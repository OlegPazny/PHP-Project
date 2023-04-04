<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style/account_style.css">
</head>
<body>
    <?php include "header.php"?>
    <section class="info-section">
        <h1>Аккаунт</h1>
        <div class="info-container">
            <div>
                <h2>Имя: <?php echo($_SESSION["user"]["name"])?></h2>
                <h2>Email: <?php echo($_SESSION["user"]["email"])?></h2>
                <h2>Номер телефона: <?php echo($_SESSION["user"]["number"])?></h2>
            </div>
            <form action="add_car.php">
                <button class="new-post-btn" type="submit">Создать объявление</button>
            </form>
            <form action="script/logout.php">
                <a><button class="logout-btn" type="submit">Выйти из аккаунта</button></a>
            </form>
        </div>
    </section>
    <section class="my-post-section">
        <h1>Мои автомобили</h1>
        <?php include "script/my_post.php"?>
    </section>
    <section class="saved-section">
        <h1>Избранное</h1>
        <span id="anchor"></span>
        <?php include "script/saved_cars.php"?>
    </section>
    <?php include "footer.html"?>
    
</body>
</html>