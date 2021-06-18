<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sistem Informasi Perpustakaan</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="main.css">

</head>

<body>

  <div class="header">
    <h1>Selamat Datang di Sistem Informasi Perpustakaan</h1>
    <h3>Universitas Atma Jaya Makassar</h3>
  </div>

  <div class="navbar">
    <a href="index.php">Beranda</a>
    <a href="buku.php">Buku</a>
    <a href="pinjam.php">Peminjaman</a>
    <a href="logout.php">Logout</a>
  </div>

  <div class="row">
    <div class="main">

      <?php
      include "koneksi.php";
      ?>

      <div class="container">
        <div class="center">
          <h2><b>REGISTER</b></h2>
        </div>

        <div class="col">
          <div class="main">
            <form class="form-horizontal" method="post" action="regform.php">

              <div class="row">
                <div class="col-25">
                  <label for="nama_depan">Nama Depan:</label>
                </div>
                <div class="col-75">
                  <input type="text" id="nama_depan" placeholder="Masukkan Nama Depan" name="nama_depan">
                </div>
              </div>

              <div class="row">
                <div class="col-25">
                  <label for="nama_belakang">Nama Belakang:</label>
                </div>
                <div class="col-75">
                  <input type="text" id="nama_belakang" placeholder="Masukkan Nama Belakang" name="nama_belakang">
                </div>
              </div>

              <div class="row">
                <div class="col-25">
                  <label for="alamat">Alamat:</label>
                </div>
                <div class="col-75">
                  <input type="text" id="alamat" placeholder="Masukkan Alamat" name="alamat">
                </div>
              </div>

              <div class="row">
                <div class="col-25">
                  <label for="nomor_rumah">Nomor Rumah:</label>
                </div>
                <div class="col-75">
                  <input type="text" id="nomor_rumah" placeholder="Masukkan Nomor Rumah" name="nomor_rumah">
                </div>
              </div>

              <div class="row">
                <div class="col-25">
                  <label for="tempat">Tempat Lahir:</label>
                </div>
                <div class="col-75">
                  <input type="text" id="tempat" placeholder="Masukkan Tempat Lahir" name="tempat">
                </div>
              </div>

              <div class="row">
                <div class="col-25">
                  <label for="lahir">Tanggal Lahir:</label>
                </div>
                <div class="col-75">
                  <input type="date" id="lahir" placeholder="Masukkan Tanggal Lahir" name="lahir">
                </div>
              </div>

              <div class="row">
                <div class="col-25">
                  <label for="jk">Jenis Kelamin:</label>
                </div>
                <div class="col-75">
                  <label class="radio-inline"><input type="radio" id="jk" name="jk" value="Pria"> Pria</label>
                  <label class="radio-inline"><input type="radio" id="jk" name="jk" value="Wanita"> Wanita</label>
                </div>
              </div>

              <div class="row">
                <div class="col-25">
                  <label for="telepon">Nomor Telepon:</label>
                </div>
                <div class="col-75">
                  <input type="tel" id="telepon" placeholder="Masukkan Nomor Telepon" name="telepon">
                </div>
              </div>

              <div class="row">
                <div class="col-25">
                  <label for="email">Username:</label>
                </div>
                <div class="col-75">
                  <input type="text" id="email" placeholder="Masukkan Username" name="email">
                </div>
              </div>


              <div class="row">
                <div class="col-25">
                  <label for="password">Password:</label>
                </div>
                <div class="col-75">
                  <input type="text" id="password" placeholder="Masukkan Password" name="password">
                </div>
              </div>

          </div>
          <input type="reset">
          <input type="submit" name="submit">
          </form>
        </div>
      </div>

      <div class="col-sm-10 col-sm-offset-1">
        <?php
        if (isset($_POST['submit'])) {
          $nama_depan = $_POST['nama_depan'];
          $nama_belakang = $_POST['nama_belakang'];
          $alamat = $_POST['alamat'];
          $nomor_rumah = $_POST['nomor_rumah'];
          $tempat = $_POST['tempat'];
          $lahir = $_POST['lahir'];
          $jk = $_POST['jk'];
          $telepon = $_POST['telepon'];
          $username = $_POST['email'];
          $password = $_POST['password'];
          date_default_timezone_set('Asia/Kuala_Lumpur');
          $waktu = date("Y-m-d H:i:s");

          $queryinsert = mysqli_query($connect, "INSERT INTO anggota VALUES ('', '$nama_depan', '$nama_belakang','$alamat','$nomor_rumah','$tempat','$lahir','$jk','$telepon')");

          if ($queryinsert) {
            $cekId = mysqli_query($connect, "SELECT id_anggota FROM anggota WHERE nama_depan='$nama_depan' AND nama_belakang='$nama_belakang' AND telepon='$telepon' AND ttl='$lahir'");
            $info = mysqli_fetch_array($cekId);
            $id_anggota = $info['id_anggota'];

            $queryLogin = mysqli_query($connect, "INSERT INTO tabel_login (id_login, email, password) VALUES ('$id_anggota', '$username', '$password')");
            if ($queryLogin) {
              $queryLevel = mysqli_query($connect, "INSERT INTO tabel_login_level (id_anggota, level) VALUES ('$id_anggota', 'user')");
              if ($queryLevel) {
                echo "<script>alert('Akun Berhasil dibuat. Silahkan Login')</script>";
                echo "<script>window.location.href='login.php';</script>";
              } else {
                echo "<script>alert('Akun Gagal dibuatt.')</script>";
                echo "<script>window.location.href='login.php';</script>";
              }
            } else {
              die('Akun Gagal Dibuat! Login' . mysqli_error($connect));
            }
          } else {
            die('Akun Gagal Dibuat!' . mysqli_error($connect));
          }
        }

        if (isset($_GET['hapus'])) {
          $id_anggota = $_GET['id_anggota'];
          $querydelete = mysqli_query($connect, "DELETE FROM anggota WHERE id_anggota='$id_anggota'");
          if ($querydelete) {
        ?>
            <div class="alert success">
              <span class="closebtn">&times;</span>
              <strong>Success!</strong> Data Anggota Berhasil Dihapus
            </div>
          <?php
          } else {
          ?>
            <div class="alert">
              <span class="closebtn">&times;</span>
              <strong>Danger!</strong> Data Anggota Gagal Dihapus
            </div>
        <?php
          }
        }
        ?>
      </div>

      <div class="footer">
        <h2><b>Copyright Kelompok 10
      </div>
      </h2>
</body>

</html>