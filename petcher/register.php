<?php
define('mypetcher', true);
session_start();
require_once("includes/connection.php"); 
include("functions.php");
include("stat.php");
//нажатие на кнопку входа
if(isset($_POST["register"]))
{
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['replay_password']) && !empty($_POST['email'])) 
    {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $replay_password = htmlspecialchars($_POST['replay_password']);
    
        if ($password != $replay_password)
        {
            $message = "Повторный пароль не совпадает с основным!";
        } else
        {
            if (htmlspecialchars($password) == htmlspecialchars($replay_password))
            {
		      $encrypted_password = password_hash($password, PASSWORD_DEFAULT); //md5($password);
            }
    
            $email = htmlspecialchars($_POST['email']);
            $phone_number_user = htmlspecialchars($_POST['userphonenumber']);
	
            $query=mysql_query("SELECT * FROM users WHERE email='".$email."'");
            $numrows=mysql_num_rows($query);
	
            if($numrows==0)
            {
                $sql="INSERT into users VALUES ('','$username','$encrypted_password','$phone_number_user','$email','Другой город','','','no','0','0','0','','','','no')";
                $result=mysql_query($sql);
            
                if($result)
                {
                    $directory = mysql_query("SELECT * FROM users WHERE full_name = '".$username."' AND password = '".$encrypted_password."' AND email='".$email."'");
                    if (mysql_num_rows($directory) > 0)
                    {
                        $directory_new = mysql_fetch_array($directory);
                    }
                    //создание папки для фотографий пользователя при регистрации и перевод кодировок для понятия названий ОС
                    $dir = mkdir("users/".ftranslite(utf8_to_cp1251($username)).$directory_new['id'], 0777);
                        if($dir)
                        {
                                //добавление папки пользователя в таблицу бд
                                $sql_add_folder="UPDATE users SET folder = '".ftranslite(utf8_to_cp1251($username)).$directory_new['id']."' WHERE full_name='".$username."' AND password='".$encrypted_password."' AND email='".$email."'";
                                $result_add_folder=mysql_query($sql_add_folder);
                                if($result_add_folder)
                                {
                                    //создаём сессию с данным
				                    $_SESSION['username']=$directory_new['full_name'];
                                    $_SESSION['encrypted_password'] = $directory_new['password'];
                                    $_SESSION['email'] = $directory_new['email'];
                                    $_SESSION['id'] = $directory_new['id'];
                                    $_SESSION['auth_user'] = 'yes_auth';
				                    //переадресация
				                    header("Location: orders");
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
    }
}
else 
{
    
}
?>
<head>
    <link href="css/style-login.css" media="screen" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript">
    $(function(){
        $("#userphonenumber").mask("+7(999) 999-9999");
    });
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
        <meta http-equiv="refresh" content="0; url=noscript" />
    </noscript>
    <title>Регистрация | PetCher</title>
    <meta name="description" content="Регистрация в PetCher.ru" />
</head>

<div class="grid-container">
    <div class="container mregister">
        <?php 
        include("includes/logreg_header.php");
        ?>
        <div id="login">
    	   <h1>Регистрация</h1>
            <form name="registerform" id="registerform" action="" method="POST">
                <?php 
                    if (!empty($message)) 
                    {
                        echo "<div class='error'>".$message."</div>";
                    } 
                ?>
                <p>
    		      <label for="user_login">Имя</label><br />
    		      <input type="text" name="username" id="reg_username" class="input" value="" size="20" required placeholder="Имя пользователя" /><span></span>
                </p>
    	
                <p>
    		      <label for="user_pass">Пароль<br />
    		      <input type="password" name="password" id="password" class="input" value="" size="32" required /><span></span></label>
                </p>		
    	
                <p>
    		      <label for="user_rep_pass">Повторить пароль<br />
    		      <input type="password" name="replay_password" id="replay_password" class="input" value="" size="32" required /><span></span></label>
                </p>
        
                <p>
                    <label for="user_email">Email | Логин<br />
                    <input type="email" name="email" placeholder="example@gmail.com" id="email" class="input" required /><span></span></label>
                </p>
                
                <p>
            		<label for="user_phone_number">Мобильный телефон<br />
            		<input type="text" name="userphonenumber" id="userphonenumber" class="input" value="" size="20" required placeholder="+7" /><span></span></label>
                </p>
        
                <p class="submit">
    		      <input type="submit" name="register" id="register" class="button" value="Регистрация" />
                </p>
    	
                <p class="regtext">У вас есть аккаунт? <a class="loglink" href="login" >Вход!</a></p>
            </form>
        </div>
    </div>
    <div class="footer">
    PetCher © 2019
    </div>
</div>
