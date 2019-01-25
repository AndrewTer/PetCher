$(document).ready(function(){
    /*Вывод окна для выбора сортировки заказов пользователя*/ 
    $('#select-links').click(function(){
        $("#list-links").slideToggle(200);
        $("#list-links-sort").slideToggle(200);    
    }); 
    
    $('.block-add-order').click(function(){
        $('.block-add-order-info').slideToggle(300);     
    }); 
    
    $('.delete-current-order').click(function(){
        var rel = $(this).attr("rel");
        
        $.confirm({
            'title'   : 'Подтверждение удаления',
            'message' : 'После удаления восстановление будет невозможно! Продолжить?',
            'buttons' : {
                'Да'  : {
                    'class' : 'blue',
                    'action': function(){
                        location.href = rel;
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
