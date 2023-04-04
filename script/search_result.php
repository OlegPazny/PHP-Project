<?php
    session_start();

    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));

    $id=$_GET["id"];

    $query = "SELECT DISTINCT POST.id, `Brand`, `Model`, `Engine`, `Body`, `Gearbox`, `Color`, `City`, `Year`, `Price`, `Run`, `Date`, `Photo` FROM `POST` INNER JOIN `BRANDS` ON `BRANDS`.`id`=`POST`.`ID_Brand` INNER JOIN `MODELS` ON `MODELS`.`id` =`POST`.`ID_Model` INNER JOIN `ENGINES` ON `ENGINES`.`id` =`POST`.`ID_Engine` INNER JOIN `BODIES` ON `BODIES`.`id` =`POST`.`ID_Body` INNER JOIN `GEARBOXES` ON `GEARBOXES`.`id` =`POST`.`ID_Gearbox` INNER JOIN `COLORS` ON `COLORS`.`id` =`POST`.`ID_Color` WHERE BRANDS.id=$id ORDER BY `POST`.`Date` DESC;";

    $result = mysqli_query($db, $query) or die("Ошибка" . mysqli_error($db));

    $itemCards= '';
    if ($result) {
        echo "<div class='post-container'>";
        for ($i=0; $i < mysqli_num_rows($result); $i++) {
            $rows = mysqli_fetch_row($result);
            $itemCards .="
            <a href='post.php?id=$rows[0]'>
                <div class='post'>
                    <figure>
                        <img src='$rows[12]'>
                    </figure>
                    <div class='post-info'>
                        <div class='post-txt'>
                            <h4>$rows[1] $rows[2]</h4>
                            <h6>$rows[9]$</h6>
                            <h6>$rows[8] г., $rows[5], $rows[3], $rows[4], $rows[10] км</h6>
                        </div>
                    </div>
                </div>
            </a>";
        }
        echo $itemCards;
        echo "</div>";
    }
?>