<?
    $result_requests = mysql_query("
        SELECT orders.id AS order_id, orders.owner_id AS owner_id, orders.date_out AS date_out, orders.date_in AS date_in, orders.cost AS order_cost, orders.other_information AS order_about,
                pets.id AS pet_id, pets.name AS pet_name, pets.kind AS pet_kind, pets.breed AS pet_breed, pets.sex AS pet_sex, pets.weight AS pet_weight, pets.growth AS pet_growth, pets.other_information AS pet_info, pets.photo AS pet_photo,
                users.id AS sitter_id, users.photo AS sitter_photo, users.folder AS sitter_folder, users.rating AS sitter_rating

        FROM request, orders, pets, users
        WHERE (orders.id = request.order_id) AND (orders.deleted = 'no') AND (orders.kind = 'current') AND (orders.owner_id = ".$id.") AND (orders.pet_id = pets.id) AND (request.sitter_id = users.id) AND (users.deleted = 'no') AND (request.deleted = 'no') AND (pets.deleted = 'no')
    ");
    $count_user_requests = mysql_num_rows($result_requests);
?>
<div class="main-part-body">
            <div class="requests-part">
                <div id="block-title-and-sorting">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Заявки от ситтеров</p>
                    </div>
                    <div class="block-title-and-sorting-right">
                        <ul id="options-list">
                            <li>Заявок: <?echo $count_user_requests;?></li>
                        </ul>
                    </div>
                </div>
                
                <?
                    if (mysql_num_rows($result_requests) == null)
                    {
                        echo '<hr /><p class="not-requests">Ни один ситтер пока ещё не откликнулся на ваши заказы</p>';
                    }else
                    {
                        $row_requests = mysql_fetch_array($result_requests);
                        do{
                            echo '
                            <hr />
                            <div class="current-request">
                                    <div class="left-part-order-list">
                                        <div id="avatar-pet"><a href="pets.php?petnum='.$row_requests["pet_id"].'">';
                                            $request_pet_id = $row_requests["pet_id"];
                                            $result_request_pet_folder = mysql_query("SELECT users.folder FROM users, pets WHERE (pets.owner_id = users.id) AND (pets.id = ".$request_pet_id.")");
                                            $folder_current_pet = mysql_fetch_array($result_request_pet_folder);
                                            $pet_folder = $folder_current_pet[0];
                                            
                                            if($row_requests["pet_photo"]!="no" && file_exists("users/".$pet_folder."/".$row_requests["pet_photo"]))
                                            {
                                                $img_path = 'users/'.$pet_folder.'/'.$row_requests["pet_photo"];
                                                echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" />';
                                            }else
                                            {
                                                echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                                            }
                                    echo '</a></div>
                                    </div>
                                    
                                    <div class="right-part-request-list">
                                        <p class="order-about">'.$row_requests["order_about"].'</p>
                                        <p class="order-about">Даты: с '.$row_requests["date_out"].' до '.$row_requests["date_in"].'</p>
                                        <p class="order-about">Животное: '.$row_requests["pet_kind"].' ('.$row_requests["pet_sex"].')</p>
                                        <p class="order-about">Кличка: '.$row_requests["pet_name"].'</p>
                                        <p class="order-about">Порода: '.$row_requests["pet_breed"].'</p>
                                        <p class="order-about">Рост | Вес: '.$row_requests["pet_growth"].' м | '.$row_requests["pet_weight"].' кг</p>
                                        <p class="order-cost">Цена: '.$row_requests["order_cost"].' руб</p>
                                    </div>
                                    
                                    <div class="sitter-request-part">
                                        ';
                                        echo '<div id="sitter-request-circle">
                                                <div class="fav-rating"><p class="fav-rating-p">'.$row_requests["sitter_rating"].'/10</p></div>';
                    
                                        if($row_requests["sitter_photo"]!="no" && file_exists("users/".$row_requests["sitter_folder"]."/".$row_requests["sitter_photo"]))
                                        {
                                            $img_path_sitter = 'users/'.$row_requests["sitter_folder"].'/'.$row_requests["sitter_photo"];
                                            echo '<a href="user.php?id='.$row_requests["sitter_id"].'"><img class="image-avatar" src="'.$img_path_sitter.'" alt="" width="100%" /></a>';
                                        }else
                                        {
                                            echo '<a href="user.php?id='.$row_requests["sitter_id"].'"><img class="image-avatar" src="images/nophoto.jpg" width="100%" /></a>';
                                        }
                                        
                                        echo '</div>
                                        <table style="margin-left: 10px; margin-right: 10px; table-layout: fixed; width: 200px;">
                                            <tr>
                                                <td style="padding-bottom: 15px; padding-top: 10px; text-align: center; width: 100%; max-width: 100px;" colspan="2"><p class="sitter-request-links" ><a class="sitter-current-request" href="user.php?id='.$row_requests["sitter_id"].'" >Страница ситтера</a></p></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%; text-align: center; "><p class="approve-request-links" ><a class="approve-current-request" rel="" >Одобрить</a></p></td>
                                                <td style="width: 50%; text-align: center;"><p class="refusing-request-links" ><a class="refuse-current-request" rel="" >Отказать</a></p></td>
                                            </tr>
                                            
                                        </table>
                                        
                                    </div>
                                    <div class="clear"></div>
                            </div>
                            ';
                        }while ($row_requests = mysql_fetch_array($result_requests));
                    }
                ?>
            </div> 
</div>
