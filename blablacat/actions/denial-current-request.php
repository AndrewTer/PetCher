<?php
echo $_POST["order"]. ", ". $_POST["sitter"];
if(isset($_POST["order"]) && isset($_POST["sitter"]) && strlen($_POST["order"])>0 && strlen($_POST["sitter"])>0)
{
        require_once(realpath('../includes/connection.php'));
        $order_id = $_POST['order']; 
        $sitter_id = $_POST['sitter'];
        
        //Поиск существующих записей с данными параметрами
        $search_resp_row = mysql_query("SELECT * FROM responses WHERE (order_id = $order_id) AND (sitter_id = $sitter_id)");
        
        //Флажок для ошибок
        $check = true;
        
        //Если существует запись, то меняем на не одобренную, иначе создаём новую
        if (mysql_num_rows($search_resp_row) > 0)
        {
            $del_old_req = "UPDATE request SET deleted = 'yes' WHERE (order_id = $order_id) AND (sitter_id = $sitter_id)";
            $add_new_resp = "UPDATE responses SET kind = 'no' WHERE (order_id = $order_id) AND (sitter_id = $sitter_id)";
        }else
        {
            $del_old_req = "UPDATE request SET deleted = 'yes' WHERE (order_id = $order_id) AND (sitter_id = $sitter_id)";
            $add_new_resp = "INSERT INTO responses SET order_id = $order_id, sitter_id = $sitter_id, kind = 'no'";
        }
        
        mysql_query($del_old_req) or $check = false;
        mysql_query($add_new_resp) or $check = false;
        
        echo $check;
}
?>