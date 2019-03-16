<?php 
require_once("includes/connection.php"); 
include("functions.php");
session_start();
if($_SESSION['auth_user'] == "yes_auth")
{
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $encrypted_password = $_SESSION['encrypted_password'];
?>

<html>
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <title>Помощь | BlaBlaCat</title> 
</head>

<div class="grid-container">

  <?php 
    include("includes/header.php");
  ?>
  
  <div class="body">
    <div class="main-body">
        <div class="main-support">
            Раздел находится в разработке...
        </div>
        <div class="clear"></div>
    </div>
  </div>
  
  <div class="footer">
    PetCher © 2019
  </div>
  
</div>
</html>
<?
}else
{
    header("Location: login.php"); 
}
?>
