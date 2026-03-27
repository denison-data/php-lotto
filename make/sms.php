<?
set_time_limit(0);
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
$dbc = dbOpen();
$seq = getCurSeq()+10; //현재회차에서 1플러스
$tb = getBuyTbName($seq);
$sms_tb = "sms_".$tb;
$dbc_sms = dbOpen("smsdb");
$que_sms	=	"SHOW TABLES";
$res = dbQuery($que_sms, $dbc_sms);
$recommend_table_exist = false;
while($row = mysqli_fetch_row($res)) {
	if ($row[0] == $sms_tb) {
		$recommend_table_exist = true;
	}
}
if (!$recommend_table_exist) {
	$que = "
	CREATE TABLE `{$sms_tb}` (
		`uid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		`uuid` CHAR(15) NOT NULL,
		`code` varchar(5) NOT NULL,
		`seq` INT(10) UNSIGNED NOT NULL,
		`b1` TINYINT(3) UNSIGNED NOT NULL,
		`b2` TINYINT(3) UNSIGNED NOT NULL,
		`b3` TINYINT(3) UNSIGNED NOT NULL,
		`b4` TINYINT(3) UNSIGNED NOT NULL,
		`b5` TINYINT(3) UNSIGNED NOT NULL,
		`b6` TINYINT(3) UNSIGNED NOT NULL,
		`rank` TINYINT(3) UNSIGNED NOT NULL,
		`type` CHAR(1) DEFAULT NULL,
		`reg_datetime` DATETIME DEFAULT NULL,
		`sms` char(1) DEFAULT 'n' COMMENT '발송여부',
		`tel` varchar(30) NOT NULL COMMENT '전화번호',
		PRIMARY KEY (`uid`),
		KEY `uuid` (`uuid`),
		KEY `seq` (`seq`)
		) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
	";
	dbQuery($que, $dbc_sms);
}
exit;
?>