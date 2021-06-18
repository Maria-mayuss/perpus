<!DOCTYPE html>
<html lang="en">
<head>
<title>Sistem Informasi Perpustakaan</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="main.css">
</head>
<body>

<?php
include "koneksi.php";
	$uname = $_COOKIE['username'];
	$pass = $_COOKIE['password'];
	
	if (!isset($uname))
	{
		?>
		<script>
			alert('Cookie Habis');
			document.location='login.php';
		</script>
		<?php
		exit;
	}
?>
Cookie anda : <?=$uname?>

<div class="header">
  <h1>Selamat Datang di Sistem Informasi Perpustakaan</h1>
  <h3>Universitas Atma Jaya Makassar</h3>
</div>

<div class="navbar">
  <a href="index.php">Beranda</a>
  <a href="anggota.php">Anggota</a>
  <a href="buku.php"  class="active">Buku</a>
  <a href="pinjam.php">Peminjaman</a>
  <a href="logout.php">Logout</a>
</div>

<div class="row">
  <div class="main">

<?php
error_reporting(E_ALL ^ E_NOTICE);
 include "koneksi.php";
 $idbuku = $_GET['id_buku'];
 $queryinfo = mysqli_query($connect, "SELECT * FROM buku WHERE id_buku='$idbuku'");
 $info = mysqli_fetch_array($queryinfo);
?>

<div class="container">
<div class="text-center">
    <h2><b>Edit Data Buku</b></h2>
    </div>
    <div class="col">
    <div class="main">

    <form class="form-horizontal" method="post" action="editbuku.php">
    <input type="hidden" class="form-control" id="idbuku" placeholder="Masukkan ID Buku" name="idbuku" value="<?=$info['id_buku']?>">
        
        <div class="row">
          <div class="col-25">
            <label for="judul">Judul Buku:</label>
          </div>
            <div class="col-75">
            <input type="text" id="judul" placeholder="Masukkan Judul Buku" name="judul" value="<?=$info['judul_buku']?>">
            </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="pengarang">Pengarang:</label>
          </div>
            <div class="col-75"> 
            <input type="text" id="pengarang" placeholder="Masukkan Pengarang" name="pengarang" value="<?=$info['pengarang']?>">
            </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="penerbit">Penerbit:</label>
          </div>
            <div class="col-75">
            <input type="text" id="penerbit" placeholder="Masukkan Penerbit" name="penerbit" value="<?=$info['penerbit']?>">
            </div>
        </div>

            <input type="reset">
            <input type="submit" name="edit">
    </div>
    </form>
</div>
</div>
</div>

    <div class="col-sm-10 col-sm-offset-1">
    <?php
        if (isset($_POST['edit']))
        {
            $idbuku = $_POST['idbuku'];
            $judul = $_POST['judul'];
            $pengarang = $_POST['pengarang'];
            $penerbit = $_POST['penerbit'];
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $waktu = date("Y-m-d H:i:s");

            $queryedit = mysqli_query($connect, "UPDATE buku SET judul_buku='$judul', pengarang='$pengarang', penerbit='$penerbit' WHERE id_buku='$idbuku'");

       
                if ($queryedit)
                {
    ?>
                <div class="alert success">
                    <span class="closebtn">&times;</span>  
                    <strong>Success!</strong> Data Buku Berhasil Diedit. Klik <a href="buku.php">disini</a> untuk Input Data Baru.
                </div>
    <?php
                }
                else
                {
    ?>
                <div class="alert">
                    <span class="closebtn">&times;</span>  
                    <strong>Danger!</strong> Data Buku Gagal Diedit
                </div>
    <?php
                }
        }
    ?>
    </div>
</div>

</div>
<div class="footer">
<h2><b>Copyright Kelompok 10</div></h2>
</body>
</html>
