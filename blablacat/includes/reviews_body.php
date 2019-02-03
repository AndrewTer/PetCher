<?
if (!empty($_GET["sort"]))
    {
        $sort = clear_string($_GET["sort"]);
        if (!preg_match('/^\+?\d+$/', $sort)) 
        {
            header("Location: index.php");
        }else
        {
            switch($sort){
                case 'my':
                    $sort = "WHERE (reviews.author_id = $id ) AND (reviews.author_id = users.id) AND (reviews.deleted='no') AND (reviews.hidden='no') AND (users.deleted='no') DESC";
                    $sort_name = 'Мои';
                break;
                case 'about_me':
                    $sort = "WHERE (reviews.sitter_id = $id ) AND (reviews.sitter_id = users.id) AND (reviews.deleted='no') AND (reviews.hidden='no') AND (users.deleted='no') DESC";
                    $sort_name = 'Обо мне';
                break;
                default:
                    $sort = "WHERE (reviews.author_id = $id ) AND (reviews.author_id = users.id) AND (reviews.deleted='no') AND (reviews.hidden='no') AND (users.deleted='no') DESC";
                    $sort_name = 'Обо мне';
                break;
            }
        }
    }else
    {
        header("Location: index.php"); 
    }
    
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
                                <a href="reviews.php?sort=my"><li><strong>Мои</strong></li></a>
                                <a href="reviews.php?sort=about_me"><li><strong>Обо мне</strong></li></a>
                            </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <?
                    $result_reviews = mysql_query("SELECT reviews.id AS review_id, reviews.author_id AS author_id, reviews.sitter_id AS sitter_id, reviews.mark AS review_mark, reviews.text AS review_text, reviews.hidden AS review_hidden, reviews.deleted AS review_deleted, users.id AS user_id, users.photo AS user_photo, users.rating AS user_rating, users.folder AS user_folder FROM reviews, users $sort");
                    if (mysql_num_rows($result_reviews) == null)
                    {
                        echo '<hr /><p class="not-order">Отзывов нет</p>';
                    }else
                    {
                        $row_result_reviews = mysql_fetch_array($result_reviews);
                        do{
                            if (($row_result_reviews["review_hidden"]=="no") AND ($row_result_reviews["review_deleted"]=="no")) 
                            {
                                echo '
                            <hr />
                            <div class="current-review">
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
                        }while ($row_result_reviews = mysql_fetch_array($result_reviews));
                    }
                ?>
            </div> 
</div>