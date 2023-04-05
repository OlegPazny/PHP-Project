<?php
    session_start();

    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));

    if($_SESSION['page_id']=="brands"){
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
    }else if($_SESSION['page_id']=="filters"){
        //достаем выбранное
        $_SESSION['page_id']="filters";


        if(isset($_POST['brand'])){
            $_SESSION['brand_selected']=$_POST['brand'];
        }else{
            $_SESSION['brand_selected']="";
        }

        if(isset($_POST['model-menu'])){
            $_SESSION['model_selected']=$_POST['model-menu'];
        }else{
            $_SESSION['model_selected']="";
        }

        if(isset($_POST['price_from'])){
            $_SESSION['price_from']=$_POST['price_from'];
        }else{
            $_SESSION['price_from']="";
        }

        if(isset($_POST['price_to'])){
            $_SESSION['price_to']=$_POST['price_to'];
        }else{
            $_SESSION['price_to']="";
        }

        if(isset($_POST['body'])){
            $_SESSION['body_selected']=$_POST['body'];
        }else{
            $_SESSION['body_selected']="";
        }

        if(isset($_POST['color'])){
            $_SESSION['color_selected']=$_POST['color'];
        }else{
            $_SESSION['color_selected']="";
        }

        if(isset($_POST['engine'])){
            $_SESSION['engine_selected']=$_POST['engine'];
        }else{
            $_SESSION['engine_selected']="";
        }

        if(isset($_POST['gearbox'])){
            $_SESSION['gearbox_selected']=$_POST['gearbox'];
        }else{
            $_SESSION['gearbox_selected']="";
        }

        if(isset($_POST['run_from'])){
            $_SESSION['run_from']=$_POST['run_from'];
        }else{
            $_SESSION['run_from']="";
        }

        if(isset($_POST['run_to'])){
            $_SESSION['run_to']=$_POST['run_to'];
        }else{
            $_SESSION['run_to']="";
        }

        if(isset($_POST['show_last'])){
            $_SESSION['checkbox']=true;
        }else{
            $_SESSION['checkbox']=false;
        }
        //если все поля пустые
        if($_SESSION['brand_selected']==""&&$_SESSION['model_selected']==""&&$_SESSION['price_from']==""&&$_SESSION['price_to']==""&&$_SESSION['body_selected']==""&&$_SESSION['color_selected']==""&&$_SESSION['engine_selected']==""&&$_SESSION['gearbox_selected']==""&&$_SESSION['run_from']==""&&$_SESSION['run_to']==""){
            $where="";
            echo("все поля пустые");
        }
        //если хотябы одно поле НЕпустое
        else if($_SESSION['brand_selected']!=""||$_SESSION['model_selected']!=""||$_SESSION['price_from']!=""||$_SESSION['price_to']!=""||$_SESSION['body_selected']!=""||$_SESSION['color_selected']!=""||$_SESSION['engine_selected']!=""||$_SESSION['gearbox_selected']!=""||$_SESSION['run_from']!=""||$_SESSION['run_to']!=""){
            $where="WHERE";
            $where_arr=array();
            echo("Есть вхождения");

            array_push($where_arr, $_SESSION['brand_selected'], $_SESSION['model_selected'], $_SESSION['price_from'], $_SESSION['price_to'], $_SESSION['body_selected'], $_SESSION['color_selected'], $_SESSION['engine_selected'], $_SESSION['gearbox_selected'], $_SESSION['run_from'], $_SESSION['run_to']);
            //удаление пустых полей
            foreach($where_arr as $elem){
                if($elem==""){
                    unset($where_arr[$elem]);
                }
            }
        }
    }
    
?>