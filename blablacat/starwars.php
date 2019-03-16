<html>
    <head>
        <link href="css/starwars.css" media="screen" rel="stylesheet"/>
        <title>О сервисе | PetCher</title>
    </head>
    <body>
    
        <script type="text/javascript">
                // Sets the number of stars we wish to display
                const numStars = 300;
                
                // For every star we want to display
                for (let i = 0; i < numStars; i++) {
                  let star = document.createElement("div");  
                  star.className = "star";
                  var xy = getRandomPosition();
                  star.style.top = xy[0] + 'px';
                  star.style.left = xy[1] + 'px';
                  document.body.append(star);
                }
                
                // Gets random x, y values based on the size of the container
                function getRandomPosition() {  
                  var y = window.innerWidth;
                  var x = window.innerHeight;
                  var randomX = Math.floor(Math.random()*x);
                  var randomY = Math.floor(Math.random()*y);
                  return [randomX,randomY];
                }   
        </script>
        
        <div class="fade"></div>
        
        <section class="star-wars">
          <div class="crawl">
            <div class="title">
              <p>Сервис по передержке домашних животных</p>
              <h1>PetCher</h1>
            </div>
            
            <p>Наша цель - помощь владельцам животных в поиске желающих посидеть с их питомцами на время отсутствия, создавая для этого удобные средства поиска и связи.</p>
            
            <p>2019 год - является годом запуска сервиса PetCher!</p>
        
            <p>Сервис предоставляет возможность поиска пользователей сервиса в 20 городах России!</p>
            
            <p>Остальные города также могут быть указаны пользователями сервиса в описании.</p>
            
            <p>PetCher - недавно начавший свою работу сервис, поэтому, если вам нравится данный сервис, мы будем очень вам признательны, если вы расскажете о нас..</p>
            
          </div>
        </section>
                
    </body>
</html>
