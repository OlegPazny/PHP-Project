<?php
    session_start();

    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));

    
    $brands = mysqli_query($db, "SELECT * FROM `BRANDS`");
    $brands = mysqli_fetch_all($brands);
    echo "<div class='brands-container'>";
    $i=0;
    foreach ($brands as $brand){

        echo 
        //  /jsda/card.php&id=$brand[0]
            "<div class='brand-card' id='$brand[0]'> 
                <a href='search_results.php?id=$brand[0]'><img src='$brand[2]'></a>
                <p>$brand[1]</p>
            </div>";
    };
    echo "</div>";

?>