<?php
        if(session_status()!== PHP_SESSION_ACTIVE) session_start();
        function get_model(){
            $arr=[];
        if ($_GET['mark']) {
            //     $models = R::findAll('model', 'mark_id = :mark_id order by model', [':mark_id' => (int) $_GET['mark']]);
            //     print json_encode($model);
            // }
            $host="localhost";
            $database="project1";
            $user="root";
            $password="";
            $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));

            $mark=$_GET['mark'];
            // var_dump($mark);
            $model_type = mysqli_query($db, "SELECT Model FROM MODELS INNER JOIN BRANDS ON BRANDS.id=MODELS.ID_Brand WHERE BRANDS.Brand='$mark'");
            $i = 0;
            while ($row = mysqli_fetch_assoc($model_type)) {
                $arr[] = $row['Model'];
                
            }
            echo json_encode($arr);
        }
        // var_dump($arr);
    }
    get_model();
?>