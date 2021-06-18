<?php
    error_reporting(E_ALL ^ E_NOTICE);
    include "koneksi.php";
    $id_pinjam = $_GET['id_pinjam'];

    $queryinfo = mysqli_query($connect, "SELECT * FROM meminjam WHERE id_pinjam='$id_pinjam'");
    $info = mysqli_fetch_array($queryinfo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota Perpustakaan</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
</head>
<body>
    <table align="center" width="1000" border="1">
        <tr>
            <td colspan="2" align="center"><h1>Edit Peminjaman Perpustakaan</h1></td>
        </tr>
        <tr>
            <td width = "100">
            <ul>
                <li><a href="anggota.php" class="las la-users">Anggota</a></li>
                <li><a href="buku.php" class="las la-book">Buku</a></li>
                <li><a href="pinjam.php" class="las la-clipboard-list">Pinjam</a></li>
            <ul>
            </td>
            <td width="500">
                <form method="post" action="" >
                <table class="table table-bordered">
          <div class="form-group row">
            <label class="control-label col-sm-2" for="np">Nama Peminjam :</label>
              <div class="col-sm-4">
              <?php

                $sql_anggota = mysqli_query($connect, "SELECT id_anggota, nama_anggota FROM anggota ORDER BY nama_anggota");
                $kueri_anggota = ($sql_anggota) or die(mysqli_error());
              ?>
              
                <select name="anggota">
              <?php
                  while (list($kode,$nama_anggota)=mysqli_fetch_array($kueri_anggota)){
              ?>
                  <option  value="<?=$kode; ?>" <?php if($kode == $info['id_anggota']){echo 'Selected';}?>><?=$nama_anggota;?></option>
              <?php
                  }
              ?>
                </select>
              </div>
          </div>
          
          <div class="form-group row">
            <label class="control-label col-sm-2" for="jb">Judul Buku :</label>
              <div class="col-sm-4">
              <?php
                $sql_buku = mysqli_query($connect, "SELECT id_buku, judul_buku FROM buku ORDER BY id_buku");
                $kueri_buku = ($sql_buku) or die(mysqli_error());
              ?>
                <select name="buku">
              <?php
                while (list($kode,$nama_status)=mysqli_fetch_array($kueri_buku)){
              ?>
                  <option  value="<?= $kode ?>"<?php if($kode == $info['id_buku']){echo 'Selected';}?>> <?= $nama_status ?></option>
              <?php
                }
              ?>
                </select>                      
              </div>
            </div>                    
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" name="edit" class="btn btn-sm btn-info"><i class="lar la-save"></i> Edit</button>
                        <button type="reset" name="reset" class="btn btn-danger"><i class="lar la-trash-alt"></i> Hapus</button>
                        <!--a href="logout.php" class="btn btn-dark"><i class="fas fa-sign-out-alt"></i> Logout</a-->
                    </div>
                </div><br><br>
                </table>
                </form>

                <?php
                    if (isset($_POST['edit'])){
                        $anggota = $_POST['anggota'];
                        $buku  = $_POST['buku'];

                        $queryedit = mysqli_query($connect, "UPDATE meminjam SET id_anggota='$anggota', id_buku='$buku' WHERE id_pinjam='$id_pinjam'");
                        echo mysqli_error($connect);

                        if ($queryedit){
                ?>
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Data Berhasil Diedit. Klik <a href="Pinjam.php">disini</a> untuk Input Data Baru.
                            </div>
                        <?php
                        }
                        else{
                        ?>
                            <div class="alert alert-ddanger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Failed!</strong> Data Gagal Diedit.
                            </div>
                        <?php
                        }
                    }
                        ?>
        </tr>
        <tr>
            <td colspan="2" align="center">PERPUSTAKAAN ONLINE<br><></script></td>
        </tr>
    </table>
</body>
</html>