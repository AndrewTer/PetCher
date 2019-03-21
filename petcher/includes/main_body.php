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
                    $result_orders = mysql_query("SELECT orders.id AS order_id, orders.owner_id AS owner_id, orders.deleted AS order_deleted, pets.id AS pet_id, date_out, date_in, cost, pets.name AS pet_name, pets.kind as pet_kind, pets.breed AS pet_breed, pets.sex AS pet_sex, pets.weight AS pet_weight, pets.growth AS pet_growth, pets.photo AS avatar, orders.other_information AS about_order, pets.other_information AS about_pet, orders.kind AS order_kind, users.city AS city FROM orders, pets, users WHERE (orders.owner_id = ".$id.") AND (orders.owner_id=pets.owner_id) AND (orders.pet_id=pets.id) AND (users.id=orders.owner_id) AND (orders.deleted='no') ORDER BY $sort");
                    if (mysql_num_rows($result_orders) == null)
                    {
                        echo '<hr /><p class="not-order">Вы пока не создали ни одного заказа</p>';
                    }else
                    {
                        $row_orders = mysql_fetch_array($result_orders);
                        do{
                            //Сравнение даты окончания заказа с текущей
                            $result_date=(strtotime($row_orders["date_in"])<strtotime(date('y-m-j'))); 
                            if ($result_date==true)
                            {
                                $check_responses_order_for_ch = mysql_query("SELECT * FROM responses WHERE (order_id = ".$row_orders["order_id"].") AND (kind='yes')");
                                if (mysql_num_rows($check_responses_order_for_ch) == null)
                                {
                                    $change_status = mysql_query("UPDATE orders SET kind='performed' WHERE id=".$row_orders["order_id"]);
                                    $row_orders["order_kind"]="performed";
                                }
                            }
                            
                            if (($row_orders["order_kind"]=="current") AND ($row_orders["order_deleted"]=="no")) 
                            {
                                $check_responses_order = mysql_query("SELECT * FROM responses WHERE (order_id = ".$row_orders["order_id"].") AND (kind='yes')");
                                if (mysql_num_rows($check_responses_order) == null)
                                {
                                                echo '
                                    <hr />
                                    <div class="current-order" id="curor'.$row_orders["order_id"].'ch" style="display: block;">
                                            <div class="ribbon-wrapper-yellow">
                                                <div class="ribbon-yellow">В поиске</div>
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
                                                <p class="order-about">'.$row_orders["about_order"].'</p>';
                                                if ($row_orders["city"]==null)
                                                {
                                                    echo '<p class="order-about">Город: не указан</p>';
                                                }else
                                                {
                                                    echo '<p class="order-about">Город: '.$row_orders["city"].'</p>';
                                                }
                                                echo '<p class="order-about">Даты: с '.$row_orders["date_out"].' до '.$row_orders["date_in"].'</p>
                                                <p class="order-about">Животное: '.$row_orders["pet_kind"].' ('.$row_orders["pet_sex"].')</p>
                                                <p class="order-about">Кличка: '.$row_orders["pet_name"].'</p>
                                                <p class="order-about">Порода: '.$row_orders["pet_breed"].'</p>
                                                <p class="order-about">Рост | Вес: '.$row_orders["pet_growth"].' м | '.$row_orders["pet_weight"].' кг</p>
                                                <p class="order-about">Остальная информация: ';
                                                if ($row_orders["about_pet"]==null) 
                                                {
                                                    echo 'отсутствует';
                                                } else {
                                                    echo $row_orders["about_pet"];
                                                }
                                                echo '</p>
                                                <p class="order-cost">Цена: '.$row_orders["cost"].' руб</p>';           
                        ?>                    
                                                <table id="del-and-cur-current-order">
                                                    <tr >
                                                        <td width=auto;><p class="change-order-links" ><a class="change-current-order" onclick="event.preventDefault();SwapEditOrders('curor<? echo $row_orders["order_id"]; ?>ch','curor<? echo $row_orders["order_id"]; ?>chf');" id="changemycurrentorder" >Редактировать</a></p></td>
                                                        <td width=auto;><p class="delete-order-links-with-ch" ><a class="delete-current-order" rel="index.php?id=<? echo $row_orders["order_id"].'&action=delete'; ?>" >Удалить | &#10008;</a></p></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="clear"></div>
                        <?
                                            echo '
                                    </div>
                                    <div id="curor'.$row_orders["order_id"].'chf" style="display: none;">';
                        ?>
                                    <script type="text/javascript">
                                        function submitchangecurrentorder(name) {
                                            var out_date = document.forms[name].elements["date_out_ch_order"].value;
                                            var in_date = document.forms[name].elements["date_in_ch_order"].value;
                                            var cost = document.forms[name].elements["cost_change_current_order"].value;
                                            var description = document.forms[name].elements["description_change_current_order"].value;
                                            var order_id_ch = document.forms[name].elements["current_order_id_for_change"].value;
                                            
                                            var updatecurorder = new Function(changecurrentorderinsearch(out_date, in_date, cost, description, order_id_ch));
                                            updatecurorder();
                                        }
                                    </script>
                                    <script type="text/javascript" src="js/ajax-scripts.js"></script>   
                            
                                    <form id="form-change-cur-order-<?echo $row_orders["order_id"];?>" enctype="multipart/form-data" method="post">
                                        <?
                                            $current_date_result = mysql_query("SELECT DATE(NOW())");
                                            $row_current_date_result = mysql_fetch_array($current_date_result);
                                            $current_order_ch_id = $row_orders["order_id"];
                                        ?>
                                        <input type="hidden" id="current_order_id_for_change" value="<?echo $row_orders["order_id"]; ?>" />
                                        <p class="add-order">Даты: с <input type="date" id="date_out_ch_order" name="date_out_change_current_order" value="<?echo $row_orders["date_out"]; ?>" min="<?echo $row_current_date_result["DATE(NOW())"]; ?>" /> по <input type="date" id="date_in_ch_order" name="date_in_change_current_order" value="<?echo $row_orders["date_in"]; ?>" min="<?echo $row_current_date_result["DATE(NOW())"]; ?>" /></p>
                                        <p class="add-order">Цена:&emsp; <input type="number" id="cost_change_current_order" name="cost_change_current_order" min="100" max="1000000" value="<?echo $row_orders["cost"]; ?>" placeholder="100-1000000" /> руб</p>
                                        <p class="add-order">Краткое описание:</p><textarea id="description_change_current_order" name="description_change_current_order" maxlength="500" cols="93" rows="10" placeholder="До 500 символов"><?echo $row_orders["about_order"]; ?></textarea>
                                        <table id="change-and-cancel-current-order">
                                            <tr >
                                                <td width=auto;><p class="save-order-links" ><input type="button" onclick="submitchangecurrentorder('form-change-cur-order-<?echo $row_orders["order_id"];?>')" class="save-current-order" value="Сохранить" /></p></td>
                                                <td width=auto;><p class="cancel-order-links-with-ch" ><a class="cancel-current-order" onclick="event.preventDefault();SwapEditOrders('curor<? echo $row_orders["order_id"]; ?>ch','curor<? echo $row_orders["order_id"]; ?>chf');" >Отмена</a></p></td>
                                            </tr>
                                        </table>
                                    </form>
                        <?
                                echo '</div>
                                    ';
                                }else
                                {
                                    $row_check_responses_order = mysql_fetch_array($check_responses_order);
                        ?>
                                <script type="text/javascript">
                                    function submitcompletecurrentorder(name) {
                                            var sitter = <?echo $row_check_responses_order["sitter_id"];?>;
                                            var author = <?echo $id;?>;       
                                            var order = <?echo $row_orders["order_id"];?>;                                                                           
                                            var text_review = document.forms[name].elements["feedback-end-order"].value;
                                            var rating = document.forms[name].elements["rating_end_order"].value;
                                            
                                            var addnewreview = new Function(completecurrentorderfornewreview(sitter, author, order, text_review, rating));
                                            addnewreview();
                                     }
                                     
                                    $(function(){
                                        /* Открытие модального окна завершения текущего заказа */
                                        $('a#endcurrent<? echo $row_orders["order_id"]; ?>order<? echo $row_check_responses_order["sitter_id"]; ?>').click( function(event){
                                    		event.preventDefault();
                                    		$('#overlay_end_<? echo $row_orders["order_id"]; ?>_cur_<? echo $row_check_responses_order["sitter_id"]; ?>').fadeIn(400,
                                    		 	function(){ 
                                    				$('#modal_form_end_<? echo $row_orders["order_id"]; ?>_cur_<? echo $row_check_responses_order["sitter_id"]; ?>') 
                                    					.css('display', 'block')
                                    					.animate({opacity: 1, top: '50%'}, 200);
                                    		});
                                    	});
                                        
                                    	/* Зaкрытие мoдaльнoгo oкнa*/
                                    	$('#modal_close_end_<? echo $row_orders["order_id"]; ?>_cur_<? echo $row_check_responses_order["sitter_id"]; ?>, #overlay_end_<? echo $row_orders["order_id"]; ?>_cur_<? echo $row_check_responses_order["sitter_id"]; ?>').click( function(){ // лoвим клик пo крестику или пoдлoжке
                                    		$('#modal_form_end_<? echo $row_orders["order_id"]; ?>_cur_<? echo $row_check_responses_order["sitter_id"];?>')
                                    			.animate({opacity: 0, top: '45%'}, 200,
                                    				function(){
                                    					$(this).css('display', 'none');
                                    					$('#overlay_end_<? echo $row_orders["order_id"]; ?>_cur_<? echo $row_check_responses_order["sitter_id"]; ?>').fadeOut(400);
                                    				}
                                    			);
                                    	});
                                     });
                                </script>
                                <script type="text/javascript" src="js/ajax-scripts.js"></script>
                        <?
                                    echo '
                                    <hr />
                                    <div class="modal_form_end_cur_ord" id="modal_form_end_'.$row_orders["order_id"].'_cur_'.$row_check_responses_order["sitter_id"].'">
                                        <form id="form-complete-cur-order-'.$row_orders["order_id"].'" enctype="multipart/form-data" method="post">
                                            <span class="modal_close_end_current_order" id="modal_close_end_'.$row_orders["order_id"].'_cur_'.$row_check_responses_order["sitter_id"].'">X</span>
                                            <p id="title-end-cur-order">Завершение заказа</p>
                                            <hr />
                                            <p class="end-cur-ord-p">Ваш отзыв:</p><textarea id="feedback-end-order" name="feedback-end-order" maxlength="1000" cols="93" rows="10" placeholder="До 1000 символов"></textarea>
                                            <p class="end-cur-ord-p">Ваша оценка:</p>
                                            <fieldset id="rating_current_review_for_end_current_order" class="rating_current_review_for_end_current_order">
                                                <input type="radio" id="star5'.$row_orders["order_id"].'" name="rating_end_order" value="5" /><label for="star5'.$row_orders["order_id"].'" title="Отлично!">5 stars</label>
                                                <input type="radio" id="star4'.$row_orders["order_id"].'" name="rating_end_order" value="4" /><label for="star4'.$row_orders["order_id"].'" title="Хорошо">4 stars</label>
                                                <input type="radio" id="star3'.$row_orders["order_id"].'" name="rating_end_order" value="3" /><label for="star3'.$row_orders["order_id"].'" title="Неплохо">3 stars</label>
                                                <input type="radio" id="star2'.$row_orders["order_id"].'" name="rating_end_order" value="2" /><label for="star2'.$row_orders["order_id"].'" title="Плохо">2 stars</label>
                                                <input type="radio" id="star1'.$row_orders["order_id"].'" name="rating_end_order" value="1" /><label for="star1'.$row_orders["order_id"].'" title="Ужасно!">1 star</label>
                                            </fieldset>
                                            <br />';
                          ?>                                            
                                            <p class="create-new-review-link" ><input type="submit" onclick="event.preventDefault();submitcompletecurrentorder('form-complete-cur-order-<?echo $row_orders["order_id"];?>')" class="create-new-review-link-a" id="complete_current_order_for_new_rev" name="complete_current_order_for_new_rev" value="Завершить заказ" /></p>
                          <?
                                    echo '
                                        </form>
                                    </div>
                                    <div class="overlay_end_current_order" id="overlay_end_'.$row_orders["order_id"].'_cur_'.$row_check_responses_order["sitter_id"].'"></div>
                                    
                                    
                                    <div class="current-order" id="curor'.$row_orders["order_id"].'ch" style="display: block;">
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
                                                <p class="order-about">'.$row_orders["about_order"].'</p>';
                                                if ($row_orders["city"]==null)
                                                {
                                                    echo '<p class="order-about">Город: не указан</p>';
                                                }else
                                                {
                                                    echo '<p class="order-about">Город: '.$row_orders["city"].'</p>';
                                                }
                                                echo '<p class="order-about">Даты: с '.$row_orders["date_out"].' до '.$row_orders["date_in"].'</p>
                                                <p class="order-about">Животное: '.$row_orders["pet_kind"].' ('.$row_orders["pet_sex"].')</p>
                                                <p class="order-about">Кличка: '.$row_orders["pet_name"].'</p>
                                                <p class="order-about">Порода: '.$row_orders["pet_breed"].'</p>
                                                <p class="order-about">Рост | Вес: '.$row_orders["pet_growth"].' м | '.$row_orders["pet_weight"].' кг</p>
                                                <p class="order-about">Остальная информация: ';
                                                    if ($row_orders["about_pet"]==null) 
                                                    {
                                                        echo 'отсутствует';
                                                    } else {
                                                        echo $row_orders["about_pet"];
                                                    }
                                                    echo '</p>
                                                <p class="order-cost">Цена: '.$row_orders["cost"].' руб</p>';           
                        ?>                    
                                                <p class="end-order-links" ><a class="end-current-order" id="endcurrent<? echo $row_orders["order_id"]; ?>order<? echo $row_check_responses_order["sitter_id"];?>" >Завершить заказ</a></p>
                                            </div>
                                            <div class="clear"></div>
                                            <hr width=80% />
                                            <p class="text-for-current-order-sitter">Текущий ситтер</p>
                        <?
                                            $result_cur_order_sitter = mysql_query("SELECT * FROM users WHERE id=".$row_check_responses_order["sitter_id"]);
                                            {
                                                $row_result_cur_order_sitter = mysql_fetch_array($result_cur_order_sitter);
                                                echo '
                                                <div id="current-order-sitter">
                                                    <div class="left-part-current-order-sitter">
                                                        <div id="sitter-current-order-circle">';
                                                            if($row_requests["sitter_photo"]!="no" && file_exists("users/".$row_requests["sitter_folder"]."/".$row_requests["sitter_photo"]))
                                                            {
                                                                $img_path_sitter = 'users/'.$row_result_cur_order_sitter["folder"].'/'.$row_result_cur_order_sitter["photo"];
                                                                echo '<a href="user.php?id='.$row_result_cur_order_sitter["id"].'"><img class="image-avatar" src="'.$img_path_sitter.'" alt="" width="100%" /></a>';
                                                            }else
                                                            {
                                                                echo '<a href="user.php?id='.$row_result_cur_order_sitter["id"].'"><img class="image-avatar" src="images/nophoto.jpg" width="100%" /></a>';
                                                            }
                                                            

                                                    echo '</div>  
                                                    </div>
                                                    
                                                    <div class="right-part-current-order-sitter">
                                                        <p class="user-about-search"><a id="user-about-search-username" href="user.php?id='.$row_result_cur_order_sitter["id"].'">'.$row_result_cur_order_sitter["full_name"].'</a></p>';
                                            
                                                        $current_time_result = mysql_query("SELECT SUBTIME(CURTIME(), '0:2:0') AS twomin, DATE(NOW());");
                                                        $row_current_time_result = mysql_fetch_array($current_time_result);
                                                        
                                                        $loggedTime=$row_current_time_result["twomin"];	//2 minutes
                                                        $loggedDate=$row_current_time_result["DATE(NOW())"];
                                                        if(($row_result_cur_order_sitter["status"]>$loggedTime) && ($row_result_cur_order_sitter["last_visit"]==$loggedDate))
                                                        {
                                                        	echo '<p class="user-about-search" id="online-status">Статус: онлайн</p>';
                                                        }
                                                        else
                                                        {
                                                        	echo '<p class="user-about-search" id="offline-status">Статус: оффлайн</p>';
                                                        }
                                                        
                                                    echo '
                                                        <p class="user-about-search">Рейтинг: '.$row_result_cur_order_sitter["rating"].' / 5</p>
                                                        <p class="user-about-search">Моб.номер: '.$row_result_cur_order_sitter["phone_number"].'</p>
                                                    </div>
                                                    
                                                    
                                                    <div class="clear"></div>
                                                </div>';
                                            }
                        
                        
                        
                                            echo '
                                    </div>
                                    ';
                                }
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
                                        <p class="order-about">'.$row_orders["about_order"].'</p>';
                                        if ($row_orders["city"]==null)
                                        {
                                            echo '<p class="order-about">Город: не указан</p>';
                                        }else
                                        {
                                            echo '<p class="order-about">Город: '.$row_orders["city"].'</p>';
                                        }
                                        echo '<p class="order-about">Даты: с '.$row_orders["date_out"].' до '.$row_orders["date_in"].'</p>
                                        <p class="order-about">Животное: '.$row_orders["pet_kind"].' ('.$row_orders["pet_sex"].')</p>
                                        <p class="order-about">Кличка: '.$row_orders["pet_name"].'</p>
                                        <p class="order-about">Порода: '.$row_orders["pet_breed"].'</p>
                                        <p class="order-about">Рост | Вес: '.$row_orders["pet_growth"].' м | '.$row_orders["pet_weight"].' кг</p>
                                        <p class="order-about">Остальная информация: ';
                                                if ($row_orders["about_pet"]==null) 
                                                {
                                                    echo 'отсутствует';
                                                } else {
                                                    echo $row_orders["about_pet"];
                                                }
                                                echo '</p>
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
