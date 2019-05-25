<?php 
define('mypetcher', true);
require_once("includes/connection.php"); 
include("functions.php");
session_start();
if($_SESSION['auth_user'] == "yes_auth")
{
    define('blablauser',true);
    $username = $_SESSION['username'];
    $encrypted_password = $_SESSION['encrypted_password'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $street = $_SESSION['street'];
    $id = $_SESSION['id']; 
    
    if ($_POST["change_user_info_submit"])
    {   
        if (empty($_POST["file_user_photo"]))
        {
            include("actions/upload-user-photo.php");
            unset($_POST["file_user_photo"]);
        }    
        
        $city_change_user = $_POST["change_user_city"];
        
        switch ($city_change_user) {
            case 'moscow':
                $city_change_user_result = "Москва";
            break;
            case 'st_petersburg':
                $city_change_user_result = "Санкт-Петербург";
            break;
            case 'volgograd':
                $city_change_user_result = "Волгоград";
            break;
            case 'vladivostok':
                $city_change_user_result = "Владивосток";
            break;
            case 'voronezh':
                $city_change_user_result = "Воронеж";
            break;
            case 'yekaterinburg':
                $city_change_user_result = "Екатеринбург";
            break;
            case 'kazan':
                $city_change_user_result = "Казань";
            break;
            case 'kaliningrad':
                $city_change_user_result = "Калининград";
            break;
            case 'krasnodar':
                $city_change_user_result = "Краснодар";
            break;
            case 'krasnoyarsk':
                $city_change_user_result = "Красноярск";
            break;
            case 'nizhny_novgorod':
                $city_change_user_result = "Нижний Новгород";
            break;
            case 'novosibirsk':
                $city_change_user_result = "Новосибирск";
            break;
            case 'omsk':
                $city_change_user_result = "Омск";
            break;
            case 'permian':
                $city_change_user_result = "Пермь";
            break;
            case 'rostov_on_don':
                $city_change_user_result = "Ростов-на-Дону";
            break;
            case 'samara':
                $city_change_user_result = "Самара";
            break;
            case 'ufa':
                $city_change_user_result = "Уфа";
            break;
            case 'chelyabinsk':
                $city_change_user_result = "Челябинск";
            break;
            case 'sevastopol':
                $city_change_user_result = "Севастополь";
            break;
            case 'simferopol':
                $city_change_user_result = "Симферополь";
            break;
            case 'other':
                $city_change_user_result = "Другой город";
            break;
            default;
                $city_change_user_result = "Другой город";
            break;
        }
        
        mysql_query("UPDATE users SET full_name = '".$_POST["change_user_name"]."', city = '".$city_change_user_result."', street = '".$_POST["change_user_street"]."', 
                        description = '".$_POST["change_user_about"]."' WHERE id = $id");
    }

    if ($_POST["delete_user_photo_submit"])
    {
        mysql_query("UPDATE users SET photo = 'no' WHERE id = $id");
    }
    
    $result_change_user_info = mysql_query("SELECT * FROM users WHERE id = $id");
    if (mysql_num_rows($result_change_user_info) > null)
    {
        $row_change_user_info = mysql_fetch_array($result_change_user_info);
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
    <title><? echo $username ?> | PetCher</title> 
</head>

<div class="grid-container">

  <?php 
    include("includes/header.php");
  ?>
  
  <div class="body">
    <div class="main-body">
        <div class="upper-part-body">
            <form enctype="multipart/form-data"  method="POST">
                <div class="user-menu">
                    <p class="update-avatar">Обновить фотографию</p>
                    <hr />
                    <div id="avatar_up">
                        <div id="upload-container">
                            <?
                            if($row_change_user_info["photo"]!="no" && $row_change_user_info["photo"]!=null && file_exists("users/".$row_change_user_info["folder"]."/".$row_change_user_info["photo"]))
                            {
                                $img_path = 'users/'.$row_change_user_info["folder"].'/'.$row_change_user_info["photo"];
                                echo '<img id="upload-image" src="'.$img_path.'" />';
                            }else
                            {
                                echo '<img id="upload-image" style="opacity: 0.7;" src="images/upload_avatar.png" />';
                            }
                            ?>
    		              <div>
                		      <input id="file-input" type="file" name="file_user_photo" />
                		  </div>
                          <label for="file-input">Выберите фото</label>
                        </div>
                    </div>
                    <hr />
                    <p class="delete-user-photo-link" ><input type="submit" class="change-pet-photo-link-a" name="delete_user_photo_submit" value="Удалить фото" /></p>
                </div>
                
                <div class="user-info-ch">
                    <p class="update-info-title">Основное</p>
                    <hr />
                    <p class="change-user-info">ФИО:&emsp; <input type="text" id="change-user-name" name="change_user_name" maxlength="50" value="<?echo $row_change_user_info["full_name"];?>" required /></p>
                    <p class="change-user-info">Город: &emsp; 
                        <select id="change-user-city" name="change_user_city">
                            <option value="moscow" <?php if($row_change_user_info['city'] == 'Москва'){ echo ' selected="selected"'; } ?>>Москва</option>
                            <option value="st_petersburg" <?php if($row_change_user_info['city'] == 'Санкт-Петербург'){ echo ' selected="selected"'; } ?>>Санкт-Петербург</option>
                            <option value="volgograd" <?php if($row_change_user_info['city'] == 'Волгоград'){ echo ' selected="selected"'; } ?>>Волгоград</option>
                            <option value="vladivostok" <?php if($row_change_user_info['city'] == 'Владивосток'){ echo ' selected="selected"'; } ?>>Владивосток</option>
                            <option value="voronezh" <?php if($row_change_user_info['city'] == 'Воронеж'){ echo ' selected="selected"'; } ?>>Воронеж</option>
                            <option value="yekaterinburg" <?php if($row_change_user_info['city'] == 'Екатеринбург'){ echo ' selected="selected"'; } ?>>Екатеринбург</option>
                            <option value="kazan" <?php if($row_change_user_info['city'] == 'Казань'){ echo ' selected="selected"'; } ?>>Казань</option>
                            <option value="kaliningrad" <?php if($row_change_user_info['city'] == 'Калининград'){ echo ' selected="selected"'; } ?>>Калининград</option>
                            <option value="krasnodar" <?php if($row_change_user_info['city'] == 'Краснодар'){ echo ' selected="selected"'; } ?>>Краснодар</option>
                            <option value="krasnoyarsk" <?php if($row_change_user_info['city'] == 'Красноярск'){ echo ' selected="selected"'; } ?>>Красноярск</option>
                            <option value="nizhny_novgorod" <?php if($row_change_user_info['city'] == 'Нижний Новгород'){ echo ' selected="selected"'; } ?>>Нижний Новгород</option>
                            <option value="novosibirsk" <?php if($row_change_user_info['city'] == 'Новосибирск'){ echo ' selected="selected"'; } ?>>Новосибирск</option>
                            <option value="omsk" <?php if($row_change_user_info['city'] == 'Омск'){ echo ' selected="selected"'; } ?>>Омск</option>
                            <option value="permian" <?php if($row_change_user_info['city'] == 'Пермь'){ echo ' selected="selected"'; } ?>>Пермь</option>
                            <option value="rostov_on_don" <?php if($row_change_user_info['city'] == 'Ростов-на-Дону'){ echo ' selected="selected"'; } ?>>Ростов-на-Дону</option>
                            <option value="samara" <?php if($row_change_user_info['city'] == 'Самара'){ echo ' selected="selected"'; } ?>>Самара</option>
                            <option value="ufa" <?php if($row_change_user_info['city'] == 'Уфа'){ echo ' selected="selected"'; } ?>>Уфа</option>
                            <option value="chelyabinsk" <?php if($row_change_user_info['city'] == 'Челябинск'){ echo ' selected="selected"'; } ?>>Челябинск</option>
                            <option value="sevastopol" <?php if($row_change_user_info['city'] == 'Севастополь'){ echo ' selected="selected"'; } ?>>Севастополь</option>
                            <option value="simferopol" <?php if($row_change_user_info['city'] == 'Симферополь'){ echo ' selected="selected"'; } ?>>Симферополь</option>
                            <option value="other" <?php if($row_change_user_info['city'] == 'Другой город'){ echo ' selected="selected"'; } ?>>Другой город</option>
                        </select>
                    <p class="change-user-info">Улица:&emsp; <input type="text" id="change-user-street" name="change_user_street" maxlength="100" value="<?echo $row_change_user_info["street"];?>" /></p>
                    <p class="change-user-info">Обо мне:</p><textarea id="change-user-about" name="change_user_about" maxlength="500" cols="93" rows="10" placeholder="До 500 символов"><?echo $row_change_user_info["description"];?></textarea>
                    <p class="change-user-info-link" ><input type="submit" class="change-user-info-link-a" name="change_user_info_submit" value="Сохранить" /></p>
                </div>
            </form>
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
