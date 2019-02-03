<div class="main-part-body">
    <div class="favourites-part">
        <div id="block-title-and-sorting">
            <div class="block-title-and-sorting-left">
                <p class="title-section-main-body">Избранное</p>
            </div>
        </div>
        <div class="favourites-list">
        <?
        $result_favourites = mysql_query("SELECT favorites.id AS fav_num_id, favorites.favourite_id AS fav_id, users.folder AS folder, users.photo AS photo, users.rating AS rating FROM favorites, users WHERE (favorites.user_id = $id) AND (favorites.favourite_id=users.id) AND (favorites.deleted='no') AND (users.deleted='no')");
        if (mysql_num_rows($result_favourites) == null)
        {
            echo '<hr /><p class="not-favourites">Список избранного пуст</p>';
        }else
        {
            $row_favourites = mysql_fetch_array($result_favourites);
            do{
            echo '<div id="favourite-circle"><div class="fav-rating"><p class="fav-rating-p">'.$row_favourites["rating"].'/10</p></div>';
                    
                if($row_favourites["photo"]!="no" && file_exists("users/".$row_favourites["folder"]."/".$row_favourites["photo"]))
                {
                    $img_path = 'users/'.$row_favourites["folder"].'/'.$row_favourites["photo"];
                    echo '<a href="user.php?id='.$row_favourites["fav_id"].'"><img class="image-avatar" src="'.$img_path.'" alt="" width="100%" /></a>';
                }else
                {
                    echo '<a href="user.php?id='.$row_favourites["fav_id"].'"><img class="image-avatar" src="images/nophoto.jpg" width="100%" /></a>';
                }
            
            echo '</div>';
                
            }while ($row_favourites = mysql_fetch_array($result_favourites));
            
            echo '<div class="clear"></div>';
        }
        ?>   
        </div>          
    </div> 
</div>
