<?php
include '../assets/konektor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namapenilai = $_POST['namapenilai'];
    $idlapangan = $_POST['idlapangan'];
    $nilailayanan = $_POST['nilailayanan'];
    $komentar = $_POST['komentar'];

    $query = "UPDATE penilaianlayanan SET namapenilai='$namapenilai', idlapangan='$idlapangan', nilailayanan='$nilailayanan', komentar='$komentar' WHERE idpenilaianlayanan=" . $_POST['idpenilaianlayanan'];
    $result = mysqli_query($konektor, $query);

    if ($result) {
        header("location:penilaian.php");
    } else {
        echo "Gagal mengubah data.";
    }
}
