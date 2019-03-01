<head>
    <link href="css/style-login.css" media="screen" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/share.js"></script>
    <title>О сервисе | BlaBlaCat</title>
</head>
<div class="header">
    <div class="contain clearfix">
        <a href=""><img id = "logos" src='images/logo.png' width="150" height="50" /></a>
        <nav>
            <a href="login.php">Вход</a>
            <a href="register.php">Регистрация</a>
            <a href="">Правила</a>
            <a href="">Помощь</a>
            <a href="about.php">О нас</a>
        </nav>
    </div>
</div>
<div class="container_about about">
    <p id="title-about">BlaBlaCat - сервис по передержке домашних животных</p>
    <hr />
    <p id="title-main-targer">Наша цель - помощь владельцам животных в поиске желающих посидеть с их питомцами на время отсутствия, создавая для этого удобные средства поиска и связи.</p>
    <hr />
    <p id="title-main-year-start">2019 год - является годом запуска сервиса BlaBlaCat !</p>
    
    <div class="div-for-map">
        <p id="text-for-map">BlaBlaCat предоставляет возможность поиска пользователей сервиса в 20 городах России</p>
        <img id="map_about" width="100%" src="images/map_about.png"/>
        <span class="metka moscow" title="Москва"></span>
        <span class="metka st_petersburg" title="Санкт-Петербург"></span>
        <span class="metka volgograd" title="Волгоград"></span>
        <span class="metka vladivostok" title="Владивосток"></span>
        <span class="metka voronezh" title="Воронеж"></span>
        <span class="metka yekaterinburg" title="Екатеринбург"></span>
        <span class="metka kazan" title="Казань"></span>
        <span class="metka kaliningrad" title="Калининград"></span>
        <span class="metka krasnodar" title="Краснодар"></span>
        <span class="metka krasnoyarsk" title="Красноярск"></span>
        <span class="metka nizhny_novgorod" title="Нижний Новгород"></span>
        <span class="metka novosibirsk" title="Новосибирск"></span>
        <span class="metka omsk" title="Омск"></span>
        <span class="metka permian" title="Пермь"></span>
        <span class="metka rostov_on_don" title="Ростов-на-Дону"></span>
        <span class="metka samara" title="Самара"></span>
        <span class="metka ufa" title="Уфа"></span>
        <span class="metka chelyabinsk" title="Челябинск"></span>
        <span class="metka sevastopol" title="Севастополь"></span>
        <span class="metka simferopol" title="Симферополь"></span>
    </div>
    <p id="text-for-map-add">Остальные города России также могут быть указаны пользователями сервиса в описании.</p>
    <hr />
    
    <!--<p id="text-for-map-add">Главная задача сервиса - собрать людей, которым нужна помощь с тем, чтобы посидеть с их питомцами, и людей, которые могут предложить свои услуги ситтера за договоренную сумму, в одном месте.</p>
    
    <hr />-->
    
    <p id="text-for-map-add">Для ознакомления с правилами данного сервиса, а также по вопросам пользования, вы можете обратиться к разделам, ссылки на которые приведены ниже</p>
    
    <div class="links-for-help-and-rules">
        <div id="links-for-help-photo">
            <a rel="nofollow" href="help.php">
                <img src="images/help-icon.png" alt="" width="100%" />';
            </a>
        </div>
        <div id="links-for-rules-photo">
            <a rel="nofollow" href="rules.php">
                <img src="images/rules-icon.png" alt="" width="100%" />';
            </a>
        </div>
        <div class="clear"></div>
    </div>
    
    <hr />
    
    <p id="text-for-map-add">Если есть какие-либо пожелания или вопросы, ответы на которые вы не смогли найти в разделе <a class="url-help" href="help.php">Помощь</a>, то вы можете написать сюда</p>
    <h4>Дополнить</h4>
    <hr />
    
    <p id="text-for-map-add">Специально для любителей саги <a class="url-help" href="starwars.php">Звёздные войны</a> у нас есть отдельно оформленный текст</p>
    <hr />
    
    <p id="text-for-map-add">BlaBlaCat - недавно начавший свою работу сервис, поэтому, если вам нравится данный сервис, мы будем очень вам признательны, если вы расскажете о нас:</p>

    <div style="text-align: center;" data-path="images/" class="shareinit"></div>
    

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
BlaBlaCat © 2019
</div>
