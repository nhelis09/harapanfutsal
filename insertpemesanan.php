<?php
include 'assets/konektor.php'; // Sertakan file koneksi ke database

// Ambil data dari form

$namapelanggan = $_POST['namapelanggan'];
$idlapangan = $_POST['idlapangan'];
$tanggal = $_POST['tanggal'];
$waktupertandingan = $_POST['waktupertandingan'];
$durasisewa = $_POST['durasisewa'];
$hargasewa = $_POST['totalhargasewa'];
$totalhargasewa = intval($hargasewa);

// Query untuk menyimpan data pemesanan
$query = "INSERT INTO pemesanan (idlapangan, tanggal, waktupertandingan, namapelanggan, durasisewa, totalhargasewa) VALUES ('$idlapangan', '$tanggal', '$waktupertandingan', '$namapelanggan', '$durasisewa', '$totalhargasewa')";
if (mysqli_query($konektor, $query)) {
    // Jika penyimpanan berhasil, redirect ke halaman lain atau tampilkan pesan sukses
    header('Location:halaman/sukses.php');
    exit();
} else {
    // Jika penyimpanan gagal, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($konektor);
}

// Tutup koneksi ke database
mysqli_close($konektor);
