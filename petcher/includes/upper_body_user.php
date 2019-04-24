<?
defined('mypetcher') or header("Location: ../403.php");
?>
<div class="upper-part-body">
            <div class="user-menu">
                <div id="avatar">
                <div class="user-rating" title="Рейтинг на основе оценок пользователей"><span class="user-rating-span"><? echo $row_selected_user["rating"].' / 5'; ?></span></div>
                    <?
                    if($row_selected_user["photo"]!="no" && $row_selected_user["photo"]!=null && file_exists("users/".$row_selected_user["folder"]."/".$row_selected_user["photo"]))
                    {
                        $img_path = 'users/'.$row_selected_user["folder"].'/'.$row_selected_user["photo"];
                        echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" height="100%"/>';
                    }else
                    {
                        echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                    }
                    ?>
                
                </div>
                
                <hr />

                <script type="text/javascript">
                    var current_user = <?php echo $id ?>;
                    var fav_user = <?php echo $user_id?>;                    
                </script>
                <script type="text/javascript" src="js/ajax-scripts.js"></script> 
                
                <?
                    $search_fav_rows = mysql_query("SELECT * FROM favorites WHERE (user_id = $id) AND (favourite_id = ".$user_id.") AND (deleted='no')");
                    if (mysql_num_rows($search_fav_rows) > 0)
                    {
                        echo '<p align="center" class="add-user-to-favorite"><a href="" class="del-to-fav-us" id="add_user_to_favorite_link"></a></p>';
                    }else
                    {
                        echo '<p align="center" class="add-user-to-favorite"><a href="" class="add-to-fav-us" id="add_user_to_favorite_link"></a></p>';
                    }
                ?>
            </div>
            <div class="user-info">
                <p class="name-user"><? echo $row_selected_user["full_name"];?></p>
                <p class="address-user"><? echo $row_selected_user["city"] ?></p>
                <?
                    $current_time_result = mysql_query("SELECT SUBTIME(CURTIME(), '0:2:0') AS twomin, DATE(NOW());");
                    $row_current_time_result = mysql_fetch_array($current_time_result);
                    
                    $loggedTime=$row_current_time_result["twomin"];	//2 minutes
                    $loggedDate=$row_current_time_result["DATE(NOW())"];
                    if(($row_selected_user["status"]>$loggedTime) && ($row_selected_user["last_visit"]==$loggedDate))
                    {
                    	echo '<p class="about-user" id="online-status">Статус: онлайн</p>';
                    }
                    else
                    {
                    	echo '<p class="about-user" id="offline-status">Статус: пользователь был в сети '.$row_selected_user["last_visit"].' в '.$row_selected_user["status"].'</p>';
                    }
                ?>
                <hr />
                <p class="about-user-info">О себе</p>
                <?
                    if($row_selected_user["description"]==null)
                    {
                        echo '<p class="about-user">Ничего не указано</p>';
                    }else
                    {
                        echo '<p class="about-user">'.$row_selected_user["description"].'</p>';
                    }
                ?>
            </div>
            
            <div class="pets-list">
                <div class="pets-list-title">
                    <p class="title-section">Питомцы</p>
                    <div class="clear"></div>
                </div>
                <?
                    $result_selected_user_pets = mysql_query("SELECT * FROM pets WHERE (owner_id = ".$user_id.") AND (deleted = 'no')");
                    if (mysql_num_rows($result_selected_user_pets) > 0)
                    {
                        $row_selected_user_pets = mysql_fetch_array($result_selected_user_pets);
                ?>
                <div class="con">
                    <div class="containerr">
                    <?
                        do{
                        echo '<figure class="caption-border"><a href="">';
                        
                            if($row_selected_user_pets["photo"]!="no" && file_exists("users/".$row_selected_user["folder"]."/".$row_selected_user_pets["photo"]))
                            {
                                $img_path = 'users/'.$row_selected_user["folder"].'/'.$row_selected_user_pets["photo"];
                                echo '<img src="'.$img_path.'" />';
                            }else
                            {
                                echo '<img src="images/nophoto.jpg" />';
                            }
                            
                            echo '<figcaption>'.$row_selected_user_pets["name"].'</figcaption>
                        </a></figure>'; 
                        }while ($row_selected_user_pets = mysql_fetch_array($result_selected_user_pets));         
            echo '</div>
                    <img class="carouselLeft" src="images/left.png" width="5%" alt="Left Arrow" />
                    <img class="carouselRight" src="images/right.png" width="5%" alt="Right Arrow" />
                </div>';
                    }else
                    {
                        echo '<p class="not-pet-list-menu">Нет питомцев</p>';
                    }
                ?>
            </div>
            <div class="clear"></div>
        </div>