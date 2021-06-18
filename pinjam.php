<?php
error_reporting(E_ALL ^ E_NOTICE);
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perpustakaan Pinjam</title>
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
</head>
<?php
include "koneksi.php";

$uname = $_COOKIE['username'];
$pass = $_COOKIE['password'];

if (!isset($uname)) {
?>
  <script>
    alert('Cookie Habis');
    document.location = 'login.php';
  </script>
<?php
  exit;
}

$cekIdLogin = mysqli_query($connect, "SELECT id_login FROM tabel_login WHERE email='$uname' AND password='$pass'");
$infoLogin = mysqli_fetch_array($cekIdLogin);
$id_login = $infoLogin['id_login'];

$cekId = mysqli_query($connect, "SELECT nama_depan , nama_belakang FROM anggota WHERE id_anggota='$id_login'");
$info = mysqli_fetch_array($cekId);
$nama_depan = $info['nama_depan'];
$nama_belakang = $info['nama_belakang'];

?>
Cookie anda : <?= $uname ?>


<body>

  <table width="1300" border="1" align="center">
    <tr>
      <td colspan="2" align="center">
        <h1>Sistem Informasi Perpustakaan</h1>
      </td>
    </tr>
    <tr>
      <td width="200">
        <ul>
          <li><a href="index.php">Beranda</a></li>
          <li><a href="lihatdata.php">List Anggota</a></li>
          <li><a href="buku.php" class="las la-book">Buku</a></li>
          <li><a href="pinjam.php" class="las la-clipboard-list">Pinjam</a></li>
          <li><a href="logout.php">Logout</a></li>
          <ul>
      </td>
      <td width="500">
        <a href="pinjam_buku.php" class="las la-file">Pinjam buku</a>
        <p style='color: #DD2F6E;'><b>Buku yang Sedang Dipinjam </b> </p>
        <table class="table table-bordered">
          <thead>
            <tr>
            <th>Date & Time</th>
              <th>Nama Peminjam</th>
              <th>Buku</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $cekIdLogin = mysqli_query($connect, "SELECT id_login FROM tabel_login WHERE email='$uname' AND password='$pass'");
            $infoLogin = mysqli_fetch_array($cekIdLogin);
            $id_login = $infoLogin['id_login'];

            $queryinfo = mysqli_query($connect, "SELECT * FROM meminjam,buku,anggota,tabel_detail_pinjam WHERE anggota.id_anggota = tabel_detail_pinjam.id_login and buku.id_buku = tabel_detail_pinjam.id_buku and meminjam.id_pinjam = tabel_detail_pinjam.id_pinjam and anggota.id_anggota = '$id_login' and meminjam.tgl_kembali = '000-00-00 00:00:00' ");
            /*$no = 1;*/
            while ($pinjam = mysqli_fetch_array($queryinfo)) {

            ?>
              <tr>
                <!--td></*?php echo $no?>*/</td-->
                <td><?= $pinjam['tgl_pinjam'] ?></td>
                <td><?= $pinjam['nama_depan'] ?> <?= $pinjam['nama_belakang'] ?></td>
                <td class="center"><?= $pinjam['judul_buku'] ?></td>

                <td class="center"><a href="pinjam.php?hapus=ok&id_pinjam=<?= $pinjam['id_pinjam'] ?>"><button type="button" class="btn btn-sm btn-danger"><i class="las la-trash-alt"></i> Hapus</button></a></td>
                <form method="kembali.php" action="POST">
                  <input type="hidden" name="id_pinjam" value=<?= $pinjam['id_pinjam']; ?> />
                  <td><button type="submit" name="kembali" class="btn btn-sm btn-danger"><a href="kembali.php?id_pinjam=<?= $pinjam['id_pinjam']; ?>"> Kembali </a></button></td>
                </form>
              </tr>


            <?php /*$no++;*/
            }

            ?>
          </tbody>
        </table><br>

        <?php
        if (isset($_GET['hapus'])) {
          $id_pinjam = $_GET['id_pinjam'];
          $querydelete = mysqli_query($connect, "DELETE FROM tabel_detail_pinjam WHERE id_pinjam='$id_pinjam'");

          if ($querydelete) {
            $querydeletePinjam = mysqli_query($connect, "DELETE FROM meminjam WHERE id_pinjam='$id_pinjam'");
            if ($querydeletePinjam) {
              echo "<script>alert('Buku Berhasil dihapus.')</script>";
              echo "<script>window.location.href='pinjam.php';</script>";
            } else {
              die('Gagal Bro/Sist' . mysqli_error($connect));
            }
          } else {
            die('Gagal Bro/Sist' . mysqli_error($connect));
          }
        }
        ?>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Date & Time</th>
              <th>Nama Peminjam</th>
              <th>Buku</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $cekIdLogin = mysqli_query($connect, "SELECT id_login FROM tabel_login WHERE email='$uname' AND password='$pass'");
            $infoLogin = mysqli_fetch_array($cekIdLogin);
            $id_login = $infoLogin['id_login'];

            $queryinfo = mysqli_query($connect, "SELECT * FROM meminjam,buku,anggota,tabel_detail_pinjam WHERE anggota.id_anggota = tabel_detail_pinjam.id_login and buku.id_buku = tabel_detail_pinjam.id_buku and meminjam.id_pinjam = tabel_detail_pinjam.id_pinjam and anggota.id_anggota = '$id_login' ");
            /*$no = 1;*/
            while ($pinjam = mysqli_fetch_array($queryinfo)) {
            ?>
              <tr>
                <!--td></*?php echo $no?>*/</td-->
                <td><?= $pinjam['tgl_pinjam'] ?></td>
                <td><?= $pinjam['nama_depan'] ?> <?= $pinjam['nama_belakang'] ?></td>
                <td class="center"><?= $pinjam['judul_buku'] ?></td>

              </tr>


            <?php /*$no++;*/
            }

            ?>
          </tbody>
        </table><br>
</body>

</html>