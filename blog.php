<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/cs.css">
    <link href="css/highslide.css" rel="stylesheet" property="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>

    <div class="popup-contener" id="contPopup">
        <div id="popup"> 
            <div class="popup-content">
                <button onclick="closePopup()">
                    <div id="mdiv">
                        <div class="mdiv">
                            <div class="md"></div>
                        </div>
                  </div></button>
                <h2 align ="center" style="margin-bottom: 20px">Авторизация</h2>

                <form action="php/autorization.php" method="post" enctype="multipart/form-data">
                    <div id="loginSignField" class="signElem">
                        <input type="text" id="name" name="login" placeholder="Login" required>
                    </div>
                    <div id="passwordSignField" class="signElem">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div align = "center" id="buttonSignField" class="signElem">
                        <input type="submit" value="Войти">
                    </div>
                    <?php 
                        if ($_SESSION['message'])
                        echo '<p align = "center" style="color: red;">' . $_SESSION['message'] . '</p>';
                        unset($_SESSION['message']);
                    ?>
                    
                </form>
            </div>
        </div>
    </div>
    
    <div id="cursor"></div>
    <div id="headOfHead"><h1><b>Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_Блог_</b></h1></div>
    <div class="header">
        <button onclick="openPopup()" id="autorization">Авторизация</button>
        <a style="color:#000" href="news.html"><div id = "lefthead" class="bothhead"><b>Новости</b></div></a>
        <a style="color:#000" href="index.html"><div id = "righthead" class="bothhead"><b>Главная</b></div></a>
        <h1><b>Севостьянов Сергей Вячеславович</b></h1>
        <br>
        <h2>25.04.2003 - <span id="current_date_time_block2"></span></h2>
        <br>
        <nav  class="header_nav">
            <ul>
                <li class="links"><a>aburgomeistus@yandex.ru</a></li>
                <li class="links"><a href="https://vk.com/aposlane">vk.com/aposlane</a></li>
                <li class="links"><a href="https://mykp.ru/aposlane">mykp.ru/aposlane</a></li>
                <li class="links"><a href="https://github.com/deus0machine">github.com/deus0machine</a></li>
            </ul>
        </nav>
    </div>
<section class="content">
    <article >
        <div id="blog_photo">
            asdasdsd
        </div>
    </article>
    <article style="width: 100%;">
        <div class="container my-3"> 
            <h1>Заметки, комментарии и отзывы</h1> 
            <hr class="hrBlog"> 
            <div id="notes" class= "row container-fluid"> 
            </div> 
            <hr class="hrBlog">  
            <?php
            if ($_SESSION['user'])
            echo '<h1>Пишите здесь</h1> 
                 <div class="card"> 
                <div class="card-body"> 
                    <p class="card-title"> 
                         Добавить от имени "_____"
                    </p> 
                    <div class="form-group"> 
                        <textarea class="form-control"
                            id="addTxt" rows="3"></textarea> 
                    </div> 
                    <button class="btn btn-primary" id="addBtn"> 
                        <b>Add Note</b> 
                    </button> 
                </div> 
            </div> ';
            else echo '<h1>Авторизуйтесь чтобы оставлять сообщения...</h1>'
            ?>
        </div> 
    </article>
        <script src="js/blog.js"></script> 
</section>


<script src="js/highslide.js" type="text/javascript"></script>
<script src="js/functional.js"></script>
</body>
</html>