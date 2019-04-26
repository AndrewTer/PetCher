<?
defined('mypetcher') or header("Location: ../403.php");
?>
<div class="main-part-body">
            <div class="reviews-part">
                <div id="block-title-and-sorting">
                    <div class="block-title-and-sorting-left">
                        <p class="title-section-main-body">Отзывы</p>
                    </div>
                    <div class="block-title-and-sorting-right">
                        <ul id="options-list">
                            <li>Отобразить</li>
                            <li><a id="select-links" href="#"><? echo $sort_name; ?></a>
                            <ul id="list-links-sort">
                                <a href="reviews?sort=my"><li><strong>Мои отзывы</strong></li></a>
                                <a href="reviews?sort=about-me"><li><strong>Отзывы обо мне</strong></li></a>
                            </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <?
                    $result_reviews = mysql_query("SELECT reviews.id AS review_id, reviews.author_id AS author_id, reviews.sitter_id AS sitter_id, reviews.mark AS review_mark, reviews.text AS review_text, reviews.hidden AS review_hidden, reviews.deleted AS review_deleted, users.id AS user_id, users.photo AS user_photo, users.rating AS user_rating, users.folder AS user_folder FROM reviews, users $sort");
                    if (mysql_num_rows($result_reviews) == null)
                    {
                        echo '<hr /><p class="not-order">Список отзывов пуст</p>';
                    }else
                    {
                        $row_result_reviews = mysql_fetch_array($result_reviews);
                        
                            $sort_for_revies = clear_string($_GET["sort"]);
                            switch($sort_for_revies){
                                case 'my':
                                    do{
                                        $result_reviews_about_sitter = mysql_query("SELECT folder, photo, rating, full_name FROM users WHERE id = ".$row_result_reviews["sitter_id"]);
                                        if (mysql_num_rows($result_reviews_about_sitter) > 0)
                                        {
                                            $row_result_reviews_about_sitter = mysql_fetch_array($result_reviews_about_sitter);
                                        }
                                        echo '
                                            <hr />
                                            <div class="current-review">
                                                    <div class="ribbon-wrapper-blue">
                                                        <div class="ribbon-blue">Мой</div>
                                                    </div>
                                                    
                                                    <div class="left-part-review-list">
                                                        <div id="favourite-circle"><div class="fav-rating" title="Рейтинг на основе оценок пользователей"><span class="fav-rating-span">'.$row_result_reviews_about_sitter["rating"].'/5</span></div>';
                                                            if($row_result_reviews_about_sitter["photo"]!="no" && file_exists("users/".$row_result_reviews_about_sitter["folder"]."/".$row_result_reviews_about_sitter["photo"]))
                                                            {
                                                                $img_path = 'users/'.$row_result_reviews_about_sitter["folder"].'/'.$row_result_reviews_about_sitter["photo"];
                                                                echo '<a href="user.php?id='.$row_result_reviews["sitter_id"].'"><img class="image-avatar" src="'.$img_path.'" alt="" width="100%" /></a>';
                                                            }else
                                                            {
                                                                echo '<a href="user.php?id='.$row_result_reviews["sitter_id"].'"><img class="image-avatar" src="images/nophoto.jpg" width="100%" /></a>';
                                                            }
                                                        
                                                        echo '</div>
                                                    </div>
                                                    <div class="right-part-review-list">
                                                        <p class="review-sitter-full-name">Ситтер: '.$row_result_reviews_about_sitter["full_name"].'</p>
                                                        <p class="review-text">'.$row_result_reviews["review_text"].'</p>
                                                        <p class="review-rating">Моя оценка:</p>
                                                        <fieldset class="rating_current_review" disabled>
                                                            <input type="radio" id="star5'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" name="myrating'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" value="5" '; if($row_result_reviews["review_mark"] == 5) { echo "checked"; } echo ' /><label for="star5'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" title="Отлично!">5 stars</label>
                                                            <input type="radio" id="star4'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" name="myrating'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" value="4" '; if($row_result_reviews["review_mark"] == 4) { echo "checked"; } echo ' /><label for="star4'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" title="Хорошо">4 stars</label>
                                                            <input type="radio" id="star3'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" name="myrating'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" value="3" '; if($row_result_reviews["review_mark"] == 3) { echo "checked"; } echo ' /><label for="star3'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" title="Неплохо">3 stars</label>
                                                            <input type="radio" id="star2'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" name="myrating'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" value="2" '; if($row_result_reviews["review_mark"] == 2) { echo "checked"; } echo ' /><label for="star2'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" title="Плохо">2 stars</label>
                                                            <input type="radio" id="star1'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" name="myrating'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" value="1" '; if($row_result_reviews["review_mark"] == 1) { echo "checked"; } echo ' /><label for="star1'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" title="Ужасно!">1 star</label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="clear"></div>
                                            </div>
                                        ';
                                    }while ($row_result_reviews = mysql_fetch_array($result_reviews));  
                                break;
                                case 'about_me':
                                    do{
                                        $result_reviews_about_author = mysql_query("SELECT folder, photo, rating, full_name FROM users WHERE id = ".$row_result_reviews["author_id"]);
                                        if (mysql_num_rows($result_reviews_about_author) > 0)
                                        {
                                            $row_result_reviews_about_author = mysql_fetch_array($result_reviews_about_author);
                                        }
                                        echo '
                                            <hr />
                                            <div class="current-review">
                                                    <div class="ribbon-wrapper-green">
                                                        <div class="ribbon-green">Обо мне</div>
                                                    </div>
                                                    
                                                    <div class="left-part-review-list">
                                                        <div id="favourite-circle"><div class="fav-rating" title="Рейтинг на основе оценок пользователей"><span class="fav-rating-span">'.$row_result_reviews_about_author["rating"].'/5</span></div>';
                                                            if($row_result_reviews_about_author["photo"]!="no" && file_exists("users/".$row_result_reviews_about_author["folder"]."/".$row_result_reviews_about_author["photo"]))
                                                            {
                                                                $img_path = 'users/'.$row_result_reviews_about_author["folder"].'/'.$row_result_reviews_about_author["photo"];
                                                                echo '<a href="user.php?id='.$row_result_reviews["author_id"].'"><img class="image-avatar" src="'.$img_path.'" alt="" width="100%" /></a>';
                                                            }else
                                                            {
                                                                echo '<a href="user.php?id='.$row_result_reviews["author_id"].'"><img class="image-avatar" src="images/nophoto.jpg" width="100%" /></a>';
                                                            }
                                                        
                                                        echo '</div>
                                                    </div>
                                                    <div class="right-part-review-list-about-user">
                                                        <p class="review-sitter-full-name">Автор отзыва: '.$row_result_reviews_about_author["full_name"].'</p>';
                                                        #<p class="review-sitter-full-name">Ситтер: '.$username.' (Вы)</p>
                                                  echo '<p class="review-text">'.$row_result_reviews["review_text"].'</p>
                                                        <p class="review-rating">Оценка:</p>
                                                        <fieldset class="rating_current_review" disabled>
                                                            <input type="radio" id="star5'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" name="rating_about_me_'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" value="5" '; if($row_result_reviews["review_mark"] == 5) { echo "checked"; } echo ' /><label for="star5'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" title="Отлично!">5 stars</label>
                                                            <input type="radio" id="star4'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" name="rating_about_me_'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" value="4" '; if($row_result_reviews["review_mark"] == 4) { echo "checked"; } echo ' /><label for="star4'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" title="Хорошо">4 stars</label>
                                                            <input type="radio" id="star3'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" name="rating_about_me_'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" value="3" '; if($row_result_reviews["review_mark"] == 3) { echo "checked"; } echo ' /><label for="star3'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" title="Неплохо">3 stars</label>
                                                            <input type="radio" id="star2'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" name="rating_about_me_'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" value="2" '; if($row_result_reviews["review_mark"] == 2) { echo "checked"; } echo ' /><label for="star2'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" title="Плохо">2 stars</label>
                                                            <input type="radio" id="star1'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" name="rating_about_me_'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" value="1" '; if($row_result_reviews["review_mark"] == 1) { echo "checked"; } echo ' /><label for="star1'.$row_result_reviews["author_id"].'-'.$row_result_reviews["review_id"].'" title="Ужасно!">1 star</label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="clear"></div>
                                            </div>
                                        ';
                                    }while ($row_result_reviews = mysql_fetch_array($result_reviews));  
                                break;
                                default:
                                    do{
                                        $result_reviews_about_sitter = mysql_query("SELECT folder, photo, rating, full_name FROM users WHERE id = ".$row_result_reviews["sitter_id"]);
                                        if (mysql_num_rows($result_reviews_about_sitter) > 0)
                                        {
                                            $row_result_reviews_about_sitter = mysql_fetch_array($result_reviews_about_sitter);
                                        }
                                        echo '
                                            <hr />
                                            <div class="current-review">
                                                    <div class="ribbon-wrapper-blue">
                                                        <div class="ribbon-blue">Мой</div>
                                                    </div>
                                                    
                                                    <div class="left-part-review-list">
                                                        <div id="favourite-circle"><div class="fav-rating" title="Рейтинг на основе оценок пользователей"><span class="fav-rating-span">'.$row_result_reviews_about_sitter["rating"].'/5</span></div>';
                                                            if($row_result_reviews_about_sitter["photo"]!="no" && file_exists("users/".$row_result_reviews_about_sitter["folder"]."/".$row_result_reviews_about_sitter["photo"]))
                                                            {
                                                                $img_path = 'users/'.$row_result_reviews_about_sitter["folder"].'/'.$row_result_reviews_about_sitter["photo"];
                                                                echo '<a href="user.php?id='.$row_result_reviews["sitter_id"].'"><img class="image-avatar" src="'.$img_path.'" alt="" width="100%" /></a>';
                                                            }else
                                                            {
                                                                echo '<a href="user.php?id='.$row_result_reviews["sitter_id"].'"><img class="image-avatar" src="images/nophoto.jpg" width="100%" /></a>';
                                                            }
                                                        
                                                        echo '</div>
                                                    </div>
                                                    <div class="right-part-review-list">
                                                        <p class="review-sitter-full-name">Ситтер: '.$row_result_reviews_about_sitter["full_name"].'</p>
                                                        <p class="review-text">'.$row_result_reviews["review_text"].'</p>
                                                        <p class="review-rating">Моя оценка:</p>
                                                        <fieldset class="rating_current_review" disabled>
                                                            <input type="radio" id="star5'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" name="myrating'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" value="5" '; if($row_result_reviews["review_mark"] == 5) { echo "checked"; } echo ' /><label for="star5'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" title="Отлично!">5 stars</label>
                                                            <input type="radio" id="star4'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" name="myrating'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" value="4" '; if($row_result_reviews["review_mark"] == 4) { echo "checked"; } echo ' /><label for="star4'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" title="Хорошо">4 stars</label>
                                                            <input type="radio" id="star3'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" name="myrating'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" value="3" '; if($row_result_reviews["review_mark"] == 3) { echo "checked"; } echo ' /><label for="star3'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" title="Неплохо">3 stars</label>
                                                            <input type="radio" id="star2'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" name="myrating'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" value="2" '; if($row_result_reviews["review_mark"] == 2) { echo "checked"; } echo ' /><label for="star2'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" title="Плохо">2 stars</label>
                                                            <input type="radio" id="star1'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" name="myrating'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" value="1" '; if($row_result_reviews["review_mark"] == 1) { echo "checked"; } echo ' /><label for="star1'.$row_result_reviews["sitter_id"].'-'.$row_result_reviews["review_id"].'" title="Ужасно!">1 star</label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="clear"></div>
                                            </div>
                                        ';
                                    }while ($row_result_reviews = mysql_fetch_array($result_reviews));  
                                break;
                            }
                        
                        
                    }
                ?>
            </div> 
</div>