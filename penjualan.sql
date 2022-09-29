-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Sep 2022 pada 06.34
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `banyak` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id_cart`, `id_user`, `id_product`, `banyak`, `total`) VALUES
(84, 12, 13, 1, 15000),
(85, 12, 15, 1, 20000),
(86, 12, 13, 1, 15000),
(87, 6, 13, 1, 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`) VALUES
(9, 'asin', 'asin'),
(10, 'manis', 'manis'),
(11, 'pedas', 'pedas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(225) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id_customer`, `nama_customer`, `email`, `phone_number`, `alamat`) VALUES
(1, 'Rita Sugiarto', 'ritasugiarto@gmail.com', '089965437272', 'Depok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `drivers`
--

CREATE TABLE `drivers` (
  `id_driver` int(11) NOT NULL,
  `name_driver` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `no_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `drivers`
--

INSERT INTO `drivers` (`id_driver`, `name_driver`, `email`, `password`, `phone_number`, `jurusan`, `no_pegawai`) VALUES
(2, 'Ahmad Faridh', 'farid@gmail.com', '$2y$10$jYa12Iccc3U5r.LOcVSi.etfKxweMBlRKJBfrwq.qf1/xu8q9UArG', '999999888767', 'BOGOR', 223355),
(5, 'Egy', 'egy123@gmail.com', '$2y$10$Ry/DjSEInc3bLrK33/Mw9OK.3qbZeE4P2iBClSKToklqhaUjxdZp6', '087854448292', 'JAKARTA', 232345);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `id_product` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `descriptions` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `stock` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id_product`, `product_name`, `unit`, `price`, `descriptions`, `category_id`, `stock`) VALUES
(13, 'keripik ubi ungu', 1, '15000', '<p>Keripik dengan bahan dasar ubi ungu pilihan.</p>\r\n\r\n<p>Berat/kemasan : 250gr</p>\r\n', 9, '17'),
(14, 'kremes ubi ungu', 1, '17000', '<p>kremes ubi dengan cita rasa manis</p>\r\n\r\n<p>Berat/kemasan : 250gr</p>\r\n', 10, '19'),
(15, 'keripik sukun', 1, '20000', '<p>keripik dengan bahan dasar sukun pilihan dan berkualitas</p>\r\n\r\n<p>Berat/kemasan : 250gr</p>\r\n', 9, '12'),
(16, 'stik ubi ungu', 1, '15000', '<p>Stik ubi ungu dengan cita rasa manis</p>\r\n\r\n<p>Berat/kemasan : 250gr</p>\r\n', 10, '10'),
(17, 'pangsit ubi ungu', 1, '17000', '<p>Pangsit ubi dengan cita rasa manis</p>\r\n\r\n<p>Berat/kemasan : 250gr</p>\r\n', 10, '20'),
(18, 'keripik singkong pedas', 1, '15000', '<p>Keripik singkong dengan cita rasa pedas yang pas.&nbsp;</p>\r\n\r\n<p>Berat/kemasan : 250gr</p>\r\n', 11, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products_galleries`
--

CREATE TABLE `products_galleries` (
  `id_gallery` int(11) NOT NULL,
  `photos` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products_galleries`
--

INSERT INTO `products_galleries` (`id_gallery`, `photos`, `product_id`) VALUES
(1, '632ff292d872f.jpg', 13),
(2, '631e3bd2109c4.jpg', 14),
(3, '631e3b5869de9.jpg', 15),
(4, '631e3b7cb9f69.jpg', 16),
(5, '631e3c23f15a6.jpg', 17),
(6, '4e747a1123b3b2a5cf4cfa22352974fc-1.jpg', 18),
(13, '631e3b359a5cc.jpg', 13),
(14, '631e3bd2109c4.jpg', 14),
(15, '631e3b5869de9.jpg', 15),
(16, '631e3b7cb9f69.jpg', 16),
(17, '631e3c23f15a6.jpg', 17),
(18, '4e747a1123b3b2a5cf4cfa22352974fc-1.jpg', 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_numbers`
--

CREATE TABLE `rekening_numbers` (
  `id_rekening` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `rekening_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rekening_numbers`
--

INSERT INTO `rekening_numbers` (`id_rekening`, `bank_name`, `number`, `rekening_name`) VALUES
(1, 'BCA', '0989878998787', 'Rini Yuliani'),
(2, 'Mandiri', '076543212123', 'Mustika '),
(3, 'Syariah', '09999977656', 'Nurlaela');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `rekening_id` int(11) NOT NULL,
  `transaction_status` varchar(255) NOT NULL,
  `weight_total` int(11) NOT NULL,
  `delivered` int(11) NOT NULL,
  `photo_transaction` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `time_arrived` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id_transaction`, `user_id`, `customer_id`, `total_price`, `city`, `rekening_id`, `transaction_status`, `weight_total`, `delivered`, `photo_transaction`, `code`, `receiver`, `time_arrived`, `created_at`) VALUES
(1, 3, 0, 260000, 'JAKARTA', 3, 'TERKIRIM', 4000, 0, '600d9b95c0711.jpg', 'EZM-57924', 'Melani', '2022-09-03 17:00:00', '2022-09-01 01:08:32'),
(2, 4, 0, 200000, 'JAKARTA', 1, 'TERKIRIM', 4000, 0, '600d9c6b4e0d8.jpg', 'EZM-9366', 'Rudi', '2022-08-07 02:00:23', '2022-08-03 09:12:13'),
(3, 1, 0, 560000, 'JAKARTA', 1, 'TERKIRIM', 3000, 0, '600e62cb73e61.png', 'EZM-86335', 'Rizki', '2022-08-18 03:02:56', '2022-08-15 06:17:49'),
(4, 4, 0, 100000, 'JAKARTA', 2, 'TERKIRIM', 1000, 0, '600eba552a23c.png', 'EZM-81471', 'Dwi', '2022-09-03 10:20:21', '2022-08-28 12:31:43'),
(5, 3, 0, 218000, 'JAKARTA', 2, 'BELUM KONFIRMASI', 6000, 0, '6010cc60e12da.png', 'EZM-51571', '', NULL, '2022-08-25 13:06:50'),
(6, 1, 0, 370000, 'JAKARTA', 1, 'TERKIRIM', 10000, 1, '6010ce5c5fc7f.png', 'EZM-98816', 'Mumun', '2022-08-19 05:26:45', '2021-08-15 02:21:26'),
(7, 2, 0, 129000, 'JAKARTA', 1, 'TERKONFIRMASI', 4000, 0, '632898bb8b4c2.png', 'EZM-19632', '', NULL, '2022-09-11 16:20:22'),
(8, 2, 0, 129000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 4000, 0, '632899c0a13cb.png', 'EZM-65647', '', NULL, '2022-09-11 16:23:50'),
(9, 2, 0, 129000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 4000, 0, '', 'EZM-19882', '', NULL, '2022-09-11 16:24:47'),
(10, 2, 0, 129000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 4000, 0, '6330edd574c51.jpg', 'EZM-91675', '', NULL, '2022-09-11 16:25:45'),
(11, 2, 0, 129000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 4000, 0, '', 'EZM-22092', '', NULL, '2022-09-11 16:26:14'),
(12, 2, 0, 129000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 4000, 0, '', 'EZM-80573', '', NULL, '2022-09-11 16:31:24'),
(13, 2, 0, 129000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 4000, 0, 'bukti tf', 'EZM-63043', '', NULL, '2022-09-22 12:32:21'),
(14, 2, 0, 45000, 'DEPOK', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-67865', '', NULL, '2022-09-11 16:46:46'),
(15, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-59349', '', NULL, '2022-09-11 16:47:48'),
(16, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-24059', '', NULL, '2022-09-11 16:47:55'),
(17, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-12229', '', NULL, '2022-09-11 16:48:01'),
(18, 12, 0, 45000, 'KUNINGAN', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-56208', '', NULL, '2022-09-11 16:48:05'),
(19, 12, 0, 45000, 'KUNINGAN', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-65024', '', NULL, '2022-09-11 16:48:14'),
(20, 12, 0, 45000, 'KUNINGAN', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-49474', '', NULL, '2022-09-11 16:48:27'),
(21, 12, 0, 45000, 'KUNINGAN', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-86467', '', NULL, '2022-09-11 16:48:50'),
(22, 12, 0, 45000, 'CIREBON', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-2918', '', NULL, '2022-09-11 16:48:54'),
(23, 12, 0, 45000, 'CIREBON', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-57009', '', NULL, '2022-09-11 16:49:01'),
(24, 12, 0, 45000, 'CIREBON', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-53505', '', NULL, '2022-09-11 16:49:08'),
(25, 12, 0, 45000, 'CIREBON', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-89430', '', NULL, '2022-09-11 16:49:13'),
(26, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-11290', '', NULL, '2022-09-11 16:49:18'),
(27, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-7571', '', NULL, '2022-09-11 16:49:22'),
(28, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-74090', '', NULL, '2022-09-11 16:49:26'),
(29, 12, 0, 45000, 'JAKARTA', 1, 'TERKONFIRMASI', 2000, 0, '6330eea0c5e1b.jpg', 'EZM-95727', '', NULL, '2022-09-11 16:49:31'),
(30, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-1215', '', NULL, '2022-09-11 16:49:35'),
(31, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-27641', '', NULL, '2022-09-11 16:49:39'),
(32, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-34818', 'Anisa', '2022-09-15 01:50:23', '2022-09-11 16:49:45'),
(33, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-38093', 'Rina', '2022-09-20 07:05:25', '2022-09-17 16:49:50'),
(34, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-23699', 'Anisa', '2022-08-06 17:00:00', '2022-08-03 16:49:55'),
(35, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-77337', 'Anisa', '2022-08-20 06:00:01', '2022-08-24 16:52:19'),
(36, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-29593', 'Rini', '2022-08-24 05:23:01', '2022-08-20 12:52:23'),
(37, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-73368', 'Anisa', '2022-09-01 03:15:22', '2022-08-28 01:52:27'),
(38, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-41977', 'Ryan', '2022-09-15 04:20:20', '2022-09-11 11:52:33'),
(39, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-34368', 'Anisa', '2022-09-18 03:03:28', '2022-09-16 09:42:38'),
(40, 12, 0, 45000, 'JAKARTA', 1, 'TERKONFIRMASI', 2000, 0, 'bukti tf.jpg', 'EZM-30132', '', NULL, '2022-09-15 08:01:43'),
(41, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-44643', '', NULL, '2022-09-26 13:52:48'),
(42, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-74867', 'Ryan', '2022-09-24 07:09:20', '2022-09-19 03:32:45'),
(43, 1, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-58984', '', NULL, '2022-09-11 16:53:51'),
(44, 1, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-84661', '', NULL, '2022-09-11 16:54:46'),
(45, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, '6330c9bd3a5e8.jpg', 'EZM-10936', 'Anisa', '2022-09-22 06:28:22', '2022-09-17 12:24:13'),
(46, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-48719', 'Anisa', '2022-08-12 06:24:22', '2022-08-08 09:42:07'),
(47, 12, 0, 45000, 'JAKARTA', 1, 'TERKIRIM', 2000, 0, 'bukti tf.jpg', 'EZM-89446', 'Ryan', '2022-09-21 05:20:21', '2022-09-17 07:55:09'),
(49, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-67317', '', NULL, '2022-09-11 16:57:54'),
(50, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-10552', '', NULL, '2022-09-11 16:57:58'),
(51, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-45435', '', NULL, '2022-09-11 17:25:26'),
(52, 12, 0, 45000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 2000, 0, '', 'EZM-76923', '', NULL, '2022-09-11 17:25:30'),
(53, 12, 0, 20000, 'JAKARTA', 1, 'BELUM KONFIRMASI', 1, 0, '', 'EZM-36581', '', NULL, '2022-09-12 14:37:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions_details`
--

CREATE TABLE `transactions_details` (
  `id_transaction_detail` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `banyak` int(11) NOT NULL,
  `code_product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transactions_details`
--

INSERT INTO `transactions_details` (`id_transaction_detail`, `transaction_id`, `product_id`, `user_id`, `price`, `banyak`, `code_product`) VALUES
(1, 1, 13, 1, 50000, 2, 'PRD-12943'),
(2, 1, 14, 1, 80000, 2, 'PRD-12943'),
(3, 2, 13, 1, 50000, 2, 'PRD-13113'),
(4, 2, 13, 1, 50000, 2, 'PRD-13113'),
(5, 3, 14, 1, 80000, 2, 'PRD-40981'),
(6, 3, 16, 3, 400000, 1, 'PRD-40981'),
(7, 4, 14, 2, 100000, 1, 'PRD-60879'),
(8, 5, 15, 2, 20000, 2, 'PRD-71011'),
(9, 5, 17, 2, 75000, 2, 'PRD-71011'),
(10, 5, 18, 3, 14000, 2, 'PRD-71011'),
(11, 6, 14, 4, 36000, 5, 'PRD-94186'),
(12, 6, 13, 4, 30000, 1, 'PRD-94186'),
(13, 6, 14, 4, 40000, 4, 'PRD-94186');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `postal_code` varchar(191) NOT NULL,
  `roles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `address`, `phone_number`, `postal_code`, `roles`) VALUES
(1, 'AMANDA PUTRI', 'manda@gmail.com', '$2y$10$2jrwSDZqHQgKlTUxPGnRau8ZD8Jgj9lNE4tBvRDsuNKNzVnEsbtxG', '<p>Jln Kampung Gunung No 22</p>\r\n', '099998887776', '224455', 'USER'),
(2, 'Vita Mahandari', 'vita@gmail.com', '$2y$10$2s/dgjADHLW1D5Ha.1qdz.as3ShDVYB/2V8fHh/P81dqtlKK2V8nG', '<p>Jln Rawa Belong No 54</p>\r\n', '098765432111', '445566', 'USER'),
(3, 'riski', 'riski@gmail.com', '$2y$10$xrt0u8OUv5S7n7L94MMSfuKtykPNnpvnrRLp0LQuV1dD5lsgpeuLW', '<p>Jln Athar Muhammad No 24</p>\r\n', '12345678', '10101010', 'USER'),
(4, 'Syatya Athary', 'athar@gmail.com', '$2y$10$LGiCeFBz8fFfOTkL8hMJxO1P6e6qq2aW3Vcc2jcc0SbdGHrVPnXX.', '<p>Jln H sanusi Gang Hamzah No 28</p>\r\n', '098777776668', '12345', 'OWNER'),
(5, 'admin123', 'admin123@gmail.com', '$2y$10$B8sCWiTy0FGPO/v2x7ctjeIF2K9H1kiIvcFzm9fs/F2cgIYEgheeC', NULL, '098765414', '', 'ADMIN'),
(6, 'anisa', 'anisa@gmail.com', '$2y$10$OYHWhatfCsEwUsIAgQbi7ekqKyNAQXXhPqT9LMEHSMSOgrbqTrsm6', '<p>cilimus</p>\r\n', '082132427569', '10550', 'USER'),
(12, 'Yuliana', 'yuliana@gmail.com', '$2y$10$Hy3p5ZDJw1kk8u.9uLiKd.RcmixlGsm7Ka4lxCQLmGLhRoB5VLc2a', '<p>cilimus</p>\r\n', '089872523987', '45556', 'OWNER');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id_driver`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `product_name` (`product_name`),
  ADD KEY `phone_number` (`phone_number`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indeks untuk tabel `products_galleries`
--
ALTER TABLE `products_galleries`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indeks untuk tabel `rekening_numbers`
--
ALTER TABLE `rekening_numbers`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `transactions_details`
--
ALTER TABLE `transactions_details`
  ADD PRIMARY KEY (`id_transaction_detail`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id_driver` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `products_galleries`
--
ALTER TABLE `products_galleries`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `rekening_numbers`
--
ALTER TABLE `rekening_numbers`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `transactions_details`
--
ALTER TABLE `transactions_details`
  MODIFY `id_transaction_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transactions_details`
--
ALTER TABLE `transactions_details`
  ADD CONSTRAINT `transactions_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_details_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id_transaction`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
