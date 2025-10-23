# 🔧 **POSTMAN SETUP FIX - CORRECT FORMAT**

## ❌ **PROBLEM IDENTIFIED:**
You're using "raw" body type, but the registration API needs "form-data" because it handles file uploads.

## ✅ **CORRECT POSTMAN SETUP:**

### **1. Change Body Type:**
- ❌ Don't use: `raw`
- ✅ Use: `form-data`

### **2. Set Content-Type Header:**
- ❌ Don't set: `Content-Type: application/json`
- ✅ Let Postman auto-set: `Content-Type: multipart/form-data`

### **3. Add Fields as Form Data:**

**In Postman Body tab:**
1. Select `form-data` (not raw)
2. Add each field as KEY-VALUE pairs:

```
Key: name                    Value: Ahmed Ali Khan
Key: email                   Value: ahmed.ali@email.com
Key: password                Value: Password123!
Key: password_confirmation   Value: Password123!
Key: user_type               Value: passenger
Key: phone                   Value: +92-300-1234567
Key: date_of_birth           Value: 1990-05-15
Key: gender                  Value: male
Key: cnic                    Value: 42101-1234567-8
Key: address                 Value: House 45, Block 6, PECHS, Karachi
Key: country                 Value: Pakistan
Key: passenger_preferred_payment    Value: mobile_wallet
Key: passenger_emergency_contact    Value: +92-301-9876543
Key: passenger_emergency_contact_name    Value: Fatima Khan
Key: passenger_emergency_contact_relation    Value: Sister
Key: languages               Value: ["urdu", "english"]
Key: bio                     Value: Professional working in IT sector, need reliable transportation for daily commute.
```

### **4. Add File Uploads:**
```
Key: passenger_cnic_front_image    Type: File    Value: [Select test_images/passengers/cnic_front_sample.jpg]
Key: passenger_cnic_back_image     Type: File    Value: [Select test_images/passengers/cnic_back_sample.jpg]
Key: passenger_profile_image       Type: File    Value: [Select test_images/passengers/profile_sample.jpg]
```

---

## 🚗 **DRIVER REGISTRATION SETUP:**

### **Form Data Fields:**
```
Key: name                    Value: Muhammad Hassan
Key: email                   Value: m.hassan@email.com
Key: password                Value: DriverPass123!
Key: password_confirmation   Value: DriverPass123!
Key: user_type               Value: driver
Key: phone                   Value: +92-302-2345678
Key: date_of_birth           Value: 1985-08-20
Key: gender                  Value: male
Key: cnic                    Value: 42101-2345678-9
Key: address                 Value: Flat 12, Building 5, Gulshan-e-Iqbal, Karachi
Key: country                 Value: Pakistan
Key: license_number          Value: LIC-2023-001234
Key: license_type            Value: LTV
Key: license_expiry_date     Value: 2028-12-31
Key: driving_experience      Value: 5 years
Key: bank_account_number     Value: 1234567890123456
Key: bank_name               Value: Habib Bank Limited
Key: bank_branch             Value: Gulshan-e-Iqbal Branch
Key: vehicle_type            Value: car
Key: vehicle_make            Value: Toyota
Key: vehicle_model           Value: Corolla
Key: vehicle_year            Value: 2020
Key: vehicle_color           Value: White
Key: license_plate           Value: KHI-2020-1234
Key: registration_number     Value: REG-2020-5678
Key: preferred_payment       Value: mobile_wallet
Key: languages                Value: ["urdu", "english", "sindhi"]
Key: bio                     Value: Professional driver with 5 years experience. Available 24/7 for reliable service.
```

### **Driver File Uploads:**
```
Key: cnic_front_image        Type: File    Value: [Select test_images/drivers/cnic_front_sample.jpg]
Key: cnic_back_image         Type: File    Value: [Select test_images/drivers/cnic_back_sample.jpg]
Key: license_image           Type: File    Value: [Select test_images/drivers/license_sample.jpg]
Key: profile_image           Type: File    Value: [Select test_images/drivers/profile_sample.jpg]
Key: vehicle_front_image     Type: File    Value: [Select test_images/vehicles/front_sample.jpg]
Key: vehicle_back_image      Type: File    Value: [Select test_images/vehicles/back_sample.jpg]
Key: vehicle_left_image      Type: File    Value: [Select test_images/vehicles/left_sample.jpg]
Key: vehicle_right_image     Type: File    Value: [Select test_images/vehicles/right_sample.jpg]
```

---

## 🔐 **LOGIN API (Use JSON):**

### **For Login API, use "raw" with JSON:**
1. Select `raw` body type
2. Select `JSON` from dropdown
3. Add this JSON:

```json
{
  "email": "ahmed.ali@email.com",
  "password": "Password123!"
}
```

---

## 📋 **STEP-BY-STEP POSTMAN SETUP:**

### **Step 1: Registration Request**
1. **Method:** POST
2. **URL:** `http://127.0.0.1:9000/api/auth/register`
3. **Body:** Select `form-data`
4. **Add all text fields** as KEY-VALUE pairs
5. **Add file fields** as FILE type
6. **Send request**

### **Step 2: Login Request**
1. **Method:** POST
2. **URL:** `http://127.0.0.1:9000/api/auth/login`
3. **Body:** Select `raw`
4. **Content-Type:** Select `JSON`
5. **Add JSON data**
6. **Send request**

---

## ⚠️ **COMMON MISTAKES TO AVOID:**

1. ❌ **Don't use "raw" for registration** (it has file uploads)
2. ❌ **Don't set Content-Type manually** for form-data (let Postman handle it)
3. ❌ **Don't use JSON format** for registration (use form-data)
4. ✅ **Use "form-data" for registration** (supports file uploads)
5. ✅ **Use "raw JSON" for login** (no file uploads needed)

---

## 🎯 **QUICK FIX:**

**Change your current setup:**
- ❌ Body Type: `raw` 
- ✅ Body Type: `form-data`

**Then add each field as:**
- Key: `name` → Value: `Ahmed Ali Khan`
- Key: `email` → Value: `ahmed.ali@email.com`
- etc...

**This will fix the validation errors! 🚀**
