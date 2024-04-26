<?php
include 'assets/konektor.php';

if (isset($_POST['idpemesanan'])) {
    $idpemesanan = $_POST['idpemesanan'];

    // Query untuk menghapus data pemesanan berdasarkan id_pemesanan
    $query = "DELETE FROM pemesanan WHERE idpemesanan = '$idpemesanan'";
    $result = mysqli_query($konektor, $query);

    if ($result) {
        // Redirect ke halaman data pemesanan setelah menghapus
        header("location:index.php");
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "Tidak ada data yang dikirim untuk dihapus.";
}