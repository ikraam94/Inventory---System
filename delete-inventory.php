<?php
include('db_connection.php');

$id = $_GET['id'];

$query = "DELETE FROM inventory WHERE id = $id";


if (mysqli_query($conn, $query)) {

    header("Location: /inventory-system/inventory.php?update=deleted");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
