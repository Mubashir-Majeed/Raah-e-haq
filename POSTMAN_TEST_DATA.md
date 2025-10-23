# 🚗 Ride Module API - Postman Test Data Collection

## Base URL
```
https://raahehaq.com/api
```

## Authentication Tokens
```
Passenger Token: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
Driver Token: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

---

## 📱 **TEST SEQUENCE 1: PASSENGER CREATES RIDE WITH STOPS**

### 1. Create Ride Request
**Method:** `POST`  
**URL:** `{{base_url}}/rides`  
**Headers:**
```
Content-Type: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Body (JSON):**
```json
{
  "passenger_id": 11,
  "pickup_address": "Karachi Airport Terminal 1",
  "dropoff_address": "DHA Phase 2, Block A",
  "pickup_latitude": 24.8607,
  "pickup_longitude": 67.0011,
  "dropoff_latitude": 24.7982,
  "dropoff_longitude": 67.0537,
  "vehicle_type": "car",
  "passenger_count": 2,
  "special_instructions": "Please call when you arrive at pickup location",
  "stops": [
    {
      "address": "Gulshan-e-Iqbal Block 6, Near Metro Station",
      "latitude": 24.9038,
      "longitude": 67.0677,
      "stop_order": 1
    },
    {
      "address": "Bahadurabad Market, Main Road",
      "latitude": 24.8858,
      "longitude": 67.0360,
      "stop_order": 2
    },
    {
      "address": "Saddar Market, Electronics Market",
      "latitude": 24.8632,
      "longitude": 67.0002,
      "stop_order": 3
    }
  ]
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Ride request created successfully",
  "data": {
    "id": 123,
    "ride_id": "RIDE-000123",
    "passenger_id": 11,
    "driver_id": null,
    "pickup_address": "Karachi Airport Terminal 1",
    "dropoff_address": "DHA Phase 2, Block A",
    "status": "requested",
    "vehicle_type": "car",
    "total_fare": 575,
    "stops": [
      {
        "id": 1,
        "address": "Gulshan-e-Iqbal Block 6, Near Metro Station",
        "stop_order": 1,
        "status": "active"
      },
      {
        "id": 2,
        "address": "Bahadurabad Market, Main Road",
        "stop_order": 2,
        "status": "active"
      },
      {
        "id": 3,
        "address": "Saddar Market, Electronics Market",
        "stop_order": 3,
        "status": "active"
      }
    ],
    "current_stop_index": 0,
    "active_stops_count": 3,
    "completed_stops_count": 0
  }
}
```

---

### 2. Find Nearby Drivers
**Method:** `GET`  
**URL:** `{{base_url}}/rides/nearby-drivers?latitude=24.8607&longitude=67.0011&radius=5&vehicle_type=car`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Expected Response:**
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
    },
    {
      "id": 7,
      "name": "Muhammad Ali",
      "phone": "+92-301-2345678",
      "rating": 4.6,
      "vehicle_type": "car",
      "distance_km": 3.1,
      "estimated_arrival_min": 12,
      "location": {
        "latitude": 24.858,
        "longitude": 67.005
      }
    }
  ]
}
```

---

### 3. Get Ride Details (Passenger)
**Method:** `GET`  
**URL:** `{{base_url}}/rides/123`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Expected Response:**
```json
{
  "success": true,
  "data": {
    "id": 123,
    "ride_id": "RIDE-000123",
    "passenger_id": 11,
    "driver_id": null,
    "status": "requested",
    "pickup_address": "Karachi Airport Terminal 1",
    "dropoff_address": "DHA Phase 2, Block A",
    "total_fare": 575,
    "stops": [...],
    "current_stop_index": 0,
    "active_stops_count": 3,
    "completed_stops_count": 0,
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

## 👨‍💼 **TEST SEQUENCE 2: DRIVER OPERATIONS**

### 4. Get Pending Rides (Driver)
**Method:** `GET`  
**URL:** `{{base_url}}/rides/pending?driver_id=5&latitude=24.8620&longitude=67.0020&radius=10&vehicle_type=car`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Expected Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 123,
      "passenger_id": 11,
      "pickup_address": "Karachi Airport Terminal 1",
      "dropoff_address": "DHA Phase 2, Block A",
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
      "estimated_fare": 575
    }
  ]
}
```

---

### 5. Update Driver Location
**Method:** `POST`  
**URL:** `{{base_url}}/tracking/update-location`  
**Headers:**
```
Content-Type: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Body (JSON):**
```json
{
  "latitude": 24.8620,
  "longitude": 67.0020,
  "status": "available",
  "speed": 0,
  "heading": 0,
  "accuracy": 5.0
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Location updated successfully"
}
```

---

### 6. Accept Ride (Driver)
**Method:** `POST`  
**URL:** `{{base_url}}/rides/123/assign-driver`  
**Headers:**
```
Content-Type: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Body (JSON):**
```json
{
  "driver_id": 5
}
```

**Expected Response:**
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
    },
    "driver": {
      "id": 5,
      "name": "Ahmed Khan",
      "phone": "+92-300-1234567",
      "rating": 4.8
    }
  }
}
```

---

## 📍 **TEST SEQUENCE 3: STOP MANAGEMENT**

### 7. Add Stop to Ride
**Method:** `POST`  
**URL:** `{{base_url}}/rides/123/stops`  
**Headers:**
```
Content-Type: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Body (JSON):**
```json
{
  "address": "Clifton Block 2, Near Beach",
  "latitude": 24.8200,
  "longitude": 67.0300,
  "stop_order": 4
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Stop added successfully",
  "data": {
    "id": 123,
    "stops": [
      {
        "id": 1,
        "address": "Gulshan-e-Iqbal Block 6, Near Metro Station",
        "stop_order": 1,
        "status": "active",
        "estimated_arrival": "15 minutes"
      },
      {
        "id": 2,
        "address": "Bahadurabad Market, Main Road",
        "stop_order": 2,
        "status": "active",
        "estimated_arrival": "25 minutes"
      },
      {
        "id": 3,
        "address": "Saddar Market, Electronics Market",
        "stop_order": 3,
        "status": "active",
        "estimated_arrival": "35 minutes"
      },
      {
        "id": 4,
        "address": "Clifton Block 2, Near Beach",
        "stop_order": 4,
        "status": "active",
        "estimated_arrival": "45 minutes"
      }
    ],
    "updated_fare": 600,
    "updated_distance": "22.5 km",
    "updated_duration": "55 minutes"
  }
}
```

---

### 8. Reorder Stops
**Method:** `PUT`  
**URL:** `{{base_url}}/rides/123/stops/reorder`  
**Headers:**
```
Content-Type: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Body (JSON):**
```json
{
  "stop_orders": [
    {"stop_id": 1, "new_order": 2},
    {"stop_id": 2, "new_order": 1},
    {"stop_id": 3, "new_order": 3},
    {"stop_id": 4, "new_order": 4}
  ]
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Stop order updated successfully",
  "data": {
    "id": 123,
    "stops": [
      {
        "id": 2,
        "address": "Bahadurabad Market, Main Road",
        "stop_order": 1,
        "status": "active",
        "estimated_arrival": "15 minutes"
      },
      {
        "id": 1,
        "address": "Gulshan-e-Iqbal Block 6, Near Metro Station",
        "stop_order": 2,
        "status": "active",
        "estimated_arrival": "25 minutes"
      },
      {
        "id": 3,
        "address": "Saddar Market, Electronics Market",
        "stop_order": 3,
        "status": "active",
        "estimated_arrival": "35 minutes"
      },
      {
        "id": 4,
        "address": "Clifton Block 2, Near Beach",
        "stop_order": 4,
        "status": "active",
        "estimated_arrival": "45 minutes"
      }
    ],
    "updated_fare": 600,
    "updated_distance": "22.5 km",
    "updated_duration": "55 minutes"
  }
}
```

---

### 9. Remove Stop from Ride
**Method:** `DELETE`  
**URL:** `{{base_url}}/rides/123/stops/4`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Stop removed successfully",
  "data": {
    "id": 123,
    "stops": [
      {
        "id": 2,
        "address": "Bahadurabad Market, Main Road",
        "stop_order": 1,
        "status": "active",
        "estimated_arrival": "15 minutes"
      },
      {
        "id": 1,
        "address": "Gulshan-e-Iqbal Block 6, Near Metro Station",
        "stop_order": 2,
        "status": "active",
        "estimated_arrival": "25 minutes"
      },
      {
        "id": 3,
        "address": "Saddar Market, Electronics Market",
        "stop_order": 3,
        "status": "active",
        "estimated_arrival": "35 minutes"
      }
    ],
    "updated_fare": 575,
    "updated_distance": "20.2 km",
    "updated_duration": "45 minutes"
  }
}
```

---

## 🧭 **TEST SEQUENCE 4: DRIVER NAVIGATION**

### 10. Start Ride (Driver)
**Method:** `PUT`  
**URL:** `{{base_url}}/rides/123`  
**Headers:**
```
Content-Type: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Body (JSON):**
```json
{
  "status": "ongoing"
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Ride started successfully",
  "data": {
    "id": 123,
    "status": "ongoing",
    "started_at": "2024-01-15T10:45:00Z"
  }
}
```

---

### 11. Navigate to Next Stop
**Method:** `POST`  
**URL:** `{{base_url}}/rides/123/navigate-next-stop`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Navigating to next stop",
  "data": {
    "id": 123,
    "current_stop_index": 0,
    "next_stop": {
      "id": 2,
      "address": "Bahadurabad Market, Main Road",
      "latitude": 24.8858,
      "longitude": 67.0360,
      "stop_order": 1,
      "status": "active",
      "estimated_arrival": "8 minutes"
    },
    "remaining_stops": 3,
    "route_updated": true
  }
}
```

---

### 12. Get Navigation Instructions
**Method:** `GET`  
**URL:** `{{base_url}}/rides/123/navigation-instructions`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Expected Response:**
```json
{
  "success": true,
  "data": {
    "current_stop_index": 0,
    "total_stops": 3,
    "route": {
      "distance": "2.5 km",
      "duration": "8 minutes",
      "steps": [
        {
          "instruction": "Head north on Airport Road",
          "distance": "500m",
          "duration": "2 minutes"
        },
        {
          "instruction": "Turn right onto Shahrah-e-Faisal",
          "distance": "1.2 km",
          "duration": "4 minutes"
        },
        {
          "instruction": "Turn left onto Bahadurabad Road",
          "distance": "800m",
          "duration": "2 minutes"
        },
        {
          "instruction": "Arrive at Bahadurabad Market",
          "distance": "0m",
          "duration": "0 minutes"
        }
      ]
    },
    "next_stop": {
      "id": 2,
      "address": "Bahadurabad Market, Main Road",
      "latitude": 24.8858,
      "longitude": 67.0360,
      "stop_order": 1,
      "status": "active"
    }
  }
}
```

---

### 13. Complete First Stop
**Method:** `POST`  
**URL:** `{{base_url}}/rides/123/stops/2/complete`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Expected Response:**
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
      "id": 1,
      "address": "Gulshan-e-Iqbal Block 6, Near Metro Station",
      "latitude": 24.9038,
      "longitude": 67.0677,
      "stop_order": 2,
      "status": "active",
      "estimated_arrival": "5 minutes"
    }
  }
}
```

---

### 14. Complete Second Stop
**Method:** `POST`  
**URL:** `{{base_url}}/rides/123/stops/1/complete`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Stop completed successfully",
  "data": {
    "id": 123,
    "current_stop_index": 2,
    "completed_stops": 2,
    "remaining_stops": 1,
    "next_stop": {
      "id": 3,
      "address": "Saddar Market, Electronics Market",
      "latitude": 24.8632,
      "longitude": 67.0002,
      "stop_order": 3,
      "status": "active",
      "estimated_arrival": "3 minutes"
    }
  }
}
```

---

### 15. Complete Third Stop
**Method:** `POST`  
**URL:** `{{base_url}}/rides/123/stops/3/complete`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Stop completed successfully",
  "data": {
    "id": 123,
    "current_stop_index": 3,
    "completed_stops": 3,
    "remaining_stops": 0,
    "next_stop": null
  }
}
```

---

### 16. Complete Ride
**Method:** `PUT`  
**URL:** `{{base_url}}/rides/123`  
**Headers:**
```
Content-Type: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Body (JSON):**
```json
{
  "status": "completed",
  "fare": 575,
  "distance_km": 20.2,
  "duration_min": 45
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Ride completed successfully",
  "data": {
    "id": 123,
    "status": "completed",
    "total_fare": 575,
    "distance_km": 20.2,
    "duration_minutes": 45,
    "completed_at": "2024-01-15T11:30:00Z"
  }
}
```

---

## 🔔 **TEST SEQUENCE 5: NOTIFICATIONS**

### 17. Get User Notifications
**Method:** `GET`  
**URL:** `{{base_url}}/notifications`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Expected Response:**
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
      "created_at": "2024-01-15T10:32:00Z"
    },
    {
      "id": 2,
      "user_id": 11,
      "type": "ride_started",
      "title": "Ride Started",
      "message": "Your ride has started",
      "data": {
        "ride_id": 123
      },
      "read_at": null,
      "created_at": "2024-01-15T10:45:00Z"
    },
    {
      "id": 3,
      "user_id": 11,
      "type": "ride_completed",
      "title": "Ride Completed",
      "message": "Your ride has been completed. Fare: PKR 575",
      "data": {
        "ride_id": 123,
        "fare": 575
      },
      "read_at": null,
      "created_at": "2024-01-15T11:30:00Z"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 20,
    "total": 3
  }
}
```

---

### 18. Get Unread Count
**Method:** `GET`  
**URL:** `{{base_url}}/notifications/unread-count`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Expected Response:**
```json
{
  "success": true,
  "data": {
    "unread_count": 3
  }
}
```

---

### 19. Mark Notification as Read
**Method:** `POST`  
**URL:** `{{base_url}}/notifications/1/read`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Notification marked as read",
  "data": {
    "id": 1,
    "read_at": "2024-01-15T11:35:00Z"
  }
}
```

---

### 20. Mark All Notifications as Read
**Method:** `POST`  
**URL:** `{{base_url}}/notifications/read-all`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Expected Response:**
```json
{
  "success": true,
  "message": "All notifications marked as read"
}
```

---

## 🌐 **TEST SEQUENCE 6: WEBSOCKET**

### 21. Subscribe to Ride Updates
**Method:** `POST`  
**URL:** `{{base_url}}/websocket/subscribe-ride`  
**Headers:**
```
Content-Type: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Body (JSON):**
```json
{
  "ride_id": 123,
  "user_type": "passenger"
}
```

**Expected Response:**
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

### 22. Subscribe to Driver Requests
**Method:** `POST`  
**URL:** `{{base_url}}/websocket/subscribe-driver`  
**Headers:**
```
Content-Type: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
```

**Body (JSON):**
```json
{
  "driver_id": 5,
  "latitude": 24.8620,
  "longitude": 67.0020,
  "radius": 10
}
```

**Expected Response:**
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

### 23. Get WebSocket Events
**Method:** `GET`  
**URL:** `{{base_url}}/websocket/events`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Expected Response:**
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
      },
      "stop_update": {
        "description": "Stop-related updates",
        "payload": {
          "type": "stop_update",
          "ride_id": "number",
          "stop_id": "number",
          "action": "string",
          "stop_data": "object"
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
      },
      "ride_cancelled": {
        "description": "Ride cancellation notifications",
        "payload": {
          "type": "ride_cancelled",
          "ride_id": "number",
          "reason": "string"
        }
      },
      "stop_navigation": {
        "description": "Stop navigation instructions",
        "payload": {
          "type": "stop_navigation",
          "ride_id": "number",
          "next_stop": "object",
          "route_instructions": "array"
        }
      }
    }
  }
}
```

---

## 🚫 **TEST SEQUENCE 7: ERROR SCENARIOS**

### 24. Cancel Ride (Error - Already Completed)
**Method:** `POST`  
**URL:** `{{base_url}}/rides/123/cancel`  
**Headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Expected Response:**
```json
{
  "success": false,
  "error": {
    "code": "RIDE_CANNOT_BE_CANCELLED",
    "message": "Ride cannot be cancelled",
    "details": "Ride cannot be cancelled in current status"
  }
}
```

---

### 25. Add Stop (Error - Max Stops Exceeded)
**Method:** `POST`  
**URL:** `{{base_url}}/rides/123/stops`  
**Headers:**
```
Content-Type: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
```

**Body (JSON):**
```json
{
  "address": "Extra Stop",
  "latitude": 24.8000,
  "longitude": 67.0000,
  "stop_order": 6
}
```

**Expected Response:**
```json
{
  "success": false,
  "error": {
    "code": "MAX_STOPS_EXCEEDED",
    "message": "Maximum number of stops (5) exceeded",
    "details": "Cannot add more than 5 stops to a ride"
  }
}
```

---

## 📊 **POSTMAN COLLECTION VARIABLES**

### Environment Variables
```
base_url: https://raahehaq.com/api
passenger_token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.passenger_token
driver_token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.driver_token
ride_id: 123
stop_id: 1
```

### Collection Variables
```
ride_id: {{ride_id}}
stop_id: {{stop_id}}
passenger_id: 11
driver_id: 5
```

---

## 🎯 **TESTING SEQUENCE SUMMARY**

### **Phase 1: Passenger Operations**
1. Create ride with 3 stops
2. Find nearby drivers
3. Get ride details

### **Phase 2: Driver Operations**
4. Get pending rides
5. Update driver location
6. Accept ride

### **Phase 3: Stop Management**
7. Add stop (4th stop)
8. Reorder stops
9. Remove stop

### **Phase 4: Driver Navigation**
10. Start ride
11. Navigate to next stop
12. Get navigation instructions
13. Complete first stop
14. Complete second stop
15. Complete third stop
16. Complete ride

### **Phase 5: Notifications**
17. Get notifications
18. Get unread count
19. Mark notification as read
20. Mark all as read

### **Phase 6: WebSocket**
21. Subscribe to ride updates
22. Subscribe to driver requests
23. Get WebSocket events

### **Phase 7: Error Testing**
24. Cancel completed ride (error)
25. Add too many stops (error)

---

This comprehensive test data collection covers the complete ride lifecycle from creation to completion, including all stop management features, real-time communication, and error scenarios. Use this data in Postman to test all ride module APIs in sequence.
