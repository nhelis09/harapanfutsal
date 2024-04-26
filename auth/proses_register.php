<?php
// Pastikan file konektor.php sudah di-include di sini
include '../assets/konektor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa keberadaan email dalam database
    $check_query = "SELECT * FROM users WHERE email='$email'";
    $check_result = mysqli_query($konektor, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Email sudah terdaftar
        echo "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Email belum terdaftar, lakukan proses pendaftaran
        $query = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";
        $result = mysqli_query($konektor, $query);

        if ($result) {
            header("Location:../index.php");
        } else {
            echo "Registration failed. Please try again.";
        }
    }
}