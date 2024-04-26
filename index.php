<?php include 'assets/konektor.php';
include 'assets/cekdata2.php';
$data = mysqli_query($konektor, "select * from profil");
while ($d = mysqli_fetch_array($data)) {
    $idprofil = $d['idprofil'];
    $alamat = $d['alamat'];
    $deskripsi = $d['deskripsi'];
}

?>

<!-- cek apakah sudah login -->
<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:auth/login.php?pesan=belum_login");
    exit(); // pastikan keluar dari script setelah mengarahkan pengguna ke halaman login
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Harahap Futsal | Profil Perusahaan</title>
    <?php include 'assets/cdn.php'; ?>
    <meta charset="utf-8">
    <style>
    .fakeimg {
        height: 200px;
        background: #aaa;
    }

    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        grid-gap: 20px;
        margin-top: 20px;
    }

    .gallery img {
        width: 100%;
        height: auto;
        border-radius: 5px;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <?php include 'assets/banner.php'; ?>
    <?php include 'assets/navbar.php'; ?>
    <div class="container mt-5">
        <!-- <p>
        <h5>Selamat datang, <?php echo namaadmin($_SESSION['username']); ?></h5>
        </p> -->
        <div class="row">
            <div class="col-sm-4">
                <h5 class="text-center">Harahap Futsal</h5>
                <div>
                    <img src="assets/images/logo1.png" width="90%" alt="">
                </div>
                <p><?php echo $deskripsi; ?></p>
                <p>Alamat: <?php echo $alamat; ?></p>
                <hr class="d-sm-none">
            </div>

            <!-- TESTING GAMBAR -->
            <div class="col-md-8">
                <div class="row">
                    <?php
                    $data = mysqli_query($konektor, "select * from lapangan ");
                    while ($d = mysqli_fetch_array($data)) {
                        $gambar = "assets/fotoprofil/" . $d['idlapangan'] . ".jpg";
                        if (!file_exists($gambar)) {
                            $gambar = "assets/images/blank.png"; // Gambar default
                        }
                    ?>
                    <div class="col-md-6">
                        <div class="card mb-2">
                            <img src="<?php echo $gambar; ?>" class="card-img-top img-thumbnail"
                                alt="GAMBAR TIDAK TERSEDIA">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $d['namalapangan']; ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- BAGIAN AKHIR TESTING GAMBAR -->



        </div>
    </div>
    <div class="mt-5 p-4 bg-dark text-white text-center">
        <p><?php echo $alamat; ?></p>
        <div id="waktu"></div>

        <script>
        function updateWaktu() {
            const options = {
                timeZone: 'Asia/Makassar',
                hour12: false,
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            };

            const waktu = new Date().toLocaleString('id-ID', options);
            document.getElementById('waktu').innerHTML = waktu;
        }

        setInterval(updateWaktu, 1000); // Update setiap detik
        </script>

    </div>

</body>

</html>