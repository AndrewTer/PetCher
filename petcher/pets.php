<?php 
require_once("includes/connection.php"); 
include("functions.php");
session_start();
if($_SESSION['auth_user'] == "yes_auth")
{
    define('blablapet',true);
    $username = $_SESSION['username'];
    $encrypted_password = $_SESSION['encrypted_password'];
    $id = $_SESSION['id']; 
    
    if (!empty($_GET["petnum"]))
    {
        $pet_id=clear_string($_GET["petnum"]);
        if (!preg_match('/^\+?\d+$/', $pet_id)) 
        {
            header("Location: index.php");
        }
    }else
    {
        header("Location: index.php"); 
        
    }
    
    $action = $_GET["action"];
    if (isset($action))
    {
        switch ($action) {
            case 'delete':
                $delete = mysql_query("UPDATE pets SET deleted='yes' WHERE id=".$pet_id);
                mysql_query("UPDATE orders SET deleted='yes' WHERE pet_id=".$pet_id);
                header("Location: index.php"); 
            break;
        }
    }
    
    if ($_POST["change_pet_info_submit"])
    {
        
        $sex_change_pet = $_POST["change_pet_sex"];
        $breed_change_pet = $_POST["change_pet_breed"];
        
        switch ($sex_change_pet) {
            case 'no':
                $sex_change_pet_result = "не указано";
            break;
            case 'm':
                $sex_change_pet_result = "мальчик";
            break;
            case 'w':
                $sex_change_pet_result = "девочка";
            break;
            default;
                $sex_change_pet_result = "не указано";
            break;
        }
        
        $kind_change_pet = $_POST["change_pet_kind"];
        
        switch ($kind_change_pet) {
            case 'cat':
                $kind_change_pet_result = "кошка";
            break;
            case 'dog':
                $kind_change_pet_result = "собака";
            break;
            case 'parrot':
                $kind_change_pet_result = "попугай";
            break;
            case 'bird':
                $kind_change_pet_result = "другая птица";
            break;
            case 'hamster':
                $kind_change_pet_result = "хомяк";
            break;
            case 'cavy':
                $kind_change_pet_result = "морская свинка";
            break;
            case 'rabbit':
                $kind_change_pet_result = "кролик";
            break;
            case 'chinchilla':
                $kind_change_pet_result = "шиншилла";
            break;
            case 'fish':
                $kind_change_pet_result = "рыбки";
            break;
            case 'turtle':
                $kind_change_pet_result = "черепаха";
            break;
            case 'other':
                $kind_change_pet_result = "другой";
            break;
            default;
                $kind_change_pet_result = "другой";
            break;
        }
        
        if ($breed_change_pet == null)
        {
            $breed_change_pet = "без породы";
        }
        
        if (empty($_POST["file_pet_photo"]))
        {
            include("actions/upload-pet-photo.php");
            unset($_POST["file_pet_photo"]);
        }    
        
        mysql_query("UPDATE pets SET name = '".$_POST["change_pet_name"]."', kind = '".$kind_change_pet_result."', 
                        breed = '".$breed_change_pet."', sex = '".$sex_change_pet_result."', 
                        weight = '".$_POST["change_pet_weight"]."', growth = '".$_POST["change_pet_growth"]."',
                        other_information = '".$_POST["change_pet_about"]."' WHERE (id = $pet_id) AND (owner_id = $id)");
    }
    
    if ($_POST["delete_pet_photo_submit"])
    {
        mysql_query("UPDATE pets SET photo = 'no' WHERE (id = $pet_id) AND (owner_id = $id)");
    }
    
    $result_user_data_for_current_pet = mysql_query("SELECT * FROM users WHERE id=$id");
    if (mysql_num_rows($result_user_data_for_current_pet) > null)
    {
        $row_user_data_for_current_pet = mysql_fetch_array($result_user_data_for_current_pet);
    }

    $result_current_pet = mysql_query("SELECT * FROM pets WHERE (id = $pet_id) AND (owner_id = $id)");
    if (mysql_num_rows($result_current_pet) > null)
    {
        $row_current_pet = mysql_fetch_array($result_current_pet);
    
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
                <div class="pet-photo-and-delete">
                    <div class="pet-menu">
                        <p class="update-avatar">Обновить фотографию</p>
                        <hr />
                        <div id="avatar_up">
                            <div id="upload-container">
                                <?
                                if($row_current_pet["photo"]!="no" && $row_current_pet["photo"]!=null && file_exists("users/".$row_user_data_for_current_pet["folder"]."/".$row_current_pet["photo"]))
                                {
                                    $img_path = 'users/'.$row_user_data_for_current_pet["folder"].'/'.$row_current_pet["photo"];
                                    echo '<img id="upload-image" src="'.$img_path.'" />';
                                }else
                                {
                                    echo '<img id="upload-image" style="opacity: 0.7;" src="images/upload_avatar.png" />';
                                }
                                ?>
        		              <div>
                    		      <input id="file-input" type="file" name="file_pet_photo" />
                    		  </div>
                              <label for="file-input">Выберите фото</label>
        		               <!--   <span>или перетащите его в квадрат</span> --!>
                            </div>
                        </div>
                        <hr />
                        <p class="delete-pet-photo-link" ><input type="submit" class="change-pet-photo-link-a" name="delete_pet_photo_submit" value="Удалить фото" /></p>
                    </div>
                    
                    <div class="pet-delete-menu">
                        <a class="delete-pet" rel="pets.php?petnum=<?echo $pet_id;?>&action=delete">Удалить питомца</a>
                    </div>
                </div>
                
                <div class="pet-info-ch">
                    <p class="update-info-title">Информация о питомце</p>
                    <hr />
                    <p class="change-pet-info">Кличка:&emsp; <input type="text" id="change-pet-name" name="change_pet_name" maxlength="30" value="<?echo $row_current_pet["name"];?>" required /></p>
                    <p class="change-pet-info">Вид:&emsp; 
                        <select id="change-pet-kind" name="change_pet_kind">
                            <option value="cat" <?php if($row_current_pet['kind'] == 'кошка'){ echo ' selected="selected"'; } ?>>Кошка</option>
                            <option value="dog" <?php if($row_current_pet['kind'] == 'собака'){ echo ' selected="selected"'; } ?>>Собака</option>
                            <option value="parrot" <?php if($row_current_pet['kind'] == 'попугай'){ echo ' selected="selected"'; } ?>>Попугай</option>
                            <option value="bird" <?php if($row_current_pet['kind'] == 'другая птица'){ echo ' selected="selected"'; } ?>>Другая птица</option>
                            <option value="hamster" <?php if($row_current_pet['kind'] == 'хомяк'){ echo ' selected="selected"'; } ?>>Хомяк</option>
                            <option value="cavy" <?php if($row_current_pet['kind'] == 'морская свинка'){ echo ' selected="selected"'; } ?>>Морская свинка</option>
                            <option value="rabbit" <?php if($row_current_pet['kind'] == 'кролик'){ echo ' selected="selected"'; } ?>>Кролик</option>
                            <option value="chinchilla" <?php if($row_current_pet['kind'] == 'шиншилла'){ echo ' selected="selected"'; } ?>>Шиншилла</option>
                            <option value="fish" <?php if($row_current_pet['kind'] == 'рыбки'){ echo ' selected="selected"'; } ?>>Рыбки</option>
                            <option value="turtle" <?php if($row_current_pet['kind'] == 'черепаха'){ echo ' selected="selected"'; } ?>>Черепаха</option>
                            <option value="other" <?php if($row_current_pet['kind'] == 'другой'){ echo ' selected="selected"'; } ?>>Другой</option>
                        </select>
                    </p>
                    <p class="change-pet-info">Порода:&emsp; <input type="text" id="change-pet-breed" name="change_pet_breed" maxlength="40" value="<?echo $row_current_pet["breed"];?>" /></p>
                    <p class="change-pet-info">Пол:&emsp; 
                        <select id="change-pet-sex" name="change_pet_sex">
                            <option value="no" <?php if($row_current_pet['sex'] == 'не указано'){ echo ' selected="selected"'; } ?>>Пусто</option>
                            <option value="m" <?php if($row_current_pet['sex'] == 'мальчик'){ echo ' selected="selected"'; } ?>>Мальчик</option>
                            <option value="w" <?php if($row_current_pet['sex'] == 'девочка'){ echo ' selected="selected"'; } ?>>Девочка</option>
                        </select>
                    </p>
                    
                    <p class="change-pet-info">Вес (в кг):&emsp; <input type="number" id="change-pet-weight" name="change_pet_weight" min="0" max="20" value="<?echo $row_current_pet["weight"];?>" step="0.1" placeholder="0-20" /></p>
                    <p class="change-pet-info">Рост (в м):&emsp; <input type="number" id="change-pet-growth" name="change_pet_growth" min="0" max="1" value="<?echo $row_current_pet["growth"];?>" step="0.01" placeholder="0-1" /></p>
                    
                    <p class="change-pet-info">О питомце:</p><textarea id="change-pet-about" name="change_pet_about" maxlength="500" cols="93" rows="10" placeholder="До 500 символов"><?echo $row_current_pet["other_information"];?></textarea>
                    
                    <p class="change-pet-info-link" ><input type="submit" class="change-pet-info-link-a" name="change_pet_info_submit" value="Сохранить" /></p>
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
        header("Location: index.php"); 
    }
}else
{
    header("Location: login.php"); 
}
?>
