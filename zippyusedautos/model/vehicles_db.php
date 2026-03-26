<?php
function get_vehicles_sorted_by_price() {
    global $db;
    $query = 'SELECT * FROM vehicles
              JOIN makes USING (make_id)
              JOIN types USING (type_id)
              JOIN classes USING (class_id)
              ORDER BY price DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function get_vehicles_sorted_by_year() {
    global $db;
    $query = 'SELECT * FROM vehicles
              JOIN makes USING (make_id)
              JOIN types USING (type_id)
              JOIN classes USING (class_id)
              ORDER BY year DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function get_vehicles_by_make($make_id) {
    global $db;
    $query = 'SELECT * FROM vehicles
              JOIN makes USING (make_id)
              JOIN types USING (type_id)
              JOIN classes USING (class_id)
              WHERE vehicles.make_id = :make_id
              ORDER BY price DESC';
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();
    return $statement->fetchAll();
}

function get_vehicles_by_type($type_id) {
    global $db;
    $query = 'SELECT * FROM vehicles
              JOIN makes USING (make_id)
              JOIN types USING (type_id)
              JOIN classes USING (class_id)
              WHERE vehicles.type_id = :type_id
              ORDER BY price DESC';
    $statement = $db->prepare($query);
    $statement->bindValue(':type_id', $type_id);
    $statement->execute();
    return $statement->fetchAll();
}

function get_vehicles_by_class($class_id) {
    global $db;
    $query = 'SELECT * FROM vehicles
              JOIN makes USING (make_id)
              JOIN types USING (type_id)
              JOIN classes USING (class_id)
              WHERE vehicles.class_id = :class_id
              ORDER BY price DESC';
    $statement = $db->prepare($query);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    return $statement->fetchAll();
}
?>
