<?php
    session_start();

    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));

    $id=$_GET["id"];
    $user_id=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT ID_User FROM POST WHERE POST.id=$id")));

    $brand=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Brand FROM BRANDS INNER JOIN POST ON BRANDS.id=POST.ID_Brand WHERE POST.id=$id")));
    $model=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Model FROM MODELS INNER JOIN POST ON MODELS.id=POST.ID_Model WHERE POST.id=$id")));
    $img=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Photo FROM POST WHERE POST.id=$id")));
    $gearbox=mb_strtolower(implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Gearbox FROM GEARBOXES INNER JOIN POST ON GEARBOXES.id=POST.ID_Gearbox WHERE POST.id=$id"))));
    $engine=mb_strtolower(implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Engine FROM ENGINES INNER JOIN POST ON ENGINES.id=POST.ID_Engine WHERE POST.id=$id"))));
    $body=mb_strtolower(implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Body FROM BODIES INNER JOIN POST ON BODIES.id=POST.ID_Body WHERE POST.id=$id"))));
    $year=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Year FROM POST WHERE POST.id=$id")));
    $city=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT City FROM POST WHERE POST.id=$id")));
    $date=strstr(implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Date FROM POST WHERE POST.id=$id"))), ' ', true);
    $id=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM POST WHERE POST.id=$id")));
    $price=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Price FROM POST WHERE POST.id=$id")));
    $run=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Run FROM POST WHERE POST.id=$id")));
    $color=mb_strtolower(implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Color FROM COLORS INNER JOIN POST ON COLORS.id=POST.ID_Color WHERE POST.id=$id"))));
    $description=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT Description FROM POST WHERE POST.id=$id")));
    $number=implode('',mysqli_fetch_assoc(mysqli_query($db, "SELECT DISTINCT number FROM `USERS` INNER JOIN `POST` ON USERS.id=POST.ID_User WHERE POST.ID_User=$user_id;
    ")));
?>