<?php
    // mengkoneksikan php ke database
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'db_sekolah';

    $conn = mysqli_connect($host, $user, $password, $db);
    mysqli_select_db($conn, $db);

?>