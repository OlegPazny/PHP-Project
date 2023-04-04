<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post</title>
    <link rel="stylesheet" type="text/css" href="style/post.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="script/saved.js"></script>
</head>
<body>
    <?php include "header.php"?>
    <?php include "script/post.php"?>
    <?php include "script/save_post.php"?>
    <section class="post">
        <div class="post-container">
            <div class="post-head">
                <?php 
                ?>
                <h1><?php echo($brand);?> <?php echo($model)?>, <?php echo($year)?> года в г. <?php echo($city)?></h1>
                <div class="post-btns">
                    <img src="img/post_copy.svg">
                    <form action="" method="post">
                        <button name="save" class="save"><img src="<?php echo($save_img)?>"></button>
                    </form>
                </div>
            </div>
            <div class="post-data">
                <h6>Добавлено <?php echo($date)?></h6>
                <h6>№<?php echo($id)?></h6>
            </div>
            <div class="info-block">
                <figure>
                    <img src="<?php echo($img)?>">
                </figure>
                <div class="info">
                    <div class="data">
                        <h2><?php echo($price)?>$</h2>
                        <h3><?php echo($year)?> г., КПП <?php echo($gearbox)?>, <?php echo($engine)?>,<br/><?php echo($body)?>, <?php echo($run)?> км</h3>
                        <h3><?php echo($color)?></h3>
                    </div>
                    <div class="button">
                        <h3><?php echo($city)?></h3>
                        <button id="number-btn" onclick="number()">Показать номер</button>
                        <p class="number"><?php echo($number);?></p>
                    </div>
                </div>
            </div>
            <div class="description">
                <h1>Описание</h1>
                <h3><?php echo($description)?></h3>
            </div>
        </div>
    </section>
    <script src="script/show_number.js"></script>
    <?php include "footer.html"?>
</body>
</html>