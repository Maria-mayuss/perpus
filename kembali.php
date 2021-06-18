<?php
include "koneksi.php";
date_default_timezone_set('Asia/Makassar');
$tanggal = date("Y-m-d H:i:sa");

$id_pinjam = $_GET['id_pinjam'];

$queryUpdate = mysqli_query($connect, "UPDATE meminjam SET tgl_kembali='$tanggal' WHERE id_pinjam='$id_pinjam'");
if ($queryUpdate) {
  echo "<script>alert('Buku Berhasil dipesan.')</script>";
  echo "<script>window.location.href='pinjam.php';</script>";
} else {
  echo "<script>alert('Gagal dipesan.')</script>";
  echo "<script>window.location.href='pinjam_buku.php';</script>";
}
