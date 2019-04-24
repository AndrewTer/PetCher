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
    
    if ($_POST["change_user_phone_number_settings_submit"])
    {   
        mysql_query("UPDATE users SET phone_number = '".$_POST["change_user_phone_number_settings"]."' WHERE id = $id");
        $message_change_phone = "Номер телефона успешно изменён!";
    }
    
    if ($_POST["change_user_email_login_settings_submit"])
    {   
        mysql_query("UPDATE users SET email = '".$_POST["change_user_email_login_settings"]."' WHERE id = $id");
        $message_change_email_login = "Email | Логин успешно изменён!";
    }
    
    if ($_POST["change_user_password_settings_submit"])
    {
        if(!empty($_POST['change_user_old_pass_settings']) && !empty($_POST['change_user_new_pass_settings']) && !empty($_POST['change_user_new_repeat_pass_settings'])) 
        {
            $old_password = htmlspecialchars($_POST['change_user_old_pass_settings']);
            $new_password = htmlspecialchars($_POST['change_user_new_pass_settings']);
            $replay_password = htmlspecialchars($_POST['change_user_new_repeat_pass_settings']);
            
            $result_change_old_password = mysql_query("SELECT password FROM users WHERE id = $id");
            if (mysql_num_rows($result_change_old_password) > null)
            {
                $row_change_old_password = mysql_fetch_array($result_change_old_password);
            }
        
            if (password_verify($old_password, $row_change_old_password["password"]))
            {
                if ($new_password != $replay_password)
                {
    		      $error_message_change_password = "Пароль не изменён, так как новый пароль повторен неправильно!";
                } else
                {
                    $encrypted_new_password_settings = password_hash($new_password, PASSWORD_DEFAULT);
                    $_SESSION['encrypted_password'] = $encrypted_new_password_settings;
                    $encrypted_password = $encrypted_new_password_settings;
                    
                    mysql_query("UPDATE users SET password = '$encrypted_new_password_settings' WHERE id = $id");
                    $message_change_password = "Пароль успешно изменён!";
                }
            } else
            {
                $error_message_change_password = "Пароль не изменён, так как старый пароль введён неверно!";
            }
        }
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
    <script type="text/javascript" src="js/script.js"></script> 
    <script type="text/javascript" src="js/jquery_confirm/jquery_confirm.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript">
    $(function(){
        $("#change-user-phone-number-settings").mask("+7(999) 999-9999");
    });
    </script>
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
                <div class="user-info-settings">
                    <p class="update-info-title">Настройки</p>
                    <hr />
                    <?php 
                        if (!empty($message_change_phone)) 
                        {
                            echo "<div class='success'>".$message_change_phone."</div>";
                        } 
                    ?>
                    <p class="change-user-info">Моб.телефон: &emsp; <input type="text" name="change_user_phone_number_settings" maxlength="20" id="change-user-phone-number-settings" class="input" value="<?echo $row_change_user_info["phone_number"];?>" size="20" required placeholder="+7" /></p>
                    <p class="change-user-info-link" ><input type="submit" class="change-user-info-link-a" name="change_user_phone_number_settings_submit" value="Изменить номер" /></p>
            </form>
            
            <form enctype="multipart/form-data"  method="POST">
                    <hr />
                    <?php 
                        if (!empty($message_change_email_login)) 
                        {
                            echo "<div class='success'>".$message_change_email_login."</div>";
                        } 
                    ?>
                    <p class="change-user-info">Email | Логин: &emsp; <input type="email" name="change_user_email_login_settings" placeholder="example@gmail.com" maxlength="50" id="change-user-phone-email-settings" class="input" value="<?echo $row_change_user_info["email"];?>" required /></p>
                    <p class="change-user-info-link" ><input type="submit" class="change-user-info-link-a" name="change_user_email_login_settings_submit" value="Изменить почту" /></p>
            </form>
            
            <form enctype="multipart/form-data"  method="POST">
                    <hr />
                    <?php 
                        if (!empty($error_message_change_password)) 
                        {
                            echo "<div class='error'>".$error_message_change_password."</div>";
                        }
                        
                        if (!empty($message_change_password))
                        {
                            echo "<div class='success'>".$message_change_password."</div>";
                        } 
                    ?>
                    <p class="change-user-info">Старый пароль: &emsp; <input type="password" name="change_user_old_pass_settings" maxlength="50" id="change-user-old-password-settings" class="input" required /></p>
                    <p class="change-user-info">Новый пароль: &emsp; <input type="password" name="change_user_new_pass_settings" maxlength="50" id="change-user-new-password-settings" class="input" required /></p>
                    <p class="change-user-info">Повторите пароль: &emsp; <input type="password" name="change_user_new_repeat_pass_settings" maxlength="50" id="change-user-new-password-repeat-settings" class="input" required /></p>
                    <p class="change-user-info-link" ><input type="submit" class="change-user-info-link-a" name="change_user_password_settings_submit" value="Изменить пароль" /></p>
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