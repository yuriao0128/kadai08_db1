-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2024 年 9 月 28 日 01:17
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `bc_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `display_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_title` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` int(12) NOT NULL,
  `address` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` int(12) NOT NULL,
  `end_time` int(12) NOT NULL,
  `qualifications` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `background` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employment_type` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `selected_tags` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `display_name`, `company_name`, `job_title`, `salary`, `address`, `start_time`, `end_time`, `qualifications`, `background`, `employment_type`, `job_description`, `image_path`, `selected_tags`) VALUES
(1, 'test_display', 'test1_company', 'test_job', 300000, 'test_adress', 600, 1800, 'test_qualifications', 'test_background', 'test_type', 'test_discription', 'uploads/test2.webp', 'test_tags'),
(2, 'test_display', 'test1_company', 'test_job', 300000, 'test_adress', 600, 1800, 'test_qualifications', 'test_background', 'test_type', 'test_discription', 'uploads/test3.webp', 'test_tags'),
(3, 'test_display', 'test1_company', 'test_job', 300000, 'test_adress', 600, 1800, 'test_qualifications', 'test_background', 'test_type', 'test_discription', 'uploads/test3.webp', 'test_tags'),
(4, 'テスト【フレックスタイム制】コンサルティング営業のアシスタント／未経験大歓迎', '⚫︎⚫︎株式会社', '営業事務', 0, '神奈川県横浜市西区南幸1-1-1', 1, 6, '未経験大歓迎／営業経験あれば尚可', '欠員補充', '正社員', '仕事内容を記載', 'uploads/test.webp', ''),
(5, 'リモートワークOK／時短勤務OK／フレキシブルワークOK', '⚫︎⚫︎株式会社', 'あああ', 300000, '神奈川県横浜市西区南幸1-1-1', 7, 16, '未経験大歓迎／営業経験あれば尚可', '欠員補充', '正社員', 'aaaa', 'uploads/test.webp', '地方創生, 好きを仕事に, 残業なし, 育児なかま就業中');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`,`display_name`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
