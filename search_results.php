<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>поиск</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/search.css">
</head>
<body>
    <?php include "header.php"?>
    <section class="post-section">
        <h2>Результаты поиска</h2>
        <?php include "script/search_result.php"?>
    </section>
    <?php include "footer.html"?>
</body>
</html>