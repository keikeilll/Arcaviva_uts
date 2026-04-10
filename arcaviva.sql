-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2026 at 11:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arcaviva`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id_arsip` int(11) NOT NULL,
  `id_proker` int(11) DEFAULT NULL,
  `link_drive` varchar(255) DEFAULT NULL,
  `link_lpj` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id_arsip`, `id_proker`, `link_drive`, `link_lpj`, `catatan`) VALUES
(1, 2, 'https://drive.google.com/drive/seli-desa', 'https://docs.google.com/lpj-desa', 'Acara berjalan sangat lancar dan warga desa sangat antusias. Saran untuk kepengurusan tahun depan: perbanyak kuota buku cerita dan alat tulis yang didonasikan.'),
(2, 3, 'https://drive.google.com/drive/ali-web', 'https://docs.google.com/lpj-web', 'Peserta aktif bertanya. Namun, koneksi internet Wi-Fi kampus sempat down. Saran: pastikan panitia membawa modem cadangan untuk berjaga-jaga.');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `id_dept` int(11) NOT NULL,
  `nama_dept` varchar(100) DEFAULT NULL,
  `tentang_dept` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`id_dept`, `nama_dept`, `tentang_dept`) VALUES
(1, 'PSDM', 'Pengembangan Sumber Daya Mahasiswa. Fokus pada kaderisasi, pelatihan, dan peningkatan kualitas pengurus himpunan.'),
(2, 'Humas', 'Hubungan Masyarakat. Menjembatani komunikasi organisasi dengan pihak eksternal, alumni, dan masyarakat umum.'),
(3, 'Ekokraf', 'Ekonomi Kreatif. Mengatur strategi penggalangan dana, pembuatan merchandise, dan pengembangan jiwa kewirausahaan.'),
(4, 'Medinfo', 'Media dan Informasi. Pusat publikasi, desain grafis, pengelolaan sosial media, dan perawatan sistem informasi (website).'),
(5, 'Adkesma', 'Advokasi dan Kesejahteraan Mahasiswa. Melayani keluh kesah mahasiswa, info beasiswa, dan bantuan UKT.');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `isi_pengumuman` text DEFAULT NULL,
  `terakhir_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `isi_pengumuman`, `terakhir_diubah`) VALUES
(1, '📢 Halo seluruh pengurus Himpunan Arcaviva! Mengingatkan kembali bahwa Rapat Pleno bersama Miss Selena akan diadakan di Aula Utama Klan Bumi hari Jumat ini jam 15.00 WIB.\r\n\r\nBagi para Penanggung Jawab Proker (terutama Seli, Ily, dan Raib), dimohon segera meng-update checklist timeline kalian di sistem agar progress kita terpantau dengan baik.\r\n\r\nJangan sampai telat kumpul ya, atau Batozar yang akan menjemput kalian satu per satu! \r\n\r\nSemangat terus! \r\n- Ttd, Ali (Kadep Medinfo)', '2026-04-10 08:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `proker`
--

CREATE TABLE `proker` (
  `id_proker` int(11) NOT NULL,
  `id_dept` int(11) DEFAULT NULL,
  `nama_proker` varchar(100) DEFAULT NULL,
  `pj_proker` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tgl_pelaksanaan` date DEFAULT NULL,
  `status` enum('Belum Mulai','Sedang Berjalan','Selesai') DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proker`
--

INSERT INTO `proker` (`id_proker`, `id_dept`, `nama_proker`, `pj_proker`, `deskripsi`, `tgl_pelaksanaan`, `status`, `created`) VALUES
(1, 1, 'Latihan Dasar Kepemimpinan', 'N-Ou', 'Acara kaderisasi wajib untuk menyambut anggota baru himpunan. Diisi dengan materi kepemimpinan dan outbond.', '2026-05-15', 'Selesai', '2026-04-10 08:13:23'),
(2, 2, 'Kunjungan Desa Binaan', 'Seli', 'Bakti sosial, mengajar, dan bermain bersama anak-anak di desa binaan pada akhir pekan.', '2026-02-20', 'Selesai', '2026-04-10 08:13:23'),
(3, 4, 'Pelatihan Web & Jurnalistik', 'Ali', 'Workshop pembuatan website dan penulisan artikel berita himpunan untuk pengurus baru.', '2026-01-10', 'Selesai', '2026-04-10 08:13:23'),
(4, 5, 'Posko Advokasi Beasiswa', 'Raib', 'Membuka stand bantuan pendaftaran beasiswa dan konsultasi akademik untuk mahasiswa.', '2026-06-01', 'Sedang Berjalan', '2026-04-10 08:13:23'),
(5, 3, 'Bazaar Kewirausahaan', 'Ily', 'Festival makanan dan kerajinan tangan mahasiswa untuk menambah pemasukan kas himpunan.', '2026-04-30', 'Sedang Berjalan', '2026-04-10 08:13:23'),
(6, 1, 'Upgrading Pengurus', 'Batozar', 'Malam keakraban dan evaluasi setengah periode kepengurusan untuk mempererat bonding antar divisi.', '2026-07-20', 'Belum Mulai', '2026-04-10 08:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `id_timeline` int(11) NOT NULL,
  `id_proker` int(11) DEFAULT NULL,
  `tugas` varchar(255) DEFAULT NULL,
  `is_done` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`id_timeline`, `id_proker`, `tugas`, `is_done`) VALUES
(1, 4, 'Rilis poster pendaftaran beasiswa', 1),
(2, 4, 'Buka pendaftaran relawan posko', 1),
(3, 4, 'Briefing relawan', 0),
(4, 4, 'Pelaksanaan posko di lobi kampus', 0),
(5, 5, 'Sewa tenda dan kursi', 1),
(6, 5, 'Mendata tenant mahasiswa', 1),
(7, 5, 'Promosi acara di Instagram', 1),
(8, 5, 'Hari H Pelaksanaan Bazaar', 0),
(9, 1, 'Rapat pembentukan panitia', 1),
(10, 1, 'Survei lokasi villa', 1),
(11, 1, 'Penyusunan RAB dan Proposal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id_arsip`),
  ADD KEY `id_proker` (`id_proker`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proker`
--
ALTER TABLE `proker`
  ADD PRIMARY KEY (`id_proker`),
  ADD KEY `id_dept` (`id_dept`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id_timeline`),
  ADD KEY `id_proker` (`id_proker`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `id_dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proker`
--
ALTER TABLE `proker`
  MODIFY `id_proker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id_timeline` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `arsip_ibfk_1` FOREIGN KEY (`id_proker`) REFERENCES `proker` (`id_proker`);

--
-- Constraints for table `proker`
--
ALTER TABLE `proker`
  ADD CONSTRAINT `proker_ibfk_1` FOREIGN KEY (`id_dept`) REFERENCES `dept` (`id_dept`);

--
-- Constraints for table `timeline`
--
ALTER TABLE `timeline`
  ADD CONSTRAINT `timeline_ibfk_1` FOREIGN KEY (`id_proker`) REFERENCES `proker` (`id_proker`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
