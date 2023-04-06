<?php
    session_start();
    
    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));
    
    $login=$_POST['login'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $number=$_POST['number'];
    $password=$_POST['password'];
    $password_confirm=$_POST['password_confirm'];

    //проверка на существование логина
    $check_login=mysqli_query($db, "SELECT * FROM `USERS` WHERE `login`='$login'");

    if(mysqli_num_rows($check_login)>0){
        $response=[
            "status"=>false,
            "type"=>1,
            "message"=>"Такой пользователь уже существует",
            "fields"=>['login']
        ];
        echo json_encode($response);
        die();
    }
    //валидация
    $error_fields=[];

    if($login===''||preg_match("/^[a-z0-9_-]{3,16}$/",$login)==0){
        $error_fields[]='login';
    }

    if($name===''||preg_match("/^[А-Я][-а-яА-Я]+$/",$name)==0){
        $error_fields[]='name';
    }
    
    if($email==='' || !filter_var($email, FILTER_VALIDATE_EMAIL)||preg_match("/^[\w\.-]+@[a-z]+\.[a-z]+$/",$email)==0){
        $error_fields[]='email';
    }

    if($number===''||preg_match("/^((\+375)+([0-9]){9})$/",$number)==0){
        $error_fields[]='number';
    }
    
    if($password===''||preg_match("/^[a-zA-Z0-9]{8,}$/",$password)==0){
        $error_fields[]='password';
    }
    
    if($password_confirm===''){
        $error_fields[]='password_confirm';
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
    }

    
    if($password===$password_confirm){
        $password=md5($password);

        mysqli_query($db, "INSERT INTO `USERS` (`id`, `login`, `password`, `number`, `name`, `email`, `isAdmin`, `liked`) VALUES (NULL, '$login', '$password', '$number', '$name', '$email', b'0', NULL)");

        $response=[
            "status"=>true,
            "message"=>"Регистрация успешна",
        ];
        echo json_encode($response);
    }else{
        $response=[
            "status"=>false,
            "message"=>"Регистрация неуспешна, пароли не совпадают",
        ];
        echo json_encode($response);
    }
?>