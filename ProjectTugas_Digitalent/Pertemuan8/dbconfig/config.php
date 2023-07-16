<?php

    $server = "localhost";
    $user = "root";
    $password = "";
    $nama_database = "db_form";

    $db = mysqli_connect($server,$user,$password,$nama_database);

    if(!$db){
        die("<script = text/javascript> alert('Koneksi Bermasalah') </sript>".mysqli_connect_error());
    }

?>