<nav style="margin-bottom: 20px;">
    <a href="index.php">Vehicles</a> |
    <a href="add_vehicle.php">Add Vehicle</a> |
    <a href="makes.php">Makes</a> |
    <a href="types.php">Types</a> |
    <a href="classes.php">Classes</a>
</nav>

<?php
require_once('../model/database.php');
require_once('../model/vehicles_db.php');
require_once('../model/makes_db.php');
require_once('../model/types_db.php');
require_once('../model/classes_db.php');

// Load all vehicles (sorted by price by default)
$vehicles = get_vehicles_sorted_by_price();

// Handle delete action
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action === 'delete_vehicle') {
    $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);

    if ($vehicle_id) {
        global $db;
        $query = 'DELETE FROM vehicles WHERE vehicle_id = :vehicle_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':vehicle_id', $vehicle_id);
        $statement->execute();
        $statement->closeCursor();
    }

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zippy Admin</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
        form { display: inline; }
    </style>
</head>
<body>

<h1>Zippy Admin Vehicle List</h1>

<table>
    <tr>
        <th>Year</th>
        <th>Model</th>
        <th>Price</th>
        <th>Make</th>
        <th>Type</th>
        <th>Class</th>
        <th>Delete</th>
    </tr>

    <?php foreach ($vehicles as $v) : ?>
        <tr>
            <td><?= $v['year']; ?></td>
            <td><?= $v['model']; ?></td>
            <td>$<?= number_format($v['price']); ?></td>
            <td><?= $v['make_name']; ?></td>
            <td><?= $v['type_name']; ?></td>
            <td><?= $v['class_name']; ?></td>
            <td>
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="delete_vehicle">
                    <input type="hidden" name="vehicle_id" value="<?= $v['vehicle_id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
