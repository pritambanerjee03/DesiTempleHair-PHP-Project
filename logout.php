<?
ob_start();
session_start();
// print_r($_SESSION['regId']);
// exit;
session_unset($_SESSION['regId']);
unset($_COOKIE['regId']);
session_destroy();

header('location:index.php');

?>