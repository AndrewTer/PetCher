<?php
defined('mypetcher') or header("Location: ../403.php");
echo $_POST["out_date_parameter"].", ".$_POST["in_date_parameter"].", ".$_POST["cost_parameter"].", ".$_POST["description_parameter"].", ".$_POST["order_id_ch_parameter"];
if(isset($_POST["out_date_parameter"]) && isset($_POST["in_date_parameter"]) && isset($_POST["order_id_ch_parameter"]) && strlen($_POST["out_date_parameter"])>0 && strlen($_POST["in_date_parameter"])>0 && strlen($_POST["order_id_ch_parameter"])>0)
{
        require_once(realpath('../includes/connection.php'));
        $out_date_order= $_POST['out_date_parameter']; 
        $in_date_order = $_POST['in_date_parameter'];
        $cost_order = $_POST['cost_parameter'];
        $description_order = $_POST['description_parameter'];
        $order_id_ch_order = $_POST['order_id_ch_parameter'];
        
        //Флажок для ошибок
        $check = true;
        
        $update_current_order = "UPDATE orders 
                                 SET date_out = '".$out_date_order."',
                                     date_in = '".$in_date_order."',
                                     cost = ".$cost_order.", 
                                     other_information = '".$description_order."'
                                 WHERE (id = ".$order_id_ch_order.")";

        mysql_query($update_current_order) or $check = false;
        
        echo $check;
}
?>