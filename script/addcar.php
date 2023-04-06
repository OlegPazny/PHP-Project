<?php
    session_start();
    
    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));
    
    $brand=$_POST['brand'];
    $model=$_POST['model'];
    $year=$_POST['year'];
    $price=$_POST['price'];
    $body=$_POST['body'];
    $color=$_POST['color'];
    $engine=$_POST['engine'];
    $gearbox=$_POST['gearbox'];
    $run=$_POST['run'];
    $city=$_POST['city'];
    $description=$_POST['description'];

    //валидация
    $error_fields=[];

    if($brand===''){
        $error_fields[]='brand';
    }

    if($model===''){
        $error_fields[]='model';
    }
    
    if($year===''||!preg_match("/^19[0-9]{2}|20[01][0-9]|202[0-3]$/", $year)){
        $error_fields[]='year';
    }

    if($price===''||!preg_match("/^[1-9]\d*$/", $price)){
        $error_fields[]='price';
    }
    
    if($body===''){
        $error_fields[]='body';
    }
    
    if($color===''){
        $error_fields[]='color';
    }

    if($engine===''){
        $error_fields[]='engine';
    }

    if($gearbox===''){
        $error_fields[]='gearbox';
    }
    
    if($run===''||!preg_match("/^[1-9]\d*$/", $run)){
        $error_fields[]='run';
    }

    if($city===''||!preg_match("/^[А-Я][а-я]+$/", $city)){
        $error_fields[]='city';
    }

    if(!$_FILES['img']){
        $error_fields[]='img';
    }

    // if($description===''||!strlen($description)<4294967295||!preg_match("/^(?!\s*$)[-\/'.,\ 0-9а-яА-Я-zA-Z]+$/", $description)){
    if($description===''||!strlen($description)>4294967295){
        $error_fields[]='description';
    }

    if(!empty($error_fields)){
        $response=[
            "status"=>false,
            "type"=>1,
            "message"=>"Заполните поля корректно",
            "fields"=>$error_fields
        ];

        echo json_encode($response);
        die();
    }
    $path='img/'.time().$_FILES['img']['name'];
    if(!move_uploaded_file($_FILES['img']['tmp_name'],'../'.$path)){
        $response=[
            "status"=>false,
            "type"=>2,
            "message"=>"Ошибка при загрузке изображения"
        ];
        echo json_encode($responce);
    }

    $id_user=$_SESSION["user"]["id"];
    $id_brand=mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM `BRANDS` WHERE Brand='$brand'"))['id'];
    $id_model=mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM `MODELS` WHERE Model='$model'"))['id'];
    $id_engine=mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM `ENGINES` WHERE Engine='$engine'"))['id'];
    $id_body=mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM `BODIES` WHERE Body='$body'"))['id'];
    $id_gearbox=mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM `GEARBOXES` WHERE Gearbox='$gearbox'"))['id'];
    $id_color=mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM `COLORS` WHERE Color='$color'"))['id'];


    mysqli_query($db, "INSERT INTO `POST` (`id`, `ID_User`, `ID_Brand`, `ID_Model`, `ID_Engine`, `ID_Body`, `ID_Gearbox`, `ID_Color`, `Photo`, `City`, `Year`, `Price`, `Run`, `Description`) VALUES (NULL, '$id_user', '$id_brand', '$id_model', '$id_engine', '$id_body', '$id_gearbox', '$id_color', '$path', '$city', '$year', '$price', '$run', '$description')");

    $response=[
        "status"=>true,
        "message"=>"Добавление автомобиля успешно",
    ];
    echo json_encode($response);
?>