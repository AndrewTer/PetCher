<?php 
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
        $encrypted_password = md5($password);
        
		$query = mysql_query("SELECT * FROM users WHERE email='".$email."' AND password='".$encrypted_password."'") 
														or trigger_error(mysql_error().$query);
		if($row= mysql_fetch_array($query))
		{
			if(($_POST['email']==$email)&&($_POST['password']==$encrypted_password))
			{
				//создаём сессию с данным
                
				$_SESSION['username']=$row['full_name'];
                $_SESSION['encrypted_password'] = $row['encrypted_password'];
                $_SESSION['phone']=$row['phone_number'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['auth_user'] = 'yes_auth';
				//переадресация
				header("Location: index.php?id".$_SESSION['id']);
			}
		}
		else
		{
			//$messgae = "Неверный логин и/или пароль";
			print "Неверный логин и/или пароль";
		}
	}
	else
	{
	   print "Неизвестный пользователь";
		
	}
} 
else 
{ 
	
}
?>
<head>
<link href="css/style-login.css" media="screen" rel="stylesheet" />
<title>Добро пожаловать | BlaBlaCat</title>
</head>

<div class="header">
<div class="contain clearfix">

<a href=""><img id = "logos" src='images/logo.png' width="150" height="50" /></a>
<nav>
<a href="">Правила</a>
<a href="">О нас</a>
</nav>
</div>
</div>

<div class="container mlogin">
    <div id="login">
        <h1>ВХОД</h1>
        <form name="loginform" id="loginform" action="" method="POST">
            <p>
                <label for="user_email">Почта<br />
                <input type="email" name="email" id="email" class="input" value="" size="20" required></label>
            </p>
            <p>
                <label for="user_pass">Пароль<br />
                <input type="password" name="password" id="password" class="input" value="" size="20" required/></label>
            </p>
            <p class="submit">
                <input type="submit" name="login" class="button" value="Вход" />
            </p>
            <p class="regtext">Впервые здесь? <a class="reglink" href="register.php" >Регистрация</a>!</p>
        </form>
    </div>
</div>

<div class="footer">
BlaBlaCat © 2019
</div>
    
<?php 
if (!empty($message)) 
{
	echo "<p class=\"error\">". $message . "</p>";
} 
?>
	