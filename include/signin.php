<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = md5($_POST['password']);

$check_user = pg_query($dbconn, "SELECT login, password FROM table1 WHERE login = '$login' AND password = '$password';");

if (pg_num_rows($check_user) > 0) {
    $user_datas = pg_query($dbconn, "SELECT full_name, login, otdel, podchin, id, id_user, user_folder FROM table1 WHERE login = '$login' AND password = '$password';");
    $_SESSION['user'] = pg_fetch_all($user_datas);
    
    foreach($_SESSION['user'] as $key) {
        if ($key["id_user"] == "101") {
            header('Location: ../admin.php');
        } else {
            header('Location: ../profile.php');
        }
    }
    

    

} else {
    $_SESSION['message'] = "Не верный логин или пароль";
    header('Location: ../index.php');
}

    ?>

