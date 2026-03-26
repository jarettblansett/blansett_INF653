<?php
require_once('model/database.php');
require_once('model/vehicles_db.php');
require_once('model/makes_db.php');
require_once('model/types_db.php');
require_once('model/classes_db.php');

// Read the GET parameters
$sort = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_STRING);
$make_id = filter_input(INPUT_GET, 'make_id', FILTER_VALIDATE_INT);
$type_id = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT);
$class_id = filter_input(INPUT_GET, 'class_id', FILTER_VALIDATE_INT);

// Load dropdown data
$makes = get_makes();
$types = get_types();
$classes = get_classes();

// What gets displayed
if ($make_id) {
    $vehicles = get_vehicles_by_make($make_id);
} else if ($type_id) {
    $vehicles = get_vehicles_by_type($type_id);
} else if ($class_id) {
    $vehicles = get_vehicles_by_class($class_id);
} else if ($sort === 'year') {
    $vehicles = get_vehicles_sorted_by_year();
} else {
    $vehicles = get_vehicles_sorted_by_price(); // default
}

// Load the view
include('view/vehicle_list.php');
?>
