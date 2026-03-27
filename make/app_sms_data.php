<?
set_time_limit(0);
$req = "/data/www/lotto/";
include($req."admin/inc/func/common_sms.php");
include($req."admin/inc/sms/api.class.php");

$mem_arr = array("01095350535");
exit;
//$mem_arr = array("01032022604",'01022340596');
$api = new gabiaSmsApi($sms_id, $sms_key);
	$send_phone = "1811-7335"; //회신번호
	$sms_title = "로또 추천 번호 조합 안내입니다.";
$sms_txt = "안녕하세요 이ㅁㅁ 고객님
미스터로또씨가 드리는 842회차 로또 추천 번호 조합입니다.
[3,4,9,20,38,40]
[12,21,22,26,27,31]
[7,15,23,25,29,34]
[6,8,17,28,30,33]
[1,13,16,19,39,42]

[14,18,24,37,44,45]
[2,5,10,11,35,36]
[14,26,32,36,39,42]
[2,9,10,27,35,41]
[4,14,15,16,29,43]

[2,3,15,34,39,40]
[6,11,12,21,24,33]
[10,13,17,31,32,42]
[22,23,29,35,36,43]
[4,14,20,25,26,37]

[5,9,27,28,44,45]
[1,8,16,18,30,41]
[6,15,16,18,22,38]
[5,7,14,19,26,32]
[10,12,17,28,31,44]


자동은 절대 답이 될 수 없습니다.
미스터로또씨를 믿고 이용해주셔서 감사드리며,
회원님이 1등이 되는 그날까지 항상 노력하겠습니다.
행운이란 준비와 기회를 만났을 때 나타난다고 합니다.

고객님의 1등을 위해 미스터로또씨가 최선을 다하겠습니다.

궁금하신 점은 고객센터로 문의해주세요.

미스터로또씨 운영시간
월 ~ 금 : 09:30 ~ 18:30 (점심시간 : 12:30 ~ 13:30)
홈페이지 : http://www.mrlottoc.co.kr
아이디 : [휴대폰 번호] 비밀번호 : [기존 비밀 번호]
[상담/고객만족센터 : 1811-7335]
[무료 수신 거부 : 080-005-4370 인증(21477)]
";

	$send_date = "0";//즉시발송
	foreach($mem_arr as $p){
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