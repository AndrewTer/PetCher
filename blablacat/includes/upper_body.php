<?
if ($_POST["add_new_pet"])
{
        $sex_new_pet = $_POST["sex_new_pet"];
        $breed_new_pet = $_POST["breed_new_pet"];
        
        switch ($sex_new_pet) {
            case 'no':
                $sex_new_pet_result = "не указано";
            break;
            case 'm':
                $sex_new_pet_result = "мальчик";
            break;
            case 'w':
                $sex_new_pet_result = "девочка";
            break;
            default;
                $sex_new_pet_result = "не указано";
            break;
        }
        
        $kind_new_pet = $_POST["kind_new_pet"];
        
        switch ($kind_new_pet) {
            case 'cat':
                $kind_new_pet_result = "кошка";
            break;
            case 'dog':
                $kind_new_pet_result = "собака";
            break;
            case 'parrot':
                $kind_new_pet_result = "попугай";
            break;
            case 'bird':
                $kind_new_pet_result = "другая птица";
            break;
            case 'hamster':
                $kind_new_pet_result = "хомяк";
            break;
            case 'cavy':
                $kind_new_pet_result = "морская свинка";
            break;
            case 'rabbit':
                $kind_new_pet_result = "кролик";
            break;
            case 'chinchilla':
                $kind_new_pet_result = "шиншилла";
            break;
            case 'fish':
                $kind_new_pet_result = "рыбки";
            break;
            case 'turtle':
                $kind_new_pet_result = "черепаха";
            break;
            case 'other':
                $kind_new_pet_result = "другой";
            break;
            default;
                $kind_new_pet_result = "другой";
            break;
        }
        
        if ($breed_new_pet == null)
        {
            $breed_new_pet = "без породы";
        }
        
        mysql_query("INSERT INTO pets (owner_id, name, kind, breed, sex, weight, growth, other_information, photo, deleted)
                        VALUES (
                            '".$id."',
                            '".$_POST["name_new_pet"]."',
                            '".$kind_new_pet_result."',
                            '".$breed_new_pet."',
                            '".$sex_new_pet_result."',
                            '".$_POST["weight_new_pet"]."',
                            '".$_POST["growth_new_pet"]."',
                            '".$_POST["other_information_new_pet"]."',
                            'no',
                            'no'
                        )");
}
?>

<div class="upper-part-body">
            <div class="user-menu">
                <div id="avatar">
                    <div class="user-rating" title="Ваш рейтинг на основе оценок пользователей"><span class="user-rating-span"><? echo $row_new["rating"].'/10'; ?></span></div>
                    <?
                    if($row_new["photo"]!="no" && $row_new["photo"]!=null && file_exists("users/".$row_new["folder"]."/".$row_new["photo"]))
                    {
                        $img_path = 'users/'.$row_new["folder"].'/'.$row_new["photo"];
                        echo '<img class="image-avatar" src="'.$img_path.'" alt="" width="100%" height="100%"/>';
                    }else
                    {
                        echo '<img class="image-avatar" src="images/nophoto.jpg" width="100%" />';
                    }
                    ?>
                </div>
                
                <p align="center" class="change-user-info"><a href="edit.php" id="change_user_info_link">Редактировать</a></p>
                
                <hr />
                
                <nav>
                    <ul class="list-user-menu">
                        <a href="index.php?id<?echo $id;?>"><li class="list-user-menu-item"><img class="main-user-menu" src="images/icon-menu-orders.png" width="10%"/>&ensp;<span>Заказы</span></li></a>
                        <a href="favourites.php"><li class="list-user-menu-item"><img class="main-user-menu" src="images/icon-menu-fav.png" width="10%"/>&ensp;<span>Избранное</span></li></a>
                        <a href="reviews.php?sort=about_me"><li class="list-user-menu-item"><img class="main-user-menu" src="images/icon-menu-reviews.png" width="10%"/>&ensp;<span>Отзывы</span></li></a>
                        <a href="requests.php"><li class="list-user-menu-item"><img class="main-user-menu" src="images/icon-menu-requests.png" width="10%"/>&ensp;<span>Заявки от ситтеров</span> <? if ($count_requests > 0) { if ($count_requests < 100) { echo '<div class="count-requests">'.$count_requests.'</div>'; }else{ echo '<div class="count-requests">99+</div>'; } } ?></li></a>
                        <a href=""><li class="list-user-menu-item"><img class="main-user-menu" src="images/icon-menu-answers.png" width="10%"/>&ensp;<span>Ответы на мои заявки</span> <? if ($count_all_responses > 0) { if ($count_all_responses < 100) { echo '<div class="count-requests">'.$count_all_responses.'</div>'; }else{ echo '<div class="count-requests">99+</div>'; } } ?></li></a>
                    </ul>
                </nav>
                
                <hr />
                
                <nav>
                    <ul class="list-user-menu">
                        <a href="users_search.php?sort=all-users"><li class="list-user-menu-item"><img class="main-user-menu" src="images/icon-menu-users-search.png" width="10%"/>&ensp;<span>Поиск пользователей</span></li></a>
                        <a href="search.php"><li class="list-user-menu-item"><img class="main-user-menu" src="images/icon-menu-orders-search.png" width="10%"/>&ensp;<span>Поиск заказов</span></li></a>
                    </ul>
                </nav>
                
                
            </div>
            <div class="user-info">
                <p class="name-user"><? echo $row_new["full_name"];?></p>
                <p class="address-user">
                <? if (($row_new["city"]!=null) && ($row_new["street"]!=null)) 
                    { 
                        echo $row_new["city"].', улица '.$row_new["street"]; 
                    }else if (($row_new["city"]!=null) && ($row_new["street"]==null)) 
                    {
                        echo $row_new["city"];
                    }
                ?>
                </p>
                <p class="address-user-hint">(другим пользователям виден только ваш город для удобства поиска ваших заказов)</p>
                <?
                    $current_time_result = mysql_query("SELECT SUBTIME(CURTIME(), '0:2:0') AS twomin, DATE(NOW());");
                    $row_current_time_result = mysql_fetch_array($current_time_result);
                    
                    $loggedTime=$row_current_time_result["twomin"];	//2 minutes
                    $loggedDate=$row_current_time_result["DATE(NOW())"];
                    if($row_new["status"]>$loggedTime && ($row_new["last_visit"]==$loggedDate))
                    {
                    	echo '<p class="about-user" id="online-status">Ваш статус: онлайн</p>';
                    }
                    else
                    {
                    	echo '<p class="about-user">Ваш статус: оффлайн</p>';
                    }
                ?>
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
            
            <div id="modal_form_add_new_pet"> <!-- Окно добавления нового животного --> 
                <form enctype="multipart/form-data" method="post">
                    <span id="modal_close_add_new_pet">X</span> <!-- Кнoпкa зaкрыть --> 
                    <p id="title-add-new-pet">Добавление питомца</p>
                    <hr />
                    <p class="add-new-pet">Кличка:&emsp; <input type="text" id="name-new-pet" name="name_new_pet" required /></p>
                    <p class="add-new-pet">Вид:&emsp; 
                        <select id="kind-new-pet" name="kind_new_pet">
                            <option value="cat">Кошка</option>
                            <option value="dog">Собака</option>
                            <option value="parrot">Попугай</option>
                            <option value="bird">Другая птица</option>
                            <option value="hamster">Хомяк</option>
                            <option value="cavy">Морская свинка</option>
                            <option value="rabbit">Кролик</option>
                            <option value="chinchilla">Шиншилла</option>
                            <option value="fish">Рыбки</option>
                            <option value="turtle">Черепаха</option>
                            <option value="other">Другой</option>
                        </select>
                    </p>
                    <p class="add-new-pet">Порода:&emsp; <input type="text" id="breed-new-pet" name="breed_new_pet" placeholder="без породы" /></p>
                    <p class="add-new-pet">Пол:&emsp; 
                        <select id="sex-new-pet" name="sex_new_pet">
                            <option value="no">Пусто</option>
                            <option value="m">Мальчик</option>
                            <option value="w">Девочка</option>
                        </select>
                    </p>
                    <p class="add-new-pet">Вес (в кг):&emsp; <input type="number" id="weight-new-pet" name="weight_new_pet" min="0" max="20" value="0" step="0.1" placeholder="0-20" /></p>
                    <p class="add-new-pet">Рост (в м):&emsp; <input type="number" id="growth-new-pet" name="growth_new_pet" min="0" max="1" value="0" step="0.01" placeholder="0-1" /></p>
                    <p class="add-new-pet">Остальная информация:</p><textarea id="other-information-new-pet" name="other_information_new_pet" maxlength="500" cols="93" rows="10" placeholder="До 500 символов"></textarea>
                    
                    <p class="add-new-pet-link" ><input type="submit" class="add-new-pet-link-a" name="add_new_pet" value="Добавить" /></p>
                </form>
            </div>
            <div id="overlay_add_new_pet"></div> <!-- Пoдлoжкa -->
            
            <div class="pets-list">
                <div class="pets-list-title">
                    <p class="title-section">Питомцы</p>
                    <p class="add-new-pet-section"><a href="#" id="addnewpet">Добавить</a></p>
                    <div class="clear"></div>
                </div>
                
                
                
                <?
                    if (mysql_num_rows($result_pet_list) > 0)
                    {
                        $row_pets_list_menu = mysql_fetch_array($result_pet_list);
                ?>
                <div class="con">
                    <div class="containerr">
                    <?
                        do{
                        echo '<figure class="caption-border"><a href="pets.php?petnum='.$row_pets_list_menu["id"].'">';
                        
                            if($row_pets_list_menu["photo"]!="no" && file_exists("users/".$row_new["folder"]."/".$row_pets_list_menu["photo"]))
                            {
                                $img_path = 'users/'.$row_new["folder"].'/'.$row_pets_list_menu["photo"];
                                echo '<img src="'.$img_path.'" />';
                            }else
                            {
                                echo '<img src="images/nophoto.jpg" />';
                            }
                            
                            echo '<figcaption>'.$row_pets_list_menu["name"].'</figcaption>
                        </a></figure>'; 
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
