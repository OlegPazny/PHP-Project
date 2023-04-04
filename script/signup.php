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

    if($login===''){
        $error_fields[]='login';
    }

    if($name===''){
        $error_fields[]='name';
    }
    
    if($email==='' || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error_fields[]='email';
    }

    if($number===''){
        $error_fields[]='number';
    }
    
    if($password===''){
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