-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2020 pada 19.59
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_paket` int(11) NOT NULL,
  `qty` double NOT NULL,
  `keterangan` text NOT NULL,
  `status_detail` enum('dikeranjang','ditransaksi') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_paket`, `qty`, `keterangan`, `status_detail`, `id_user`) VALUES
(110, 61, 2, 3, '', 'ditransaksi', 1),
(111, 62, 2, 2, '', 'ditransaksi', 1),
(119, 65, 2, 2, '', 'ditransaksi', 1),
(120, 65, 5, 1, '', 'ditransaksi', 1),
(122, 67, 2, 1, '', 'ditransaksi', 3),
(123, 67, 6, 1, '', 'ditransaksi', 3),
(124, 68, 3, 1, '', 'ditransaksi', 3),
(125, 69, 6, 1, '', 'ditransaksi', 3),
(126, 69, 4, 1, '', 'ditransaksi', 3),
(127, 70, 9, 3, '', 'ditransaksi', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` int(11) NOT NULL,
  `nm_member` varchar(100) NOT NULL,
  `alamat_member` text NOT NULL,
  `jk_member` enum('L','P') NOT NULL,
  `tlp_member` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `nm_member`, `alamat_member`, `jk_member`, `tlp_member`, `id_user`) VALUES
(2, 'Agus supermen', 'Sukabumi', 'P', '026654879', 1),
(3, 'Asep trol', 'jakarta', 'P', '0258545458', 1),
(6, 'member4', 'bandung', 'L', '028885645', 2),
(8, 'Reni', 'Bogor', 'L', '0266235789', 1),
(9, 'Sendi Rachmat Darmawan', 'Jl.Tipar', 'L', '085659430203', 1),
(10, 'Sendi Rachmat Darmawan', 'Tipar', 'L', '085659430203', 3),
(13, 'Mirna Wahyuni', 'Cisarua', 'L', '085862318581', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id_outlet` int(11) NOT NULL,
  `nm_outlet` varchar(100) NOT NULL,
  `alamat_outlet` text NOT NULL,
  `tlp_outlet` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_outlet`
--

INSERT INTO `tb_outlet` (`id_outlet`, `nm_outlet`, `alamat_outlet`, `tlp_outlet`) VALUES
(1, 'outlet1', 'bandung', '0266 235212'),
(2, 'outlet2', 'Sukabumi', '0266 2352222');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `jenis_paket` enum('standar','paketan') NOT NULL,
  `nm_paket` varchar(100) NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `deskripsi_paket` text NOT NULL,
  `gambar_paket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `id_outlet`, `jenis_paket`, `nm_paket`, `harga_paket`, `deskripsi_paket`, `gambar_paket`) VALUES
(1, 2, 'standar', 'Kemeja', 3000, 'Kemeja Lengan panjang, pendek dengan berbagai motif', 'kemeja.png'),
(2, 1, 'paketan', 'A', 25000, 'Semua jenis pakaian dengan berat 5 kg.', ''),
(3, 1, 'paketan', 'B', 50000, 'Semua jenis pakaian dengan total 15 kg.', ''),
(4, 1, 'paketan', 'C', 75000, 'Semua jenis selimut dengan berat 10 kg.', ''),
(5, 2, 'standar', 'Jaket', 7000, 'Levis Lengan panjang, pendek dengan berbagai motif', 'jaket.jpg'),
(6, 2, 'standar', 'Selimut', 15000, 'Selimut tipis (bukan bedcover) dengan berbagai motif.', 'selimut.jpeg'),
(7, 2, 'standar', 'Sprei', 10000, 'Sprei kasur dengan berbagai motif.', 'sprei.jpg'),
(8, 2, 'standar', 'Bedcover', 40000, 'Bedcover besar dan tebal, berbagai motif.', 'bedcover.jpeg'),
(9, 1, 'standar', 'Celana Jeans', 8000, 'Celana model jeans panjang/pendek.', 'jeans.jpeg'),
(10, 1, 'standar', 'Bedcover', 40000, 'Bedcover besar dan tebal, berbagai motif.', 'bedcover.jpeg'),
(11, 1, 'standar', 'Gorden Jendela', 10000, 'Gorden jendela ukuran 1 meter, dengan berbagai motif.', 'gorden.jpeg'),
(12, 1, 'standar', 'Kasur Lantai', 35000, 'Kasur lantai besar dengan berbagai motif.', 'kasurlantai.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `kode_invoice` varchar(100) NOT NULL,
  `id_member` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `batas_waktu` date NOT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `biaya_tambahan` int(11) DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `status_transaksi` enum('baru','proses','selesai','diambil') NOT NULL,
  `status_pembayaran` enum('dibayar','dp','belum bayar') NOT NULL,
  `id_user` int(11) NOT NULL,
  `bayar_transaksi` int(11) DEFAULT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_outlet`, `kode_invoice`, `id_member`, `tgl_transaksi`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `status_transaksi`, `status_pembayaran`, `id_user`, `bayar_transaksi`, `total_harga`) VALUES
(61, 1, '5e61c8e483bbc', 2, '2020-03-06', '2020-03-08', '2020-03-06 00:00:00', 0, 0, 0, 'diambil', 'dibayar', 1, 80000, 75000),
(62, 1, '5e61d0c1a39a4', 3, '2020-03-09', '2020-03-10', '2020-03-06 00:00:00', 0, 0, 0, 'diambil', 'dibayar', 1, 50000, 50000),
(65, 1, '5e65c28794947', 2, '2020-03-09', '2020-03-17', '2020-04-08 09:56:11', 0, 0, 0, 'diambil', 'dibayar', 1, 60000, 57000),
(67, 1, '5e932704144ea', 10, '2020-04-12', '2020-04-19', '2020-04-12 04:37:58', 0, 10, 2, 'diambil', 'dibayar', 3, 40000, 36800),
(68, 1, '5e93d8e52620e', 13, '2020-04-13', '2020-04-20', '2020-04-13 05:14:54', 0, 10, 1, 'diambil', 'dibayar', 3, 50000, 45500),
(69, 1, '5e93dbcf4b5af', 11, '2020-04-13', '2020-04-21', '2020-04-13 07:03:07', 2, 15, 5, 'diambil', 'dibayar', 3, 100000, 81002),
(70, 1, '5ea040856dfea', 10, '2020-04-22', '2020-04-27', '2020-04-22 03:03:14', 0, 0, 2, 'diambil', 'dibayar', 3, 25000, 24480);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `role` enum('admin','kasir','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nm_user`, `username`, `password`, `id_outlet`, `role`) VALUES
(1, 'asd', 'asd', 'asd', 1, 'kasir'),
(2, 'qwe', 'qwe', 'qwe', 2, 'kasir'),
(3, 'Sendi Rachmat Darmawan', 'Sendi', '123456', 1, 'kasir'),
(4, 'okeayah', 'okeayah', 'a02187376e439e86e3c41f80b7e0b41b', 1, 'admin'),
(5, 'kasir1', 'kasir1', '29c748d4d8f4bd5cbc0f3f60cb7ed3d0', 1, 'kasir'),
(6, 'admin1', 'admin1', 'admin1', 1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indeks untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indeks untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `kode_invoice` (`kode_invoice`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
