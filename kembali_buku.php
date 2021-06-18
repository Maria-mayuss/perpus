<?php
    include "koneksi.php";

    $tgl = date('Y-m-d');

$queryup = mysqli_query($connect, "UPDATE meminjam SET tgl_kembali = '$tgl', kembali = '2' WHERE id_pinjam ='$_GET[id]'");
if ($queryup){
    ?>
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Buku Sudah Dikembalikan.
            <script>
                document.location.href='pinjam.php';
            </script>
        </div>
    <?php
}
else{
    ?>
        <div class="alert alert-ddanger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed!</strong> Buku Gagal Dikembalikan.
            <script>
                document.location.href='pinjam.php';
            </script>
        </div>
    <?php
}
?>