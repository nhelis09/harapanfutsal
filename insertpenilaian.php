<?php
include 'assets/konektor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namapenilai = $_POST['namapenilai'];
    $idlapangan = $_POST['idlapangan'];
    $nilailayanan = $_POST['nilailayanan'];
    $komentar = $_POST['komentar'];

    $query = "INSERT INTO penilaianlayanan (namapenilai, idlapangan, nilailayanan, komentar, tanggalpenilaian) VALUES ('$namapenilai', '$idlapangan', '$nilailayanan', '$komentar', NOW())";

    if (mysqli_query($konektor, $query)) {
        header('Location:halaman/berhasilpenilaian.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konektor);
    }
} else {
    echo "Permintaan tidak valid.";
}
