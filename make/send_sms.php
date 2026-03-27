<?
set_time_limit(0);
//include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
$req = "/data/www/lotto/";
include($req."admin/inc/func/common_sms.php");
include($req."admin/inc/sms/api.class.php");
/*
$sms_id = "mrlotto";
$sms_key = "9ab5307363d1c10c500d0b5f57bb9bc2";
*/

$api = new gabiaSmsApi($sms_id, $sms_key);

$phone = array("01032022604");
$w = date("w");
$peroid = 36;

/*
if($w<=3){
	$sdate = date("Ymd",strtotime("Thursday"));	
	$edate = date("Ymd",strtotime("$peroid month"));
} else {
	$sdate = date("Ymd",strtotime("next week Thursday"));
	$edate = date("Ymd",strtotime("$peroid month"));
}*/
$his_end_date = "20190919";

$sdate = date("Ymd",strtotime ("1 days", strtotime($his_end_date))); 

//$edate = date("Ymd",strtotime("1 month"));


$send_phone = "1811-7335"; //회신번호
$sms_title = "로또 추천 번호 조합 안내입니다.";
$sms_txt = "마아아안.!!~";
$send_date = "0";//즉시발송
foreach($phone as $p){
	$code= getCode(6);
	$r = $api->lms_send($p, $send_phone, $sms_txt, $sms_title, $code, $send_date);
	if ($r == gabiaSmsApi::$RESULT_OK)
	{
		echo($p . " : " . $api->getResultMessage() . "<br>");
		echo("이전 : " . $api->getBefore() . "<br>");
		echo("이후 : " . $api->getAfter() . "<br>");
	}
	else {
		echo("error : " . $p . " - " . $api->getResultCode() . " - " . $api->getResultMessage() . "<br>");
	}
	$result = $api->get_status_by_ref($code);
	echo "<br>";
	echo "CODE : ".$result["CODE"]."\n<br>";
	echo "MESG : ".$result["MESG"];
}


?>