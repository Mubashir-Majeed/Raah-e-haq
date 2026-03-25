# Raah-e-Haq Mobile App Documentation

## 🚗 Project Overview

**Raah-e-Haq** is a comprehensive ride-sharing mobile application similar to Uber and Careem, built with Laravel backend. This document provides the complete API sequence and implementation guide for mobile app development.

---

## 📱 Mobile App Architecture

### **User Roles**
1. **Passenger** - Requests rides and pays for trips
2. **Driver** - Accepts rides and earns money
3. **Admin** - Manages the entire system

### **Core Features**
- 🔐 User Authentication & Registration
- 🚗 Ride Booking & Management
- 📍 Real-time GPS Tracking
- 💳 Payment & Wallet System
- ⭐ Rating & Review System
- 🗺️ Multiple Stops Support
- 🔔 Push Notifications
- 📊 Trip History
- 👥 Referral System

---

## 🔄 Complete Ride Flow Sequence

### **Phase 1: User Registration & Authentication**

#### **1.1 Passenger Registration**
```
POST /api/auth/register
```
**Request:**
```json
{
  "name": "Ahmed Khan",
  "email": "ahmed@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "user_type": "passenger",
  "phone": "+92-300-1234567",
  "cnic": "12345-1234567-1",
  "address": "DHA Phase 5, Karachi",
  "emergency_contact": "+92-300-7654321",
  "preferred_payment": "cash"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Registration successful! Your account is pending admin approval.",
  "data": {
    "user": {
      "id": 1,
      "name": "Ahmed Khan",
      "email": "ahmed@example.com",
      "user_type": "passenger",
      "status": "pending",
      "created_at": "2025-01-19T10:30:00.000000Z"
    }
  }
}
```

#### **1.2 Driver Registration**
```
POST /api/auth/register
```
**Request:**
```json
{
  "name": "Ali Hassan",
  "email": "ali@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "user_type": "driver",
  "phone": "+92-300-9876543",
  "cnic": "54321-7654321-1",
  "address": "Gulshan-e-Iqbal, Karachi",
  "emergency_contact": "+92-300-1234567",
  "license_number": "LIC789012",
  "vehicle_type": "Sedan",
  "preferred_payment": "wallet"
}
```

#### **1.3 Login (Email/Password)**
```
POST /api/auth/login
```
**Request:**
```json
{
  "email": "ahmed@example.com",
  "password": "password123"
}
```

#### **1.4 Phone OTP Login**
```
POST /api/auth/send-otp
POST /api/auth/verify-otp
```

---

### **Phase 2: Driver Online & Available**

#### **2.1 Driver Goes Online**
```
POST /api/tracking/update-location
```
**Request:**
```json
{
  "latitude": 24.8607,
  "longitude": 67.0011,
  "status": "online",
  "speed": 0,
  "heading": 0,
  "accuracy": 5.0
}
```

#### **2.2 Driver Status Changes**
- `online` - Ready to accept rides
- `available` - Available for ride requests
- `busy` - Currently on a ride
- `offline` - Not accepting rides

---

### **Phase 3: Passenger Requests Ride**

#### **3.1 Create Ride Request**
```
POST /api/rides
```
**Request:**
```json
{
  "passenger_id": 1,
  "pickup_address": "Karachi Airport, Jinnah Terminal",
  "dropoff_address": "DHA Phase 2, Karachi",
  "pickup_latitude": 24.9038,
  "pickup_longitude": 67.1606,
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
    "status": "requested",
    "total_fare": 450,
    "estimated_duration": "25 minutes",
    "estimated_distance": "15.2 km",
    "stops": [...],
    "created_at": "2025-01-19T10:30:00Z"
  }
}
```

#### **3.2 Find Nearby Drivers**
```
GET /api/rides/nearby-drivers?latitude=24.9038&longitude=67.1606&radius=10&vehicle_type=car
```

---

### **Phase 4: Driver Accepts Ride**

#### **4.1 Get Pending Rides**
```
GET /api/rides/pending?driver_id=5&latitude=24.8620&longitude=67.0020&radius=10
```

#### **4.2 Driver Accepts Ride**
```
POST /api/rides/123/assign-driver
```
**Request:**
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
    "status": "accepted",
    "driver": {
      "id": 5,
      "name": "Ali Hassan",
      "phone": "+92-300-9876543",
      "rating": 4.8,
      "vehicle": {
        "type": "Sedan",
        "plate_number": "ABC-123"
      }
    },
    "accepted_at": "2025-01-19T10:32:00Z"
  }
}
```

---

### **Phase 5: Driver Navigation to Pickup**

#### **5.1 Driver Updates Location (Real-time)**
```
POST /api/tracking/update-location
```
**Request:**
```json
{
  "latitude": 24.8625,
  "longitude": 67.0025,
  "status": "busy",
  "speed": 35.5,
  "heading": 90,
  "accuracy": 5.0
}
```

#### **5.2 Passenger Tracks Driver**
```
GET /api/tracking/driver/5/latest
```

#### **5.3 Driver Arrives at Pickup**
```
PUT /api/rides/123
```
**Request:**
```json
{
  "status": "arrived"
}
```

---

### **Phase 6: Ride Journey**

#### **6.1 Start Ride**
```
PUT /api/rides/123
```
**Request:**
```json
{
  "status": "ongoing",
  "started_at": "2025-01-19T10:35:00Z"
}
```

#### **6.2 Multiple Stops Navigation**

**Navigate to Next Stop:**
```
POST /api/rides/123/navigate-next-stop
```

**Mark Stop as Completed:**
```
POST /api/rides/123/stops/1/complete
```

**Get Navigation Instructions:**
```
GET /api/rides/123/navigation-instructions
```

#### **6.3 Real-time Location Updates**
Driver sends location updates every 5-10 seconds:
```
POST /api/tracking/update-location
```

---

### **Phase 7: Ride Completion**

#### **7.1 Complete Ride**
```
PUT /api/rides/123
```
**Request:**
```json
{
  "status": "completed",
  "fare": 450,
  "distance_km": 15.2,
  "duration_min": 25,
  "completed_at": "2025-01-19T10:55:00Z"
}
```

#### **7.2 Payment Processing**
```
POST /api/payments/process
```
**Request:**
```json
{
  "ride_id": 123,
  "payment_method": "cash",
  "amount": 450,
  "driver_earnings": 360,
  "platform_commission": 90
}
```

#### **7.3 Rating & Review**
```
POST /api/rides/123/rate
```
**Request:**
```json
{
  "rating": 5,
  "review": "Excellent service, very professional driver",
  "rated_by": "passenger",
  "rated_user_id": 5
}
```

---

## 📱 Mobile App Screen Flow

### **Passenger App Screens**

#### **1. Authentication Screens**
- Welcome Screen
- Login Screen (Email/Phone)
- Registration Screen
- OTP Verification Screen
- Forgot Password Screen

#### **2. Main App Screens**
- **Home Screen** (Map View)
  - Current Location
  - Pickup/Dropoff Input
  - Nearby Drivers
  - Book Ride Button

- **Ride Booking Screen**
  - Pickup Location Confirmation
  - Dropoff Location Selection
  - Vehicle Type Selection
  - Multiple Stops Option
  - Fare Estimate
  - Special Instructions

- **Ride Request Screen**
  - Searching for Drivers
  - Driver Found Notification
  - Driver Details
  - Estimated Arrival Time

- **Active Ride Screen**
  - Real-time Driver Location
  - Route Visualization
  - Driver Information
  - Emergency Contact
  - Share Trip Status

- **Ride Completion Screen**
  - Trip Summary
  - Payment Method Selection
  - Rating & Review
  - Receipt Generation

#### **3. Profile & Settings Screens**
- Profile Management
- Payment Methods
- Ride History
- Wallet Balance
- Settings
- Help & Support

### **Driver App Screens**

#### **1. Authentication Screens**
- Login/Registration
- Document Upload
- Vehicle Registration
- Admin Approval Status

#### **2. Main App Screens**
- **Home Screen**
  - Online/Offline Toggle
  - Earnings Summary
  - Current Ride Status
  - Ride Requests

- **Ride Request Screen**
  - Passenger Details
  - Pickup Location
  - Dropoff Location
  - Fare Information
  - Accept/Decline Buttons

- **Navigation Screen**
  - Turn-by-turn Navigation
  - Real-time Location
  - Route Information
  - Stop Management

- **Earnings Screen**
  - Daily/Weekly Earnings
  - Payment History
  - Wallet Balance
  - Withdrawal Options

---

## 🔔 Real-time Features

### **WebSocket Integration**

#### **1. Subscribe to Ride Updates**
```
POST /api/websocket/subscribe-ride
```
**Request:**
```json
{
  "ride_id": 123,
  "user_type": "passenger"
}
```

#### **2. Real-time Events**
- **driver_assigned**: Driver accepted the ride
- **driver_location**: Driver location updates
- **ride_status**: Ride status changes
- **payment_processed**: Payment completed
- **rating_received**: New rating received

#### **3. Push Notification Events**
- Ride request accepted
- Driver arrived at pickup
- Ride started/ended
- Payment processed
- Promotional notifications

---

## 💳 Payment System

### **Payment Methods**
1. **Cash** - Pay driver directly
2. **Wallet** - Use app wallet balance
3. **Credit Card** - Online payment
4. **Bank Transfer** - Direct bank payment

### **Wallet Management**
```
GET /api/payments/wallet/balance
POST /api/payments/wallet/add-funds
GET /api/payments/wallet/transactions
```

### **Fare Calculation**
- **Base Fare**: PKR 50
- **Per KM Rate**: PKR 25
- **Per Minute Rate**: PKR 2
- **Stop Charges**: PKR 25 per stop
- **Platform Commission**: 20%

---

## 🗺️ Map & Navigation Features

### **Map Integration**
- Google Maps API
- Real-time traffic data
- Route optimization
- Geofencing support
- Offline map caching

### **Location Services**
- GPS tracking
- Location accuracy optimization
- Battery-efficient updates
- Background location tracking

---

## 🔒 Security Features

### **Data Protection**
- End-to-end encryption
- Secure API communication
- User data privacy
- Location data protection

### **Safety Features**
- Emergency SOS button
- Trip sharing with contacts
- Driver verification
- Real-time tracking
- 24/7 support

---

## 📊 Analytics & Reporting

### **User Analytics**
```
GET /api/analytics/user-stats
GET /api/analytics/ride-history
GET /api/analytics/earnings-report
```

### **Admin Analytics**
- Total rides per day
- Revenue reports
- Driver performance
- Customer satisfaction
- Peak hours analysis

---

## 🛠 Technical Implementation

### **Mobile App Technologies**
- **React Native** or **Flutter** for cross-platform
- **Native Android/iOS** for performance
- **Firebase** for push notifications
- **Socket.io** for real-time communication
- **Google Maps SDK** for navigation

### **API Integration**
- RESTful API consumption
- WebSocket connections
- Real-time data synchronization
- Offline data caching
- Error handling & retry logic

### **Database Schema**
- Users & Roles
- Rides & Stops
- Payments & Wallets
- Locations & Tracking
- Notifications & Events

---

## 🚀 Deployment & Testing

### **Testing Strategy**
- Unit testing for API integration
- UI/UX testing
- Performance testing
- Security testing
- User acceptance testing

### **Deployment Checklist**
- API endpoint configuration
- Authentication setup
- Push notification setup
- Map service integration
- Payment gateway setup
- Analytics integration

---

## 📋 Missing Features to Implement

Based on current project analysis, here are the missing features for complete mobile app functionality:

### **1. Enhanced Driver Features**
- [ ] Driver document verification
- [ ] Vehicle registration system
- [ ] Driver performance tracking
- [ ] In-app navigation

### **2. Advanced Payment Features**
- [ ] Multiple payment gateways
- [ ] Wallet recharge options
- [ ] Refund system
- [ ] Promotional discounts

### **3. Safety & Security**
- [ ] Emergency SOS system
- [ ] Trip recording
- [ ] Driver background checks
- [ ] Insurance integration

### **4. Analytics & Insights**
- [ ] User behavior tracking
- [ ] Route optimization
- [ ] Demand prediction
- [ ] Dynamic pricing

### **5. Customer Support**
- [ ] In-app chat system
- [ ] Ticket management
- [ ] FAQ system
- [ ] Video calling support

---

## 📞 Support & Maintenance

### **Customer Support Channels**
- In-app chat support
- Email support
- Phone support
- Social media integration

### **Maintenance Schedule**
- Regular API updates
- Bug fixes and patches
- Feature enhancements
- Security updates

---

## 🎯 Success Metrics

### **Key Performance Indicators**
- Daily active users
- Ride completion rate
- Average wait time
- Customer satisfaction score
- Driver utilization rate
- Revenue per ride

---

This documentation provides the complete sequence for implementing the Raah-e-Haq mobile application. The APIs are already built and ready for integration. Follow the sequence step by step for successful mobile app development.

**Next Steps:**
1. Review existing APIs in detail
2. Set up mobile development environment
3. Implement authentication flow
4. Build ride booking system
5. Integrate real-time features
6. Test and deploy the application

For any clarification or additional features, please refer to the existing API documentation or contact the development team.
