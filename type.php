<?php
session_start();

$typ = $_GET['typ'];
if ($typ == 1) {
	foreach($_SESSION["user"] as $key) {
		$res = ($key["user_folder"]);
		$dir = "uploads/" . $res . "backups/";
	}
	
	$pTitle = "Мои архивы кофигураций";
}
elseif ($typ == 2) {
	foreach($_SESSION["user"] as $key) {
		$res = ($key["user_folder"]);
		$dir = "uploads/" . $res . "info/";
	}
 	$pTitle = "Общая информация";
}
else {
    header('Location: profile.php');
}
   
echo '
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>'.$pTitle.'</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>';

foreach($_SESSION['user'] as $key) {
	if ($key["id_user"] == "101") {
		echo '
		<!-- Кнопка возврата назад -->
		<div class="button_back">
    	    <a href="admin.php">Назад</a>
    	</div>
		<div class="main">
		';
	} else {
		echo '
		<!-- Кнопка возврата назад -->
		<div class="button_back">
    	    <a href="profile.php">Назад</a>
    	</div>
		<div class="main">
		';
    }
}


$files = scandir($dir);
$key1 = array_search('.', $files);
unset($files[$key1]);
$key2 = array_search('..', $files);
unset($files[$key2]);


foreach ($files as $value) {
	echo " <a href='$dir$value'> ";
	echo " <div class='nameTxt'> ";
	echo " $value ";
	echo " </div> ";
	echo " </a> ";
}

echo"
    </div>
</body>
</html>
";

?>
