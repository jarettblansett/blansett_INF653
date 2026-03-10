<?php
require_once('model/course_db.php');

$course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);

$course = get_course($course_id);

if (!$course) {
    $error = "Course not found.";
    include('view/error.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
</head>
<body>

<h1>Update Course</h1>

<form action="index.php" method="post">
    <input type="hidden" name="action" value="update_course">
    <input type="hidden" name="course_id" value="<?php echo $course['courseID']; ?>">

    <label>Course Name:</label>
    <input type="text" name="course_name" value="<?php echo $course['courseName']; ?>" required>

    <br><br>

    <input type="submit" value="Update Course">
</form>

</body>
</html>
