<?php 
// session_start();
// unset($_SESSION['user']);
// header('Location: ../blog.php');
setcookie('user', '', time() - 3600, '/');
header('Location: ../blog.php');
?>