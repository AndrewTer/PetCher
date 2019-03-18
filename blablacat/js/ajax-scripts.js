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

function addtoresponsescurrentrequest(current_order_response, current_sitter)
{
        var orderandsitter = 'order='+current_order_response+'&sitter='+current_sitter;
        
        //alert(orderandsitter);
        
        $.ajax({
        url: "actions/apply-current-request.php",
        type : 'POST',
        data : orderandsitter,
        success : function (data) {
            //alert("Одобрено!");
            //$( ".main-part-body" ).load(window.location.href + ".main-part-body" );
            //Обновление страницы
            location.reload(true)
        },
        error : function () {
           alert("Ошибка!\r\nПовторите действие, пожалуйста");
        }
        });
        return false;
}

function deltoresponsescurrentrequest(current_order_response, current_sitter)
{
        var orderandsitter = 'order='+current_order_response+'&sitter='+current_sitter;
        
        //alert(orderandsitter);
        
        $.ajax({
        url: "actions/denial-current-request.php",
        type : 'POST',
        data : orderandsitter,
        success : function (data) {
            //alert("Отказано!");
            //$( ".main-part-body" ).load(window.location.href + ".main-part-body" );
            //Обновление страницы
            location.reload(true)
        },
        error : function () {
           alert("Ошибка!\r\nПовторите действие, пожалуйста");
        }
        });
        return false;
}

function changecurrentorderinsearch(out_date_param, in_date_param, cost_param, description_param, order_id_ch_param)
{
        var changecurrentorderparams = 'out_date_parameter='+out_date_param+'&in_date_parameter='+in_date_param+'&cost_parameter='+cost_param+'&description_parameter='+description_param+'&order_id_ch_parameter='+order_id_ch_param;
        
        $.ajax({
        url: "actions/change-current-order.php",
        type: 'POST',
        data: changecurrentorderparams,
        success: function (data) {
            //Обновление страницы
            location.reload(true)
        },
        error: function () {
            alert("Ошибка!\r\nПовторите действие, пожалуйста");
        }
        });
        return false;
}

$(document).ready(function(){
    $("#add_user_to_favorite_link").click(addtofavoriteuser);
    //$("#apply_current_user_order").click(applycurrentorder);
    $('.approve-current-request').click(function(){
        $.confirm({
            'title'   : 'Подтверждение одобрения ситтера',
            'message' : 'При этом будет отказано остальным ситтерам в выполнении текущего заказа<br />Это необратимое действие! Продолжить?',
            'buttons' : {
                'Да'  : {
                    'class' : 'blue',
                    'action': function goaddcurreqtoresp()
                    {     
                        var curr_or_resp =$('.approve-current-request').data('curorderresp'); 
                        var curr_or_resp_sit =$('.approve-current-request').data('curorderrespsit');
        
                        var addtorespFunc = new Function(addtoresponsescurrentrequest(curr_or_resp, curr_or_resp_sit));
                        addtorespFunc();                                      
                    } 
                },
                'Нет' : {
                    'class' : 'gray',
                    'action': function(){}
                }
                
            }
        });
        
    });
    
    $('.refuse-current-request').click(function(){
        $.confirm({
            'title'   : 'Подтверждение отказа ситтеру',
            'message' : 'Это необратимое действие! Продолжить?',
            'buttons' : {
                'Да'  : {
                    'class' : 'blue',
                    'action': function godelcurreqtoresp()
                    {     
                        var curr_or_resp =$('.refuse-current-request').data('curorderresp'); 
                        var curr_or_resp_sit =$('.refuse-current-request').data('curorderrespsit');
        
                        var deltorespFunc = new Function(deltoresponsescurrentrequest(curr_or_resp, curr_or_resp_sit));
                        deltorespFunc();                                       
                    } 
                },
                'Нет' : {
                    'class' : 'gray',
                    'action': function(){}
                }
                
            }
        });
        
    });
    
});
