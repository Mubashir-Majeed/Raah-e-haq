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

## Rate Limiting

- Auth endpoints: `throttle:20,1` (20 requests per minute per IP)
- Public content endpoints: `throttle:60,1` (60 requests per minute per IP)
- Public contact submission: `throttle:10,1` (10 requests per minute per IP)
- Authenticated APIs: `throttle:120,1` (120 requests per minute per user token)

If limits are exceeded, API returns HTTP 429 with a Retry-After header.

---

## Table of Contents
- Authentication (above)
- Users
- Rides
- Payments
- Settings
- Security
- Analytics
- Driver Tracking
- Referrals
- Support
- Profile
- Public

> Base URL: `{{APP_URL}}/api`
> Auth: Unless marked Public, include header `Authorization: Bearer {token}`.

## Users

- List users: `GET /users`
  - Query: `role`, `status`, `search`, `page`
  - 200: `{ success, data: Paginated<UserResource> }`
- Show user: `GET /users/{id}`
  - 200: `{ success, data: UserResource }`
- Create user: `POST /users` (multipart/form-data)
  - Body: name, email, password+confirmation, status, roles[], optional personal/driver/passenger fields, images (cnic_front_image, cnic_back_image, license_image, profile_image, vehicle_* and passenger_* images)
  - 201: `{ success, message, data: UserResource }`
- Update user: `PUT /users/{id}` (multipart/form-data)
  - Body: any editable fields from Create; roles[] optional
  - 200: `{ success, message, data: UserResource }`
- Delete user: `DELETE /users/{id}`
  - 200: `{ success, message }`

## Rides

- List rides: `GET /rides`
  - 200: `{ success, data: Paginated<RideResource> }`
- Show ride: `GET /rides/{id}`
  - 200: `{ success, data: RideResource }`
- Create ride: `POST /rides`
  - Body: passenger_id, pickup_address, dropoff_address, pickup_latitude, pickup_longitude, dropoff_latitude, dropoff_longitude, vehicle_type?
  - 201: `{ success, message, data: RideResource }`
- Update ride: `PUT /rides/{id}`
  - Body: status[in:requested,accepted,ongoing,completed,cancelled], driver_id?, fare?, distance_km?, duration_min?
  - 200: `{ success, message, data: RideResource }`
- Delete ride: `DELETE /rides/{id}`
  - 200: `{ success, message }`
- Assign driver: `POST /rides/{id}/assign-driver`
  - Body: driver_id
  - 200: `{ success, message, data: RideResource }`
- Cancel ride: `POST /rides/{id}/cancel`
  - 200: `{ success, message, data: RideResource }`

## Payments

- List transactions: `GET /payments/transactions`
- Show transaction: `GET /payments/transactions/{transaction}`
- Adjust wallet: `POST /payments/wallets/{wallet}/adjust`
  - Body: amount, reason?
- Wallet transactions: `GET /payments/wallets/{wallet}/transactions`
- Financial report: `GET /payments/reports/financial`

All return `{ success, data }` (or `{ success, message }`) according to action.

## Settings

- Get settings: `GET /settings`
- Update settings: `POST /settings`
- List banners: `GET /settings/banners`
- Create banner: `POST /settings/banners` (multipart/form-data if image)
- Toggle banner: `POST /settings/banners/{banner}/toggle`
- Delete banner: `DELETE /settings/banners/{banner}`
- Public app settings: `GET /settings/public` (Public)

## Security

- Audit logs: `GET /security/audit-logs`
- Login attempts: `GET /security/login-attempts`
- Security events: `GET /security/security-events`
- Resolve event: `POST /security/security-events/{securityEvent}/resolve`

## Analytics

- Dashboard: `GET /analytics/dashboard`
- Events (list): `GET /analytics/events`
- Track event: `POST /analytics/track`
  - Body: type, metadata{}
- Export: `GET /analytics/export`

## Driver Tracking

- Update location: `POST /tracking/update-location`
  - Body: latitude, longitude, status?[online|available|busy|offline], address?, speed?, heading?, accuracy?
- Latest location: `GET /tracking/driver/{driverId}/latest`
- Drivers in radius: `GET /tracking/drivers-in-radius?latitude=&longitude=&radius_km=`
- Ride path: `GET /tracking/ride/{ride}/path`

## Referrals

- My referrals: `GET /referrals`
- Show referral: `GET /referrals/{referral}`
- Create referral: `POST /referrals`
  - Body: referred_id, level?, metadata?{}
- Complete referral: `POST /referrals/{referral}/complete`
- My referral code: `GET /referrals/code/mine`
- Referral tree: `GET /referrals/tree?max_level=3`
- Referral stats: `GET /referrals/stats`
- My rewards: `GET /referrals/rewards`
- Claim reward: `POST /referrals/rewards/{reward}/claim`
- Get referral settings: `GET /referrals/settings`
- Update referral settings: `POST /referrals/settings`

## Support

- List tickets: `GET /support/tickets` (Admins see all; filters: status, priority, category)
- Show ticket: `GET /support/tickets/{ticket}` (Owner or Admin)
- Create ticket: `POST /support/tickets` (subject, description, category?, priority?, attachments[]?)
- Reply: `POST /support/tickets/{ticket}/reply` (message, attachments[]?, is_internal? [Admin only])
- Assign: `POST /support/tickets/{ticket}/assign` (Admin only; admin_id)
- Change status: `POST /support/tickets/{ticket}/status` (Admin only; status in [open,in_progress,pending_customer,resolved,closed])
- Categories: `GET /support/categories`
- Create category: `POST /support/categories` (Admin)
- Update category: `PUT /support/categories/{category}` (Admin)
- Delete category: `DELETE /support/categories/{category}` (Admin)

## Profile

- Get profile: `GET /profile`
- Update profile: `PUT /profile` (name, email, phone, address, country, date_of_birth, gender, preferred_payment, bio, languages[])
- Change password: `POST /profile/change-password` (current_password, password, password_confirmation)
- Update avatar: `POST /profile/avatar` (multipart/form-data: avatar image)

## Public

- Landing stats: `GET /public/landing-stats` (Public)
- Banners: `GET /public/banners` (Public)
- Contact: `POST /public/contact` (Public; name, email, subject, message)

## Conventions

- Content-Type: JSON unless uploading files (`multipart/form-data`).
- Pagination: Laravel pagination fields included; `data` is a resource collection.
- Dates: ISO 8601 (UTC).
- Currency: PKR by default.

## Error Format

```
{
  "success": false,
  "message": "<error summary>",
  "errors": { "field": ["message"] } // present on 422
}
```