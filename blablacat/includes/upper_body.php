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
                        <a href=""><li class="list-user-menu-item">&ensp;&#9743;&ensp;Заявки от ситтеров <?if ($count_requests > 0) { echo '<div class="count-requests">'.$count_requests.'</div>'; }?></li></a>
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
                <div class="con">
                    <div class="containerr">
                        <img src="users/<?echo $row_new["folder"];?>/andrey_burbon1.jpg" alt="Бурбон" />
                        <img src="users/<?echo $row_new["folder"];?>/andrey_anfisa1.jpg" alt="Анфиса" />
                        <img src="users/<?echo $row_new["folder"];?>/andrey_burbon1.jpg" alt="Бурбон" />
                        <img src="users/<?echo $row_new["folder"];?>/andrey_burbon1.jpg" alt="Бурбон" />
                    </div>
                <img class="carouselLeft" src="images/left.png" width="5%" alt="Left Arrow" />
                <img class="carouselRight" src="images/right.png" width="5%" alt="Right Arrow" />
                </div>

            </div>
            <div class="clear"></div>
</div>
