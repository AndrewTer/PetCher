$(document).ready(function(){
    /*Вывод окна для выбора сортировки заказов пользователя*/ 
    $('#select-links').click(function(){
        $("#list-links").slideToggle(200);
        $("#list-links-sort").slideToggle(200);    
    }); 
    
    $('.block-add-order').click(function(){
        $('.block-add-order-info').slideToggle(300);     
    }); 
});
