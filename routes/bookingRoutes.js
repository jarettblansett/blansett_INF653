const express = require('express');
const router = express.Router();
const {
  bookTicket,
  getMyBookings,
  getBookingById
} = require('../controllers/bookingController');
const { protect } = require('../middleware/authMiddleware');

// All booking routes require authentication
router.post('/', protect, bookTicket);
router.get('/', protect, getMyBookings);
router.get('/:id', protect, getBookingById);

module.exports = router;