<?php 
define('mypetcher', true);
require_once("includes/connection.php");
?>
<head>
<link href="css/style-login.css" media="screen" rel="stylesheet" />
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