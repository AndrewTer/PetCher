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
                        $result_search = mysql_query("SELECT orders.date_out AS date_out, orders.date_in AS date_in, orders.cost AS cost, orders.other_information AS about_order, pets.name AS pet_name, pets.kind AS pet_kind, pets.sex AS pet_sex, pets.breed AS pet_breed, pets.growth AS pet_growth, pets.weight AS pet_weight, pets.photo AS pet_photo, users.full_name AS full_name_user, users.id AS user_id, users.folder AS folder FROM orders, pets, users WHERE (orders.pet_id = pets.id) AND (users.id = pets.owner_id) AND (orders.owner_id != $id)  AND (orders.date_out>=curdate()) AND (orders.deleted = 'no') GROUP BY orders.id");
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
                                        <div id="avatar-pet">';
                                            if($row_search["pet_photo"]!="no" && file_exists("users/".$row_search["folder"]."/".$row_search["pet_photo"]))
                                            {
                                                $img_path = 'users/'.$row_search["folder"].'/'.$row_search["pet_photo"];
                                                echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" />';
                                            }else
                                            {
                                                echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                                            }
                                    echo '</div>
                                    </div>
                                    <div class="right-part-order-search-list">
                                        <p class="order-about-search">Заказчик: <a href="user.php?id='.$row_search["user_id"].'">'.$row_search["full_name_user"].'</a></p>
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
                
                <hr />
                <div class="search-pet-param">
                    <p class="search-order-pet-kind">Животное</p>
                    <select id="search-order-kind-pet" name="search_order_kind_pet">
                        <option value="cat">Кошка</option>
                        <option value="dog">Собака</option>
                        <option value="parrot">Попугай</option>
                        <option value="bird">Другая птица</option>
                        <option value="hamster">Хомяк</option>
                        <option value="cavy">Морская свинка</option>
                        <option value="rabbit">Кролик</option>
                        <option value="chinchilla">Шиншилла</option>
                        <option value="fish">Рыбки</option>
                        <option value="turtle">Черепаха</option>
                        <option value="other">Другой</option>
                    </select>
                    
                    <p class="search-order-pet-sex">Пол</p>
                    <select id="search-order-sex-pet" name="search_order_sex_pet">
                        <option value="no">Пусто</option>
                        <option value="m">Мальчик</option>
                        <option value="w">Девочка</option>
                    </select>
                    
                    <p class="search-order-pet-growth">Рост (в метрах)</p>
                    <input type="number" id="search-order-growth-pet" name="search_order_growth_pet" min="0" max="1" step="0.01" placeholder="от 0 до 1" />
                    
                    <p class="search-order-pet-weight">Вес (в килограммах)</p>
                    <input type="number" id="search-order-weight-pet" name="search_order_weight_pet" min="0" max="20" step="0.1" placeholder="от 0 до 20" />
                </div>
                
                
                <p class="search-order-cost">Цена (в рублях)</p>
                <input type="number" id="search-order-cost" name="search_order_cost" min="100" max="1000000" placeholder="100-1000000" />
                
                <p class="search-order-dates">Даты</p>
                
                <p class="search-order-city">Город</p>
                <select id="search-order-city" name="search_order_city">
                        <option value="moscow">Москва</option>
                        <option value="st_petersburg">Санкт-Петербург</option>
                        <option value="volgograd">Волгоград</option>
                        <option value="vladivostok">Владивосток</option>
                        <option value="voronezh">Воронеж</option>
                        <option value="yekaterinburg">Екатеринбург</option>
                        <option value="kazan">Казань</option>
                        <option value="kaliningrad">Калининград</option>
                        <option value="krasnodar">Краснодар</option>
                        <option value="krasnoyarsk">Красноярск</option>
                        <option value="nizhny_novgorod">Нижний Новгород</option>
                        <option value="novosibirsk">Новосибирск</option>
                        <option value="omsk">Омск</option>
                        <option value="permian">Пермь</option>
                        <option value="rostov_on_don">Ростов-на-Дону</option>
                        <option value="samara">Самара</option>
                        <option value="ufa">Уфа</option>
                        <option value="chelyabinsk">Челябинск</option>
                        <option value="sevastopol">Севастополь</option>
                        <option value="simferopol">Симферополь</option>
                        <option value="other">Другой город</option>
                </select>
                    
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
