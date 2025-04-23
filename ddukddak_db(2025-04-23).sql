-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.2.0.6587
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ddk_db
CREATE DATABASE IF NOT EXISTS `ddk_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ddk_db`;

-- Dumping structure for table ddk_db.fix_broker_id
CREATE TABLE IF NOT EXISTS `fix_broker_id` (
  `brokerID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ddk_db.fix_broker_id: ~1 rows (approximately)
DELETE FROM `fix_broker_id`;
INSERT INTO `fix_broker_id` (`brokerID`) VALUES
	('AA0f0096d3');

-- Dumping structure for table ddk_db.fix_coins
CREATE TABLE IF NOT EXISTS `fix_coins` (
  `coin_id` int(11) NOT NULL AUTO_INCREMENT,
  `coin_name` varchar(50) NOT NULL,
  `market` varchar(50) NOT NULL,
  `digit` int(11) NOT NULL DEFAULT 0,
  `min_volume` float NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`coin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COMMENT='코인 테이블';

-- Dumping data for table ddk_db.fix_coins: ~68 rows (approximately)
DELETE FROM `fix_coins`;
INSERT INTO `fix_coins` (`coin_id`, `coin_name`, `market`, `digit`, `min_volume`, `status`) VALUES
	(1, '1INCHUSDT', 'htx', 4, 1, 1),
	(2, 'AAVEUSDT', 'htx', 3, 0.1, 1),
	(3, 'ADAUSDT', 'htx', 6, 10, 1),
	(4, 'ALGOUSDT', 'htx', 5, 10, 1),
	(5, 'ARBUSDT', 'htx', 4, 1, 1),
	(6, 'ATOMUSDT', 'htx', 4, 1, 1),
	(7, 'AVAXUSDT', 'htx', 4, 1, 1),
	(8, 'AXSUSDT', 'htx', 4, 0.1, 1),
	(9, 'BERAUSDT', 'htx', 4, 0.1, 1),
	(10, 'CAKEUSDT', 'htx', 4, 0.1, 1),
	(11, 'CFXUSDT', 'htx', 4, 1, 1),
	(12, 'CHZUSDT', 'htx', 5, 10, 1),
	(13, 'COMPUSDT', 'htx', 2, 0.01, 1),
	(14, 'COREUSDT', 'htx', 4, 0.1, 1),
	(15, 'CRVUSDT', 'htx', 4, 1, 1),
	(16, 'DOGEUSDT', 'htx', 6, 100, 1),
	(17, 'DYDXUSDT', 'htx', 3, 0.1, 1),
	(18, 'EOSUSDT', 'htx', 4, 1, 1),
	(19, 'FARTCOINUSDT', 'htx', 5, 1, 1),
	(20, 'FILUSDT', 'htx', 3, 0.1, 1),
	(21, 'FTTUSDT', 'htx', 3, 1, 1),
	(22, 'GMEUSDT', 'htx', 6, 100, 1),
	(23, 'GRTUSDT', 'htx', 5, 10, 1),
	(24, 'ICPUSDT', 'htx', 3, 0.1, 1),
	(25, 'IMXUSDT', 'htx', 4, 0.1, 1),
	(26, 'IPUSDT', 'htx', 4, 1, 1),
	(27, 'JUSDT', 'htx', 4, 1, 1),
	(28, 'JUPUSDT', 'htx', 4, 1, 1),
	(29, 'KAVAUSDT', 'htx', 4, 1, 1),
	(30, 'KSMUSDT', 'htx', 3, 0.1, 1),
	(31, 'LAYERUSDT', 'htx', 5, 1, 1),
	(32, 'LINKUSDT', 'htx', 4, 0.1, 1),
	(33, 'LRCUSDT', 'htx', 5, 10, 1),
	(34, 'LTCUSDT', 'htx', 2, 0.1, 1),
	(35, 'MANAUSDT', 'htx', 4, 10, 1),
	(36, 'MASKUSDT', 'htx', 3, 0.1, 1),
	(37, 'MAVIAUSDT', 'htx', 4, 0.1, 1),
	(38, 'MELANIAUSDT', 'htx', 3, 0.1, 1),
	(39, 'MKRUSDT', 'htx', 1, 0.001, 1),
	(40, 'MOVEUSDT', 'htx', 5, 1, 1),
	(41, 'MYROUSDT', 'htx', 5, 1, 1),
	(42, 'NEARUSDT', 'htx', 3, 1, 1),
	(43, 'OPUSDT', 'htx', 4, 0.1, 1),
	(44, 'ORDIUSDT', 'htx', 4, 0.1, 1),
	(45, 'PENDLEUSDT', 'htx', 4, 1, 1),
	(46, 'PEOPLEUSDT', 'htx', 5, 10, 1),
	(47, 'PUFFERUSDT', 'htx', 4, 1, 1),
	(48, 'RATSUSDT', 'htx', 7, 1000, 1),
	(49, 'SANDUSDT', 'htx', 6, 10, 1),
	(50, 'SNXUSDT', 'htx', 4, 1, 1),
	(51, 'SONICUSDT', 'htx', 5, 1, 1),
	(52, 'SSVUSDT', 'htx', 3, 0.01, 1),
	(53, 'STEEMUSDT', 'htx', 4, 1, 1),
	(54, 'SUIUSDT', 'htx', 4, 1, 1),
	(55, 'SUSHIUSDT', 'htx', 4, 1, 1),
	(56, 'THETAUSDT', 'htx', 5, 10, 1),
	(57, 'TONUSDT', 'htx', 4, 0.1, 1),
	(58, 'TRUMPUSDT', 'htx', 3, 0.1, 1),
	(59, 'UNIUSDT', 'htx', 4, 1, 1),
	(60, 'WAVESUSDT', 'htx', 4, 1, 1),
	(61, 'WIFUSDT', 'htx', 4, 1, 1),
	(62, 'WLDUSDT', 'htx', 4, 1, 1),
	(63, 'WOOUSDT', 'htx', 5, 10, 1),
	(64, 'XLMUSDT', 'htx', 4, 10, 1),
	(65, 'XMRUSDT', 'htx', 2, 0.01, 1),
	(66, 'XRPUSDT', 'htx', 5, 10, 1),
	(67, 'YFIUSDT', 'htx', 1, 0.0001, 1),
	(68, 'YGGUSDT', 'htx', 4, 1, 1);

-- Dumping structure for table ddk_db.fix_email
CREATE TABLE IF NOT EXISTS `fix_email` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `file_name` varchar(250) DEFAULT NULL,
  `path` varchar(250) DEFAULT NULL,
  `upload_date` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table ddk_db.fix_email: ~8 rows (approximately)
DELETE FROM `fix_email`;
INSERT INTO `fix_email` (`eid`, `name`, `file_name`, `path`, `upload_date`) VALUES
	(1, 'auth', 'n_auth.html', 'ddukddak.local.com/html/n_auth.html', '2024-03-29 19:39:44'),
	(2, 'signup', 'n_congrat.html', 'ddukddak.local.com/html/n_congrat.html', '2024-03-29 19:42:28'),
	(3, 'password', 'n_password.html', 'ddukddak.local.com/html/n_password.html', '2024-03-29 18:54:02'),
	(4, 'coupon', 'n_coupon.html', 'ddukddak.local.com/html/n_coupon.html', '2024-03-29 18:54:17'),
	(5, 'due', 'n_expire.html', 'ddukddak.local.com/html/n_expire.html', '2024-03-29 18:54:26'),
	(6, 'used', 'n_spent.html', 'ddukddak.local.com/html/n_spent.html', '2024-03-29 18:54:43'),
	(7, 'welcome', 'n_welcome.html', 'ddukddak.local.com/html/n_welcome.html', '2024-03-29 21:16:36'),
	(8, 'closing', 'n_abill.html', 'ddukddak.local.com/html/n_abill.html', '2024-03-29 21:16:46');

-- Dumping structure for table ddk_db.fix_leverage
CREATE TABLE IF NOT EXISTS `fix_leverage` (
  `fid` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  UNIQUE KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='레버리지 테이블';

-- Dumping data for table ddk_db.fix_leverage: ~30 rows (approximately)
DELETE FROM `fix_leverage`;
INSERT INTO `fix_leverage` (`fid`, `value`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 6),
	(7, 7),
	(8, 8),
	(9, 9),
	(10, 10),
	(11, 11),
	(12, 12),
	(13, 13),
	(14, 14),
	(15, 15),
	(16, 16),
	(17, 17),
	(18, 18),
	(19, 19),
	(20, 20),
	(21, 21),
	(22, 22),
	(23, 23),
	(24, 24),
	(25, 25),
	(26, 26),
	(27, 27),
	(28, 28),
	(29, 29),
	(30, 30);

-- Dumping structure for table ddk_db.fix_liquidation_range
CREATE TABLE IF NOT EXISTS `fix_liquidation_range` (
  `fid` int(11) NOT NULL,
  `value` float DEFAULT NULL,
  `unit` varchar(2) DEFAULT NULL,
  UNIQUE KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='거래당 청산 범위 테이블';

-- Dumping data for table ddk_db.fix_liquidation_range: ~34 rows (approximately)
DELETE FROM `fix_liquidation_range`;
INSERT INTO `fix_liquidation_range` (`fid`, `value`, `unit`) VALUES
	(1, 0.5, '%'),
	(2, 0.55, '%'),
	(3, 0.6, '%'),
	(4, 0.65, '%'),
	(5, 0.7, '%'),
	(6, 0.75, '%'),
	(7, 0.8, '%'),
	(8, 0.85, '%'),
	(9, 0.9, '%'),
	(10, 0.95, '%'),
	(11, 1, '%'),
	(12, 1.05, '%'),
	(13, 1.1, '%'),
	(14, 1.15, '%'),
	(15, 1.2, '%'),
	(16, 1.25, '%'),
	(17, 1.3, '%'),
	(18, 1.35, '%'),
	(19, 1.4, '%'),
	(20, 1.45, '%'),
	(21, 1.5, '%'),
	(22, 1.55, '%'),
	(23, 1.6, '%'),
	(24, 1.65, '%'),
	(25, 1.7, '%'),
	(26, 1.75, '%'),
	(27, 1.8, '%'),
	(28, 1.85, '%'),
	(29, 1.9, '%'),
	(30, 1.95, '%'),
	(31, 2, '%'),
	(32, 2.1, '%'),
	(33, 2.2, '%'),
	(34, 2.3, '%');

-- Dumping structure for table ddk_db.fix_params
CREATE TABLE IF NOT EXISTS `fix_params` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(150) NOT NULL COMMENT '파라미터 이름',
  `pvalue` varchar(50) DEFAULT NULL COMMENT '파라미터 값',
  `punit` varchar(50) DEFAULT NULL COMMENT '단위',
  `pmin` varchar(50) DEFAULT NULL COMMENT '최소',
  `pmax` varchar(50) DEFAULT NULL COMMENT '최대',
  `ptype` varchar(50) DEFAULT NULL COMMENT '형태',
  `description` text DEFAULT NULL COMMENT '설명',
  `enabled` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='watcher 파라미터 테이블';

-- Dumping data for table ddk_db.fix_params: ~50 rows (approximately)
DELETE FROM `fix_params`;
INSERT INTO `fix_params` (`pid`, `pname`, `pvalue`, `punit`, `pmin`, `pmax`, `ptype`, `description`, `enabled`) VALUES
	(1, 'w1', '30', 'min', '', '', 'w', '최소참고중위가격(분)', 1),
	(2, 'w2', '60', 'min', '', '', 'w', '최대참고중위가격(분)', 1),
	(3, 'w3', '9', 'sec', '', '', 'w', '급등,급락판단을위한계산주기(초)', 1),
	(4, 'w4', '3', 'hour', '', '', 'w', '급등,급락기준(시간)', 1),
	(5, 'w5', '20', '%', '', '', 'w', '등락율(%)', 1),
	(6, 'w6', '1', 'hour', '', '', 'w', 'l-break시간(시간)', 1),
	(7, 'w7', '4', '', '', '', 'w', 'break주문 선택', 0),
	(8, 'w8', '25', 'min', '', '', 'w', '급등,급락기준(분)', 1),
	(9, 'w9', '12', '%', '', '', 'w', '등락율(%)', 1),
	(10, 'w10', '120', 'min', '', '', 'w', 's-break시간(분)', 1),
	(11, 'w11', '30', 'min', '', '', 'w', 's-break재시작 시간(분)', 1),
	(12, 'w12', '2', '', '', '', 'w', 's-break선택', 1),
	(13, 'w13', '10', 'min', '', '', 'w', 'l-break재시작 시간(분)', 1),
	(14, 'w14', '2', '', '', '', 'w', 'l-break선택', 1),
	(15, 'm1', '1.25', '', '0.5', '5', 'm', '선매매(live1) 주문강도 세팅(0.5~5)', 1),
	(16, 'm2', '1', '', '0.5', '5', 'm', '2차매매(live2) 주문강도 세팅(0.5~5)', 1),
	(17, 'm3', '1', '', '0.5', '5', 'm', '3차매매(live3) 주문강도 세팅(0.5~5)', 1),
	(18, 'm4', '1', '', '0.5', '5', 'm', '4차매매(live4) 주문강도 세팅(0.5~5)', 1),
	(19, 'm5', '300', 'sec', '', '', 'm', '선 주문 취소 시간(초)', 1),
	(20, 'm6', '200', 'sec', '', '', 'm', '선매수, 선매도 체결 후 저장 시간(초)', 0),
	(21, 'm7', '600', 'sec', '', '', 'm', '선매수, 선매도(Live_s1, b1)에 대한 매도, 매수 주문이 모두 체결된 후 재주문 시간(초)', 1),
	(22, 'm8', '60', 'sec', '', '', 'm', '상위 Live_s1, b1의 매도, 매수가 완료된 후(초)', 1),
	(23, 'm9', '60', 'sec', '', '', 'm', '조건 만족 후 추가 매도, 매수 주문 시간 delay(초)', 1),
	(24, 'm10', '60', 'sec', '', '', 'm', '재매도, 재매수 주문 시기(초)', 1),
	(25, 'm11', '1.5', '%', '', '', 'm', '앱사용료(%)', 1),
	(26, 'm12', '0.5', '', '0.5', '1', 'm', 'b1, s1수량(0.5~1)', 1),
	(27, 'm13', '0.3', '', '0.5', '1', 'm', 'b2, s2수량(0.5~1)', 1),
	(28, 'm14', '0.25', '', '0.5', '1', 'm', 'b3, s3수량(0.5~1)', 1),
	(29, 'm15', '0.25', '', '0.5', '1', 'm', 'b4, s4수량(0.5~1)', 1),
	(30, 'm16', '-1', '', '-3', '3', 'm', 's1, b1 재주문 범위(-3~3)', 1),
	(31, 'm17', '200', 'min', '', '', 'm', '거래 Reset 대기 시간(분)', 0),
	(32, 'm18', '1', '', '', '', 'm', 'Reset 범위 조정(0~1)', 0),
	(33, 'm19', '30', 'hour', '', '', 'm', '거래 Restart 대기 시간(시간)', 1),
	(34, 'm20', '-2', '', '', '', 'm', 'b1, s1 레버리지', 0),
	(35, 'm21', '-1', '', '', '', 'm', 'b2, s2 레버리지', 0),
	(36, 'm22', '0', '', '', '', 'm', 'b3, s3 레버리지', 0),
	(37, 'm23', '1', '', '', '', 'm', 'b4, s4 레버리지', 0),
	(38, 'm24', '30', 'min', '', '', 'm', 'Peak Order(Short Break)확인시간(분)', 1),
	(39, 'm25', '2.5', '%', '', '', 'm', 'Peak Order(Short Break)등락율(%)', 1),
	(40, 'm26', '30', 'min', '', '', 'm', 'Peak Order(SB3, SB4)확인시간(분)', 1),
	(41, 'm27', '2', '%', '', '', 'm', 'Peak Order(SB3, SB4)등락율(%)', 1),
	(42, 'm28', '1', '%', '', '', 'm', 'Peak Clear Start Point 등락율(%)', 1),
	(43, 'm29', '10', 'sec', '', '', 'm', '선 주문 취소 후 쿨타임(초)', 1),
	(44, 'm30', '65', '%', '', '', 'm', 'Peak Clear End Point 등락율(%)', 1),
	(45, 'e1', '2', '%', '', '', 'e', '공제율', 1),
	(46, 'e2', '1', 'day', '', '', 'e', '에이전트 독립가능 기간(일)', 1),
	(47, 'e3', '20', '%', '', '', 'e', 'Lv6 에이전트 기본 할인율(%)', 1),
	(48, 'e4', '25', '%', '', '', 'e', 'Lv7 에이전트 기본 할인율(%)', 1),
	(49, 'e5', '50', '$', '', '', 'e', '신규유저 증정금액', 1),
	(50, 'h1', '25', '%', NULL, NULL, 'h', '홀딩설정 비율(%)', 1);

-- Dumping structure for table ddk_db.fix_payment_address
CREATE TABLE IF NOT EXISTS `fix_payment_address` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_name` varchar(150) DEFAULT NULL COMMENT '주소 이름',
  `address_link` varchar(250) DEFAULT NULL COMMENT '주소 링크',
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='입금 주소 테이블';

-- Dumping data for table ddk_db.fix_payment_address: ~1 rows (approximately)
DELETE FROM `fix_payment_address`;
INSERT INTO `fix_payment_address` (`pay_id`, `address_name`, `address_link`) VALUES
	(1, NULL, 'TKEqHXp6iSzp7NMqxsytPZ2yC67AJkdgeH');

-- Dumping structure for table ddk_db.fix_profit_range
CREATE TABLE IF NOT EXISTS `fix_profit_range` (
  `fid` int(11) NOT NULL,
  `value` float NOT NULL DEFAULT 0,
  `unit` varchar(2) NOT NULL DEFAULT '%',
  UNIQUE KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='거래당 수익범위 테이블';

-- Dumping data for table ddk_db.fix_profit_range: ~19 rows (approximately)
DELETE FROM `fix_profit_range`;
INSERT INTO `fix_profit_range` (`fid`, `value`, `unit`) VALUES
	(1, 2, '%'),
	(2, 3, '%'),
	(3, 4, '%'),
	(4, 5, '%'),
	(5, 6, '%'),
	(6, 7, '%'),
	(7, 8, '%'),
	(8, 9, '%'),
	(9, 10, '%'),
	(10, 11, '%'),
	(11, 12, '%'),
	(12, 13, '%'),
	(13, 14, '%'),
	(14, 15, '%'),
	(15, 16, '%'),
	(16, 17, '%'),
	(17, 18, '%'),
	(18, 19, '%'),
	(19, 20, '%');

-- Dumping structure for table ddk_db.fix_trade_money
CREATE TABLE IF NOT EXISTS `fix_trade_money` (
  `fid` int(11) NOT NULL,
  `value` int(11) DEFAULT 0 COMMENT '거래금액',
  `level` int(11) DEFAULT 0 COMMENT '유저 레벨',
  UNIQUE KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='최대 거래 금액';

-- Dumping data for table ddk_db.fix_trade_money: ~259 rows (approximately)
DELETE FROM `fix_trade_money`;
INSERT INTO `fix_trade_money` (`fid`, `value`, `level`) VALUES
	(1, 100, 1),
	(2, 120, 1),
	(3, 140, 1),
	(4, 160, 1),
	(5, 180, 1),
	(6, 200, 1),
	(7, 220, 2),
	(8, 240, 2),
	(9, 260, 2),
	(10, 280, 2),
	(11, 300, 2),
	(12, 320, 2),
	(13, 340, 2),
	(14, 360, 2),
	(15, 380, 2),
	(16, 400, 2),
	(17, 440, 3),
	(18, 480, 3),
	(19, 520, 3),
	(20, 560, 3),
	(21, 600, 3),
	(22, 650, 4),
	(23, 700, 4),
	(24, 750, 4),
	(25, 800, 4),
	(26, 850, 4),
	(27, 900, 4),
	(28, 950, 4),
	(29, 1000, 4),
	(30, 1050, 5),
	(31, 1100, 5),
	(32, 1150, 5),
	(33, 1200, 5),
	(34, 1250, 5),
	(35, 1300, 5),
	(36, 1350, 5),
	(37, 1400, 5),
	(38, 1450, 5),
	(39, 1500, 5),
	(40, 1550, 5),
	(41, 1600, 5),
	(42, 1650, 5),
	(43, 1700, 5),
	(44, 1750, 5),
	(45, 1800, 5),
	(46, 1850, 5),
	(47, 1900, 5),
	(48, 1950, 5),
	(49, 2000, 5),
	(50, 2050, 6),
	(51, 2100, 6),
	(52, 2150, 6),
	(53, 2200, 6),
	(54, 2250, 6),
	(55, 2300, 6),
	(56, 2350, 6),
	(57, 2400, 6),
	(58, 2450, 6),
	(59, 2500, 6),
	(60, 2550, 6),
	(61, 2600, 6),
	(62, 2650, 6),
	(63, 2700, 6),
	(64, 2750, 6),
	(65, 2800, 6),
	(66, 2850, 6),
	(67, 2900, 6),
	(68, 2950, 6),
	(69, 3000, 6),
	(70, 3050, 6),
	(71, 3100, 6),
	(72, 3150, 6),
	(73, 3200, 6),
	(74, 3250, 6),
	(75, 3300, 6),
	(76, 3350, 6),
	(77, 3400, 6),
	(78, 3450, 6),
	(79, 3500, 6),
	(80, 3550, 6),
	(81, 3600, 6),
	(82, 3650, 6),
	(83, 3700, 6),
	(84, 3750, 6),
	(85, 3800, 6),
	(86, 3850, 6),
	(87, 3900, 6),
	(88, 3950, 6),
	(89, 4000, 6),
	(90, 4050, 6),
	(91, 4100, 6),
	(92, 4150, 6),
	(93, 4200, 6),
	(94, 4250, 6),
	(95, 4300, 6),
	(96, 4350, 6),
	(97, 4400, 6),
	(98, 4450, 6),
	(99, 4500, 6),
	(100, 4550, 6),
	(101, 4600, 6),
	(102, 4650, 6),
	(103, 4700, 6),
	(104, 4750, 6),
	(105, 4800, 6),
	(106, 4850, 6),
	(107, 4900, 6),
	(108, 4950, 6),
	(109, 5000, 6),
	(110, 5100, 7),
	(111, 5200, 7),
	(112, 5300, 7),
	(113, 5400, 7),
	(114, 5500, 7),
	(115, 5600, 7),
	(116, 5700, 7),
	(117, 5800, 7),
	(118, 5900, 7),
	(119, 6000, 7),
	(120, 6100, 7),
	(121, 6200, 7),
	(122, 6300, 7),
	(123, 6400, 7),
	(124, 6500, 7),
	(125, 6600, 7),
	(126, 6700, 7),
	(127, 6800, 7),
	(128, 6900, 7),
	(129, 7000, 7),
	(130, 7100, 7),
	(131, 7200, 7),
	(132, 7300, 7),
	(133, 7400, 7),
	(134, 7500, 7),
	(135, 7600, 7),
	(136, 7700, 7),
	(137, 7800, 7),
	(138, 7900, 7),
	(139, 8000, 7),
	(140, 8200, 8),
	(141, 8400, 8),
	(142, 8600, 8),
	(143, 8800, 8),
	(144, 9000, 8),
	(145, 9200, 8),
	(146, 9400, 8),
	(147, 9600, 8),
	(148, 9800, 8),
	(149, 10000, 8),
	(150, 10200, 8),
	(151, 10400, 8),
	(152, 10600, 8),
	(153, 10800, 8),
	(154, 11000, 8),
	(155, 11200, 8),
	(156, 11400, 8),
	(157, 11600, 8),
	(158, 11800, 8),
	(159, 12000, 8),
	(160, 12200, 8),
	(161, 12400, 8),
	(162, 12600, 8),
	(163, 12800, 8),
	(164, 13000, 8),
	(165, 13200, 8),
	(166, 13400, 8),
	(167, 13600, 8),
	(168, 13800, 8),
	(169, 14000, 8),
	(170, 14200, 8),
	(171, 14400, 8),
	(172, 14600, 8),
	(173, 14800, 8),
	(174, 15000, 8),
	(175, 15200, 8),
	(176, 15400, 8),
	(177, 15600, 8),
	(178, 15800, 8),
	(179, 16000, 8),
	(180, 16200, 8),
	(181, 16400, 8),
	(182, 16600, 8),
	(183, 16800, 8),
	(184, 17000, 8),
	(185, 17200, 8),
	(186, 17400, 8),
	(187, 17600, 8),
	(188, 17800, 8),
	(189, 18000, 8),
	(190, 18200, 8),
	(191, 18400, 8),
	(192, 18600, 8),
	(193, 18800, 8),
	(194, 19000, 8),
	(195, 19200, 8),
	(196, 19400, 8),
	(197, 19600, 8),
	(198, 19800, 8),
	(199, 20000, 8),
	(200, 20500, 8),
	(201, 21000, 8),
	(202, 21500, 8),
	(203, 22000, 8),
	(204, 22500, 8),
	(205, 23000, 8),
	(206, 23500, 8),
	(207, 24000, 8),
	(208, 24500, 8),
	(209, 25000, 8),
	(210, 25500, 8),
	(211, 26000, 8),
	(212, 26500, 8),
	(213, 27000, 8),
	(214, 27500, 8),
	(215, 28000, 8),
	(216, 28500, 8),
	(217, 29000, 8),
	(218, 29500, 8),
	(219, 30000, 8),
	(220, 30500, 8),
	(221, 31000, 8),
	(222, 31500, 8),
	(223, 32000, 8),
	(224, 32500, 8),
	(225, 33000, 8),
	(226, 33500, 8),
	(227, 34000, 8),
	(228, 34500, 8),
	(229, 35000, 8),
	(230, 35500, 8),
	(231, 36000, 8),
	(232, 36500, 8),
	(233, 37000, 8),
	(234, 37500, 8),
	(235, 38000, 8),
	(236, 38500, 8),
	(237, 39000, 8),
	(238, 39500, 8),
	(239, 40000, 8),
	(240, 40500, 8),
	(241, 41000, 8),
	(242, 41500, 8),
	(243, 42000, 8),
	(244, 42500, 8),
	(245, 43000, 8),
	(246, 43500, 8),
	(247, 44000, 8),
	(248, 44500, 8),
	(249, 45000, 8),
	(250, 45500, 8),
	(251, 46000, 8),
	(252, 46500, 8),
	(253, 47000, 8),
	(254, 47500, 8),
	(255, 48000, 8),
	(256, 48500, 8),
	(257, 49000, 8),
	(258, 49500, 8),
	(259, 50000, 8);

-- Dumping structure for table ddk_db.tbl_api_key
CREATE TABLE IF NOT EXISTS `tbl_api_key` (
  `kid` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) DEFAULT NULL COMMENT '유저 유일번호',
  `market` varchar(50) NOT NULL DEFAULT 'htx' COMMENT '거래소 이름',
  `key_name` varchar(150) DEFAULT '' COMMENT '키 이름',
  `api_key` varchar(250) DEFAULT '' COMMENT 'api key',
  `secret_key` varchar(250) DEFAULT '' COMMENT 'Secret Key',
  `create_date` varchar(150) DEFAULT NULL COMMENT '생성일자',
  PRIMARY KEY (`kid`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 COMMENT='유저별 api 키 테이블';

-- Dumping data for table ddk_db.tbl_api_key: ~69 rows (approximately)
DELETE FROM `tbl_api_key`;
INSERT INTO `tbl_api_key` (`kid`, `user_num`, `market`, `key_name`, `api_key`, `secret_key`, `create_date`) VALUES
	(11, 3, 'bin', 'API Key', 'dlKVflhIn8HjuCvWUN2pvcQewa5Pa1NjrnPoTiXy7Nxk0GrSZuWbpf3Qq8u5OtQL', 'jVexd2s0ii1DH085PboFn5Li0iDWajzzr1rAaqWjO1xTPqJv0K7XPIsoH41jOQ3Z', '2024-04-29 07:17:07'),
	(14, 6, 'bin', 'API Key', 'VNfwtSBfREYipcFZw9urt1NENaySpt0eQSV1Am3ujGq9QVaiK5dH9JpERUEEBKCh', '9Srq98XWfezYF8BHD6HJjcV9PQlaKwglT7Sh6MUCVHVFUzLEI96fO3nOv6gNEX34', '2024-05-09 16:21:15'),
	(77, 22, 'htx', 'API Key', '6ce4f6d9-4dfd0338-2510ea95-ur2fg6h2gf', 'eaa74f54-e417b453-62501790-0ca50', '2024-09-24 08:50:00'),
	(78, 22, 'htx', 'API Key', 'vftwcr5tnh-9d212478-b299255c-40195', '52024c77-e2935127-67269e24-f06b0', '2024-09-24 08:50:12'),
	(79, 22, 'htx', 'API Key', 'frbghq7rnm-e12c934c-a6f6d97a-a560b', '494d058e-378325b1-47ee5f7a-628a5', '2024-09-24 08:50:24'),
	(80, 22, 'htx', 'API Key', 'bgrdawsdsd-8bcec16d-b4a79920-b7ba5', 'fda41d52-fcc258b2-6f9c711e-d4751', '2024-09-24 08:50:37'),
	(81, 22, 'htx', 'API Key', 'c48454f1-b980ca91-vfd5ghr532-5a4f2', 'b17d1047-1161c64d-b09b2f42-5fdec', '2024-09-24 08:50:50'),
	(82, 22, 'htx', 'API Key', 'edrfhh5h53-a2c7e633-11fd8086-13994', '532609f5-7d5fb069-33e048d4-7ef34', '2024-09-24 08:51:03'),
	(83, 22, 'htx', 'API Key', 'yh4fhmvs5k-12d8c5fe-06cce533-686a8', 'f3749560-9cf9b1e7-c4ce0025-dc962', '2024-09-24 08:51:15'),
	(84, 22, 'htx', 'API Key', '71f28f88-8de20bda-785d7988-afwo04df3f', '1d5c9482-84a72b89-9533451d-53691', '2024-09-24 08:51:26'),
	(85, 22, 'htx', 'API Key', '2756a88e-vfd5ghr532-d6b57a16-5ecf2', '5958b31e-d7269690-1a331d60-0288a', '2024-09-24 08:51:39'),
	(86, 22, 'htx', 'API Key', 'e72c6d95-cef32ed6-d50f56eb-qv2d5ctgbn', 'f5cee9d2-893f3af0-08f6ba62-dbf31', '2024-09-24 08:51:52'),
	(87, 6, 'htx', 'API Key', '6ce4f6d9-4dfd0338-2510ea95-ur2fg6h2gf', 'eaa74f54-e417b453-62501790-0ca50', '2024-09-24 08:52:40'),
	(88, 6, 'htx', 'API Key', 'vftwcr5tnh-9d212478-b299255c-40195', '52024c77-e2935127-67269e24-f06b0', '2024-09-24 08:52:51'),
	(89, 6, 'htx', 'API Key', 'frbghq7rnm-e12c934c-a6f6d97a-a560b', '494d058e-378325b1-47ee5f7a-628a5', '2024-09-24 08:53:02'),
	(90, 6, 'htx', 'API Key', 'bgrdawsdsd-8bcec16d-b4a79920-b7ba5', 'fda41d52-fcc258b2-6f9c711e-d4751', '2024-09-24 08:53:13'),
	(91, 6, 'htx', 'API Key', 'c48454f1-b980ca91-vfd5ghr532-5a4f2', 'b17d1047-1161c64d-b09b2f42-5fdec', '2024-09-24 08:53:24'),
	(92, 6, 'htx', 'API Key', 'edrfhh5h53-a2c7e633-11fd8086-13994', '532609f5-7d5fb069-33e048d4-7ef34', '2024-09-24 08:53:36'),
	(93, 6, 'htx', 'API Key', 'yh4fhmvs5k-12d8c5fe-06cce533-686a8', 'f3749560-9cf9b1e7-c4ce0025-dc962', '2024-09-24 08:53:47'),
	(94, 6, 'htx', 'API Key', '71f28f88-8de20bda-785d7988-afwo04df3f', '1d5c9482-84a72b89-9533451d-53691', '2024-09-24 08:53:58'),
	(95, 6, 'htx', 'API Key', '2756a88e-vfd5ghr532-d6b57a16-5ecf2', '5958b31e-d7269690-1a331d60-0288a', '2024-09-24 08:54:10'),
	(96, 6, 'htx', 'API Key', 'e72c6d95-cef32ed6-d50f56eb-qv2d5ctgbn', 'f5cee9d2-893f3af0-08f6ba62-dbf31', '2024-09-24 08:54:29'),
	(97, 24, 'htx', 'API Key', 'e72c6d95-cef32ed6-d50f56eb-qv2d5ctgbn', 'f5cee9d2-893f3af0-08f6ba62-dbf31', '2024-11-04 10:00:16'),
	(98, 24, 'htx', 'API Key', '2756a88e-vfd5ghr532-d6b57a16-5ecf2', '5958b31e-d7269690-1a331d60-0288a', '2024-11-05 15:05:13'),
	(99, 24, 'htx', 'API Key', '71f28f88-8de20bda-785d7988-afwo04df3f', '1d5c9482-84a72b89-9533451d-53691', '2024-11-05 15:05:31'),
	(100, 24, 'htx', 'API Key', 'yh4fhmvs5k-12d8c5fe-06cce533-686a8', 'f3749560-9cf9b1e7-c4ce0025-dc962', '2024-11-05 15:06:24'),
	(101, 24, 'htx', 'API Key', 'edrfhh5h53-a2c7e633-11fd8086-13994', '532609f5-7d5fb069-33e048d4-7ef34', '2024-11-05 15:06:42'),
	(102, 24, 'htx', 'API Key', 'c48454f1-b980ca91-vfd5ghr532-5a4f2', 'b17d1047-1161c64d-b09b2f42-5fdec', '2024-11-05 15:07:00'),
	(103, 24, 'htx', 'API Key', 'bgrdawsdsd-8bcec16d-b4a79920-b7ba5', 'fda41d52-fcc258b2-6f9c711e-d4751', '2024-11-05 15:07:17'),
	(104, 24, 'htx', 'API Key', 'frbghq7rnm-e12c934c-a6f6d97a-a560b', '494d058e-378325b1-47ee5f7a-628a5', '2024-11-05 15:07:35'),
	(105, 24, 'htx', 'API Key', 'vftwcr5tnh-9d212478-b299255c-40195', '52024c77-e2935127-67269e24-f06b0', '2024-11-05 15:07:52'),
	(106, 24, 'htx', 'API Key', '6ce4f6d9-4dfd0338-2510ea95-ur2fg6h2gf', 'eaa74f54-e417b453-62501790-0ca50', '2024-11-05 15:08:10'),
	(107, 3, 'htx', 'API Key', 'f8f462ad-c8f939f5-ebc27da0-bvrge3rf7j', 'f3ea06d3-3a145f54-7e9f68e7-b0ae0', '2025-01-13 15:21:25'),
	(111, 26, 'htx', 'API Key', '731ad538-c0c4e173-04afc533-vqgdf4gsga', '707eaa80-cdebfdc0-f8525d0e-e4d86', '2025-01-19 10:38:10'),
	(112, 26, 'htx', 'API Key', '25ac86a8-1hrfj6yhgg-251cd2d4-10aaa', '9f3237b2-96312483-7fc7133e-b0ac7', '2025-01-19 10:38:26'),
	(113, 26, 'htx', 'API Key', 'a36c3ea2-2734abf7-uymylwhfeg-55b8d', 'deef923f-f2da8df0-4841452f-afb7d', '2025-01-19 10:38:40'),
	(114, 26, 'htx', 'API Key', '6f88a3df-95c4865a-d55c3308-frbghq7rnm', 'b2f35819-10e93ec7-71b8579b-524d4', '2025-01-19 10:38:54'),
	(115, 26, 'htx', 'API Key', '8bdb35fe-c992e73a-frbghq7rnm-638e5', 'a1f16f26-271cbafe-0bf153f6-f76f0', '2025-01-19 10:39:07'),
	(116, 26, 'htx', 'API Key', 'bg5t6ygr6y-52b283ec-e4eb9c2b-e4fa7', 'fcc8bc25-12ef63c0-eb64fe6b-e39ac', '2025-01-19 10:39:21'),
	(117, 27, 'htx', 'API Key', 'mk0lklo0de-f3d8dbcd-ac21cf90-ab830', '1b984069-a67d5ba4-fb89a5d4-b8485', '2025-01-19 10:40:03'),
	(118, 27, 'htx', 'API Key', 'b1rkuf4drg-f7dc258b-fd244cd9-d7ec6', '757c44b1-fc8e7006-e82536b8-9d123', '2025-01-19 10:40:16'),
	(119, 27, 'htx', 'API Key', '89f1a4c5-cc9f918e-def1f6ea-mjlpdje3ld', 'ae769ca7-d0726ed3-dad60b2e-c439c', '2025-01-19 10:40:31'),
	(120, 27, 'htx', 'API Key', '41e3c987-0a173a7a-vqgdf4gsga-65353', '0163d0e4-6ed62b66-e98d61e6-bde69', '2025-01-19 10:40:47'),
	(121, 27, 'htx', 'API Key', 'rbr45t6yr4-bfeb3618-0e034aac-6cd8e', '14d01a1f-6a4899f1-5389df9b-b611d', '2025-01-19 10:41:00'),
	(122, 27, 'htx', 'API Key', '10158a5b-f6a889c3-78dfbb12-dqnh6tvdf3', 'e17e76a1-b291924d-a82ca143-0aa30', '2025-01-19 10:41:14'),
	(123, 28, 'htx', 'API Key', 'd9a6052f-77b8b059-dqnh6tvdf3-f3a63', 'e168b939-a2c8fa52-f2facac4-40793', '2025-01-19 10:47:57'),
	(124, 28, 'htx', 'API Key', '9540a868-7e9786dc-bg2hyw2dfg-bacd3', 'c4183a1f-95bfa3b8-0eccba3d-237da', '2025-01-19 10:48:13'),
	(125, 28, 'htx', 'API Key', '7yngd7gh5g-d68361f5-07629dcf-ecc37', '0cd9c81c-c85f0881-d7127ae2-c9ac3', '2025-01-19 10:48:29'),
	(126, 28, 'htx', 'API Key', '12a63e9d-94c362a8-150b12f7-qv2d5ctgbn', '36e1d281-3f046a28-4378a0e4-d6784', '2025-01-19 10:48:45'),
	(127, 28, 'htx', 'API Key', 'c28792ed-3d2xc4v5bu-05da87a1-c77c2', '5051121b-bf16513e-81f0a95f-879c6', '2025-01-19 10:49:00'),
	(128, 28, 'htx', 'API Key', '458aec4e-vfd5ghr532-e160714f-9ddea', '199aee83-3c13fa51-954918ed-23595', '2025-01-19 10:49:14'),
	(129, 29, 'htx', 'API Key', 'd0f277e0-edrfhh5h53-2227e789-69950', 'd2214221-294f4d98-089591c3-a2460', '2025-01-19 10:49:53'),
	(130, 29, 'htx', 'API Key', 'rbr45t6yr4-7ed76e19-267210ef-a86b6', '2597dd6b-234c07ea-0e1efd60-05edd', '2025-01-19 10:50:06'),
	(131, 29, 'htx', 'API Key', '5ca3e811-uymylwhfeg-003ca4de-3b083', '447a9283-9912990d-b0a2ae51-b42f0', '2025-01-19 10:50:20'),
	(132, 29, 'htx', 'API Key', '1qdmpe4rty-40356c22-1ee21b74-00c12', '404636f4-fa2177e9-8ab29d6c-0efcc', '2025-01-19 10:50:35'),
	(133, 29, 'htx', 'API Key', 'mjlpdje3ld-df9465b4-3cdb0765-36b64', '708a467c-9bdb4384-193f18c4-1dfb8', '2025-01-19 10:50:49'),
	(134, 29, 'htx', 'API Key', '73d84b99-d4d031f3-ur2fg6h2gf-e6c54', 'c1b04700-e89b14df-84c1294a-d1eb3', '2025-01-19 10:51:09'),
	(136, 30, 'htx', 'API Key', '8193c569-ghxertfvbf-8ec818de-9642b', '54cde017-cc8d18a4-630aaab6-cadbc', '2025-01-21 21:27:55'),
	(137, 30, 'htx', 'API Key', 'ez2xc4vb6n-95c75734-9dec2a96-72ffe', 'ecffa2c9-99290e73-db12bb1f-de58b', '2025-01-21 21:28:10'),
	(138, 30, 'htx', 'API Key', '155ce1dd-vfd5ghr532-1b6a33c5-45485', '2f7f8e96-5e7cec48-185ffe16-07167', '2025-01-21 21:28:24'),
	(139, 30, 'htx', 'API Key', 'ghxertfvbf-2353891c-ce29bfad-4ee02', 'f48416ac-275bb461-d42d3007-2a255', '2025-01-21 21:28:38'),
	(140, 30, 'htx', 'API Key', 'fr2wer5t6y-9d30375b-fb43f474-efb0c', '51e47e86-b9fcc7d9-dd2f5daa-acd35', '2025-01-21 21:28:51'),
	(141, 30, 'htx', 'API Key', '815315ac-d43c7ea9-6f04c186-vqgdf4gsga', '94bd1523-ba09e332-4176185c-e11ac', '2025-01-21 21:29:03'),
	(142, 31, 'htx', 'API Key', '63346d61-85d9dd87-2b6d341e-fr2wer5t6y', '63bad193-effa4dad-acb573eb-56f64', '2025-01-21 21:29:39'),
	(143, 31, 'htx', 'API Key', '7a0f91a0-da8a9a03-ht4tgq1e4t-02d96', '51b7afda-c7c2b1df-9cc609e4-0770d', '2025-01-21 21:29:54'),
	(144, 31, 'htx', 'API Key', '0e886098-eac5c3c4-3aa7ada7-1hrfj6yhgg', 'b4f41c92-5deb853e-83b74266-b6926', '2025-01-21 21:30:08'),
	(145, 31, 'htx', 'API Key', 'ur2fg6h2gf-0ed564a9-389b7ca5-d0fb6', 'ab074db3-56a6b645-0a59ddba-d6629', '2025-01-21 21:30:22'),
	(146, 31, 'htx', 'API Key', '1ac076e6-ghxertfvbf-2921e536-32599', '07e3da74-bd653601-a4cc6d12-955fc', '2025-01-21 21:30:36'),
	(147, 31, 'htx', 'API Key', '1hrfj6yhgg-f17d5b47-f982e7b0-e4f3d', '65dc134e-339d591f-d84a2590-b67e6', '2025-01-21 21:30:49');

-- Dumping structure for table ddk_db.tbl_coupon
CREATE TABLE IF NOT EXISTS `tbl_coupon` (
  `coupon_num` int(11) NOT NULL AUTO_INCREMENT COMMENT '쿠폰 번호',
  `coupon_name` varchar(150) NOT NULL COMMENT '쿠폰 이름',
  `coupon_level` int(11) NOT NULL DEFAULT 0 COMMENT '쿠폰 레벨',
  `coupon_valid` int(11) NOT NULL DEFAULT 0 COMMENT '쿠폰 유효 기간',
  `coupon_price` int(11) NOT NULL DEFAULT 0 COMMENT '구매 가격',
  `amount_given` double(10,5) NOT NULL DEFAULT 0.00000 COMMENT '제공 금액',
  `description` varchar(250) NOT NULL COMMENT '설명',
  `show` int(11) NOT NULL DEFAULT 0 COMMENT '웹에 올림, 내림 선택',
  `coin_count` int(11) NOT NULL DEFAULT 0 COMMENT '동시 사용가능한 코인 수량',
  `create_date` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`coupon_num`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='쿠폰 테이블';

-- Dumping data for table ddk_db.tbl_coupon: ~13 rows (approximately)
DELETE FROM `tbl_coupon`;
INSERT INTO `tbl_coupon` (`coupon_num`, `coupon_name`, `coupon_level`, `coupon_valid`, `coupon_price`, `amount_given`, `description`, `show`, `coin_count`, `create_date`) VALUES
	(2, '1레벨 쿠폰', 1, 20, 500, 600.00000, '1레벨 유저에 해당 함', 0, 1, '2024-03-21 06:14:39'),
	(4, '3레벨 쿠폰', 3, 60, 1600, 2000.00000, '3레벨 유저에게 해당함', 0, 3, '2024-03-21 21:13:22'),
	(6, '2레벨 쿠폰', 2, 60, 900, 1000.00000, '2레벨 유저에 해당 함', 0, 2, '2024-03-22 00:48:32'),
	(7, '4레벨 쿠폰', 4, 60, 2000, 2200.00000, '4레벨 유저가 사용함', 0, 5, '2024-03-22 00:49:18'),
	(8, '5레벨 쿠폰', 5, 60, 3500, 4000.00000, '5레벨에 해당 함', 0, 8, '2024-03-22 00:50:11'),
	(9, '6레벨 쿠폰', 7, 60, 5000, 6000.00000, '6레벨 유저가 사용', 0, 6, '2024-03-24 15:03:23'),
	(10, '1레벨 쿠폰', 1, 60, 650, 700.00000, '1레벨 쿠폰', 0, 1, '2024-03-25 15:41:42'),
	(11, '2레벨 쿠폰', 2, 60, 1100, 1200.00000, '2레벨 쿠폰', 0, 2, '2024-03-25 15:42:19'),
	(12, '3레벨 쿠폰', 3, 60, 2200, 2300.00000, '3레벨 쿠폰', 0, 3, '2024-03-25 15:42:49'),
	(13, '4레벨 쿠폰', 4, 60, 3500, 4000.00000, '4레벨 쿠폰', 0, 6, '2024-03-25 15:43:14'),
	(14, '5레벨 쿠폰', 5, 60, 5000, 5500.00000, '5레벨 쿠폰', 0, 8, '2024-03-25 15:43:59'),
	(15, '6레벨 쿠폰', 6, 60, 6500, 7000.00000, '6레벨 쿠폰', 0, 10, '2024-03-25 15:44:30'),
	(16, '7레벨 쿠폰', 7, 60, 10000, 15000.00000, '7레벨 쿠폰', 0, 20, '2024-03-25 15:44:52');

-- Dumping structure for table ddk_db.tbl_coupon_user
CREATE TABLE IF NOT EXISTS `tbl_coupon_user` (
  `cid` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) NOT NULL COMMENT '유저 유일번호',
  `coupon_num` int(11) NOT NULL COMMENT '쿠폰번호',
  `date_buy` varchar(150) DEFAULT NULL COMMENT '구폰 구매 일자',
  `date_due` varchar(150) DEFAULT NULL COMMENT '쿠폰 유효 기간',
  `price_buy` double(10,5) DEFAULT 0.00000 COMMENT '구매 가격',
  `amount_given` double(10,5) DEFAULT 0.00000 COMMENT '쿠폰 증정 금액',
  `level` tinyint(4) DEFAULT NULL COMMENT '쿠폰 레벨',
  `amount_used` double(10,5) DEFAULT 0.00000 COMMENT '사용한 금액',
  `balance` double(10,5) DEFAULT 0.00000 COMMENT '남은 금액',
  `status` tinyint(4) DEFAULT 0 COMMENT '상태(0: 사용전, 1:사용중, 2:기간만료, 3:사용완료)',
  `created_date` varchar(150) DEFAULT NULL,
  `coin_num_ext` tinyint(4) DEFAULT 0,
  `sales_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `user_num` (`user_num`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='유저쿠폰 테이블';

-- Dumping data for table ddk_db.tbl_coupon_user: ~1 rows (approximately)
DELETE FROM `tbl_coupon_user`;
INSERT INTO `tbl_coupon_user` (`cid`, `user_num`, `coupon_num`, `date_buy`, `date_due`, `price_buy`, `amount_given`, `level`, `amount_used`, `balance`, `status`, `created_date`, `coin_num_ext`, `sales_num`) VALUES
	(1, 6, 2, '2024-03-25 23:59:17', '2024-05-25 23:59:31', 500.00000, 600.00000, 1, 0.00000, 600.00000, 0, NULL, 1, NULL);

-- Dumping structure for table ddk_db.tbl_live_coins
CREATE TABLE IF NOT EXISTS `tbl_live_coins` (
  `cid` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '실행 번호',
  `user_num` bigint(20) DEFAULT NULL COMMENT '유저 유일번호',
  `coin_num` int(11) DEFAULT NULL COMMENT '코인번호',
  `market` varchar(50) DEFAULT NULL COMMENT '거래소 이름(bin, htx)',
  `bet_limit` int(11) DEFAULT 100 COMMENT '1회 최대 거래 금액',
  `rate_rev` float DEFAULT 0.5 COMMENT '거래 당 수익범위',
  `leverage` tinyint(4) DEFAULT NULL COMMENT '레버리지',
  `rate_liq` float DEFAULT 5 COMMENT '거래 당 청산범위',
  `is_run` tinyint(4) DEFAULT 0 COMMENT '실행상태(0-정지, 1-실행중)',
  `kid` bigint(20) DEFAULT 0 COMMENT '생성된 API 키의 유일번호',
  `hold_status` tinyint(4) DEFAULT 0 COMMENT 'Holding 상태',
  `check_time` int(10) DEFAULT 1 COMMENT '자동확인 시간',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='작업중 코인 테이블';

-- Dumping data for table ddk_db.tbl_live_coins: ~0 rows (approximately)
DELETE FROM `tbl_live_coins`;

-- Dumping structure for table ddk_db.tbl_market_amount
CREATE TABLE IF NOT EXISTS `tbl_market_amount` (
  `mid` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) NOT NULL DEFAULT 0 COMMENT '유저번호',
  `market` varchar(50) NOT NULL COMMENT '거래소 이름(bin, htx)',
  `amount` double(20,5) NOT NULL DEFAULT 0.00000 COMMENT '보유금액',
  `date` varchar(50) DEFAULT '' COMMENT '날짜',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COMMENT='유저별 거래소별 보유금액';

-- Dumping data for table ddk_db.tbl_market_amount: ~97 rows (approximately)
DELETE FROM `tbl_market_amount`;
INSERT INTO `tbl_market_amount` (`mid`, `user_num`, `market`, `amount`, `date`) VALUES
	(1, 3, 'bin', 0.00000, '2025-02-12'),
	(2, 3, 'htx', 185.36000, '2025-02-12'),
	(3, 6, 'bin', 0.00000, '2025-02-12'),
	(4, 6, 'htx', 800.60000, '2025-02-12'),
	(5, 22, 'htx', 800.60000, '2025-02-12'),
	(6, 24, 'htx', 800.60000, '2025-02-12'),
	(7, 26, 'htx', 177.27000, '2025-02-12'),
	(8, 27, 'htx', 200.69000, '2025-02-12'),
	(9, 28, 'htx', 6.00000, '2025-02-12'),
	(10, 29, 'htx', 7.00000, '2025-02-12'),
	(11, 30, 'htx', 8.00000, '2025-02-12'),
	(12, 31, 'htx', 9.00000, '2025-02-12'),
	(13, 3, 'bin', 0.00000, '2025-02-17'),
	(14, 3, 'htx', 184.82000, '2025-02-17'),
	(15, 6, 'bin', 0.00000, '2025-02-17'),
	(16, 6, 'htx', 769.24000, '2025-02-17'),
	(17, 22, 'htx', 769.24000, '2025-02-17'),
	(18, 24, 'htx', 769.24000, '2025-02-17'),
	(19, 26, 'htx', 144.36000, '2025-02-17'),
	(20, 27, 'htx', 167.30000, '2025-02-17'),
	(21, 3, 'bin', 0.00000, '2025-02-18'),
	(22, 3, 'htx', 180.73000, '2025-02-18'),
	(23, 6, 'bin', 0.00000, '2025-02-18'),
	(24, 6, 'htx', 766.43000, '2025-02-18'),
	(25, 22, 'htx', 766.43000, '2025-02-18'),
	(26, 24, 'htx', 766.43000, '2025-02-18'),
	(27, 26, 'htx', 144.36000, '2025-02-18'),
	(28, 27, 'htx', 167.30000, '2025-02-18'),
	(29, 28, 'htx', 6.00000, '2025-02-18'),
	(30, 29, 'htx', 7.00000, '2025-02-18'),
	(31, 30, 'htx', 8.00000, '2025-02-18'),
	(32, 31, 'htx', 9.00000, '2025-02-18'),
	(33, 3, 'bin', 0.00000, '2025-02-19'),
	(34, 3, 'htx', 168.88000, '2025-02-19'),
	(35, 6, 'bin', 0.00000, '2025-02-19'),
	(36, 6, 'htx', 9500.00000, '2025-02-19'),
	(37, 22, 'htx', 9500.00000, '2025-02-19'),
	(38, 3, 'bin', 0.00000, '2025-02-21'),
	(39, 3, 'bin', 0.00000, '2025-02-23'),
	(40, 3, 'htx', 169.66000, '2025-02-23'),
	(41, 6, 'bin', 0.00000, '2025-02-23'),
	(42, 26, 'htx', 127.96000, '2025-02-23'),
	(43, 27, 'htx', 167.30000, '2025-02-23'),
	(44, 28, 'htx', 6.00000, '2025-02-23'),
	(45, 29, 'htx', 7.00000, '2025-02-23'),
	(46, 30, 'htx', 8.00000, '2025-02-23'),
	(47, 31, 'htx', 9.00000, '2025-02-23'),
	(48, 3, 'bin', 0.00000, '2025-02-24'),
	(49, 3, 'htx', 159.66000, '2025-02-24'),
	(50, 6, 'bin', 0.00000, '2025-02-24'),
	(51, 26, 'htx', 127.96000, '2025-02-24'),
	(52, 3, 'bin', 0.00000, '2025-02-25'),
	(53, 3, 'htx', 157.93000, '2025-02-25'),
	(54, 6, 'bin', 0.00000, '2025-02-25'),
	(55, 26, 'htx', 276.41000, '2025-02-25'),
	(56, 27, 'htx', 978.57000, '2025-02-25'),
	(57, 28, 'htx', 6.00000, '2025-02-25'),
	(58, 29, 'htx', 7.00000, '2025-02-25'),
	(59, 30, 'htx', 8.00000, '2025-02-25'),
	(60, 31, 'htx', 9.00000, '2025-02-25'),
	(61, 3, 'bin', 0.00000, '2025-03-04'),
	(62, 3, 'htx', 151.30000, '2025-03-04'),
	(63, 6, 'bin', 0.00000, '2025-03-04'),
	(64, 26, 'htx', 1000.92000, '2025-03-04'),
	(65, 27, 'htx', 965.77000, '2025-03-04'),
	(66, 28, 'htx', 66.00000, '2025-03-04'),
	(67, 29, 'htx', 7.00000, '2025-03-04'),
	(68, 30, 'htx', 8.00000, '2025-03-04'),
	(69, 31, 'htx', 9.00000, '2025-03-04'),
	(70, 3, 'bin', 0.00000, '2025-03-05'),
	(71, 3, 'htx', 146.98000, '2025-03-05'),
	(72, 6, 'bin', 0.00000, '2025-03-05'),
	(73, 26, 'htx', 994.25000, '2025-03-05'),
	(74, 27, 'htx', 955.81000, '2025-03-05'),
	(75, 28, 'htx', 66.00000, '2025-03-05'),
	(76, 29, 'htx', 7.00000, '2025-03-05'),
	(77, 30, 'htx', 8.00000, '2025-03-05'),
	(78, 31, 'htx', 9.00000, '2025-03-05'),
	(79, 3, 'bin', 0.00000, '2025-03-07'),
	(80, 3, 'htx', 144.34000, '2025-03-07'),
	(81, 6, 'bin', 0.00000, '2025-03-07'),
	(82, 26, 'htx', 994.25000, '2025-03-07'),
	(83, 27, 'htx', 955.81000, '2025-03-07'),
	(84, 28, 'htx', 66.00000, '2025-03-07'),
	(85, 29, 'htx', 7.00000, '2025-03-07'),
	(86, 30, 'htx', 8.00000, '2025-03-07'),
	(87, 31, 'htx', 9.00000, '2025-03-07'),
	(88, 3, 'bin', 0.00000, '2025-03-08'),
	(89, 3, 'htx', 140.65000, '2025-03-08'),
	(90, 6, 'bin', 0.00000, '2025-03-08'),
	(91, 26, 'htx', 994.25000, '2025-03-08'),
	(92, 27, 'htx', 955.81000, '2025-03-08'),
	(93, 28, 'htx', 66.00000, '2025-03-08'),
	(94, 29, 'htx', 7.00000, '2025-03-08'),
	(95, 30, 'htx', 8.00000, '2025-03-08'),
	(96, 31, 'htx', 9.00000, '2025-03-08'),
	(97, 3, 'bin', 0.00000, '2025-03-10'),
	(98, 3, 'htx', 138.10000, '2025-03-10'),
	(99, 6, 'bin', 0.00000, '2025-03-10'),
	(100, 26, 'htx', 994.25000, '2025-03-10'),
	(101, 27, 'htx', 955.81000, '2025-03-10'),
	(102, 28, 'htx', 66.00000, '2025-03-10'),
	(103, 29, 'htx', 7.00000, '2025-03-10'),
	(104, 3, 'bin', 0.00000, '2025-03-14'),
	(105, 3, 'htx', 136.74000, '2025-03-14'),
	(106, 6, 'bin', 0.00000, '2025-03-14'),
	(107, 26, 'htx', 994.25000, '2025-03-14'),
	(108, 27, 'htx', 955.81000, '2025-03-14'),
	(109, 28, 'htx', 66.00000, '2025-03-14'),
	(110, 29, 'htx', 7.00000, '2025-03-14'),
	(111, 30, 'htx', 8.00000, '2025-03-14'),
	(112, 31, 'htx', 9.00000, '2025-03-14');

-- Dumping structure for table ddk_db.tbl_notice
CREATE TABLE IF NOT EXISTS `tbl_notice` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_title` varchar(250) DEFAULT NULL COMMENT '알림 제목',
  `msg_content` text DEFAULT NULL COMMENT '알림 내용',
  `msg_type` varchar(50) DEFAULT NULL COMMENT '알림 타입 : all/agent/persion/  |  전체/에이전트/개인',
  `sender` varchar(150) DEFAULT NULL COMMENT '발송자 이름',
  `target` int(11) DEFAULT 0 COMMENT '대상',
  `create_date` varchar(150) DEFAULT NULL COMMENT '전송날자',
  PRIMARY KEY (`msg_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table ddk_db.tbl_notice: ~14 rows (approximately)
DELETE FROM `tbl_notice`;
INSERT INTO `tbl_notice` (`msg_id`, `msg_title`, `msg_content`, `msg_type`, `sender`, `target`, `create_date`) VALUES
	(1, '공지 테스트', '공지 테스트', 'all', 'admin', 0, '2024-03-20 19:33:26'),
	(2, '공지 테스트1', '공지 테스트1', 'persoin', 'admin', 3, '2024-03-20 19:48:11'),
	(3, '전체 공지', '전체 유저에게 보내는 공지', 'all', 'admin', 0, '2024-03-20 10:47:45'),
	(4, '전체 공지2', '전체 유저에게 보내는 공지2', 'all', 'admin', 0, '2024-03-20 11:00:51'),
	(5, '전체 공지2', '전체 유저에게 보내는 공지2', 'all', 'admin', 0, '2024-03-20 11:02:18'),
	(6, '전체 공지3', '전체 공지3', 'all', 'admin', 0, '2024-03-20 11:06:41'),
	(7, '전체 공지4', '전체 공지4', 'all', 'admin', 0, '2024-03-20 11:07:39'),
	(8, '개인공지1', '개인공지11111111111', 'persion', 'admin', 3, '2024-03-20 11:09:31'),
	(9, '에이전트 공지', '에이전트에게 보내는 공지사항', 'agent', 'admin', 0, '2024-03-20 11:10:18'),
	(10, '개인공지2', '개인공지2', 'persion', 'admin', 6, '2024-03-20 11:32:07'),
	(11, '코인 공지1', '개인 코인 공지1', 'persion', 'admin', 6, '2024-03-20 11:32:34'),
	(12, '공지12', '문제 발견, 잠시 대기중', 'persion', 'admin', 14, '2024-03-21 06:15:47'),
	(13, '공지13', '공지 확인1', 'persion', 'admin', 12, '2024-03-21 18:19:13'),
	(14, '공지001', '테이블 수정', 'all', 'admin', 0, '2024-03-24 15:02:29');

-- Dumping structure for table ddk_db.tbl_point_history
CREATE TABLE IF NOT EXISTS `tbl_point_history` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) NOT NULL DEFAULT 0 COMMENT '유저 유일번호',
  `paid_point` int(11) DEFAULT NULL COMMENT '지급된 포인트수량',
  `payer_name` varchar(150) DEFAULT NULL COMMENT '지급자 이름',
  `create_date` varchar(150) DEFAULT NULL COMMENT '지급일자',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='포인트 내역 테이블';

-- Dumping data for table ddk_db.tbl_point_history: ~9 rows (approximately)
DELETE FROM `tbl_point_history`;
INSERT INTO `tbl_point_history` (`pid`, `user_num`, `paid_point`, `payer_name`, `create_date`) VALUES
	(1, 7, 100000, 'admin', '2024-03-24 01:44:11'),
	(2, 9, 5000, 'admin', '2024-03-24 02:16:07'),
	(3, 11, 1500, 'admin', '2024-03-24 13:45:51'),
	(4, 16, 8000, 'admin', '2024-03-24 13:46:09'),
	(5, 9, 500, 'admin', '2024-03-24 13:46:20'),
	(6, 9, 2000, 'admin', '2024-03-24 13:46:32'),
	(7, 10, 500, 'admin', '2024-03-24 14:24:01'),
	(8, 15, 1000, 'admin', '2024-03-26 20:51:11'),
	(9, 6, 10000, 'admin', '2024-03-30 12:34:22');

-- Dumping structure for table ddk_db.tbl_profit_friend
CREATE TABLE IF NOT EXISTS `tbl_profit_friend` (
  `fid` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) DEFAULT 0 COMMENT '유저 번호',
  `my_profit` double(11,5) DEFAULT 0.00000 COMMENT '나의 수익(에이전트 수익)',
  `friend_num` bigint(20) DEFAULT 0 COMMENT '친구 번호',
  `friend_profit` double(11,5) DEFAULT 0.00000 COMMENT '친구 수익',
  `deduction` double(11,5) DEFAULT 0.00000 COMMENT '공제액',
  `final_amount` double(11,5) DEFAULT 0.00000 COMMENT '최종 금액',
  `market` varchar(50) DEFAULT NULL COMMENT '거래소 이름(bin, htx)',
  `create_date` varchar(150) DEFAULT NULL COMMENT '수익 일자',
  `convert_date` varchar(150) DEFAULT NULL COMMENT '포인트 전환 일자',
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='친구 수익 테이블';

-- Dumping data for table ddk_db.tbl_profit_friend: ~0 rows (approximately)
DELETE FROM `tbl_profit_friend`;

-- Dumping structure for table ddk_db.tbl_req_settle
CREATE TABLE IF NOT EXISTS `tbl_req_settle` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) DEFAULT 0 COMMENT '신청 유저번호',
  `settle_point` double(11,2) DEFAULT 0.00 COMMENT '정산 포인트',
  `settle_money` double(11,2) DEFAULT 0.00 COMMENT '정산 금액',
  `method` varchar(50) DEFAULT NULL COMMENT '정산 방법',
  `status` int(11) DEFAULT 0 COMMENT '정산 상태',
  `settle_txid` varchar(250) DEFAULT NULL COMMENT '입금 주소',
  `settle_bank` varchar(150) DEFAULT NULL COMMENT '기관명',
  `create_date` varchar(150) DEFAULT NULL COMMENT '정산 요청 일자',
  `comp_date` varchar(150) DEFAULT NULL COMMENT '정산 완료 일자',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='정산요청 테이블';

-- Dumping data for table ddk_db.tbl_req_settle: ~0 rows (approximately)
DELETE FROM `tbl_req_settle`;

-- Dumping structure for table ddk_db.tbl_server
CREATE TABLE IF NOT EXISTS `tbl_server` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `server_name` varchar(150) DEFAULT NULL COMMENT '서버 이름',
  `server_ip` varchar(150) DEFAULT NULL COMMENT '서버 주소',
  `cpu_count` int(11) DEFAULT 0,
  `cpu_size` varchar(150) DEFAULT '0',
  `cpu_rate` varchar(150) DEFAULT '0',
  `ram_size` varchar(150) DEFAULT '0',
  `ram_rate` varchar(150) DEFAULT '0',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='서버 테이블';

-- Dumping data for table ddk_db.tbl_server: ~3 rows (approximately)
DELETE FROM `tbl_server`;
INSERT INTO `tbl_server` (`sid`, `server_name`, `server_ip`, `cpu_count`, `cpu_size`, `cpu_rate`, `ram_size`, `ram_rate`) VALUES
	(1, 'watcher1', '13.114.141.159', 1, '2.44', '0', '1.9', '26'),
	(2, 'maker', '54.238.182.166', 1, '2.44', '1', '7.7', '7'),
	(3, 'watcher2', '13.231.202.91', 1, '2.44', '1', '3.8', '54');

-- Dumping structure for table ddk_db.tbl_trade_coin_day
CREATE TABLE IF NOT EXISTS `tbl_trade_coin_day` (
  `cid` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) NOT NULL DEFAULT 0 COMMENT '유저 유일번호',
  `market` varchar(50) NOT NULL COMMENT '거래소 이름(bin, htx)',
  `symbol` varchar(50) NOT NULL COMMENT '거래 코인 명',
  `hold_money` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '보유금액',
  `real_money` double(10,6) NOT NULL DEFAULT 0.000000 COMMENT '실 수익금액',
  `create_date` varchar(150) NOT NULL COMMENT '체결 일자',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='일별 코인 주문수익 테이블';

-- Dumping data for table ddk_db.tbl_trade_coin_day: ~0 rows (approximately)
DELETE FROM `tbl_trade_coin_day`;

-- Dumping structure for table ddk_db.tbl_trade_day
CREATE TABLE IF NOT EXISTS `tbl_trade_day` (
  `tid` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) NOT NULL DEFAULT 0 COMMENT '유저 유일번호',
  `market` varchar(50) NOT NULL COMMENT '거래소 이름(bin, htx)',
  `hold_money` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '보유금액',
  `profit_money` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '수익금액',
  `fee_money` double(10,6) NOT NULL DEFAULT 0.000000 COMMENT '앱 수수료 금액',
  `agent_num` bigint(20) NOT NULL DEFAULT 0 COMMENT '에이전트 번호',
  `agent_rate` int(11) NOT NULL DEFAULT 0 COMMENT '에이전트 수수료%',
  `agent_money` double(10,6) NOT NULL DEFAULT 0.000000 COMMENT '에이전트에게 상납할 금액',
  `real_money` double(10,6) NOT NULL DEFAULT 0.000000 COMMENT '실 수익금액',
  `level_discount` int(11) NOT NULL DEFAULT 0 COMMENT '레벨 할인율',
  `create_date` varchar(150) NOT NULL COMMENT '체결 일자',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='일별 사용자 주문수익 테이블';

-- Dumping data for table ddk_db.tbl_trade_day: ~0 rows (approximately)
DELETE FROM `tbl_trade_day`;

-- Dumping structure for table ddk_db.tbl_trade_order
CREATE TABLE IF NOT EXISTS `tbl_trade_order` (
  `user_num` bigint(20) NOT NULL DEFAULT 0 COMMENT '유저 유일번호',
  `order_num` varchar(50) NOT NULL COMMENT '주문번호',
  `tp_id` varchar(50) NOT NULL DEFAULT '',
  `sl_id` varchar(50) NOT NULL DEFAULT '',
  `side` varchar(50) NOT NULL DEFAULT 'sell' COMMENT 'B(buy), S(sell)',
  `idx` tinyint(4) NOT NULL DEFAULT 1 COMMENT '매매 차수 번호',
  `coin_num` int(11) NOT NULL DEFAULT 0 COMMENT '주문코인 번호(fix_coins의 coin_id)',
  `symbol` varchar(50) NOT NULL DEFAULT '' COMMENT '주문코인 이름',
  `market` varchar(50) NOT NULL DEFAULT 'bin' COMMENT '거래소 이름(bin, htx)',
  `leverage` int(11) NOT NULL DEFAULT 0 COMMENT '레버리지',
  `bet_limit` int(11) NOT NULL DEFAULT 200 COMMENT '1회 최대 거래금액',
  `rate_rev` float NOT NULL DEFAULT 0.6 COMMENT '거래 당 수익 범위',
  `rate_liq` float NOT NULL DEFAULT 3.5 COMMENT '거래 당 청산 범위',
  `live_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '주문실행상태(0 : close, 1 : live, 2 : l-stop, 3 : s-break, 4 : l-stop and s-break)',
  `order_position` tinyint(4) NOT NULL DEFAULT 0 COMMENT '주문체결상태(0 : 미체결, 1 : 체결, 2: 청산)',
  `hold_money` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '보유금액',
  `order_volume` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '주문수량',
  `order_money` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '주문금액',
  `order_price` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '주문가격',
  `tp_price` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '수익가격',
  `sl_price` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '손해가격',
  `tp_trigger_price` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '수익 트리거 가격',
  `sl_trigger_price` double(20,6) NOT NULL DEFAULT 0.000000 COMMENT '손해 트리거 가격',
  `make_money` varchar(50) NOT NULL DEFAULT '0' COMMENT '체결금액',
  `make_price` varchar(50) NOT NULL DEFAULT '0' COMMENT '체결가격',
  `profit_money` varchar(50) NOT NULL DEFAULT '0' COMMENT '수익금액',
  `fee_rate` int(11) NOT NULL DEFAULT 0 COMMENT '앱 수수료%',
  `fee_money` varchar(50) NOT NULL DEFAULT '0' COMMENT '앱 수수료 금액',
  `coupon` int(11) NOT NULL DEFAULT 0 COMMENT '쿠폰잔액',
  `order_date` varchar(150) NOT NULL DEFAULT '' COMMENT '주문 오픈 일자',
  `pos_date` varchar(150) NOT NULL DEFAULT '' COMMENT '주문 체결 일자',
  `make_date` varchar(150) NOT NULL DEFAULT '' COMMENT '청산 완료 일자',
  UNIQUE KEY `order_num` (`order_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='코인별 거래 주문 내역 테이블';

-- Dumping data for table ddk_db.tbl_trade_order: ~0 rows (approximately)
DELETE FROM `tbl_trade_order`;

-- Dumping structure for table ddk_db.tbl_trade_setting
CREATE TABLE IF NOT EXISTS `tbl_trade_setting` (
  `tid` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) DEFAULT NULL COMMENT '유저 번호',
  `market` varchar(50) DEFAULT NULL COMMENT '거래소 이름(bin, htx)',
  `trade_money_id` int(11) DEFAULT 1 COMMENT '1회 최대 거래 금액 번호',
  `leverage_id` int(11) DEFAULT 3 COMMENT '거래 레버리지 번호',
  `profit_range_id` int(11) DEFAULT 1 COMMENT '거래당 수익 범위 번호',
  `liquidation_range_id` int(11) DEFAULT 1 COMMENT '거래당 청산 범위 번호',
  `check_time` int(11) DEFAULT 6 COMMENT '자동확인 시간',
  `update_date` varchar(150) DEFAULT NULL COMMENT '수정일자',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- Dumping data for table ddk_db.tbl_trade_setting: ~20 rows (approximately)
DELETE FROM `tbl_trade_setting`;
INSERT INTO `tbl_trade_setting` (`tid`, `user_num`, `market`, `trade_money_id`, `leverage_id`, `profit_range_id`, `liquidation_range_id`, `check_time`, `update_date`) VALUES
	(1, 3, 'htx', 1, 10, 2, 1, 1, '2025-03-07 23:29:03'),
	(20, 24, 'htx', 1, 6, 1, 25, 2, '2025-01-22 16:36:57'),
	(21, 25, 'htx', 1, 3, 1, 1, 6, '2025-01-15 19:18:32'),
	(22, 25, 'bin', 1, 3, 1, 1, 6, '2025-01-15 19:18:32'),
	(23, 26, 'htx', 1, 10, 1, 23, 1, '2025-02-07 12:01:56'),
	(24, 26, 'bin', 1, 3, 1, 1, 6, '2025-01-15 19:19:11'),
	(25, 27, 'htx', 1, 3, 1, 1, 6, '2025-01-15 19:34:51'),
	(26, 27, 'bin', 1, 3, 1, 1, 6, '2025-01-15 19:34:51'),
	(27, 28, 'htx', 1, 3, 1, 1, 6, '2025-01-15 19:35:27'),
	(28, 28, 'bin', 1, 3, 1, 1, 6, '2025-01-15 19:35:27'),
	(29, 29, 'htx', 1, 3, 1, 1, 6, '2025-01-17 16:53:26'),
	(30, 29, 'bin', 1, 3, 1, 1, 6, '2025-01-17 16:53:26'),
	(31, 30, 'htx', 1, 3, 1, 1, 6, '2025-01-17 16:54:06'),
	(32, 30, 'bin', 1, 3, 1, 1, 6, '2025-01-17 16:54:06'),
	(33, 31, 'htx', 1, 3, 1, 1, 6, '2025-01-17 16:54:36'),
	(34, 31, 'bin', 1, 3, 1, 1, 6, '2025-01-17 16:54:36'),
	(35, 22, 'htx', 1, 10, 1, 3, 1, '2025-02-07 08:08:02'),
	(36, 21, 'htx', 1, 3, 1, 1, 6, '2025-01-29 13:36:39'),
	(37, 32, 'htx', 1, 3, 1, 1, 6, '2025-02-05 11:04:38'),
	(38, 32, 'bin', 1, 3, 1, 1, 6, '2025-02-05 11:04:38');

-- Dumping structure for table ddk_db.tbl_user_friend
CREATE TABLE IF NOT EXISTS `tbl_user_friend` (
  `fid` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) DEFAULT NULL COMMENT '유저 유일번호',
  `friend_phone` varchar(150) DEFAULT NULL COMMENT '친구전화번호',
  `friend_num` bigint(20) DEFAULT NULL COMMENT '친구 유저 번호',
  `friend_fee` int(11) DEFAULT 0 COMMENT '친구 수수료',
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='친구 정보 테이블';

-- Dumping data for table ddk_db.tbl_user_friend: ~1 rows (approximately)
DELETE FROM `tbl_user_friend`;
INSERT INTO `tbl_user_friend` (`fid`, `user_num`, `friend_phone`, `friend_num`, `friend_fee`) VALUES
	(1, 6, '111222', 7, 25);

-- Dumping structure for table ddk_db.tbl_user_info
CREATE TABLE IF NOT EXISTS `tbl_user_info` (
  `num` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '유저 유일번호',
  `name` varchar(150) NOT NULL COMMENT '유저 이름',
  `id` varchar(250) NOT NULL COMMENT '유저 아이디 (이메일)',
  `password` varchar(250) NOT NULL COMMENT '비밀번호',
  `phone` varchar(250) NOT NULL COMMENT '유저 전화번호',
  `actived` tinyint(4) NOT NULL DEFAULT 0 COMMENT '유저 액티브상태',
  `enabled` tinyint(4) NOT NULL DEFAULT 0 COMMENT '거래중인 유저상태(0 : 미거래, 1 : 거래중)',
  `agent_num` int(11) NOT NULL DEFAULT 0 COMMENT '추천한 에이전트 번호(유저번호)',
  `agentable` tinyint(4) NOT NULL DEFAULT 0 COMMENT '에이전트 상태(1:에이전트, 0: 에이전트 아님)',
  `level` int(11) NOT NULL DEFAULT 1 COMMENT '유저 레벨',
  `my_fee` int(11) NOT NULL DEFAULT 0 COMMENT '나의 수수료(%)',
  `agent_fee` int(11) NOT NULL DEFAULT 0 COMMENT '에이전트에게 상납할 수수료(%)',
  `coupon` double(11,5) NOT NULL DEFAULT 0.00000 COMMENT '보유한 쿠폰금액',
  `point` int(11) NOT NULL DEFAULT 0 COMMENT '보유한 포인트 수량',
  `permission` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 : 관리자, 0 : 사용자',
  `login_date` timestamp NULL DEFAULT NULL COMMENT '로그인된 일자',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='유저정보 테이블';

-- Dumping data for table ddk_db.tbl_user_info: ~13 rows (approximately)
DELETE FROM `tbl_user_info`;
INSERT INTO `tbl_user_info` (`num`, `name`, `id`, `password`, `phone`, `actived`, `enabled`, `agent_num`, `agentable`, `level`, `my_fee`, `agent_fee`, `coupon`, `point`, `permission`, `login_date`, `create_date`, `update_date`) VALUES
	(1, 'admin', 'admin@gmail.com', '$2y$10$G2WUXyTscHXnC92Whr8sWOsXPDorPVxXOAAhgGbtFCRV6RIBblb0u', '01022223333', 1, 0, 0, 0, 9, 0, 0, 0.00000, 0, 1, '2025-03-14 15:22:24', '2024-03-15 17:26:26', '2024-03-18 06:20:15'),
	(3, 'sunstar', 'sunstart1102@163.com', '$2y$10$NbcOTNERReVkDc39Rwhc1eu1nWsXREm239kzWcziYDWTubKrZWvnu', '01013225475', 1, 1, 0, 0, 2, 25, 0, 0.00000, 0, 0, '2025-03-14 15:20:55', '2024-03-15 17:31:39', '2024-05-09 18:46:27'),
	(6, 'webdev', 'webdev12345@163.com', '$2y$10$TE587A/WXSQEgCro9WUp/u8LFpZCi/Sl2p/9hi4WD56YYjB3MTs8y', '01012223222', 1, 1, 0, 0, 5, 20, 0, 0.00000, 10000, 0, '2024-11-01 12:44:41', '2024-03-17 18:11:14', '2024-05-09 17:00:20'),
	(21, 'tester2', 'test002', '$2y$10$qv19f1/djS7Tyq2LRBmBJu3v1MCvbdK2tfo1W1TTH6d/eSOoSmL2e', '111', 1, 1, 0, 0, 5, 15, 0, 0.00000, 0, 0, '2025-01-29 14:04:14', '2024-06-28 18:25:05', '2024-06-28 18:30:24'),
	(22, 'tester1', 'test001', '$2y$10$XmM8IkNafLnZ.Tt/NwsiXeJ7qShRXvco3aH24K.W87AR0uJG1N76K', '546', 1, 1, 0, 0, 5, 15, 0, 0.00000, 0, 0, '2025-02-05 18:30:38', '2024-06-28 18:34:01', NULL),
	(24, 'live', 'liveacc', '$2y$10$1/dBO8A7P2mOrmz/hXaLiOVHwS4UZ7pdMse3twj3edc4x3Ew1qGgy', '11112223', 1, 1, 0, 0, 5, 15, 0, 0.00000, 0, 0, '2025-01-21 21:35:25', '2024-11-01 08:05:00', '2024-11-01 13:22:29'),
	(26, 't4', 'test004', '$2y$10$o4T/3yVsuIXnfdMBVrd.F.yjnzj4DmlNDW62u09RM6t0iSK4VmNsa', '1', 1, 0, 0, 0, 5, 10, 0, 0.00000, 0, 0, '2025-02-07 12:07:08', '2025-01-15 19:19:11', '2025-01-18 19:47:55'),
	(27, 't5', 'test005', '$2y$10$XOaArvWlOUtPBRUoUIAkEeVxqoRfm8YSH0D5wsc51PqG1m4ARegCK', '1', 1, 0, 0, 0, 5, 10, 0, 0.00000, 0, 0, '2025-01-19 10:39:43', '2025-01-15 19:34:51', '2025-01-17 16:49:08'),
	(28, 't6', 'test006', '$2y$10$PiNd4ydITPJq41IzTM4V9.9rvu2BQsf9vepJUG8vjzIWgTF3ZSAT.', '1', 1, 0, 0, 0, 5, 10, 0, 0.00000, 0, 0, '2025-01-21 20:49:11', '2025-01-15 19:35:27', '2025-01-17 16:49:29'),
	(29, 't7', 'test007', '$2y$10$gkeVGRV1rKvwF8Y9QqUCi.scEzIF9PJjBCGu.cFehvhouzzo4O9SC', '333', 1, 0, 0, 0, 5, 10, 0, 0.00000, 0, 0, '2025-01-21 20:50:34', '2025-01-17 16:53:26', NULL),
	(30, 't8', 'test008', '$2y$10$8lblQ6KSrqxFBxRiqQZgiOxSsmmioYoQVwgUf6qA8av9/9o.Vgpoq', '234', 1, 0, 0, 0, 5, 10, 0, 0.00000, 0, 0, '2025-01-21 21:27:35', '2025-01-17 16:54:06', NULL),
	(31, 't9', 'test009', '$2y$10$cBW4RjANDbxQerW69lCHHumOdIClsew0UHJdAXg2jnxCTcsdCba1O', '564', 1, 0, 0, 0, 5, 10, 0, 0.00000, 0, 0, '2025-01-21 21:29:25', '2025-01-17 16:54:36', NULL),
	(32, 'dayi', 'dayi', '$2y$10$ekZ44D4s4ublZnsWSEsCPuyufOjr/Tqv8W59kmjgIcG7J5I9xv4Ju', '123123', 1, 0, 0, 0, 1, 15, 0, 0.00000, 0, 0, NULL, '2025-02-05 11:04:38', NULL);

-- Dumping structure for table ddk_db.tbl_user_log
CREATE TABLE IF NOT EXISTS `tbl_user_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_num` bigint(20) DEFAULT NULL COMMENT '유저 유일번호',
  `edit_field` varchar(50) DEFAULT NULL COMMENT '수정한 마당이름',
  `edit_val` varchar(250) DEFAULT NULL COMMENT '수정한 값',
  `edit_admin` varchar(250) DEFAULT NULL COMMENT '수정한 관리자 아이디',
  `log_date` varchar(150) DEFAULT NULL COMMENT '수정날자',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='유저정보 수정 로그';

-- Dumping data for table ddk_db.tbl_user_log: ~51 rows (approximately)
DELETE FROM `tbl_user_log`;
INSERT INTO `tbl_user_log` (`id`, `user_num`, `edit_field`, `edit_val`, `edit_admin`, `log_date`) VALUES
	(1, 6, 'name', 'webdev', 'admin@gmail.com', '2024-03-18 15:57:12'),
	(2, 6, 'level', '1', 'admin@gmail.com', '2024-03-18 15:57:12'),
	(3, 6, 'my_fee', '20', 'admin@gmail.com', '2024-03-18 15:57:12'),
	(4, 10, 'Active', '0', 'admin@gmail.com', '2024-03-21 00:15:49'),
	(5, 9, 'Active', '0', 'admin@gmail.com', '2024-03-21 00:16:18'),
	(6, 10, 'Active', '1', 'admin@gmail.com', '2024-03-21 00:16:19'),
	(7, 9, 'Active', '1', 'admin@gmail.com', '2024-03-21 00:16:21'),
	(8, 15, 'Active', '0', 'admin@gmail.com', '2024-03-21 17:18:59'),
	(9, 16, 'Active', '0', 'admin@gmail.com', '2024-03-21 17:19:00'),
	(10, 16, 'Active', '1', 'admin@gmail.com', '2024-03-21 17:19:01'),
	(11, 15, 'Active', '1', 'admin@gmail.com', '2024-03-21 17:19:01'),
	(12, 7, 'actived', '0', 'admin@gmail.com', '2024-03-21 17:37:17'),
	(13, 15, 'Active', '0', 'admin@gmail.com', '2024-03-22 23:05:06'),
	(14, 15, 'level', '8', 'admin@gmail.com', '2024-03-23 17:54:28'),
	(15, 15, 'Active', '1', 'admin@gmail.com', '2024-03-23 17:54:34'),
	(16, 14, 'actived', '0', 'admin@gmail.com', '2024-03-23 17:54:47'),
	(17, 14, 'Active', '1', 'admin@gmail.com', '2024-03-23 17:54:51'),
	(18, 14, 'actived', '0', 'admin@gmail.com', '2024-03-23 17:55:13'),
	(19, 14, 'level', '8', 'admin@gmail.com', '2024-03-23 17:55:13'),
	(20, 14, 'Active', '1', 'admin@gmail.com', '2024-03-23 17:55:17'),
	(21, 7, 'level', '8', 'admin@gmail.com', '2024-03-24 15:01:32'),
	(22, 7, 'Active', '1', 'admin@gmail.com', '2024-03-24 15:01:35'),
	(23, 6, 'actived', '0', 'admin@gmail.com', NULL),
	(24, 6, 'level', '5', 'admin@gmail.com', NULL),
	(25, 6, 'Active', '1', 'admin@gmail.com', '2024-05-09 17:00:49'),
	(26, 3, 'actived', '0', 'admin@gmail.com', NULL),
	(27, 3, 'level', '4', 'admin@gmail.com', NULL),
	(28, 3, 'Active', '1', 'admin@gmail.com', '2024-05-09 18:26:08'),
	(29, 3, 'actived', '0', 'admin@gmail.com', NULL),
	(30, 3, 'level', '3', 'admin@gmail.com', NULL),
	(31, 3, 'Active', '1', 'admin@gmail.com', '2024-05-09 18:27:28'),
	(32, 3, 'actived', '0', 'admin@gmail.com', NULL),
	(33, 3, 'level', '2', 'admin@gmail.com', NULL),
	(34, 3, 'Active', '1', 'admin@gmail.com', '2024-05-09 18:46:29'),
	(35, 21, 'actived', '0', 'admin@gmail.com', NULL),
	(36, 21, 'level', '5', 'admin@gmail.com', NULL),
	(37, 21, 'Active', '1', 'admin@gmail.com', '2024-06-28 18:30:26'),
	(38, 24, 'actived', '0', 'admin@gmail.com', NULL),
	(39, 24, 'level', '5', 'admin@gmail.com', NULL),
	(40, 24, 'Active', '1', 'admin@gmail.com', '2024-11-01 13:22:32'),
	(41, 26, 'name', 't4', 'admin@gmail.com', NULL),
	(42, 26, 'actived', '0', 'admin@gmail.com', NULL),
	(43, 27, 'name', 't5', 'admin@gmail.com', NULL),
	(44, 27, 'actived', '0', 'admin@gmail.com', NULL),
	(45, 26, 'Active', '1', 'admin@gmail.com', '2025-01-17 16:49:15'),
	(46, 27, 'Active', '1', 'admin@gmail.com', '2025-01-17 16:49:16'),
	(47, 28, 'name', 't6', 'admin@gmail.com', NULL),
	(48, 28, 'actived', '0', 'admin@gmail.com', NULL),
	(49, 28, 'Active', '1', 'admin@gmail.com', '2025-01-17 16:49:37'),
	(50, 26, 'actived', '0', 'admin@gmail.com', NULL),
	(51, 26, 'Active', '1', 'admin@gmail.com', '2025-01-18 19:48:00');

-- Dumping structure for table ddk_db.tbl_web_setting
CREATE TABLE IF NOT EXISTS `tbl_web_setting` (
  `show_count` int(11) DEFAULT 10,
  `show_language` varchar(50) DEFAULT 'ko'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ddk_db.tbl_web_setting: ~0 rows (approximately)
DELETE FROM `tbl_web_setting`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
