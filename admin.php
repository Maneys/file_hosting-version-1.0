<?php
session_start();
require_once 'include/connect.php';

if (!$_SESSION['user']) {
    header('Location: /');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="main">
	<div class="h-1">
    <h1>ПАНЕЛЬ АДМИНИСТРАТОРА</h1>
        <div class="warning-info">
            <h3>ВНИМАНИЕ!!! Разрешено сохранять только файлы резервных конфигураций!!!<br>
                ЗАГРУЗКА ЗАПРЕЩЕНЫХ ФАЙЛОВ КАРАЕТСЯ введением анального зонтика!!!</h3>
        </div>
	</div>
	<div class="button_upload" style='margin-top: 20px';>
		<a href='type.php?typ=1' style='margin-right: 30px';>Мои архивы конфигураций</a>
    		<a href='type.php?typ=2' style='margin-left: 30px';>Информация</a>
	</div>


<?php
$check_bd = pg_query($dbconn, "SELECT full_name, login, otdel, podchin, user_folder FROM table1;");
$res = pg_fetch_all($check_bd);

$check_rows = pg_num_rows($check_bd);
$check_fields = pg_numfields($check_bd);

	echo "<div class = 'h-3'> <h3> СПИСОК ПОЛЬЗОВАТЕЛЕЙ </h3> </div>";

	echo "<div class = 'table'>";
echo "<table>";

echo "<th style='padding-bottom: 10px; padding-top: 5px; padding-night: 20px; padding-left: 10px; border-bottom-width: 1px; border-bottom-style: solid; border-right-width: 1px; border-right-style: solid; padding-right: 10px'>Имя пользователя</th><th style='padding-bottom: 10px; padding-top: 5px; padding-night: 20px; padding-left: 10px; border-bottom-width: 1px; border-bottom-style: solid; border-right-width: 1px; border-right-style: solid; padding-right: 10px;'>Логин</th><th style='padding-bottom: 10px; padding-top: 5px; padding-night: 20px; padding-left: 10px; border-bottom-width: 1px; border-bottom-style: solid; border-right-width: 1px; border-right-style: solid; padding-right: 10px;'>Отдел</th><th style='padding-bottom: 10px; padding-top: 5px; padding-night: 20px; padding-left: 10px; border-bottom-width: 1px; border-bottom-style: solid; border-right-width: 1px; border-right-style: solid; padding-right: 10px;'>Подчиненность</th><th style='padding-bottom: 10px; padding-top: 5px; padding-night: 20px; padding-left: 10px; border-bottom-width: 1px; border-bottom-style: solid; border-right-width: 0px; border-right-style: solid; padding-right: 10px;'>Файлы пользователя</th>";

foreach ($res as $key) {
    $tr = 1;
    if ($tr <= $check_rows) {
        $dir_user_backups = "uploads/" . $key["user_folder"] . "backups/";
        $a_user_backups = "<a href='lists.php?list=$dir_user_backups'>БЭКАПЫ</a>";
/*
        $dir_user_info = "uploads/" . $key["user_folder"] . "info/";
        $a_user_info = "<a href='lists.php?list=$dir_user_info'>ИНФО</a>";
*/
        echo "<tr><td style='padding: 10px;'>" . $key["full_name"] . "</td><td style='padding: 10px;'>" . $key["login"] . "</td><td style='padding: 10px;'>" . $key["otdel"] . "</td><td style='padding: 10px;'>" . $key["podchin"] . "</td><td style='padding: 10px;'>" ."<pre>$a_user_backups  $a_user_info</pre>". "</td></tr>";
        $tr = $tr +1;
    }
}
echo "</table>";
	echo "</div>";

?>
	<dev class = "upload_button">
    <form enctype="multipart/form-data" action="upload.php" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        <input name="userfile" type="file" />
        <input type="submit" value="Загрузить файл (максимальный размер файла  - 2 Мб)" />
    </form>
	</dev>

    <form>
        <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
        <a href="#"><?= $_SESSION['user']['otdel'] ?></a>
        <a href="include/logout.php" class="logout">Выход</a>
    </form>

</div>
</body>
</html>
