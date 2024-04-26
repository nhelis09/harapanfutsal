<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran Berhasil</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../assets/images/player.png" type="image/x-icon">
</head>

<body>
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
            <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="hero"
                src="../assets/images/thankyou-img.png">
            <div class="text-center lg:w-2/3 w-full">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                    Terimakasih Atas Pesanannya
                </h1>
                <p class="mb-8 leading-relaxed">
                    Silakan datang dan lakukan Pembayaran ditempat<span style=" color: red;"> 1 Jam lebih awal</span>
                    sebelum pertandingan dimulai</p>
                <div class="flex justify-center">
                    <a href="../index.php"
                        class="inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">
                        Kembali
                    </a>
                    <form id="printForm" action="generate_pdf.php" target="_blank" method="post">
                        <input type="hidden" name="idlapangan" value="<?php echo $_POST['idlapangan']; ?>">
                        <input type="hidden" name="idlapangan" value="<?php echo $_POST['namalapangan']; ?>">
                        <input type="hidden" name="namapelanggan" value="<?php echo $_POST['namapelanggan']; ?>">
                        <input type="hidden" name="tanggal" value="<?php echo $_POST['tanggal']; ?>">
                        <input type="hidden" name="durasisewa" value="<?php echo $_POST['hargasewa']; ?>">
                        <button type="submit"
                            class="ml-4 inline-flex text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">
                            Cetak Bukti Pesanan Anda
                        </button>
                    </form>
                </div>
            </div>
    </section>
</body>

</html>