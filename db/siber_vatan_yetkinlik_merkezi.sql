-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 10 Eki 2023, 14:05:51
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `siber_vatan_yetkinlik_merkezi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `class_teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `classes_students`
--

CREATE TABLE `classes_students` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_score` tinyint(4) NOT NULL,
  `exam_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `teacher_user_id` int(11) DEFAULT NULL,
  `lesson_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_key2` (`class_teacher_id`);

--
-- Tablo için indeksler `classes_students`
--
ALTER TABLE `classes_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class` (`class_id`),
  ADD KEY `student` (`student_id`);

--
-- Tablo için indeksler `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_key` (`class_id`),
  ADD KEY `lesson_key` (`lesson_id`),
  ADD KEY `student_key` (`student_id`);

--
-- Tablo için indeksler `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_key` (`teacher_user_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `classes_students`
--
ALTER TABLE `classes_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `teacher_key2` FOREIGN KEY (`class_teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `classes_students`
--
ALTER TABLE `classes_students`
  ADD CONSTRAINT `class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `student` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `class_key` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `lesson_key` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`),
  ADD CONSTRAINT `student_key` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `teacher_key` FOREIGN KEY (`teacher_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
