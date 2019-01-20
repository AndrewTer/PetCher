<?php 
require_once("includes/connection.php"); 
include("functions.php");
session_start();
if($_SESSION['auth_user'] == "yes_auth")
{
$id = $_SESSION['id'];
$username = $_SESSION['username'];
?>

<html>
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <title>Поиск заказов | BlaBlaCat</title> 
</head>

<div class="grid-container">

  <?php 
    include("includes/header.php");
  ?>
  
  <div class="body">
    <div class="main-body">
        <div class="upper-part-body">
            <div class="main-search">
                <div id="block-title-and-sorting">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Поиск заказов</p>
                    </div>
                </div>
                <div class="search-list">
                    <?
                        $result_search = mysql_query("SELECT * FROM ");
                    
                    ?>
                </div>
            </div>
            <div class="search-parameters">
                <div id="block-title-and-sorting">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Параметры</p>
                    </div>
                </div>
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