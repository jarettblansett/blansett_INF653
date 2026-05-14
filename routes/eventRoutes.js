const express = require('express');
const router = express.Router();
const {
  createEvent,
  getEvents,
  getEventById,
  updateEvent,
  deleteEvent
} = require('../controllers/eventController');
const { protect, isAdmin } = require('../middleware/authMiddleware');

// Public routes
router.get('/', getEvents);
router.get('/:id', getEventById);

// Admin only routes
router.post('/', protect, isAdmin, createEvent);
router.put('/:id', protect, isAdmin, updateEvent);
router.delete('/:id', protect, isAdmin, deleteEvent);

module.exports = router;