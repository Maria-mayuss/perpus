<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sistem Informasi Perpustakaan</title>
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initialscale=1">
 <link rel="stylesheet" href="regis.css">
</head>
<body>
        <?php
        error_reporting(E_ALL ^ E_NOTICE);
        include 'koneksi.php';
        if (isset($_POST['login']))
        {
          $uname = $_POST['username'];
          $pass = $_POST['password'];
          $query = mysqli_query($connect, "SELECT * from tabel_login WHERE email='$uname' and password='$pass'");
          $cek = mysqli_num_rows($query);
          if ($cek > 0)
          {
            setcookie("username", $uname, time()+3600 );
            setcookie("password", $pass, time()+3600 );
            header("Location: index.php");
          }
          else
          {
            echo "Username dan Password Tidak Tepat";
          }
        }
?>
        <div class="header">
            <h1>Selamat Datang di Sistem Informasi Perpustakaan</h1>
            <h3>Universitas Atma Jaya Makassar</h3>
        </div>
            <div class="container">
                <h1>Login</h1>
        <form method="post" action="login.php" autocomplete='off'>
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Input Username" name="username" autofocus>

                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Input Password" name="password">

          <br>
            <button type="submit" name="login" class="registerbtn">Login</button>
          <div class="container signin">
              <p>Jika tidak memiliki akun, klik <a href="regform.php">Register</a> untuk membuat akun lalu login kembali.</p>
          </div>
              </form>
            </div>
        </div>
    </div>
</body>
</html>