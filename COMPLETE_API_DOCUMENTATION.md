# 🚗 Ride Module API Documentation

## Base URL
```
https://raahehaq.com/api
```

## Authentication
All endpoints require Bearer token authentication:
```
Authorization: Bearer {user_token}
```

---

## 📱 **RIDE MANAGEMENT ENDPOINTS**

### 1. Create Ride Request
**Endpoint:** `POST /rides`

**Description:** Creates a new ride request with optional multiple stops.

**Headers:**
```
Content-Type: application/json
Authorization: Bearer {passenger_token}
```

**Request Payload:**
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

**Response:**
```json
{
  "success": true,
  "message": "Ride request created successfully",
  "data": {
    "id": 123,
    "ride_id": "RIDE-000123",
    "passenger_id": 11,
    "driver_id": null,
    "pickup_address": "Karachi Airport",
    "dropoff_address": "DHA Phase 2",
    "pickup_latitude": 24.8607,
    "pickup_longitude": 67.0011,
    "dropoff_latitude": 24.7982,
    "dropoff_longitude": 67.0537,
    "status": "requested",
    "vehicle_type": "car",
    "passenger_count": 1,
    "special_instructions": "Please call when you arrive",
    "base_fare": 100,
    "distance_fare": 350,
    "time_fare": 0,
    "total_fare": 500,
    "driver_earnings": 0,
    "platform_commission": 0,
    "distance_km": null,
    "duration_minutes": null,
    "payment_method": "cash",
    "payment_status": "pending",
    "stops": [
      {
        "id": 1,
        "ride_id": 123,
        "address": "Gulshan-e-Iqbal Block 6",
        "latitude": 24.9038,
        "longitude": 67.0677,
        "stop_order": 1,
        "status": "active",
        "status_label": "Active",
        "status_color": "blue",
        "arrived_at": null,
        "completed_at": null,
        "notes": null,
        "estimated_arrival": "15 minutes",
        "created_at": "2024-01-15T10:30:00Z",
        "updated_at": "2024-01-15T10:30:00Z"
      },
      {
        "id": 2,
        "ride_id": 123,
        "address": "Bahadurabad Market",
        "latitude": 24.8858,
        "longitude": 67.0360,
        "stop_order": 2,
        "status": "active",
        "status_label": "Active",
        "status_color": "blue",
        "arrived_at": null,
        "completed_at": null,
        "notes": null,
        "estimated_arrival": "25 minutes",
        "created_at": "2024-01-15T10:30:00Z",
        "updated_at": "2024-01-15T10:30:00Z"
      }
    ],
    "current_stop_index": 0,
    "active_stops_count": 2,
    "completed_stops_count": 0,
    "estimated_arrival": null,
    "passenger": {
      "id": 11,
      "name": "Sara Ahmed",
      "phone": "+92-300-9876543",
      "rating": 4.5
    },
    "driver": null,
    "vehicle": null,
    "requested_at": "2024-01-15T10:30:00Z",
    "accepted_at": null,
    "arrived_at": null,
    "started_at": null,
    "completed_at": null,
    "cancelled_at": null,
    "created_at": "2024-01-15T10:30:00Z",
    "updated_at": "2024-01-15T10:30:00Z"
  }
}
```

---

### 2. Get Ride Details
**Endpoint:** `GET /rides/{id}`

**Description:** Retrieves detailed information about a specific ride.

**Headers:**
```
Authorization: Bearer {user_token}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 123,
    "ride_id": "RIDE-000123",
    "passenger_id": 11,
    "driver_id": 5,
    "pickup_address": "Karachi Airport",
    "dropoff_address": "DHA Phase 2",
    "status": "accepted",
    "driver": {
      "id": 5,
      "name": "Ahmed Khan",
      "phone": "+92-300-1234567",
      "rating": 4.8,
      "vehicle_type": "car",
      "license_number": "ABC-123"
    },
    "stops": [...],
    "estimated_arrival": "5 minutes"
  }
}
```

---

### 3. Update Ride Status
**Endpoint:** `PUT /rides/{id}`

**Description:** Updates ride status and related information.

**Headers:**
```
Content-Type: application/json
Authorization: Bearer {driver_token}
```

**Request Payload:**
```json
{
  "status": "ongoing",
  "fare": 450,
  "distance_km": 15.2,
  "duration_min": 25
}
```

**Response:**
```json
{
  "success": true,
  "message": "Ride updated successfully",
  "data": {
    "id": 123,
    "status": "ongoing",
    "started_at": "2024-01-15T10:45:00Z"
  }
}
```

---

### 4. Assign Driver
**Endpoint:** `POST /rides/{id}/assign-driver`

**Description:** Assigns a driver to a ride request.

**Headers:**
```
Content-Type: application/json
Authorization: Bearer {driver_token}
```

**Request Payload:**
```json
{
  "driver_id": 5
}
```

**Response:**
```json
{
  "success": true,
  "message": "Driver assigned successfully",
  "data": {
    "id": 123,
    "passenger_id": 11,
    "driver_id": 5,
    "status": "accepted",
    "accepted_at": "2024-01-15T10:32:00Z",
    "passenger": {
      "id": 11,
      "name": "Sara Ahmed",
      "phone": "+92-300-9876543",
      "rating": 4.5
    }
  }
}
```

---

### 5. Cancel Ride
**Endpoint:** `POST /rides/{id}/cancel`

**Description:** Cancels a ride request.

**Headers:**
```
Authorization: Bearer {user_token}
```

**Response:**
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

---

### 6. Get Pending Rides (Driver)
**Endpoint:** `GET /rides/pending`

**Description:** Retrieves available ride requests for drivers.

**Headers:**
```
Authorization: Bearer {driver_token}
```

**Query Parameters:**
- `driver_id` (required): Driver ID
- `latitude` (required): Driver's current latitude
- `longitude` (required): Driver's current longitude
- `radius` (optional): Search radius in km (default: 10)
- `vehicle_type` (optional): Filter by vehicle type

**Example Request:**
```
GET /rides/pending?driver_id=5&latitude=24.8620&longitude=67.0020&radius=10&vehicle_type=car
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 123,
      "passenger_id": 11,
      "pickup_address": "Karachi Airport",
      "dropoff_address": "DHA Phase 2",
      "pickup_latitude": 24.8607,
      "pickup_longitude": 67.0011,
      "dropoff_latitude": 24.7982,
      "dropoff_longitude": 67.0537,
      "status": "requested",
      "vehicle_type": "car",
      "passenger": {
        "id": 11,
        "name": "Sara Ahmed",
        "phone": "+92-300-9876543",
        "rating": 4.5
      },
      "estimated_distance": "2.3 km",
      "estimated_fare": 450
    }
  ]
}
```

---

### 7. Find Nearby Drivers
**Endpoint:** `GET /rides/nearby-drivers`

**Description:** Finds available drivers near a location.

**Headers:**
```
Authorization: Bearer {passenger_token}
```

**Query Parameters:**
- `latitude` (required): Search latitude
- `longitude` (required): Search longitude
- `radius` (optional): Search radius in km (default: 5)
- `vehicle_type` (optional): Filter by vehicle type

**Example Request:**
```
GET /rides/nearby-drivers?latitude=24.8607&longitude=67.0011&radius=5&vehicle_type=car
```

**Response:**
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

## 📍 **STOP MANAGEMENT ENDPOINTS**

### 1. Add Stop to Ride
**Endpoint:** `POST /rides/{id}/stops`

**Description:** Adds a new stop to an existing ride.

**Headers:**
```
Content-Type: application/json
Authorization: Bearer {passenger_token}
```

**Request Payload:**
```json
{
  "address": "Saddar Market",
  "latitude": 24.8632,
  "longitude": 67.0002,
  "stop_order": 3
}
```

**Response:**
```json
{
  "success": true,
  "message": "Stop added successfully",
  "data": {
    "id": 123,
    "stops": [
      {
        "id": 1,
        "address": "Gulshan-e-Iqbal Block 6",
        "latitude": 24.9038,
        "longitude": 67.0677,
        "stop_order": 1,
        "status": "active",
        "estimated_arrival": "15 minutes"
      },
      {
        "id": 2,
        "address": "Bahadurabad Market",
        "latitude": 24.8858,
        "longitude": 67.0360,
        "stop_order": 2,
        "status": "active",
        "estimated_arrival": "25 minutes"
      },
      {
        "id": 3,
        "address": "Saddar Market",
        "latitude": 24.8632,
        "longitude": 67.0002,
        "stop_order": 3,
        "status": "active",
        "estimated_arrival": "35 minutes"
      }
    ],
    "updated_fare": 550,
    "updated_distance": "18.5 km",
    "updated_duration": "45 minutes"
  }
}
```

---

### 2. Remove Stop from Ride
**Endpoint:** `DELETE /rides/{id}/stops/{stop_id}`

**Description:** Removes a stop from a ride.

**Headers:**
```
Authorization: Bearer {passenger_token}
```

**Response:**
```json
{
  "success": true,
  "message": "Stop removed successfully",
  "data": {
    "id": 123,
    "stops": [
      {
        "id": 1,
        "address": "Gulshan-e-Iqbal Block 6",
        "latitude": 24.9038,
        "longitude": 67.0677,
        "stop_order": 1,
        "status": "active",
        "estimated_arrival": "15 minutes"
      },
      {
        "id": 3,
        "address": "Saddar Market",
        "latitude": 24.8632,
        "longitude": 67.0002,
        "stop_order": 2,
        "status": "active",
        "estimated_arrival": "25 minutes"
      }
    ],
    "updated_fare": 450,
    "updated_distance": "15.2 km",
    "updated_duration": "35 minutes"
  }
}
```

---

### 3. Update Stop Order
**Endpoint:** `PUT /rides/{id}/stops/reorder`

**Description:** Reorders stops in a ride.

**Headers:**
```
Content-Type: application/json
Authorization: Bearer {passenger_token}
```

**Request Payload:**
```json
{
  "stop_orders": [
    {"stop_id": 1, "new_order": 2},
    {"stop_id": 2, "new_order": 1}
  ]
}
```

**Response:**
```json
{
  "success": true,
  "message": "Stop order updated successfully",
  "data": {
    "id": 123,
    "stops": [
      {
        "id": 2,
        "address": "Bahadurabad Market",
        "latitude": 24.8858,
        "longitude": 67.0360,
        "stop_order": 1,
        "status": "active",
        "estimated_arrival": "15 minutes"
      },
      {
        "id": 1,
        "address": "Gulshan-e-Iqbal Block 6",
        "latitude": 24.9038,
        "longitude": 67.0677,
        "stop_order": 2,
        "status": "active",
        "estimated_arrival": "25 minutes"
      }
    ],
    "updated_fare": 450,
    "updated_distance": "15.2 km",
    "updated_duration": "35 minutes"
  }
}
```

---

## 🧭 **DRIVER NAVIGATION ENDPOINTS**

### 1. Navigate to Next Stop
**Endpoint:** `POST /rides/{id}/navigate-next-stop`

**Description:** Initiates navigation to the next stop.

**Headers:**
```
Authorization: Bearer {driver_token}
```

**Response:**
```json
{
  "success": true,
  "message": "Navigating to next stop",
  "data": {
    "id": 123,
    "current_stop_index": 1,
    "next_stop": {
      "id": 2,
      "address": "Bahadurabad Market",
      "latitude": 24.8858,
      "longitude": 67.0360,
      "stop_order": 2,
      "status": "active",
      "estimated_arrival": "8 minutes"
    },
    "remaining_stops": 2,
    "route_updated": true
  }
}
```

---

### 2. Mark Stop as Completed
**Endpoint:** `POST /rides/{id}/stops/{stop_id}/complete`

**Description:** Marks a stop as completed.

**Headers:**
```
Authorization: Bearer {driver_token}
```

**Response:**
```json
{
  "success": true,
  "message": "Stop completed successfully",
  "data": {
    "id": 123,
    "current_stop_index": 1,
    "completed_stops": 1,
    "remaining_stops": 2,
    "next_stop": {
      "id": 2,
      "address": "Bahadurabad Market",
      "latitude": 24.8858,
      "longitude": 67.0360,
      "stop_order": 2,
      "status": "active",
      "estimated_arrival": "5 minutes"
    }
  }
}
```

---

### 3. Get Navigation Instructions
**Endpoint:** `GET /rides/{id}/navigation-instructions`

**Description:** Retrieves navigation instructions for the next stop.

**Headers:**
```
Authorization: Bearer {driver_token}
```

**Response:**
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
        },
        {
          "instruction": "Turn right onto Market Road",
          "distance": "1.2 km",
          "duration": "4 minutes"
        },
        {
          "instruction": "Arrive at Bahadurabad Market",
          "distance": "800m",
          "duration": "2 minutes"
        }
      ]
    },
    "next_stop": {
      "id": 2,
      "address": "Bahadurabad Market",
      "latitude": 24.8858,
      "longitude": 67.0360,
      "stop_order": 2,
      "status": "active"
    }
  }
}
```

---

## 📍 **LOCATION TRACKING ENDPOINTS**

### 1. Update Driver Location
**Endpoint:** `POST /tracking/update-location`

**Description:** Updates driver's current location.

**Headers:**
```
Content-Type: application/json
Authorization: Bearer {driver_token}
```

**Request Payload:**
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

**Response:**
```json
{
  "success": true,
  "message": "Location updated successfully"
}
```

---

### 2. Get Driver Location
**Endpoint:** `GET /tracking/driver/{driver_id}/location`

**Description:** Retrieves driver's current location.

**Headers:**
```
Authorization: Bearer {user_token}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "driver_id": 5,
    "latitude": 24.8620,
    "longitude": 67.0020,
    "status": "online",
    "speed": 25.5,
    "heading": 180,
    "accuracy": 5.0,
    "last_seen_at": "2024-01-15T10:30:00Z"
  }
}
```

---

## 🔔 **NOTIFICATION ENDPOINTS**

### 1. Get User Notifications
**Endpoint:** `GET /notifications`

**Description:** Retrieves user's notifications.

**Headers:**
```
Authorization: Bearer {user_token}
```

**Query Parameters:**
- `page` (optional): Page number for pagination
- `per_page` (optional): Number of notifications per page (default: 20)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "user_id": 11,
      "type": "driver_assigned",
      "title": "Driver Assigned",
      "message": "Your ride has been accepted by Ahmed Khan",
      "data": {
        "ride_id": 123,
        "driver_name": "Ahmed Khan",
        "driver_phone": "+92-300-1234567"
      },
      "read_at": null,
      "created_at": "2024-01-15T10:30:00Z",
      "updated_at": "2024-01-15T10:30:00Z"
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

---

### 2. Mark Notification as Read
**Endpoint:** `POST /notifications/{id}/read`

**Description:** Marks a notification as read.

**Headers:**
```
Authorization: Bearer {user_token}
```

**Response:**
```json
{
  "success": true,
  "message": "Notification marked as read",
  "data": {
    "id": 1,
    "read_at": "2024-01-15T10:35:00Z"
  }
}
```

---

### 3. Mark All Notifications as Read
**Endpoint:** `POST /notifications/read-all`

**Description:** Marks all notifications as read.

**Headers:**
```
Authorization: Bearer {user_token}
```

**Response:**
```json
{
  "success": true,
  "message": "All notifications marked as read"
}
```

---

### 4. Get Unread Count
**Endpoint:** `GET /notifications/unread-count`

**Description:** Gets count of unread notifications.

**Headers:**
```
Authorization: Bearer {user_token}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "unread_count": 5
  }
}
```

---

## 🌐 **WEBSOCKET ENDPOINTS**

### 1. Subscribe to Ride Updates
**Endpoint:** `POST /websocket/subscribe-ride`

**Description:** Subscribes to real-time ride updates.

**Headers:**
```
Content-Type: application/json
Authorization: Bearer {user_token}
```

**Request Payload:**
```json
{
  "ride_id": 123,
  "user_type": "passenger"
}
```

**Response:**
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

---

### 2. Subscribe to Driver Requests
**Endpoint:** `POST /websocket/subscribe-driver`

**Description:** Subscribes to new ride requests for drivers.

**Headers:**
```
Content-Type: application/json
Authorization: Bearer {driver_token}
```

**Request Payload:**
```json
{
  "driver_id": 5,
  "latitude": 24.8620,
  "longitude": 67.0020,
  "radius": 10
}
```

**Response:**
```json
{
  "success": true,
  "message": "Subscribed to driver requests",
  "data": {
    "driver_id": 5,
    "websocket_url": "wss://raahehaq.com/ws/driver/5",
    "channels": [
      "new_ride_requests",
      "ride_cancellations",
      "location_updates"
    ]
  }
}
```

---

### 3. Get WebSocket Events
**Endpoint:** `GET /websocket/events`

**Description:** Returns available WebSocket event types and their payloads.

**Headers:**
```
Authorization: Bearer {user_token}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "passenger_events": {
      "driver_location_update": {
        "description": "Real-time driver location updates",
        "payload": {
          "type": "driver_location_update",
          "ride_id": "number",
          "driver_location": {
            "latitude": "number",
            "longitude": "number",
            "speed": "number",
            "heading": "number"
          },
          "estimated_arrival": "string"
        }
      },
      "ride_status_update": {
        "description": "Ride status changes",
        "payload": {
          "type": "ride_status_update",
          "ride_id": "number",
          "status": "string",
          "driver": {
            "id": "number",
            "name": "string",
            "phone": "string"
          }
        }
      }
    },
    "driver_events": {
      "new_ride_request": {
        "description": "New ride requests in area",
        "payload": {
          "type": "new_ride_request",
          "ride": {
            "id": "number",
            "passenger": {
              "id": "number",
              "name": "string",
              "phone": "string"
            },
            "pickup_address": "string",
            "dropoff_address": "string",
            "estimated_fare": "number"
          }
        }
      }
    }
  }
}
```

---

## ❌ **ERROR HANDLING**

### Standard Error Response Format
```json
{
  "success": false,
  "error": {
    "code": "ERROR_CODE",
    "message": "Human readable error message",
    "details": "Detailed error description"
  }
}
```

### Common Error Codes

| Error Code | HTTP Status | Description |
|------------|-------------|-------------|
| `RIDE_NOT_FOUND` | 404 | Ride with specified ID not found |
| `RIDE_ALREADY_ACCEPTED` | 400 | Ride has already been accepted by another driver |
| `RIDE_CANCELLED` | 400 | Ride has been cancelled |
| `INVALID_STATUS_TRANSITION` | 400 | Invalid status change attempt |
| `DRIVER_NOT_AVAILABLE` | 400 | Driver is not available for new rides |
| `LOCATION_REQUIRED` | 400 | Driver location is required for this operation |
| `AUTHENTICATION_REQUIRED` | 401 | Valid authentication token required |
| `MAX_STOPS_EXCEEDED` | 400 | Maximum number of stops (5) exceeded |
| `INVALID_STOP_ORDER` | 400 | Stop order must be between 1 and 5 |
| `STOP_NOT_FOUND` | 404 | Stop with specified ID not found |
| `STOP_ALREADY_COMPLETED` | 400 | Stop has already been completed |
| `CANNOT_MODIFY_COMPLETED_RIDE` | 400 | Cannot modify stops for completed rides |
| `INVALID_STOP_COORDINATES` | 400 | Stop coordinates are invalid or out of range |
| `VALIDATION_ERROR` | 422 | Request validation failed |
| `UNAUTHORIZED` | 403 | User not authorized for this action |

---

## 📊 **DATA MODELS**

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

## 🚦 **RATE LIMITING**

| Endpoint Type | Rate Limit | Description |
|---------------|------------|-------------|
| Ride Creation | 5 requests/minute | Per passenger |
| Location Updates | 10 requests/minute | Per driver |
| Status Updates | 20 requests/minute | Per user |
| Stop Operations | 3 requests/minute | Per ride (add/remove/reorder) |
| Navigation Requests | 5 requests/minute | Per driver |

---

## 🔐 **AUTHENTICATION**

All endpoints require Bearer token authentication. Include the token in the Authorization header:

```
Authorization: Bearer {user_token}
```

### Token Types
- **Passenger Token**: For passenger-specific operations
- **Driver Token**: For driver-specific operations
- **Admin Token**: For administrative operations

---

## 📱 **MOBILE APP INTEGRATION**

### Example Implementation (React Native)

```javascript
// Create ride request
const createRide = async (rideData) => {
  try {
    const response = await fetch('https://raahehaq.com/api/rides', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${userToken}`
      },
      body: JSON.stringify(rideData)
    });
    
    const result = await response.json();
    return result;
  } catch (error) {
    console.error('Error creating ride:', error);
  }
};

// Get nearby drivers
const getNearbyDrivers = async (latitude, longitude) => {
  try {
    const response = await fetch(
      `https://raahehaq.com/api/rides/nearby-drivers?latitude=${latitude}&longitude=${longitude}&radius=5`,
      {
        headers: {
          'Authorization': `Bearer ${userToken}`
        }
      }
    );
    
    const result = await response.json();
    return result;
  } catch (error) {
    console.error('Error getting nearby drivers:', error);
  }
};
```

---

## 🎯 **BUSINESS RULES**

### Stop Management Rules
1. **Maximum Stops**: 5 stops per ride (excluding pickup and dropoff)
2. **Stop Order**: Must be sequential and unique (1, 2, 3, 4, 5)
3. **Modification**: Stops can only be modified when ride status is `requested` or `accepted`
4. **Fare Calculation**: Each stop adds PKR 25 to the total fare
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

This comprehensive API documentation provides all the necessary information for integrating the ride module with your mobile application. All endpoints are production-ready and include proper error handling, validation, and security measures.
