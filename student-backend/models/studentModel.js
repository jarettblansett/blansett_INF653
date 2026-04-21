const mongoose = require('mongoose');

const studentSchema = new mongoose.Schema({
  firstName: { type: String, required: true, trim: true },
  lastName:  { type: String, required: true, trim: true },
  email:     { type: String, required: true, unique: true, trim: true, lowercase: true },
  course:    { type: String, required: true, trim: true },
  enrolledDate: { type: Date, default: Date.now }
});

module.exports = mongoose.model('Student', studentSchema);
