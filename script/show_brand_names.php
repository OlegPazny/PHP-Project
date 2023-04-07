<?php
    session_start();

    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));

    // $_SESSION['brands']="filters";
    $brands = mysqli_query($db, "SELECT `Brand`, count(POST.ID_Brand), `BRANDS`.`id` FROM BRANDS INNER JOIN POST ON POST.ID_Brand=BRANDS.id GROUP BY BRANDS.id ORDER BY `Brand`;
    ");

    $_SESSION['page_id']="brand_list";

    $item='';
    echo "<div class='brands-block'>";
    echo "<ul class='brands-list'>";
    for($i=0; $i<mysqli_num_rows($brands); $i++){
        $rows=mysqli_fetch_row($brands);
        $item .="
        <li><a class='brand-name' href='search_results.php?id=$rows[2]'>$rows[0]</a> <span class='amount'>$rows[1]</span></li>
        ";
    }
    echo "</ul>";
    echo $item;
    echo "</div>";
?>