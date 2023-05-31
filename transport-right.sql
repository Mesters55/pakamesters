-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 01:12 PM
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
-- Database: `transport-right`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `position_id` int(10) UNSIGNED NOT NULL,
  `image` text DEFAULT NULL,
  `show_on_first_page` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `surname`, `email`, `position_id`, `image`, `show_on_first_page`) VALUES
(36, 'Artūrs', 'Dreiliņš', 'arturs.dreilins@logistic.lv', 5, 'istockphoto-973685860-612x612.jpg', 1),
(37, 'Dmitrijs', 'Aleksejevs', 'dmitrijs.aleksejevs@logistic.lv', 5, 'istockphoto-1072480804-612x612.jpg', 1),
(38, 'Krisš', 'Osis', 'osis.kriss@logistic.lv', 5, 'istockphoto-668592852-612x612.jpg', 1),
(39, 'Santa', 'Kupruka', 'santa.santa@logistic.lv', 5, 'istockphoto-465479132-612x612.jpg', 1),
(40, 'Vita', 'Karlsone', 'karlsone.vite@logistic.lv', 5, 'istockphoto-1089633230-612x612.jpg', 1),
(41, 'Aldis', 'Liepa', 'darbinieks@logistic.lv', 8, '', 0),
(42, 'Janis', 'Lapsa', 'darbinieks@logistic.lv', 8, '', 0),
(43, 'Oļegs', 'Baruļins', 'barulins.olegs@logistic.lv', 5, 'istockphoto-471689597-612x612.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(5, 'Direktors'),
(6, 'Loģistikas departamenta vadītāja'),
(7, 'Transporta menedžeris'),
(8, 'Šoferis'),
(9, 'Loģistikas departamenta vadītājs');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `title`, `text`, `image`) VALUES
(1, 'Jānis Bērziņš', 'Palīdzēja man, kā uzņēmumam izdomāt viss ātrāko un efektīvāko veidu kā nogādātu savu sūtījumu līdz galamērķim. Noteikti iesaku!', 'istockphoto-1159741374-612x612.jpg'),
(2, 'Jānis Slota', 'Noteikti iesaku, viss super!', 'istockphoto-864313346-612x612.jpg'),
(3, 'Jānis Puplaks', 'Ļoti atsaucīga personāla daļa, neskaidrības vai problēmu gadījumā nav ilgi jāgaida!!!', 'istockphoto-1289239044-612x612.jpg'),
(4, 'Jānis Fedukovičs', 'Jau 5 gadus sadarbojamies kopā, lieliska komanda.', 'istockphoto-995745012-612x612.jpg'),
(5, 'Jānis Straume', 'Nevienu sliktu vārdu, nevienu.', 'istockphoto-1299828148-612x612.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `image`) VALUES
(1, 'Noliktavas zonas', 'Noliktavas zonas sākas ar iekraušanas un izkraušanas zonām. Noliktavu pakalpojumi ietver arī šķirošanas zonu, kurā tiek nodalīts, kuras preces tiks pārvestas uz glabāšanas zonu, kuras – uz marķēšanas zonu, un kuras būs paredzētas kravu konsolidācijai vai tieši otrādi – sadalīšanai citiem kravu pārvadājumiem. Noliktavās ir arī saimniecības un administratīvās telpas, kurās notiek koordinēšana un noliktavas drošības uzturēšana.', '360_F_181658575_6gz3Gx96iRndmBtXv2llVsGOGsfdT1AP.jpg'),
(2, 'Kravas marķēšana', 'Mēs labi zinām, ka atbildīga kravas marķēšana ietekmē transportēšanas efektivitāti. Mēs esam priecīgi pārņemt šo akurāto uzdevumu, ļaujot jums tā vietā parūpēties par sava biznesa attīstību. Laikā, kad jūs attīstāt savu biznesu, mēs pārliecināsimies, ka visa jūsu krava ir pareizi marķēta, lai nebūtu nekādu šaubu par to, kā transportēšanas laikā apieties ar konkrēto kravu. Mēs cenšamies panākt maksimālu efektivitāti un darām visu, lai katra prece droši sasniegtu savu galamērķi.', 'depositphotos_470367558-stock-photo-top-view-photo-white-keyboard.jpg'),
(3, 'Starptautiskie pārvadājumi', 'Mūsu starptautisko kravu pārvadājumu pakalpojumu klāstā ietilpst viss, kas nepieciešams, lai Jūsu kravu efektīvi un uzticami nogādātu no punkta A līdz punktam B neatkarīgi no kravas lieluma un galamērķa.', 'about-us.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(5, 'admin', '$2y$10$SjSGgkMF/vsJgAyVZX0RBemQT1j3geP8xCI88ErrYjqZqKGqIBPNa'),
(6, 'admin', '$2y$10$kAymTsWtUiusxshS2YkPJOqD6tqL9j5kVzkShmU6GvNvp4otrT/.O'),
(7, 'niks', '$2y$10$xCg0vIpMJNXchf/JxAutEOxBBeg5NHD4Ygg2yI/M/YZyuT87nzklq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
