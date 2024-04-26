-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Apr 2024 pada 06.26
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbharahapfutsal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `idkegiatan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `namakegiatan` text NOT NULL,
  `isi` text NOT NULL,
  `tanggalpublikasi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapangan`
--

CREATE TABLE `lapangan` (
  `idlapangan` int(11) NOT NULL,
  `namalapangan` text NOT NULL,
  `hargasewa` int(11) NOT NULL,
  `gambarlapangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lapangan`
--

INSERT INTO `lapangan` (`idlapangan`, `namalapangan`, `hargasewa`, `gambarlapangan`) VALUES
(2, 'Lapangan Alaska', 150000, ''),
(3, 'Lapangan Oepoi', 200000, ''),
(34, 'lapangan lembata', 1000000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `idpemesanan` int(11) NOT NULL,
  `idlapangan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktupertandingan` time NOT NULL,
  `namapelanggan` text NOT NULL,
  `durasisewa` tinyint(4) NOT NULL,
  `totalhargasewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`idpemesanan`, `idlapangan`, `tanggal`, `waktupertandingan`, `namapelanggan`, `durasisewa`, `totalhargasewa`) VALUES
(66, 4, '2024-04-19', '19:48:00', 'Kornelis Andrian Kabo', 2, 600000),
(68, 4, '2024-04-20', '11:26:00', 'coba', 1, 300000),
(69, 4, '2024-04-20', '17:53:00', 'andy2', 5, 1500000),
(70, 4, '2024-04-20', '18:16:00', 'andy', 5, 1500000),
(71, 13, '2024-05-11', '05:05:00', 'andy', 4, 400000),
(72, 4, '2024-04-20', '01:37:00', 'andy', 9, 2700000),
(73, 4, '2024-04-20', '06:30:00', 'andy', 2, 600000),
(74, 13, '2024-05-10', '09:04:00', 'andy', 9, 900000),
(75, 1, '2024-04-23', '04:26:00', 'andy', 9, 900000),
(76, 2, '2024-04-25', '06:53:00', 'andy', 4, 600000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaianlayanan`
--

CREATE TABLE `penilaianlayanan` (
  `idpenilaianlayanan` int(11) NOT NULL,
  `namapenilai` text NOT NULL,
  `idlapangan` int(11) NOT NULL,
  `nilailayanan` int(11) NOT NULL,
  `komentar` text NOT NULL,
  `tanggalpenilaian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penilaianlayanan`
--

INSERT INTO `penilaianlayanan` (`idpenilaianlayanan`, `namapenilai`, `idlapangan`, `nilailayanan`, `komentar`, `tanggalpenilaian`) VALUES
(22, 'louis supratman', 1, 1, 'mantap', '2024-04-19 17:30:07'),
(23, 'yos asap2', 2, 4, 'lumayan2', '2024-04-19 16:29:52'),
(24, 'yos asap2', 1, 4, 'aaaa', '2024-04-19 17:30:19'),
(25, 'hanes', 15, 3, 'mantap nih', '2024-04-19 17:36:17'),
(26, 'vigo', 13, 1, 'lumayan untuk bertanding', '2024-04-19 17:40:59'),
(27, 'hanes', 3, 2, 'mantap betul', '2024-04-19 17:44:26'),
(28, 'louis supratman', 4, 1, 'asik', '2024-04-19 17:47:51'),
(29, 'coba', 4, 4, 'sangat bagus', '2024-04-20 04:19:42'),
(30, 'hanes', 4, 4, 'bagus', '2024-04-20 10:46:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `idprofil` int(11) NOT NULL,
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `telepon` text NOT NULL,
  `email` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`idprofil`, `nama`, `alamat`, `telepon`, `email`, `deskripsi`) VALUES
(1, 'HARAHAP FUTSAL', 'Kupang', '082237487497', 'Harapfutsalkupang@gmail.com', 'Harahap Futsal adalah tempat sewa lapangan futsal terbaik di kota Anda. Kami menyediakan fasilitas                     lapangan yang nyaman dan bersih untuk memastikan pengalaman bermain futsal Anda lebih menyenangkan.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `superadmin`
--

CREATE TABLE `superadmin` (
  `idsuperadmin` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `superadmin`
--

INSERT INTO `superadmin` (`idsuperadmin`, `nama`, `email`, `password`) VALUES
(1, 'Kornelis Andrian Kabo', 'andyapc09@gmail.com', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`idusers`, `nama`, `email`, `password`) VALUES
(7, 'KORNELIS ANDRIAN KABO', 'andyapc09@gmail.com', '12'),
(8, 'IMACULATA DELSI BEDA', 'Delsybeda2804@gmail.com', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`idkegiatan`);

--
-- Indeks untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`idlapangan`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`idpemesanan`);

--
-- Indeks untuk tabel `penilaianlayanan`
--
ALTER TABLE `penilaianlayanan`
  ADD PRIMARY KEY (`idpenilaianlayanan`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`idprofil`);

--
-- Indeks untuk tabel `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`idsuperadmin`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `idkegiatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `idlapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `idpemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `penilaianlayanan`
--
ALTER TABLE `penilaianlayanan`
  MODIFY `idpenilaianlayanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `idprofil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `idsuperadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
