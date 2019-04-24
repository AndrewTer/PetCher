<?php
defined('mypetcher') or header("Location: ../403.php");
echo $_POST["order"]. ", ". $_POST["sitter"];
if(isset($_POST["order"]) && isset($_POST["sitter"]) && strlen($_POST["order"])>0 && strlen($_POST["sitter"])>0)
{
        require_once(realpath('../includes/connection.php'));
        $order_id = $_POST['order']; 
        $sitter_id = $_POST['sitter'];
        
        //Поиск существующих записей с данными параметрами
        $search_req_row = mysql_query("SELECT * FROM request WHERE (order_id = $order_id) AND (sitter_id = $sitter_id)");
        
        //Флажок для ошибок
        $check = true;
        
        //Если существует запись, то меняем на не удалённую, иначе создаём новую
        if (mysql_num_rows($search_req_row) > 0)
        {
            $add_new_request = "UPDATE request SET deleted = 'no' WHERE (order_id = $order_id) AND (sitter_id = $sitter_id)";
        }else
        {
            $add_new_request = "INSERT INTO request SET order_id = $order_id, sitter_id = $sitter_id, deleted = 'no'";
        }
        
        mysql_query($add_new_request) or $check = false;
        
        echo $check;
}
?>