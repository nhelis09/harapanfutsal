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
    <title>Tambah Lapangan</title>
    <?php include 'assets/cdn.php'; ?>
</head>

<body>
    <?php include 'assets/banner.php'; ?>
    <?php include 'assets/navbar.php'; ?>

    <div class="container mt-5">
        <p>
        <h5>Selamat datang, <?php echo namaadmin($_SESSION['username']); ?></h5>
        </p>
        <p>
        <h2><strong>Data Lapangan</strong></h2>
        </p>
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Tambah Lapangan Baru</h5>
                        <p></p>
                        <form action="insertlapangan.php" method="POST">
                            <div class="mb-3">
                                <label for="namalapangan" class="form-label">Nama Lapangan</label>
                                <input type="text" name="namalapangan" class="form-control" id="namalapangan" required>
                            </div>
                            <div class="mb-3">
                                <label for="hargasewa" class="form-label">Harga Sewa</label>
                                <input type="text" name="hargasewa" class="form-control" id="hargasewa" required>
                            </div>
                            <input type="hidden" name="idlapangan">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Tambah
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Data Tabel Lapangan</h5>
                        <table width="100%" class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar Lapangan</th>
                                    <th>Nama Lapangan</th>
                                    <th>Harga Sewa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data = mysqli_query($konektor, "SELECT * FROM lapangan order by idlapangan desc");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>
                                        <?php
                                            //Display image
                                            $file = $d['idlapangan'];
                                            if (file_exists("../assets/fotoprofil/$file.jpg")) {
                                            ?><a target="_blank"
                                            href="../assets/fotoprofil/<?php echo $d['idlapangan']; ?>.jpg"><img
                                                src="../assets/fotoprofil/<?php echo $d['idlapangan']; ?>.jpg"
                                                width="80" height="80" /></a>
                                        <small><a
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')"
                                                href="hapusgambar.php?idlapangan=<?php echo $d['idlapangan']; ?>">
                                                <i class="bi bi-trash"></i> Hapus</a></small>

                                        <?php
                                            } else { ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#myModalIMG"> <img
                                                src="../assets/images/blank.png" width="90" height="90" /></a>
                                        <?php
                                            }
                                            ?>
                                    </td>
                                    <td><?php echo $d['namalapangan']; ?></td>
                                    <td>Rp. <?php echo number_format($d['hargasewa'], 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#myModal<?php echo $d['idlapangan']; ?>">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <a href="deletelapangan.php?idlapangan=<?php echo $d['idlapangan']; ?>"
                                            class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus Lapangan ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </td>

                                </tr>


                                <!-- MODAL UPLOAD GAMBAR  -->
                                <div class="modal" id="myModalIMG">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <img src="../assets/images/logo1.png" width="50px"
                                                    alt="Deskripsi gambar">
                                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="alert alert-info">
                                                    Hanya bisa menerima gambar dalam format <span
                                                        style=" color: red;">jpg </span> dengan ukuran kurang dari <span
                                                        style=" color: red;">1MB</span>
                                                </div>
                                                <form action="unggahaksi.php" method="post"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="idlapangan"
                                                        value="<?php echo $d['idlapangan']; ?>">
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <!-- Untuk penamaan file -->
                                                <input type="file" class="form-control" name="berkas"><br>
                                                <button class="btn btn-info" type="submit">
                                                    <i class="bi bi-cloud-upload"></i>
                                                    <span class="sr-only">Unggah</span>
                                                </button>
                                                </form>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-lg"></i> Tutup
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- MODAL BAGIAN AKHIR UPLOAD GAMBAR  -->


                                <!-- The Modal -->
                                <div class="modal" id="myModal<?php echo $d['idlapangan']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <center>
                                                    <h4 class="modal-title">Ubah Data Lapangan</h4>
                                                </center>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <form action="editlapangan.php" method="POST">
                                                <div class="modal-body">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Nama Lapangan</span>
                                                        <input name="namalapangan"
                                                            value="<?php echo $d['namalapangan']; ?>" type="text"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Harga Sewa</span>
                                                        <input name="hargasewa" value="<?php echo $d['hargasewa']; ?>"
                                                            type="text" class="form-control" required>
                                                    </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <input name="idlapangan" value="<?php echo $d['idlapangan']; ?>"
                                                        type="hidden">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="bi bi-check"></i> Simpan
                                                    </button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">
                                                        <i class="bi bi-x"></i> Tutup
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Edit Lapangan -->

        </div>
    </div>
</body>


<div class="mt-5 p-4 bg-dark text-white text-center">
    Kupang
</div>

</html>
<?php
include 'assets/emstable.php'; //koneksi ke database
?>