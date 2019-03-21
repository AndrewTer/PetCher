<head>
    <link href="css/style-login.css" media="screen" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/share.js"></script>
    <title>Помощь | PetCher</title>
</head>
<div class="header">
    <div class="contain clearfix">
        <a href=""><img id = "logos" src='images/logo.png' width="150" height="50" /></a>
        <nav>
            <a href="login.php">Вход</a>
            <a href="register.php">Регистрация</a>
            <a href="">Правила</a>
            <a href="support_for_user.php">Помощь</a>
            <a href="about.php">О нас</a>
        </nav>
    </div>
</div>
<div class="container_about about">
    <p id="title-about">Раздел помощи</p>
    <hr />
    <p id="title-main-targer-support">Как создать свою страницу <sub>﹀</sub></p>
    <p id="title-main-targer-support">Как добавить информацию о себе <sub>﹀</sub></p>
    <p id="title-main-targer-support">Как добавить питомца <sub>﹀</sub></p>
    <p id="title-main-targer-support">Всё о заказах <sub>﹀</sub></p>
    <p id="title-main-targer-support">Всё о пользователях <sub>﹀</sub></p>
    <p id="title-main-targer-support">Всё об ответах <sub>﹀</sub></p>
    <p id="title-main-targer-support">Всё о заявках <sub>﹀</sub></p>
    <p id="title-main-targer-support">Всё об отзывах <sub>﹀</sub></p>
    <p id="title-main-targer-support">Всё о настройках <sub>﹀</sub></p>

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