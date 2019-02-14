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
           alert("Ошибка!\r\nПовторите действие, пожалуйста");
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
           alert("Ошибка!\r\nПовторите действие, пожалуйста");
        }
        });
        return false;
    }
}

function addtofavoritesearchuser(fav_user, current_user)
{
    if ($('#apply_current_user_search[data-usersearchid="'+fav_user+'"]').hasClass('apply-current-user-search')) {
        var favanduser = 'user='+current_user+'&fav='+fav_user;
        
        //alert(favanduser);
        
        $.ajax({
        url: "actions/add-to-favourite.php",
        type : 'POST',
        data : favanduser,
        success : function (data) {
            //alert("Добавлено в избранное");
            $('#apply_current_user_search[data-usersearchid="'+fav_user+'"]').removeClass('apply-current-user-search');
            $('#apply_current_user_search[data-usersearchid="'+fav_user+'"]').addClass('del-apply-current-user-search');
        },
        error : function () {
           alert("Ошибка!\r\nПовторите действие, пожалуйста");
        }
        });
        return false;
    } else if ($('#apply_current_user_search[data-usersearchid="'+fav_user+'"]').hasClass('del-apply-current-user-search')) {
        var favanduser = 'user='+current_user+'&fav='+fav_user;
        
        //alert(favanduser);
        
        $.ajax({
        url: "actions/delete-from-favourite.php",
        type : 'POST',
        data : favanduser,
        success : function (data) {
            //alert("Убрано из избранного");
            $('#apply_current_user_search[data-usersearchid="'+fav_user+'"]').removeClass('del-apply-current-user-search');
            $('#apply_current_user_search[data-usersearchid="'+fav_user+'"]').addClass('apply-current-user-search');
        },
        error : function () {
           alert("Ошибка!\r\nПовторите действие, пожалуйста");
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
           alert("Ошибка!\r\nПовторите действие, пожалуйста");
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
           alert("Ошибка!\r\nПовторите действие, пожалуйста");
        }
        });
        return false;
    }
}

function addtorequestsearchorder(current_order, current_user)
{
    if ($('#apply_current_order_search[data-ordersearchid="'+current_order+'"]').hasClass('apply-current-order-search')) {
        var orderanduser = 'order='+current_order+'&sitter='+current_user;
        
        //alert(orderanduser);
        
        $.ajax({
        url: "actions/apply-current-order.php",
        type : 'POST',
        data : orderanduser,
        success : function (data) {
            //alert("Добавлено в избранное");
            $('#apply_current_order_search[data-ordersearchid="'+current_order+'"]').removeClass('apply-current-order-search');
            $('#apply_current_order_search[data-ordersearchid="'+current_order+'"]').addClass('del-apply-current-order-search');
        },
        error : function () {
           alert("Ошибка!\r\nПовторите действие, пожалуйста");
        }
        });
        return false;
    } else if ($('#apply_current_order_search[data-ordersearchid="'+current_order+'"]').hasClass('del-apply-current-order-search')) {
        var orderanduser = 'order='+current_order+'&sitter='+current_user;
        
        //alert(orderanduser);
        
        $.ajax({
        url: "actions/delete-apply-current-order.php",
        type : 'POST',
        data : orderanduser,
        success : function (data) {
            //alert("Убрано из избранного");
            $('#apply_current_order_search[data-ordersearchid="'+current_order+'"]').removeClass('del-apply-current-order-search');
            $('#apply_current_order_search[data-ordersearchid="'+current_order+'"]').addClass('apply-current-order-search');
        },
        error : function () {
           alert("Ошибка!\r\nПовторите действие, пожалуйста");
        }
        });
        return false;
    }
}

$(document).ready(function(){
    $("#add_user_to_favorite_link").click(addtofavoriteuser);
    //$("#apply_current_user_order").click(applycurrentorder);
});
