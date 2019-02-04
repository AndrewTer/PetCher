<?
$order_id = clear_string($_GET["id"]);
$action = $_GET["action"];
    if (isset($action))
    {
        switch ($action) {
            case 'delete':
            $delete = mysql_query("UPDATE orders SET deleted='yes' WHERE id=".$order_id);
            break;
        }
    }
    
$sort = $_GET["sort"];
        switch($sort){
            case 'all-orders':
                $sort = " orders.id DESC";
                $sort_name = 'Все';
            break;
            case 'performed':
                $sort = " orders.kind = 'performed' DESC";
                $sort_name = 'Выполненные';
            break;
            case 'current':
                $sort = " orders.kind = 'current' DESC";
                $sort_name = 'Текущие';
            break;
            default:
                $sort = " orders.id DESC";
                $sort_name = 'Все';
            break;
        }

if ($_POST["add_new_order"])
{
        mysql_query("INSERT INTO orders (owner_id, pet_id, date_out, date_in, cost, other_information, kind, deleted)
                        VALUES (
                            '".$id."',
                            '".$_POST["select-pet-for-add-order"]."',
                            '".$_POST["date_out_new_order"]."',
                            '".$_POST["date_in_new_order"]."',
                            '".$_POST["cost_new_order"]."',
                            '".$_POST["discription_new_order"]."',
                            'current',
                            'no'
                        )");
}

?>
<div class="main-part-body">
            <div class="orders-part">
                <div id="block-title-and-sorting">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Мои заказы</p>
                    </div>
                    <div class="block-title-and-sorting-right">
                        <ul id="options-list">
                            <li>Сортировать</li>
                            <li><a id="select-links" href="#"><? echo $sort_name; ?></a>
                            <ul id="list-links-sort">
                                <a href="index.php?sort=all-orders"><li><strong>Все</strong></li></a>
                                <a href="index.php?sort=current"><li><strong>Текущие</strong></li></a>
                                <a href="index.php?sort=performed"><li><strong>Выполненные</strong></li></a>
                            </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr />
                
                <div class="block-add-order">
                    Добавить новый заказ <sub>﹀</sub>
                </div>
                <div class="block-add-order-info">
                    <form enctype="multipart/form-data" method="post">
                        <?
                            $current_date_result = mysql_query("SELECT DATE(NOW())");
                            $row_current_date_result = mysql_fetch_array($current_date_result);
                        ?>
                        <p class="add-order">Даты: с <input type="date" id="dates_new_order" name="date_out_new_order" value="<?echo $row_current_date_result["DATE(NOW())"]; ?>" min="<?echo $row_current_date_result["DATE(NOW())"]; ?>" /> по <input type="date" id="dates_new_order" name="date_in_new_order" value="<?echo $row_current_date_result["DATE(NOW())"]; ?>" min="<?echo $row_current_date_result["DATE(NOW())"]; ?>" /></p>
                        <p class="add-order">Цена:&emsp; <input type="number" id="cost_new_order" name="cost_new_order" min="100" max="1000000" value="1000" placeholder="100-1000000" /> руб</p>
                        <p class="add-order">Краткое описание:</p><textarea id="discription_new_order" name="discription_new_order" maxlength="500" cols="93" rows="10" placeholder="До 500 символов"></textarea>
                        <p class="add-order">Выбор питомца:</p>
                        <?
                            $pets_list_result = mysql_query("SELECT id, name FROM pets WHERE (owner_id = ".$id.") AND (deleted='no')");
                            if (mysql_num_rows($pets_list_result) == null)
                            {
                                echo '<p class="add-order" style="text-align: center;">У вас нет ни одного питомца!</p>';
                            }else{
                                $row_pets_list_result = mysql_fetch_array($pets_list_result);
                                $count_actual_pet = 0;
                                echo '
                                    <div class="select-pet-add-order-main">';
                                do {
                                    $count_actual_pet++;
                                    if ($count_actual_pet == 1)
                                    {
                                        echo '
                                        <input type="radio" class="select-pet-add-order" id="'.$row_pets_list_result["id"].'" name="select-pet-for-add-order" value="'.$row_pets_list_result["id"].'" checked>
                                        <label for="'.$row_pets_list_result["id"].'">'.$row_pets_list_result["name"].'</label>
                                        ';
                                    }else
                                    {
                                        echo '
                                        <input type="radio" class="select-pet-add-order" id="'.$row_pets_list_result["id"].'" name="select-pet-for-add-order" value="'.$row_pets_list_result["id"].'">
                                        <label for="'.$row_pets_list_result["id"].'">'.$row_pets_list_result["name"].'</label>
                                        ';
                                    }
                                
                                 }while ($row_pets_list_result = mysql_fetch_array($pets_list_result));   
                                 
                                 echo '
                                    </div>
                                    <p align="center" class="add-order"><input type="submit" id="submit_add_new_order" name="add_new_order" value="Добавить" /></p>';
                            }
                        ?>
                    </form>
                </div>
                
                <?
                    $result_orders = mysql_query("SELECT orders.id AS order_id, orders.owner_id AS owner_id, orders.deleted AS order_deleted, pets.id AS pet_id, date_out, date_in, cost, pets.name AS pet_name, pets.kind as pet_kind, pets.breed AS pet_breed, pets.sex AS pet_sex, pets.weight AS pet_weight, pets.growth AS pet_growth, pets.photo AS avatar, orders.other_information AS about_order, pets.other_information AS about_pet, orders.kind AS order_kind FROM orders, pets WHERE (orders.owner_id = ".$id.") AND (orders.owner_id=pets.owner_id) AND (orders.pet_id=pets.id) ORDER BY $sort");
                    if (mysql_num_rows($result_orders) == null)
                    {
                        echo '<hr /><p class="not-order">Вы пока не создали ни одного заказа</p>';
                    }else
                    {
                        $row_orders = mysql_fetch_array($result_orders);
                        do{
                            if (($row_orders["order_kind"]=="current") AND ($row_orders["order_deleted"]=="no")) 
                            {
                                echo '
                            <hr />
                            <div class="current-order">
                                    <div class="ribbon-wrapper-blue">
                                        <div class="ribbon-blue">Текущий</div>
                                    </div>
                                    
                                    <div class="left-part-order-list">
                                        <div id="avatar-pet"><a href="pets.php?petnum='.$row_orders["pet_id"].'">';
                                            if($row_orders["avatar"]!="no" && file_exists("users/".$row_new["folder"]."/".$row_orders["avatar"]))
                                            {
                                                $img_path = 'users/'.$row_new["folder"].'/'.$row_orders["avatar"];
                                                echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" />';
                                            }else
                                            {
                                                echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                                            }
                                    echo '</a></div>
                                    </div>
                                    <div class="right-part-order-list">
                                        <p class="order-about">'.$row_orders["about_order"].'</p>
                                        <p class="order-about">Даты: с '.$row_orders["date_out"].' до '.$row_orders["date_in"].'</p>
                                        <p class="order-about">Животное: '.$row_orders["pet_kind"].' ('.$row_orders["pet_sex"].')</p>
                                        <p class="order-about">Кличка: '.$row_orders["pet_name"].'</p>
                                        <p class="order-about">Порода: '.$row_orders["pet_breed"].'</p>
                                        <p class="order-about">Рост | Вес: '.$row_orders["pet_growth"].' м | '.$row_orders["pet_weight"].' кг</p>
                                        <p class="order-cost">Цена: '.$row_orders["cost"].' руб</p>
                                        <p class="delete-order-links" ><a class="delete-current-order" rel="index.php?id='.$row_orders["order_id"].'&action=delete" >Удалить | &#10008;</a></p>
                                    </div>
                                    <div class="clear"></div>
                            </div>
                            ';
                            } else if ($row_orders["order_kind"]=="performed" AND ($row_orders["order_deleted"]=="no"))
                            {
                                echo '
                            <hr />
                            <div class="current-order">
                                    <div class="ribbon-wrapper-green">
                                        <div class="ribbon-green">Выполнен</div>
                                    </div>
                                    <div class="left-part-order-list">
                                        <div id="avatar-pet"><a href="pets.php?petnum='.$row_orders["pet_id"].'">';
                                            if($row_orders["avatar"]!="no" && file_exists("users/".$row_new["folder"]."/".$row_orders["avatar"]))
                                            {
                                                $img_path = 'users/'.$row_new["folder"].'/'.$row_orders["avatar"];
                                                echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" />';
                                            }else
                                            {
                                                echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                                            }
                                    echo '</a></div>
                                    </div>
                                    <div class="right-part-order-list">
                                        <p class="order-about">'.$row_orders["about_order"].'</p>
                                        <p class="order-about">Даты: с '.$row_orders["date_out"].' до '.$row_orders["date_in"].'</p>
                                        <p class="order-about">Животное: '.$row_orders["pet_kind"].' ('.$row_orders["pet_sex"].')</p>
                                        <p class="order-about">Кличка: '.$row_orders["pet_name"].'</p>
                                        <p class="order-about">Порода: '.$row_orders["pet_breed"].'</p>
                                        <p class="order-about">Рост | Вес: '.$row_orders["pet_growth"].' м | '.$row_orders["pet_weight"].' кг</p>
                                        <p class="order-cost">Цена: '.$row_orders["cost"].' руб</p>
                                        <p class="delete-order-links" ><a class="delete-current-order" rel="index.php?id='.$row_orders["order_id"].'&action=delete" >Удалить | &#10008;</a></p>
                                    </div>
                                    <div class="clear"></div>
                            </div>
                            ';
                            }
                        }while ($row_orders = mysql_fetch_array($result_orders));
                    }
                ?>
            </div> 
</div>
