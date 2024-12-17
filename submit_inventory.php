<?php

include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sn_no = mysqli_real_escape_string($conn, $_POST['sn_no']);
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $item_desc = mysqli_real_escape_string($conn, $_POST['itemDesc']);
    $qty = intval($_POST['qty']);
    $category_id = intval($_POST['category_id']);


    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $img_name = $_FILES['img']['name'];
        $img_tmp_name = $_FILES['img']['tmp_name'];
        $img_path = 'uploads/' . basename($img_name);


        if (move_uploaded_file($img_tmp_name, $img_path)) {
            $img = $img_path;
        } else {
            echo "Failed to upload image.";
            exit;
        }
    } else {
        $img = null;
    }


    $sql = "INSERT INTO inventory (sn_no, item_name, item_desc, img, qty, category_id)
            VALUES ('$sn_no', '$item_name', '$item_desc', '$img', $qty, $category_id)";

    if (mysqli_query($conn, $sql)) {

        header("Location: /inventory-system/inventory.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
