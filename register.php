
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
    <title>ДОБРО ПОЖАЛОВАТЬ В АД</title>
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
    <header>
        <div class="container">
    <form action="include/signup.php" method="post"> 
            <label>ФИО </label>
            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Введите свое полное имя"><br>
            <label>Логин</label>
            <input type="text" class="form-control" name="login" id="login" placeholder="Введите свой логин"><br>
            <label>Подразделение</label>
            <input type="text" class="form-control" name="otdel" id="otdel" placeholder="Введите номер подразделения"><br>
            <label>Подчиненность</label>
            <input type="text" class="form-control" name="podchin" id="podchin"  placeholder="Укажите принадлежность (2,14,41,нп)"><br>
            <label>Пароль</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"><br>
            <label>Подтверждение пароля</label>
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Подтвердите пароль"><br>
            <button class="btn btn-success" type="submit">Зарегистрироваться</button><br>
            <p>
                Если у Вас создана учетная запись - <a href="/">АВТОРИЗИРУЙТЕСЬ!</a>
            </p>

        <?php
       
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
            
        ?>

    </form>

</body>
</html>
