<div class="upper-part-body">
            <div class="user-menu">
                <div id="avatar">
                <?
                    if($row_new["photo"]!="no" && file_exists("users/".$row_new["folder"]."/".$row_new["photo"]))
                    {
                        $img_path = 'users/'.$row_new["folder"].'/'.$row_new["photo"];
                        echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" height="100%"/>';
                    }else
                    {
                        echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                    }
                ?>
                
                </div>
                
                <nav>
                    <ul class="list-user-menu">
                        <a href="favourites.php"><li class="list-user-menu-item">&ensp;&#9733;&ensp;Избранное</li></a>
                        <a href=""><li class="list-user-menu-item">&ensp;&#9993;&ensp;Отзывы</li></a>
                        <a href="requests.php"><li class="list-user-menu-item">&ensp;&#9743;&ensp;Заявки от ситтеров <?if ($count_requests > 0) { echo '<div class="count-requests">'.$count_requests.'</div>'; }?></li></a>
                        <a href=""><li class="list-user-menu-item">&ensp;&#9990;&ensp;Ответы на мои заявки</li></a>
                        <a href="search.php"><li class="list-user-menu-item">&ensp;&#128270;&ensp;Поиск заказов</li></a>
                    </ul>
                </nav>
                
            </div>
            <div class="user-info">
                <p class="name-user"><? echo $row_new["full_name"];?></p>
                <p class="address-user"><? echo $row_new["address"] ?></p>
                <hr />
                <p class="about-user-info">Контактная информация</p>
                <p class="about-user">Моб.номер: <? echo $row_new["phone_number"]; ?></p>
                <p class="about-user-info">О себе</p>
                <?
                    if($row_new["description"]==null)
                    {
                        echo '<p class="about-user">Ничего не указано</p>';
                    }else
                    {
                        echo '<p class="about-user">'.$row_new["description"].'</p>';
                    }
                ?>
            </div>
            <div class="pets-list">
                <p class="title-section">Питомцы</p>
                <?
                    if (mysql_num_rows($result_pet_list) > 0)
                    {
                        $row_pets_list_menu = mysql_fetch_array($result_pet_list);
                ?>
                <div class="con">
                    <div class="containerr">
                    <?
                        do{
                        echo '<figure class="caption-border">';
                        
                            if($row_pets_list_menu["photo"]!="no" && file_exists("users/".$row_new["folder"]."/".$row_pets_list_menu["photo"]))
                            {
                                $img_path = 'users/'.$row_new["folder"].'/'.$row_pets_list_menu["photo"];
                                echo '<img src="'.$img_path.'" />';
                            }else
                            {
                                echo '<img src="images/nophoto.jpg" />';
                            }
                            
                            echo '<figcaption>'.$row_pets_list_menu["name"].'</figcaption>
                        </figure>'; 
                        }while ($row_pets_list_menu = mysql_fetch_array($result_pet_list));         
            echo '</div>
                    <img class="carouselLeft" src="images/left.png" width="5%" alt="Left Arrow" />
                    <img class="carouselRight" src="images/right.png" width="5%" alt="Right Arrow" />
                </div>';
                    }else
                    {
                        echo '<p class="not-pet-list-menu">Вы пока не добавили ни одного питомца</p>';
                    }
                ?>
            </div>
            <div class="clear"></div>
</div>
