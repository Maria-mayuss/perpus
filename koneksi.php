<?php
error_reporting(E_ALL ^ E_NOTICE);
// buka koneksi ke database server
    // sesuaikan dengan database sendiri
    $hostname="localhost"; // sesuaikan
    $username="root"; // sesuaikan
    $password=""; //sesuaikan
    $database="perpus";
    if (!$connect=mysqli_connect($hostname,$username,$password))
    {
        echo mysqli_error($connect);
        exit;
    }
    else 
    {
    // select default database
        mysqli_select_db($connect, $database);
    }
?>