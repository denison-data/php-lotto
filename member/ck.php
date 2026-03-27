<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
$dbc = dbOpen();
$mode = $_GET['mode'];
switch($mode){
	case "mem_logins"	:	function_memck();	break; /*회원가입후 로그인처리*/
}
function function_memck()
{
	global $dbc,$sms_id, $sms_key, $sms_send_phone, $send_date;
	$req = "/data/www/lotto/";
	include($req."admin/inc/sms/api.class.php");
	$api = new gabiaSmsApi($sms_id, $sms_key);

	$code = $_GET['code'];
	$mtype = $_GET['mtype'];
	$que = "
	Select * from member Where 1=1 And code in ('$code') 
	";
	
	$data= dbQuery($que, $dbc);
	$total = mysqli_num_rows();
	if($total==0){ echo "<script></script>인증 에러";} else {
		$row = mysqli_fetch_array($data);
		if($row['grade']=="i"){
			$upq = "
			Update member set grade = 'n' Where code in ('$code')
			";
			dbQuery($upq,$dbc);

			$sms_titles = "
			Select * from 
			lumieyes_lotto_intra.sms_send_txt
			Where sms_name in ('회원가입')
			";
			$sdata = dbQuery($sms_titles,$dbc);
			$srows = mysqli_fetch_array($sdata);
			$sms_title	=	$srows['sms_title'];
			$sms_txt	=	$srows['sms_txt'];
			$sms_txt = str_replace("Seq",$seq,$sms_txt);

			$codes= getCode(6);
			$p = $row['tel'];
			$message = str_replace("Name",$row['nickname'],$sms_txt);

			$r = $api->lms_send($p, $sms_send_phone, $message, $sms_title, $codes, $send_date);
			if($mtype=="m"){
				echo "<script>alert('인증되었습니다.');top.location.href=\"/m/\";</script>";
			} else {
				echo "<script>alert('인증되었습니다.');top.location.href=\"/\";</script>";
			}
		} else {
			if($mtype=="m"){
				echo "<script>alert('이미 인증 받았습니다.');top.location.href=\"/m/\";</script>";

			} else {
				echo "<script>alert('이미 인증 받았습니다.');top.location.href=\"/\";</script>";
			}
		}	
		
	}

}

?>