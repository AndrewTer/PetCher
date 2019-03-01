<div class="main-part-body">
            <div class="orders-favourite-user-part">
                <div id="block-title-and-sorting-all-orders-favourite-user-part">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Заказы</p>
                    </div>
                </div>
                <div class="all-orders-favourite-user-part">
                <?
                    $result_orders_current_user = mysql_query("SELECT orders.id AS order_id, orders.owner_id AS owner_id, orders.deleted AS order_deleted, pets.id AS pet_id, date_out, date_in, cost, pets.name AS pet_name, pets.kind as pet_kind, pets.breed AS pet_breed, pets.sex AS pet_sex, pets.weight AS pet_weight, pets.growth AS pet_growth, pets.photo AS avatar, orders.other_information AS about_order, pets.other_information AS about_pet, orders.kind AS order_kind, users.city AS city FROM orders, pets, users WHERE (orders.owner_id = ".$user_id.") AND (orders.owner_id=pets.owner_id) AND (orders.pet_id=pets.id) AND (users.id = orders.owner_id) AND (orders.kind = 'current') AND (orders.deleted = 'no')");
                    if (mysql_num_rows($result_orders_current_user) == null)
                    {
                        echo '<hr /><p class="not-order">Список текущих заказов пуст</p>';
                    }else
                    {
                        $row_result_orders_current_user = mysql_fetch_array($result_orders_current_user);
                        do{
                            $current_order_id = $row_result_orders_current_user["order_id"];
                            
                            //Сравнение даты окончания заказа с текущей
                            $result_date_order_fav_user=(strtotime($row_result_orders_current_user["date_in"])<strtotime(date('y-m-j'))); 
                            if ($result_date_order_fav_user==true)
                            {
                                $change_status = mysql_query("UPDATE orders SET kind='performed' WHERE id=".$current_order_id);
                                $row_result_orders_current_user["order_kind"]="performed";
                            }
                            
                            if ($row_result_orders_current_user["order_kind"]=="current")
                            {
                                echo '
                                <hr />
                                <div class="current-order">
                                        <div class="ribbon-wrapper-blue">
                                            <div class="ribbon-blue">Текущий</div>
                                        </div>
                                        <div class="left-part-order-list">
                                            <div id="avatar-pet">';
                                                if($row_result_orders_current_user["avatar"]!="no" && file_exists("users/".$row_selected_user["folder"]."/".$row_result_orders_current_user["avatar"]))
                                                {
                                                    $img_path = 'users/'.$row_selected_user["folder"].'/'.$row_result_orders_current_user["avatar"];
                                                    echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" />';
                                                }else
                                                {
                                                    echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                                                }
                                        echo '</div>
                                        </div>
                                        <div class="right-part-order-list">
                                            <p class="order-about">'.$row_result_orders_current_user["about_order"].'</p>';
                                            if ($row_result_orders_current_user["city"]==null)
                                            {
                                                echo '<p class="order-about">Город: не указан</p>';
                                            }else
                                            {
                                                echo '<p class="order-about">Город: '.$row_result_orders_current_user["city"].'</p>';
                                            }
                                            echo '<p class="order-about">Даты: с '.$row_result_orders_current_user["date_out"].' до '.$row_result_orders_current_user["date_in"].'</p>
                                            <p class="order-about">Животное: '.$row_result_orders_current_user["pet_kind"].' ('.$row_result_orders_current_user["pet_sex"].')</p>
                                            <p class="order-about">Кличка: '.$row_result_orders_current_user["pet_name"].'</p>
                                            <p class="order-about">Порода: '.$row_result_orders_current_user["pet_breed"].'</p>
                                            <p class="order-about">Рост | Вес: '.$row_result_orders_current_user["pet_growth"].' м | '.$row_result_orders_current_user["pet_weight"].' кг</p>
                                            <p class="order-cost">Цена: '.$row_result_orders_current_user["cost"].' руб</p>';
                    ?>
                    <script type="text/javascript">
                        function goaddapply(identifier)
                        {     
                            var current_order =$(identifier).data('orderid'); 
                            var sit_user = <?php echo $id ?>;
                            //alert(current_order);
                            //alert(sit_user);
                            var tmpFunc = new Function(applycurrentorder(current_order, sit_user));
                            tmpFunc();                                      
                        }                           
                    </script>
                    
                    <?                       
                                            $search_req_rows = mysql_query("SELECT * FROM request, orders WHERE (request.order_id = orders.id) AND (request.sitter_id = $id) AND (orders.owner_id = ".$user_id.") AND (request.order_id = ".$row_result_orders_current_user["order_id"].") AND (request.deleted='no')");
                                            if (mysql_num_rows($search_req_rows) > 0)
                                            {
                                                echo '<p class="apply-order-links" ><a data-orderid="'.$current_order_id.'" onclick="event.preventDefault();goaddapply(this);" class="del-apply-current-order" id="apply_current_user_order" href="" ></a></p>';
                                            }else
                                            {
                                                echo '<p class="apply-order-links" ><a data-orderid="'.$current_order_id.'" onclick="event.preventDefault();goaddapply(this);" class="apply-current-order" id="apply_current_user_order" href="" ></a></p>';
                                            }
                                    
                                            echo '
                                        </div>
                                        <div class="clear"></div>
                                </div>
                                ';
                            }
                        }while ($row_result_orders_current_user = mysql_fetch_array($result_orders_current_user));
                    }
                    ?>
                </div>
            </div> 
            
            <div class="reviews-favourite-user-part">
                <div id="block-title-and-sorting-all-reviews-favourite-user-part">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Отзывы</p>
                    </div>
                </div>
                <div class="all-reviews-favourite-user-part">
                
                <?
                    $result_current_fav_user_reviews = mysql_query("SELECT reviews.id AS review_id, reviews.author_id AS author_id, reviews.sitter_id AS sitter_id, 
                                                    reviews.mark AS review_mark, reviews.text AS review_text, reviews.hidden AS review_hidden, 
                                                    reviews.deleted AS review_deleted, users.id AS user_id, users.photo AS user_photo, 
                                                    users.rating AS user_rating, users.folder AS user_folder 
                                                    FROM reviews, users 
                                                    WHERE (reviews.sitter_id = $user_id ) AND (reviews.sitter_id = users.id) AND (reviews.deleted='no') AND (reviews.hidden='no') AND (users.deleted='no')");
                    if (mysql_num_rows($result_current_fav_user_reviews) == null)
                    {
                        echo '<hr /><p class="not-order">Список отзывов пуст</p>';
                    }else
                    {
                        $row_result_current_fav_user_reviews = mysql_fetch_array($result_current_fav_user_reviews);
                        
                        do{
                            $result_reviews_about_author = mysql_query("SELECT folder, photo, rating, full_name FROM users WHERE id = ".$row_result_current_fav_user_reviews["author_id"]);
                            if (mysql_num_rows($result_reviews_about_author) > 0)
                            {
                                $row_result_reviews_about_author = mysql_fetch_array($result_reviews_about_author);
                            }
                            echo '
                            <hr />
                            <div class="current-review">
                                                    
                                <div class="left-part-review-list">
                                    <div id="favourite-circle"><div class="fav-rating" title="Рейтинг на основе оценок пользователей"><span class="fav-rating-span">'.$row_result_reviews_about_author["rating"].'/10</span></div>';
                                    if($row_result_reviews_about_author["photo"]!="no" && file_exists("users/".$row_result_reviews_about_author["folder"]."/".$row_result_reviews_about_author["photo"]))
                                    {
                                        $img_path = 'users/'.$row_result_reviews_about_author["folder"].'/'.$row_result_reviews_about_author["photo"];
                                        echo '<a href="user.php?id='.$row_result_current_fav_user_reviews["author_id"].'"><img class="image-avatar" src="'.$img_path.'" alt="" width="100%" /></a>';
                                    }else
                                    {
                                        echo '<a href="user.php?id='.$row_result_current_fav_user_reviews["author_id"].'"><img class="image-avatar" src="images/nophoto.jpg" width="100%" /></a>';
                                    }
                                                        
                                    echo '</div>
                                </div>
                                    
                                <div class="right-part-review-list-about-user">
                                    <p class="review-sitter-full-name">Автор отзыва: '.$row_result_reviews_about_author["full_name"].'</p>';
                                                        
                                    echo '<p class="review-text">'.$row_result_current_fav_user_reviews["review_text"].'</p>
                                                        <p class="review-rating">Оценка:</p>
                                                        <fieldset class="rating_current_review" disabled>
                                                            <input type="radio" id="star5'.$row_result_current_fav_user_reviews["author_id"].'" name="rating'.$row_result_current_fav_user_reviews["author_id"].'" value="5" '; if($row_result_current_fav_user_reviews["review_mark"] == 5) { echo "checked"; } echo ' /><label for="star5'.$row_result_current_fav_user_reviews["author_id"].'" title="Отлично!">5 stars</label>
                                                            <input type="radio" id="star4'.$row_result_current_fav_user_reviews["author_id"].'" name="rating'.$row_result_current_fav_user_reviews["author_id"].'" value="4" '; if($row_result_current_fav_user_reviews["review_mark"] == 4) { echo "checked"; } echo ' /><label for="star4'.$row_result_current_fav_user_reviews["author_id"].'" title="Хорошо">4 stars</label>
                                                            <input type="radio" id="star3'.$row_result_current_fav_user_reviews["author_id"].'" name="rating'.$row_result_current_fav_user_reviews["author_id"].'" value="3" '; if($row_result_current_fav_user_reviews["review_mark"] == 3) { echo "checked"; } echo ' /><label for="star3'.$row_result_current_fav_user_reviews["author_id"].'" title="Неплохо">3 stars</label>
                                                            <input type="radio" id="star2'.$row_result_current_fav_user_reviews["author_id"].'" name="rating'.$row_result_current_fav_user_reviews["author_id"].'" value="2" '; if($row_result_current_fav_user_reviews["review_mark"] == 2) { echo "checked"; } echo ' /><label for="star2'.$row_result_current_fav_user_reviews["author_id"].'" title="Плохо">2 stars</label>
                                                            <input type="radio" id="star1'.$row_result_current_fav_user_reviews["author_id"].'" name="rating'.$row_result_current_fav_user_reviews["author_id"].'" value="1" '; if($row_result_current_fav_user_reviews["review_mark"] == 1) { echo "checked"; } echo ' /><label for="star1'.$row_result_current_fav_user_reviews["author_id"].'" title="Ужасно!">1 star</label>
                                                        </fieldset>
                                </div>
                                <div class="clear"></div>
                            </div>';
                        }while ($row_result_current_fav_user_reviews = mysql_fetch_array($result_current_fav_user_reviews));  
                    }
                
                ?>
                </div>
            </div> 
            
</div>
