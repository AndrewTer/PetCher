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

$sort = $_GET["sort"];
    switch($sort){
        case 'all-orders':
        $sort = " id DESC";
        $sort_name = 'Все';
        break;
        case 'performed':
        $sort = " confirmed = 'yes' DESC";
        $sort_name = 'Выполненные';
        break;
        case 'current':
        $sort = " confirmed = 'no' DESC";
        $sort_name = 'Текущие';
        break;
        default:
        $sort = " id DESC";
        $sort_name = 'Все';
        break;
    }
?>

<html>
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/click-carousel.js"></script> 
    <script type="text/javascript" src="js/script.js"></script> 
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
        
        $result_orders = mysql_query("SELECT orders.id AS order_id, orders.owner_id AS owner_id, pets.id AS pet_id, date_out, date_in, cost, pets.name AS pet_name, pets.kind as pet_kind, pets.breed AS pet_breed, pets.sex AS pet_sex, pets.weight AS pet_weight, pets.growth AS pet_growth, pets.photo AS avatar, orders.other_information AS about_order, pets.other_information AS about_pet FROM orders, pets WHERE (orders.owner_id = ".$id.") AND (orders.owner_id=pets.owner_id) AND (orders.pet_id=pets.id)");
        if (mysql_num_rows($result_orders) > 0)
        {
            $row_orders = mysql_fetch_array($result_orders);
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
            <div class="orders-part">
                <div id="block-title-and-sorting">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Мои заказы</p>
                    </div>
                    <div class="block-title-and-sorting-right">
                        <ul id="options-list">
                            <li>Сортировать</li>
                            <li><a id="select-links" href="#"><? echo $sort_name; ?></a>
                            <ul id="list-links-sort">
                                <a href="index.php?sort=all-orders"><li><strong>Все</strong></li></a>
                                <a href="index.php?sort=current"><li><strong>Текущие</strong></li></a>
                                <a href="index.php?sort=performed"><li><strong>Выполненные</strong></li></a>
                            </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                
                
                <?
                    if (mysql_num_rows($result_orders) == null)
                    {
                        echo '<hr /><p class="not-order">Вы пока не создали ни одного заказа</p>';
                    }else
                    {
                        do{
                            echo '
                            <hr />
                            <div class="current-order">
                                <div class="left-part-order-list">
                                    <div id="avatar-pet">';
                                        if($row_orders["avatar"]!="no" && file_exists("users/".$row_new["folder"]."/".$row_orders["avatar"]))
                                        {
                                            $img_path = 'users/'.$row_new["folder"].'/'.$row_orders["avatar"];
                                            echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" />';
                                        }else
                                        {
                                            echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                                        }
                                echo '</div>
                                </div>
                                <div class="right-part-order-list">
                                    <p class="order-about">'.$row_orders["about_order"].'</p>
                                    <p class="order-about">Даты: с '.$row_orders["date_out"].' до '.$row_orders["date_in"].'</p>
                                    <p class="order-about">Животное: '.$row_orders["pet_kind"].' ('.$row_orders["pet_sex"].')</p>
                                    <p class="order-about">Кличка: '.$row_orders["pet_name"].'</p>
                                    <p class="order-about">Порода: '.$row_orders["pet_breed"].'</p>
                                    <p class="order-about">Рост | Вес: '.$row_orders["pet_growth"].' м | '.$row_orders["pet_weight"].' кг</p>
                                    <p class="order-cost">Цена: '.$row_orders["cost"].' руб</p>
                                </div>
                                <div class="clear"></div>
                            </div>
                            
                            ';
                
                        }while ($row_orders = mysql_fetch_array($result_orders));
                    }
                ?>
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
