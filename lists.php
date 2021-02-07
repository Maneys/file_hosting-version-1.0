<?php
session_start();

$list = $_GET['list'];

if (!$_GET['list']) {
    header('Location: admin.php');
}

echo '
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>';

echo '
<!-- Кнопка возврата назад -->
<div class="button_back">
    <a href="admin.php">Назад</a>
   	</div>
<div class="main">
';


$files = scandir($list);
$key1 = array_search('.', $files);
unset($files[$key1]);


$key2 = array_search('..', $files);
unset($files[$key2]);


foreach ($files as $value) {
	echo " <a href='$list$value'> ";
	echo " <div class='nameTxt'> ";
	echo $value;
	echo " </div> ";
	echo " </a> ";
}

echo"
    </div>
</body>
</html>
";

?>
