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
            $brand=$_POST['brand'];
        }else{
            $brand="";
        }

        if(isset($_POST['model-menu'])){
            $model=$_POST['model-menu'];
        }else{
            $model="";
        }

        if(isset($_POST['year_from'])){
            $year_from=$_POST['year_from'];
        }else{
            $year_from="";
        }

        if(isset($_POST['year_to'])){
            $year_to=$_POST['year_to'];
        }else{
            $year_to="";
        }

        if(isset($price_from)){
            $price_from=$price_from;
        }else{
            $price_from="";
        }

        if(isset($price_to)){
            $price_to=$price_to;
        }else{
            $price_to="";
        }

        if(isset($_POST['body'])){
            $body=$_POST['body'];
        }else{
            $body="";
        }

        if(isset($color)){
            $color=$color;
        }else{
            $color="";
        }

        if(isset($engine)){
            $engine=$engine;
        }else{
            $engine="";
        }

        if(isset($gearbox)){
            $gearbox=$gearbox;
        }else{
            $gearbox="";
        }

        if(isset($run_from)){
            $run_from=$run_from;
        }else{
            $run_from="";
        }

        if(isset($run_to)){
            $run_to=$run_to;
        }else{
            $run_to="";
        }

        if(isset($_POST['show_last'])){
            $show_last=true;
        }else{
            $show_last=false;
        }
        //если все поля пустые
        if($brand==""&&$model==""&&$year_from==""&&$year_to==""&&$price_from==""&&$price_to==""&&$body==""&&$color==""&&$engine==""&&$gearbox==""&&$run_from==""&&$run_to=="")
        {
            $query = "SELECT DISTINCT POST.id, `Brand`, `Model`, `Engine`, `Body`, `Gearbox`, `Color`, `City`, `Year`, `Price`, `Run`, `Date`, `Photo` FROM `POST` INNER JOIN `BRANDS` ON `BRANDS`.`id`=`POST`.`ID_Brand` INNER JOIN `MODELS` ON `MODELS`.`id` =`POST`.`ID_Model` INNER JOIN `ENGINES` ON `ENGINES`.`id` =`POST`.`ID_Engine` INNER JOIN `BODIES` ON `BODIES`.`id` =`POST`.`ID_Body` INNER JOIN `GEARBOXES` ON `GEARBOXES`.`id` =`POST`.`ID_Gearbox` INNER JOIN `COLORS` ON `COLORS`.`id` =`POST`.`ID_Color`;";

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
        }
        //если хотябы одно поле НЕ пустое
        else if($brand!=""||$model!=""||$year_from!=""||$year_to!=""||$price_from!=""||$price_to!=""||$body!=""||$color!=""||$engine!=""||$gearbox!=""||$run_from!=""||$run_to!="")
        {
            $where_arr=array();

            if($brand!=""){
                $brand_str="BRANDS.Brand="."\"$brand\"";
                array_push($where_arr,$brand_str);
            }

            if($model!=""){
                $model_str="MODELS.Model="."\"$model\"";
                array_push($where_arr,$model_str);
            }

            if($year_from!=""&&$year_to==""){
                $year_str="POST.Year>".$year_from;
                array_push($where_arr,$year_str);
            }else if($year_from==""&&$year_to!=""){
                $year_str="POST.Year<".$year_to;
                array_push($where_arr,$year_str);
            }else if($year_from!=""&&$year_to!=""){
                $year_str="POST.Year BETWEEN ".$year_from." AND ".$year_to;
                array_push($where_arr,$year_str);
            }

            if($price_from!=""&&$price_to==""){
                $price_str="POST.Price>".$price_from;
                array_push($where_arr,$price_str);
            }else if($price_from==""&&$price_to!=""){
                $price_str="POST.Price<".$price_to;
                array_push($where_arr,$price_str);
            }else if($price_from!=""&&$price_to!=""){
                $price_str="POST.Price BETWEEN ".$price_from." AND ".$price_to;
                array_push($where_arr,$price_str);
            }

            if($body!=""){
                $body_str="BODIES.Body="."\"$body\"";
                array_push($where_arr,$body_str);
            }

            if($color!=""){
                $color_str="COLORS.Color="."\"$color\"";
                array_push($where_arr,$color_str);
            }

            if($engine!=""){
                $engine_str="ENGINES.Engine="."\"$engine\"";
                array_push($where_arr,$engine_str);
            }

            if($gearbox!=""){
                $gearbox_str="GEARBOXES.Gearbox="."\"$gearbox\"";
                array_push($where_arr,$gearbox_str);
            }

            if($run_from!=""&&$run_to==""){
                $run_str="POST.Run>".$run_from;
                array_push($where_arr,$run_str);
            }else if($run_from==""&&$run_to!=""){
                $run_str="POST.Run<".$run_to;
                array_push($where_arr,$price_str);
            }else if($run_from!=""&&$run_to!=""){
                $run_str="POST.Run BETWEEN ".$run_from." AND ".$run_to;
                array_push($where_arr,$run_str);
            }

            //генерация строки where
            $where_string=implode(" AND ", $where_arr);
            $where_string=" WHERE ".$where_string;

            //запрос
            $query = "SELECT DISTINCT POST.id, `Brand`, `Model`, `Engine`, `Body`, `Gearbox`, `Color`, `City`, `Year`, `Price`, `Run`, `Date`, `Photo` FROM `POST` INNER JOIN `BRANDS` ON `BRANDS`.`id`=`POST`.`ID_Brand` INNER JOIN `MODELS` ON `MODELS`.`id` =`POST`.`ID_Model` INNER JOIN `ENGINES` ON `ENGINES`.`id` =`POST`.`ID_Engine` INNER JOIN `BODIES` ON `BODIES`.`id` =`POST`.`ID_Body` INNER JOIN `GEARBOXES` ON `GEARBOXES`.`id` =`POST`.`ID_Gearbox` INNER JOIN `COLORS` ON `COLORS`.`id` =`POST`.`ID_Color`$where_string;";

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
        }
    }
    
?>