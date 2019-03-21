<?
    $current_time_main_result = mysql_query("SELECT CURTIME()");
    $row_current_time_main_result = mysql_fetch_array($current_time_main_result);
                    
    $setLogged=mysql_query("UPDATE users SET status='".$row_current_time_main_result["CURTIME()"]."', last_visit='".date("y-m-j")."' WHERE id='".$id."'");
    $result_new = mysql_query("SELECT * FROM users WHERE id = '".$id."' AND password = '".$encrypted_password."'"); // AND email = '".$email."'");
    if (mysql_num_rows($result_new) > 0)
    {
        $row_new = mysql_fetch_array($result_new);
    }
        
    $result_requests = mysql_query("SELECT orders.owner_id AS owner_id, orders.pet_id AS pet_id, orders.date_out AS date_out, orders.date_in AS date_in, orders.cost AS cost, orders.other_information AS order_info, request.sitter_id AS sitter_id FROM orders, request WHERE (orders.id = request.order_id) AND (orders.owner_id = $id) AND (orders.kind = 'current') AND (orders.deleted = 'no') AND (request.deleted='no')");
    if (mysql_num_rows($result_requests) > 0)
    {
        $row_requests = mysql_fetch_array($result_requests);
        $count_requests = mysql_num_rows($result_requests);
    }
    
    $result_all_responses = mysql_query("SELECT id FROM responses WHERE (sitter_id=$id)");
    if (mysql_num_rows($result_all_responses) > 0)
    {
        $count_all_responses = mysql_num_rows($result_all_responses);
    }
    
    $result_pet_list = mysql_query("SELECT * FROM pets WHERE (owner_id = $id) AND (deleted = 'no')");
?>
<div class="header">
    <div class="contain clearfix">

        <a href=""><img id = "logos" src='images/logo.png' width="150" height="50" /></a>
        <nav>
            <a href="index.php?id<?echo $id;?>"><div class="menu"><? echo $row_new["full_name"] ?></div></a>
            <a href="settings.php"><div class="menu">Настройки</div></a>
            <a href="support.php"><div class="menu">Помощь</div></a>
            <a href="logout.php"><div class="menu">Выйти</div></a>
        </nav>
    </div>
  </div>