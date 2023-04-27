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
    <link rel="stylesheet" type="text/css" href="style/admin.css">
</head>
<body>
    <section class="header-section">
        <h1>Панель администратора</h1>
        <form action="script/logout.php">
            <button class="logout-btn" type="submit">Выйти из аккаунта</button>
        </form>
    </section>
    <section class="post-section">
        <?php include "script/admin_script.php"?>
    </section>
</body>
</html>