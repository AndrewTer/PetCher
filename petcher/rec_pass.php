<?php
define('mypetcher', true);
include("stat.php");
require_once("includes/connection.php");

    if(!empty($_POST['email'])) 
	{
		$email=mysql_escape_string($_POST['email']);
        
		$query = mysql_query("SELECT * FROM users WHERE email='".$email."' AND deleted='no'") 
														or trigger_error(mysql_error().$query);
		if($row = mysql_fetch_array($query))
		{
            $simv = array("92", "83", "7", "66", "45", "4", "31", "1", "0", "k", "l", "m", "n", "o", "p", "1q", "3s", "2d", "a", "xz", "sl", "dl", "po", "1l");
            
            for ($k=0; $k < 8; $k++)
            {
                shuffle($simv);
                $string_p = $string_p.$simv[1];
            }
            $new_pass = password_hash($string_p, PASSWORD_DEFAULT);
            $update_query = mysql_query("UPDATE users SET password = '".$new_pass."' WHERE email='".$email."' AND deleted='no' AND full_name='".$row["full_name"]."' AND folder='".$row["folder"]."'");
            mail($email, "Запрос на восстановление пароля", "Доброго времени суток, ".$row["full_name"]."!\n\nВаш новый пароль: $string_p \n\nЭто временный пароль, после авторизации на нашем сервисе рекомендуем вам изменить свой временный пароль на новый в разделе 'Настройки'\n\nС уважением, администрация сервиса petcher.ru");
            $success_message = "На ваш эл.адрес отправлено письмо с новым паролем";
        }
		else
		{
			$message = "Неверный эл.адрес";
		}
	}
	else
	{
	   $message = "Неверный эл.адрес";
	}	

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
            <form name="loginform" id="loginform" action="includes/rec_pass.php" >
                <?php 
                if (!empty($message)) 
                {
                    echo "<div class='error'>".$message."</div>";
                ?>
                        <hr />
                        <p align="center"><a class='pass_recovery_link' href='password_recovery'>Повторный ввод эл.адреса</a></p>
                    
                <?
                }else if (!empty($success_message))
                {
                    echo "<div class='success'>".$success_message."</div>";
                ?>
                        <hr />
                        <p align="center"><a class='pass_recovery_link_success' href='login'>Перейти к авторизации</a></p>
                <?
                } 
                ?>
            </form>
        </div>
    </div>
    
    <div class="footer">
    PetCher © 2019
    </div>
</div>
