<?php 
define('mypetcher', true);
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
                $param_city_search = " AND ((city = null) OR (city = '') OR (city = 'Другой город'))";
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
        
        $result_search_count_of_city_moscow = mysql_query("SELECT * FROM users WHERE (city = 'Москва')");
        $count_search_count_of_city_moscow = mysql_num_rows($result_search_count_of_city_moscow);
        
        $result_search_count_of_city_spb = mysql_query("SELECT * FROM users WHERE (city = 'Санкт-Петербург')");
        $count_search_count_of_city_spb = mysql_num_rows($result_search_count_of_city_spb);
        
        $result_search_count_of_city_volgograd = mysql_query("SELECT * FROM users WHERE (city = 'Волгоград')");
        $count_search_count_of_city_volgograd = mysql_num_rows($result_search_count_of_city_volgograd);
        
        $result_search_count_of_city_vladivostok = mysql_query("SELECT * FROM users WHERE (city = 'Владивосток')");
        $count_search_count_of_city_vladivostok = mysql_num_rows($result_search_count_of_city_vladivostok);
        
        $result_search_count_of_city_voronezh = mysql_query("SELECT * FROM users WHERE (city = 'Воронеж')");
        $count_search_count_of_city_voronezh = mysql_num_rows($result_search_count_of_city_voronezh);
        
        $result_search_count_of_city_yekaterinburg = mysql_query("SELECT * FROM users WHERE (city = 'Екатеринбург')");
        $count_search_count_of_city_yekaterinburg = mysql_num_rows($result_search_count_of_city_yekaterinburg);
        
        $result_search_count_of_city_kazan = mysql_query("SELECT * FROM users WHERE (city = 'Казань')");
        $count_search_count_of_city_kazan = mysql_num_rows($result_search_count_of_city_kazan);
        
        $result_search_count_of_city_kaliningrad = mysql_query("SELECT * FROM users WHERE (city = 'Калининград')");
        $count_search_count_of_city_kaliningrad = mysql_num_rows($result_search_count_of_city_kaliningrad);
        
        $result_search_count_of_city_krasnodar = mysql_query("SELECT * FROM users WHERE (city = 'Краснодар')");
        $count_search_count_of_city_krasnodar = mysql_num_rows($result_search_count_of_city_krasnodar);
        
        $result_search_count_of_city_krasnoyarsk = mysql_query("SELECT * FROM users WHERE (city = 'Красноярск')");
        $count_search_count_of_city_krasnoyarsk = mysql_num_rows($result_search_count_of_city_krasnoyarsk);
        
        $result_search_count_of_city_nizhny_novgorod = mysql_query("SELECT * FROM users WHERE (city = 'Нижний Новгород')");
        $count_search_count_of_city_nizhny_novgorod = mysql_num_rows($result_search_count_of_city_nizhny_novgorod);
        
        $result_search_count_of_city_novosibirsk = mysql_query("SELECT * FROM users WHERE (city = 'Новосибирск')");
        $count_search_count_of_city_novosibirsk = mysql_num_rows($result_search_count_of_city_novosibirsk);
        
        $result_search_count_of_city_omsk = mysql_query("SELECT * FROM users WHERE (city = 'Омск')");
        $count_search_count_of_city_omsk = mysql_num_rows($result_search_count_of_city_omsk);
        
        $result_search_count_of_city_permian = mysql_query("SELECT * FROM users WHERE (city = 'Пермь')");
        $count_search_count_of_city_permian = mysql_num_rows($result_search_count_of_city_permian);
        
        $result_search_count_of_city_rostov_on_don = mysql_query("SELECT * FROM users WHERE (city = 'Ростов-на-Дону')");
        $count_search_count_of_city_rostov_on_don = mysql_num_rows($result_search_count_of_city_rostov_on_don);
        
        $result_search_count_of_city_samara = mysql_query("SELECT * FROM users WHERE (city = 'Самара')");
        $count_search_count_of_city_samara = mysql_num_rows($result_search_count_of_city_samara);
        
        $result_search_count_of_city_ufa = mysql_query("SELECT * FROM users WHERE (city = 'Уфа')");
        $count_search_count_of_city_ufa = mysql_num_rows($result_search_count_of_city_ufa);
        
        $result_search_count_of_city_chelyabinsk = mysql_query("SELECT * FROM users WHERE (city = 'Челябинск')");
        $count_search_count_of_city_chelyabinsk = mysql_num_rows($result_search_count_of_city_chelyabinsk);
        
        $result_search_count_of_city_sevastopol = mysql_query("SELECT * FROM users WHERE (city = 'Севастополь')");
        $count_search_count_of_city_sevastopol = mysql_num_rows($result_search_count_of_city_sevastopol);
        
        $result_search_count_of_city_simferopol = mysql_query("SELECT * FROM users WHERE (city = 'Симферополь')");
        $count_search_count_of_city_simferopol = mysql_num_rows($result_search_count_of_city_simferopol);
?>

<html>
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
       m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
    
       ym(53791042, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
       });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/53791042" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <noscript>
        <meta http-equiv="refresh" content="0; url=noscript.php" />
    </noscript>
    <title>Поиск пользователей | PetCher</title> 
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
                    <hr />
                    <!--Карта-->
                    <div id="map" style="width: 600px; height: 200px;"></div>  

                    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
                    <script type="text/javascript">
                    ymaps.ready(init);        
                    function init() {
                        var myMap = new ymaps.Map("map", {
                            center: [53, 55],
                            zoom: 3
                        }, {
                            searchControlProvider: 'yandex#search'
                        });
                    
                        ymaps.geocode("г.Москва").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_moscow;?>',
                                balloonContentHeader: "Москва",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_moscow;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });  
                        
                        ymaps.geocode("г.Санкт-Петербург").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_spb;?>',
                                balloonContentHeader: "Санкт-Петербург",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_spb;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });   
                        
                        ymaps.geocode("г.Волгоград").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_volgograd;?>',
                                balloonContentHeader: "Волгоград",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_volgograd;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Владивосток").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_vladivostok;?>',
                                balloonContentHeader: "Владивосток",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_vladivostok;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Воронеж").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_voronezh;?>',
                                balloonContentHeader: "Воронеж",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_voronezh;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Екатеринбург").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_yekaterinburg;?>',
                                balloonContentHeader: "Екатеринбург",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_yekaterinburg;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Казань").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_kazan;?>',
                                balloonContentHeader: "Казань",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_kazan;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Калининград").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_kaliningrad;?>',
                                balloonContentHeader: "Калининград",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_kaliningrad;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Краснодар").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_krasnodar;?>',
                                balloonContentHeader: "Краснодар",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_krasnodar;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Красноярск").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_krasnoyarsk;?>',
                                balloonContentHeader: "Красноярск",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_krasnoyarsk;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Нижний Новгород").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_nizhny_novgorod;?>',
                                balloonContentHeader: "Нижний Новгород",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_nizhny_novgorod;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Новосибирск").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_novosibirsk;?>',
                                balloonContentHeader: "Новосибирск",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_novosibirsk;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Омск").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_omsk;?>',
                                balloonContentHeader: "Омск",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_omsk;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Пермь").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_permian;?>',
                                balloonContentHeader: "Пермь",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_permian;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Ростов-на-Дону").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_rostov_on_don;?>',
                                balloonContentHeader: "Ростов-на-Дону",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_rostov_on_don;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Самара").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_samara;?>',
                                balloonContentHeader: "Самара",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_samara;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Уфа").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_ufa;?>',
                                balloonContentHeader: "Уфа",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_ufa;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Челябинск").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_chelyabinsk;?>',
                                balloonContentHeader: "Челябинск",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_chelyabinsk;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Севастополь").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_sevastopol;?>',
                                balloonContentHeader: "Севастополь",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_sevastopol;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                        
                        ymaps.geocode("г.Симферополь").then(function (res) {
                            var coord = res.geoObjects.get(0).geometry.getCoordinates();
                            var myPlacemark = new ymaps.Placemark(coord, {
                                iconCaption: '<?echo $count_search_count_of_city_simferopol;?>',
                                balloonContentHeader: "Симферополь",
                                balloonContentBody: "пользователей: <?echo $count_search_count_of_city_simferopol;?>"
                            }, {
                                preset: 'islands#blueCircleDotIcon'
                            });
                            myMap.geoObjects.add(myPlacemark); 
                        });
                    }
                    </script>
                    
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
                                            echo '<a href="id'.$row_search["user_id"].'_'.ftranslite($row_search["full_name"]).'"><img class="image-avatar" src="'.$img_path.'" alt="" width="100%" /></a>';
                                        }else
                                        {
                                            echo '<a href="id'.$row_search["user_id"].'_'.ftranslite($row_search["full_name"]).'"><img class="image-avatar" src="images/nophoto.jpg" width="100%" /></a>';
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
                                        <p class="user-about-search"><a id="user-about-search-username" href="id'.$row_search["user_id"].'_'.ftranslite($row_search["full_name"]).'">'.$row_search["full_name"].'</a></p>';
                                        
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
                    
                    <a class="sort-user-by-param-a" href="users_search?sort=rating-decrease"><p class="sort-user-by-param">&#8659; По убыванию рейтинга</p></a>
                    <a class="sort-user-by-param-a" href="users_search?sort=rating-increase"><p class="sort-user-by-param">&#8657; По возрастанию рейтинга</p></a>
                    <a class="sort-user-by-param-a" href="users_search?sort=all-users"><p class="sort-user-by-param">&#215; Без сортировки</p><a></a>             
                </div>
                
                <div class="go-to-search-orders">
                <a href="orders_search">
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
    header("Location: login"); 
}
?>
