-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-02-28 08:10:57
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `portfolio`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `horenso_infos`
--

CREATE TABLE `horenso_infos` (
  `code` tinyint(3) NOT NULL,
  `member_code` tinyint(3) NOT NULL,
  `target_member_code` tinyint(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `title` varchar(1000) DEFAULT NULL COMMENT '件名',
  `purpose` varchar(1000) DEFAULT NULL COMMENT '目的',
  `detail` varchar(1000) DEFAULT NULL COMMENT '詳細',
  `cause` varchar(1000) DEFAULT NULL COMMENT '原因',
  `other` varchar(1000) DEFAULT NULL COMMENT 'その他',
  `rsvp` varchar(2) DEFAULT NULL COMMENT '要返信'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `horenso_infos`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `members`
--

CREATE TABLE `members` (
  `code` tinyint(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `year` tinyint(2) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `members`
--

INSERT INTO `members` (`code`, `name`, `year`, `pass`, `mail`) VALUES
(1, '質問次郎', 2, '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'sample@gmail.com'),
(3, '使用例', 6, '39a5e04aaff7455d9850c605364f514c11324ce64016960d23d5dc57d3ffd8f49a739468ab8049bf18eef820cdb1ad6c9015f838556bc7fad4138b23fdf986c7', 'sample@gmial.com'),
(4, '質問一太', 1, '22e7e9d85b7fe6004f7b9f3aa592ea9ec9ce098682e8192fa83785f1784c768d1d1ac3b8afcae88666f66aec24739ac133e9d4adc7506f1a5f1f6078cb27c674', 'ichita@gamil.com'),
(5, '質問三郎', 3, 'a73ae84199edd6790cfc5497e7d8fe7b600c71542c6b9fc77e3f43834564905dea73a533858cd0ddad1702074f32f0d9a44545c28ac17b4138204a746df393e1', '333@gmalc.com'),
(6, '質問史郎', 4, 'cf7a4a223c276be3c60ce48185fdd7af2c1714fa5df35b179bda731c2eb70c7e664d84ca3c62de788ecf0504f05f5676486bdb38141c664d1b7532d9b70990c3', '4rou@gmial.com');

-- --------------------------------------------------------

--
-- テーブルの構造 `mypage_infos`
--

CREATE TABLE `mypage_infos` (
  `code` tinyint(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `member_code` tinyint(3) NOT NULL,
  `task` varchar(500) NOT NULL,
  `bytime1_1` tinyint(2) NOT NULL,
  `bytime1_2` tinyint(2) NOT NULL,
  `bytime2_1` tinyint(2) DEFAULT NULL,
  `bytime2_2` tinyint(2) DEFAULT NULL,
  `emotion` varchar(8) NOT NULL,
  `time1_1` tinyint(10) NOT NULL,
  `time1_2` tinyint(10) NOT NULL,
  `time2_1` tinyint(10) NOT NULL,
  `time2_2` tinyint(10) NOT NULL,
  `attention` varchar(500) NOT NULL,
  `strong1` varchar(50) NOT NULL,
  `strong2` varchar(50) DEFAULT NULL,
  `strong3` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `mypage_infos`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `notices`
--

CREATE TABLE `notices` (
  `code` tinyint(3) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `content` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `notices`
--

INSERT INTO `notices` (`code`, `date`, `content`) VALUES
(1, '2023-02-15 16:06:18', 'テストです。'),
(29, '2023-02-27 06:02:36', 'テスト\r\nテスト\r\nテスト'),
(30, '2023-02-27 12:16:06', 'テストテスト');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `horenso_infos`
--
ALTER TABLE `horenso_infos`
  ADD PRIMARY KEY (`code`);

--
-- テーブルのインデックス `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`code`);

--
-- テーブルのインデックス `mypage_infos`
--
ALTER TABLE `mypage_infos`
  ADD PRIMARY KEY (`code`);

--
-- テーブルのインデックス `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`code`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `horenso_infos`
--
ALTER TABLE `horenso_infos`
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- テーブルの AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- テーブルの AUTO_INCREMENT `mypage_infos`
--
ALTER TABLE `mypage_infos`
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- テーブルの AUTO_INCREMENT `notices`
--
ALTER TABLE `notices`
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
