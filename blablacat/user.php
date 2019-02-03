<?php 
require_once("includes/connection.php"); 
include("functions.php");
session_start();
if($_SESSION['auth_user'] == "yes_auth")
{
    $username = $_SESSION['username'];
    $encrypted_password = $_SESSION['encrypted_password'];
    $id = $_SESSION['id']; 
    
    if (!empty($_GET["id"]))
    {
        $user_id=clear_string($_GET["id"]);
        if (!preg_match('/^\+?\d+$/', $user_id)) 
        {
            header("Location: index.php");
        }else
        {
            $result_selected_user = mysql_query("SELECT * FROM users WHERE id = ".$user_id." AND (deleted='no')");
            if (mysql_num_rows($result_selected_user) > 0)
            {
                $row_selected_user = mysql_fetch_array($result_selected_user);
            }else
            {
                header("Location: index.php"); 
            }
        }
    }else
    {
        header("Location: index.php"); 
        
    }
?>

<html>
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <link href="js/jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />  
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/click-carousel.js"></script> 
    <script type="text/javascript" src="js/script.js"></script> 
    <script type="text/javascript" src="js/jquery_confirm/jquery_confirm.js"></script>
    <script type="text/javascript">
    $(function(){
        $(".containerr").clickCarousel({margin: 10});
    });
    </script>
    <title><? echo $row_selected_user["full_name"] ?> | BlaBlaCat</title> 
</head>

<div class="grid-container">

  
  <?php 
    include("includes/header.php");
  ?>
  
  <div class="body">
    <div class="main-body">
    
        <div class="upper-part-body">
            <div class="user-menu">
                <div id="avatar">
                <?
                    if($row_selected_user["photo"]!="no" && $row_selected_user["photo"]!=null && file_exists("users/".$row_selected_user["folder"]."/".$row_selected_user["photo"]))
                    {
                        $img_path = 'users/'.$row_selected_user["folder"].'/'.$row_selected_user["photo"];
                        echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" height="100%"/>';
                    }else
                    {
                        echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                    }
                ?>
                
                </div>
                
                <hr />
                <p align="center" class="add-user-to-favorite"><a href="javascript:void(0)" onclick="this.parentNode.classList.toggle('opened');" id="add_user_to_favorite_link"></a></p>
            </div>
            <div class="user-info">
                <p class="name-user"><? echo $row_selected_user["full_name"];?></p>
                <p class="address-user"><? echo $row_selected_user["address"] ?></p>
                <hr />
                <p class="about-user-info">О себе</p>
                <?
                    if($row_selected_user["description"]==null)
                    {
                        echo '<p class="about-user">Ничего не указано</p>';
                    }else
                    {
                        echo '<p class="about-user">'.$row_selected_user["description"].'</p>';
                    }
                ?>
            </div>
            
            <div class="pets-list">
                <div class="pets-list-title">
                    <p class="title-section">Питомцы</p>
                    <div class="clear"></div>
                </div>
                
                
                
                <?
                    $result_selected_user_pets = mysql_query("SELECT * FROM pets WHERE owner_id = ".$user_id);
                    if (mysql_num_rows($result_selected_user_pets) > 0)
                    {
                        $row_selected_user_pets = mysql_fetch_array($result_selected_user_pets);
                ?>
                <div class="con">
                    <div class="containerr">
                    <?
                        do{
                        echo '<figure class="caption-border"><a href="">';
                        
                            if($row_selected_user_pets["photo"]!="no" && file_exists("users/".$row_selected_user["folder"]."/".$row_selected_user_pets["photo"]))
                            {
                                $img_path = 'users/'.$row_selected_user["folder"].'/'.$row_selected_user_pets["photo"];
                                echo '<img src="'.$img_path.'" />';
                            }else
                            {
                                echo '<img src="images/nophoto.jpg" />';
                            }
                            
                            echo '<figcaption>'.$row_selected_user_pets["name"].'</figcaption>
                        </a></figure>'; 
                        }while ($row_selected_user_pets = mysql_fetch_array($result_selected_user_pets));         
            echo '</div>
                    <img class="carouselLeft" src="images/left.png" width="5%" alt="Left Arrow" />
                    <img class="carouselRight" src="images/right.png" width="5%" alt="Right Arrow" />
                </div>';
                    }else
                    {
                        echo '<p class="not-pet-list-menu">Нет питомцев</p>';
                    }
                ?>
            </div>
            <div class="clear"></div>
        </div>
    
        <div class="main-part-body">
            <div class="orders-part">
                <div id="block-title-and-sorting">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Заказы</p>
                    </div>
                </div>
                <hr />
                <?
                    $result_selected_user_orders = mysql_query("SELECT * FROM orders WHERE (owner_id = ".$user_id.") AND (date_out>=curdate()) AND (deleted='no')");
                    
                ?>
                
            </div> 
            
            <div class="orders-part">
                <div id="block-title-and-sorting">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Отзывы</p>
                    </div>
                </div>
                <hr />
                
                
            </div> 
            
        </div>
    
    </div>
  </div>
  
<script>
$(document).ready(function() {
    $('body').append('<div class="button-up" style="display: none; margin-top:50px; opacity: 0.7;width: 100%;max-width:90px;height:100%;position: fixed;left: 0px;top: 0px;cursor: pointer;text-align: center;line-height: 100px;color: #45688E;">&#9650; Наверх</div>');
    $ (window).scroll (function () {
        if ($ (this).scrollTop () > 300) {
        $ ('.button-up').fadeIn();
        } else {
        $ ('.button-up').fadeOut();
        }
    });
    $('.button-up').click(function(){
        $('body,html').animate({
            scrollTop: 0
        }, 100);
        return false;
    });
    $('.button-up').hover(function() {
        $(this).animate({
            'opacity':'1',
        }).css({'background-color':'#E1E7ED','color':'#45688E'});
    }, function(){
        $(this).animate({
            'opacity':'0.7'
        }).css({'background':'none','color':'#45688E'});;
    });
});
</script>
  
<?php 
    include("includes/footer.php");
?> 
  
</div>
</html>
<?
}else
{
    header("Location: login.php"); 
}
?>
