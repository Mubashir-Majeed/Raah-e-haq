# Raah-e-Haq Postman Collection Setup Guide

## 📋 Collection Overview

Maine aapke Raah-e-Haq mobile app ke liye complete Postman collection banai hai. Ye collection aapko API testing ke liye ready kar degi.

## 🚀 Quick Setup Instructions

### **1. Import Collection in Postman**

1. **Open Postman**
2. **Click on Import** (top left)
3. **Select "File" tab**
4. **Choose file**: `Raah_e_Haq_Mobile_App_API.postman_collection.json`
5. **Click Import**

### **2. Environment Variables Setup**

Collection mein already variables hain jo aapko update karne honge:

```json
{
  "base_url": "http://localhost:8000",
  "auth_token": "your_auth_token_here",
  "driver_id": "5",
  "ride_id": "123",
  "stop_id": "1",
  "notification_id": "1"
}
```

**Environment Variables Update Karne Ke Liye:**

1. **Postman mein** → **Environments** tab
2. **Create new environment** naam se: "Raah-e-Haq Development"
3. **Variables add karo**:
   - `base_url`: `http://localhost:8000` (ya aapka actual URL)
   - `auth_token`: Login karne ke mila token
   - `driver_id`: Driver user ka ID
   - `ride_id`: Test ride ka ID
   - `stop_id`: Stop ka ID
   - `notification_id`: Notification ka ID

## 🔄 Testing Sequence

### **Phase 1: Authentication Testing**

1. **User Registration** 
   - Test karo passenger aur driver dono ke liye
   - Response mein user ID note karo

2. **Login**
   - Email/password se login karo
   - Response mein token copy kar ke `auth_token` variable mein paste karo

3. **Get Profile**
   - Token working hai ya nahi check karo

### **Phase 2: Driver Setup**

1. **Update Driver Location**
   - Driver ko online set karo
   - Status: "online"

2. **Find Nearby Drivers**
   - Location-based search test karo

### **Phase 3: Complete Ride Flow**

1. **Create Ride Request** (Passenger)
   - Pickup aur dropoff locations set karo
   - Response mein ride ID note karo

2. **Get Pending Rides** (Driver)
   - Driver ke liye available rides check karo

3. **Assign Driver** 
   - Ride ko driver assign karo
   - `ride_id` variable update karo

4. **Update Ride Status** (Sequence wise):
   - "arrived" - Driver pickup location pahunch gaya
   - "ongoing" - Ride start ho gayi
   - "completed" - Ride complete ho gayi

### **Phase 4: Multiple Stops Testing**

1. **Add Stop to Ride**
2. **Navigate to Next Stop**
3. **Mark Stop as Completed**
4. **Get Navigation Instructions**

### **Phase 5: Payment & Rating**

1. **Process Payment**
2. **Rate Ride**
3. **Check Wallet Balance**

## 📱 Mobile App Testing Scenarios

### **Scenario 1: New User Registration**
```
Registration → Login → Profile Update → Avatar Upload
```

### **Scenario 2: Complete Ride Flow**
```
Driver Online → Passenger Requests Ride → Driver Accepts → 
Driver Arrives → Ride Starts → Location Updates → 
Multiple Stops → Ride Completes → Payment → Rating
```

### **Scenario 3: Real-time Features**
```
WebSocket Subscribe → Location Updates → 
Notifications → Real-time Tracking
```

## 🔧 Important Testing Tips

### **1. Token Management**
- Har request ke liye fresh token use karo
- Token expire ho gaya to dobara login karo
- `auth_token` variable update karna na bhulein

### **2. Dynamic Variables**
- `ride_id`, `driver_id`, `stop_id` ko responses se update karo
- Real database IDs use karo hardcoded values nahi

### **3. Error Handling**
- 401 Unauthorized: Token expired ya invalid
- 404 Not Found: ID galat hai
- 422 Validation: Request body galat format mein hai
- 500 Server Error: Backend issue

### **4. Real-time Testing**
- WebSocket endpoints test karne ke liye browser console use karo
- Multiple Postman tabs open kar ke parallel testing karo

## 📊 Response Samples

### **Successful Registration Response:**
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
      "status": "pending"
    }
  }
}
```

### **Successful Login Response:**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {...},
    "token": "1|abcdef123456...",
    "token_type": "Bearer"
  }
}
```

### **Ride Created Response:**
```json
{
  "success": true,
  "message": "Ride request created successfully",
  "data": {
    "id": 123,
    "ride_id": "RIDE-000123",
    "status": "requested",
    "total_fare": 450
  }
}
```

## 🚨 Common Issues & Solutions

### **Issue 1: CORS Errors**
**Solution:** Backend mein CORS headers check karo

### **Issue 2: Token Not Working**
**Solution:** 
1. Dobara login karo
2. Token copy kar ke environment variable mein paste karo
3. Header format check karo: `Authorization: Bearer {token}`

### **Issue 3: 404 Not Found**
**Solution:** 
1. URL check karo
2. Database mein record exist karta hai ya nahi
3. ID correct hai ya nahi

### **Issue 4: Validation Errors**
**Solution:** 
1. Request body format check karo
2. Required fields fill karo
3. Data types correct hain ya nahi

## 📝 Testing Checklist

### **Authentication ✅**
- [ ] User registration working
- [ ] Login with email/password
- [ ] OTP login working
- [ ] Profile retrieval
- [ ] Logout working

### **Ride Management ✅**
- [ ] Ride creation
- [ ] Driver assignment
- [ ] Status updates
- [ ] Ride cancellation
- [ ] Ride history

### **Location Tracking ✅**
- [ ] Driver location updates
- [ ] Nearby drivers search
- [ ] Real-time tracking

### **Multiple Stops ✅**
- [ ] Add stop to ride
- [ ] Remove stop
- [ ] Navigate to stops
- [ ] Complete stops

### **Payments ✅**
- [ ] Payment processing
- [ ] Wallet operations
- [ ] Transaction history

### **Notifications ✅**
- [ ] Get notifications
- [ ] Mark as read
- [ ] Real-time updates

## 🎯 Next Steps

1. **Complete API testing** using ye collection
2. **Mobile app integration** start karo
3. **Real-time features** implement karo
4. **Error handling** improve karo
5. **Performance testing** karo

Ye collection aapko complete API testing ke liye ready hai. Mobile app development se pehle ye APIs test kar ke confident ho jao. Koi issue ho to mujhse contact karo.
