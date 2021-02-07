<?php
session_start();

if ($_SESSION['user']) {
    header('Location: profile.php');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация и регистрация</title>
    <style> body {
        width: 100%;
        background-image: url(images/site.jpg);
        background-blend-mode: multiply;
        background-color: #2e3a44;
        background-size: cover;
        color: rgb(255, 0, 0); ;} </style>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


    <form action="include/signin.php" method="post">
        <label>Логин</label>
        <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин">
        <label>Пароль</label>
        <input type="password" class="form-control" name="password" id="login" placeholder="Введите пароль">
        <button class="btn btn-success" type="submit">Войти</button>
        <p>
            <a href="register.php">Зарегистрироваться!</a>
	</p>
    
    
        <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        
        ?>

</body>
</html>
