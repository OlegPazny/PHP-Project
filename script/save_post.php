<?php
    session_start();

    $host="localhost";
    $database="project1";
    $user="root";
    $password="";
    $db=mysqli_connect($host, $user, $password, $database) or die("Ошибка ".mysqli_error($db));

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
        $user_id=$_SESSION["user"]["id"];
        //достаем массив, превращаем в строку, потом в массив чтобы работать с массивом
            $saved=implode('', mysqli_fetch_assoc(mysqli_query($db, "SELECT liked FROM USERS WHERE id='$user_id'")));
            $saved_arr=explode(",", $saved);
            $saved_arr = array_map('trim', $saved_arr);

            if(isset($_POST['save'])){
                if(in_array($id,$saved_arr)){
                    $key=array_search($id,$saved_arr);
                    unset($saved_arr[$key]);
                }else{
                    if($saved_arr[0]==""){
                        unset($saved_arr[0]);
                        array_push($saved_arr, $id);
                    }else if(!array_search($id, $saved_arr)){
                        array_push($saved_arr, $id);
                    }
                }
                $saved_arr=array_unique($saved_arr);
                $saved=implode(", ", $saved_arr);
            
                $query="UPDATE USERS SET liked='$saved' WHERE id='$user_id'";
                mysqli_query($db, $query);
            }
        //подгрузка цвета иконки в зависимости от бд
            if(in_array($id,$saved_arr)){
                $save_img="
                    <form action='' method='post'>
                        <button name='save' class='save'><img src='img/post_save_yellow.svg'></button>
                    </form>";
            }else if(!in_array($id,$saved_arr)){
                $save_img="
                    <form action='' method='post'>
                        <button name='save' class='save'><img src='img/post_save.svg'></button>
                    </form>";
            }
    }else{
        $save_img="";
    }
    
?>