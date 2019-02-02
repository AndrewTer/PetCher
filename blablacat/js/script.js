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
    
    $('.delete-pet').click(function(){
        var rel = $(this).attr("rel");
        
        $.confirm({
            'title'   : 'Подтверждение удаления питомца',
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
    
    /* Открытие модального окна добавления нового животного */
    $('a#addnewpet').click( function(event){ // лoвим клик пo ссылки с id="addnewpet"
		event.preventDefault(); // выключaем стaндaртную рoль элементa
		$('#overlay_add_new_pet').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
		 	function(){ // пoсле выпoлнения предыдущей aнимaции
				$('#modal_form_add_new_pet') 
					.css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
					.animate({opacity: 1, top: '50%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
		});
	});
    
	/* Зaкрытие мoдaльнoгo oкнa добавления нового животного, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
	$('#modal_close_add_new_pet, #overlay_add_new_pet').click( function(){ // лoвим клик пo крестику или пoдлoжке
		$('#modal_form_add_new_pet')
			.animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
				function(){ // пoсле aнимaции
					$(this).css('display', 'none'); // делaем ему display: none;
					$('#overlay_add_new_pet').fadeOut(400); // скрывaем пoдлoжку
				}
			);
	});
    
    
    /*Загрузка фото пользователя*/
   	var dropZone = $('#upload-container');

	$('#file-input').focus(function() {
		$('label').addClass('focus');
	})
	.focusout(function() {
		$('label').removeClass('focus');
	});


	dropZone.on('drag dragstart dragend dragover dragenter dragleave drop', function(){
		return false;
	});

	dropZone.on('dragover dragenter', function() {
		dropZone.addClass('dragover');
	});

	dropZone.on('dragleave', function(e) {
		let dx = e.pageX - dropZone.offset().left;
		let dy = e.pageY - dropZone.offset().top;
		if ((dx < 0) || (dx > dropZone.width()) || (dy < 0) || (dy > dropZone.height())) {
			dropZone.removeClass('dragover');
		}
	});

	dropZone.on('drop', function(e) {
		dropZone.removeClass('dragover');
		let files = e.originalEvent.dataTransfer.files;
		//sendFiles(files);
        readURL(e.originalEvent.dataTransfer);
	});

	$('#file-input').change(function() {
		let files = this.files;
		//sendFiles(files);
        readURL(this);
	});

    /*
	function sendFiles(files) {
		let maxFileSize = 5242880;
		let Data = new FormData();
		$(files).each(function(index, file) {
			if ((file.size <= maxFileSize) && ((file.type == 'image/png') || (file.type == 'image/jpeg'))) {
				Data.append('file_user_photo', file);
			}
		});

		$.ajax({
			url: dropZone.attr('action'),
			type: dropZone.attr('method'),
			data: Data,
			contentType: false,
			processData: false,
			success: function(data) {
				//alert ('Файлы были успешно загружены!');
			}
		});
	}
    */
    
    /*Для отображения загруженного фото*/
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('#upload-image').attr('src', e.target.result);
            };
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    
});
