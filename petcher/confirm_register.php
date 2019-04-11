<?php 
require_once("includes/connection.php"); 
include("functions.php");
?>
<head>
    <link href="css/style-login.css" media="screen" rel="stylesheet"/>
    <!--<script type="text/javascript" src="/js/header.js"></script>-->
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript">
    $(function(){
        $("#userphonenumber").mask("+7(999) 999-9999");
    });
    </script>
    <noscript>
        <meta http-equiv="refresh" content="0; url=noscript.php" />
    </noscript>
    <title>Регистрация | BlaBlaCat</title>
</head>

<div class="container mregister">
    <?php 
        include("includes/logreg_header.php");
    ?>
    <div id="login">
    	<h1>Завершение регистрации</h1>
        <form name="registerform" id="registerform" action="register.php" method="post">
        	
            <!--<p>Для защиты Вашей страницы мы вышлем на Ваш мобильный телефон бесплатное сообщение с кодом.</p>-->
            
        	<p>
        		<label for="user_phone_number">Мобильный телефон<br />
        		<input type="text" name="userphonenumber" id="userphonenumber" class="input" value="" size="20" required placeholder="+7" /><span></span></label>
        	</p>
        	
        	<p>
                <label for="user_email">Email | Логин<br />
                <input type="email" name="email" placeholder="example@gmail.com" id="email" class="input" required /><span></span></label>
            </p>
            
                
            <p class="submit">
        		<input type="submit" name="register" id="register" class="button" value="Регистрация" />
        	</p>
        	
        	<p class="regtext">У вас есть аккаунт? <a class="loglink" href="login.php" >Вход</a>!</p>
        </form>
    </div>
</div>


<div class="footer">
PetCher © 2019
</div>

