<?php 
    session_start();
    require_once 'php/DB.php';
    function autoriz(){
        $dsf = new DB();
        $login = $_POST['login'];
        $password = $_POST['password'];
    
        $check_user = $dsf->select("SELECT * FROM `users` where login = '$login' and password ='$password';");
        if (count($check_user) > 0){
            $user = $check_user[0];
            //$_SESSION['user'] = ["login" => $user['login']];
            setcookie('user', $user['login'], time() + (86400 * 30), '/');
        }
        else{
            $_SESSION['message'] = 'Неверные данные';
        }
    }
    if ($_POST['login'] && $_POST['password']){
        autoriz();
        unset($_POST['password']);
        unset($_POST['login']);
    }
    function sendNote(){
        require_once 'php/connect.php';
        $text = $_POST['comment'];
        $author = $_SESSION['user']['login'];
        mysqli_query($connct, "INSERT INTO 'notes' (head, body) VALUES ($author, $text)");
    }
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

                <form action="" method="post" enctype="multipart/form-data">
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
        <?php
        // if (!$_SESSION['user']) 
        // echo '<button onclick="openPopup()" id="autorization">Авторизация</button>';
        // else
        // echo '<a href ="php/logout.php"><button id="autorization">Выйти</button></a>';
        if (isset($_COOKIE['user'])){
            echo '<a href ="php/logout.php"><button id="autorization">Выйти</button></a>';
        } else {
            echo '<button onclick="openPopup()" id="autorization">Авторизация</button>';
        }
        ?>
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
                <?php 
                    $dsf = new DB();
                    $sql = "SELECT * FROM notes";
                    $result = $dsf->select($sql);
                    foreach($result as $note){
                            echo '<div class="noteCard my-2 mx-2 card" style="width: 24rem;">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Note by <b>' . $note["head"] . '</b> ' . $note["date"] . '</h5>';
                            echo '<p class="card-text">' . $note["body"] . '</p>';
                            //if($_SESSION['user']['login'] == 'admin')
                            if (isset($_COOKIE['user']) && $_COOKIE['user'] == 'admin')
                            {
                                echo '<button id="' . $note["id"] . '" onclick="deleteNote(this.id)" class="btn btn-primary">Delete Note</button>';
                            }
                            
                            echo '</div>';
                            echo '</div>';
                        }
                ?>
            </div> 
            <hr class="hrBlog">  
            <?php
            //if ($_SESSION['user']){
            if (isset($_COOKIE['user'])){
            echo '<h1>Пишите здесь</h1> 
                 <div class="card"> 
                <div class="card-body"> 
                    <p class="card-title"> 
                         Добавить от имени <b id="author">';
                        //print $_SESSION['user']['login'];
                        print $_COOKIE['user'];
            echo '</b></p> 
                    <div class="form-group"> 
                        <textarea name="comment" class="form-control"
                            id="addTxt" rows="3"></textarea> 
                    </div>
                    <button class="btn btn-primary" id="addBtn" onclick="addNote()"> 
                            <b>Add Note</b> 
                        </button>'; 
            echo    '</div> 
            </div> ';}
            else echo '<h1>Авторизуйтесь чтобы оставлять сообщения...</h1>'
            ?>
        </div> 
    </article>

</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
<script>
    function checkAdmin() {
        return (typeof Cookies.get('user') !== 'undefined' && Cookies.get('user') === 'admin');
    }
    function displayNotes(notes) {
        $('#notes').empty(); 
        for (var i = 0; i < notes.length; i++) {
            var note = notes[i];
            var noteHtml = '<div class="noteCard my-2 mx-2 card" style="width: 24rem;">' +
                '<div class="card-body">' +
                '<h5 class="card-title">Note by <b>' + note["head"] + '</b> ' + note["date"] + '</h5>' +
                '<p class="card-text">' + note["body"] + '</p>';
            if (checkAdmin()) {
                noteHtml += '<button id="' + note["id"] + '" onclick="deleteNote(this.id)" class="btn btn-primary">Delete Note</button>';
            }
            noteHtml += '</div></div>';
            $('#notes').append(noteHtml);
        }
    }

    function deleteNote(id) {
        $.ajax({
            type: "POST",
            url: "php/delete_note.php", 
            data: { noteId: id },
            success: function(response) {
                alert(response);

                $.ajax({
                    url: 'php/get_notes.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        displayNotes(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred while fetching notes:', error);
                        console.log(xhr.responseText); 
                }});
            },
            error: function(xhr, status, error) {
                alert('Error occurred while deleting note');
            }
        });
    }

    function addNote() {
        var noteText = $('#addTxt').val(); 
        var author = $('#author').text();
        $.ajax({
            type: "POST",
            url: "php/add_note.php", 
            data: { noteText: noteText , author : author},
            success: function(response) {
                alert(response); 

                $.ajax({
                    url: 'php/get_notes.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        displayNotes(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred while fetching notes:', error);
                        console.log(xhr.responseText); 
                }});
            },
            error: function(xhr, status, error) {
                alert('Error occurred while adding note');
            }
        }
        );
        
    };
</script>
<script src="js/highslide.js" type="text/javascript"></script>
<script src="js/functional.js"></script>
</body>
</html>