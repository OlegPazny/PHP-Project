<?php
    session_start();

    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));

    //достаем массив, превращаем в строку, потом в массив чтобы работать с массивом
    $user_id=$_SESSION["user"]["id"];
    
    $saved=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT liked FROM USERS WHERE id=$user_id")));
    //если нет сохраненных автомобилей 
    if($saved==NULL){
        echo("У Вас нет сохранённых автомобилей");
    }else{
        $query = "SELECT DISTINCT POST.id, `Brand`, `Model`, `Engine`, `Body`, `Gearbox`, `Color`, `City`, `Year`, `Price`, `Run`, `Date`, `Photo` FROM `POST` 
        INNER JOIN `BRANDS` ON `BRANDS`.`id`=`POST`.`ID_Brand` 
        INNER JOIN `MODELS` ON `MODELS`.`id` =`POST`.`ID_Model` 
        INNER JOIN `ENGINES` ON `ENGINES`.`id` =`POST`.`ID_Engine` 
        INNER JOIN `BODIES` ON `BODIES`.`id` =`POST`.`ID_Body` 
        INNER JOIN `GEARBOXES` ON `GEARBOXES`.`id` =`POST`.`ID_Gearbox` 
        INNER JOIN `COLORS` ON `COLORS`.`id` =`POST`.`ID_Color` WHERE `POST`.`id` IN ($saved)";
        $result = mysqli_query($db, $query) or die("Ошибка" . mysqli_error($db));

        $itemCards= '';
        if ($result) {
            echo "<div class='saved-post-container'>";
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
    }
?>