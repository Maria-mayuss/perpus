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
  <a href="lihatdata.php" class "active">List Anggota</a>
  <a href="buku.php" class="active">Buku</a>
  <a href="pinjam.php">Peminjaman</a>
  <a href="logout.php">Logout</a>
</div>


<div class="row">
  <div class="main">

<?php
 include "koneksi.php";
 $id = $_GET['id_anggota'];
 $queryinfo = mysqli_query($connect, "SELECT * FROM anggota WHERE id_anggota='$id'");
 $info = mysqli_fetch_array($queryinfo);
?>

<div class="container">
<div class="text-center">
    <h2><b>Edit Data Anggota</b></h2>
    </div>

    <div class="col">
    <div class="main">

    <form class="form-horizontal" method="post" action="editanggota.php?id_anggota=<?=$id?>">

    <input type="hidden" class="form-control" id="id" placeholder="Masukkan id" name="id" value="<?=$info['id_anggota']?>">
        
		<div class="row">
          <div class="col-25">
            <label for="nama_depan">Nama Depan:</label>
          </div>
          <div class="col-75">
            <input type="text" id="nama_depan" placeholder="Masukkan Nama Depan" name="nama_depan" value="<?=$info['nama_depan']?>">
          </div>
        </div>
		
		<div class="row">
          <div class="col-25">
            <label for="nama_belakang">Nama Belakang:</label>
          </div>
            <div class="col-75">
            <input type="text" id="nama_belakang" placeholder="Masukkan Nama Belakang" name="nama_belakang" value="<?=$info['nama_belakang']?>">
            </div>
        </div>
		
        <div class="row">
          <div class="col-25">
            <label for="alamat">Alamat:</label>
          </div>
            <div class="col-75">
            <input type="text" id="alamat" placeholder="Masukkan Alamat" name="alamat" value="<?=$info['alamat']?>">
            </div>
        </div>
		
		<div class="row">
          <div class="col-25">
            <label for="nomor_rumah">Nomor Rumah:</label>
          </div>
            <div class="col-75">
            <input type="text" id="nomor_rumah" placeholder="Masukkan Nomor Rumah" name="nomor_rumah"value="<?=$info['nomor_rumah']?>">
            </div>
        </div>


        <div class="row">
          <div class="col-25">
            <label for="tempat">Tempat Lahir:</label>
          </div>
            <div class="col-75">
            <input type="text" id="tempat" placeholder="Masukkan Tempat Lahir" name="tempat" value="<?=$info['tempat']?>">
            </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label class="control-label col-sm-2" for="lahir">Tanggal Lahir:</label>
          </div>
            <div class="col-75">
            <input type="date" id="lahir" placeholder="Masukkan Tanggal Lahir" name="lahir" value="<?=$info['ttl']?>">
            </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="jk">Jenis Kelamin:</label>
          </div>
            <div class="col-75"> 
            <label class="radio-inline" ><input type="radio" id="jk" name="jk" value="Pria" <?php if 
                ($info['jenis_kelamin'] == "Pria") echo "checked"; ?>> Pria</label>
            <label class="radio-inline"><input type="radio" id="jk" name="jk" value="Wanita" <?php if 
                ($info['jenis_kelamin'] == "Wanita") echo "checked"; ?>> Wanita</label>
            </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label class="control-label col-sm-2" for="telepon">Nomor Telepon:</label>
          </div>
            <div class="col-75"> 
            <input type="tel" id="telepon" placeholder="Masukkan Nomor Telepon" name="telepon" value="<?=$info['telepon']?>">
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
			$id = $_POST['id'];
            $nama_depan = $_POST['nama_depan'];
			$nama_belakang = $_POST['nama_belakang'];
            $alamat = $_POST['alamat'];
			$nomor_rumah = $_POST['nomor_rumah'];
            $tempat = $_POST['tempat'];
            $lahir = $_POST['lahir'];
            $jk = $_POST['jk'];
            $telepon = $_POST['telepon'];
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $waktu = date("Y-m-d H:i:s");
            
            $queryedit = mysqli_query($connect, "UPDATE anggota SET nama_depan= '$nama_depan', nama_belakang= '$nama_belakang', alamat='$alamat', nomor_rumah= '$nomor_rumah', tempat='$tempat', ttl='$lahir', jenis_kelamin='$jk', telepon='$telepon' WHERE id_anggota='$id'");
                
			
                  
                if ($queryedit)
                { 
    ?>
                <div class="alert success">
                    <span class="closebtn">&times;</span>  
                    <strong>Success!</strong> Data Anggota Berhasil Diedit. Klik <a href="anggota.php">disini</a> untuk Input Data Baru.
                </div>
                
    <?php
                }
                else
                {
    ?>
                <div class="alert">
                    <span class="closebtn">&times;</span>  
                    <strong>Danger!</strong> Data Anggota Gagal Diedit
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
