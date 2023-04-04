<?php
    session_start();
    
    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));
    
    $login=$_POST['login'];
    $password=$_POST['password'];

    //валидация
    $error_fields=[];

    if($login===''){
        $error_fields[]='login';
    }

    if($password===''){
        $error_fields[]='password';
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

    $password=md5($password);//хеш пассворда

    $check_user=mysqli_query($db, "SELECT * FROM `USERS` WHERE `login`='$login' AND `password`='$password'");
    $is_admin=implode('',mysqli_fetch_assoc(mysqli_query($db, "SELECT isAdmin FROM `USERS` WHERE `login`='$login'")));

    if(mysqli_num_rows($check_user)>0){
        if($is_admin==0){
            $user=mysqli_fetch_assoc($check_user);

            $_SESSION['user']=[
                "id"=>$user['id'],
                "name"=>$user['name'],
                "number"=>$user['number'],
                "email"=>$user['email'],
                "liked"=>$user['liked'],
            ];

            $response=[//ответ авторизации
                "status"=>true,
                "isAdmin"=>false
            ];

            // header('Location: ../account.php');
            echo json_encode($response);

            $_SESSION['loggedin'] = true;
        }else if($is_admin==1){
            $user=mysqli_fetch_assoc($check_user);

            $_SESSION['user']=[
                "id"=>$user['id'],
                "name"=>$user['name'],
                "number"=>$user['number'],
                "email"=>$user['email'],
                "liked"=>$user['liked'],
            ];

            $response=[//ответ авторизации
                "status"=>true,
                "isAdmin"=>true
            ];

            // header('Location: ../account.php');
            echo json_encode($response);
            $_SESSION['loggedin'] = true;
        }
    }else{
        // $_SESSION['message']='Неверный логин или пароль';
        // header('Location: auth.php');
        $response=[//ответ авторизации
            "status"=>false,
            "message"=>'Авторизация неуспешна',
        ];

        echo json_encode($response);
    }
?>