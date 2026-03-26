<nav style="margin-bottom: 20px;">
    <a href="index.php">Vehicles</a> |
    <a href="add_vehicle.php">Add Vehicle</a> |
    <a href="makes.php">Makes</a> |
    <a href="types.php">Types</a> |
    <a href="classes.php">Classes</a>
</nav>

<?php
require_once('../model/database.php');
require_once('../model/classes_db.php');

// Handle add
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if ($action === 'add_class') {
    $class_name = filter_input(INPUT_POST, 'class_name', FILTER_SANITIZE_STRING);

    if ($class_name) {
        global $db;
        $query = 'INSERT INTO classes (class_name) VALUES (:class_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':class_name', $class_name);
        $statement->execute();
        $statement->closeCursor();
    }

    header("Location: classes.php");
    exit();
}

// Handle delete
if ($action === 'delete_class') {
    $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);

    if ($class_id) {
        global $db;
        $query = 'DELETE FROM classes WHERE class_id = :class_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':class_id', $class_id);
        $statement->execute();
        $statement->closeCursor();
    }

    header("Location: classes.php");
    exit();
}

// Load all classes
$classes = get_classes();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zippy Admin – Classes</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 300px; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
        form { display: inline; }
    </style>
</head>
<body>

<h1>Manage Classes</h1>

<h2>Add Class</h2>
<form action="classes.php" method="post">
    <input type="hidden" name="action" value="add_class">
    <input type="text" name="class_name" placeholder="Class name" required>
    <button type="submit">Add</button>
</form>

<h2>Existing Classes</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Delete</th>
    </tr>

    <?php foreach ($classes as $class) : ?>
        <tr>
            <td><?= $class['class_name']; ?></td>
            <td>
                <form action="classes.php" method="post">
                    <input type="hidden" name="action" value="delete_class">
                    <input type="hidden" name="class_id" value="<?= $class['class_id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
