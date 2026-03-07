# 🚗 **COMPLETE REGISTRATION PAYLOADS - WITH IMAGES**

## ⚠️ **TECHNICAL LIMITATION:**
JSON cannot handle file uploads directly. However, I'll provide you with:

1. **JSON payloads** for testing (without images)
2. **Form-data payloads** for complete registration (with images)
3. **Both approaches** for maximum flexibility

---

## 📱 **1. PASSENGER REGISTRATION - JSON (WITHOUT IMAGES)**

### **Method:** POST
### **URL:** `http://127.0.0.1:9000/api/auth/register`
### **Body Type:** `raw` (JSON)

```json
{
  "name": "Ahmed Ali Khan",
  "email": "ahmed.ali@email.com",
  "password": "Password123!",
  "password_confirmation": "Password123!",
  "user_type": "passenger",
  "phone": "+92-300-1234567",
  "cnic": "42101-1234567-8",
  "address": "House 45, Block 6, PECHS, Karachi",
  "date_of_birth": "1990-05-15",
  "gender": "male",
  "emergency_contact_name": "Fatima Khan",
  "emergency_contact_relation": "sister",
  "languages": "urdu,english",
  "bio": "Professional working in IT sector, need reliable transportation for daily commute.",
  "passenger_preferred_payment": "mobile_wallet",
  "passenger_emergency_contact": "+92-301-9876543",
  "passenger_emergency_contact_name": "Fatima Khan",
  "passenger_emergency_contact_relation": "sister"
}
```

---

## 📱 **2. PASSENGER REGISTRATION - FORM-DATA (WITH IMAGES)**

### **Method:** POST
### **URL:** `http://127.0.0.1:9000/api/auth/register`
### **Body Type:** `form-data`

### **Text Fields (Add as KEY-VALUE pairs):**
```
Key: name                           Value: Ahmed Ali Khan
Key: email                          Value: ahmed.ali@email.com
Key: password                       Value: Password123!
Key: password_confirmation          Value: Password123!
Key: user_type                      Value: passenger
Key: phone                          Value: +92-300-1234567
Key: cnic                           Value: 42101-1234567-8
Key: address                        Value: House 45, Block 6, PECHS, Karachi
Key: date_of_birth                  Value: 1990-05-15
Key: gender                         Value: male
Key: emergency_contact_name         Value: Fatima Khan
Key: emergency_contact_relation     Value: sister
Key: languages                      Value: urdu,english
Key: bio                            Value: Professional working in IT sector, need reliable transportation for daily commute.
Key: passenger_preferred_payment     Value: mobile_wallet
Key: passenger_emergency_contact     Value: +92-301-9876543
Key: passenger_emergency_contact_name Value: Fatima Khan
Key: passenger_emergency_contact_relation Value: sister
```

### **Image Fields (Select File type):**
```
Key: passenger_cnic_front_image     Type: File    Value: [Select test_images/passengers/cnic_front_sample.jpg]
Key: passenger_cnic_back_image      Type: File    Value: [Select test_images/passengers/cnic_back_sample.jpg]
Key: passenger_profile_image        Type: File    Value: [Select test_images/passengers/profile_sample.jpg]
```

---

## 🚗 **3. DRIVER REGISTRATION - JSON (WITHOUT IMAGES)**

### **Method:** POST
### **URL:** `http://127.0.0.1:9000/api/auth/register`
### **Body Type:** `raw` (JSON)

```json
{
  "name": "Muhammad Hassan",
  "email": "m.hassan@email.com",
  "password": "DriverPass123!",
  "password_confirmation": "DriverPass123!",
  "user_type": "driver",
  "phone": "+92-302-2345678",
  "cnic": "42101-2345678-9",
  "address": "Flat 12, Building 5, Gulshan-e-Iqbal, Karachi",
  "date_of_birth": "1985-08-20",
  "gender": "male",
  "emergency_contact_name": "Hassan Ahmed",
  "emergency_contact_relation": "brother",
  "languages": "urdu,english,sindhi",
  "bio": "Professional driver with 5 years experience. Available 24/7 for reliable service.",
  "license_number": "LIC-2023-001234",
  "license_type": "LTV",
  "license_expiry_date": "2028-12-31",
  "driving_experience": "5 years",
  "bank_account_number": "1234567890123456",
  "bank_name": "Habib Bank Limited",
  "bank_branch": "Gulshan-e-Iqbal Branch",
  "vehicle_type": "car",
  "vehicle_make": "Toyota",
  "vehicle_model": "Corolla",
  "vehicle_year": "2020",
  "vehicle_color": "White",
  "license_plate": "KHI-2020-1234",
  "registration_number": "REG-2020-5678",
  "preferred_payment": "mobile_wallet"
}
```

---

## 🚗 **4. DRIVER REGISTRATION - FORM-DATA (WITH IMAGES)**

### **Method:** POST
### **URL:** `http://127.0.0.1:9000/api/auth/register`
### **Body Type:** `form-data`

### **Text Fields (Add as KEY-VALUE pairs):**
```
Key: name                           Value: Muhammad Hassan
Key: email                          Value: m.hassan@email.com
Key: password                       Value: DriverPass123!
Key: password_confirmation          Value: DriverPass123!
Key: user_type                      Value: driver
Key: phone                          Value: +92-302-2345678
Key: cnic                           Value: 42101-2345678-9
Key: address                        Value: Flat 12, Building 5, Gulshan-e-Iqbal, Karachi
Key: date_of_birth                  Value: 1985-08-20
Key: gender                         Value: male
Key: emergency_contact_name         Value: Hassan Ahmed
Key: emergency_contact_relation     Value: brother
Key: languages                      Value: urdu,english,sindhi
Key: bio                            Value: Professional driver with 5 years experience. Available 24/7 for reliable service.
Key: license_number                 Value: LIC-2023-001234
Key: license_type                   Value: LTV
Key: license_expiry_date             Value: 2028-12-31
Key: driving_experience             Value: 5 years
Key: bank_account_number            Value: 1234567890123456
Key: bank_name                      Value: Habib Bank Limited
Key: bank_branch                    Value: Gulshan-e-Iqbal Branch
Key: vehicle_type                   Value: car
Key: vehicle_make                   Value: Toyota
Key: vehicle_model                  Value: Corolla
Key: vehicle_year                   Value: 2020
Key: vehicle_color                  Value: White
Key: license_plate                  Value: KHI-2020-1234
Key: registration_number            Value: REG-2020-5678
Key: preferred_payment              Value: mobile_wallet
```

### **Image Fields (Select File type - ALL REQUIRED):**
```
Key: cnic_front_image               Type: File    Value: [Select test_images/drivers/cnic_front_sample.jpg]
Key: cnic_back_image                Type: File    Value: [Select test_images/drivers/cnic_back_sample.jpg]
Key: license_image                  Type: File    Value: [Select test_images/drivers/license_sample.jpg]
Key: profile_image                  Type: File    Value: [Select test_images/drivers/profile_sample.jpg]
Key: vehicle_front_image            Type: File    Value: [Select test_images/vehicles/front_sample.jpg]
Key: vehicle_back_image             Type: File    Value: [Select test_images/vehicles/back_sample.jpg]
Key: vehicle_left_image             Type: File    Value: [Select test_images/vehicles/left_sample.jpg]
Key: vehicle_right_image            Type: File    Value: [Select test_images/vehicles/right_sample.jpg]
```

---

## 📱 **5. ADDITIONAL PASSENGER PROFILES - FORM-DATA (WITH IMAGES)**

### **Passenger 2 - Ayesha Fatima:**

**Text Fields:**
```
Key: name                           Value: Ayesha Fatima
Key: email                          Value: ayesha.fatima@email.com
Key: password                       Value: SecurePass456!
Key: password_confirmation          Value: SecurePass456!
Key: user_type                      Value: passenger
Key: phone                          Value: +92-303-3456789
Key: cnic                           Value: 42101-3456789-0
Key: address                        Value: Apartment 7B, Clifton Block 2, Karachi
Key: date_of_birth                  Value: 1992-03-22
Key: gender                         Value: female
Key: emergency_contact_name         Value: Ali Ahmed
Key: emergency_contact_relation     Value: brother
Key: languages                      Value: urdu,english,punjabi
Key: bio                            Value: Marketing professional, frequently travels for work meetings.
Key: passenger_preferred_payment     Value: card
Key: passenger_emergency_contact     Value: +92-304-4567890
Key: passenger_emergency_contact_name Value: Ali Ahmed
Key: passenger_emergency_contact_relation Value: brother
```

**Image Fields:**
```
Key: passenger_cnic_front_image     Type: File    Value: [Select test_images/passengers/cnic_front_sample.jpg]
Key: passenger_cnic_back_image      Type: File    Value: [Select test_images/passengers/cnic_back_sample.jpg]
Key: passenger_profile_image        Type: File    Value: [Select test_images/passengers/profile_sample.jpg]
```

---

## 🚗 **6. ADDITIONAL DRIVER PROFILES - FORM-DATA (WITH IMAGES)**

### **Bike Driver - Abdul Rehman:**

**Text Fields:**
```
Key: name                           Value: Abdul Rehman
Key: email                          Value: abdul.rehman@email.com
Key: password                       Value: DriverPass456!
Key: password_confirmation          Value: DriverPass456!
Key: user_type                      Value: driver
Key: phone                          Value: +92-307-5678901
Key: cnic                           Value: 42101-5678901-2
Key: address                        Value: House 89, North Nazimabad, Karachi
Key: date_of_birth                  Value: 1988-11-10
Key: gender                         Value: male
Key: emergency_contact_name         Value: Rehman Ahmed
Key: emergency_contact_relation     Value: father
Key: languages                      Value: urdu,english
Key: bio                            Value: Experienced bike rider, specializes in quick city deliveries and short rides.
Key: license_number                 Value: LIC-2023-002345
Key: license_type                   Value: MC
Key: license_expiry_date             Value: 2027-06-15
Key: driving_experience             Value: 3 years
Key: bank_account_number            Value: 2345678901234567
Key: bank_name                      Value: United Bank Limited
Key: bank_branch                    Value: North Nazimabad Branch
Key: vehicle_type                   Value: bike
Key: vehicle_make                   Value: Honda
Key: vehicle_model                  Value: CD-70
Key: vehicle_year                   Value: 2021
Key: vehicle_color                  Value: Red
Key: license_plate                  Value: KHI-2021-5678
Key: registration_number            Value: REG-2021-9012
Key: preferred_payment              Value: cash
```

**Image Fields:**
```
Key: cnic_front_image               Type: File    Value: [Select test_images/drivers/cnic_front_sample.jpg]
Key: cnic_back_image                Type: File    Value: [Select test_images/drivers/cnic_back_sample.jpg]
Key: license_image                  Type: File    Value: [Select test_images/drivers/license_sample.jpg]
Key: profile_image                  Type: File    Value: [Select test_images/drivers/profile_sample.jpg]
Key: vehicle_front_image            Type: File    Value: [Select test_images/vehicles/front_sample.jpg]
Key: vehicle_back_image             Type: File    Value: [Select test_images/vehicles/back_sample.jpg]
Key: vehicle_left_image             Type: File    Value: [Select test_images/vehicles/left_sample.jpg]
Key: vehicle_right_image            Type: File    Value: [Select test_images/vehicles/right_sample.jpg]
```

---

## 🔐 **7. LOGIN PAYLOADS (JSON FORMAT)**

### **Email/Password Login:**

```json
{
  "email": "ahmed.ali@email.com",
  "password": "Password123!"
}
```

### **OTP Login - Send OTP:**

```json
{
  "phone": "+92-300-1234567"
}
```

### **OTP Login - Verify OTP:**

```json
{
  "phone": "+92-300-1234567",
  "otp_code": "123456"
}
```

---

## 📋 **8. POSTMAN SETUP INSTRUCTIONS**

### **For Registration with Images (Form-Data):**
1. **Open Postman**
2. **Create new request**
3. **Method:** POST
4. **URL:** `http://127.0.0.1:9000/api/auth/register`
5. **Body tab:** Select `form-data`
6. **Add all text fields** as KEY-VALUE pairs
7. **Add all image fields** as FILE type
8. **Select images** from `test_images/` directory
9. **Send request**

### **For Registration without Images (JSON):**
1. **Method:** POST
2. **URL:** `http://127.0.0.1:9000/api/auth/register`
3. **Body tab:** Select `raw`
4. **Content-Type:** Select `JSON`
5. **Copy the JSON payload**
6. **Send request**

### **For Login:**
1. **Method:** POST
2. **URL:** `http://127.0.0.1:9000/api/auth/login`
3. **Body tab:** Select `raw`
4. **Content-Type:** Select `JSON`
5. **Copy the JSON payload**
6. **Send request**

---

## ⚠️ **9. IMPORTANT NOTES**

### **Image Requirements:**
- **Passengers:** Images are optional (can use JSON or form-data)
- **Drivers:** Images are optional in current setup (can use JSON or form-data)
- **For production:** Driver images should be required

### **Body Types:**
- **JSON:** Use `raw` body type (no file uploads)
- **Form-data:** Use `form-data` body type (supports file uploads)

### **Status After Registration:**
- **Passengers:** `status: "active"` (can login immediately)
- **Drivers:** `status: "pending"` (need admin approval)

---

## 🎯 **10. TESTING WORKFLOW**

### **Option 1: Test with Images (Form-Data)**
1. Use form-data payloads above
2. Upload all required images
3. Should get successful registration

### **Option 2: Test without Images (JSON)**
1. Use JSON payloads above
2. No file uploads needed
3. Should get successful registration

### **Option 3: Test Login**
1. Use passenger credentials
2. Should get token for active users
3. Drivers will get error (pending status)

---

## ✅ **11. EXPECTED RESPONSES**

### **Successful Registration (Both JSON and Form-Data):**
```json
{
  "success": true,
  "message": "Registration successful! Your account is now active. You can login immediately.",
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

**Now you have both JSON and Form-Data payloads with images! 🚀**
