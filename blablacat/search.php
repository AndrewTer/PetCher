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
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
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
                        $result_search = mysql_query("SELECT orders.id AS current_order_id, orders.date_out AS date_out, orders.date_in AS date_in, orders.cost AS cost, orders.other_information AS about_order, pets.name AS pet_name, pets.kind AS pet_kind, pets.sex AS pet_sex, pets.breed AS pet_breed, pets.growth AS pet_growth, pets.weight AS pet_weight, pets.photo AS pet_photo, users.full_name AS full_name_user, users.id AS user_id, users.folder AS folder, users.city AS city FROM orders, pets, users WHERE (orders.pet_id = pets.id) AND (users.id = pets.owner_id) AND (orders.owner_id != $id)  AND (orders.date_out>=curdate()) AND (orders.deleted = 'no') GROUP BY orders.id");
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
                                        <div id="search-order-circle">';
                                            if($row_search["pet_photo"]!="no" && file_exists("users/".$row_search["folder"]."/".$row_search["pet_photo"]))
                                            {
                                                $img_path = 'users/'.$row_search["folder"].'/'.$row_search["pet_photo"];
                                                echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" />';
                                            }else
                                            {
                                                echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                                            }
                                    echo '</div>';
                                    $cur_order_search_id = $row_search["current_order_id"];
                    ?>
                    
                                    <script type="text/javascript">
                                            function goaddcurortoreq(identifier)
                                            {     
                                                var curr_order_search =$(identifier).data('ordersearchid'); 
                                                var cur_user = <?php echo $id ?>;

                                                var addtoreqFunc = new Function(addtorequestsearchorder(curr_order_search, cur_user));
                                                addtoreqFunc();                                      
                                            }                           
                                    </script>    
                                    <script type="text/javascript" src="js/ajax-scripts.js"></script>   
                    
                    <?        
                                    $search_sitter_req_list = mysql_query("SELECT * FROM request WHERE (order_id = ".$cur_order_search_id.") AND (sitter_id = ".$id.") AND (deleted='no')");
                                        if (mysql_num_rows($search_sitter_req_list) > 0)
                                        {
                                            echo '<p class="orders-search-links" ><a data-ordersearchid="'.$cur_order_search_id.'" onclick="event.preventDefault();goaddcurortoreq(this);" class="del-apply-current-order-search" id="apply_current_order_search" href="" ></a></p>';
                                        }else
                                        {
                                            echo '<p class="orders-search-links" ><a data-ordersearchid="'.$cur_order_search_id.'" onclick="event.preventDefault();goaddcurortoreq(this);" class="apply-current-order-search" id="apply_current_order_search" href="" ></a></p>';
                                        }
                            echo '</div>
                                    
                                    <div class="right-part-order-search-list">
                                        <p class="order-about-search">Заказчик: <a id="order-about-search-username" href="user.php?id='.$row_search["user_id"].'">'.$row_search["full_name_user"].'</a> <a id="order-about-search-username-page" href="user.php?id='.$row_search["user_id"].'">(Перейти на страницу)</a></p>
                                        <p class="order-about-search">'.$row_search["about_order"].'</p>';
                                        if ($row_search["city"]!=null)
                                        {
                                            echo '<p class="order-about-search">Город: '.$row_search["city"].'</p>';
                                        }else
                                        {
                                            echo '<p class="order-about-search">Город: не указан</p>';
                                        }
                                        echo '<p class="order-about-search">Даты: с '.$row_search["date_out"].' до '.$row_search["date_in"].'</p>
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
            
            <div class="part-parameters-and-to-search-orders">
                <div class="search-parameters">
                    <div id="block-title-and-sorting">
                        <div class="block-title-and-sorting-for-search">
                            <p class="title-section-main-body">Параметры поиска</p>
                        </div>
                    </div>
                    
                    <hr />
                    
                    <form enctype="multipart/form-data"  method="POST">
                        <p class="search-order-cost">Цена (в рублях)</p>
                        
                        <div class="block-for-search-cost-order">
                            <div class="block-for-search-cost">
                                <input type="number" id="search-order-cost" name="search_order_cost_min" min="100" max="1000000" placeholder="100 р" />
                            </div>
                            <p class="search-order-between">-</p>
                            <div class="block-for-search-cost">
                                <input type="number" id="search-order-cost" name="search_order_cost_max" min="100" max="1000000" placeholder="1000000 р" />
                            </div>
                        </div>
                        
                        <p class="search-order-dates">Даты</p>
                        
                        <?
                            $current_date_result = mysql_query("SELECT DATE(NOW()) AS now_date, DATE(DATE_ADD(NOW(), INTERVAL 1 YEAR)) AS next_year");
                            $row_current_date_result = mysql_fetch_array($current_date_result);
                        ?>
                        
                        <div class="block-for-search-date-order">
                            <p class="search-order-between-dates">с</p>
                            <div class="block-for-search-date">
                                <input type="date" id="search-order-date" name="search_order_date_start" min="<?echo $row_current_date_result["now_date"]; ?>" value="<?echo $row_current_date_result["now_date"]; ?>" />
                            </div>
                        </div>
                        
                        <div class="block-for-search-date-order">
                            <p class="search-order-between-dates">по</p>
                            <div class="block-for-search-date">
                                <input type="date" id="search-order-date" name="search_order_date_end" min="<?echo $row_current_date_result["now_date"]; ?>" value="<?echo $row_current_date_result["next_year"]; ?>" />
                            </div>
                        </div>
                        
                        <p class="search-order-city">Город</p>
                        <select id="search-order-city" name="search_order_city">
                                <option value="all">Все города</option>
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
                        
                        <div class="search-pet-param">
                            <p class="search-order-pet-kind">Животное</p>
                            <select id="search-order-kind-pet" name="search_order_kind_pet">
                                <option value="all">Любое</option>
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
                                <option value="other">Другое</option>
                            </select>
                            
                            <p class="search-order-pet-sex">Пол</p>
                            <select id="search-order-sex-pet" name="search_order_sex_pet">
                                <option value="all">Любой</option>
                                <option value="m">Мальчик</option>
                                <option value="w">Девочка</option>
                                <option value="no">Не указан</option>
                            </select>
                            
                            <p class="search-order-pet-growth">Рост (в метрах)</p>
                            
                            <div class="block-for-search-pet-growth-order">
                                <div class="block-for-search-growth">
                                    <input type="number" id="search-order-growth-pet" name="search_order_growth_pet_min" min="0" max="1" step="0.01" placeholder="0 м" />
                                </div>
                                <p class="search-order-between">-</p>
                                <div class="block-for-search-growth">
                                    <input type="number" id="search-order-growth-pet" name="search_order_growth_max" min="0" max="1" step="0.01" placeholder="1 м" />
                                </div>
                            </div>
                            
                            <p class="search-order-pet-weight">Вес (в килограммах)</p>
                            
                            <div class="block-for-search-pet-weight-order">
                                <div class="block-for-search-weight">
                                    <input type="number" id="search-order-weight-pet" name="search_order_weight_pet_min" min="0" max="20" step="0.1" placeholder="0 кг" />
                                </div>
                                <p class="search-order-between">-</p>
                                <div class="block-for-search-weight">
                                    <input type="number" id="search-order-weight-pet" name="search_order_weight_pet_max" min="0" max="20" step="0.1" placeholder="20 кг" />
                                </div>
                            </div>
                        </div>
                        <p class="orders-search-links-button" ><input type="submit" class="search-order-by-param" name="search_order_by_param" value="Поиск" /></p>     
                    </form>                     
                    
                 </div>   
                 
                <div class="go-to-search-users">
                    <a href="users_search.php?sort=all-users">
                        <div id="block-title-and-sorting" style="min-height: 40px; height: auto;">
                            <p class="title-section-main-body" style="font-size: 15px;">Перейти к поиску пользователей</p>
                        </div>
                    </a>
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
