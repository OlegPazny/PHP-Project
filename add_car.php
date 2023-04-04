<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add</title>
    <link rel="stylesheet" type="text/css" href="style/addcar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    
</head>
<body>
    <?php include "script/filters.php";?>
    <?php include "header.php"?>
    <section class="form-section">
        <div class="form-container">
            <h1>Новое объявление</h1>
            <div class="clear" onclick="clear_input()">
                <img src="img/bucket.svg">
                <h5>Очистить все поля</h5>
            </div>
            <form class="filters">
                <div class="filters-row">
                    <div class="filter-selection">
                        <h6>Марка</h6>
                        <select onchange="modal()" id="brand" name="brand">
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
                        <select id="model" name="model" class="custom-select">
                        </select> 
                    </div>
                    <div class="filter-selection">
                        <h6>Год</h6>
                        <input type="text" name="year" id="year">
                    </div>
                </div>
                <div class="filters-row">
                    <div class="filter-selection">
                        <h6>Цена</h6>
                        <input type="text" name="price" id="price">
                    </div>
                    <div class="filter-selection">
                        <h6>Кузов</h6>
                        <select name="body" id="body">
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
                        <select name="color" id="color">
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
                        <select name="engine" id="engine">
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
                        <select name="gearbox" id="gearbox">
                        <?php
                            foreach ($gearbox_arr as $gearbox)
                            {
                                    echo("<option value='".$gearbox."'>".$gearbox."</option>");
                            }
                        ?>
                        </select>
                    </div>
                    <div class="filter-selection">
                        <h6>Пробег</h6>
                        <input type="text" name="run" id="run">
                    </div>
                </div>
                <div class="filters-row">
                <div class="filter-selection">
                    <h6>Город</h6>
                    <input type="text" name="city" id="city">
                </div >
                    <input class="photo-btn" type="file" name="img" value="Добавить фото"></input>
                    <button class="submit-btn" type="submit">Добавить объявление</button>
                </div>
                <textarea name="description" class="description"></textarea>
            </form>
            <p class="message none">error</p>
        </div>
    </section>
    <?php include "footer.html"?>
    <script src="script/clear_filter.js"></script>
    <script src="script/main.js"></script>
</body>
</html>