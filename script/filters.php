<?php
    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($link));
    //для бренда
    $brand_type = mysqli_query($db, "SELECT Brand FROM BRANDS");
    $i = 0;
    while ($row = mysqli_fetch_assoc($brand_type))
    {
        $brand_arr[$i] = $row['Brand'];
        $i++;
    }
    //для моделей
    $model_type = mysqli_query($db, "SELECT Model FROM MODELS");
    $i = 0;
    while ($row = mysqli_fetch_assoc($model_type))
    {
        $model_arr[$i] = $row['Model'];
        $i++;
    }
    // для кузова
    $body_type = mysqli_query($db, "SELECT Body FROM BODIES");
    $i = 0;
    while ($row = mysqli_fetch_assoc($body_type))
    {
        $body_arr[$i] = $row['Body'];
        $i++;
    }
    //для двигателя
    $engine_type = mysqli_query($db, "SELECT Engine FROM ENGINES");
    $i = 0;
    while ($row = mysqli_fetch_assoc($engine_type))
    {
        $engine_arr[$i] = $row['Engine'];
        $i++;
    }
    //для коробки
    $gearbox_type = mysqli_query($db, "SELECT Gearbox FROM GEARBOXES");
    $i = 0;
    while ($row = mysqli_fetch_assoc($gearbox_type))
    {
        $gearbox_arr[$i] = $row['Gearbox'];
        $i++;
    }
    //для цвета
    $color_type = mysqli_query($db, "SELECT Color FROM COLORS");
    $i = 0;
    while ($row = mysqli_fetch_assoc($color_type))
    {
        $color_arr[$i] = $row['Color'];
        $i++;
    }
?>