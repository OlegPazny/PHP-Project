<?php if(session_status()!== PHP_SESSION_ACTIVE) session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <title>main</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <?php include "script/filters.php";?>
    <?php include "header.php";?>
    <section class="brands">
        <div class="brands-section">
            <h1>52326 объявлений о<br />продаже авто</h1>
            <?php include "script/show_brand_names.php"?>
            <form action="brands.php">
                <button class="brands-btn" type="submit">Все марки</button>
            </form>
        </div>
    </section>

    <section class="search">
        <div class="search-section">
            <h3>Поиск по параметрам</h3>
            <form class="filters" action="search_results.php" method="POST">
                <div class="filters-row">
                    <div  class="filter-selection">
                        <h6>Марка</h6>
                        <select onchange="modal()" name="brand" id="brand">
                            <option disabled selected value>Выбрать</option>
                            <?php
                                foreach ($brand_arr as $brand)
                                {
                                    echo("<option value='$brand'>$brand</option>");
                                }
                            ?>
                            </select>
                            <script type="text/javascript">
                                function modal(){
                                    let val= $('#brand').val();
                                    $.ajax({
                                        url: "script/models.php?mark="+val,
                                        success: function(data){
                                            document.querySelector("#model").innerHTML = '';
                                            document.querySelector('#model').innerHTML += `<option disabled selected value>Выбрать</option>`;
                                            JSON.parse(data).forEach(element => {
                                                document.querySelector('#model').innerHTML += `<option value="${element}">${element}</option>`;
                                            });
                                        }
                                    });
                                }
                            </script>
                        
                    </div>
                    <div class="filter-selection">
                        <h6>Модель</h6>
                        <select id="model" name="model-menu" class="custom-select">
                            <option disabled selected value>Выбрать</option>
                        </select> 
                    </div>
                    <div class="filter-selection double">
                        <h6>Год</h6>
                        <input placeholder="от" name="year_from" id="year" type="text">
                        <input placeholder="до" name="year_to" id="year2">
                    </div>
                </div>
                <div class="filters-row">
                    <div class="filter-selection double">
                        <h6>Цена</h6>
                        <input placeholder="от" name="price_from" id="price">
                        <input placeholder="до" name="price_to" id="price2">
                    </div>
                    <div class="filter-selection">
                        <h6>Кузов</h6>
                        <select id="body" name="body">
                            <option disabled selected value>Выбрать</option>
                            <?php
                                foreach ($body_arr as $body)
                                {
                                    echo("<option value='".$body."'>".$body."</option>");
                                }
                            ?>
                        </select>
                    </div>
                    <div class="filter-selection">
                        <h6>Цвет</h6>
                        <select id="color" name="color">
                            <option disabled selected value>Выбрать</option>
                            <?php
                                foreach ($color_arr as $color)
                                {
                                        echo("<option value='".$color."'>".$color."</option>");
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="filters-row">
                    <div class="filter-selection">
                        <h6>Дрыгатель</h6>
                        <select id="engine" name="engine">
                            <option disabled selected value>Выбрать</option>
                            <?php
                                foreach ($engine_arr as $engine)
                                {
                                    echo("<option value='".$engine."'>".$engine."</option>");
                                }
                            ?>
                        </select>
                    </div>
                    <div class="filter-selection">
                        <h6>КПП</h6>
                        <select id="gearbox" name="gearbox">
                            <option disabled selected value>Выбрать</option>
                            <?php
                                foreach ($gearbox_arr as $gearbox)
                                {
                                        echo("<option value='".$gearbox."'>".$gearbox."</option>");
                                }
                            ?>
                        </select>
                    </div>
                    <div class="filter-selection double">
                        <h6>Пробег</h6>
                        <input placeholder="от" name="run_from" id="run">
                        <input placeholder="до" name="run_to" id="run2">
                    </div>
                </div>
                <div class="filters-row">
                    <div class="check-section">
                        <div class="check-elem">
                            <input class="checkbox" type="checkbox" name="show_last">
                            <h6>Показать последние</h6>
                        </div>
                    </div>
                    <button class="filter-btn reset" type="button" onclick="clear_input()">Сбросить</button>
                    <input class="filter-btn submit" type="submit" value="Показать 124 объявлений"></input>
                </div>
            </form>
        </div>
    </section>

    <section class="last-post">
        <h3>Последние объявления</h3>
        <div class="last-post-block">
            <?php include "script/car_card.php"?>
            <input type="button" class="more-post-btn" value="Показать ещё">
        </div>

    </section>
    <script src="script/clear_filter.js"></script>
    <?php include "footer.html"?>
</body>

</html>