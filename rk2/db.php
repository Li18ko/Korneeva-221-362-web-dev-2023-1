<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'lizakornee');
    define('DB_PASSWORD', 'Korneeva_1867');
    define('DB_NAME', 'lizakornee');
    $mysql = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    if ($mysql == false) {
        print("Ошибка подключения: " . $mysql->connect_error);
    }
?>