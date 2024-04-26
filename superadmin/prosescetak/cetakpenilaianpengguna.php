<?php
include '../../assets/konektor.php';
include '../assets/cekdata.php';
$mulai = $_POST['mulai'];
$selesai = $_POST['selesai'];
$format = $_POST['format'];


if ($format == 'xls') {
    header("Content-Type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan Data.xls");
} else {
    $nama_dokumen = 'Laporan Data'; //Beri nama file PDF hasil.
    include("../../assets/mpdf60/mpdf.php"); //Lokasi file mpdf.php
    //$mpdf = new mPDF('utf-8', 'A4'); // Membuat sebuah file pdf potrait atau tegak lurus
    $mpdf = new mPDF("en-GB-x", "Letter-L", "", "", 10, 10, 10, 10, 6, 3); // Kertas landscape (mendatar)
    $mpdf->SetHeader('');
    //$mpdf->setFooter('{PAGENO}');// Memberi nomor halaman
    ob_start();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Histori Pesanan</title>
</head>

<body>
    <strong>
        <h4>Histori Pemesanan</h4>
    </strong>
    <br>
    <i>Priode:<?php echo logdate($mulai); ?> s.d <?php echo logdate($selesai); ?></i>
    <hr>
    <br>
    <table border="1" style="border-collapse: collapse;" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penilaian</th>
                <th>Nama Penilai</th>
                <th>Nama Lapangan</th>
                <th>Nilai Layanan</th>
                <th>Komentar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $jumlahKurangBaik = 0;
            $jumlahBaik = 0;
            $jumlahBagus = 0;
            $jumlahSangatBaik = 0;

            $data = mysqli_query($konektor, "SELECT * FROM penilaianlayanan WHERE DATE(tanggalpenilaian) BETWEEN '$mulai' AND '$selesai' ORDER BY idpenilaianlayanan  DESC");
            while ($d = mysqli_fetch_array($data)) {
                // Hitung total nilai layanan
                $totalNilai += $d['nilailayanan'];
                // Tambahkan jumlah penilaian untuk setiap kategori
                if ($d['nilailayanan'] == 1) {
                    $jumlahKurangBaik++;
                } elseif ($d['nilailayanan'] == 2) {
                    $jumlahBaik++;
                } elseif ($d['nilailayanan'] == 3) {
                    $jumlahBagus++;
                } elseif ($d['nilailayanan'] == 4) {
                    $jumlahSangatBaik++;
                }
                // Increment jumlah penilaian
                $jumlahPenilaian++;
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['tanggalpenilaian']; ?></td>
                <td><?php echo $d['namapenilai']; ?></td>
                <td><?php echo lapangan2($d['idlapangan']); ?></td>
                <td><?php echo namastatus($d['nilailayanan']); ?></td>
                <td><?php echo $d['komentar']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <h4>Data Penilaian Pengguna</h4>
    <p>Jumlah Layanan Kurang Baik: <?php echo $jumlahKurangBaik; ?><br>
        Jumlah Layanan Baik: <?php echo $jumlahBaik; ?><br>
        Jumlah Layanan Bagus: <?php echo $jumlahBagus; ?><br>
        Jumlah Layanan Sangat Bagus: <?php echo $jumlahSangatBaik; ?>
    </p>


    <!-- cetak tanggal dan jam -->
    <center>
        <small>
            <?php
            date_default_timezone_set('Asia/Makassar'); // Set zona waktu ke Waktu Indonesia Barat (WITA)
            // Tampilkan tanggal dalam format yang diinginkan
            echo "Dicetak Tanggal: " . ucwords(strtolower(date('j F Y')));
            // Contoh lain 
            echo " Jam : " . date('H:i:a');
            ?>
        </small>
    </center>
    <p></p>
    <!-- AKHIR cetak tanggal dan jam -->


</body>

</html>
<?php
if ($format == 'pdf') {

    $html = ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($nama_dokumen . ".pdf", 'I');
    exit;
}
?>