<nav style="margin-bottom: 20px;">
    <a href="index.php">Vehicles</a> |
    <a href="add_vehicle.php">Add Vehicle</a> |
    <a href="makes.php">Makes</a> |
    <a href="types.php">Types</a> |
    <a href="classes.php">Classes</a>
</nav>

<?php
require_once('../model/database.php');
require_once('../model/types_db.php');

// Handle add
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if ($action === 'add_type') {
    $type_name = filter_input(INPUT_POST, 'type_name', FILTER_SANITIZE_STRING);

    if ($type_name) {
        global $db;
        $query = 'INSERT INTO types (type_name) VALUES (:type_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':type_name', $type_name);
        $statement->execute();
        $statement->closeCursor();
    }

    header("Location: types.php");
    exit();
}

// Handle delete
if ($action === 'delete_type') {
    $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);

    if ($type_id) {
        global $db;
        $query = 'DELETE FROM types WHERE type_id = :type_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':type_id', $type_id);
        $statement->execute();
        $statement->closeCursor();
    }

    header("Location: types.php");
    exit();
}

// Load all types
$types = get_types();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zippy Admin – Types</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 300px; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
        form { display: inline; }
    </style>
</head>
<body>

<h1>Manage Types</h1>

<h2>Add Type</h2>
<form action="types.php" method="post">
    <input type="hidden" name="action" value="add_type">
    <input type="text" name="type_name" placeholder="Type name" required>
    <button type="submit">Add</button>
</form>

<h2>Existing Types</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Delete</th>
    </tr>

    <?php foreach ($types as $type) : ?>
        <tr>
            <td><?= $type['type_name']; ?></td>
            <td>
                <form action="types.php" method="post">
                    <input type="hidden" name="action" value="delete_type">
                    <input type="hidden" name="type_id" value="<?= $type['type_id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
