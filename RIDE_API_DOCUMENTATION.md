# Ride Module API Documentation

## Overview

This document provides comprehensive API documentation for the Ride Module, including all endpoints for ride management, multiple stops functionality, real-time communication, and push notifications.

## Base URL

```
https://raahehaq.com/api
```

## Authentication

All endpoints require Bearer token authentication:

```
Authorization: Bearer {user_token}
```

## Rate Limiting

- **Ride Creation**: 5 requests per minute per passenger
- **Location Updates**: 10 requests per minute per driver
- **Status Updates**: 20 requests per minute per user
- **Stop Operations**: 3 requests per minute per ride
- **Navigation Requests**: 5 requests per minute per driver

---

## Ride Management Endpoints

### 1. Create Ride Request

**Endpoint**: `POST /rides`

**Description**: Creates a new ride request with optional multiple stops.

**Request Body**:
```json
{
  "passenger_id": 11,
  "pickup_address": "Karachi Airport",
  "dropoff_address": "DHA Phase 2",
  "pickup_latitude": 24.8607,
  "pickup_longitude": 67.0011,
  "dropoff_latitude": 24.7982,
  "dropoff_longitude": 67.0537,
  "vehicle_type": "car",
  "passenger_count": 1,
  "special_instructions": "Please call when you arrive",
  "stops": [
    {
      "address": "Gulshan-e-Iqbal Block 6",
      "latitude": 24.9038,
      "longitude": 67.0677,
      "stop_order": 1
    },
    {
      "address": "Bahadurabad Market",
      "latitude": 24.8858,
      "longitude": 67.0360,
      "stop_order": 2
    }
  ]
}
```

**Response**:
```json
{
  "success": true,
  "message": "Ride request created successfully",
  "data": {
    "id": 123,
    "ride_id": "RIDE-000123",
    "passenger_id": 11,
    "pickup_address": "Karachi Airport",
    "dropoff_address": "DHA Phase 2",
    "status": "requested",
    "vehicle_type": "car",
    "total_fare": 450,
    "stops": [
      {
        "id": 1,
        "address": "Gulshan-e-Iqbal Block 6",
        "latitude": 24.9038,
        "longitude": 67.0677,
        "stop_order": 1,
        "status": "active",
        "estimated_arrival": "15 minutes"
      }
    ],
    "current_stop_index": 0,
    "active_stops_count": 2,
    "completed_stops_count": 0,
    "created_at": "2024-01-15T10:30:00Z"
  }
}
```

### 2. Get Ride Details

**Endpoint**: `GET /rides/{id}`

**Description**: Retrieves detailed information about a specific ride.

**Response**:
```json
{
  "success": true,
  "data": {
    "id": 123,
    "ride_id": "RIDE-000123",
    "status": "accepted",
    "driver": {
      "id": 5,
      "name": "Ahmed Khan",
      "phone": "+92-300-1234567",
      "rating": 4.8
    },
    "stops": [...],
    "estimated_arrival": "5 minutes"
  }
}
```

### 3. Update Ride Status

**Endpoint**: `PUT /rides/{id}`

**Description**: Updates ride status and related information.

**Request Body**:
```json
{
  "status": "ongoing",
  "fare": 450,
  "distance_km": 15.2,
  "duration_min": 25
}
```

### 4. Assign Driver

**Endpoint**: `POST /rides/{id}/assign-driver`

**Description**: Assigns a driver to a ride request.

**Request Body**:
```json
{
  "driver_id": 5
}
```

### 5. Cancel Ride

**Endpoint**: `POST /rides/{id}/cancel`

**Description**: Cancels a ride request.

**Response**:
```json
{
  "success": true,
  "message": "Ride cancelled successfully",
  "data": {
    "id": 123,
    "status": "cancelled",
    "cancelled_at": "2024-01-15T10:35:00Z"
  }
}
```

### 6. Get Pending Rides (Driver)

**Endpoint**: `GET /rides/pending`

**Description**: Retrieves available ride requests for drivers.

**Query Parameters**:
- `driver_id` (required): Driver ID
- `latitude` (required): Driver's current latitude
- `longitude` (required): Driver's current longitude
- `radius` (optional): Search radius in km (default: 10)
- `vehicle_type` (optional): Filter by vehicle type

**Response**:
```json
{
  "success": true,
  "data": [
    {
      "id": 123,
      "passenger": {
        "id": 11,
        "name": "Sara Ahmed",
        "phone": "+92-300-9876543",
        "rating": 4.5
      },
      "pickup_address": "Karachi Airport",
      "dropoff_address": "DHA Phase 2",
      "estimated_distance": "2.3 km",
      "estimated_fare": 450
    }
  ]
}
```

### 7. Find Nearby Drivers

**Endpoint**: `GET /rides/nearby-drivers`

**Description**: Finds available drivers near a location.

**Query Parameters**:
- `latitude` (required): Search latitude
- `longitude` (required): Search longitude
- `radius` (optional): Search radius in km (default: 5)
- `vehicle_type` (optional): Filter by vehicle type

**Response**:
```json
{
  "success": true,
  "data": [
    {
      "id": 5,
      "name": "Ahmed Khan",
      "phone": "+92-300-1234567",
      "rating": 4.8,
      "vehicle_type": "car",
      "distance_km": 2.3,
      "estimated_arrival_min": 8,
      "location": {
        "latitude": 24.862,
        "longitude": 67.002
      }
    }
  ]
}
```

---

## Stop Management Endpoints

### 1. Add Stop to Ride

**Endpoint**: `POST /rides/{id}/stops`

**Description**: Adds a new stop to an existing ride.

**Request Body**:
```json
{
  "address": "Saddar Market",
  "latitude": 24.8632,
  "longitude": 67.0002,
  "stop_order": 3
}
```

**Response**:
```json
{
  "success": true,
  "message": "Stop added successfully",
  "data": {
    "id": 123,
    "stops": [...],
    "updated_fare": 550,
    "updated_distance": "18.5 km",
    "updated_duration": "45 minutes"
  }
}
```

### 2. Remove Stop from Ride

**Endpoint**: `DELETE /rides/{id}/stops/{stop_id}`

**Description**: Removes a stop from a ride.

**Response**:
```json
{
  "success": true,
  "message": "Stop removed successfully",
  "data": {
    "id": 123,
    "stops": [...],
    "updated_fare": 450,
    "updated_distance": "15.2 km",
    "updated_duration": "35 minutes"
  }
}
```

### 3. Update Stop Order

**Endpoint**: `PUT /rides/{id}/stops/reorder`

**Description**: Reorders stops in a ride.

**Request Body**:
```json
{
  "stop_orders": [
    {"stop_id": 1, "new_order": 2},
    {"stop_id": 2, "new_order": 1}
  ]
}
```

---

## Driver Navigation Endpoints

### 1. Navigate to Next Stop

**Endpoint**: `POST /rides/{id}/navigate-next-stop`

**Description**: Initiates navigation to the next stop.

**Response**:
```json
{
  "success": true,
  "message": "Navigating to next stop",
  "data": {
    "id": 123,
    "current_stop_index": 1,
    "next_stop": {
      "address": "Bahadurabad Market",
      "latitude": 24.8858,
      "longitude": 67.036,
      "stop_order": 2,
      "estimated_arrival": "8 minutes"
    },
    "remaining_stops": 2,
    "route_updated": true
  }
}
```

### 2. Mark Stop as Completed

**Endpoint**: `POST /rides/{id}/stops/{stop_id}/complete`

**Description**: Marks a stop as completed.

**Response**:
```json
{
  "success": true,
  "message": "Stop completed successfully",
  "data": {
    "id": 123,
    "current_stop_index": 1,
    "completed_stops": 1,
    "remaining_stops": 2,
    "next_stop": {...}
  }
}
```

### 3. Get Navigation Instructions

**Endpoint**: `GET /rides/{id}/navigation-instructions`

**Description**: Retrieves navigation instructions for the next stop.

**Response**:
```json
{
  "success": true,
  "data": {
    "current_stop_index": 1,
    "total_stops": 3,
    "route": {
      "distance": "2.5 km",
      "duration": "8 minutes",
      "steps": [
        {
          "instruction": "Head north on Main Street",
          "distance": "500m",
          "duration": "2 minutes"
        }
      ]
    },
    "next_stop": {...}
  }
}
```

---

## Location Tracking Endpoints

### 1. Update Driver Location

**Endpoint**: `POST /tracking/update-location`

**Description**: Updates driver's current location.

**Request Body**:
```json
{
  "latitude": 24.8620,
  "longitude": 67.0020,
  "status": "online",
  "speed": 25.5,
  "heading": 180,
  "accuracy": 5.0
}
```

### 2. Get Driver Location

**Endpoint**: `GET /tracking/driver/{driver_id}/location`

**Description**: Retrieves driver's current location.

---

## Notification Endpoints

### 1. Get User Notifications

**Endpoint**: `GET /notifications`

**Description**: Retrieves user's notifications.

**Response**:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "type": "driver_assigned",
      "title": "Driver Assigned",
      "message": "Your ride has been accepted by Ahmed Khan",
      "data": {
        "ride_id": 123,
        "driver_name": "Ahmed Khan"
      },
      "read_at": null,
      "created_at": "2024-01-15T10:30:00Z"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 20,
    "total": 100
  }
}
```

### 2. Mark Notification as Read

**Endpoint**: `POST /notifications/{id}/read`

**Description**: Marks a notification as read.

### 3. Mark All Notifications as Read

**Endpoint**: `POST /notifications/read-all`

**Description**: Marks all notifications as read.

### 4. Get Unread Count

**Endpoint**: `GET /notifications/unread-count`

**Description**: Gets count of unread notifications.

---

## WebSocket Endpoints

### 1. Subscribe to Ride Updates

**Endpoint**: `POST /websocket/subscribe-ride`

**Description**: Subscribes to real-time ride updates.

**Request Body**:
```json
{
  "ride_id": 123,
  "user_type": "passenger"
}
```

**Response**:
```json
{
  "success": true,
  "message": "Subscribed to ride updates",
  "data": {
    "ride_id": 123,
    "user_type": "passenger",
    "websocket_url": "wss://raahehaq.com/ws/ride/123",
    "channels": [
      "ride_updates",
      "driver_location",
      "stop_updates",
      "status_changes"
    ]
  }
}
```

### 2. Subscribe to Driver Requests

**Endpoint**: `POST /websocket/subscribe-driver`

**Description**: Subscribes to new ride requests for drivers.

**Request Body**:
```json
{
  "driver_id": 5,
  "latitude": 24.8620,
  "longitude": 67.0020,
  "radius": 10
}
```

### 3. Get WebSocket Events

**Endpoint**: `GET /websocket/events`

**Description**: Returns available WebSocket event types and their payloads.

---

## Error Handling

### Standard Error Response

```json
{
  "success": false,
  "error": {
    "code": "RIDE_NOT_FOUND",
    "message": "Ride not found",
    "details": "The requested ride with ID 123 does not exist"
  }
}
```

### Common Error Codes

- `RIDE_NOT_FOUND`: Ride with specified ID not found
- `RIDE_ALREADY_ACCEPTED`: Ride has already been accepted by another driver
- `RIDE_CANCELLED`: Ride has been cancelled
- `INVALID_STATUS_TRANSITION`: Invalid status change attempt
- `DRIVER_NOT_AVAILABLE`: Driver is not available for new rides
- `LOCATION_REQUIRED`: Driver location is required for this operation
- `AUTHENTICATION_REQUIRED`: Valid authentication token required
- `MAX_STOPS_EXCEEDED`: Maximum number of stops (5) exceeded
- `INVALID_STOP_ORDER`: Stop order must be between 1 and 5
- `STOP_NOT_FOUND`: Stop with specified ID not found
- `STOP_ALREADY_COMPLETED`: Stop has already been completed
- `CANNOT_MODIFY_COMPLETED_RIDE`: Cannot modify stops for completed rides
- `INVALID_STOP_COORDINATES`: Stop coordinates are invalid or out of range

---

## Data Models

### Ride Resource

```typescript
interface RideResource {
  id: number;
  ride_id: string;
  passenger_id: number;
  driver_id?: number;
  pickup_address: string;
  dropoff_address: string;
  pickup_latitude: number;
  pickup_longitude: number;
  dropoff_latitude: number;
  dropoff_longitude: number;
  status: 'requested' | 'accepted' | 'ongoing' | 'completed' | 'cancelled';
  vehicle_type: string;
  passenger_count: number;
  special_instructions?: string;
  base_fare: number;
  distance_fare: number;
  time_fare: number;
  total_fare: number;
  driver_earnings: number;
  platform_commission: number;
  distance_km?: number;
  duration_minutes?: number;
  payment_method: string;
  payment_status: string;
  stops: RideStopResource[];
  current_stop_index: number;
  active_stops_count: number;
  completed_stops_count: number;
  estimated_arrival?: string;
  passenger?: UserResource;
  driver?: UserResource;
  vehicle?: VehicleResource;
  requested_at: string;
  accepted_at?: string;
  arrived_at?: string;
  started_at?: string;
  completed_at?: string;
  cancelled_at?: string;
  created_at: string;
  updated_at: string;
}
```

### Ride Stop Resource

```typescript
interface RideStopResource {
  id: number;
  ride_id: number;
  address: string;
  latitude: number;
  longitude: number;
  stop_order: number;
  status: 'active' | 'completed' | 'cancelled' | 'skipped';
  status_label: string;
  status_color: string;
  arrived_at?: string;
  completed_at?: string;
  notes?: string;
  estimated_arrival?: string;
  created_at: string;
  updated_at: string;
}
```

---

## Business Rules

### Stop Management Rules

1. **Maximum Stops Limit**: Maximum 5 stops per ride (excluding pickup and dropoff)
2. **Stop Order Validation**: Stop order must be sequential and unique
3. **Stop Modification Rules**: Stops can only be modified when ride status is `requested` or `accepted`
4. **Fare Calculation**: Each additional stop adds PKR 25 to the total fare
5. **Route Optimization**: Backend optimizes route order for shortest distance

### Ride Status Flow

```
requested → accepted → ongoing → completed
     ↓           ↓         ↓
  cancelled   cancelled cancelled
```

### Stop Status Flow

```
Stop Created → Stop Active → Stop Completed
     ↓              ↓
Stop Cancelled  Stop Skipped
```

---

## Implementation Notes

### Caching Strategy

- Driver locations: Cache for 30 seconds
- Ride status: Cache for 10 seconds
- Nearby drivers: Cache for 1 minute
- Stop information: Cache for 5 minutes
- Route calculations: Cache for 2 minutes
- Navigation instructions: Cache for 1 minute

### Security Considerations

- All endpoints require authentication
- Location data should be encrypted in transit
- Driver assignment validates driver availability
- Rate limiting prevents abuse
- User authorization checks for all operations

### Performance Optimization

- Use pagination for ride history
- Implement WebSocket connections for real-time updates
- Cache frequently accessed data
- Use database indexes on location coordinates
- Optimize distance calculations

---

This API provides a comprehensive solution for ride management with multiple stops, real-time tracking, and professional-grade features suitable for production use.
