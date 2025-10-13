<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ride;
use App\Models\RideStop;
use App\Models\DriverLocation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class RideModuleApiTest extends TestCase
{
    use RefreshDatabase;

    protected $passenger;
    protected $driver;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test users
        $this->passenger = User::factory()->create(['role' => 'passenger']);
        $this->driver = User::factory()->create(['role' => 'driver']);
        
        // Create driver location
        DriverLocation::create([
            'driver_id' => $this->driver->id,
            'latitude' => 24.8620,
            'longitude' => 67.0020,
            'status' => 'available',
            'last_seen_at' => now(),
        ]);
    }

    /** @test */
    public function passenger_can_create_ride_request_with_stops()
    {
        Sanctum::actingAs($this->passenger);

        $response = $this->postJson('/api/rides', [
            'passenger_id' => $this->passenger->id,
            'pickup_address' => 'Karachi Airport',
            'dropoff_address' => 'DHA Phase 2',
            'pickup_latitude' => 24.8607,
            'pickup_longitude' => 67.0011,
            'dropoff_latitude' => 24.7982,
            'dropoff_longitude' => 67.0537,
            'vehicle_type' => 'car',
            'stops' => [
                [
                    'address' => 'Gulshan-e-Iqbal Block 6',
                    'latitude' => 24.9038,
                    'longitude' => 67.0677,
                    'stop_order' => 1
                ],
                [
                    'address' => 'Bahadurabad Market',
                    'latitude' => 24.8858,
                    'longitude' => 67.0360,
                    'stop_order' => 2
                ]
            ]
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'ride_id',
                    'status',
                    'stops' => [
                        '*' => [
                            'id',
                            'address',
                            'latitude',
                            'longitude',
                            'stop_order',
                            'status'
                        ]
                    ],
                    'current_stop_index',
                    'active_stops_count',
                    'completed_stops_count'
                ]
            ]);

        $this->assertDatabaseHas('rides', [
            'passenger_id' => $this->passenger->id,
            'status' => 'requested'
        ]);

        $this->assertDatabaseHas('ride_stops', [
            'address' => 'Gulshan-e-Iqbal Block 6',
            'stop_order' => 1
        ]);
    }

    /** @test */
    public function driver_can_get_pending_rides()
    {
        // Create a ride request
        $ride = Ride::create([
            'ride_id' => 'RIDE-001',
            'passenger_id' => $this->passenger->id,
            'pickup_address' => 'Karachi Airport',
            'pickup_latitude' => 24.8607,
            'pickup_longitude' => 67.0011,
            'dropoff_address' => 'DHA Phase 2',
            'dropoff_latitude' => 24.7982,
            'dropoff_longitude' => 67.0537,
            'status' => 'requested',
            'vehicle_type' => 'car',
            'total_fare' => 450,
        ]);

        Sanctum::actingAs($this->driver);

        $response = $this->getJson('/api/rides/pending?' . http_build_query([
            'driver_id' => $this->driver->id,
            'latitude' => 24.8620,
            'longitude' => 67.0020,
            'radius' => 10
        ]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'passenger',
                        'pickup_address',
                        'dropoff_address',
                        'estimated_distance',
                        'estimated_fare'
                    ]
                ]
            ]);
    }

    /** @test */
    public function driver_can_accept_ride()
    {
        // Create a ride request
        $ride = Ride::create([
            'ride_id' => 'RIDE-002',
            'passenger_id' => $this->passenger->id,
            'pickup_address' => 'Karachi Airport',
            'pickup_latitude' => 24.8607,
            'pickup_longitude' => 67.0011,
            'dropoff_address' => 'DHA Phase 2',
            'dropoff_latitude' => 24.7982,
            'dropoff_longitude' => 67.0537,
            'status' => 'requested',
            'vehicle_type' => 'car',
            'total_fare' => 450,
        ]);

        Sanctum::actingAs($this->driver);

        $response = $this->postJson("/api/rides/{$ride->id}/assign-driver", [
            'driver_id' => $this->driver->id
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Driver assigned successfully'
            ]);

        $this->assertDatabaseHas('rides', [
            'id' => $ride->id,
            'driver_id' => $this->driver->id,
            'status' => 'accepted'
        ]);
    }

    /** @test */
    public function passenger_can_add_stop_to_ride()
    {
        // Create a ride with driver assigned
        $ride = Ride::create([
            'ride_id' => 'RIDE-003',
            'passenger_id' => $this->passenger->id,
            'driver_id' => $this->driver->id,
            'pickup_address' => 'Karachi Airport',
            'pickup_latitude' => 24.8607,
            'pickup_longitude' => 67.0011,
            'dropoff_address' => 'DHA Phase 2',
            'dropoff_latitude' => 24.7982,
            'dropoff_longitude' => 67.0537,
            'status' => 'accepted',
            'vehicle_type' => 'car',
            'total_fare' => 450,
        ]);

        Sanctum::actingAs($this->passenger);

        $response = $this->postJson("/api/rides/{$ride->id}/stops", [
            'address' => 'Saddar Market',
            'latitude' => 24.8632,
            'longitude' => 67.0002,
            'stop_order' => 3
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Stop added successfully'
            ]);

        $this->assertDatabaseHas('ride_stops', [
            'ride_id' => $ride->id,
            'address' => 'Saddar Market',
            'stop_order' => 3
        ]);
    }

    /** @test */
    public function driver_can_complete_stop()
    {
        // Create a ride with stops
        $ride = Ride::create([
            'ride_id' => 'RIDE-004',
            'passenger_id' => $this->passenger->id,
            'driver_id' => $this->driver->id,
            'pickup_address' => 'Karachi Airport',
            'pickup_latitude' => 24.8607,
            'pickup_longitude' => 67.0011,
            'dropoff_address' => 'DHA Phase 2',
            'dropoff_latitude' => 24.7982,
            'dropoff_longitude' => 67.0537,
            'status' => 'ongoing',
            'vehicle_type' => 'car',
            'total_fare' => 450,
        ]);

        $stop = RideStop::create([
            'ride_id' => $ride->id,
            'address' => 'Gulshan-e-Iqbal Block 6',
            'latitude' => 24.9038,
            'longitude' => 67.0677,
            'stop_order' => 1,
            'status' => 'active',
        ]);

        Sanctum::actingAs($this->driver);

        $response = $this->postJson("/api/rides/{$ride->id}/stops/{$stop->id}/complete");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Stop completed successfully'
            ]);

        $this->assertDatabaseHas('ride_stops', [
            'id' => $stop->id,
            'status' => 'completed'
        ]);
    }

    /** @test */
    public function passenger_can_cancel_ride()
    {
        // Create a ride
        $ride = Ride::create([
            'ride_id' => 'RIDE-005',
            'passenger_id' => $this->passenger->id,
            'pickup_address' => 'Karachi Airport',
            'pickup_latitude' => 24.8607,
            'pickup_longitude' => 67.0011,
            'dropoff_address' => 'DHA Phase 2',
            'dropoff_latitude' => 24.7982,
            'dropoff_longitude' => 67.0537,
            'status' => 'requested',
            'vehicle_type' => 'car',
            'total_fare' => 450,
        ]);

        Sanctum::actingAs($this->passenger);

        $response = $this->postJson("/api/rides/{$ride->id}/cancel");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Ride cancelled successfully'
            ]);

        $this->assertDatabaseHas('rides', [
            'id' => $ride->id,
            'status' => 'cancelled'
        ]);
    }

    /** @test */
    public function can_get_nearby_drivers()
    {
        Sanctum::actingAs($this->passenger);

        $response = $this->getJson('/api/rides/nearby-drivers?' . http_build_query([
            'latitude' => 24.8607,
            'longitude' => 67.0011,
            'radius' => 5,
            'vehicle_type' => 'car'
        ]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'phone',
                        'rating',
                        'vehicle_type',
                        'distance_km',
                        'estimated_arrival_min',
                        'location'
                    ]
                ]
            ]);
    }

    /** @test */
    public function can_get_navigation_instructions()
    {
        // Create a ride with stops
        $ride = Ride::create([
            'ride_id' => 'RIDE-006',
            'passenger_id' => $this->passenger->id,
            'driver_id' => $this->driver->id,
            'pickup_address' => 'Karachi Airport',
            'pickup_latitude' => 24.8607,
            'pickup_longitude' => 67.0011,
            'dropoff_address' => 'DHA Phase 2',
            'dropoff_latitude' => 24.7982,
            'dropoff_longitude' => 67.0537,
            'status' => 'ongoing',
            'vehicle_type' => 'car',
            'total_fare' => 450,
        ]);

        RideStop::create([
            'ride_id' => $ride->id,
            'address' => 'Gulshan-e-Iqbal Block 6',
            'latitude' => 24.9038,
            'longitude' => 67.0677,
            'stop_order' => 1,
            'status' => 'active',
        ]);

        Sanctum::actingAs($this->driver);

        $response = $this->getJson("/api/rides/{$ride->id}/navigation-instructions");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'current_stop_index',
                    'total_stops',
                    'route' => [
                        'distance',
                        'duration',
                        'steps'
                    ],
                    'next_stop'
                ]
            ]);
    }

    /** @test */
    public function can_get_user_notifications()
    {
        Sanctum::actingAs($this->passenger);

        $response = $this->getJson('/api/notifications');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data',
                'pagination'
            ]);
    }

    /** @test */
    public function can_subscribe_to_websocket_updates()
    {
        // Create a ride
        $ride = Ride::create([
            'ride_id' => 'RIDE-007',
            'passenger_id' => $this->passenger->id,
            'pickup_address' => 'Karachi Airport',
            'pickup_latitude' => 24.8607,
            'pickup_longitude' => 67.0011,
            'dropoff_address' => 'DHA Phase 2',
            'dropoff_latitude' => 24.7982,
            'dropoff_longitude' => 67.0537,
            'status' => 'requested',
            'vehicle_type' => 'car',
            'total_fare' => 450,
        ]);

        Sanctum::actingAs($this->passenger);

        $response = $this->postJson('/api/websocket/subscribe-ride', [
            'ride_id' => $ride->id,
            'user_type' => 'passenger'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'ride_id',
                    'user_type',
                    'websocket_url',
                    'channels'
                ]
            ]);
    }
}
