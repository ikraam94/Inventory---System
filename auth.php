<?php
include('db_connection.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

   
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

       
        if ($password == $user['password']) {
            session_start();
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: /inventory-system");
        }
    } else {
        header("Location:/inventory-system");
    }
}


mysqli_close($conn);
?>