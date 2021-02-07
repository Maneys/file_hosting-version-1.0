<?php
session_start();


foreach($_SESSION["user"] as $key) {
	$res = ($key["user_folder"]);
	$upload_dir = "uploads/" . $res;
}

$upload_file = $upload_dir . basename($_FILES["userfile"]["name"]); 

if(
    isset(
        $_FILES["userfile"], $_FILES["userfile"]["tmp_name"],
        $_FILES["userfile"]["name"], $_FILES["userfile"]["size"],
        $_FILES["userfile"]["error"]
    )
){

    $accepted_backups = array(
	    "application/x-rar-compressed" => "rar",
	    "application/x-rar" => "rar",
	    "application/octet-stream" => "rar",
	    "application/x-tar" => "tar",
	    "application/zip" => "zip",
	    "application/gzip" => "gz",
	    "application/x-gzip" => "gz",
	);


	$accepted_info = array(
		"application/msword" => "doc",
		"application/vnd.openxmlformats-officedocument.wordprocessingml.document" => "docx",
		"application/vnd.ms-excel" => "xls",
		"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" => "xlsx",
        	"text/plain" => "txt",
	);

    $maxSize = 2000000; // 2 MB

    if( UPLOAD_ERR_OK !== $_FILES["userfile"]["error"] ){

        echo "Ошибка загрузки файла: ", $_FILES["userfile"]["error"], "<br/>";

    } elseif ( $_FILES["userfile"]["size"] > $maxSize ) {
        echo "Ошибка: Размер файла слишком большой.<br/>";

    } else {
        $finfo = finfo_open( FILEINFO_MIME );
        $mime = finfo_file( $finfo, $_FILES["userfile"]["tmp_name"] );
        $mime = array_shift( explode( ';', $mime ) );
		
        if( ! array_key_exists( $mime, $accepted_backups ) )  /* or use isset: ! isset( $accepted[ $mime ] ) */ {

            echo 'Ошибка: Неподдерживаемый тип файла. <br/>';
		} else {
			$user_datas = pg_query($dbconn, "SELECT id_user FROM table1 WHERE login = '$login' AND password = '$password';");
			$_SESSION['user'] = pg_fetch_all($user_datas);
			foreach($_SESSION['user'] as $key) {
				if ($key["id_user"] == "101") {
					if ( array_key_exists( $mime, $accepted_backups ) || array_key_exists( $mime, $accepted_info )) {
						$upload_file = $upload_dir . "backups/" . basename($_FILES["userfile"]["name"]);
						move_uploaded_file($_FILES["userfile"]["tmp_name"], $upload_file);
						echo "Файл ". htmlspecialchars( basename( $_FILES["userfile"]["name"])). " был загружен в папку 'Мои архивы конфигураций'. <br/>";
					}
					elseif ( array_key_exists( $mime, $accepted_info ) ) {
						$upload_file = $upload_dir . "info/" . basename($_FILES["userfile"]["name"]);
						move_uploaded_file($_FILES["userfile"]["tmp_name"], $upload_file);
						echo "Файл ". htmlspecialchars( basename( $_FILES["userfile"]["name"])). " был загружен в папку 'Информация'. <br/>";
					}
					
				} 
				elseif ($key["id_user"] == "0") {
					if ( array_key_exists( $mime, $accepted_backups )) {
						$upload_file = $upload_dir . "backups/" . basename($_FILES["userfile"]["name"]);
						move_uploaded_file($_FILES["userfile"]["tmp_name"], $upload_file);
						echo "Файл ". htmlspecialchars( basename( $_FILES["userfile"]["name"])). " был загружен в папку 'Мои архивы конфигураций'. <br/>";
						}
				}
			}	   
		}
	}
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Страница статуса загрузки</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <!-- Кнопка возврата назад -->
    <form>
        <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
        <a href="#"><?= $_SESSION['user']['otdel'] ?></a>
    <?php        
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
    ?>
    </form>

</body>
</html>

        
