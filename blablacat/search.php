<?php 
require_once("includes/connection.php"); 
include("functions.php");
session_start();
if($_SESSION['auth_user'] == "yes_auth")
{
$id = $_SESSION['id'];
$username = $_SESSION['username'];
$encrypted_password = $_SESSION['encrypted_password'];

$current_date_result = mysql_query("SELECT DATE(NOW()) AS now_date, DATE(DATE_ADD(NOW(), INTERVAL 1 YEAR)) AS next_year");
$row_current_date_result = mysql_fetch_array($current_date_result);
$param_order_date_start = $row_current_date_result["now_date"];
$param_order_date_end = $row_current_date_result["next_year"];
                
        if ($_POST["search_order_by_param"])
        {
            $param_order_cost_min = $_POST["search_order_cost_min"];
            $param_order_cost_max = $_POST["search_order_cost_max"];
            
            if (($param_order_cost_min>$param_order_cost_max) || ($param_order_cost_min == null) || ($param_order_cost_max == null) || ($param_order_cost_min == '') || ($param_order_cost_max == '') || ($param_order_cost_min <= 0) || ($param_order_cost_max <= 0))
            {
                $param_order_cost_min = 100;
                $param_order_cost_max = 1000000;
                $param_order_cost_search = " AND (orders.cost>=$param_order_cost_min) AND (orders.cost<=$param_order_cost_max)";
            }else
            {
                $param_order_cost_search = " AND (orders.cost>=$param_order_cost_min) AND (orders.cost<=$param_order_cost_max)";
            }
            
            $param_order_date_start = $_POST["search_order_date_start"];
            $param_order_date_end = $_POST["search_order_date_end"];
            
            if (($param_order_date_start>$param_order_date_end) || ($param_order_date_start == null) || ($param_order_date_end == null) || ($param_order_date_start == '') || ($param_order_date_end = ''))
            {
                $param_order_date_start = $row_current_date_result["now_date"];
                $param_order_date_end = $row_current_date_result["next_year"];
                $param_order_date_search = " AND (orders.date_out>='$param_order_date_start') AND (orders.date_in<='$param_order_date_end')";
            }else
            {
                $param_order_date_start = $_POST["search_order_date_start"];
                $param_order_date_end = $_POST["search_order_date_end"];
                $param_order_date_search = " AND (orders.date_out>='$param_order_date_start') AND (orders.date_in<='$param_order_date_end')";
            }
            
            $param_order_pet_growth_min = $_POST["search_order_growth_pet_min"];
            $param_order_pet_growth_max = $_POST["search_order_growth_pet_max"];
            
            if (($param_order_pet_growth_min>$param_order_pet_growth_max) || ($param_order_pet_growth_max == null) || ($param_order_pet_growth_min == '') || ($param_order_pet_growth_max == '') || ($param_order_pet_growth_min < 0) || ($param_order_pet_growth_max < 0))
            {
                $param_order_pet_growth_min = 0;
                $param_order_pet_growth_max = 1;
                $param_order_pet_growth_search = " AND (pets.growth>=$param_order_pet_growth_min) AND (pets.growth<=$param_order_pet_growth_max)";
            }else
            {
                $param_order_pet_growth_search = " AND (pets.growth>=$param_order_pet_growth_min) AND (pets.growth<=$param_order_pet_growth_max)";
            }
            
            $param_order_pet_weight_min = $_POST["search_order_weight_pet_min"];
            $param_order_pet_weight_max = $_POST["search_order_weight_pet_max"];
            
            if (($param_order_pet_weight_min>$param_order_pet_weight_max) || ($param_order_pet_weight_max == null) || ($param_order_pet_weight_max == '') || ($param_order_pet_weight_min < 0) || ($param_order_pet_weight_max < 0))
            {
                $param_order_pet_weight_min = 0;
                $param_order_pet_weight_max = 20;
                $param_order_pet_growth_search = " AND (pets.weight>=$param_order_pet_weight_min) AND (pets.weight<=$param_order_pet_weight_max)";
            }else if(($param_order_pet_weight_min == null) || ($param_order_pet_weight_min == ''))
            {
                $param_order_pet_weight_min = 0;
                $param_order_pet_growth_search = " AND (pets.weight>=$param_order_pet_weight_min) AND (pets.weight<=$param_order_pet_weight_max)";
            }else
            {
                $param_order_pet_growth_search = " AND (pets.weight>=$param_order_pet_weight_min) AND (pets.weight<=$param_order_pet_weight_max)";
            }
            
            
            $param_city = $_POST["search_order_city"];
            switch ($param_city) {
                case 'all':
                    $param_city_search = " ";
                break;
                case 'moscow':
                    $param_city_search = " AND (users.city = 'Москва')";
                break;
                case 'st_petersburg':
                    $param_city_search = " AND (users.city = 'Санкт-Петербург')";
                break;
                case 'volgograd':
                    $param_city_search = " AND (users.city = 'Волгоград')";
                break;
                case 'vladivostok':
                    $param_city_search = " AND (users.city = 'Владивосток')";
                break;
                case 'voronezh':
                    $param_city_search = " AND (users.city = 'Воронеж')";
                break;
                case 'yekaterinburg':
                    $param_city_search = " AND (users.city = 'Екатеринбург')";
                break;
                case 'kazan':
                    $param_city_search = " AND (users.city = 'Казань')";
                break;
                case 'kaliningrad':
                    $param_city_search = " AND (users.city = 'Калининград')";
                break;
                case 'krasnodar':
                    $param_city_search = " AND (users.city = 'Краснодар')";
                break;
                case 'krasnoyarsk':
                    $param_city_search = " AND (users.city = 'Красноярск')";
                break;
                case 'nizhny_novgorod':
                    $param_city_search = " AND (users.city = 'Нижний Новгород')";
                break;
                case 'novosibirsk':
                    $param_city_search = " AND (users.city = 'Новосибирск')";
                break;
                case 'omsk':
                    $param_city_search = " AND (users.city = 'Омск')";
                break;
                case 'permian':
                    $param_city_search = " AND (users.city = 'Пермь')";
                break;
                case 'rostov_on_don':
                    $param_city_search = " AND (users.city = 'Ростов-на-Дону')";
                break;
                case 'samara':
                    $param_city_search = " AND (users.city = 'Самара')";
                break;
                case 'ufa':
                    $param_city_search = " AND (users.city = 'Уфа')";
                break;
                case 'chelyabinsk':
                    $param_city_search = " AND (users.city = 'Челябинск')";
                break;
                case 'sevastopol':
                    $param_city_search = " AND (users.city = 'Севастополь')";
                break;
                case 'simferopol':
                    $param_city_search = " AND (users.city = 'Симферополь')";
                break;
                case 'other':
                    $param_city_search = " AND ((users.city = null) OR (users.city = ''))";
                break;
                default;
                    $param_city_search = " ";
                break;
            }
            
            $param_pet_sex = $_POST["search_order_sex_pet"];
            switch ($param_pet_sex) {
                case 'all':
                    $param_pet_sex_search = " ";
                break;
                case 'm':
                    $param_pet_sex_search = " AND (pets.sex = 'мальчик')";
                break;
                case 'w':
                    $param_pet_sex_search = " AND (pets.sex = 'девочка')";
                break;
                case 'no':
                    $param_pet_sex_search = " AND (pets.sex = 'не указано')";
                break;
                default;
                    $param_pet_sex_search = " ";
                break;
            }
            
            $param_pet_kind = $_POST["search_order_kind_pet"];
            switch ($param_pet_kind) {
                case 'all':
                    $param_pet_kind_search = " ";
                break;
                case 'cat':
                    $param_pet_kind_search = " AND (pets.kind = 'кошка')";
                break;
                case 'dog':
                    $param_pet_kind_search = " AND (pets.kind = 'собака')";
                break;
                case 'parrot':
                    $param_pet_kind_search = " AND (pets.kind = 'попугай')";
                break;
                case 'bird':
                    $param_pet_kind_search = " AND (pets.kind = 'другая птица')";
                break;
                case 'hamster':
                    $param_pet_kind_search = " AND (pets.kind = 'хомяк')";
                break;
                case 'cavy':
                    $param_pet_kind_search = " AND (pets.kind = 'морская свинка')";
                break;
                case 'rabbit':
                    $param_pet_kind_search = " AND (pets.kind = 'кролик')";
                break;
                case 'chinchilla':
                    $param_pet_kind_search = " AND (pets.kind = 'шиншилла')";
                break;
                case 'fish':
                    $param_pet_kind_search = " AND (pets.kind = 'рыбки')";
                break;
                case 'turtle':
                    $param_pet_kind_search = " AND (pets.kind = 'черепаха')";
                break;
                case 'other':
                    $param_pet_kind_search = " AND (pets.kind = 'другое')";
                break;
                default;
                    $param_pet_kind_search = " ";
                break;
            }
        }
        
$result_search_orders_count = mysql_query("SELECT * FROM orders WHERE (owner_id != $id) AND (deleted = 'no')");
$count_orders_search = mysql_num_rows($result_search_orders_count);

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
                    <div class="block-title-and-sorting-right">
                        <ul id="options-list">
                            <p class="count-search-users-title"><?echo $count_orders_search;?></p>
                        </ul>
                    </div>
                </div>
                <div class="search-list">
                    <?
                        $result_search = mysql_query("SELECT orders.id AS current_order_id, orders.date_out AS date_out, orders.date_in AS date_in, orders.cost AS cost, orders.other_information AS about_order, pets.name AS pet_name, pets.kind AS pet_kind, pets.sex AS pet_sex, pets.breed AS pet_breed, pets.growth AS pet_growth, pets.weight AS pet_weight, pets.photo AS pet_photo, users.full_name AS full_name_user, users.id AS user_id, users.folder AS folder, users.city AS city FROM orders, pets, users WHERE (orders.pet_id = pets.id) AND (users.id = pets.owner_id) AND (orders.owner_id != $id)  AND (orders.date_out>=curdate()) AND (orders.deleted = 'no') $param_city_search $param_order_cost_search $param_pet_sex_search $param_pet_kind_search $param_order_pet_growth_search $param_order_date_search GROUP BY orders.id");
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
                                <input type="number" id="search-order-cost" name="search_order_cost_min" value="<?echo $param_order_cost_min;?>" min="100" max="1000000" placeholder="100 р" />
                            </div>
                            <p class="search-order-between">-</p>
                            <div class="block-for-search-cost">
                                <input type="number" id="search-order-cost" name="search_order_cost_max" value="<?echo $param_order_cost_max;?>" min="100" max="1000000" placeholder="1000000 р" />
                            </div>
                        </div>
                        
                        <p class="search-order-dates">Даты</p>
                        
                        <div class="block-for-search-date-order">
                            <p class="search-order-between-dates">с</p>
                            <div class="block-for-search-date">
                                <input type="date" id="search-order-date" name="search_order_date_start" min="<?echo $row_current_date_result["now_date"]; ?>" value="<?echo $param_order_date_start; ?>" />
                            </div>
                        </div>
                        
                        <div class="block-for-search-date-order">
                            <p class="search-order-between-dates">по</p>
                            <div class="block-for-search-date">
                                <input type="date" id="search-order-date" name="search_order_date_end" min="<?echo $row_current_date_result["now_date"]; ?>" value="<?echo $param_order_date_end; ?>" />
                            </div>
                        </div>
                        
                        <p class="search-order-city">Город</p>
                        <select id="search-order-city" name="search_order_city">
                                <option value="all" <?php if($param_city == 'all'){ echo ' selected="selected"'; } ?>>Все города</option>
                                <option value="moscow" <?php if($param_city == 'moscow'){ echo ' selected="selected"'; } ?>>Москва</option>
                                <option value="st_petersburg" <?php if($param_city == 'st_petersburg'){ echo ' selected="selected"'; } ?>>Санкт-Петербург</option>
                                <option value="volgograd" <?php if($param_city == 'volgograd'){ echo ' selected="selected"'; } ?>>Волгоград</option>
                                <option value="vladivostok" <?php if($param_city == 'vladivostok'){ echo ' selected="selected"'; } ?>>Владивосток</option>
                                <option value="voronezh" <?php if($param_city == 'voronezh'){ echo ' selected="selected"'; } ?>>Воронеж</option>
                                <option value="yekaterinburg" <?php if($param_city == 'yekaterinburg'){ echo ' selected="selected"'; } ?>>Екатеринбург</option>
                                <option value="kazan" <?php if($param_city == 'kazan'){ echo ' selected="selected"'; } ?>>Казань</option>
                                <option value="kaliningrad" <?php if($param_city == 'kaliningrad'){ echo ' selected="selected"'; } ?>>Калининград</option>
                                <option value="krasnodar" <?php if($param_city == 'krasnodar'){ echo ' selected="selected"'; } ?>>Краснодар</option>
                                <option value="krasnoyarsk" <?php if($param_city == 'krasnoyarsk'){ echo ' selected="selected"'; } ?>>Красноярск</option>
                                <option value="nizhny_novgorod" <?php if($param_city == 'nizhny_novgorod'){ echo ' selected="selected"'; } ?>>Нижний Новгород</option>
                                <option value="novosibirsk" <?php if($param_city == 'novosibirsk'){ echo ' selected="selected"'; } ?>>Новосибирск</option>
                                <option value="omsk" <?php if($param_city == 'omsk'){ echo ' selected="selected"'; } ?>>Омск</option>
                                <option value="permian" <?php if($param_city == 'permian'){ echo ' selected="selected"'; } ?>>Пермь</option>
                                <option value="rostov_on_don" <?php if($param_city == 'rostov_on_don'){ echo ' selected="selected"'; } ?>>Ростов-на-Дону</option>
                                <option value="samara" <?php if($param_city == 'samara'){ echo ' selected="selected"'; } ?>>Самара</option>
                                <option value="ufa" <?php if($param_city == 'ufa'){ echo ' selected="selected"'; } ?>>Уфа</option>
                                <option value="chelyabinsk" <?php if($param_city == 'chelyabinsk'){ echo ' selected="selected"'; } ?>>Челябинск</option>
                                <option value="sevastopol" <?php if($param_city == 'sevastopol'){ echo ' selected="selected"'; } ?>>Севастополь</option>
                                <option value="simferopol" <?php if($param_city == 'simferopol'){ echo ' selected="selected"'; } ?>>Симферополь</option>
                                <option value="other" <?php if($param_city == 'other'){ echo ' selected="selected"'; } ?>>Другой город</option>
                        </select>
                        
                        <div class="search-pet-param">
                            <p class="search-order-pet-kind">Животное</p>
                            <select id="search-order-kind-pet" name="search_order_kind_pet">
                                <option value="all" <?php if($param_pet_kind == 'all'){ echo ' selected="selected"'; } ?>>Любое</option>
                                <option value="cat" <?php if($param_pet_kind == 'cat'){ echo ' selected="selected"'; } ?>>Кошка</option>
                                <option value="dog" <?php if($param_pet_kind == 'dog'){ echo ' selected="selected"'; } ?>>Собака</option>
                                <option value="parrot" <?php if($param_pet_kind == 'parrot'){ echo ' selected="selected"'; } ?>>Попугай</option>
                                <option value="bird" <?php if($param_pet_kind == 'bird'){ echo ' selected="selected"'; } ?>>Другая птица</option>
                                <option value="hamster" <?php if($param_pet_kind == 'hamster'){ echo ' selected="selected"'; } ?>>Хомяк</option>
                                <option value="cavy" <?php if($param_pet_kind == 'cavy'){ echo ' selected="selected"'; } ?>>Морская свинка</option>
                                <option value="rabbit" <?php if($param_pet_kind == 'rabbit'){ echo ' selected="selected"'; } ?>>Кролик</option>
                                <option value="chinchilla" <?php if($param_pet_kind == 'chinchilla'){ echo ' selected="selected"'; } ?>>Шиншилла</option>
                                <option value="fish" <?php if($param_pet_kind == 'fish'){ echo ' selected="selected"'; } ?>>Рыбки</option>
                                <option value="turtle" <?php if($param_pet_kind == 'turtle'){ echo ' selected="selected"'; } ?>>Черепаха</option>
                                <option value="other" <?php if($param_pet_kind == 'other'){ echo ' selected="selected"'; } ?>>Другое</option>
                            </select>
                            
                            <p class="search-order-pet-sex">Пол</p>
                            <select id="search-order-sex-pet" name="search_order_sex_pet">
                                <option value="all" <?php if($param_pet_sex == 'all'){ echo ' selected="selected"'; } ?>>Любой</option>
                                <option value="m" <?php if($param_pet_sex == 'm'){ echo ' selected="selected"'; } ?>>Мальчик</option>
                                <option value="w" <?php if($param_pet_sex == 'w'){ echo ' selected="selected"'; } ?>>Девочка</option>
                                <option value="no" <?php if($param_pet_sex == 'no'){ echo ' selected="selected"'; } ?>>Не указан</option>
                            </select>
                            
                            <p class="search-order-pet-growth">Рост (в метрах)</p>
                            
                            <div class="block-for-search-pet-growth-order">
                                <div class="block-for-search-growth">
                                    <input type="number" id="search-order-growth-pet" name="search_order_growth_pet_min" value="<?echo $param_order_pet_growth_min;?>" min="0" max="1" step="0.01" placeholder="0 м" />
                                </div>
                                <p class="search-order-between">-</p>
                                <div class="block-for-search-growth">
                                    <input type="number" id="search-order-growth-pet" name="search_order_growth_pet_max" value="<?echo $param_order_pet_growth_max;?>" min="0" max="1" step="0.01" placeholder="1 м" />
                                </div>
                            </div>
                            
                            <p class="search-order-pet-weight">Вес (в килограммах)</p>
                            
                            <div class="block-for-search-pet-weight-order">
                                <div class="block-for-search-weight">
                                    <input type="number" id="search-order-weight-pet" name="search_order_weight_pet_min" value="<?echo $param_order_pet_weight_min;?>" min="0" max="20" step="0.1" placeholder="0 кг" />
                                </div>
                                <p class="search-order-between">-</p>
                                <div class="block-for-search-weight">
                                    <input type="number" id="search-order-weight-pet" name="search_order_weight_pet_max" value="<?echo $param_order_pet_weight_max;?>" min="0" max="20" step="0.1" placeholder="20 кг" />
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
