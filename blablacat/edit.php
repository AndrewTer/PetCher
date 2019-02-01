<?php 
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
    $address = $_SESSION['address'];
    $id = $_SESSION['id']; 
    
    if ($_POST["change_user_info_submit"])
    {   
        
        if (empty($_POST["file_user_photo"]))
        {
            include("actions/upload-user-photo.php");
            unset($_POST["file_user_photo"]);
        }    
        
        mysql_query("UPDATE users SET full_name = '".$_POST["change_user_name"]."', phone_number = '".$_POST["change_user_phone_number"]."', 
                        email = '".$_POST["change_user_email"]."', address = '".$_POST["change_user_address"]."', 
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
    <title><? echo $username ?> | BlaBlaCat</title> 
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
    		               <!--   <span>или перетащите его в квадрат</span> --!>
                        </div>
                    </div>
                    <hr />
                    <p class="delete-user-photo-link" ><input type="submit" class="change-pet-photo-link-a" name="delete_user_photo_submit" value="Удалить фото" /></p>
                </div>
                
                <div class="user-info-ch">
                    <p class="update-info-title">Основное</p>
                    <hr />
                    <p class="change-user-info">ФИО:&emsp; <input type="text" id="change-user-name" name="change_user_name" maxlength="50" value="<?echo $row_change_user_info["full_name"];?>" required /></p>
                    <p class="change-user-info">Моб.телефон: &emsp; <input type="text" name="change_user_phone_number" maxlength="20" id="change-user-phone-number" class="input" value="<?echo $row_change_user_info["phone_number"];?>" size="20" required placeholder="+7" /></p>
                    <p class="change-user-info">Email: &emsp; <input type="email" name="change_user_email" placeholder="example@gmail.com" maxlength="50" id="change-user-phone-email" class="input" value="<?echo $row_change_user_info["email"];?>" required /></p>
                    <p class="change-user-info">Адрес:&emsp; <input type="text" id="change-user-address" name="change_user_address" maxlength="50" value="<?echo $row_change_user_info["address"];?>" required /></p>
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
