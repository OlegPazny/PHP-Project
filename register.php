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
    <title>reg</title>
    <link rel="stylesheet" type="text/css" href="style/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
    <?php include "header.php"?>
    <section class="form-section">
        <div class="form-container">
            <form>
                <p><label>Ваше имя</label></p>
                <p><input type="text" name="name" class="name" placeholder="Введите своё имя"></p>
                <p><label>Логин</label></p>
                <p><input type="text" name="login" class="login" placeholder="Введите логин"></p>
                <p><label>Email</label></p>
                <p><input type="text" name="email" class="email" placeholder="Введите почту"></p>
                <p><label>Номер телефона</label></p>
                <p><input type="text" name="number" class="number" placeholder="Введите номер телефона"></p>
                <p><label>Пароль</label></p>
                <p><input type="password" name="password" class="password" placeholder="Введите пароль"></p>
                <p><input type="password" name="password_confirm" class="password" placeholder="Повторите введенный пароль"></p>
                <p><button type="submit" class="register-btn">Зарегистрироваться</button></p>
                <p><a href="auth.php" class="have-acc">Уже есть аккаунт?</a></p>
                <p class="message none">error</p>
            </form>
        </div>
    </section>
    <?php include "footer.html"?>
    <script src="script/main.js"></script>
</body>
</html>