# Event Ticketing API

REST API for managing events and bookings. Users can register, login, and book tickets. Admins can make, update, and delete events.

Created with Node.js, Express, MongoDB, and JWT authorization.

## Live URL
https://jarett-event-ticketing-api.onrender.com

## Getting Started

```bash
npm install
npm run dev
```

## .env Setup

```
PORT=5000
MONGO_URI=your_mongodb_uri
JWT_SECRET=your_secret
JWT_EXPIRES_IN=30d
```

## Endpoints

| Method | Route | Access |
|--------|-------|--------|
| POST | /api/auth/register | Public |
| POST | /api/auth/login | Public |
| GET | /api/events | Public |
| GET | /api/events/:id | Public |
| GET | /api/events?category= | Public |
| GET | /api/events?date= | Public |
| POST | /api/events | Admin |
| PUT | /api/events/:id | Admin |
| DELETE | /api/events/:id | Admin |
| GET | /api/bookings | Auth |
| GET | /api/bookings/:id | Auth |
| POST | /api/bookings | Auth |

## Notes
- Passwords hashed with bcryptjs
- JWT required for protected routes — `Authorization: Bearer <token>`
- Users can only access their own bookings
