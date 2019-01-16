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
if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['replay_password'])) 
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
	
	$query=mysql_query("SELECT * FROM users WHERE full_name='".$username."' AND password='".$encrypted_password."'");
	$numrows=mysql_num_rows($query);
	
		if($numrows==0)
		{
			$sql="insert into users VALUES ('','$username','$encrypted_password','$role','','','','','','')";
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
                               $message = "Аккаунт успешно создан";
				                //переадресация
                                header("Location: login.php");
                        }
                        else
                        {
                        $sql_er="DELETE FROM users WHERE username = '".$username."' AND encrypted_password = '".$encrypted_password."'";
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
			$message = "Ваше имя занято!";
		}
        
		if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['replay_password']))
		{
			$message = "Заполните пожалуйста все поля !";
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
	<h1>Регистрация</h1>
    <form name="registerform" id="registerform" action="register.php" method="post">
	
	<p>
		<label for="user_login">Имя<br />
		<input type="text" name="username" id="username" class="input" value="" size="20" required /></label>
	</p>
	
	<p>
		<label for="user_pass">Пароль<br />
		<input type="password" name="password" id="password" class="input" value="" size="32" required /></label>
	</p>		
	
	<p>
		<label for="user_rep_pass">Повторить пароль<br />
		<input type="password" name="replay_password" id="replay_password" class="input" value="" size="32" required /></label>
	</p>
    
        <h4 id="sitter">Я Ситтер!
        <div class="doggy">
        <div class="toggle-wrapper">
            <input type="checkbox" name="role" class="doggle" id="doggle"/>
            <label for="doggle" class="toggle">
                <span class="toggle-handler">
                <span class="face eye-left"></span>
                <span class="face eye-right"></span>
                <span class="nose"></span>
                <span class="face mouth1"></span>
                <span class="face mouth2"></span>
                <span class="face2 mouth-smile"></span>
                <span class="face2 mouth-smile2"></span>
                <span class="left-ear">
                <span class="right-ear">
                    <span class="tongue"></span>
                </span>
            </label>
        </div>
        </div>
        Я Владелец!</h4>
        
    <p class="submit">
		<input type="submit" name="register" id="register" class="button" value="Продолжить регистрацию" />
	</p>
	
	<p class="regtext">У вас есть аккаунт? <a class="loglink" href="login.php" >Вход</a>!</p>
    </form>
    </div>
</div>

<div class="footer">
BlaBlaCat © 2019
</div>

