<?php 
define('mypetcher', true);
require_once("includes/connection.php");
?>
<head>
<link href="css/style-login.css" media="screen" rel="stylesheet" />
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
    <meta http-equiv="refresh" content="0; url=noscript" />
</noscript>
<title>Восстановление пароля | PetCher</title>
</head>

<div class="grid-container">
    <div class="container mlogin">
        <?php 
            include("includes/logreg_header.php");
        ?>
        <div id="login">
            <h1>Восстановление пароля</h1>
            <form name="loginform" id="loginform" action="rec_pass" method="post" >
                <?php 
                if (!empty($message)) 
                {
                    echo "<div class='error'>".$message."</div>";
                } 
                ?>
                <p>
                    <label for="user_email">Введите ваш эл.адрес (ваш логин), на который придёт письмо с ссылкой на изменение пароля.<br />
                    <input type="email" name="email" id="email_login" class="input" value="" size="20" required /></label>
                </p>
                <p class="submit">
                    <input type="submit" name="check_email" class="button" value="Проверка эл.адреса" />
                </p>
            </form>
        </div>
    </div>
    
    <div class="footer">
    PetCher © 2019
    </div>
</div>
