<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $check_user = mysqli_query($connct, "SELECT * FROM `users` where login = '$login' and password ='$password';");
    if (mysqli_num_rows($check_user) > 0){
        $user = mysqli_fetch_assoc($check_user);
        $_SESSION['user'] = ["login" => $user['login']];
        header('Location: ../blog.php');
    }
    else{
        $_SESSION['message'] = 'Неверные данные';
        header('Location: ../blog.php');
    }
?>
