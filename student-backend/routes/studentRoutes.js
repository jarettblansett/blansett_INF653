const express = require('express');
const router = express.Router();

const {
  getAllStudents,
  getStudentById,
  createStudent,
  updateStudent,
  deleteStudent
} = require('../controllers/studentController');

// Base route: /students

router.get('/', getAllStudents);          // GET all students
router.get('/:id', getStudentById);       // GET one student by ID
router.post('/', createStudent);          // CREATE a student
router.put('/:id', updateStudent);        // UPDATE a student
router.delete('/:id', deleteStudent);     // DELETE a student

module.exports = router;
