<?php
$temp = $_FILES['berkas']['tmp_name'];
$name = $_FILES['berkas']['name']; //mengambil nama file asli
$id = $_POST['idlapangan'] . '.jpg'; //mengambil nama file dari url parameter
$size = $_FILES['berkas']['size']; //mengambil ukuran file
$type = $_FILES['berkas']['type']; //mengambil tipe file
$folder = "../assets/fotoprofil/"; //Folder untuk menampung berkas. Pastikan Anda telah membuatnya
// upload Process
//1 Megabyte = 1000000
if ($size <= 1000000 and $type == 'image/jpeg') {   //Melakukan validasi tipe file dan ukuran file 5 MB
    move_uploaded_file($temp, $folder . $id); //Jika menggunakan nama file berdasarkan url parameter silakan ganti $name dengan $id
    // mengalihkan halaman kembali ke unggah.php atau sesui yang diinginkan
    // header("location:lapangan.php?pesan=fileterkirim&name=$name&size=$size&type=$type");
    echo "<script>alert('Gambar Berhasil Diunggah.');window.location='lapangan.php';</script>";
} else {
    echo "<script>alert('Gambar Gagal Dikirimkan, Periksa Kembali Format dan Ukuran Foto Anda.');window.location='lapangan.php';</script>";
}