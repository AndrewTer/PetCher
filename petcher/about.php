<?
define('mypetcher', true);
include("stat.php");
?>
<head>
    <link href="css/style-login.css" media="screen" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/share.js"></script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
       m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
    
       ym(53791042, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
       });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/53791042" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <noscript>
        <meta http-equiv="refresh" content="0; url=noscript" />
    </noscript>
    <title>О сервисе | PetCher</title>
</head>

<div class="grid-container">
    <div class="container_about about">
        <?php 
            include("includes/logreg_header.php");
        ?>
        
        <p id="title-about">PetCher - сервис по передержке домашних животных</p>
        <hr />
        <p id="title-main-targer">Наша цель - помощь владельцам животных в поиске желающих посидеть с их питомцами на время отсутствия, создавая для этого удобные средства поиска и связи.</p>
        <hr />
        <p id="title-main-year-start">2019 год - является годом запуска сервиса PetCher !</p>
        
        <div class="div-for-map">
            <p id="text-for-map">PetCher предоставляет возможность поиска пользователей сервиса в 20 городах России</p>
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
        
        <p id="text-for-map-add">Для ознакомления с правилами данного сервиса вы можете обратиться к разделу, ссылка на который приведена ниже</p>
        
        <div class="links-for-help-and-rules">
            <div id="links-for-rules-photo">
                <a rel="nofollow" href="rules">
                    <img src="images/rules-icon.png" alt="" width="100%" />';
                </a>
            </div>
            <div class="clear"></div>
        </div>
        
        <hr />
        
        <p id="text-for-map-add">Специально для любителей саги <a class="url-help" href="starwars">Звёздные войны</a> у нас есть отдельно оформленный текст.</p>
        <hr />
        
        <p id="text-for-map-add">PetCher - недавно начавший свою работу сервис, поэтому, если вам нравится данный сервис, мы будем очень вам признательны, если вы расскажете о нас:</p>
    
        
    <script type="text/javascript">(function(w,doc) {
    if (!w.__utlWdgt ) {
        w.__utlWdgt = true;
        var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
        s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
        s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
        var h=d[g]('body')[0];
        h.appendChild(s);
    }})(window,document);
    </script>
    <div style="text-align: center;" data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1837300" data-mode="share" data-background-color="#ffffff" data-share-shape="round-rectangle" data-share-counter-size="13" data-icon-color="#ffffff" data-mobile-sn-ids="fb.vk.tw.ok.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.fb.tw.ok.wh.tm." data-preview-mobile="false" data-selection-enable="false" data-exclude-show-more="true" data-share-style="13" data-counter-background-alpha="1.0" data-top-button="false" class="uptolike-buttons" ></div>
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
