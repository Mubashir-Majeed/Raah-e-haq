<?php

/**
 * Ride Module API Testing Script
 * 
 * This script demonstrates all the API endpoints from the ride module documentation.
 * Run this script to test the complete ride flow.
 */

require_once 'vendor/autoload.php';

class RideApiTester
{
    private $baseUrl = 'https://raahehaq.com/api';
    private $passengerToken;
    private $driverToken;
    private $rideId;

    public function __construct()
    {
        echo "🚗 Ride Module API Testing Script\n";
        echo "================================\n\n";
    }

    public function runTests()
    {
        try {
            $this->authenticateUsers();
            $this->testRideCreation();
            $this->testDriverAssignment();
            $this->testStopManagement();
            $this->testDriverNavigation();
            $this->testRideCompletion();
            $this->testNotifications();
            $this->testWebSocket();
            
            echo "\n✅ All tests completed successfully!\n";
        } catch (Exception $e) {
            echo "\n❌ Test failed: " . $e->getMessage() . "\n";
        }
    }

    private function authenticateUsers()
    {
        echo "🔐 Authenticating users...\n";
        
        // Simulate authentication (in real implementation, use actual login)
        $this->passengerToken = 'passenger_token_123';
        $this->driverToken = 'driver_token_456';
        
        echo "✅ Users authenticated\n\n";
    }

    private function testRideCreation()
    {
        echo "📱 Testing Ride Creation...\n";
        
        $rideData = [
            'passenger_id' => 11,
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
        ];

        $response = $this->makeRequest('POST', '/rides', $rideData, $this->passengerToken);
        
        if ($response['success']) {
            $this->rideId = $response['data']['id'];
            echo "✅ Ride created successfully (ID: {$this->rideId})\n";
            echo "   - Status: {$response['data']['status']}\n";
            echo "   - Stops: " . count($response['data']['stops']) . "\n";
            echo "   - Total Fare: PKR {$response['data']['total_fare']}\n";
        } else {
            throw new Exception("Failed to create ride: " . $response['error']['message']);
        }
        
        echo "\n";
    }

    private function testDriverAssignment()
    {
        echo "👨‍💼 Testing Driver Assignment...\n";
        
        // Get nearby drivers
        $driversResponse = $this->makeRequest('GET', '/rides/nearby-drivers?' . http_build_query([
            'latitude' => 24.8607,
            'longitude' => 67.0011,
            'radius' => 5,
            'vehicle_type' => 'car'
        ]), null, $this->passengerToken);
        
        if ($driversResponse['success'] && count($driversResponse['data']) > 0) {
            $driver = $driversResponse['data'][0];
            echo "✅ Found nearby driver: {$driver['name']} (Distance: {$driver['distance_km']} km)\n";
            
            // Assign driver
            $assignResponse = $this->makeRequest('POST', "/rides/{$this->rideId}/assign-driver", [
                'driver_id' => $driver['id']
            ], $this->driverToken);
            
            if ($assignResponse['success']) {
                echo "✅ Driver assigned successfully\n";
                echo "   - Driver: {$assignResponse['data']['driver']['name']}\n";
                echo "   - Status: {$assignResponse['data']['status']}\n";
            } else {
                throw new Exception("Failed to assign driver: " . $assignResponse['error']['message']);
            }
        } else {
            echo "⚠️  No nearby drivers found\n";
        }
        
        echo "\n";
    }

    private function testStopManagement()
    {
        echo "📍 Testing Stop Management...\n";
        
        // Add a new stop
        $addStopResponse = $this->makeRequest('POST', "/rides/{$this->rideId}/stops", [
            'address' => 'Saddar Market',
            'latitude' => 24.8632,
            'longitude' => 67.0002,
            'stop_order' => 3
        ], $this->passengerToken);
        
        if ($addStopResponse['success']) {
            echo "✅ Stop added successfully\n";
            echo "   - Updated Fare: PKR {$addStopResponse['data']['updated_fare']}\n";
            echo "   - Total Stops: " . count($addStopResponse['data']['stops']) . "\n";
        }
        
        // Reorder stops
        $reorderResponse = $this->makeRequest('PUT', "/rides/{$this->rideId}/stops/reorder", [
            'stop_orders' => [
                ['stop_id' => 1, 'new_order' => 2],
                ['stop_id' => 2, 'new_order' => 1]
            ]
        ], $this->passengerToken);
        
        if ($reorderResponse['success']) {
            echo "✅ Stop order updated successfully\n";
        }
        
        echo "\n";
    }

    private function testDriverNavigation()
    {
        echo "🧭 Testing Driver Navigation...\n";
        
        // Navigate to next stop
        $navigateResponse = $this->makeRequest('POST', "/rides/{$this->rideId}/navigate-next-stop", null, $this->driverToken);
        
        if ($navigateResponse['success']) {
            echo "✅ Navigation started\n";
            echo "   - Current Stop Index: {$navigateResponse['data']['current_stop_index']}\n";
            echo "   - Remaining Stops: {$navigateResponse['data']['remaining_stops']}\n";
        }
        
        // Get navigation instructions
        $instructionsResponse = $this->makeRequest('GET', "/rides/{$this->rideId}/navigation-instructions", null, $this->driverToken);
        
        if ($instructionsResponse['success']) {
            echo "✅ Navigation instructions retrieved\n";
            echo "   - Route Distance: {$instructionsResponse['data']['route']['distance']}\n";
            echo "   - Route Duration: {$instructionsResponse['data']['route']['duration']}\n";
        }
        
        echo "\n";
    }

    private function testRideCompletion()
    {
        echo "🏁 Testing Ride Completion...\n";
        
        // Update ride status to ongoing
        $startResponse = $this->makeRequest('PUT', "/rides/{$this->rideId}", [
            'status' => 'ongoing'
        ], $this->driverToken);
        
        if ($startResponse['success']) {
            echo "✅ Ride started\n";
        }
        
        // Complete the ride
        $completeResponse = $this->makeRequest('PUT', "/rides/{$this->rideId}", [
            'status' => 'completed',
            'fare' => 450,
            'distance_km' => 15.2,
            'duration_min' => 25
        ], $this->driverToken);
        
        if ($completeResponse['success']) {
            echo "✅ Ride completed successfully\n";
            echo "   - Final Fare: PKR {$completeResponse['data']['total_fare']}\n";
            echo "   - Distance: {$completeResponse['data']['distance_km']} km\n";
            echo "   - Duration: {$completeResponse['data']['duration_minutes']} minutes\n";
        }
        
        echo "\n";
    }

    private function testNotifications()
    {
        echo "🔔 Testing Notifications...\n";
        
        // Get user notifications
        $notificationsResponse = $this->makeRequest('GET', '/notifications', null, $this->passengerToken);
        
        if ($notificationsResponse['success']) {
            echo "✅ Notifications retrieved\n";
            echo "   - Total Notifications: " . count($notificationsResponse['data']) . "\n";
        }
        
        // Get unread count
        $unreadResponse = $this->makeRequest('GET', '/notifications/unread-count', null, $this->passengerToken);
        
        if ($unreadResponse['success']) {
            echo "✅ Unread count: {$unreadResponse['data']['unread_count']}\n";
        }
        
        echo "\n";
    }

    private function testWebSocket()
    {
        echo "🌐 Testing WebSocket Subscription...\n";
        
        // Subscribe to ride updates
        $subscribeResponse = $this->makeRequest('POST', '/websocket/subscribe-ride', [
            'ride_id' => $this->rideId,
            'user_type' => 'passenger'
        ], $this->passengerToken);
        
        if ($subscribeResponse['success']) {
            echo "✅ WebSocket subscription successful\n";
            echo "   - WebSocket URL: {$subscribeResponse['data']['websocket_url']}\n";
            echo "   - Channels: " . implode(', ', $subscribeResponse['data']['channels']) . "\n";
        }
        
        // Get WebSocket events
        $eventsResponse = $this->makeRequest('GET', '/websocket/events', null, $this->passengerToken);
        
        if ($eventsResponse['success']) {
            echo "✅ WebSocket events retrieved\n";
            echo "   - Passenger Events: " . count($eventsResponse['data']['passenger_events']) . "\n";
            echo "   - Driver Events: " . count($eventsResponse['data']['driver_events']) . "\n";
        }
        
        echo "\n";
    }

    private function makeRequest($method, $endpoint, $data = null, $token = null)
    {
        $url = $this->baseUrl . $endpoint;
        
        $headers = [
            'Content-Type: application/json',
            'Accept: application/json'
        ];
        
        if ($token) {
            $headers[] = "Authorization: Bearer {$token}";
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        if ($method === 'POST' || $method === 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
        }
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode >= 400) {
            throw new Exception("HTTP Error {$httpCode}: {$response}");
        }
        
        return json_decode($response, true);
    }
}

// Run the tests
$tester = new RideApiTester();
$tester->runTests();
