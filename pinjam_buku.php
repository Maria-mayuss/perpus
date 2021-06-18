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
  <title>Perpustakaan Pinjam_Buku</title>
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
        <h1>Selamat Datang Peminjaman Perpustakaan</h1>
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
        <form method="post" action="pinjam_buku.php">
          <table class="table table-bordered">
            <div class="form-group row">
              <label class="control-label col-sm-2" for="np">Nama Peminjam :</label>
              <div class="col-sm-4">
                <input type="text" id="password" value="<?php echo $nama_depan . ' ' . $nama_belakang; ?>" name="password" readonly>
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-sm-2" for="jb">Judul Buku :</label>
              <div class="col-sm-4">
                <?php
                $sql_buku = mysqli_query($connect, "SELECT * FROM buku ORDER BY id_buku");
                $kueri_buku = ($sql_buku) or die(mysqli_error($connect));
                ?>
                <select name="buku">
                  <?php
                  while (list($kode, $nama_status) = mysqli_fetch_array($kueri_buku)) {
                  ?>
                    <option value="<?= $kode ?>"><?= $nama_status ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" name="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                <!--button type="reset" name="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Hapus</button>
                <a href="logout.php" class="btn btn-dark"><i class="fas fa-sign-out-alt"></i> Logout</a-->
              </div>
            </div><br><br>
          </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
          $buku  = $_POST['buku'];

          date_default_timezone_set('Asia/Makassar');
          $tanggal = date("Y-m-d H:i:sa");

          $queryInsert = mysqli_query($connect, "INSERT INTO meminjam (tgl_pinjam) VALUES ('$tanggal')");
          echo mysqli_error($connect);

          if ($queryInsert) {
            $cekIdPinjam = mysqli_query($connect, "SELECT id_pinjam FROM meminjam WHERE tgl_pinjam='$tanggal'");
            $infoPinjam = mysqli_fetch_array($cekIdPinjam);
            $id_pinjam = $infoPinjam['id_pinjam'];

            $queryDetail = mysqli_query($connect, "INSERT INTO tabel_detail_pinjam (id_pinjam, id_login, id_buku) VALUES ('$id_pinjam', '$id_login', '$buku')");
            if ($queryDetail) {
              echo "<script>alert('Buku Berhasil dipesan.')</script>";
              echo "<script>window.location.href='pinjam.php';</script>";
            } else {
              echo "<script>alert('Gagal dipesan.')</script>";
              echo "<script>window.location.href='pinjam_buku.php';</script>";
            }
          } else {
            die('Gagal Bro/Sist' . mysqli_error($connect));
          }
        }
        ?>

      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">perpustakaan<br>
        <>
          </script>
      </td>
    </tr>
  </table>
</body>

</html>