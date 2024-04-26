<?php
include 'assets/konektor.php';

$query = "DELETE FROM pemesanan";
if (mysqli_query($konektor, $query)) {
    echo 'Semua histori pemesanan berhasil dihapus.';
} else {
    echo 'Gagal menghapus histori pemesanan: ' . mysqli_error($konektor);
}