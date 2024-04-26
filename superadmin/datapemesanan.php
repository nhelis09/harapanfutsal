<?php
include '../assets/konektor.php';

// Proses Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM pemesanan WHERE idpemesanan='$id'";
    if (mysqli_query($konektor, $query)) {
        header('Location: indexsuperadmin.php');
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konektor);
    }
}

$data = mysqli_query($konektor, "select * from profil");
while ($d = mysqli_fetch_array($data)) {
    $alamat = $d['alamat'];
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
    <title>Super Admin Dashboard</title>
    <?php include 'assets/cdn.php'; ?>

<body>
    <?php
    include 'assets/banner.php';
    include 'assets/navbar.php';
    include 'assets/cekdata.php';
    ?>

    <div class="container mt-5">
        <p>
        <h5>Selamat datang, <?php echo namaadmin($_SESSION['username']); ?></h5>
        </p>
        <p>
            <strong>
                <h2>Data Pemesanan</h2>
            </strong>
        </p>
        <div class="card">
            <table width="100%" class="table table-sm table-hover table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Waktu Pertandingan</th>
                        <th>Nama Lapangan</th>
                        <th>Durasi Sewa</th>
                        <th>Total Harga Sewa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($konektor, "SELECT p.*, l.namalapangan FROM pemesanan p JOIN lapangan l ON p.idlapangan = l.idlapangan");
                    $no = 1;
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['namapelanggan']; ?></td>
                        <td><?php echo $d['tanggal']; ?></td>
                        <td><?php echo $d['waktupertandingan']; ?></td>
                        <td><?php echo $d['namalapangan']; ?></td>
                        <td><?php echo $d['durasisewa']; ?> Jam</td>
                        <td>Rp <?php echo number_format($d['totalhargasewa'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="editdatapesanan.php?id=<?php echo $d['idpemesanan']; ?>" class="btn btn-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <a href="indexsuperadmin.php?hapus=<?php echo $d['idpemesanan']; ?>" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <hr>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- cetak laporan -->
                    <form action="prosescetak/cetakadmin.php" target="_blank" method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Periode</span>
                            <input name="mulai" type="date" class="form-control" required>
                            <input name="selesai" type="date" class="form-control" required>
                            <select name="format" class="form-control" required>
                                <option value="pdf">PDF</option>
                                <option value="xls">Excel</option>
                            </select>
                            <input class="btn btn-success" type="submit" value="cetak">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>



<div class="mt-5 p-4 bg-dark text-white text-center">
    <p><?php echo $alamat; ?></p>
</div>

<?php
include 'assets/emstable.php'; //koneksi ke database
?>

</html>