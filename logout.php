
<?php                                                      
session_start();

unset($_SESSION['sid']);

header("Location: login.php");
die;
?>