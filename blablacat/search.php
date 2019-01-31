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
                        $result_search = mysql_query("SELECT orders.date_out AS date_out, orders.date_in AS date_in, orders.cost AS cost, orders.other_information AS about_order, pets.name AS pet_name, pets.kind AS pet_kind, pets.sex AS pet_sex, pets.breed AS pet_breed, pets.growth AS pet_growth, pets.weight AS pet_weight FROM orders, pets WHERE (orders.pet_id = pets.id) AND (orders.owner_id != $id)  AND (orders.date_out>=curdate()) AND (orders.deleted = 'no') GROUP BY orders.id");
                        if (mysql_num_rows($result_search) == null)
                        {
                            echo '<hr /><p class="not-order">Заказов нет</p>';
                        }else
                        {
                            $row_search = mysql_fetch_array($result_search);
                            do{
                                echo '
                            <hr />
                            <div class="current-order-search">
                                    <div class="left-part-order-search-list">
                                        <div id="avatar-pet">
                                            <img class="image-avatar" src="images/nophoto.jpg" width="100%" />
                                        </div>
                                    </div>
                                    <div class="right-part-order-search-list">
                                        <p class="order-about-search">'.$row_search["about_order"].'</p>
                                        <p class="order-about-search">Даты: с '.$row_search["date_out"].' до '.$row_search["date_in"].'</p>
                                        <p class="order-about-search">Животное: '.$row_search["pet_kind"].' ('.$row_search["pet_sex"].')</p>
                                        <p class="order-about-search">Кличка: '.$row_search["pet_name"].'</p>
                                        <p class="order-about-search">Порода: '.$row_search["pet_breed"].'</p>
                                        <p class="order-about-search">Рост | Вес: '.$row_search["pet_growth"].' м | '.$row_search["pet_weight"].' кг</p>
                                        <p class="order-cost-search">Цена: '.$row_search["cost"].' руб</p>
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
