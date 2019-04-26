<?
defined('mypetcher') or header("Location: ../403.php");
?>
<div class="header">
    <div class="contain clearfix">
        <a href=""><img id = "logos" src='images/logo.png' width="150" height="50" /></a>
        <nav>
            <a href="login"><div class="menu">Вход</div></a>
            <a href="register"><div class="menu">Регистрация</div></a>
            <a href="rules"><div class="menu">Правила</div></a>
            <a href="about"><div class="menu">О нас</div></a>
        </nav>
    </div>
</div>

<div class="header-min">
    <div class="contain clearfix">
        <a href=""><img id = "logos" src='images/logo.png' width="150" height="50" /></a>
        <div class="hamburger-menu">
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn" for="menu__toggle">
              <span></span>
            </label>
        
            <ul class="menu__box">
                <li><a class="menu__item" href="login">Вход</a></li>
                <li><a class="menu__item" href="register">Регистрация</a></li>
     			<li><a class="menu__item" href="rules">Правила</a></li>
     			<li><a class="menu__item" href="about">О нас</a></li>
            </ul>
        </div>
    </div>
</div>