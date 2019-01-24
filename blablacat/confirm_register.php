<?php 
require_once("includes/connection.php"); 
include("functions.php");
?>
<head>
    <link href="css/style-login.css" media="screen" rel="stylesheet"/>
    <script type="text/javascript" src="/js/header.js"></script>
    <script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
    <title>Регистрация | BlaBlaCat</title>
</head>
<?php
if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['replay_password']) && !empty($_POST['email'])) 
{
	$username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $replay_password = htmlspecialchars($_POST['replay_password']);
	
    if(!empty($_POST['role']))
    {
        $role = "owner";
    }else{
        $role = "sitter";
    }
    
    if (htmlspecialchars($password) == htmlspecialchars($replay_password))
	{
		$encrypted_password = md5($password);
	}
    
    $email = htmlspecialchars($_POST['email']);
	
	$query=mysql_query("SELECT * FROM users WHERE email='".$email."'");
	$numrows=mysql_num_rows($query);
	
		if($numrows==0)
		{
			$sql="insert into users VALUES ('','$username','$encrypted_password','$role','','$email','','','no','0','')";
			$result=mysql_query($sql);
            
			if($result)
			{
                $directory = mysql_query("SELECT * FROM users WHERE full_name = '".$username."' AND password = '".$encrypted_password."'");
                if (mysql_num_rows($directory) > 0)
                {
                  $directory_new = mysql_fetch_array($directory);
                }
                //создание папки для фотографий пользователя при регистрации и перевод кодировок для понятия названий ОС
			     $dir = mkdir("users/".ftranslite(utf8_to_cp1251($username)).$directory_new['id']);
                        if($dir)
                        {
                                //добавление папки пользователя в таблицу бд
                                $sql_add_folder="UPDATE users SET folder = '".ftranslite(utf8_to_cp1251($username)).$directory_new['id']."' WHERE full_name='".$username."' AND password='".$encrypted_password."' AND email='".$email."'";
                                $result_add_folder=mysql_query($sql_add_folder);
                                if($result_add_folder)
                                {
				                    //переадресация
                                    header('Location: login.php');
                                }
                        }
                        else
                        {
                        $sql_er="DELETE FROM users WHERE username = '".$username."' AND encrypted_password = '".$encrypted_password."' AND email = '".$email."'";
                        $result_er=mysql_query($sql_er);
                        $message = "Ошибка при добавление информации!\nПовторите ввод, пожалуйста";
                        }
			} 
			else 
			{	
				$message = "Ошибка при добавление информации!";
			}

		} 
		else 
		{
			$message = "Введённая эл.почта уже занята!";
		}
}
?>


<?php if (!empty($message)) {echo "<p class=\"error\">" .$message . "</p>";} ?>

<div class="header">
<div class="contain clearfix">


<a href=""><img id = "logos" src='images/logo.png' width="150" height="50" /></a>
<nav>
<a href="">Правила</a>
<a href="">О нас</a>
</nav>
</div>
</div>

<div class="container mregister">
    <div id="login">
	<h1>Подтверждение регистрации</h1>
    <form name="registerform" id="registerform" action="register.php" method="post">
	
    <p>Для защиты Вашей страницы мы вышлем на Ваш мобильный телефон бесплатное сообщение с кодом.</p>
    
	<p>
		<label for="user_phone_number">Мобильный телефон<br />
		<input type="text" name="userphonenumber" id="userphonenumber" class="input" value="" size="20" required placeholder="+7" /></label>
	</p>
	
	
        
    <p class="submit">
		<input type="submit" name="register" id="register" class="button" value="Получить код" />
	</p>
	
	<p class="regtext">У вас есть аккаунт? <a class="loglink" href="login.php" >Вход</a>!</p>
    </form>
    </div>
</div>


<div class="footer">
BlaBlaCat © 2019
</div>

