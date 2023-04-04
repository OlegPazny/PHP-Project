<?php
    session_start();

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
        $header_btn='"account.php"';
    }else{
        $header_btn='"auth.php"';
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="script/scroll.js"></script>
<header>
    <div class="list">
        <div class="nav">
            <a href="index.php">
                <h4>Главная</h4>
            </a>
            <a href="brands.php">
                <h4>Производители</h4>
            </a>
            <a href="#">
                <h4>Контакты</h4>
            </a>
        </div>
        <div class="account">
            <a href="account.php#anchor"><img src="img/saved_small.svg"></a>
            <a href=<?php echo($header_btn)?>>
                <h4>
                    <?php
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
                            echo($_SESSION['user']['name']);
                        }else{
                            echo('Вход/Регистрация');
                        }
                        ?>
                </h4>
            </a>
            <a href=<?php echo($header_btn)?>><img src="img/account.svg"></a>
        </div>
    </div>
</header>