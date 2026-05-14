const Booking = require('../models/Booking');
const Event = require('../models/Event');

// Create a booking (authenticated user only)
exports.bookTicket = async (req, res) => {
  try {
    const { eventId, quantity } = req.body;

    // Validate quantity
    if (!quantity || quantity < 1) {
      return res.status(400).json({ error: 'Quantity must be at least 1' });
    }

    const event = await Event.findById(eventId);
    if (!event) return res.status(404).json({ error: 'Event not found' });

    // Check available seats
    const availableSeats = event.seatCapacity - event.bookedSeats;
    if (quantity > availableSeats) {
      return res.status(400).json({
        error: `Not enough seats available. Only ${availableSeats} remaining.`
      });
    }

    // Increment bookedSeats on the event
    event.bookedSeats += quantity;
    await event.save();

    const booking = await Booking.create({
      user: req.user.id,
      event: eventId,
      quantity
    });

    res.status(201).json(booking);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
};

// Get all bookings for the logged-in user only
exports.getMyBookings = async (req, res) => {
  try {
    const bookings = await Booking.find({ user: req.user.id }).populate('event');
    res.json(bookings);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
};

// Get a single booking by ID - only if it belongs to the logged-in user
exports.getBookingById = async (req, res) => {
  try {
    const booking = await Booking.findById(req.params.id).populate('event');

    if (!booking) return res.status(404).json({ error: 'Booking not found' });

    // Ensure the booking belongs to the requesting user
    if (booking.user.toString() !== req.user.id.toString()) {
      return res.status(403).json({ error: 'Not authorized to view this booking' });
    }

    res.json(booking);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
};