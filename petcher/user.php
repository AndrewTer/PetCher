<?php 
require_once("includes/connection.php"); 
include("functions.php");
session_start();
if($_SESSION['auth_user'] == "yes_auth")
{
    define('blablafavuser',true);
    $username = $_SESSION['username'];
    $encrypted_password = $_SESSION['encrypted_password'];
    $id = $_SESSION['id']; 
    
    if (!empty($_GET["id"]))
    {
        $user_id=clear_string($_GET["id"]);
        if (!preg_match('/^\+?\d+$/', $user_id)) 
        {
            header("Location: index.php");
        }else
        {
            if ($user_id == $id)
            {
                header("Location: index.php"); 
            }
            
            $result_selected_user = mysql_query("SELECT * FROM users WHERE id = ".$user_id." AND (deleted='no')");
            if (mysql_num_rows($result_selected_user) > 0)
            {
                $row_selected_user = mysql_fetch_array($result_selected_user);
            }else
            {
                header("Location: index.php"); 
            }
        }
    }else
    {
        header("Location: index.php"); 
        
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
    <noscript>
        <meta http-equiv="refresh" content="0; url=noscript.php" />
    </noscript>
    <title><? echo $row_selected_user["full_name"] ?> | PetCher</title> 
</head>

<div class="grid-container">

  
  <?php 
    include("includes/header.php");
  ?>
  
  <div class="body">
    <div class="main-body">
        <?php 
            include("includes/upper_body_user.php");
            include("includes/main_body_user.php");
        ?>
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