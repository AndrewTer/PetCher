<?php 
define('mypetcher', true);
require_once("includes/connection.php"); 
include("functions.php");
session_start();
if($_SESSION['auth_user'] == "yes_auth")
{
    $username = $_SESSION['username'];
    $encrypted_password = $_SESSION['encrypted_password'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $street = $_SESSION['street'];
    $id = $_SESSION['id']; 
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
    
    /*Для смены блоков*/
    function SwapEditOrders(div1,div2)
    {
       d1 = document.getElementById(div1);
       d2 = document.getElementById(div2);
       if( d2.style.display == "none" )
       {
          d1.style.display = "none";
          d2.style.display = "block";
       }
       else
       {
          d1.style.display = "block";
          d2.style.display = "none";
       }
    }
    
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
    <meta name="description" content="PetCher - сервис по передержке домашних животных. Наша цель - помощь владельцам животных в поиске желающих посидеть с их питомцами на время отсутствия, создавая для этого удобные средства поиска и связи." />
</head>

<div class="grid-container">
    
  <?php 
    include("includes/header.php");
  ?>
  
  <div class="body">
    <div class="main-body">
    <?php 
        include("includes/upper_body.php");
        include("includes/main_body.php");
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
    header("Location: login"); 
}
?>
