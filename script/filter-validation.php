<?php
    session_start();

    $error_fields=[];

    $year_from=$_POST['year_from'];
    $year_to=$_POST['year_to'];
    $price_from=$_POST['price_from'];
    $price_to=$_POST['price_to'];
    $run_from=$_POST['run_from'];
    $run_to=$_POST['run_to'];

    if($year_from!=''&&!preg_match("/^19[0-9]{2}|20[01][0-9]|202[0-3]$/", $year_from)){
        $error_fields[]='year_from';
    }

    if($year_to!=''&&!preg_match("/^19[0-9]{2}|20[01][0-9]|202[0-3]$/", $year_to)){
        $error_fields[]='year_to';
    }

    if($year_from!=''&&$year_to!=''){
        $int_year_from=(int)$year_from;
        $int_year_to=(int)$year_to;

        if($int_year_to<$int_year_from){
            $error_fields[]='year values';
        }else if($int_year_to==$int_year_from){
            $error_fields[]='year values equals';
        }
    }

    if($price_from!=''&&!preg_match("/^[1-9]\d*$/", $price_from)){
        $error_fields[]='price_from';
    }

    if($price_to!=''&&!preg_match("/^[1-9]\d*$/", $price_to)){
        $error_fields[]='price_to';
    }

    if($price_from!=''&&$price_to!=''){
        $int_price_from=(int)$price_from;
        $int_price_to=(int)$price_to;

        if($int_price_to<$int_price_from){
            $error_fields[]='price values';
        }else if($int_price_to==$int_price_from){
            $error_fields[]='price values equals';
        }
    }

    if($run_from!=''&&!preg_match("/^[1-9]\d*$/", $run_from)){
        $error_fields[]='run_from';
    }

    if($run_to!=''&&!preg_match("/^[1-9]\d*$/", $run_to)){
        $error_fields[]='run_to';
    }

    if($run_from!=''&&$run_to!=''){
        $int_run_from=(int)$run_from;
        $int_run_to=(int)$run_to;

        if($int_run_to<$int_run_from){
            $error_fields[]='run values';
        }else if($int_run_to==$int_run_from){
            $error_fields[]='run values equals';
        }
    }

    if(!empty($error_fields)){
        $response=[
            "status"=>false,
            "type"=>1,
            "message"=>"Проверьте правильность полей",
            "fields"=>$error_fields
        ];

        echo json_encode($response);
        die();
    }else if(empty($error_fields)){
        $response=[
            "status"=>true,
            "message"=>"Поля заполнены верно",
        ];

        echo json_encode($response);
    }
?>