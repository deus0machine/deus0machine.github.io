<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $check_user = mysqli_query($connct, "SELECT * FROM 'users' WHERE 'login' = $login AND 'password' = '$password'");
    if (mysqli_num_rows($check_user) == 1){
        $user = mysqli_fetch_assoc($check_user);
        $_SESSION['user'] = ["login" => $user['login']];
    }
    else{
        $_SESSION['message'] = 'Неверные данные';
        header('Location: ../blog.php');
    }
?>
