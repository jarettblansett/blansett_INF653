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

// Handle form submit
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if ($action === 'add_vehicle') {
    $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
    $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
    $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
    $make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);

    if ($year && $model && $price && $type_id && $class_id && $make_id) {
        global $db;
        $query = 'INSERT INTO vehicles (year, model, price, type_id, class_id, make_id)
                  VALUES (:year, :model, :price, :type_id, :class_id, :make_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':year', $year);
        $statement->bindValue(':model', $model);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':type_id', $type_id);
        $statement->bindValue(':class_id', $class_id);
        $statement->bindValue(':make_id', $make_id);
        $statement->execute();
        $statement->closeCursor();
    }

    header("Location: index.php");
    exit();
}

// Load dropdown data
$makes = get_makes();
$types = get_types();
$classes = get_classes();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { max-width: 400px; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 15px; }
    </style>
</head>
<body>

<h1>Add Vehicle</h1>

<form action="add_vehicle.php" method="post">
    <input type="hidden" name="action" value="add_vehicle">

    <label>Year:</label>
    <input type="number" name="year" required>

    <label>Model:</label>
    <input type="text" name="model" required>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" required>

    <label>Make:</label>
    <select name="make_id" required>
        <?php foreach ($makes as $make) : ?>
            <option value="<?= $make['make_id']; ?>"><?= $make['make_name']; ?></option>
        <?php endforeach; ?>
    </select>

    <label>Type:</label>
    <select name="type_id" required>
        <?php foreach ($types as $type) : ?>
            <option value="<?= $type['type_id']; ?>"><?= $type['type_name']; ?></option>
        <?php endforeach; ?>
    </select>

    <label>Class:</label>
    <select name="class_id" required>
        <?php foreach ($classes as $class) : ?>
            <option value="<?= $class['class_id']; ?>"><?= $class['class_name']; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Add Vehicle</button>
</form>

</body>
</html>