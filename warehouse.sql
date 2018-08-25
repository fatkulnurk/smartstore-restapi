-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2018 pada 08.22
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `material_id` varchar(255) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `operator`
--

CREATE TABLE `operator` (
  `id` int(11) NOT NULL,
  `op_nb` varchar(255) NOT NULL,
  `work_center` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `spare_part_issue_list`
--

CREATE TABLE `spare_part_issue_list` (
  `id` int(11) NOT NULL,
  `working_order` int(11) NOT NULL,
  `operator` int(11) NOT NULL,
  `material` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `storage_location` int(11) NOT NULL,
  `storage_bin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `storage_bin`
--

CREATE TABLE `storage_bin` (
  `id` int(11) NOT NULL,
  `code_company` varchar(255) NOT NULL,
  `code_rack` varchar(255) NOT NULL,
  `code_box` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `storage_location`
--

CREATE TABLE `storage_location` (
  `id` int(11) NOT NULL,
  `location_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `storekeeper`
--

CREATE TABLE `storekeeper` (
  `id_user` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `working_order`
--

CREATE TABLE `working_order` (
  `id` int(11) NOT NULL,
  `working_order_nb` varchar(255) NOT NULL,
  `pm_activity_type` varchar(255) NOT NULL,
  `maintenance_plan_number` varchar(255) NOT NULL,
  `maintenance_task_list_number` varchar(255) NOT NULL,
  `notification_number` varchar(255) NOT NULL,
  `reserved_nb` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `creation_on` date NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `changed_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `work_center`
--

CREATE TABLE `work_center` (
  `id` int(11) NOT NULL,
  `id_work_center` varchar(255) NOT NULL,
  `nama_work_center` varchar(255) NOT NULL,
  `num_of_people` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `material_id` (`material_id`);

--
-- Indeks untuk tabel `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `op_nb` (`op_nb`),
  ADD KEY `work_center` (`work_center`);

--
-- Indeks untuk tabel `spare_part_issue_list`
--
ALTER TABLE `spare_part_issue_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `working_order` (`working_order`,`operator`,`material`),
  ADD KEY `storage_location` (`storage_location`),
  ADD KEY `operator` (`operator`),
  ADD KEY `working_order_2` (`working_order`),
  ADD KEY `operator_2` (`operator`),
  ADD KEY `material` (`material`),
  ADD KEY `storage_bin` (`storage_bin`);

--
-- Indeks untuk tabel `storage_bin`
--
ALTER TABLE `storage_bin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_company` (`code_company`,`code_rack`,`code_box`);

--
-- Indeks untuk tabel `storage_location`
--
ALTER TABLE `storage_location`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `location_id` (`location_id`);

--
-- Indeks untuk tabel `storekeeper`
--
ALTER TABLE `storekeeper`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `working_order`
--
ALTER TABLE `working_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `work_center`
--
ALTER TABLE `work_center`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `spare_part_issue_list`
--
ALTER TABLE `spare_part_issue_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `storage_bin`
--
ALTER TABLE `storage_bin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `storage_location`
--
ALTER TABLE `storage_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `storekeeper`
--
ALTER TABLE `storekeeper`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `working_order`
--
ALTER TABLE `working_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `work_center`
--
ALTER TABLE `work_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `operator`
--
ALTER TABLE `operator`
  ADD CONSTRAINT `operator_ibfk_1` FOREIGN KEY (`work_center`) REFERENCES `work_center` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `spare_part_issue_list`
--
ALTER TABLE `spare_part_issue_list`
  ADD CONSTRAINT `spare_part_issue_list_ibfk_1` FOREIGN KEY (`storage_location`) REFERENCES `storage_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spare_part_issue_list_ibfk_2` FOREIGN KEY (`working_order`) REFERENCES `working_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spare_part_issue_list_ibfk_3` FOREIGN KEY (`operator`) REFERENCES `operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spare_part_issue_list_ibfk_4` FOREIGN KEY (`material`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spare_part_issue_list_ibfk_5` FOREIGN KEY (`storage_bin`) REFERENCES `storage_bin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
