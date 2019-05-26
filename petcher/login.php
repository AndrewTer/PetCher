<?php 
define('mypetcher', true);
include("stat.php");
session_start();
require_once("includes/connection.php");
//нажатие на кнопку входа
if(isset($_POST["login"]))
{	
	//пустые ли формы
	if(!empty($_POST['email']) && !empty($_POST['password'])) 
	{
		$email=mysql_escape_string($_POST['email']);
		$password=mysql_escape_string($_POST['password']);
        
		$query = mysql_query("SELECT * FROM users WHERE email='".$email."' AND deleted='no'") 
														or trigger_error(mysql_error().$query);
		if($row= mysql_fetch_array($query))
		{
            		$user_pass = $row['password'];
            		if (password_verify($password, $user_pass)) {
				if(($_POST['email']==$email)&&($_POST['password']==$password))
				{
    					//создаём сессию с данным
    					$_SESSION['username']=$row['full_name'];
				    	$_SESSION['encrypted_password'] = $row['password'];
				    	$_SESSION['phone']=$row['phone_number'];
				    	$_SESSION['email'] = $row['email'];
				    	$_SESSION['street'] = $row['street'];
				   	$_SESSION['id'] = $row['id'];
				    	$_SESSION['auth_user'] = 'yes_auth';
    					//переадресация
    					header("Location: orders");
    				}
            		}else
            		{
                		$message = "Неверный логин и/или пароль";
            		}
		}
		else
		{
			$message = "Неверный логин и/или пароль";
		}
	}
	else
	{
	   $message = "Неизвестный пользователь";	
	}
} 
else 
{ 
	
}
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
<title>Добро пожаловать | PetCher</title>
<meta name="description" content="Вход PetCher.ru" />
</head>

<div class="grid-container">
    <div class="container mlogin">
        <?php 
            include("includes/logreg_header.php");
        ?>
        <div id="login">
            <h1>ВХОД</h1>
            <form name="loginform" id="loginform" action="" method="POST">
                <?php 
                if (!empty($message)) 
                {
                    echo "<div class='error'>".$message."</div>";
                } 
                ?>
                <p>
                    <label for="user_email">Email | Логин<br />
                    <input type="email" name="email" id="email_login" class="input" value="" size="20" required /></label>
                </p>
                <p>
                    <label for="user_pass">Пароль<br />
                    <input type="password" name="password" id="password_login" class="input" value="" size="20" required /></label>
                </p>
                <p class="submit">
                    <input type="submit" name="login" class="button" value="Вход" />
                </p>
                <p class="regtext">Впервые здесь? <a class="reglink" href="register" >Регистрация</a>!</p>
            </form>
            <hr />
            <p class="regtext">Забыли свой пароль? <a class="reglink" href="password_recovery" >Восстановление пароля</a></p>
        </div>
    </div>
    
    <div class="footer">
    PetCher © 2019
    </div>
</div>
