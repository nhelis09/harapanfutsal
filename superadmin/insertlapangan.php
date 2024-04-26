<?php
include '../assets/konektor.php';

if (isset($_POST['namalapangan']) && isset($_POST['hargasewa'])) {
    $namalapangan = $_POST['namalapangan'];
    $hargasewa = $_POST['hargasewa'];

    $query = "INSERT INTO lapangan (namalapangan, hargasewa) VALUES ('$namalapangan', '$hargasewa')";
    if (mysqli_query($konektor, $query)) {
        header('Location: lapangan.php'); // Redirect kembali ke halaman tambahlapangan.php
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konektor);
    }
} else {
    header('Location: lapangan.php'); // Redirect kembali ke halaman tambahlapangan.php jika tidak ada data yang dikirim
    exit();
}