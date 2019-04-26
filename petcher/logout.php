<?php 
session_start();
unset($_SESSION['session_user']);
session_destroy();
header("location:login");
?>
