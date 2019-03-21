<?
$order_id = clear_string($_GET["id"]);
$action = $_GET["action"];
    if (isset($action))
    {
        switch ($action) {
            case 'delete':
            $delete = mysql_query("DELETE FROM responses WHERE (order_id=".$order_id.") AND (sitter_id=".$id.") AND (kind='no')");
            break;
        }
    }
    
$sort = $_GET["sort"];
        switch($sort){
            case 'all-responses':
                $sort = " orders.id DESC";
                $sort_name = 'Все';
            break;
            case 'approved':
                $sort = " responses.kind = 'yes' DESC";
                $sort_name = 'Одобренные';
            break;
            case 'denied':
                $sort = " responses.kind = 'no' DESC";
                $sort_name = 'Отказанные';
            break;
            default:
                $sort = " responses.id DESC";
                $sort_name = 'Все';
            break;
        }
        
$result_responses = mysql_query("SELECT orders.id AS order_id, orders.owner_id AS owner_id, orders.deleted AS order_deleted, pets.id AS pet_id, date_out, date_in, cost, pets.name AS pet_name, pets.kind as pet_kind, pets.breed AS pet_breed, pets.sex AS pet_sex, pets.weight AS pet_weight, pets.growth AS pet_growth, pets.photo AS avatar, orders.other_information AS about_order, pets.other_information AS about_pet, orders.kind AS order_kind, users.city AS city, users.full_name AS full_name_owner, users.folder AS owner_folder, responses.kind AS response_kind 
                                FROM responses, orders, pets, users 
                                WHERE (responses.sitter_id = '".$id."') AND (orders.owner_id=pets.owner_id) AND (orders.pet_id=pets.id) AND (users.id=orders.owner_id) AND (responses.order_id=orders.id) AND (orders.deleted='no') AND (orders.kind='current') ORDER BY $sort");  
?>
<div class="main-part-body">
            <div class="responses-part">
                <div id="block-title-and-sorting">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Ответы на мои заявки</p>
                    </div>
                    <div class="block-title-and-sorting-right">
                        <ul id="options-list">
                            <li>Ответов: <? if ($count_all_responses>0) { echo $count_all_responses; }else{ echo 'нет';} ?> | Сортировать</li>
                            <li><a id="select-links" href="#"><? echo $sort_name; ?></a>
                            <ul id="list-links-sort">
                                <a href="responses.php?sort=all-responses"><li><strong>Все</strong></li></a>
                                <a href="responses.php?sort=approved"><li><strong>Одобренные</strong></li></a>
                                <a href="responses.php?sort=denied"><li><strong>Отказанные</strong></li></a>
                            </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <?
                    if (mysql_num_rows($result_responses) == null)
                    {
                        echo '<hr /><p class="not-responses">Вы пока не получили ни одного ответа</p>';
                    }else
                    {
                        $row_responses = mysql_fetch_array($result_responses);
                        do{     
                            if ($row_responses["response_kind"]=="yes") 
                            {
                                $result_number_owner = mysql_query("SELECT phone_number AS number FROM users WHERE (id=".$row_responses["owner_id"].")");
                                if (mysql_num_rows($result_number_owner) == null)
                                {
                                    $number_owner = "отсутствует";
                                }else
                                {
                                    $row_number_owner = mysql_fetch_array($result_number_owner);
                                    $number_owner = $row_number_owner["number"];
                                }
                                echo '
                                    <hr />
                                    <div class="current-order" style="display: block;">
                                            <div class="ribbon-wrapper-blue">
                                                <div class="ribbon-blue">Одобрено</div>
                                            </div>
                                            
                                            <div class="left-part-response-list">
                                                <div id="avatar-pet"><a>';
                                                    if($row_responses["avatar"]!="no" && file_exists("users/".$row_responses["owner_folder"]."/".$row_responses["avatar"]))
                                                    {
                                                        $img_path = 'users/'.$row_responses["owner_folder"].'/'.$row_responses["avatar"];
                                                        echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" />';
                                                    }else
                                                    {
                                                        echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                                                    }
                                            echo '</a></div>
                                            </div>
                                            <div class="right-part-response-list">
                                                <p class="order-about">Заказчик: <a id="order-about-response-username" href="user.php?id='.$row_responses["owner_id"].'">'.$row_responses["full_name_owner"].'</a></p>
                                                <p class="order-about"><a id="order-about-search-username-page" href="user.php?id='.$row_responses["owner_id"].'">(Перейти на страницу пользователя)</a></p>
                                                <p class="order-cost">Моб.номер: '.$number_owner.'</p>
                                                <p class="order-about">'.$row_responses["about_order"].'</p>';
                                                if ($row_responses["city"]==null)
                                                {
                                                    echo '<p class="order-about">Город: не указан</p>';
                                                }else
                                                {
                                                    echo '<p class="order-about">Город: '.$row_responses["city"].'</p>';
                                                }
                                                echo '<p class="order-about">Даты: с '.$row_responses["date_out"].' до '.$row_responses["date_in"].'</p>
                                                <p class="order-about">Животное: '.$row_responses["pet_kind"].' ('.$row_responses["pet_sex"].')</p>
                                                <p class="order-about">Кличка: '.$row_responses["pet_name"].'</p>
                                                <p class="order-about">Порода: '.$row_responses["pet_breed"].'</p>
                                                <p class="order-about">Рост | Вес: '.$row_responses["pet_growth"].' м | '.$row_responses["pet_weight"].' кг</p>
                                                <p class="order-cost">Цена: '.$row_responses["cost"].' руб</p>
                                            </div>
                                        <div class="clear"></div>
                                    </div>';
                            } else if ($row_responses["response_kind"]=="no")
                            {
                                echo '
                            <hr />
                            <div class="current-response">
                                    <div class="ribbon-wrapper-red">
                                        <div class="ribbon-red">Отказано</div>
                                    </div>
                                    <div class="left-part-response-list">
                                        <div id="avatar-pet"><a>';
                                            if($row_responses["avatar"]!="no" && file_exists("users/".$row_responses["owner_folder"]."/".$row_responses["avatar"]))
                                            {
                                                $img_path = 'users/'.$row_responses["owner_folder"].'/'.$row_responses["avatar"];
                                                echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" />';
                                            }else
                                            {
                                                echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                                            }
                                    echo '</a></div>
                                    </div>
                                    <div class="right-part-response-list">
                                        <p class="order-about">Заказчик: <a id="order-about-response-username" href="user.php?id='.$row_responses["owner_id"].'">'.$row_responses["full_name_owner"].'</a></p>
                                        <p class="order-about"><a id="order-about-search-username-page" href="user.php?id='.$row_responses["owner_id"].'">(Перейти на страницу пользователя)</a></p>
                                        <p class="order-about">'.$row_responses["about_order"].'</p>';
                                        if ($row_responses["city"]==null)
                                        {
                                            echo '<p class="order-about">Город: не указан</p>';
                                        }else
                                        {
                                            echo '<p class="order-about">Город: '.$row_responses["city"].'</p>';
                                        }
                                        echo '<p class="order-about">Даты: с '.$row_responses["date_out"].' до '.$row_responses["date_in"].'</p>
                                        <p class="order-about">Животное: '.$row_responses["pet_kind"].' ('.$row_responses["pet_sex"].')</p>
                                        <p class="order-about">Кличка: '.$row_responses["pet_name"].'</p>
                                        <p class="order-about">Порода: '.$row_responses["pet_breed"].'</p>
                                        <p class="order-about">Рост | Вес: '.$row_responses["pet_growth"].' м | '.$row_responses["pet_weight"].' кг</p>
                                        <p class="order-cost">Цена: '.$row_responses["cost"].' руб</p>
                                        <p class="delete-order-links" ><a class="delete-current-order" rel="responses.php?id='.$row_responses["order_id"].'&action=delete" >Удалить | &#10008;</a></p>
                                    </div>
                                    <div class="clear"></div>
                            </div>';
                            }
                        }while ($row_responses = mysql_fetch_array($result_responses));
                    }
                ?>
            </div> 
</div>