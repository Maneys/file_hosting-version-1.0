<?php

$dbconn = pg_connect("host=localhost dbname=filehosting user=userdb password=12345678");

    if (!$dbconn) {
        die('What a Fack DB');
    }

?>
