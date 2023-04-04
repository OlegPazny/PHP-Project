<?php
    session_start();

    // if($_SESSION['user']){
    //     header('Location:account.php');
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>auth</title>
    <link rel="stylesheet" type="text/css" href="style/auth_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    
</head>
<body>
    <?php include "header.php"?>
    <section class="form-section">
        <div class="form-container">
            <form>
                <p><label>Логин</label></p>
                <p><input type="text" name="login" class="login" placeholder="Введите свой логин"></p>
                <p><label>Пароль</label></p>
                <p><input type="password" name="password" class="password" placeholder="Введите пароль"></p>
                <p><button type="submit" class="login-btn">ВОЙТИ</button></p>
                <a href="register.php"><p class="no-acc">У меня нет аккаунта</p></a>
                <p class="message none"></p>
            </form>
        </div>
    </section>
    <?php include "footer.html"?>
    <script src="script/main.js"></script>
</body>
</html>