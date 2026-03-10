<?php
require('model/assignment_db.php');
require('model/course_db.php');

$assignment_id = filter_input(INPUT_GET, 'assignment_id', FILTER_VALIDATE_INT);
$assignment = get_assignment($assignment_id);
$courses = get_courses();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Assignment</title>
</head>
<body>
<h1>Update Assignment</h1>

<form action="index.php" method="post">
    <input type="hidden" name="action" value="update_assignment">
    <input type="hidden" name="assignment_id" value="<?php echo $assignment['ID']; ?>">

    <label>Description:</label>
    <input type="text" name="description" value="<?php echo $assignment['Description']; ?>"><br>

    <label>Course:</label>
    <select name="course_id">
        <?php foreach ($courses as $course) : ?>
            <option value="<?php echo $course['courseID']; ?>"
                <?php if ($course['courseID'] == $assignment['courseID']) echo 'selected'; ?>>
                <?php echo $course['courseName']; ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Update Assignment">
</form>

</body>
</html>
