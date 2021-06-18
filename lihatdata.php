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
  <a href="buku.php">Buku</a>
  <a href="pinjam.php">Peminjaman</a>
  <a href="logout.php">Logout</a>
</div>

<div class="row">
  <div class="main">
    
  <?php
include "koneksi.php";
?>



<div class="table-responsive col-sm-10 col-sm-offset-1">
    <div class="text-center">
    <h2><b>List Data Anggota</b></h2>
    </div>
    <div class="col">
    <div class="main">
        <table>
                <tr>
                    <th>ID Anggota</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                    <th>Action</th>
                </tr>
      
        
        <?php
            $queryanggota = mysqli_query($connect, "SELECT * FROM anggota ORDER BY id_anggota");
            $jumanggota = mysqli_num_rows($queryanggota);
            if ($jumanggota == 0)
            {
        ?>
        <tr>
        <td class="alert warning">Data Anggota Masih Kosong</td>
                </tr>
        <?php
                }
                else
                {
                    while ($anggota = mysqli_fetch_array($queryanggota))
                    {
        ?>
                    <tr>
                        <td><?=$anggota['id_anggota']?></td>
                        <td><?=$anggota['nama_depan'].' '.$anggota['nama_belakang']?></td>
                        <td><?=$anggota['alamat'].' '.$anggota['nomor_rumah']?></td>
                        <td><?=$anggota['tempat']?></td>
                        <td><?=$anggota['ttl']?></td>
                        <td><?=$anggota['jenis_kelamin']?></td>
                        <td><?=$anggota['telepon']?></td>
                        <td><a href="editanggota.php?id_anggota=<?=$anggota['id_anggota']?>">Edit </a></td>
                        <td><a href="anggota.php?hapus=ok&id_anggota=<?=$anggota['id_anggota']?>"> Hapus</a></td>
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
</body>
</html>
