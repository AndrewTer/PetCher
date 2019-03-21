<?php 
    require_once("includes/connection.php"); 
    include("functions.php");
    session_start();
    if($_SESSION['auth_user'] == "yes_auth")
    {
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $encrypted_password = $_SESSION['encrypted_password'];

        if ($_POST["search_user_by_param"])
        {
            $param_city = $_POST["search_user_city"];
            switch ($param_city) {
            case 'all':
                $param_city_search = " ";
            break;
            case 'moscow':
                $param_city_search = " AND (city = 'Москва')";
            break;
            case 'st_petersburg':
                $param_city_search = " AND (city = 'Санкт-Петербург')";
            break;
            case 'volgograd':
                $param_city_search = " AND (city = 'Волгоград')";
            break;
            case 'vladivostok':
                $param_city_search = " AND (city = 'Владивосток')";
            break;
            case 'voronezh':
                $param_city_search = " AND (city = 'Воронеж')";
            break;
            case 'yekaterinburg':
                $param_city_search = " AND (city = 'Екатеринбург')";
            break;
            case 'kazan':
                $param_city_search = " AND (city = 'Казань')";
            break;
            case 'kaliningrad':
                $param_city_search = " AND (city = 'Калининград')";
            break;
            case 'krasnodar':
                $param_city_search = " AND (city = 'Краснодар')";
            break;
            case 'krasnoyarsk':
                $param_city_search = " AND (city = 'Красноярск')";
            break;
            case 'nizhny_novgorod':
                $param_city_search = " AND (city = 'Нижний Новгород')";
            break;
            case 'novosibirsk':
                $param_city_search = " AND (city = 'Новосибирск')";
            break;
            case 'omsk':
                $param_city_search = " AND (city = 'Омск')";
            break;
            case 'permian':
                $param_city_search = " AND (city = 'Пермь')";
            break;
            case 'rostov_on_don':
                $param_city_search = " AND (city = 'Ростов-на-Дону')";
            break;
            case 'samara':
                $param_city_search = " AND (city = 'Самара')";
            break;
            case 'ufa':
                $param_city_search = " AND (city = 'Уфа')";
            break;
            case 'chelyabinsk':
                $param_city_search = " AND (city = 'Челябинск')";
            break;
            case 'sevastopol':
                $param_city_search = " AND (city = 'Севастополь')";
            break;
            case 'simferopol':
                $param_city_search = " AND (city = 'Симферополь')";
            break;
            case 'other':
                $param_city_search = " AND ((city = null) OR (city = ''))";
            break;
            default;
                $param_city_search = " ";
            break;
            }
        }
    
        if (!empty($_GET["sort"]))
        {
                $sort = clear_string($_GET["sort"]);
    
                    switch($sort){
                        case 'all-users':
                            $sort = " ";
                        break;
                        case 'rating-decrease':
                            $sort = " ORDER BY rating DESC";
                        break;
                        case 'rating-increase':
                            $sort = " ORDER BY rating ASC";
                        break;
                        default:
                            $sort = " ";
                        break;
                    }
        }else
        {
            header("Location: index.php"); 
        }
        
        $result_search = mysql_query("SELECT id AS user_id, full_name, city, description, photo, rating, folder, status, last_visit FROM users WHERE (id != $id) AND (deleted = 'no') $param_city_search $sort");
        
        $result_search_count = mysql_query("SELECT * FROM users WHERE (id != $id)");
        
        $count_users_search = mysql_num_rows($result_search_count);
?>

<html>
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <title>Поиск пользователей | BlaBlaCat</title> 
</head>

<div class="grid-container">

  <?php 
    include("includes/header.php");
  ?>
  
  <div class="body">
    <div class="main-body">
        <div class="upper-part-search-body">
            <div class="main-search">
                <div id="block-title-and-sorting">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Поиск пользователей</p>
                    </div>
                    <div class="block-title-and-sorting-right">
                        <ul id="options-list">
                            <p class="count-search-users-title"><?echo $count_users_search+1;?></p>
                        </ul>
                    </div>
                </div>
                <div class="search-list">
                    <?
                        if (mysql_num_rows($result_search) == null)
                        {
                            echo '<hr /><p class="not-users">Пользователей нет</p>';
                        }else
                        {
                            $row_search = mysql_fetch_array($result_search);
                            do{
                                echo '
                            <hr />
                            <div class="current-user-search">
    
                                    <div class="left-part-user-search-list">
                                        <div id="search-user-circle"><div class="fav-rating" title="Рейтинг на основе оценок пользователей"><span class="fav-rating-span">'.$row_search["rating"].'/5</span></div>';
                                        if($row_search["photo"]!="no" && file_exists("users/".$row_search["folder"]."/".$row_search["photo"]))
                                        {
                                            $img_path = 'users/'.$row_search["folder"].'/'.$row_search["photo"];
                                            echo '<a href="user.php?id='.$row_search["user_id"].'"><img class="image-avatar" src="'.$img_path.'" alt="" width="100%" /></a>';
                                        }else
                                        {
                                            echo '<a href="user.php?id='.$row_search["user_id"].'"><img class="image-avatar" src="images/nophoto.jpg" width="100%" /></a>';
                                        }
                                                        
                                        echo '</div>';
                                        
                                        $user_search_id = $row_search["user_id"];
                    ?>
                                        <script type="text/javascript">
                                            function goaddcurustofav(identifier)
                                            {     
                                                var current_user_search =$(identifier).data('usersearchid'); 
                                                var cur_user = <?php echo $id ?>;

                                                var addtofavFunc = new Function(addtofavoritesearchuser(current_user_search, cur_user));
                                                addtofavFunc();                                      
                                            }                           
                                        </script>    
                                        <script type="text/javascript" src="js/ajax-scripts.js"></script>   
                    <?                  
                                        $search_user_fav_list = mysql_query("SELECT * FROM favorites WHERE (user_id = $id) AND (favourite_id = ".$user_search_id.") AND (deleted='no')");
                                        if (mysql_num_rows($search_user_fav_list) > 0)
                                        {
                                            echo '<p class="users-search-links" ><a data-usersearchid="'.$user_search_id.'" onclick="event.preventDefault();goaddcurustofav(this);" class="del-apply-current-user-search" id="apply_current_user_search" href="" ></a></p>';
                                        }else
                                        {
                                            echo '<p class="users-search-links" ><a data-usersearchid="'.$user_search_id.'" onclick="event.preventDefault();goaddcurustofav(this);" class="apply-current-user-search" id="apply_current_user_search" href="" ></a></p>';
                                        }
                                        
                            echo '</div>
                                    
                                    <div class="right-part-user-search-list">
                                        <p class="user-about-search"><a id="user-about-search-username" href="user.php?id='.$row_search["user_id"].'">'.$row_search["full_name"].'</a></p>';
                                        
                                        $current_time_result = mysql_query("SELECT SUBTIME(CURTIME(), '0:2:0') AS twomin, DATE(NOW());");
                                        $row_current_time_result = mysql_fetch_array($current_time_result);
                                        
                                        $loggedTime=$row_current_time_result["twomin"];	//2 minutes
                                        $loggedDate=$row_current_time_result["DATE(NOW())"];
                                        if(($row_search["status"]>$loggedTime) && ($row_search["last_visit"]==$loggedDate))
                                        {
                                        	echo '<p class="user-about-search" id="online-status">Статус: онлайн</p>';
                                        }
                                        else
                                        {
                                        	echo '<p class="user-about-search" id="offline-status">Статус: оффлайн</p>';
                                        }
                                        
                                        if ($row_search["city"]!=null)
                                        {
                                            echo '<p class="user-about-search">Город: '.$row_search["city"].'</p>';
                                        }else
                                        {
                                            echo '<p class="user-about-search">Город: не указан</p>';
                                        }
                                        echo '
                                        <p class="user-about-search">О себе</p>';
                                        
                                        if($row_search["description"]==null)
                                        {
                                            echo '<p class="user-about-search">Ничего не указано</p>';
                                        }else
                                        {
                                            echo '<p class="user-about-search">'.$row_search["description"].'</p>';
                                        }
                                        
                                    echo '
                                        <p class="user-about-search">Рейтинг: '.$row_search["rating"].' / 5</p>
                                    </div>
                                    <div class="clear"></div>
                            </div>
                            ';
                            }while ($row_search = mysql_fetch_array($result_search));
                        }
                    ?>
                </div>
            </div>
            <div class="part-parameters-and-to-search-users">
                <div class="search-parameters-for-users">
                    <div id="block-title-and-sorting">
                        <div class="block-title-and-sorting-for-search">
                            <p class="title-section-main-body">Параметры поиска</p>
                        </div>
                    </div>
                    
                    <hr />
                    <form enctype="multipart/form-data"  method="POST">
                        <p class="search-user-city">Город</p>
                        <select id="search-user-city" name="search_user_city">
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
                        <p class="users-search-links-button" ><input type="submit" class="search-user-by-param" name="search_user_by_param" value="Поиск" /></p>     
                    </form>       
                </div>
                
                <div class="sort-parameters-for-users">
                    <div id="block-title-and-sorting">
                        <div class="block-title-and-sorting-for-search">
                            <p class="title-section-main-body">Сортировка</p>
                        </div>
                    </div>
                    
                    <hr />
                    
                    <a class="sort-user-by-param-a" href="users_search.php?sort=rating-decrease"><p class="sort-user-by-param">&#8659; По убыванию рейтинга</p></a>
                    <a class="sort-user-by-param-a" href="users_search.php?sort=rating-increase"><p class="sort-user-by-param">&#8657; По возрастанию рейтинга</p></a>
                    <a class="sort-user-by-param-a" href="users_search.php?sort=all-users"><p class="sort-user-by-param">&#215; Без сортировки</p><a></a>             
                </div>
                
                <div class="go-to-search-orders">
                <a href="search.php">
                    <div id="block-title-and-sorting" style="min-height: 40px; height: auto;">
                        <p class="title-section-main-body" style="font-size: 18px;">Перейти к поиску заказов</p>
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
