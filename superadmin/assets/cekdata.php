<?php


function namastatus($nilailayanan)
{
    switch ($nilailayanan) {
        case "1":
            echo "kurang Baik";
            break;
        case "2":
            echo "Baik";
            break;
        case "3":
            echo "Bagus";
            break;
        case "4":
            echo "Sangat Bangus";
    }
}

function namaadmin($email)
{
    include '../assets/konektor.php';
    //Mencari data di dalam database sesuai dengan inputan yang dimasukan
    $data = mysqli_query($konektor, "select * from superadmin where email like '$email'");
    if (mysqli_num_rows($data) > 0) {
        while ($d = mysqli_fetch_array($data)) {
            $hasil = $d['nama'];
        }
    }
    return $hasil;
}
function lapangan($idlapangan)
{
    include '../assets/konektor.php';
    //Mencari data di dalam database sesuai dengan inputan yang dimasukan
    $data = mysqli_query($konektor, "select * from lapangan where idlapangan like '$idlapangan'");
    $hasil = null; //inisialisasi nilai $hasil
    if (mysqli_num_rows($data) > 0) {
        while ($d = mysqli_fetch_array($data)) {
            $hasil = $d['namalapangan'];
        }
    }
    return $hasil;
}

function lapangan2($idlapangan)
{
    include '../../assets/konektor.php';
    $data = mysqli_query($konektor, "select * from lapangan where idlapangan like '$idlapangan'");
    $hasil = null; //inisialisasi nilai $hasil
    if (mysqli_num_rows($data) > 0) {
        while ($d = mysqli_fetch_array($data)) {
            $hasil = $d['namalapangan'];
        }
    }
    return $hasil;
}

function logdate($tanggal)
{
    return date(" d F Y", strtotime($tanggal));
}