<?php
$nama = ($_GET['idlapangan']);
$target = "../assets/fotoprofil/$nama.jpg";
if (file_exists($target)) {
    unlink($target);
}
echo "<script>alert('Gambar Berhasil Dihapus.');window.location='lapangan.php';</script>";
exit();