<?php
defined('mypetcher') or header("Location: ../403.php");
echo $_POST["user"]. ", ". $_POST["fav"];
if(isset($_POST["user"]) && isset($_POST["fav"]) && strlen($_POST["user"])>0 && strlen($_POST["fav"])>0)
{
        require_once(realpath('../includes/connection.php'));
        $user_id = $_POST['user']; 
        $fav_id = $_POST['fav'];
        
        //Поиск существующих записей с данными параметрами
        $search_fav_row = mysql_query("SELECT * FROM favorites WHERE (user_id = $user_id) AND (favourite_id = $fav_id) AND (deleted = 'no')");
        
        //Флажок для ошибок
        $check = true;
        
        //Если существует запись, то меняем на не удалённую, иначе создаём новую
        if (mysql_num_rows($search_fav_row) > 0)
        {
            $delete_from_favotite = "UPDATE favorites SET deleted = 'yes' WHERE (user_id = $user_id) AND (favourite_id = $fav_id)";
        }
        
        mysql_query($delete_from_favotite) or $check = false;
        
        echo $check;
}
?>