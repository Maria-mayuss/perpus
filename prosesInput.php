<!doctype html> 
<html> 
<head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="assets/css/bootstrap.css"> 
</head> 
<body>

<?php
include "koneksi.php";


$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];



$mysqli = "INSERT INTO tabel_register (id, nama, email, password) VALUES ('$id', '$nama', '$email', '$password')";
$result = mysqli_query($connect, $mysqli);

if ($result) {
  echo "<script>alert('Inputan Berhasil. Terima Kasih')</script>";
  echo "<script>window.location.href='login.php';</script>";
}
else {
  echo "Input gagal";
}

  mysqli_close($connect);

?>


</body> 
</html>