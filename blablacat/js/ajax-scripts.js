function addtofavoriteuser()
{
    if ($('#add_user_to_favorite_link').hasClass('add-to-fav-us')) {
        var favanduser = 'user='+current_user+'&fav='+fav_user;
        
        //alert(favanduser);
        
        $.ajax({
        url: "actions/add-to-favourite.php",
        type : 'POST',
        data : favanduser,
        success : function (data) {
            //alert("Добавлено в избранное");
            $('#add_user_to_favorite_link').removeClass('add-to-fav-us');
            $('#add_user_to_favorite_link').addClass('del-to-fav-us');
        },
        error : function () {
           alert("Ошибка");
        }
        });
        return false;
    } else if ($('#add_user_to_favorite_link').hasClass('del-to-fav-us')) {
        var favanduser = 'user='+current_user+'&fav='+fav_user;
        
        //alert(favanduser);
        
        $.ajax({
        url: "actions/delete-from-favourite.php",
        type : 'POST',
        data : favanduser,
        success : function (data) {
            //alert("Убрано из избранного");
            $('#add_user_to_favorite_link').removeClass('del-to-fav-us');
            $('#add_user_to_favorite_link').addClass('add-to-fav-us');
        },
        error : function () {
           alert("Ошибка");
        }
        });
        return false;
    }
}


$(document).ready(function(){
    $("#add_user_to_favorite_link").click(addtofavoriteuser);
});