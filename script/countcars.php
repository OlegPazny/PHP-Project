<?php
        session_start();

        $host="localhost";
        $database="project1";
        $user="root";
        $password="";
        $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));
    
        $query = "SELECT DISTINCT POST.id, `Brand`, `Model`, `Engine`, `Body`, `Gearbox`, `Color`, `City`, `Year`, `Price`, `Run`, `Date`, `Photo` FROM `POST` 
        INNER JOIN `BRANDS` ON `BRANDS`.`id`=`POST`.`ID_Brand` 
        INNER JOIN `MODELS` ON `MODELS`.`id` =`POST`.`ID_Model` 
        INNER JOIN `ENGINES` ON `ENGINES`.`id` =`POST`.`ID_Engine` 
        INNER JOIN `BODIES` ON `BODIES`.`id` =`POST`.`ID_Body` 
        INNER JOIN `GEARBOXES` ON `GEARBOXES`.`id` =`POST`.`ID_Gearbox` 
        INNER JOIN `COLORS` ON `COLORS`.`id` =`POST`.`ID_Color` ORDER BY `POST`.`Date` DESC;";
    
        $result = mysqli_query($db, $query) or die("Ошибка" . mysqli_error($db));
    
        $count=mysqli_num_rows($result);
?>