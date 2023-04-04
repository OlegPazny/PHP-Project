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
    INNER JOIN `COLORS` ON `COLORS`.`id` =`POST`.`ID_Color`;";

    $result = mysqli_query($db, $query) or die("Ошибка" . mysqli_error($db));
    $itemCards= '';
    if ($result) {
        echo "<div class='last-post-container'>";
        for ($i=0; $i < mysqli_num_rows($result); $i++) {
            $rows = mysqli_fetch_row($result);
            $itemCards .="
                <div class='post'>
                    <a href='post.php?id=$rows[0]'>
                        <figure>
                            <img src='$rows[12]'>
                        </figure>
                    </a>
                    <div class='post-info'>
                        <div class='post-txt'>
                            <h4>$rows[1] $rows[2]</h4>
                            <h6>$rows[9]$</h6>
                            <h6>$rows[8] г., $rows[5], $rows[3], $rows[4], $rows[10] км</h6>
                        </div>
                        <img src='img/saved_big.svg'>
                        <form action='admin.php' method='post'>
                            <input type='submit' name='delete' value='$rows[0]'>Удалить</input>
                        </form>
                    </div>
                </div>";
        }
        echo $itemCards;
        echo "</div>";
    }
    if(isset($_POST['delete'])){
        $id=mysqli_real_escape_string($db, $_POST['delete']);
        $query=("DELETE FROM POST WHERE id=$id");
        if(mysqli_query($db,$query)){
            echo("Товар удален");
        }
    }
?>