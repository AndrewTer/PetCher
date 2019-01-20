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
                        $result_search = mysql_query("SELECT * FROM orders WHERE (orders.owner_id != $id)  AND (orders.date_out>=curdate())");
                        if (mysql_num_rows($result_search) == null)
                        {
                            echo '<hr /><p class="not-order">Заказов нет</p>';
                        }else
                        {
                            $row_search = mysql_fetch_array($result_search);
                            do{
                                echo '
                            <hr />
                            <div class="current-order">
                                    
                                    <div class="left-part-order-list">
                                        <div id="avatar-pet">';
                                            
                                                echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                                            
                                    echo '</div>
                                    </div>
                                    <div class="right-part-order-list">
                                        <p class="order-about">'.$row_search["about_order"].'</p>
                                        <p class="order-about">Даты: с '.$row_search["date_out"].' до '.$row_search["date_in"].'</p>
                                        <p class="order-about">Животное: </p>
                                        <p class="order-about">Кличка: </p>
                                        <p class="order-about">Порода: </p>
                                        <p class="order-about">Рост | Вес: </p>
                                        <p class="order-cost">Цена: '.$row_search["cost"].' руб</p>
                                    </div>
                                    <div class="clear"></div>
                            </div>
                            ';
                            }while ($row_search = mysql_fetch_array($result_search));
                        }
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
