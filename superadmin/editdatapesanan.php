<?php
include '../assets/konektor.php';

// Proses Update Data
if (isset($_POST['update'])) {
    $id = $_POST['idpemesanan'];
    $namapelanggan = $_POST['namapelanggan'];
    $tanggal = $_POST['tanggal'];
    $idlapangan = $_POST['idkategori']; // ambil ID lapangan dari select dengan idkategori
    $waktupertandingan = $_POST['waktupertandingan'];
    $durasisewa = $_POST['durasisewa'];

    // Ambil harga lapangan berdasarkan ID lapangan
    $query_harga = "SELECT hargasewa FROM lapangan WHERE idlapangan='$idlapangan'";
    $result_harga = mysqli_query($konektor, $query_harga);
    $row_harga = mysqli_fetch_assoc($result_harga);
    $harga_lapangan = $row_harga['hargasewa']; // Definisikan harga lapangan di sini

    // Hitung total harga sewa
    $totalhargasewa = $durasisewa * $harga_lapangan;

    // Update data pemesanan
    $query = "UPDATE pemesanan SET namapelanggan='$namapelanggan', tanggal='$tanggal', idlapangan='$idlapangan', waktupertandingan='$waktupertandingan', durasisewa='$durasisewa', totalhargasewa='$totalhargasewa' WHERE idpemesanan='$id'";
    if (mysqli_query($konektor, $query)) {
        header('Location: datapemesanan.php');
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konektor);
    }
}



// Ambil data pemesanan berdasarkan id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = mysqli_query($konektor, "SELECT * FROM pemesanan WHERE idpemesanan='$id'");
    $d = mysqli_fetch_array($data);
} else {
    header('Location: datapemesanan.php');
    exit();
}
?>

<!-- cek apakah sudah login -->
<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:authadmin/loginadmin.php?pesan=belum_login");
    exit(); // pastikan keluar dari script setelah mengarahkan pengguna ke halaman login
}
?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pemesanan</title>
    <?php include 'assets/cdn.php'; ?>
</head>

<body>
    <?php include 'assets/banner.php'; ?>
    <?php include 'assets/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-header text-center">Edit Data Pemesanan</h4>
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" name="idpemesanan" value="<?php echo $d['idpemesanan']; ?>">
                            <div class="mb-3">
                                <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="namapelanggan" name="namapelanggan"
                                    value="<?php echo $d['namapelanggan']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    value="<?php echo $d['tanggal']; ?>" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nama Lapangan</span>
                                <select name="idkategori" id="idkategori" class="custom-select form-control" required
                                    onchange="hitungTotalHarga()">
                                    <?php
                                    $kategori = $d['idlapangan'];
                                    $data_kategori = mysqli_query($konektor, "SELECT * FROM lapangan ORDER BY namalapangan ASC");
                                    while ($k = mysqli_fetch_array($data_kategori)) {
                                        $selected = ($kategori == $k['idlapangan']) ? 'selected' : '';
                                        echo "<option value='{$k['idlapangan']}' data-hargasewa='{$k['hargasewa']}' $selected>{$k['namalapangan']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="waktupertandingan" class="form-label">Waktu Pertandingan</label>
                                <input type="time" class="form-control" id="waktupertandingan" name="waktupertandingan"
                                    value="<?php echo $d['waktupertandingan']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="durasisewa" class="form-label">Durasi Sewa (Jam)</label>
                                <input type="number" class="form-control" id="durasisewa" name="durasisewa"
                                    value="<?php echo $d['durasisewa']; ?>" required onchange="hitungTotalHarga()">
                            </div>
                            <div class="mb-3">
                                <label for="totalhargasewa" class="form-label">Total Harga Sewa</label>
                                <input type="text" class="form-control" id="totalhargasewa" name="totalhargasewa"
                                    value="Rp <?php echo number_format($d['totalhargasewa'], 0, ',', '.'); ?>" readonly>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="update" class="btn btn-primary">
                                    <i class="bi bi-check"></i> Simpan
                                </button>
                                <a href="datapemesanan.php" class="btn btn-secondary">
                                    Kembali <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var select = document.querySelector("select[name='idkategori']");
        var durasiInput = document.querySelector("input[name='durasisewa']");
        var totalHargaInput = document.getElementById("totalhargasewa");

        function updateTotalHarga() {
            var hargaSewa = parseInt(select.options[select.selectedIndex].getAttribute("data-hargasewa"));
            var durasi = parseInt(durasiInput.value);
            var totalHarga = hargaSewa * durasi;

            totalHargaInput.value = totalHarga; // Ubah nilai total harga sewa
        }

        select.addEventListener("change", updateTotalHarga);
        durasiInput.addEventListener("input",
            updateTotalHarga); // Gunakan event input agar terupdate secara real-time

        // Panggil updateTotalHarga saat halaman dimuat untuk pertama kali
        updateTotalHarga();
    });
    </script>


</body>

<div class="mt-5 p-4 bg-dark text-white text-center">
    <div class="social-icons mt-3">
        <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
    </div>
</div>

</html>