-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-07-10 12:12:06
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
  `question_or_report` varchar(2) NOT NULL,
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

INSERT INTO `horenso_infos` (`code`, `member_code`, `target_member_code`, `created_at`, `question_or_report`, `title`, `purpose`, `detail`, `cause`, `other`, `rsvp`) VALUES
(1, 1, 5, '2023-07-07 09:10:07', '報告', '今開発を担当している購入機能に関して', NULL, '開発が終わりそうなので、テストに移行したいと思っています。\r\n私のほうでもテスト仕様書のチェックを行おうと思っているので、仕様書作成が終わったら私にもご一報をお願いします。', NULL, 'テストは他の方と分担して行いたいと思います。', '不要'),
(2, 2, 6, '2023-07-07 10:24:20', '質問', '現在進めている、A社様との納品時期の相談', '納品の時期に関して、こちらとしての最短と最長の時期がどれくらいなのか相談したいです。', '', '', 'こちらは急ぎではありませんので、\r\nお手すきでよろしくお願いします。', '');

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
(1, '質問一郎', 1, '028d0289e987833d1eb1aca3820b6c00f9c80fb16d5f85e94148d9aa5d5d39470d63d12a5145a4d0874fea40bc21cab9fcf9b00b18fe3d4fe9ad720495f4662e', 'ichiro@test.com'),
(2, '質問二郎', 2, 'dc3c57b618676f2d38959c785c8ad44b8f4162abfc1c300eb7ec355eb53a137a407c629fa9cfb544286b4ad8c91c8cbde08839b510a7f67ddcc1e0bcff0f550e', 'jiro@test.com'),
(3, '質問三郎', 3, '3d7c6eccdd9479b9740845ca67fe7e4b4ff354f40dab847e910ef89e8a934e34f755206e3ce3fd270fb76c60fa9b4fba8c89445a7613d3d9d4f7a992632364cf', 'saburo@test.com'),
(4, '質問四郎', 4, '2529ed313b72f02c585dcd92ff5194c5a9f4b907a26919cc526a24beaddeaaddace7df82ba500e004f4dd480f82e4fa2ca67df319f480c072df9343dfc6f5c3b', 'shiro@test.com'),
(5, '質問五郎', 5, '89630bc11d97bad1187ffc1290c55788f459157fd7aadf5417d50d3b880dc7c476815d0f74990209e87cbcd9541900e923fadd140f557bfe4bd9e830164e9827', 'goro@test.com'),
(6, '質問シニア', 6, '173e9b8257e1604cdcbd7a6336ca4cead7af62fcc1e0c88d10d964f82658e0ebead18d66f87810b0d5878f6a03858433a43e25d3dde15bcdae1a6bf2036bae0b', 'senior@test.com'),
(7, '試用ユーザ', 1, '51a23bdaab46cfa9fc755bca65522f858be02a1ae951af75e9d7b18db99065c154e5a81cf206805b8aa8abfea3b90ec015278b6b1c5aba6405a1f6b8b5919b1c', 'test@test.com');

-- --------------------------------------------------------

--
-- テーブルの構造 `mypage_infos`
--

CREATE TABLE `mypage_infos` (
  `code` tinyint(4) NOT NULL,
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

INSERT INTO `mypage_infos` (`code`, `created_at`, `member_code`, `task`, `bytime1_1`, `bytime1_2`, `bytime2_1`, `bytime2_2`, `emotion`, `time1_1`, `time1_2`, `time2_1`, `time2_2`, `attention`, `strong1`, `strong2`, `strong3`) VALUES
(1, '2023-07-04 23:32:52', 1, '購入機能の新規機能開発作業', 10, 0, 19, 0, '忙しい', 15, 0, 16, 30, '時間はあまり気にしなくて大丈夫です。\r\n明日お休みをもらっているので質問があれば\r\n今日お願いします。', '機能追加に関する作業を担当しているので、周辺の質問は回答できます。', 'フロント系の技術系の質問にも回答できます。', ''),
(2, '2023-07-04 23:40:55', 2, 'お客様と要件定義のための会議', 12, 0, 14, 30, '余裕', 15, 0, 19, 0, '今日は午前中は会議の前準備のため、それ以降が都合がいいです。\r\n細かい技術系の質問は他の方にお願いしたほうがいいと思います。', 'A様の開発の要件に関しての質問', '', ''),
(3, '2023-07-05 02:03:38', 3, '要件定義の会議', 12, 0, 14, 30, '余裕', 16, 0, 18, 0, '会議後の作業があるので、\r\n明日でいいものは明日にしてほしいです。', '要件定義の資料作成を担当したので、資料に関すること', '要件に関する質問', ''),
(4, '2023-07-05 02:09:10', 4, '既存システムの改修をしています。\r\n担当：ブログ機能、購入機能\r\n今日はブログ機能', 10, 0, 19, 0, '余裕がない', 10, 0, 19, 0, '最近忙しいので、以下をお願いします。\r\n質問するときはやってみたことと、その結果をきちんと整理して教えてください。\r\nまた、事前にslackで声をかけてほしいです。', '開発全般', '設計に関して', ''),
(5, '2023-07-06 11:33:49', 5, 'テスト仕様書の作成をしています。', 10, 0, 19, 0, '普通', 17, 0, 19, 0, '月曜日と水曜日はたいてい忙しいので、別日だと嬉しいです。', '仕様書に関してのことは私に聞いてください。\r\nまた不備があれば教えてほしいです。', '', ''),
(6, '2023-07-06 11:40:28', 6, '開発担当です。プロジェクトリーダーをしています。', 10, 0, 17, 0, '余裕', 17, 0, 19, 0, 'たいてい、17時までには作業を終わらせるようにしています。\r\n質問があれば17時以降はがんがん受け付けます！\r\nなんでも質問してください！', '開発業務全般\r\n※設計は特に私に聞いてください', '', '');

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
(1, '2023-07-06 11:42:00', '7/10は清掃の方が来ますので、机の上のものはしまっておいてください。'),
(2, '2023-07-06 11:44:12', '7/31は面談日です。\r\nみなさんよろしくお願いします。'),
(3, '2023-07-06 11:45:09', '8/1は全体ミーティングを開催します。\r\n詳細は朝会で共有します。'),
(4, '2023-07-07 08:32:02', '試用ユーザは以下でログインできます。\r\nmail：test@test.com\r\npassword：PKUU5');

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
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `mypage_infos`
--
ALTER TABLE `mypage_infos`
  MODIFY `code` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `notices`
--
ALTER TABLE `notices`
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
