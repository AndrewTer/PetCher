<?php
echo $_POST["sitter_parameter"].", ".$_POST["author_parameter"].", ".$_POST["order_parameter"].", ".$_POST["text_review_parameter"].", ".$_POST["rating_parameter"];
if(isset($_POST["sitter_parameter"]) && isset($_POST["author_parameter"]) && isset($_POST["rating_parameter"]) && isset($_POST["order_parameter"]) && strlen($_POST["sitter_parameter"])>0 && strlen($_POST["author_parameter"])>0 && strlen($_POST["order_parameter"])>0 && strlen($_POST["rating_parameter"])>0)
{
        require_once(realpath('../includes/connection.php'));
        $sitter_order = $_POST['sitter_parameter']; 
        $author_order = $_POST['author_parameter'];
        $order_order = $_POST["order_parameter"];
        $text_order = $_POST['text_review_parameter'];
        $rating_order = $_POST['rating_parameter'];
        
        //Флажок для ошибок
        $check = true;
        
        $complete_current_order = "INSERT INTO reviews (author_id, sitter_id, mark, text, hidden, deleted) 
                                    VALUES ('".$author_order."', '".$sitter_order."', '".$rating_order."', '".$text_order."', 'no', 'no')"; 
        
        $change_current_order = "UPDATE orders SET kind = 'performed' WHERE (id = ".$order_order.")";
        
        $number_of_completed_orders_and_ratings = mysql_query("SELECT number_of_completed_orders, number_of_ratings FROM users WHERE (id=".$sitter_order.")");
        if (mysql_num_rows($number_of_completed_orders_and_ratings) > 0)
        {
            $row_number_of_completed_orders_and_ratings = mysql_fetch_array($number_of_completed_orders_and_ratings);
            $current_sum_of_completed_orders = $row_number_of_completed_orders_and_ratings["number_of_completed_orders"];
            $current_count_of_completed_orders = $row_number_of_completed_orders_and_ratings["number_of_ratings"];
            $completed_orders_sum = $current_sum_of_completed_orders + $rating_order;
            $completed_orders_count_ratings = $current_count_of_completed_orders + 1;
            
            $completed_rating = round( ($completed_orders_sum/$completed_orders_count_ratings), 1, PHP_ROUND_HALF_UP);
            
            $change_current_sitter = "UPDATE users SET number_of_completed_orders = ".$completed_orders_sum.", number_of_ratings = ".$completed_orders_count_ratings.", rating = ".$completed_rating." WHERE (id = ".$sitter_order.")";
            mysql_query($change_current_sitter) or $check = false;
        }
        
        $deleted_completed_response = "DELETE FROM responses WHERE (order_id = ".$order_order.") AND (sitter_id = ".$sitter_order.") AND (kind = 'yes')";

        mysql_query($complete_current_order) or $check = false;
        mysql_query($change_current_order) or $check = false;
        mysql_query($deleted_completed_response) or $check = false;
        
        echo $check;
}
?>