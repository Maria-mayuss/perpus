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
  <a href="lihatdata.php">List Anggota</a>
  <a href="buku.php" class="active">Buku</a>
  <a href="pinjam.php">Peminjaman</a>
  <a href="logout.php">Logout</a>
</div>


<div class="row">
  <div class="main">

<?php
error_reporting(E_ALL ^ E_NOTICE);
include "koneksi.php";
?>

<div class="container">
    <div class="text-center">
    <h2><b>Input Buku</b></h2>
    </div>

<div class="col">
<div class="main">

    <form class="form-horizontal" method="post" action="buku.php">

        <div class="row">
          <div class="col-25">
            <label for="judul">Judul Buku:</label>
          </div>
            <div class="col-75">
            <input type="text" id="judul" placeholder="Masukkan Judul Buku" name="judul">
            </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="pengarang">Pengarang:</label>
          </div>
            <div class="col-75">
            <input type="text" id="pengarang" placeholder="Masukkan Pengarang" name="pengarang">
            </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label class="control-label col-sm-2"  for="penerbit">Penerbit:</label>
          </div>
            <div class="col-75">
            <input type="text" id="penerbit" placeholder="Masukkan Penerbit" name="penerbit">
            </div>
        </div>

            <input type="reset"> 
            <input type="submit" name="submit">
</div>
    </form>
</div>
</div>

    <div class="col-sm-10 col-sm-offset-1">
        <?php
        if (isset($_POST['submit']))
        {
            $idbuku = $_POST['idbuku'];
            $judul = $_POST['judul'];
            $pengarang = $_POST['pengarang'];
            $penerbit = $_POST['penerbit'];
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $waktu = date("Y-m-d H:i:s");
            
            $queryinsert = mysqli_query($connect, "INSERT INTO buku VALUES ('$idbuku','$judul','$pengarang','$penerbit')");
                
            if ($queryinsert)
                {
        ?>
    
                <div class="alert success">
                    <span class="closebtn">&times;</span>  
                    <strong>Success!</strong> Data Buku Berhasil Diinput
                </div>
        <?php
                }
                else
                {
        ?>
                <div class="alert">
                    <span class="closebtn">&times;</span>  
                    <strong>Danger!</strong> Data Buku Gagal Diinput
                </div>
        <?php
                }
        }

        if (isset($_GET['hapus']))
        {
            $idbuku = $_GET['id_buku'];
            $querydelete = mysqli_query($connect, "DELETE FROM buku WHERE id_buku='$idbuku'");
                if ($querydelete)
                {
        ?>
                <div class="alert success">
                    <span class="closebtn">&times;</span>  
                    <strong>Success!</strong> Data Buku Berhasil Dihapus
                </div>
        <?php
                }
                else
                {
        ?>
                <div class="alert">
                    <span class="closebtn">&times;</span>  
                    <strong>Danger!</strong> Data Buku Gagal Dihapus
                </div>
        <?php
                }
        }
        ?>
    </div>

    <div class="table-responsive col-sm-10 col-sm-offset-1">
    <div class="text-center">
    <h2><b>List Data Buku</b></h2>
    </div>
    <div class="col">
    <div class="main">
        <table>
                <tr>
                    <th>ID Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>
                </tr>

        
        <?php
            $queryanggota = mysqli_query($connect, "SELECT * FROM buku ORDER BY id_buku");
            $jumanggota = mysqli_num_rows($queryanggota);
            if ($jumanggota == 0)
            {
        ?>
        <tr>
        <td class="alert warning">Data Buku Masih Kosong</td>
                </tr>
        <?php
                }
                else
                {
                    while ($anggota = mysqli_fetch_array($queryanggota))
                    {
        ?>
                    <tr>
                        <td><?=$anggota['id_buku']?></td>
                        <td><?=$anggota['judul_buku']?></td>
                        <td><?=$anggota['pengarang']?></td>
                        <td><?=$anggota['penerbit']?></td>
                        <td><a href="editbuku.php?id_buku=<?=$anggota['id_buku']?>"> Edit</a></td>
                        <td><a href="buku.php?hapus=ok&id_buku=<?=$anggota['id_buku']?>"> Hapus</a></td>
                    </tr>
        <?php
                    }
                }
        ?>

        </table>
            </div>
            </div>
        </div>
</div>

</div>
<div class="footer">
<h2><b>Copyright Kelompok 10</div></h2>
</body>
</html>
