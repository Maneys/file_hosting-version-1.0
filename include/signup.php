<?php

    session_start();
    require_once 'connect.php';

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $otdel = $_POST['otdel'];
    $podchin = $_POST['podchin'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {
        $password = md5($password);
        $check_user_bd = pg_query($dbconn, "SELECT login FROM table1 WHERE login = '$login';");

        if (pg_num_rows($check_user_bd) > 0) {
            $_SESSION['message'] = 'Пользователь с данным логином уже существует';
            header('Location: ../register.php');
        } else {
            $user_date = date("YmdHms");
            $user_patch = $login . "-" . $user_date . "/";
            mkdir("/var/www/html/web/pus/uploads/" . $user_patch, 0700);
            mkdir("/var/www/html/web/pus/uploads/" . $user_patch . "backups/", 0700);
            //mkdir("/var/www/html/web/pus/uploads/" . $user_patch . "info/", 0700);

            pg_query($dbconn, "INSERT INTO table1 (full_name, login, otdel, podchin, password, id_user, user_folder) VALUES ('$full_name', '$login', '$otdel', '$podchin', '$password', '0', '$user_patch')");
		

            $_SESSION['message'] = 'Регистрация прошла успешно!';
            header('Location: ../index.php');
        }

    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../register.php');
    }

?>
