-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 01:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb_update_sd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `c_admin` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`c_admin`, `nama`, `username`, `password`) VALUES
('adm1', 'Administrator', 'admin', '$2y$10$dHACjsNQTYk.eyoDj69HF.Hox/68RWQjUEF3TDBzCJqOeze/6nZtO');

-- --------------------------------------------------------

--
-- Table structure for table `data_pendaftaran_siswa`
--

CREATE TABLE `data_pendaftaran_siswa` (
  `id` int(11) NOT NULL,
  `pendaftaran_kelas` varchar(250) DEFAULT NULL,
  `nama_calon_siswa` varchar(50) DEFAULT NULL,
  `panggilan_calon_siswa` varchar(50) DEFAULT NULL,
  `nisn` varchar(50) DEFAULT NULL,
  `asal_sekolah` varchar(250) DEFAULT NULL,
  `jenis_kelamin` char(50) DEFAULT NULL,
  `tempat_lahir` varchar(250) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `dari_berapa_saudara` int(11) DEFAULT NULL,
  `kk_atau_adik_di_aiis` varchar(50) DEFAULT NULL,
  `tingkat_kelas_kk_atau_adik` varchar(50) DEFAULT NULL,
  `nama_kk_atau_adik` varchar(250) DEFAULT NULL,
  `riwayat_penyakit` varchar(250) DEFAULT NULL,
  `bacaan_tahsin` varchar(250) DEFAULT NULL,
  `jumlah_juz_dihafal` varchar(50) DEFAULT NULL,
  `juz_dihafal` varchar(50) DEFAULT NULL,
  `hafalan_surat` varchar(250) DEFAULT NULL,
  `dapat_berjalan_pada_usia` varchar(250) DEFAULT NULL,
  `dapat_berbicara_bermakna_pada_usia` varchar(250) DEFAULT NULL,
  `pernah_menjalani_terapi` varchar(250) DEFAULT NULL,
  `jenis_terapi` varchar(250) DEFAULT NULL,
  `alasan_menjalani_terapi` varchar(250) DEFAULT NULL,
  `durasi_terapi` varchar(250) DEFAULT NULL,
  `waktu_mulai_dan_waktu_selesai_terapi` varchar(250) DEFAULT NULL,
  `saat_ini_masih_menjalani_terapi` varchar(250) DEFAULT NULL,
  `keterlambatan_perkembangan` varchar(250) DEFAULT NULL,
  `terbiasa_solat_lima_waktu` varchar(250) DEFAULT NULL,
  `orangtua_sudah_lancar_dalam_tahsin` varchar(250) DEFAULT NULL,
  `hafalan_tahfidz_orangtua` varchar(250) DEFAULT NULL,
  `peran_orangtua_membantu_anak_menghafal` varchar(250) DEFAULT NULL,
  `anak_terbiasa_menonton_tv_atau_gadget` varchar(250) DEFAULT NULL,
  `berapa_lama_menonton_tv_atau_gadget_dalam_sehari` varchar(250) DEFAULT NULL,
  `nama_ayah` varchar(250) DEFAULT NULL,
  `tempat_lahir_ayah` varchar(250) DEFAULT NULL,
  `tanggal_lahir_ayah` date DEFAULT NULL,
  `agama_ayah` varchar(250) DEFAULT NULL,
  `pendidikan_terakhir_ayah` varchar(250) DEFAULT NULL,
  `pekerjaan_ayah` varchar(250) DEFAULT NULL,
  `domisili_ayah_saat_ini` varchar(250) DEFAULT NULL,
  `nomor_hp_ayah` varchar(250) DEFAULT NULL,
  `nama_ibu` varchar(250) DEFAULT NULL,
  `tempat_lahir_ibu` varchar(250) DEFAULT NULL,
  `tanggal_lahir_ibu` date DEFAULT NULL,
  `agama_ibu` varchar(50) DEFAULT NULL,
  `pendidikan_terakhir_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `domisili_ibu_saat_ini` varchar(250) DEFAULT NULL,
  `nomor_hp_ibu` varchar(50) DEFAULT NULL,
  `pendapatan_orangtua` varchar(250) DEFAULT NULL,
  `rencana_mutasi` varchar(250) DEFAULT NULL,
  `file_pdf_akte` varchar(250) DEFAULT NULL,
  `file_pdf_kk` varchar(250) DEFAULT NULL,
  `ktp_ayah` varchar(250) DEFAULT NULL,
  `ktp_ibu` varchar(250) DEFAULT NULL,
  `sertif_tahsin` varchar(250) DEFAULT NULL,
  `sertif_tahfidz` varchar(250) DEFAULT NULL,
  `nominal_infaq` int(20) DEFAULT NULL,
  `nominal_terbilang` varchar(250) DEFAULT NULL,
  `tanggal_formulir_dibuat` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_pendaftaran_siswa_diterima`
--

CREATE TABLE `data_pendaftaran_siswa_diterima` (
  `id` int(11) NOT NULL,
  `pendaftaran_kelas` varchar(250) DEFAULT NULL,
  `nama_calon_siswa` varchar(50) DEFAULT NULL,
  `panggilan_calon_siswa` varchar(50) DEFAULT NULL,
  `nisn` varchar(50) DEFAULT NULL,
  `asal_sekolah` varchar(250) DEFAULT NULL,
  `jenis_kelamin` char(50) DEFAULT NULL,
  `tempat_lahir` varchar(250) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `dari_berapa_saudara` int(11) DEFAULT NULL,
  `kk_atau_adik_di_aiis` varchar(50) DEFAULT NULL,
  `tingkat_kelas_kk_atau_adik` varchar(50) DEFAULT NULL,
  `nama_kk_atau_adik` varchar(250) DEFAULT NULL,
  `riwayat_penyakit` varchar(250) DEFAULT NULL,
  `bacaan_tahsin` varchar(250) DEFAULT NULL,
  `jumlah_juz_dihafal` varchar(50) DEFAULT NULL,
  `juz_dihafal` varchar(50) DEFAULT NULL,
  `hafalan_surat` varchar(250) DEFAULT NULL,
  `dapat_berjalan_pada_usia` varchar(250) DEFAULT NULL,
  `dapat_berbicara_bermakna_pada_usia` varchar(250) DEFAULT NULL,
  `pernah_menjalani_terapi` varchar(250) DEFAULT NULL,
  `jenis_terapi` varchar(250) DEFAULT NULL,
  `alasan_menjalani_terapi` varchar(250) DEFAULT NULL,
  `durasi_terapi` varchar(250) DEFAULT NULL,
  `waktu_mulai_dan_waktu_selesai_terapi` varchar(250) DEFAULT NULL,
  `saat_ini_masih_menjalani_terapi` varchar(250) DEFAULT NULL,
  `keterlambatan_perkembangan` varchar(250) DEFAULT NULL,
  `terbiasa_solat_lima_waktu` varchar(250) DEFAULT NULL,
  `orangtua_sudah_lancar_dalam_tahsin` varchar(250) DEFAULT NULL,
  `hafalan_tahfidz_orangtua` varchar(250) DEFAULT NULL,
  `peran_orangtua_membantu_anak_menghafal` varchar(250) DEFAULT NULL,
  `anak_terbiasa_menonton_tv_atau_gadget` varchar(250) DEFAULT NULL,
  `berapa_lama_menonton_tv_atau_gadget_dalam_sehari` varchar(250) DEFAULT NULL,
  `nama_ayah` varchar(250) DEFAULT NULL,
  `tempat_lahir_ayah` varchar(250) DEFAULT NULL,
  `tanggal_lahir_ayah` date DEFAULT NULL,
  `agama_ayah` varchar(250) DEFAULT NULL,
  `pendidikan_terakhir_ayah` varchar(250) DEFAULT NULL,
  `pekerjaan_ayah` varchar(250) DEFAULT NULL,
  `domisili_ayah_saat_ini` varchar(250) DEFAULT NULL,
  `nomor_hp_ayah` varchar(250) DEFAULT NULL,
  `nama_ibu` varchar(250) DEFAULT NULL,
  `tempat_lahir_ibu` varchar(250) DEFAULT NULL,
  `tanggal_lahir_ibu` date DEFAULT NULL,
  `agama_ibu` varchar(50) DEFAULT NULL,
  `pendidikan_terakhir_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `domisili_ibu_saat_ini` varchar(250) DEFAULT NULL,
  `nomor_hp_ibu` varchar(50) DEFAULT NULL,
  `pendapatan_orangtua` varchar(250) DEFAULT NULL,
  `rencana_mutasi` varchar(250) DEFAULT NULL,
  `file_pdf_akte` varchar(250) DEFAULT NULL,
  `file_pdf_kk` varchar(250) DEFAULT NULL,
  `ktp_ayah` varchar(250) DEFAULT NULL,
  `ktp_ibu` varchar(250) DEFAULT NULL,
  `sertif_tahsin` varchar(250) DEFAULT NULL,
  `sertif_tahfidz` varchar(250) DEFAULT NULL,
  `nominal_infaq` int(20) DEFAULT NULL,
  `nominal_terbilang` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_ppdb`
--

CREATE TABLE `password_ppdb` (
  `id` int(11) NOT NULL,
  `is_password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_ppdb`
--

INSERT INTO `password_ppdb` (`id`, `is_password`) VALUES
(1, '$2y$10$luiki.q9t6nFB/VFsQn0TutGcqLrOB2gYEWj6jCUHEQ7R91ZPryX2');

-- --------------------------------------------------------

--
-- Table structure for table `status_data_pendaftaran_siswa`
--

CREATE TABLE `status_data_pendaftaran_siswa` (
  `id` int(11) NOT NULL,
  `pendaftaran_kelas` varchar(250) DEFAULT NULL,
  `nama_calon_siswa` varchar(50) DEFAULT NULL,
  `panggilan_calon_siswa` varchar(50) DEFAULT NULL,
  `nisn` varchar(50) DEFAULT NULL,
  `asal_sekolah` varchar(250) DEFAULT NULL,
  `jenis_kelamin` char(50) DEFAULT NULL,
  `tempat_lahir` varchar(250) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `dari_berapa_saudara` int(11) DEFAULT NULL,
  `kk_atau_adik_di_aiis` varchar(50) DEFAULT NULL,
  `tingkat_kelas_kk_atau_adik` varchar(50) DEFAULT NULL,
  `nama_kk_atau_adik` varchar(250) DEFAULT NULL,
  `riwayat_penyakit` varchar(250) DEFAULT NULL,
  `bacaan_tahsin` varchar(250) DEFAULT NULL,
  `jumlah_juz_dihafal` varchar(50) DEFAULT NULL,
  `juz_dihafal` varchar(50) DEFAULT NULL,
  `hafalan_surat` varchar(250) DEFAULT NULL,
  `dapat_berjalan_pada_usia` varchar(250) DEFAULT NULL,
  `dapat_berbicara_bermakna_pada_usia` varchar(250) DEFAULT NULL,
  `pernah_menjalani_terapi` varchar(250) DEFAULT NULL,
  `jenis_terapi` varchar(250) DEFAULT NULL,
  `alasan_menjalani_terapi` varchar(250) DEFAULT NULL,
  `durasi_terapi` varchar(250) DEFAULT NULL,
  `waktu_mulai_dan_waktu_selesai_terapi` varchar(250) DEFAULT NULL,
  `saat_ini_masih_menjalani_terapi` varchar(250) DEFAULT NULL,
  `keterlambatan_perkembangan` varchar(250) DEFAULT NULL,
  `terbiasa_solat_lima_waktu` varchar(250) DEFAULT NULL,
  `orangtua_sudah_lancar_dalam_tahsin` varchar(250) DEFAULT NULL,
  `hafalan_tahfidz_orangtua` varchar(250) DEFAULT NULL,
  `peran_orangtua_membantu_anak_menghafal` varchar(250) DEFAULT NULL,
  `anak_terbiasa_menonton_tv_atau_gadget` varchar(250) DEFAULT NULL,
  `berapa_lama_menonton_tv_atau_gadget_dalam_sehari` varchar(250) DEFAULT NULL,
  `nama_ayah` varchar(250) DEFAULT NULL,
  `tempat_lahir_ayah` varchar(250) DEFAULT NULL,
  `tanggal_lahir_ayah` date DEFAULT NULL,
  `agama_ayah` varchar(250) DEFAULT NULL,
  `pendidikan_terakhir_ayah` varchar(250) DEFAULT NULL,
  `pekerjaan_ayah` varchar(250) DEFAULT NULL,
  `domisili_ayah_saat_ini` varchar(250) DEFAULT NULL,
  `nomor_hp_ayah` varchar(250) DEFAULT NULL,
  `nama_ibu` varchar(250) DEFAULT NULL,
  `tempat_lahir_ibu` varchar(250) DEFAULT NULL,
  `tanggal_lahir_ibu` date DEFAULT NULL,
  `agama_ibu` varchar(50) DEFAULT NULL,
  `pendidikan_terakhir_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `domisili_ibu_saat_ini` varchar(250) DEFAULT NULL,
  `nomor_hp_ibu` varchar(50) DEFAULT NULL,
  `pendapatan_orangtua` varchar(250) DEFAULT NULL,
  `rencana_mutasi` varchar(250) DEFAULT NULL,
  `file_pdf_akte` varchar(250) DEFAULT NULL,
  `file_pdf_kk` varchar(250) DEFAULT NULL,
  `ktp_ayah` varchar(250) DEFAULT NULL,
  `ktp_ibu` varchar(250) DEFAULT NULL,
  `sertif_tahsin` varchar(250) DEFAULT NULL,
  `sertif_tahfidz` varchar(250) DEFAULT NULL,
  `nominal_infaq` int(20) DEFAULT NULL,
  `nominal_terbilang` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `tanggal_formulir_dibuat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_data_pendaftaran_siswa`
--

INSERT INTO `status_data_pendaftaran_siswa` (`id`, `pendaftaran_kelas`, `nama_calon_siswa`, `panggilan_calon_siswa`, `nisn`, `asal_sekolah`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `anak_ke`, `dari_berapa_saudara`, `kk_atau_adik_di_aiis`, `tingkat_kelas_kk_atau_adik`, `nama_kk_atau_adik`, `riwayat_penyakit`, `bacaan_tahsin`, `jumlah_juz_dihafal`, `juz_dihafal`, `hafalan_surat`, `dapat_berjalan_pada_usia`, `dapat_berbicara_bermakna_pada_usia`, `pernah_menjalani_terapi`, `jenis_terapi`, `alasan_menjalani_terapi`, `durasi_terapi`, `waktu_mulai_dan_waktu_selesai_terapi`, `saat_ini_masih_menjalani_terapi`, `keterlambatan_perkembangan`, `terbiasa_solat_lima_waktu`, `orangtua_sudah_lancar_dalam_tahsin`, `hafalan_tahfidz_orangtua`, `peran_orangtua_membantu_anak_menghafal`, `anak_terbiasa_menonton_tv_atau_gadget`, `berapa_lama_menonton_tv_atau_gadget_dalam_sehari`, `nama_ayah`, `tempat_lahir_ayah`, `tanggal_lahir_ayah`, `agama_ayah`, `pendidikan_terakhir_ayah`, `pekerjaan_ayah`, `domisili_ayah_saat_ini`, `nomor_hp_ayah`, `nama_ibu`, `tempat_lahir_ibu`, `tanggal_lahir_ibu`, `agama_ibu`, `pendidikan_terakhir_ibu`, `pekerjaan_ibu`, `domisili_ibu_saat_ini`, `nomor_hp_ibu`, `pendapatan_orangtua`, `rencana_mutasi`, `file_pdf_akte`, `file_pdf_kk`, `ktp_ayah`, `ktp_ibu`, `sertif_tahsin`, `sertif_tahfidz`, `nominal_infaq`, `nominal_terbilang`, `status`, `tanggal_formulir_dibuat`) VALUES
(43, '1SD', 'JNSD', 'JSSADASN', '3123123123', 'TK ASAL', 'LAKI-LAKI', 'ASKDMASDM,A,SD', '2024-11-05', 1, 2, 'ADA', '4SD', 'JDNASD;ASDA', 'Flue', 'BAIK', '1', '30', 'An-Naba', '11 buan', 'hashdnaskd', 'PERNAH', 'ADADASDAS', 'djasdjasd', 'idhausdjasd', 'asjdasdasidnas', 'IYA MASIH', 'asdhasudjasdiasda', 'SUDAH TERBIASA', 'CUKUP', 'SUDAH', 'jndhasjdsdad\'asda', 'IYA', '31jda', 'AJDADKASD;ASDASDASD\'', 'KASJDAKSDASDA', '2024-11-20', 'ISLAM', 'D2', 'POLRI', 'asdjasidoasda', '837129312', 'AJDASJDKAS', 'JASDASDJASD', '2024-11-25', 'ISLAM', 'S1', 'IRT', 'asdjasdasd\'asdasda', '923012012', '6 - 10 JUTA RUPIAH', '32YUGNDAS', 'http://192.168.0.163/ppdb_update_sd/upload/akte_kelahiran/70ea2a58aa_pemrograman1_10(1).pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/kartu_keluarga/0aa65de75d_pemrograman1_09.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/ktp_ayah/b965268021_Nadia Lutfi Sukmaningsih (202443501840) Kalkulus pertemuan ke-11.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/ktp_ibu/a4c47be6f5_IlhamRizkiPratama_202443501907_KalkulusPertemuan7.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/sertif_tahsin/720aa4a82d_Nabila Syalsabila_202443501856_Tugas algo&amp;pemograman.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/sertif_tahfidz/ef9f261d95_Door Sign Akhyar ok-1.pdf ', 0, '', 0, '2024-11-15'),
(44, '1SD', 'JNSDXXXX', 'JSSADASNXXX', '3123123123', 'TK ASAL', 'LAKI-LAKI', 'ASKDMASDM,A,SD', '2024-11-05', 1, 2, 'ADA', '4SD', 'JDNASD;ASDA', 'Flue', 'BAIK', '1', '30', 'An-Naba', '11 buan', 'hashdnaskd', 'PERNAH', 'ADADASDAS', 'djasdjasd', 'idhausdjasd', 'asjdasdasidnas', 'IYA MASIH', 'asdhasudjasdiasda', 'SUDAH TERBIASA', 'CUKUP', 'SUDAH', 'jndhasjdsdad\'asda', 'IYA', '31jda', 'AJDADKASD;ASDASDASD\'', 'KASJDAKSDASDA', '2024-11-20', 'ISLAM', 'D2', 'POLRI', 'asdjasidoasda', '837129312', 'AJDASJDKAS', 'JASDASDJASD', '2024-11-25', 'ISLAM', 'S1', 'IRT', 'asdjasdasd\'asdasda', '923012012', '6 - 10 JUTA RUPIAH', '32YUGNDAS', 'http://192.168.0.163/ppdb_update_sd/upload/akte_kelahiran/70ea2a58aa_pemrograman1_10(1).pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/kartu_keluarga/0aa65de75d_pemrograman1_09.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/ktp_ayah/b965268021_Nadia Lutfi Sukmaningsih (202443501840) Kalkulus pertemuan ke-11.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/ktp_ibu/a4c47be6f5_IlhamRizkiPratama_202443501907_KalkulusPertemuan7.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/sertif_tahsin/720aa4a82d_Nabila Syalsabila_202443501856_Tugas algo&amp;pemograman.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/sertif_tahfidz/ef9f261d95_Door Sign Akhyar ok-1.pdf ', 0, '', 0, '2024-11-15'),
(45, '1SD', 'TE\'S DATA DUMMY PA\'UD', 'PA\'UD', 'BELUM ADA NISN', '-', 'LAKI-LAKI', 'JAKARTA', '2019-11-05', 3, 3, 'ADA', '2SD', 'TE\'S DA\'TA DUM\'MY', 'Batuk &amp; flue', 'CUKUP', '1', '30', 'An-Naba', '2,5 tahun', '3 tahun', 'PERNAH', 'TERAPI BICARA', 'Agar Anak Lancar bicara', 'kurang lebih selama 4 bulan', 'waktu mulai awal bulan januari - akhir april', 'SUDAH TIDAK', 'tidak ada', 'SUDAH TERBIASA', 'CUKUP', 'SUDAH', 'dengan menyetel murottal setiap hari', 'IYA', '5 menit setiap selesai murottal', 'PAREN\'T1', 'BANDUNG', '1994-10-31', 'ISLAM', 'S1', 'KARYAWAN SWASTA', 'sdasnd\'ad\'as', '837983792', 'PAREN\'T2', 'SURABAYA', '1998-08-31', 'ISLAM', 'S1', 'KARYAWAN SWASTA', 'dsdasda\'da\'d', '837727836', '1 - 5 JUTA RUPIAH', 'TIDAK ADA RENCANA UNTUK MUTASI', 'http://192.168.0.163/ppdb_update_sd/upload/akte_kelahiran/ab9600c103_Cam\'Scanner 08-11-2024 23.13-1.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/kartu_keluarga/f7bdf34bc4_Cam\'Scanner 08-11-2024 23.13-1.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/ktp_ayah/63cc877d25_Cam\'Scanner 08-11-2024 23.13-1.pdf ', 'http://192.168.0.163/ppdb_update_sd/upload/ktp_ibu/cad786054f_Cam\'Scanner 08-11-2024 23.13-1.pdf ', '- ', '- ', 1250000, 'SATU JUTA DUA RATUS RIBU RUPIAH', 1, '2024-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(11) NOT NULL,
  `thn_ajaran` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `thn_ajaran`, `status`) VALUES
(1, '2024 - 2025', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran_adm`
--

CREATE TABLE `tahun_ajaran_adm` (
  `id_tahun_ajaran` int(11) NOT NULL,
  `c_role` varchar(50) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_ajaran_adm`
--

INSERT INTO `tahun_ajaran_adm` (`id_tahun_ajaran`, `c_role`, `tahun`, `semester`, `status`) VALUES
(1, 'adm1', '2024/2025', '1', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`c_admin`);

--
-- Indexes for table `data_pendaftaran_siswa`
--
ALTER TABLE `data_pendaftaran_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pendaftaran_siswa_diterima`
--
ALTER TABLE `data_pendaftaran_siswa_diterima`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_ppdb`
--
ALTER TABLE `password_ppdb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_data_pendaftaran_siswa`
--
ALTER TABLE `status_data_pendaftaran_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun_ajaran_adm`
--
ALTER TABLE `tahun_ajaran_adm`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pendaftaran_siswa`
--
ALTER TABLE `data_pendaftaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_pendaftaran_siswa_diterima`
--
ALTER TABLE `data_pendaftaran_siswa_diterima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_ppdb`
--
ALTER TABLE `password_ppdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status_data_pendaftaran_siswa`
--
ALTER TABLE `status_data_pendaftaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tahun_ajaran_adm`
--
ALTER TABLE `tahun_ajaran_adm`
  MODIFY `id_tahun_ajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
