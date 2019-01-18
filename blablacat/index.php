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
  <div class="header">
    <div class="contain clearfix">

        <a href=""><img id = "logos" src='images/logo.png' width="150" height="50" /></a>
        <nav>
            <a href=""><div class="menu"><? echo $username ?></div></a>
            <a href=""><div class="menu">Настройки</div></a>
            <a href=""><div class="menu">Помощь</div></a>
            <a href="logout.php"><div class="menu">Выйти</div></a>
        </nav>
    </div>
  </div>
  
  <div class="body">
    <div class="main-body">
        <div class="upper-part-body">
            <div class="user-menu">
                <div id="avatar">
                <?
                    if($row_new["photo"]!="no" && file_exists("users/".$row_new["folder"]."/".$row_new["photo"]))
                    {
                        $img_path = 'users/'.$row_new["folder"].'/'.$row_new["photo"];
                        echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" />';
                    }else
                    {
                        echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                    }
                ?>
                
                </div>
                
                <nav>
                    <ul class="list-user-menu">
                        <a href=""><li class="list-user-menu-item">&ensp;&#9733;&ensp;Избранное</li></a>
                        <a href=""><li class="list-user-menu-item">&ensp;&#9993;&ensp;Мои отзывы</li></a>
                        <a href=""><li class="list-user-menu-item">&ensp;&#9743;&ensp;Заявки от ситтеров</li></a>
                    </ul>
                </nav>
                
            </div>
            <div class="user-info">
                <p class="name-user"><? echo $row_new["full_name"];?></p>
                <p class="address-user"><? echo $row_new["address"] ?></p>
                <p class="about-user-info">О себе:</p>
                <?
                    if($row_new["description"]==null)
                    {
                        echo '<p class="about-user">Ничего не указано</p>';
                    }else
                    {
                        echo '<p class="about-user">'.$row_new["description"].'</p>';
                    }
                ?>
            </div>
            <div class="clear"></div>
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
