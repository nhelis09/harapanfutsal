<?php
// koneksi database
include '../assets/konektor.php';

// menangkap data id lapangan yang dihapus
$idlapangan = $_GET['idlapangan'];

// menghapus data dari database
$query = "DELETE FROM lapangan WHERE idlapangan = '$idlapangan'";
$result = mysqli_query($konektor, $query);

if ($result) {
    // Jika berhasil dihapus, hapus juga file gambar jika ada
    $nama = ($_GET['idlapangan']);
    $target = "../assets/fotoprofil/$nama.jpg";
    if (file_exists($target)) {
        unlink($target);
    }

    // Alihkan ke halaman lapangan.php
    header("location:lapangan.php");
} else {
    // Jika gagal, tampilkan pesan error
    echo "Gagal menghapus lapangan: " . mysqli_error($konektor);
}