<?php 
require_once("includes/connection.php"); 
include("functions.php");
session_start();
if($_SESSION['auth_user'] == "yes_auth")
{
$username = $_SESSION['username'];
$encrypted_password = $_SESSION['encrypted_password'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$address = $_SESSION['address'];
$id = $_SESSION['id']; 
?>

<html>
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/click-carousel.js"></script> 
    <script type="text/javascript">
    $(function(){
        $(".containerr").clickCarousel({margin: 10});
    });
    </script>
    <title><? echo $username ?> | BlaBlaCat</title> 
</head>

<div class="grid-container">

    <?
        $result_new = mysql_query("SELECT * FROM users WHERE full_name = '".$username."' AND password = '".$encrypted_password."'"); // AND email = '".$email."'");
        if (mysql_num_rows($result_new) > 0)
        {
            $row_new = mysql_fetch_array($result_new);
        }
        
        
    ?>
  
  <?php 
    include("includes/header.php");
  ?>
  
  <div class="body">
    <div class="main-body">
    <?php 
        include("includes/upper_body.php");
    ?>
        
        <div class="main-part-body">
            <div class="favorites-part">
                Избранное
            </div>
        </div>
    </div>
  </div>
  
  <div class="footer">
    BlaBlaCat © 2019
  </div>
  
</div>
</html>
<?
}else
{
    header("Location: login.php"); 
}
?>
