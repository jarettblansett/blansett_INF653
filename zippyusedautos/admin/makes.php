<nav style="margin-bottom: 20px;">
    <a href="index.php">Vehicles</a> |
    <a href="add_vehicle.php">Add Vehicle</a> |
    <a href="makes.php">Makes</a> |
    <a href="types.php">Types</a> |
    <a href="classes.php">Classes</a>
</nav>

<?php
require_once('../model/database.php');
require_once('../model/makes_db.php');

// Handle add
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if ($action === 'add_make') {
    $make_name = filter_input(INPUT_POST, 'make_name', FILTER_SANITIZE_STRING);

    if ($make_name) {
        global $db;
        $query = 'INSERT INTO makes (make_name) VALUES (:make_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':make_name', $make_name);
        $statement->execute();
        $statement->closeCursor();
    }

    header("Location: makes.php");
    exit();
}

// Handle delete
if ($action === 'delete_make') {
    $make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);

    if ($make_id) {
        global $db;
        $query = 'DELETE FROM makes WHERE make_id = :make_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':make_id', $make_id);
        $statement->execute();
        $statement->closeCursor();
    }

    header("Location: makes.php");
    exit();
}

// Load all makes
$makes = get_makes();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zippy Admin – Makes</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 300px; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
        form { display: inline; }
    </style>
</head>
<body>

<h1>Manage Makes</h1>

<h2>Add Make</h2>
<form action="makes.php" method="post">
    <input type="hidden" name="action" value="add_make">
    <input type="text" name="make_name" placeholder="Make name" required>
    <button type="submit">Add</button>
</form>

<h2>Existing Makes</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Delete</th>
    </tr>

    <?php foreach ($makes as $make) : ?>
        <tr>
            <td><?= $make['make_name']; ?></td>
            <td>
                <form action="makes.php" method="post">
                    <input type="hidden" name="action" value="delete_make">
                    <input type="hidden" name="make_id" value="<?= $make['make_id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
