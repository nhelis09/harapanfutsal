<nav class="navbar navbar-expand-sm navbar-dark"
    style="background-image: url('assets/images/navbar1.png'); background-size: cover;">
    <div class="container-fluid">
        <div class="navbar-brand">
            <img src="assets/images/logo1.png" alt="Avatar Logo" style="width:40px; pointer-events: none;">
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="bi bi-house-door"></i> Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-calendar2-plus"></i> Penyewaan lapangan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModalCDS">Cari
                                dan
                                sewa lapangan</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#myModalDBT">Histori Pemesanan</a></li>

                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#myModalpenilaian">Berikan Penilaian</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModalHP">Histori
                                Penilaian</a></li>
                    </ul>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="pesan.php">Pesan<span class="badge bg-danger">3</a></span>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="auth/login.php"
                        onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- The Modal CARI DAN SEWA LAPANGAN -->
<div class="modal" id="myModalCDS">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title">Boking Lapangan Anda Sekarang</h1>
                <img src="assets/images/sewa1.png" width="20%" alt="..">

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="input-group mb-3">
                    <?php include 'assets/konektor.php'; ?>
                    <span class="input-group-text">Lapangan</span>

                    <form id="formPemesanan" action="insertpemesanan.php" method="POST">
                        <select name="idlapangan" class="custom-select form-control" required>
                            <?php
                            $data = mysqli_query($konektor, "SELECT * FROM lapangan ORDER BY namalapangan ASC");
                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                            <option value="<?php echo $d['idlapangan']; ?>"
                                data-hargasewa="<?php echo $d['hargasewa']; ?>">
                                <?php echo $d['namalapangan']; ?> - Harga Sewa: Rp.
                                <?php echo $d['hargasewa'];  ?> /jam
                            </option>
                            <?php } ?>
                        </select>
                </div>

                <div class="input-group mb-2">
                    <span class="input-group-text">Nama Pemesan</span>
                    <input name="namapelanggan" type="text" class="form-control" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Tanggal Boking</span>
                    <input name="tanggal" type="date" class="form-control" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Waktu Pertandingan</span>
                    <input name="waktupertandingan" type="time" class="form-control" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Durasi Sewa (jam)</span>
                    <input name="durasisewa" type="text" class="form-control" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Total Harga Sewa</span>
                    <input name="totalhargasewa" id="totalHargaSewa" type="text" class="form-control" readonly>
                </div>
            </div>

            <input type="hidden" name="totalhargasewa" id="totalHargaSewaInput" value="">

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-calendar-plus"></i> Boking Sekarang
                </button>
                </form>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>

    <!-- logika hitung hitungan  -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var select = document.querySelector("select[name='idlapangan']");
        var durasiInput = document.querySelector("input[name='durasisewa']");
        var totalHargaInput = document.getElementById("totalHargaSewa");

        function updateTotalHarga() {
            var hargaSewa = parseInt(select.options[select.selectedIndex].getAttribute("data-hargasewa"));
            var durasi = parseInt(durasiInput.value);
            var totalHarga = hargaSewa * durasi;

            totalHargaInput.value = "Rp " + totalHarga.toLocaleString('id-ID'); // Tambahkan format "Rp"
            document.getElementById("totalHargaSewaInput").value = totalHarga; // Tambahkan baris ini
        }

        select.addEventListener("change", updateTotalHarga);
        durasiInput.addEventListener("change", updateTotalHarga);

        // Panggil updateTotalHarga saat halaman dimuat untuk pertama kali
        updateTotalHarga();
    });
    </script>
</div>



<!-- Modal HISTORI PEMESANAN -->
<div class="modal" id="myModalDBT">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title">Histori Pemesanan Anda</h1>
                <img src="assets/images/histori1.png" width="20%" alt="..">
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <?php
                $data = mysqli_query($konektor, "SELECT pemesanan.*, lapangan.namalapangan, lapangan.hargasewa FROM pemesanan JOIN lapangan ON pemesanan.idlapangan = lapangan.idlapangan");
                if (mysqli_num_rows($data) > 0) {
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Waktu Pertandingan</th>
                                <th>Durasi Sewa (jam)</th>
                                <th>Nama Lapangan</th>
                                <th>Harga Lapangan</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['namapelanggan']; ?></td>
                                <td><?php echo $d['tanggal']; ?></td>
                                <td><?php echo $d['waktupertandingan']; ?></td>
                                <td><?php echo $d['durasisewa']; ?> Jam</td>
                                <td><?php echo $d['namalapangan']; ?></td>
                                <td>Rp <?php echo number_format($d['hargasewa'], 0, ',', '.'); ?></td>
                                <td>Rp <?php echo number_format($d['totalhargasewa'], 0, ',', '.'); ?></td>
                                <td>
                                    <form method="POST" action="hapushistori.php">
                                        <input type="hidden" name="idpemesanan"
                                            value="<?php echo $d['idpemesanan']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php
                } else {
                    echo '<p>Data pemesanan Anda belum ada, silakan lakukan pemesanan terlebih dahulu.</p>';
                }
                ?>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <form action="halaman/generate_histori.php" target="_blank" method="POST">
                    <button type="submit" class="btn btn-primary">Cetak Semua Data Pesanan Anda</button>

                </form>
                <!-- <?php if (mysqli_num_rows($data) > 0) { ?>
                <button type="button" class="btn btn-danger" onclick="deleteAllBookings()">Hapus Semua Histori
                    Pemesanan</button>
                   
                    
                <?php } ?> -->
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- 
<script>
function deleteAllBookings() {
    if (confirm('Apakah Anda yakin ingin menghapus semua histori pemesanan?')) {
        $.ajax({
            type: 'POST',
            url: 'deleteallpemesanan.php',
            success: function(response) {
                // Refresh tabel histori pemesanan setelah penghapusan
                $('#myTable').load(location.href + ' #myTable');
            }
        });
    }
}
</script> -->



<!-- Modal PENILAIAN -->
<div class="modal" id="myModalpenilaian">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Berikan Penilaian<br> Kepada Kami</h2>
                <img src="assets/images/penilaian1.png" width="20%" alt="..">
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="insertpenilaian" action="insertpenilaian.php" method="POST">
                    <div class="input-group mb-2">
                        <span class="input-group-text">Nama</span>
                        <input name="namapenilai" id="namapenilai" type="text" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <?php include 'assets/konektor.php'; ?>
                        <span class="input-group-text">Lapangan</span>

                        <form id="formPemesanan" action="insertpemesanan.php" method="POST">
                            <select name="idlapangan" class="custom-select form-control" required>
                                <?php
                                $data = mysqli_query($konektor, "SELECT * FROM lapangan ORDER BY namalapangan ASC");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                <option value="<?php echo $d['idlapangan']; ?>"
                                    data-hargasewa="<?php echo $d['hargasewa']; ?>">
                                    <?php echo $d['namalapangan']; ?>
                                    <?php } ?>
                            </select>
                    </div>

                    <div class="input-group mb-2">
                        <span class="input-group-text">Nilai Layanan</span>
                        <select name="nilailayanan" class="custom-select form-control" required>
                            <option value="1">kurang Baik</option>
                            <option value="2">Baik</option>
                            <option value="3">Bagus</option>
                            <option value="4">Sangat Bangus</option>
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">Komentar</span>
                        <textarea name="komentar" class="form-control" rows="2" required></textarea>
                    </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <input type="hidden" name="idusers">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                </form>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



<!-- MODAL HISTORI PENILAIAN -->

<!-- The Modal -->
<div class="modal" id="myModalHP">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Histori Penilaian Anda</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal & Waktu</th>
                                    <th>Nama</th>
                                    <th>Layanan Kami</th>
                                    <th>Nilai Layanan</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data = mysqli_query($konektor, "select * from penilaianlayanan");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d['tanggalpenilaian']; ?></td>
                                    <td><?php echo $d['namapenilai']; ?></td>
                                    <td><?php echo lapangan($d['idlapangan']); ?></td>
                                    <td><?php echo namastatus($d['nilailayanan']); ?></td>
                                    <td><?php echo $d['komentar']; ?></td>
                                    <td>
                                        <a href="editpenilaianlayanan.php?id=<?php echo $d['idpenilaianlayanan']; ?>"
                                            class="btn btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="index.php?hapus=<?php echo $d['idpenilaianlayanan']; ?>"
                                            class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>


<!-- MODAL EDIT DALAM MODAL HISTORI PENILAIAN -->
<!-- The Modal -->
<?php
$data = mysqli_query($konektor, "select * from penilaianlayanan");
while ($d = mysqli_fetch_array($data)) {
?>
<div class="modal" id="myModalEdit<?php echo $d['idpenilaianlayanan']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Histori Penilaian</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="editpenilaian.php" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nama</span>
                        <input name="namapenilai" value="<?php echo $d['namapenilai']; ?>" type="text"
                            class="form-control" required>
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
                        <textarea name="komentar" class="form-control" rows="2"
                            required><?php echo $d['komentar']; ?></textarea>
                    </div>
                    <input type="hidden" name="idpenilaianlayanan" value="<?php echo $d['idpenilaianlayanan']; ?>">
            </div>


            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>
<?php } ?>

<script>
function openEditModal(id) {
    $('#myModalEdit' + id).modal('show');
}
</script>