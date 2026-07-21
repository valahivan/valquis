-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2026 at 06:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `valquis`
--

-- --------------------------------------------------------

--
-- Table structure for table `val_admin`
--

CREATE TABLE `val_admin` (
  `id_admin` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `val_admin`
--

INSERT INTO `val_admin` (`id_admin`, `username`, `password`, `nama`, `created_at`) VALUES
(1, 'admincbt', 'admin12345', 'Valah Ivan Maulana', '2026-06-29 01:10:20');

-- --------------------------------------------------------

--
-- Table structure for table `val_group`
--

CREATE TABLE `val_group` (
  `id_group` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `val_group`
--

INSERT INTO `val_group` (`id_group`, `nama`, `created_at`) VALUES
(1, 'XII Akuntansi', '2026-07-16 03:26:11'),
(2, 'XII TKJ 1', '2026-07-16 03:26:20'),
(3, 'XII TKJ 2', '2026-07-16 03:26:28'),
(4, 'XII TKR 1', '2026-07-16 03:26:40'),
(5, 'XII TKR 2', '2026-07-16 03:26:49'),
(6, 'XI Akuntansi', '2026-07-16 03:27:03'),
(7, 'XI TKJ 1', '2026-07-16 03:27:17'),
(8, 'XI TKJ 2', '2026-07-16 03:27:24'),
(9, 'XI TKJ 3', '2026-07-16 03:27:33'),
(10, 'XI TKR 1', '2026-07-16 03:27:48'),
(11, 'XI TKR 2', '2026-07-16 03:27:55'),
(12, 'X Akuntansi', '2026-07-16 03:28:11'),
(13, 'X TKJ 1', '2026-07-16 03:28:21'),
(14, 'X TKJ 2', '2026-07-16 03:28:29'),
(15, 'X TKR 1', '2026-07-16 03:28:40'),
(16, 'X TKR 2', '2026-07-16 03:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `val_hasil`
--

CREATE TABLE `val_hasil` (
  `id_hasil` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `setquis_id` bigint(20) NOT NULL,
  `nilai` int(3) NOT NULL DEFAULT 0,
  `waktu_berjalan` varchar(50) NOT NULL,
  `status` enum('belum','sedang','selesai','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `val_hasil`
--

INSERT INTO `val_hasil` (`id_hasil`, `user_id`, `group_id`, `setquis_id`, `nilai`, `waktu_berjalan`, `status`, `created_at`) VALUES
(1, 3, 2, 1, 85, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:50:49'),
(2, 4, 2, 1, 90, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:55:52'),
(3, 5, 2, 1, 85, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:59:16'),
(4, 6, 2, 1, 75, 'Berjalan 6 menit', 'selesai', '2026-07-18 12:06:13'),
(5, 7, 2, 1, 85, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:50:49'),
(6, 8, 2, 1, 69, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:55:52'),
(7, 9, 2, 1, 71, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:59:16'),
(8, 10, 2, 1, 80, 'Berjalan 6 menit', 'selesai', '2026-07-18 12:06:13'),
(9, 11, 2, 1, 65, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:50:49'),
(10, 12, 2, 1, 60, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:55:52'),
(11, 13, 2, 1, 66, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:59:16'),
(12, 14, 2, 1, 84, 'Berjalan 6 menit', 'selesai', '2026-07-18 12:06:13'),
(13, 15, 2, 1, 72, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:50:49'),
(14, 17, 2, 1, 97, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:55:52'),
(15, 16, 2, 1, 75, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:59:16'),
(16, 18, 2, 1, 79, 'Berjalan 6 menit', 'selesai', '2026-07-18 12:06:13'),
(17, 19, 2, 1, 86, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:50:49'),
(18, 20, 2, 1, 74, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:55:52'),
(19, 21, 2, 1, 77, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:59:16'),
(20, 22, 2, 1, 71, 'Berjalan 6 menit', 'selesai', '2026-07-18 12:06:13'),
(21, 23, 2, 1, 68, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:50:49'),
(22, 24, 2, 1, 90, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:55:52'),
(23, 25, 2, 1, 71, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:59:16'),
(24, 26, 2, 1, 70, 'Berjalan 6 menit', 'selesai', '2026-07-18 12:06:13'),
(25, 27, 2, 1, 82, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:55:52'),
(26, 9, 2, 1, 96, 'Berjalan 7 menit', 'selesai', '2026-07-18 11:59:16'),
(27, 29, 2, 1, 78, 'Berjalan 6 menit', 'selesai', '2026-07-18 12:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `val_jawaban`
--

CREATE TABLE `val_jawaban` (
  `id_jawaban` bigint(20) NOT NULL,
  `soal_id` bigint(20) NOT NULL,
  `pilihan` text DEFAULT NULL,
  `pilihan_benar` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `val_jawaban`
--

INSERT INTO `val_jawaban` (`id_jawaban`, `soal_id`, `pilihan`, `pilihan_benar`, `created_at`) VALUES
(1, 1, '<p>Linear Search</p>', 0, '2026-07-17 10:07:42'),
(2, 1, '<p>Binary Search</p>', 1, '2026-07-17 10:07:42'),
(3, 1, '<p>Bubble Sort</p>', 0, '2026-07-17 10:07:42'),
(4, 1, '<p>Insertion Sort</p>', 0, '2026-07-17 10:07:42'),
(5, 2, '<p>Leaf</p>', 0, '2026-07-17 10:07:42'),
(6, 2, '<p>Branch</p>', 0, '2026-07-17 10:07:42'),
(7, 2, '<p>Root</p>', 1, '2026-07-17 10:07:42'),
(8, 2, '<p>child</p>', 0, '2026-07-17 10:07:42'),
(9, 3, '<p>Stack</p>', 0, '2026-07-17 10:07:42'),
(10, 3, '<p>Queue</p>', 1, '2026-07-17 10:07:42'),
(11, 3, '<p>Array</p>', 0, '2026-07-17 10:07:42'),
(12, 3, '<p>Graph</p>', 0, '2026-07-17 10:07:42'),
(13, 4, '<p>Design</p>', 0, '2026-07-17 10:07:42'),
(14, 4, '<p>Testing</p>', 0, '2026-07-17 10:07:42'),
(15, 4, '<p>Analiysis</p>', 1, '2026-07-17 10:07:42'),
(16, 4, '<p>Implementation</p>', 0, '2026-07-17 10:07:42'),
(17, 5, '<p>Waterfall</p>', 0, '2026-07-17 10:07:42'),
(18, 5, '<p>Agile</p>', 1, '2026-07-17 10:07:42'),
(19, 5, '<p>Spiral</p>', 0, '2026-07-17 10:07:42'),
(20, 5, '<p>Linear</p>', 0, '2026-07-17 10:07:42'),
(21, 6, '<p>Switch</p>', 0, '2026-07-17 10:07:42'),
(22, 6, '<p>Hub</p>', 0, '2026-07-17 10:07:42'),
(23, 6, '<p>Router</p>', 1, '2026-07-17 10:07:42'),
(24, 6, '<p>Modem</p>', 0, '2026-07-17 10:07:42'),
(25, 7, '<p>POP3</p>', 0, '2026-07-17 10:07:42'),
(26, 7, '<p>HTTP</p>', 0, '2026-07-17 10:07:42'),
(27, 7, '<p>SMTP</p>', 1, '2026-07-17 10:07:42'),
(28, 7, '<p>FTP</p>', 0, '2026-07-17 10:07:42'),
(29, 8, '<p>Coaxial</p>\r\n', 0, '2026-07-17 10:07:42'),
(30, 8, '<p>UTP</p>', 0, '2026-07-17 10:07:42'),
(31, 8, '<p>Fiber Optic</p>\r\n', 1, '2026-07-17 10:07:42'),
(32, 8, '<p>STP</p>', 0, '2026-07-17 10:07:42'),
(33, 9, '<p>Ransomware</p>', 1, '2026-07-17 10:07:42'),
(34, 9, '<p>Spayware</p>', 0, '2026-07-17 10:07:42'),
(35, 9, '<p>Phising</p>', 0, '2026-07-17 10:07:42'),
(36, 9, '<p>Trojan</p>', 0, '2026-07-17 10:07:42'),
(37, 10, '<p>MAC Filtering</p>', 0, '2026-07-17 10:07:42'),
(38, 10, '<p>WPA3 Encryption</p>', 0, '2026-07-17 10:07:42'),
(39, 10, '<p>SSID Broadcast Disabling</p>', 1, '2026-07-17 10:07:42'),
(40, 10, '<p>Firewall Setup</p>', 0, '2026-07-17 10:07:42'),
(41, 11, '<p>UPDATE</p>', 0, '2026-07-17 10:07:42'),
(42, 11, '<p>INSERT</p>', 0, '2026-07-17 10:07:42'),
(43, 11, '<p>SELECT</p>', 1, '2026-07-17 10:07:42'),
(44, 11, '<p>DELETE</p>', 0, '2026-07-17 10:07:42'),
(45, 12, '<p>Metadata</p>', 0, '2026-07-17 10:07:42'),
(46, 12, '<p>Big Data</p>', 1, '2026-07-17 10:07:42'),
(47, 12, '<p>Data Warehouse</p>', 0, '2026-07-17 10:07:42'),
(48, 12, '<p>Datamining</p>', 0, '2026-07-17 10:07:42'),
(49, 13, '<p>Data Cleansing</p>', 1, '2026-07-17 10:07:42'),
(50, 13, '<p>Data Mining</p>', 0, '2026-07-17 10:07:42'),
(51, 13, '<p>Data Ingestion</p>', 0, '2026-07-17 10:07:42'),
(52, 13, '<p>Data Modeling</p>', 0, '2026-07-17 10:07:42'),
(53, 14, '<p>Natural Language Processing</p>', 0, '2026-07-17 10:07:42'),
(54, 14, '<p>Computer Vision</p>', 1, '2026-07-17 10:07:42'),
(55, 14, '<p>Expert System</p>', 0, '2026-07-17 10:07:42'),
(56, 14, '<p>Speech Recognition</p>', 0, '2026-07-17 10:07:42'),
(57, 15, '<p>Menggunakan software open source</p>', 0, '2026-07-17 10:07:42'),
(58, 15, '<p>Melakukan modifikasi kode berlisensi MIT</p>', 0, '2026-07-17 10:07:42'),
(59, 15, '<p>Menggandakan software komersial tanpa izin</p>', 1, '2026-07-17 10:07:42'),
(60, 15, '<p>Membeli lisensi resmi sistem operasi</p>', 0, '2026-07-17 10:07:42'),
(61, 16, '<p>Meningkatnya kesenjangan digital</p>', 0, '2026-07-17 10:07:42'),
(62, 16, '<p>Membuka peluang pasar global bagi UMKM</p>', 1, '2026-07-17 10:07:42'),
(63, 16, '<p>Menurunnya keamanan transaksi finansial</p>', 0, '2026-07-17 10:07:42'),
(64, 16, '<p>Berkurangnya lapangan kerja sektor logistik</p>', 0, '2026-07-17 10:07:42'),
(65, 17, '<p>Freeware</p>', 0, '2026-07-17 10:07:42'),
(66, 17, '<p>Shareware</p>', 1, '2026-07-17 10:07:42'),
(67, 17, '<p>Open Source</p>', 0, '2026-07-17 10:07:42'),
(68, 17, '<p>Proprietary</p>', 0, '2026-07-17 10:07:42'),
(69, 18, '<p>Agar pesan terkirim lebih cepat</p>', 0, '2026-07-17 10:07:42'),
(70, 18, '<p>Agar hemat kuota data internet</p>', 0, '2026-07-17 10:07:42'),
(71, 18, '<p>Agar pesan hanya bisa dibaca oleh pengirim dan penerima</p>', 1, '2026-07-17 10:07:42'),
(72, 18, '<p>Agar ukuran file pesan menjadi lebih kecil</p>', 0, '2026-07-17 10:07:42'),
(73, 19, '<p>SaaS (Software as a Service)</p>', 0, '2026-07-17 10:07:42'),
(74, 19, '<p>PaaS (Platform as a Service)</p>', 0, '2026-07-17 10:07:42'),
(75, 19, '<p>IaaS (Infrastructure as a Service)</p>', 1, '2026-07-17 10:07:42'),
(76, 19, '<p>DaaS (Data as a Service)</p>', 0, '2026-07-17 10:07:42'),
(77, 20, '<p>Selection Sort</p>', 0, '2026-07-17 10:07:42'),
(78, 20, '<p>Merge Sort</p>', 0, '2026-07-17 10:07:42'),
(79, 20, '<p>Quick Sort</p>', 0, '2026-07-17 10:07:42'),
(80, 20, '<p>Bubble Sort</p>', 1, '2026-07-17 10:07:42'),
(81, 21, '<p>Sabar dalam menerima cobaan</p>', 1, '2026-07-17 10:09:16'),
(82, 21, '<p>Sabar dalam menerima ujian</p>', 0, '2026-07-17 10:09:16'),
(83, 21, '<p>Sabar dalam menerima takdir</p>', 0, '2026-07-17 10:09:16'),
(84, 21, '<p>Sabar menerima musibah</p>', 0, '2026-07-17 10:09:16'),
(85, 21, '<p>Sabar dalam taat kepada Allah SWT</p>', 0, '2026-07-17 10:09:16'),
(86, 22, '<p>Hauqolah</p>', 0, '2026-07-17 10:09:16'),
(87, 22, '<p>Tarji’</p>', 1, '2026-07-17 10:09:16'),
(88, 22, '<p>Tasbih</p>', 0, '2026-07-17 10:09:16'),
(89, 22, '<p>Tahmid</p>', 0, '2026-07-17 10:09:16'),
(90, 22, '<p>Tahlil</p>', 0, '2026-07-17 10:09:16'),
(91, 23, '<p>Selalu berburuk sangka</p>', 0, '2026-07-17 10:09:16'),
(92, 23, '<p>Memperoleh teman yang banyak</p>', 0, '2026-07-17 10:09:16'),
(93, 23, '<p>Memperoleh kasih sayang manusia</p>', 0, '2026-07-17 10:09:16'),
(94, 23, '<p>Selalu mendapatkan yang ia inginkan</p>', 0, '2026-07-17 10:09:16'),
(95, 23, '<p>Memperoleh martabat tinggi di surga</p>', 1, '2026-07-17 10:09:16'),
(96, 24, '<p>Sabar dalam melaksanakan ketaatan kepada Allah Swt</p>', 1, '2026-07-17 10:09:16'),
(97, 24, '<p>Rela terhadap qodha\'nya Allah Swt</p>', 0, '2026-07-17 10:09:16'),
(98, 24, '<p>Sabar dalam menjauhi maksiat</p>', 0, '2026-07-17 10:09:16'),
(99, 24, '<p>Sabar dalam menerima takdir</p>', 0, '2026-07-17 10:09:16'),
(100, 24, '<p>Iman kepada takdir Allah Swt</p>', 0, '2026-07-17 10:09:16'),
(101, 25, '<p>1, 2, 3 dan 4</p>', 1, '2026-07-17 10:09:16'),
(102, 25, '<p>1, 2, 3 dan 5</p>', 0, '2026-07-17 10:09:16'),
(103, 25, '<p>1, 2 dan 4</p>', 0, '2026-07-17 10:09:16'),
(104, 25, '<p>2, 3 dan 4</p>', 0, '2026-07-17 10:09:16'),
(105, 25, '<p>3, 4 dan 5</p>', 0, '2026-07-17 10:09:16'),
(106, 26, '<p>Bertaubat memohon ampun atas dosa yang dilakukan</p>', 1, '2026-07-17 10:09:16'),
(107, 26, '<p>Menangisi dan mengakui atas kelemahan diri sendiri</p>', 0, '2026-07-17 10:09:16'),
(108, 26, '<p>Melakukan konsultasi dengan ustadz atau guru ngaji</p>', 0, '2026-07-17 10:09:16'),
(109, 26, '<p>Membaca Al-Quran dan memohon ampun Allah</p>', 0, '2026-07-17 10:09:16'),
(110, 26, '<p>Berupaya menenangkan diri untuk tidak depresi</p>', 0, '2026-07-17 10:09:16'),
(111, 27, '<p>Ihsan kepada makhluk Allah</p>', 0, '2026-07-17 10:09:16'),
(112, 27, '<p>Ihsan kepada sesama manusia</p>', 1, '2026-07-17 10:09:16'),
(113, 27, '<p>Supaya dikatakan suka menolong</p>', 0, '2026-07-17 10:09:16'),
(114, 27, '<p>Panggilan nurani sebagai manusia</p>', 0, '2026-07-17 10:09:16'),
(115, 27, '<p>Merasa terpanggil untuk menolong</p>', 0, '2026-07-17 10:09:16'),
(116, 28, '<p>Mahasiswa harus taat beribadah</p>', 0, '2026-07-17 10:09:16'),
(117, 28, '<p>Ardi seorang yang khusuk dalam sholatnya</p>', 0, '2026-07-17 10:09:16'),
(118, 28, '<p>Orang yang bersyukur akan ditambah nikmatnya</p>', 0, '2026-07-17 10:09:16'),
(119, 28, '<p>Ardi adalah mahasiswa yang rajin membaca Al-Quran</p>', 0, '2026-07-17 10:09:16'),
(120, 28, '<p>Ardi seorang muslim yang bersyukur dengan tetap istiqomah dalam ibadah</p>', 1, '2026-07-17 10:09:16'),
(121, 29, '<p>Berpikiran jahat</p>', 0, '2026-07-17 10:09:16'),
(122, 29, '<p>Berprofesi mata-mata</p>', 1, '2026-07-17 10:09:16'),
(123, 29, '<p>Berbuat kemungkaran</p>', 0, '2026-07-17 10:09:16'),
(124, 29, '<p>Muslim yang lemah</p>', 1, '2026-07-17 10:09:16'),
(125, 29, '<p>Munafik sejati</p>', 0, '2026-07-17 10:09:16'),
(126, 30, '<p>Abdullah bin Umar</p>', 0, '2026-07-17 10:09:16'),
(127, 30, '<p>Abdullah bin Jahsyi</p>', 0, '2026-07-17 10:09:16'),
(128, 30, '<p>Abdullah bin Ubay</p>', 1, '2026-07-17 10:09:16'),
(129, 30, '<p>Abu Jahal</p>', 0, '2026-07-17 10:09:16'),
(130, 30, '<p>Abu Lahab</p>', 0, '2026-07-17 10:09:16'),
(131, 31, '<p>1, 2, 3 dan 4</p>', 0, '2026-07-17 10:09:16'),
(132, 31, '<p>1, 2, 4 dan 5</p>', 1, '2026-07-17 10:09:16'),
(133, 31, '<p>2, 3, 4 dan 5</p>', 0, '2026-07-17 10:09:16'),
(134, 31, '<p>2, 3 dan 4</p>', 0, '2026-07-17 10:09:16'),
(135, 31, '<p>2, 3 dan 5</p>', 0, '2026-07-17 10:09:16'),
(136, 32, '<p>Qalbun salim</p>', 0, '2026-07-17 10:09:16'),
(137, 32, '<p>Qaswah al-Qalb</p>', 1, '2026-07-17 10:09:16'),
(138, 32, '<p>Qalbun mayyitun</p>', 0, '2026-07-17 10:09:16'),
(139, 32, '<p>Nifaq</p>', 0, '2026-07-17 10:09:16'),
(140, 32, '<p>Kufur</p>', 0, '2026-07-17 10:09:16'),
(141, 33, '<p>Rajin dalam mengerjakan kebaikan dan ketaatan</p>', 0, '2026-07-17 10:09:16'),
(142, 33, '<p>Tersentuh hatinya dengan ayat-ayat Al-Quran yang dibacakan</p>', 0, '2026-07-17 10:09:16'),
(143, 33, '<p>Selalu merasa takut akan janji dan ancaman Allah Swt</p>', 0, '2026-07-17 10:09:16'),
(144, 33, '<p>Bertambahnya kecintaan terhadap dunia dan melupakan akhirat</p>', 1, '2026-07-17 10:09:16'),
(145, 33, '<p>Merasa tenang hatinya dan tidak merasa gundah</p>', 0, '2026-07-17 10:09:16'),
(146, 34, '<p>Menghadiri majlis ta\'lim dan majlis nasihat</p>', 1, '2026-07-17 10:09:16'),
(147, 34, '<p>Mendatangi kafe dan hiburan malam</p>', 0, '2026-07-17 10:09:16'),
(148, 34, '<p>Berjemur hingga larut malam</p>', 0, '2026-07-17 10:09:16'),
(149, 34, '<p>Banyak membaca novel</p>', 0, '2026-07-17 10:09:16'),
(150, 34, '<p>Belanja di supermarket</p>', 0, '2026-07-17 10:09:16'),
(151, 35, '<p>Qalbun Salim</p>', 1, '2026-07-17 10:09:16'),
(152, 35, '<p>Mayyit al-qalb</p>', 0, '2026-07-17 10:09:16'),
(153, 35, '<p>Maridh al-qalb</p>', 0, '2026-07-17 10:09:16'),
(154, 35, '<p>Qaswat al-qalb</p>', 0, '2026-07-17 10:09:16'),
(155, 35, '<p>Qalbun mayyitun</p>', 0, '2026-07-17 10:09:16'),
(156, 36, '<p>Anak laki-laki tunggal</p>', 0, '2026-07-17 10:09:16'),
(157, 36, '<p>Anak perempuan tunggal</p>', 1, '2026-07-17 10:09:16'),
(158, 36, '<p>Cucu perempuan tunggal dari anak laki-laki</p>', 0, '2026-07-17 10:09:16'),
(159, 36, '<p>Saudara perempuan tunggal yang sekandung</p>', 0, '2026-07-17 10:09:16'),
(160, 36, '<p>Suami jika istrinya tidak mempunyai anak atau cucu dari anak laki laki</p>', 0, '2026-07-17 10:09:16'),
(161, 37, '<p>Anak laki-laki, suami dan ayah</p>', 0, '2026-07-17 10:09:16'),
(162, 37, '<p>Suami, kakek, dan anak laki-laki</p>', 1, '2026-07-17 10:09:16'),
(163, 37, '<p>Suami, anak laki-laki dan anak perempuan</p>', 0, '2026-07-17 10:09:16'),
(164, 37, '<p>Anak laki-laki, anak perempuan, istri dan ayah</p>', 0, '2026-07-17 10:09:16'),
(165, 37, '<p>Suami anak laki-laki, anak perempuan dan cucu</p>', 0, '2026-07-17 10:09:16'),
(166, 38, '<p>Sepertiga dari harta pusaka</p>', 1, '2026-07-17 10:09:16'),
(167, 38, '<p>Setengahnya dari harta pusaka</p>', 0, '2026-07-17 10:09:16'),
(168, 38, '<p>Seperempatnya dari harta pusaka</p>', 0, '2026-07-17 10:09:16'),
(169, 38, '<p>Seperlimanya dari harta pusaka</p>', 0, '2026-07-17 10:09:16'),
(170, 38, '<p>Seperenamnya dari harta pusaka</p>', 0, '2026-07-17 10:09:16'),
(171, 39, '<p>Seperdua</p>', 0, '2026-07-17 10:09:16'),
(172, 39, '<p>Sepertiga</p>', 0, '2026-07-17 10:09:16'),
(173, 39, '<p>Seperempat</p>', 1, '2026-07-17 10:09:16'),
(174, 39, '<p>Seperlima</p>', 0, '2026-07-17 10:09:16'),
(175, 39, '<p>Seperdelapan</p>', 0, '2026-07-17 10:09:16'),
(176, 40, '<p>Asbabun nuzul</p>', 0, '2026-07-17 10:09:16'),
(177, 40, '<p>Ashabus sunan</p>', 0, '2026-07-17 10:09:16'),
(178, 40, '<p>Ashabul kahfi</p>', 0, '2026-07-17 10:09:16'),
(179, 40, '<p>Asabah</p>', 1, '2026-07-17 10:09:16'),
(180, 40, '<p>Ashabul buruj</p>', 0, '2026-07-17 10:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `val_setquis`
--

CREATE TABLE `val_setquis` (
  `id_setquis` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `topik_id` bigint(20) NOT NULL,
  `groups` varchar(100) NOT NULL,
  `waktu` char(3) NOT NULL,
  `nilai_plus` char(3) NOT NULL,
  `nilai_minus` char(3) NOT NULL,
  `token` tinyint(1) NOT NULL DEFAULT 0,
  `acak_soal` tinyint(1) NOT NULL DEFAULT 0,
  `acak_jawaban` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `val_setquis`
--

INSERT INTO `val_setquis` (`id_setquis`, `nama`, `topik_id`, `groups`, `waktu`, `nilai_plus`, `nilai_minus`, `token`, `acak_soal`, `acak_jawaban`, `created_at`) VALUES
(1, 'Quis Informatika', 1, 'XII Akuntansi, XII TKJ 1, XII TKJ 2, XII TKR 1, XII TKR 2', '10', '5', '-5', 1, 1, 1, '2026-07-17 10:10:06'),
(2, 'Quis Pendidikan Agama Islam', 2, 'XII Akuntansi, XII TKJ 1, XII TKJ 2, XII TKR 1, XII TKR 2', '10', '5', '-5', 1, 1, 1, '2026-07-17 10:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `val_soal`
--

CREATE TABLE `val_soal` (
  `id_soal` bigint(20) NOT NULL,
  `topik_id` bigint(20) NOT NULL,
  `no_soal` char(8) NOT NULL,
  `soal` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `val_soal`
--

INSERT INTO `val_soal` (`id_soal`, `topik_id`, `no_soal`, `soal`, `created_at`) VALUES
(1, 1, 'soal-1', '<p>Algoritma pencarian yang bekerja dengan cara membagi dua data secara berulang hingga ditemukan nilai yang dicari dinamakan...</p>', '2026-07-17 10:07:42'),
(2, 1, 'soal-2', '<p>Pada struktur data Tree, node yang berada di posisi paling atas dan tidak memiliki parent disebut...</p>', '2026-07-17 10:07:42'),
(3, 1, 'soal-3', '<p>Struktur data yang menggunakan prinsip FIFO (First In First Out) dalam antrean data dinamakan...</p>', '2026-07-17 10:07:42'),
(4, 1, 'soal-4', '<p>Kegiatan menganalisis kebutuhan pengguna dan menentukan fitur perangkat lunak dalam SDLC termasuk dalam fase...</p>', '2026-07-17 10:07:42'),
(5, 1, 'soal-5', '<p>Metodologi pengembangan perangkat lunak yang berfokus pada kolaborasi, fleksibilitas, dan iterasi cepat dinamakan...</p>', '2026-07-17 10:07:42'),
(6, 1, 'soal-6', '<p>Perangkat keras jaringan yang berfungsi untuk menghubungkan beberapa jaringan berbeda dan mengarahkan paket data dinamakan...</p>', '2026-07-17 10:07:42'),
(7, 1, 'soal-7', '<p>Protokol yang digunakan untuk mengirimkan pesan email antar server di jaringan internet adalah...</p>', '2026-07-17 10:07:42'),
(8, 1, 'soal-8', '<p>Manakah jenis kabel jaringan yang menggunakan gelombang cahaya untuk mentransmisikan data berkecepatan tinggi?</p>', '2026-07-17 10:07:42'),
(9, 1, 'soal-9', '<p>Jenis ancaman keamanan siber yang mengunci data korban dan meminta tebusan uang untuk membukanya dinamakan...</p>', '2026-07-17 10:07:42'),
(10, 1, 'soal-10', '<p>Langkah pengamanan jaringan nirkabel dengan cara menyembunyikan nama jaringan WiFi dari publik disebut...</p>', '2026-07-17 10:07:42'),
(11, 1, 'soal-11', '<p>Perintah SQL yang digunakan untuk mengambil data dari satu atau beberapa tabel database dinamakan...</p>', '2026-07-17 10:07:42'),
(12, 1, 'soal-12', '<p>Kumpulan data dalam jumlah yang sangat besar, cepat, dan kompleks sehingga tidak mampu dikelola oleh database tradisional disebut..</p>', '2026-07-17 10:07:42'),
(13, 1, 'soal-13', '<p>Istilah untuk proses pembersihan data dari kesalahan atau ketidakkonsistenan sebelum dianalisis dinamakan...</p>', '2026-07-17 10:07:42'),
(14, 1, 'soal-14', '<p>Penggunaan teknologi AI untuk mengenali wajah seseorang pada kamera keamanan merupakan contoh penerapan...</p>', '2026-07-17 10:07:42'),
(15, 1, 'soal-15', '<p>Manakah yang merupakan salah satu bentuk pelanggaran Hak Kekayaan Intelektual (HKI) di bidang informatika?</p>', '2026-07-17 10:07:42'),
(16, 1, 'soal-16', '<p>Dampak positif dari perkembangan e-commerce dalam aspek sosial ekonomi masyarakat adalah...</p>', '2026-07-17 10:07:42'),
(17, 1, 'soal-17', '<p>Jenis lisensi perangkat lunak yang didistribusikan secara gratis namun hanya untuk jangka waktu percobaan tertentu disebut...</p>', '2026-07-17 10:07:42'),
(18, 1, 'soal-18', '<p>Mengapa enkripsi end-to-end sangat penting pada aplikasi pesan instan?</p>', '2026-07-17 10:07:42'),
(19, 1, 'soal-19', '<p>Model layanan cloud computing di mana pengguna menyewa infrastruktur komputasi seperti server fisik dan storage dinamakan...</p>', '2026-07-17 10:07:42'),
(20, 1, 'soal-20', '<p>Algoritma pengurutan data yang bekerja dengan cara membandingkan elemen yang berdekatan lalu menukarnya jika urutannya salah dinamakan...</p>', '2026-07-17 10:07:42'),
(21, 2, 'soal-1', '<p>Pak Sarno adalah seorang pengusaha restoran yang sukses mengembangkan usahanya hingga dia dapat mendirikan restoran di berbagai kota. Saat jalan tol dibangun, usahanya mengalami penurunan omset hingga terlilit hutang jutaan rupiah, akan tetapi Pak Sarno tetap rajin menunaikan sholat lima waktu, membaca Al-Quran sembari berdoa kepada Allah Swt untuk agar dimudahkan dalam melunasi hutang-hutangnya. Dari cerita tersebut Pak Sarno termasuk orang yang...</p>', '2026-07-17 10:09:16'),
(22, 2, 'soal-2', '<p>Pak Fulan dikabari bahwa tetangganya yang dirawat di rumah sakit meninggal dunia, dengan spontan Pak Fulan mengucapkan \"inna lillahi wainna ilaihi roji\'un\". Ungkapan tersebut dalam agama Islam disebut dengan bacaan...</p>', '2026-07-17 10:09:16'),
(23, 2, 'soal-3', '<p>Hubbah adalah seorang anak dari keluarga miskin, bapaknya pedagang buah di pasar yang penghasilannya hanya dapat mencukupi kebutuhan pokok saja. Keluarga Hubbah termasuk kelompok masyarakat yang kekurangan, tetapi ia termasuk orang yang selalu berusaha berdoa dan mengharapkan anugerah Allah Swt karena dia yakin Allah akan mengabulkan doanya.</p>', '2026-07-17 10:09:16'),
(24, 2, 'soal-4', '<p>Pak Rahman selalu membimbing dan mengajak istri dan anak-anaknya mengerjakan sholat jamaah di masjid kampung, walaupun dalam keadaan gerimis mereka tetap rajin sholat berjamaah. Dari narasi tersebut Pak Rahman termasuk...</p>', '2026-07-17 10:09:16'),
(25, 2, 'soal-5', '<p>Perhatikan pernyataan-pernyataan berikut!</p>\r\n\r\n			<p>1) Diyakini dalam hati</p>\r\n\r\n			<p>2) Diucapkan dengan lisan</p>\r\n\r\n			<p>3) Dilaksanakan tanpa paksaan</p>\r\n\r\n			<p>4) Diamalkan dengan anggota tubuh</p>\r\n\r\n			<p>5) Dilakukan saat pagi dan petang</p>\r\n\r\n			<p>Dari pernyataan tersebut yang merupakan definisi iman adalah...</p>', '2026-07-17 10:09:16'),
(26, 2, 'soal-6', '<p>Manusia tidak bersifat ma\'sum, di suatu waktu memungkinkan berbuat khilaf atau dosa. Berdasarkan ajaran Islam, bila kita berbuat khilaf atau dosa, maka segera...</p>', '2026-07-17 10:09:16'),
(27, 2, 'soal-7', '<p>Rudi dan Nanang berboncengan ketika pulang sekolah, di pertigaan tiba-tiba melihat teman dari sekolah lain terjatuh dari sepeda dan sontak Rudi dan Nanang berhenti untuk menolong. Sikap Rudi dan Nanang semacam ini termasuk...</p>', '2026-07-17 10:09:16'),
(28, 2, 'soal-8', '<p>Ardi seorang pelajar SMA yang baru lulus, dia bercita-cita ingin melanjutkan ke perguruan tinggi fakultas teknik Universitas Gadjah Mada Yogyakarta. Dengan semangat belajar yang gigih, disertai rajin sholat dan beribadah Ardi diterima di fakultas tersebut. Selama di fakultas teknik Ardi tetap selalu sholat, baca Al-Quran dan bangun malam untuk melakukan sholat tahajud. Dari teks narasi tersebut dapat diambil pelajaran bahwa...</p>', '2026-07-17 10:09:16'),
(29, 2, 'soal-9', '<p>Pada zaman penjajahan Belanda, Snouck Hurgronje (1857-1936) adalah nama yang tak asing bagi banyak orang Indonesia yang mengenal sejarah peperangan melawan Belanda. Ia Berpura-pura masuk Islam dengan niat jahat menghancurkan Islam di Aceh. Dalam narasi sejarah Indonesia, ia banyak dikonstruksikan sebagai aktor jahat di balik takluknya Aceh oleh pemerintah kolonial dalam perang yang berlangsung dari 1878 hingga 1908. Ia juga dianggap sebagai pembelah sekaligus pelemah Islam Indonesia. Dari cerita tersebut menggambarkan bahwa Snouck Hurgronje adalah seorang yang...</p>', '2026-07-17 10:09:16'),
(30, 2, 'soal-10', '<p>Pada saat bertemu Rasulullah Saw dan kaum muslimin ia berbohong dengan cara menceritakan kejelekan orang orang kafir. Pada saat bertemu orang kafir ia mengaku bagian dari orang kafir dan menjelekkan kaum muslimin dan Rasulullah Saw. Pada saat bertemu kaum muslimin dan Rasulullah Saw, ia mengaku bagian dari kaum muslimin dan siap melawan kaum kafir Quraisy. Tokoh munafik ini bernama...</p>', '2026-07-17 10:09:16'),
(31, 2, 'soal-11', '<p>Perhatikan karakteristik manusia berikut!</p>\r\n\r\n			<p>1) Bersumpah palsu</p>\r\n\r\n			<p>2) Menghalangi jalan Allah</p>\r\n\r\n			<p>3) Menghardik anak yatim</p>\r\n\r\n			<p>4) Tampilan lahir dan batin berbeda</p>\r\n\r\n			<p>5) Manis perkataan tapi buruk hati</p>\r\n\r\n			<p>Dari pernyataan-pernyataan tersebut yang merupakan karakteristik munafiqin adalah...</p>', '2026-07-17 10:09:16'),
(32, 2, 'soal-12', '<p>Pada era digital seperti sekarang ini dan segala sesuatu yang serba canggih terkadang memberikan suatu perubahan yang tidak pasti, baik dari segi moral, nilai kehidupan dan spiritual. Semakin cepat perubahan itu, semakin maju pula masyarakat serta tuntunan hidup yang harus dipenuhi oleh manusia. Oleh karena itu, orang sering tidak mampu untuk mengatasi permasalahan yang dihadapi sehingga menimbulkan rasa stres yang memicu munculnya rasa gelisah dan krisis rohani dan permasalahan spiritual sehingga menimbulkan kerasnya hati manusia. Keras hati dalam bahasa agama sering disebut dengan...</p>', '2026-07-17 10:09:16'),
(33, 2, 'soal-13', '<p>Tanda-tanda berikut merupakan orang-orang yang mulai mengeras hatinya..</p>', '2026-07-17 10:09:16'),
(34, 2, 'soal-14', '<p>Pernyataan berikut merupakan obat yang dapat melunakkan hati yang sedang susah...</p>', '2026-07-17 10:09:16'),
(35, 2, 'soal-15', '<p>Pak Fulan sudah dua tahun menderita sakit gula sehingga sangat hati-hati ketika makan dan minum. Pak Fulan menerima musibah ini dengan hati yang ikhlas, sabar dan selalu berdoa kepada Allah Swt agar penyakitnya segera diangkat dan bisa sehat kembali. Dari cerita tersebut Pak Fulan termasuk orang yang memiliki...</p>', '2026-07-17 10:09:16'),
(36, 2, 'soal-16', '<p>Ahli waris yang mendapatkan bagian seperdua (1/2) dari harta pusaka adalah...</p>', '2026-07-17 10:09:16'),
(37, 2, 'soal-17', '<p>Apabila kelompok ahli waris laki-laki semuanya ada, maka yang berhak mendapat bagian harta pusaka adalah...</p>', '2026-07-17 10:09:16'),
(38, 2, 'soal-18', '<p>Jika berwasiat melebihi dari sepertiga harta pusaka, maka yang wajib dilaksanakan hanya...</p>', '2026-07-17 10:09:16'),
(39, 2, 'soal-19', '<p>Apabila istri meninggal dunia dan mempunyai anak atau cucu dari anak laki-laki, suami mendapat bagian dari harta pusaka istrinya sebanyak...</p>', '2026-07-17 10:09:16'),
(40, 2, 'soal-20', '<p>Ahli waris yang dapat mewarisi seluruh harta pusaka setelah harta pusaka dibagikan kepada semua ahli waris sesuai dengan ketentuan syara\' disebut...</p>', '2026-07-17 10:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `val_token`
--

CREATE TABLE `val_token` (
  `id_token` bigint(20) NOT NULL,
  `nama_token` char(8) NOT NULL,
  `expired_at` datetime NOT NULL,
  `setquis_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `val_token`
--

INSERT INTO `val_token` (`id_token`, `nama_token`, `expired_at`, `setquis_id`, `created_at`) VALUES
(2, 'EUMM3A', '2026-08-18 18:08:41', 2, '2026-07-18 11:33:41'),
(3, 'B6KIQY', '2026-07-19 19:07:02', 1, '2026-07-18 12:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `val_topik`
--

CREATE TABLE `val_topik` (
  `id_topik` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `val_topik`
--

INSERT INTO `val_topik` (`id_topik`, `nama`, `deskripsi`, `created_at`) VALUES
(1, 'Informatika', 'Ini adalah topik quis informatika', '2026-07-17 10:04:41'),
(2, 'Pendidikan agama islam', 'Ini adalah topik pendidikan agama islam', '2026-07-17 10:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `val_users`
--

CREATE TABLE `val_users` (
  `id_user` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `remember_token` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `val_users`
--

INSERT INTO `val_users` (`id_user`, `nama`, `username`, `email`, `password`, `group_id`, `remember_token`, `created_at`) VALUES
(3, 'Abdur Rafi', '2324.01.0001', '', '2324.01.0001', 2, 'b6734860f1f93c22c69e2b5af665a471bb377a5ede91d245e8e3856fca4b87e4', '2026-07-16 14:53:39'),
(4, 'Adelia Maharani', '2324.01.0002', '', '2324.01.0002', 2, 'f0b1ae4491f3b4d5c665b58e770716ed743733deb8806f84888c284e32fed7c4', '2026-07-16 14:55:35'),
(5, 'Afwa Nur Aulia Salsabila', '2324.01.0003', '', '2324.01.0003', 2, '9e21a1e026a6d5ebae6adca8e48a15795b1666e40b1b993f39a14de51b4fa0d3', '2026-07-16 14:58:40'),
(6, 'Ahmad Bagja A.A.K', '2324.01.0004', '', '2324.01.0004', 2, 'c2b02a2720e37989f3387b150b6dfde0b4aea52806f9fe6c1f1623b16de82ae2', '2026-07-16 15:43:14'),
(7, 'Ardianysah', '2324.01.0005', '', '2324.01.0005', 2, '', '2026-07-17 00:22:24'),
(8, 'Destri Dyani SY.', '2324.01.0006', '', '2324.01.0006', 2, '', '2026-07-17 00:22:58'),
(9, 'Dewi Widiantina', '2324.01.0007', '', '2324.01.0007', 2, '', '2026-07-17 00:23:25'),
(10, 'Elawati', '2324.01.0008', '', '2324.01.0008', 2, '', '2026-07-17 00:51:34'),
(11, 'Ibnu Rafi', '2324.01.0009', '', '2324.01.0009', 2, '', '2026-07-17 00:52:05'),
(12, 'Ikbal Alfarizi', '2324.01.0010', '', '2324.01.0010', 2, '', '2026-07-17 00:52:35'),
(13, 'Laura Cinta Bela', '2324.01.0011', '', '2324.01.0011', 2, '', '2026-07-17 00:53:06'),
(14, 'Mela Novianti', '2324.01.0012', '', '2324.01.0012', 2, '', '2026-07-17 00:55:54'),
(15, 'Moch Damar Oktapiandi', '2324.01.0013', '', '2324.01.00113', 2, '', '2026-07-17 00:56:22'),
(16, 'Muhammad Iqbal Mustofa', '2324.01.0014', '', '2324.01.0014', 2, '', '2026-07-17 00:56:51'),
(17, 'Muhammad Fauzan', '2324.01.0015', '', '2324.01.0015', 2, '', '2026-07-17 00:57:22'),
(18, 'Nur Aina Septiasari', '2324.01.0016', '', '2324.01.0016', 2, '', '2026-07-17 00:58:03'),
(19, 'Rafil Aprian', '2324.01.0017', '', '2324.01.0017', 2, '', '2026-07-17 00:58:45'),
(20, 'Rangga Febrian', '2324.01.0018', '', '2324.01.0018', 2, '', '2026-07-17 00:59:02'),
(21, 'Riani Shelavia', '2324.01.0019', '', '2324.01.0019', 2, '', '2026-07-17 00:59:21'),
(22, 'Ripal', '2324.01.0020', '', '2324.01.0020', 2, '', '2026-07-17 00:59:44'),
(23, 'Rosa Amelia', '2324.01.0021', '', '2324.01.0021', 2, '', '2026-07-17 01:00:50'),
(24, 'Satria Adi Sadaya', '2324.01.0022', '', '2324.01.0022', 2, '', '2026-07-17 01:01:07'),
(25, 'Seril Yuliani', '2324.01.0023', '', '2324.01.0023', 2, '', '2026-07-17 01:01:26'),
(26, 'Sevilla Suci Anggraeni', '2324.01.0024', '', '2324.01.0024', 2, '', '2026-07-17 01:01:47'),
(27, 'Suhendar', '2324.01.0025', '', '2324.01.0025', 2, '', '2026-07-17 01:02:03'),
(28, 'Valah Ivan Maulana', '2324.01.0026', '', '2324.01.0026', 2, 'e6493d8cef9413d5527d51f3632f1c746f552ba7ce98ac05c7785823e268a8aa', '2026-07-17 01:02:22'),
(29, 'Yudi Yana', '2324.01.0027', '', '2324.01.0027', 2, '', '2026-07-17 01:02:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `val_admin`
--
ALTER TABLE `val_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `val_group`
--
ALTER TABLE `val_group`
  ADD PRIMARY KEY (`id_group`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `val_hasil`
--
ALTER TABLE `val_hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `fk_group_hasil` (`group_id`),
  ADD KEY `fk_user_hasil` (`user_id`),
  ADD KEY `fk_setquis_hasil` (`setquis_id`);

--
-- Indexes for table `val_jawaban`
--
ALTER TABLE `val_jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `fk_jawaban_soal` (`soal_id`);

--
-- Indexes for table `val_setquis`
--
ALTER TABLE `val_setquis`
  ADD PRIMARY KEY (`id_setquis`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD KEY `fk_topik_setquis` (`topik_id`);

--
-- Indexes for table `val_soal`
--
ALTER TABLE `val_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `fk_topik_soal` (`topik_id`);

--
-- Indexes for table `val_token`
--
ALTER TABLE `val_token`
  ADD PRIMARY KEY (`id_token`),
  ADD KEY `fk_setquis_token` (`setquis_id`);

--
-- Indexes for table `val_topik`
--
ALTER TABLE `val_topik`
  ADD PRIMARY KEY (`id_topik`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `val_users`
--
ALTER TABLE `val_users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_group_user` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `val_admin`
--
ALTER TABLE `val_admin`
  MODIFY `id_admin` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `val_group`
--
ALTER TABLE `val_group`
  MODIFY `id_group` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `val_hasil`
--
ALTER TABLE `val_hasil`
  MODIFY `id_hasil` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `val_jawaban`
--
ALTER TABLE `val_jawaban`
  MODIFY `id_jawaban` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `val_setquis`
--
ALTER TABLE `val_setquis`
  MODIFY `id_setquis` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `val_soal`
--
ALTER TABLE `val_soal`
  MODIFY `id_soal` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `val_token`
--
ALTER TABLE `val_token`
  MODIFY `id_token` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `val_topik`
--
ALTER TABLE `val_topik`
  MODIFY `id_topik` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `val_users`
--
ALTER TABLE `val_users`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `val_hasil`
--
ALTER TABLE `val_hasil`
  ADD CONSTRAINT `fk_group_hasil` FOREIGN KEY (`group_id`) REFERENCES `val_group` (`id_group`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_setquis_hasil` FOREIGN KEY (`setquis_id`) REFERENCES `val_setquis` (`id_setquis`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_hasil` FOREIGN KEY (`user_id`) REFERENCES `val_users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `val_jawaban`
--
ALTER TABLE `val_jawaban`
  ADD CONSTRAINT `fk_jawaban_soal` FOREIGN KEY (`soal_id`) REFERENCES `val_soal` (`id_soal`) ON DELETE CASCADE;

--
-- Constraints for table `val_setquis`
--
ALTER TABLE `val_setquis`
  ADD CONSTRAINT `fk_topik_setquis` FOREIGN KEY (`topik_id`) REFERENCES `val_topik` (`id_topik`);

--
-- Constraints for table `val_soal`
--
ALTER TABLE `val_soal`
  ADD CONSTRAINT `fk_topik_soal` FOREIGN KEY (`topik_id`) REFERENCES `val_topik` (`id_topik`) ON DELETE CASCADE;

--
-- Constraints for table `val_token`
--
ALTER TABLE `val_token`
  ADD CONSTRAINT `fk_setquis_token` FOREIGN KEY (`setquis_id`) REFERENCES `val_setquis` (`id_setquis`) ON DELETE CASCADE;

--
-- Constraints for table `val_users`
--
ALTER TABLE `val_users`
  ADD CONSTRAINT `fk_group_user` FOREIGN KEY (`group_id`) REFERENCES `val_group` (`id_group`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
