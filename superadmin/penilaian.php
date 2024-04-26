<?php
include '../assets/konektor.php';
include 'assets/cekdata.php';
// Ambil data lapangan dari database
$query = "SELECT * FROM lapangan";
$result = mysqli_query($konektor, $query);

?>

<!-- cek apakah sudah login -->
<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:authadmin/loginadmin.php?loginterlebihdahuluyah");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Penilaian Pengguna</title>
    <?php include 'assets/cdn.php'; ?>
</head>

<body>
    <?php include 'assets/banner.php'; ?>
    <?php include 'assets/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <p>
            <h5>Selamat datang, <?php echo namaadmin($_SESSION['username']); ?></h5>
            </p>
            <p>
                <strong>
                    <h2>Penilaian Pengguna</h2>
                </strong>
            </p>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Data Penilaian Pengguna</h5>
                        <p>
                            <?php
                            $query = "SELECT
                            SUM(nilailayanan = 1) AS jumlah_1,
                            SUM(nilailayanan = 2) AS jumlah_2,
                            SUM(nilailayanan = 3) AS jumlah_3,
                            SUM(nilailayanan = 4) AS jumlah_4
                            FROM penilaianlayanan";
                            $result = mysqli_query($konektor, $query);
                            $row = mysqli_fetch_assoc($result);
                            $jumlah_1 = $row['jumlah_1'];
                            $jumlah_2 = $row['jumlah_2'];
                            $jumlah_3 = $row['jumlah_3'];
                            $jumlah_4 = $row['jumlah_4'];
                            echo "Jumlah nilai Kurang Baik: <span class='badge bg-danger'>" . $jumlah_1 . "</span><br>";
                            echo "Jumlah nilai Baik: <span class='badge bg-warning'>" . $jumlah_2 . "</span><br>";
                            echo "Jumlah nilai Bagus: <span class='badge bg-info'>" . $jumlah_3 . "</span><br>";
                            echo "Jumlah nilai Sangat Bagus: <span class='badge bg-primary'>" . $jumlah_4 . "</span><br>";
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">2 Lapangan Terfavorit</h5>
                        <?php
                        $query_favorit = "SELECT l.idlapangan, l.namalapangan,
                        SUM(pl.nilailayanan = 1) AS jumlah_1,
                        SUM(pl.nilailayanan = 2) AS jumlah_2,
                        SUM(pl.nilailayanan = 3) AS jumlah_3,
                        SUM(pl.nilailayanan = 4) AS jumlah_4
                        FROM lapangan l
                        LEFT JOIN penilaianlayanan pl ON l.idlapangan = pl.idlapangan
                        GROUP BY l.idlapangan
                        ORDER BY jumlah_4 DESC, jumlah_3 DESC, jumlah_2 DESC, jumlah_1 DESC
                        LIMIT 2";

                        $result_favorit = mysqli_query($konektor, $query_favorit);
                        while ($row_favorit = mysqli_fetch_assoc($result_favorit)) {
                            echo "<center><h4><span class='badge bg-primary'>" . $row_favorit['namalapangan'] . "</span></h4></center>";
                        }
                        ?>
                    </div>
                    <p></p>
                    <p></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cetak Rekapan Data Anda</h5>
                        <form action="prosescetak/cetakpenilaianpengguna.php" target="_blank" method="POST">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="mulai" class="col-form-label">Tanggal Mulai:</label>
                                    <input id="mulai" name="mulai" type="date" class="form-control" required>
                                    <label for="selesai" class="col-form-label">Tanggal Selesai:</label>
                                    <input id="selesai" name="selesai" type="date" class="form-control" required>
                                </div>
                                <div class="col-auto">
                                    <label for="format" class="col-form-label">Format:</label>
                                    <select id="format" name="format" class="form-control" required>
                                        <option value="pdf">PDF</option>
                                        <option value="xls">Excel</option>
                                    </select>
                                </div>
                                <div class="col-auto text-center align-items-center">
                                    <input class="btn btn-success" type="submit" value="Cetak">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p></p>
    <div class="col-md-13">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Penilaian Pengguna</h5>
                <table width="100%" class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama </th>
                            <th>Lapangan</th>
                            <th>Penilaian</th>
                            <th>Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = mysqli_query($konektor, "SELECT * FROM penilaianlayanan order by idpenilaianlayanan desc");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['tanggalpenilaian']; ?></td>
                                <td><?php echo $d['namapenilai']; ?></td>
                                <td><?php echo lapangan($d['idlapangan']); ?></td>
                                <td><?php echo  namastatus($d['nilailayanan']); ?></td>
                                <td><?php echo $d['komentar']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $d['idpenilaianlayanan']; ?>">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="deletelapangan.php?idlapangan=<?php echo $d['idpenilaianlayanan']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Lapangan ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>

                            </tr>
                            <!-- The Modal -->
                            <div class="modal" id="myModal<?php echo $d['idpenilaianlayanan']; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <div class="d-flex justify-content-center">
                                                <img src="assets/images/edit.png" width="30%" alt="">
                                            </div>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="editpenilaian.php" method="POST">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Nama</span>
                                                    <input name="namapenilai" value="<?php echo $d['namapenilai']; ?>" type="text" class="form-control" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Lapangan</span>
                                                    <select name="idlapangan" class="custom-select form-control" required>
                                                        <?php
                                                        include '../assets/konektor.php';
                                                        $data_lapangan = mysqli_query($konektor, "SELECT * FROM lapangan ORDER BY namalapangan ASC");
                                                        while ($lapangan = mysqli_fetch_array($data_lapangan)) {
                                                            $selected = ($lapangan['idlapangan'] == $d['idlapangan']) ? 'selected' : '';
                                                        ?>
                                                            <option value="<?php echo $lapangan['idlapangan']; ?>" <?php echo $selected; ?>>
                                                                <?php echo $lapangan['namalapangan']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">Nilai Layanan</span>
                                                    <select name="nilailayanan" class="custom-select form-control" required>
                                                        <option value="1" <?php echo ($d['nilailayanan'] == 1) ? 'selected' : ''; ?>>
                                                            Kurang Baik</option>
                                                        <option value="2" <?php echo ($d['nilailayanan'] == 2) ? 'selected' : ''; ?>>
                                                            Baik</option>
                                                        <option value="3" <?php echo ($d['nilailayanan'] == 3) ? 'selected' : ''; ?>>
                                                            Bagus</option>
                                                        <option value="4" <?php echo ($d['nilailayanan'] == 4) ? 'selected' : ''; ?>>
                                                            Sangat Bagus</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Komentar</span>
                                                    <textarea name="komentar" class="form-control" rows="2" required><?php echo $d['komentar']; ?></textarea>
                                                </div>
                                                <input type="hidden" name="idpenilaianlayanan" value="<?php echo $d['idpenilaianlayanan']; ?>">
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="hidden" name="idlapangan">
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-check"></i> Simpan
                                            </button>
                                            </form>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                <i class="bi bi-x"></i> Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Akhir Modal Edit Lapangan -->

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <p></p>
</body>

<div class="mt-5 p-4 bg-dark text-white text-center">
    Kupang
</div>

</html>
<?php
include 'assets/emstable.php'; //koneksi ke database
?>