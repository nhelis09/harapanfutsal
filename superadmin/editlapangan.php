<?php

include '../assets/konektor.php';


// menangkap data yang di kirim dari form
$namalapangan = $_POST['namalapangan'];
$hargasewa = $_POST['hargasewa'];

// menginput data ke database
$query = "INSERT INTO lapangan (namalapangan, hargasewa) VALUES ('$namalapangan', '$hargasewa')";
$result = mysqli_query($konektor, $query);

if ($result) {
    // Jika berhasil diinputkan, alihkan ke halaman lapangan.php
    header("location:lapangan.php");
}