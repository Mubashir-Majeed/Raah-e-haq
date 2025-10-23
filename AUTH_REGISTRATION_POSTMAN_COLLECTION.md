# 🚗 **POSTMAN COLLECTION: Driver & Passenger Registration APIs**

## 📋 **Collection Overview**
This collection contains all authentication and registration APIs for the ReH ride-sharing platform, including real test data and image uploads for both drivers and passengers.

---

## 🔧 **Environment Variables**
Set these variables in your Postman environment:

```json
{
  "base_url": "http://127.0.0.1:9000/api",
  "passenger_token": "",
  "driver_token": "",
  "admin_token": ""
}
```

---

## 📱 **1. PASSENGER REGISTRATION**

### **1.1 Register New Passenger**
```http
POST {{base_url}}/auth/register
Content-Type: multipart/form-data
```

**Form Data (Passenger Registration):**
```
name: Ahmed Ali Khan
email: ahmed.ali@email.com
password: Password123!
password_confirmation: Password123!
user_type: passenger
phone: +92-300-1234567
date_of_birth: 1990-05-15
gender: male
cnic: 42101-1234567-8
address: House 45, Block 6, PECHS, Karachi
country: Pakistan
passenger_preferred_payment: mobile_wallet
passenger_emergency_contact: +92-301-9876543
passenger_emergency_contact_name: Fatima Khan
passenger_emergency_contact_relation: Sister
passenger_cnic_front_image: [FILE] - CNIC Front Image
passenger_cnic_back_image: [FILE] - CNIC Back Image
passenger_profile_image: [FILE] - Profile Image (Optional)
languages: ["urdu", "english"]
bio: Professional working in IT sector, need reliable transportation for daily commute.
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Registration successful! Your account is pending admin approval. You will be able to login once approved.",
  "data": {
    "user": {
      "id": 1,
      "name": "Ahmed Ali Khan",
      "email": "ahmed.ali@email.com",
      "user_type": "passenger",
      "role": "passenger",
      "roles": ["passenger"],
      "status": "active",
      "created_at": "2025-01-15T10:30:00.000000Z"
    },
    "token": "1|abc123def456...",
    "token_type": "Bearer"
  }
}
```

---

## 🚗 **2. DRIVER REGISTRATION**

### **2.1 Register New Driver**
```http
POST {{base_url}}/auth/register
Content-Type: multipart/form-data
```

**Form Data (Driver Registration):**
```
name: Muhammad Hassan
email: m.hassan@email.com
password: DriverPass123!
password_confirmation: DriverPass123!
user_type: driver
phone: +92-302-2345678
date_of_birth: 1985-08-20
gender: male
cnic: 42101-2345678-9
address: Flat 12, Building 5, Gulshan-e-Iqbal, Karachi
country: Pakistan
license_number: LIC-2023-001234
license_type: LTV
license_expiry_date: 2028-12-31
driving_experience: 5 years
bank_account_number: 1234567890123456
bank_name: Habib Bank Limited
bank_branch: Gulshan-e-Iqbal Branch
vehicle_type: car
vehicle_make: Toyota
vehicle_model: Corolla
vehicle_year: 2020
vehicle_color: White
license_plate: KHI-2020-1234
registration_number: REG-2020-5678
preferred_payment: mobile_wallet
cnic_front_image: [FILE] - CNIC Front Image
cnic_back_image: [FILE] - CNIC Back Image
license_image: [FILE] - Driving License Image
profile_image: [FILE] - Profile Image
vehicle_front_image: [FILE] - Vehicle Front Image
vehicle_back_image: [FILE] - Vehicle Back Image
vehicle_left_image: [FILE] - Vehicle Left Side Image
vehicle_right_image: [FILE] - Vehicle Right Side Image
languages: ["urdu", "english", "sindhi"]
bio: Professional driver with 5 years experience. Available 24/7 for reliable service.
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Registration successful! Your account is pending admin approval. You will be able to login once approved.",
  "data": {
    "user": {
      "id": 2,
      "name": "Muhammad Hassan",
      "email": "m.hassan@email.com",
      "user_type": "driver",
      "role": "driver",
      "roles": ["driver"],
      "status": "pending",
      "created_at": "2025-01-15T10:35:00.000000Z"
    },
    "token": null,
    "token_type": null
  }
}
```

---

## 🔐 **3. AUTHENTICATION**

### **3.1 Login with Email/Password**
```http
POST {{base_url}}/auth/login
Content-Type: application/json
```

**Request Body:**
```json
{
  "email": "ahmed.ali@email.com",
  "password": "Password123!"
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "Ahmed Ali Khan",
      "email": "ahmed.ali@email.com",
      "phone": "+92-300-1234567",
      "status": "active",
      "role": "passenger",
      "roles": ["passenger"]
    },
    "token": "2|xyz789abc123...",
    "token_type": "Bearer"
  }
}
```

### **3.2 Send OTP to Phone**
```http
POST {{base_url}}/auth/send-otp
Content-Type: application/json
```

**Request Body:**
```json
{
  "phone": "+92-300-1234567"
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "OTP sent successfully",
  "data": {
    "phone": "+92-300-1234567",
    "otp_code": "123456",
    "expires_in": 60
  }
}
```

### **3.3 Verify OTP and Login**
```http
POST {{base_url}}/auth/verify-otp
Content-Type: application/json
```

**Request Body:**
```json
{
  "phone": "+92-300-1234567",
  "otp_code": "123456"
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "OTP verified successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "Ahmed Ali Khan",
      "email": "ahmed.ali@email.com",
      "phone": "+92-300-1234567",
      "status": "active",
      "role": "passenger",
      "roles": ["passenger"]
    },
    "token": "3|def456ghi789...",
    "token_type": "Bearer"
  }
}
```

### **3.4 Get User Profile**
```http
GET {{base_url}}/auth/profile
Authorization: Bearer {{passenger_token}}
```

**Expected Response:**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "Ahmed Ali Khan",
      "email": "ahmed.ali@email.com",
      "phone": "+92-300-1234567",
      "cnic": "42101-1234567-8",
      "address": "House 45, Block 6, PECHS, Karachi",
      "country": "Pakistan",
      "status": "active",
      "emergency_contact": "+92-301-9876543",
      "license_number": null,
      "vehicle_type": null,
      "preferred_payment": "mobile_wallet",
      "role": "passenger",
      "roles": ["passenger"],
      "created_at": "2025-01-15T10:30:00.000000Z",
      "updated_at": "2025-01-15T10:30:00.000000Z"
    }
  }
}
```

### **3.5 Logout**
```http
POST {{base_url}}/auth/logout
Authorization: Bearer {{passenger_token}}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

### **3.6 Logout from All Devices**
```http
POST {{base_url}}/auth/logout-all
Authorization: Bearer {{passenger_token}}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Logged out from all devices successfully"
}
```

### **3.7 Refresh Token**
```http
POST {{base_url}}/auth/refresh
Authorization: Bearer {{passenger_token}}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Token refreshed successfully",
  "data": {
    "token": "4|jkl012mno345...",
    "token_type": "Bearer"
  }
}
```

---

## 🔄 **4. PASSWORD RESET**

### **4.1 Forgot Password**
```http
POST {{base_url}}/auth/forgot-password
Content-Type: application/json
```

**Request Body:**
```json
{
  "email": "ahmed.ali@email.com"
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Password reset link sent to your email address"
}
```

### **4.2 Reset Password**
```http
POST {{base_url}}/auth/reset-password
Content-Type: application/json
```

**Request Body:**
```json
{
  "token": "reset_token_from_email",
  "email": "ahmed.ali@email.com",
  "password": "NewPassword123!",
  "password_confirmation": "NewPassword123!"
}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Password reset successfully"
}
```

---

## 📸 **5. TEST IMAGES FOR UPLOAD**

### **5.1 Sample Image URLs (Download these for testing):**

**CNIC Front Images:**
- https://via.placeholder.com/800x500/0066CC/FFFFFF?text=CNIC+Front+Sample
- https://via.placeholder.com/800x500/0066CC/FFFFFF?text=Ahmed+Ali+Khan+CNIC+Front

**CNIC Back Images:**
- https://via.placeholder.com/800x500/0099FF/FFFFFF?text=CNIC+Back+Sample
- https://via.placeholder.com/800x500/0099FF/FFFFFF?text=Ahmed+Ali+Khan+CNIC+Back

**Driving License Images:**
- https://via.placeholder.com/800x500/00CC66/FFFFFF?text=Driving+License+Sample
- https://via.placeholder.com/800x500/00CC66/FFFFFF?text=Muhammad+Hassan+License

**Profile Images:**
- https://via.placeholder.com/400x400/FF6600/FFFFFF?text=Profile+Photo
- https://via.placeholder.com/400x400/FF6600/FFFFFF?text=Ahmed+Ali+Khan
- https://via.placeholder.com/400x400/FF6600/FFFFFF?text=Muhammad+Hassan

**Vehicle Images:**
- **Front:** https://via.placeholder.com/800x600/CC0000/FFFFFF?text=Vehicle+Front+View
- **Back:** https://via.placeholder.com/800x600/CC0000/FFFFFF?text=Vehicle+Back+View
- **Left:** https://via.placeholder.com/800x600/CC0000/FFFFFF?text=Vehicle+Left+Side
- **Right:** https://via.placeholder.com/800x600/CC0000/FFFFFF?text=Vehicle+Right+Side

### **5.2 Create Test Images Locally:**

**For Windows (PowerShell):**
```powershell
# Create test images directory
mkdir test_images

# Download sample images (if you have curl)
curl -o test_images/cnic_front.jpg "https://via.placeholder.com/800x500/0066CC/FFFFFF?text=CNIC+Front"
curl -o test_images/cnic_back.jpg "https://via.placeholder.com/800x500/0099FF/FFFFFF?text=CNIC+Back"
curl -o test_images/license.jpg "https://via.placeholder.com/800x500/00CC66/FFFFFF?text=Driving+License"
curl -o test_images/profile.jpg "https://via.placeholder.com/400x400/FF6600/FFFFFF?text=Profile"
curl -o test_images/vehicle_front.jpg "https://via.placeholder.com/800x600/CC0000/FFFFFF?text=Vehicle+Front"
curl -o test_images/vehicle_back.jpg "https://via.placeholder.com/800x600/CC0000/FFFFFF?text=Vehicle+Back"
curl -o test_images/vehicle_left.jpg "https://via.placeholder.com/800x600/CC0000/FFFFFF?text=Vehicle+Left"
curl -o test_images/vehicle_right.jpg "https://via.placeholder.com/800x600/CC0000/FFFFFF?text=Vehicle+Right"
```

---

## 🧪 **6. TESTING SEQUENCE**

### **Step 1: Test Passenger Registration**
1. Use the passenger registration form data
2. Upload the required images (CNIC front/back, profile)
3. Verify the response shows `status: "active"`
4. Save the token for further testing

### **Step 2: Test Driver Registration**
1. Use the driver registration form data
2. Upload all required images (CNIC, license, profile, vehicle images)
3. Verify the response shows `status: "pending"`
4. Note that no token is returned (requires admin approval)

### **Step 3: Test Authentication**
1. Test email/password login with passenger credentials
2. Test OTP flow (send OTP → verify OTP)
3. Test profile retrieval
4. Test logout functionality

### **Step 4: Test Password Reset**
1. Test forgot password
2. Test password reset (if you have email configured)

---

## 📊 **7. ADDITIONAL TEST DATA**

### **7.1 More Passenger Test Data:**

**Passenger 2:**
```
name: Ayesha Fatima
email: ayesha.fatima@email.com
password: SecurePass456!
phone: +92-303-3456789
cnic: 42101-3456789-0
address: Apartment 7B, Clifton Block 2, Karachi
passenger_emergency_contact: +92-304-4567890
passenger_emergency_contact_name: Ali Ahmed
passenger_emergency_contact_relation: Brother
```

**Passenger 3:**
```
name: Usman Sheikh
email: usman.sheikh@email.com
password: StrongPass789!
phone: +92-305-4567890
cnic: 42101-4567890-1
address: House 23, DHA Phase 5, Karachi
passenger_emergency_contact: +92-306-5678901
passenger_emergency_contact_name: Saima Sheikh
passenger_emergency_contact_relation: Wife
```

### **7.2 More Driver Test Data:**

**Driver 2:**
```
name: Abdul Rehman
email: abdul.rehman@email.com
password: DriverPass456!
phone: +92-307-5678901
cnic: 42101-5678901-2
license_number: LIC-2023-002345
vehicle_type: bike
vehicle_make: Honda
vehicle_model: CD-70
vehicle_year: 2021
license_plate: KHI-2021-5678
```

**Driver 3:**
```
name: Sana Khan
email: sana.khan@email.com
password: DriverPass789!
phone: +92-308-6789012
cnic: 42101-6789012-3
license_number: LIC-2023-003456
vehicle_type: rickshaw
vehicle_make: Qingqi
vehicle_model: QS125T-2D
vehicle_year: 2022
license_plate: KHI-2022-9012
```

---

## ⚠️ **8. IMPORTANT NOTES**

### **8.1 File Upload Requirements:**
- **Image formats:** JPEG, PNG, JPG, GIF
- **Maximum file size:** 5MB per image
- **Required for passengers:** CNIC front & back images
- **Required for drivers:** CNIC front & back, license, profile, and all 4 vehicle images

### **8.2 Status Flow:**
- **Passengers:** Registered with `status: "active"` (can login immediately)
- **Drivers:** Registered with `status: "pending"` (requires admin approval)

### **8.3 Phone Number Format:**
- Use Pakistani format: `+92-XXX-XXXXXXX`
- Examples: `+92-300-1234567`, `+92-301-9876543`

### **8.4 CNIC Format:**
- Pakistani CNIC format: `XXXXX-XXXXXXX-X`
- Examples: `42101-1234567-8`, `42101-2345678-9`

### **8.5 License Plate Format:**
- Pakistani format: `KHI-YYYY-XXXX`
- Examples: `KHI-2020-1234`, `KHI-2021-5678`

---

## 🚀 **9. QUICK START GUIDE**

1. **Set up environment variables** in Postman
2. **Download test images** from the provided URLs
3. **Start with passenger registration** (easier, immediate activation)
4. **Test authentication flow** with the registered passenger
5. **Try driver registration** (requires admin approval)
6. **Test all authentication endpoints** in sequence

---

## 📞 **10. SUPPORT**

If you encounter any issues:
1. Check that all required fields are provided
2. Ensure image files are in correct format and size
3. Verify phone numbers and CNIC formats
4. Check server logs for detailed error messages

**Happy Testing! 🎉**
