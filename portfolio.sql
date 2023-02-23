-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-02-23 14:48:33
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
  `created_at` datetime NOT NULL,
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

INSERT INTO `horenso_infos` (`code`, `member_code`, `target_member_code`, `created_at`, `title`, `purpose`, `detail`, `cause`, `other`, `rsvp`) VALUES
(1, 0, 1, '2023-02-16 15:23:00', '件名', '', '詳細', '', 'その他', '不要'),
(2, 1, 2, '2023-02-16 15:23:00', '件名', '依頼したいこと（必須）', '詳細', '考えられる原因', '試してみたこと・その他', ''),
(3, 1, 2, '2023-02-16 15:23:00', '件名', '', '詳細', '', 'その他', '必要'),
(4, 3, 1, '2023-02-16 15:23:00', '単体テスト実施の件', '', '実施完了しました。', '', 'テスト仕様書の編集も完了しています。', '必要'),
(5, 3, 2, '2023-02-16 15:23:00', 'リリース作業に関して', 'deploy作業を依頼されていますが、\r\n実際に運用されているdeploy方法の確認がしたいです。', '指示を受けたときは、変更セットでdeployを行うように指示がされています。\r\nしかし以前は、GitHubにてdeploy作業をしていたので、誰かが上書きしてしまい、\r\nデグレが発生してしまうと考えられます。', 'deployの運用方法が統一されていないのではないかと思います。\r\n運用方法を検討するべきかと考えます。', '〇〇さんと話したときに、GitHubでのdeployが正しいと思っているとおっしゃっていました。', ''),
(6, 0, 3, '2023-02-16 15:23:00', '件名', '依頼', '詳細', '原因', 'その他', ''),
(7, 1, 3, '2023-02-16 15:23:00', '質問次郎→使用例', '', 'なし', '', 'なし', '必要'),
(8, 1, 3, '2023-02-16 15:23:00', '件名', '依頼', '詳細', '原因', 'その他', ''),
(9, 1, 4, '2023-02-16 15:37:00', 'title変更', '', '詳細', '', '', '必要'),
(10, 1, 6, '2023-02-16 15:43:00', 'fdsafa', 'fdsafdsa', 'fdsa', 'fdsa', 'fdsa', ''),
(11, 1, 3, '2023-02-16 15:48:00', '1111', '', '1111111', '', '11111', '不要'),
(12, 1, 3, '2023-02-16 15:49:00', '11111', '11111', '', '11111', '11111', ''),
(13, 1, 3, '2023-02-16 15:55:00', '222222222', '', '222222222', '', '222222222', '必要'),
(14, 1, 3, '2023-02-16 15:56:00', '222222222', '222222222', '222222222', '222222222', '222222222', ''),
(15, 1, 3, '2023-02-16 16:00:00', '33333', '', '33333', '', '33333', '不要'),
(16, 1, 3, '2023-02-16 16:00:00', '33333', '33333', '33333', '33333', '33333', ''),
(17, 1, 3, '2023-02-16 16:07:00', '44444', '', '44444', '', '44444', '必要'),
(18, 1, 3, '2023-02-16 16:08:00', '44444', '44444', '44444', '44444', '44444', ''),
(19, 1, 4, '2023-02-16 16:19:00', '5555555', '', '5555555', '', '5555555', '不要'),
(20, 1, 4, '2023-02-16 16:19:00', '5555555', '5555555', '5555555', '5555555', '5555555', '');

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
(5, '質問三郎', 3, 'a73ae84199edd6790cfc5497e7d8fe7b600c71542c6b9fc77e3f43834564905dea73a533858cd0ddad1702074f32f0d9a44545c28ac17b4138204a746df393e1', '333@gmalc.com')
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

INSERT INTO `mypage_infos` (`code`, `created_at`, `member_code`, `task`, `bytime1_1`, `bytime1_2`, `bytime2_1`, `bytime2_2`, `emotion`, `time1_1`, `time1_2`, `time2_1`, `time2_2`, `attention`, `strong1`, `strong2`, `strong3`) VALUES
(1, '2023-02-15 16:18:00', 3, '追加機能作成', 13, 0, 20, 0, '忙しい', 9, 0, 9, 50, '基本的に木曜日に質問をしてもらえると助かります。\r\n月曜日は緊急の質問のみにしてほしいです。', 'JavaScript', '', ''),
(2, '2023-02-15 16:32:00', 3, '追加機能作成', 13, 0, 20, 0, '忙しい', 9, 0, 9, 50, '基本的に木曜日に質問をしてもらえると助かります。\r\n月曜日は緊急の質問のみにしてほしいです。', 'TypeScript', '', ''),
(3, '2023-02-16 05:07:00', 1, '今は何をしていますか？', 10, 0, 0, 0, '余裕', 15, 0, 17, 0, '質問時の注意事項', 'ここは私に任せて！', '', ''),
(4, '2023-02-20 12:02:14', 0, 'タスク', 15, 0, 16, 0, '余裕', 16, 0, 17, 0, 'attention', 'strong1', '', ''),
(20, '2023-02-20 13:49:27', 18, 'a', 1, 0, 0, 0, '余裕', 1, 0, 2, 0, 'a', 'a', '', ''),
(21, '2023-02-21 14:47:04', 1, '今は何をしていますか？', 10, 0, 0, 0, '余裕', 15, 0, 17, 0, '質問時の注意事項', 'ここは私に任せて！', '', ''),
(22, '2023-02-21 15:04:14', 1, '今は何をしていますか？', 10, 0, 0, 0, '余裕', 15, 0, 17, 0, '質問時の注意事項', 'ここは私に任せて！', '', ''),
(23, '2023-02-21 15:06:48', 1, '今は何をしていますか？', 10, 0, 0, 0, '余裕', 15, 0, 17, 0, '質問時の注意事項', 'ここは私に任せて！', '', '');

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
(2, '2023-02-15 19:28:10', 'ねむいねむい'),
(3, '2023-02-16 05:27:31', 'テーブル名変更後テスト'),
(4, '2023-02-17 11:19:10', '修正中テスト'),
(5, '2023-02-17 11:23:23', '修正中テスト')
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
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- テーブルの AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- テーブルの AUTO_INCREMENT `mypage_infos`
--
ALTER TABLE `mypage_infos`
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- テーブルの AUTO_INCREMENT `notices`
--
ALTER TABLE `notices`
  MODIFY `code` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
