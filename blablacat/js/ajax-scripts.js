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

function applycurrentorder(current_order_id, sit_user_id)
{
    if ($('#apply_current_user_order[data-orderid="'+current_order_id+'"]').hasClass('apply-current-order')) {
        var orderandsitter = 'order='+current_order_id+'&sitter='+sit_user_id;
        
        //alert(orderandsitter);
        
        $.ajax({
        url: "actions/apply-current-order.php",
        type : 'POST',
        data : orderandsitter,
        success : function (data) {
            //alert("Заявка отправлена");
            $('#apply_current_user_order[data-orderid="'+current_order_id+'"]').removeClass('apply-current-order');
            $('#apply_current_user_order[data-orderid="'+current_order_id+'"]').addClass('del-apply-current-order');
        },
        error : function () {
           alert("Ошибка");
        }
        });
        return false;
    } else if ($('#apply_current_user_order[data-orderid="'+current_order_id+'"]').hasClass('del-apply-current-order')) {
        var orderandsitter = 'order='+current_order_id+'&sitter='+sit_user_id;
        
        //alert(orderandsitter);
        
        $.ajax({
        url: "actions/delete-apply-current-order.php",
        type : 'POST',
        data : orderandsitter,
        success : function (data) {
            //alert("Заявка отменена");
            $('#apply_current_user_order[data-orderid="'+current_order_id+'"]').removeClass('del-apply-current-order');
            $('#apply_current_user_order[data-orderid="'+current_order_id+'"]').addClass('apply-current-order');
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
    //$("#apply_current_user_order").click(applycurrentorder);
});
