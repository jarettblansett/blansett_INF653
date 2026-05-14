const Event = require('../models/Event');
const Booking = require('../models/Booking');

// Create event (admin only)
exports.createEvent = async (req, res) => {
  try {
    const event = await Event.create(req.body);
    res.status(201).json(event);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
};

// Get all events with optional category and date filters
exports.getEvents = async (req, res) => {
  try {
    const filter = {};

    // Filter by category if provided
    if (req.query.category) {
      filter.category = req.query.category;
    }

    // Filter by date if provided (matches entire day)
    if (req.query.date) {
      const start = new Date(req.query.date);
      const end = new Date(req.query.date);
      end.setDate(end.getDate() + 1);
      filter.date = { $gte: start, $lt: end };
    }

    const events = await Event.find(filter);
    res.json(events);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
};

// Get single event by ID
exports.getEventById = async (req, res) => {
  try {
    const event = await Event.findById(req.params.id);
    if (!event) return res.status(404).json({ error: 'Event not found' });
    res.json(event);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
};

// Update event (admin only)
exports.updateEvent = async (req, res) => {
  try {
    const event = await Event.findById(req.params.id);
    if (!event) return res.status(404).json({ error: 'Event not found' });

    // Prevent seatCapacity from being set below bookedSeats
    if (
      req.body.seatCapacity !== undefined &&
      req.body.seatCapacity < event.bookedSeats
    ) {
      return res.status(400).json({
        error: `seatCapacity cannot be less than bookedSeats (${event.bookedSeats})`
      });
    }

    // Prevent _id from being changed
    delete req.body._id;

    const updated = await Event.findByIdAndUpdate(req.params.id, req.body, {
      new: true,
      runValidators: true
    });

    res.json(updated);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
};

// Delete event (admin only) - also deletes associated bookings
exports.deleteEvent = async (req, res) => {
  try {
    const event = await Event.findById(req.params.id);
    if (!event) return res.status(404).json({ error: 'Event not found' });

    // Delete all bookings associated with this event
    await Booking.deleteMany({ event: req.params.id });

    await event.deleteOne();
    res.json({ message: 'Event and associated bookings deleted' });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
};