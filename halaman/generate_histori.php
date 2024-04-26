<?php
include '../assets/konektor.php';

$nama_dokumen = 'Daftar Pesanan Anda'; //Beri nama file PDF hasil.
include("../assets/mpdf60/mpdf.php"); //Lokasi file mpdf.php
//$mpdf = new mPDF('utf-8', 'A4'); // Membuat sebuah file pdf potrait atau tegak lurus
$mpdf = new mPDF("en-GB-x", "Letter-L", "", "", 10, 10, 10, 10, 6, 3); // Kertas landscape (mendatar)
$mpdf->SetHeader('');
//$mpdf->setFooter('{PAGENO}');// Memberi nomor halaman
ob_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Pesanan Anda</title>

</head>

<body>

    <p class="mb-8 leading-relaxed">
        <center><strong>Terimakasih Atas Kesetiaan Anda Dengan Kami</strong></center>
    </p>
    <table border="1" style="border-collapse: collapse;" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Dan Durasi Sewa</th>
                <th>Waktu Pertandingan</th>
                <th>Nama Lapangan</th>
                <th>Harga</th>
                <th>Total Harga Sewa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $data = mysqli_query($konektor, "SELECT pemesanan.*, lapangan.namalapangan, lapangan.hargasewa FROM pemesanan JOIN lapangan ON pemesanan.idlapangan = lapangan.idlapangan");
            while ($d = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['namapelanggan']; ?></td>
                <td><?php echo $d['tanggal'] . ' || ' . $d['durasisewa']; ?> Jam</td>
                <td><?php echo $d['waktupertandingan']; ?></td>
                <td><?php echo $d['namalapangan']; ?></td>
                <td>Rp. <?php echo number_format($d['hargasewa'], 0, ',', '.'); ?></td>
                <td>Rp. <?php echo number_format($d['totalhargasewa'], 0, ',', '.'); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <p></p>
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

$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen . ".pdf", 'I');
exit;
?>