<?
define('mypetcher', true);
?>
<head>
    <link href="css/style-login.css" media="screen" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/share.js"></script>
    <noscript>
        <meta http-equiv="refresh" content="0; url=noscript" />
    </noscript>
    <title>Правила | PetCher</title>
</head>

<div class="grid-container">
    <div class="container_about about">
            <?php 
                include("includes/logreg_header.php");
            ?>
            
        <p id="title-rules">Правила сервиса</p>
        <hr />
        <div class="block-support-info-rules">
            Ниже представлен небольшой список правил сервиса:<br />
            <ol class="rules-list">
                <li>Будьте вежливы и уважайте других пользователей. Грубости, хамству, оскорблениям и угрозам здесь нет места. Ни в каком виде!</li>
                <li>Старайтесь писать грамотно.</li>
                <li>Здесь не матерятся. Нигде и ни в каком виде!</li>
                <li>Законы РФ нарушаться не должны. Здесь запрещено всё, что запрещено законами РФ!</li>
                <li>Отдельно запрещено размещение всего того, что может потенциально привести к бану сервиса в роскомнадзоре.</li>
                <li>Реклама чего-либо без прямого на то разрешения администрацией запрещена.</li>
                <li>В случае трёх жалоб на вас со стороны других пользователей сервиса ваша страница и все ваши действия на данном сервисе за последнее время идут на рассмотрение администрацией.<br />
                    После рассмотрения два исхода: если жалобы были подтверждены - бан вашей страницы навсегда, иначе - восстановление и предоставление возможности дальнейшего пользования вашей страницей.</li>
                <li>Администрация всегда права. Действия администрации не обсуждаются. Требования администрации обязательны к выполнению.</li>
            </ol>
            Список правил в дальнейшем может быть изменён.
        </div>
    
    </div>
    
    <script>
        $(document).ready(function() {
            $('body').append('<div class="button-up" style="display: none; margin-top:50px; opacity: 0.7;width: 100%;max-width:90px;height:100%;position: fixed;left: 0px;top: 0px;cursor: pointer;text-align: center;line-height: 100px;color: #45688E;">&#9650; Наверх</div>');
            $ (window).scroll (function () {
                if ($ (this).scrollTop () > 300) {
                $ ('.button-up').fadeIn();
                } else {
                $ ('.button-up').fadeOut();
                }
            });
            $('.button-up').click(function(){
                $('body,html').animate({
                    scrollTop: 0
                }, 100);
                return false;
            });
            $('.button-up').hover(function() {
                $(this).animate({
                    'opacity':'1',
                }).css({'background-color':'#E1E7ED','color':'#45688E'});
            }, function(){
                $(this).animate({
                    'opacity':'0.7'
                }).css({'background':'none','color':'#45688E'});;
            });
        });
    </script>
    
    <div class="footer">
    PetCher © 2019
    </div>
</div>