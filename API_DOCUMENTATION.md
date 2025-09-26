# Authentication API Documentation

This document describes the authentication API endpoints for the ReH application.

## Base URL
```
http://localhost:8000/api
```

## Authentication Methods

### 1. User Registration

**Endpoint:** `POST /api/auth/register`

Register a new user account. The account will be created with 'pending' status and requires admin approval before login.

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "user_type": "driver",
    "phone": "+1234567890",
    "cnic": "12345-1234567-1",
    "address": "123 Main St, City",
    "emergency_contact": "+1234567890",
    "license_number": "LIC123456",
    "vehicle_type": "Sedan",
    "preferred_payment": "Cash"
}
```

**Response (Success - 201):**
```json
{
    "success": true,
    "message": "Registration successful! Your account is pending admin approval. You will be able to login once approved.",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "user_type": "driver",
            "status": "pending",
            "created_at": "2025-01-19T10:30:00.000000Z"
        }
    }
}
```

**Response (Validation Error - 422):**
```json
{
    "success": false,
    "message": "Validation Error",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password field is required."]
    }
}
```

### 2. Forgot Password

**Endpoint:** `POST /api/auth/forgot-password`

Send a password reset link to the user's email address.

**Request Body:**
```json
{
    "email": "user@example.com"
}
```

**Response (Success - 200):**
```json
{
    "success": true,
    "message": "Password reset link sent to your email address"
}
```

**Response (User Not Found - 404):**
```json
{
    "success": false,
    "message": "No user found with this email address"
}
```

### 3. Reset Password

**Endpoint:** `POST /api/auth/reset-password`

Reset user password using the token from email.

**Request Body:**
```json
{
    "token": "reset-token-from-email",
    "email": "user@example.com",
    "password": "newpassword123",
    "password_confirmation": "newpassword123"
}
```

**Response (Success - 200):**
```json
{
    "success": true,
    "message": "Password reset successfully. You can now login with your new password."
}
```

**Response (Invalid Token - 400):**
```json
{
    "success": false,
    "message": "Failed to reset password. Invalid or expired token."
}
```

### 4. Email/Password Login

**Endpoint:** `POST /api/auth/login`

**Request Body:**
```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

**Response (Success):**
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "user@example.com",
            "phone": "+1234567890",
            "status": "active"
        },
        "token": "1|abcdef123456...",
        "token_type": "Bearer"
    }
}
```

**Response (Error):**
```json
{
    "success": false,
    "message": "Invalid credentials"
}
```

### 2. Phone OTP Login

#### Send OTP
**Endpoint:** `POST /api/auth/send-otp`

**Request Body:**
```json
{
    "phone": "+1234567890"
}
```

**Response (Success):**
```json
{
    "success": true,
    "message": "OTP sent successfully",
    "data": {
        "phone": "+1234567890",
        "otp_code": "123456",
        "expires_in": 60
    }
}
```

#### Verify OTP
**Endpoint:** `POST /api/auth/verify-otp`

**Request Body:**
```json
{
    "phone": "+1234567890",
    "otp_code": "123456"
}
```

**Response (Success):**
```json
{
    "success": true,
    "message": "OTP verified successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "user@example.com",
            "phone": "+1234567890",
            "status": "active"
        },
        "token": "1|abcdef123456...",
        "token_type": "Bearer"
    }
}
```

### 3. Protected Endpoints

All protected endpoints require the `Authorization` header:
```
Authorization: Bearer {token}
```

#### Get User Profile
**Endpoint:** `GET /api/auth/profile`

**Response:**
```json
{
    "success": true,
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "user@example.com",
            "phone": "+1234567890",
            "cnic": "12345-1234567-1",
            "address": "123 Main St",
            "country": "Pakistan",
            "status": "active",
            "emergency_contact": "+0987654321",
            "license_number": "LIC123456",
            "vehicle_type": "car",
            "preferred_payment": "cash",
            "created_at": "2025-09-19T01:00:00.000000Z",
            "updated_at": "2025-09-19T01:00:00.000000Z"
        }
    }
}
```

#### Logout
**Endpoint:** `POST /api/auth/logout`

**Response:**
```json
{
    "success": true,
    "message": "Logged out successfully"
}
```

#### Logout from All Devices
**Endpoint:** `POST /api/auth/logout-all`

**Response:**
```json
{
    "success": true,
    "message": "Logged out from all devices successfully"
}
```

#### Refresh Token
**Endpoint:** `POST /api/auth/refresh`

**Response:**
```json
{
    "success": true,
    "message": "Token refreshed successfully",
    "data": {
        "token": "2|newtoken123456...",
        "token_type": "Bearer"
    }
}
```

#### Test Authentication
**Endpoint:** `GET /api/user`

**Response:**
```json
{
    "success": true,
    "message": "Authentication successful",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "user@example.com",
            "phone": "+1234567890",
            "status": "active"
        }
    }
}
```

## Error Responses

### Validation Errors (422)
```json
{
    "success": false,
    "message": "Validation errors",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password field is required."]
    }
}
```

### Unauthorized (401)
```json
{
    "success": false,
    "message": "Invalid credentials"
}
```

### Not Found (404)
```json
{
    "success": false,
    "message": "No user found with this phone number"
}
```

### Server Error (500)
```json
{
    "success": false,
    "message": "Failed to send OTP. Please try again."
}
```

## OTP Features

- **Expiry Time:** 1 minute
- **Format:** 6-digit numeric code
- **Rate Limiting:** One OTP per phone number at a time
- **Auto-cleanup:** Expired OTPs are automatically deleted when new ones are generated

## Security Features

- **Sanctum Authentication:** Secure token-based authentication
- **Token Expiry:** Configurable token expiration
- **Rate Limiting:** Built-in rate limiting for API endpoints
- **Input Validation:** Comprehensive request validation
- **Error Handling:** Detailed error responses for debugging

## Testing

### Using cURL

1. **Email/Password Login:**
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password123"}'
```

2. **Send OTP:**
```bash
curl -X POST http://localhost:8000/api/auth/send-otp \
  -H "Content-Type: application/json" \
  -d '{"phone":"+1234567890"}'
```

3. **Verify OTP:**
```bash
curl -X POST http://localhost:8000/api/auth/verify-otp \
  -H "Content-Type: application/json" \
  -d '{"phone":"+1234567890","otp_code":"123456"}'
```

4. **Access Protected Route:**
```bash
curl -X GET http://localhost:8000/api/auth/profile \
  -H "Authorization: Bearer {your-token}"
```
