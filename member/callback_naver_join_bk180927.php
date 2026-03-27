<?php
session_start();

include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head.html');
$dbc = dbOpen();
/*네이버 콜백*/
 
if ($_SESSION['naver_state'] != $_GET['state']) {
  // 오류가 발생하였습니다. 잘못된 경로로 접근 하신것 같습니다.
}

 /*네아로 토큰 삭제
$naver_curl = "https://nid.naver.com/oauth2.0/token?grant_type=delete&client_id=".NCI."&client_secret=".NCS."&access_token=".urlencode($mb['mb_sns_token'])."&service_provider=NAVER";
$is_post = false;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $naver_curl);
curl_setopt($ch, CURLOPT_POST, $is_post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close ($ch);
*/


$naver_curl = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".NCI."&client_secret=".NCS."&redirect_uri=".urlencode(NCU)."&code=".$_GET['code']."&state=".$_GET['state'];
 
 //https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=CLIENT_ID&state=STATE_STRING&redirect_uri=CALLBACK_URL&auth_type=reauthenticate
//https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=jyvqXeaVOVmV&client_secret=527300A0_COq1_XV33cf&code=EIc5bFrl4RibFls1&state=9kgsGTfH4j7IyAkg
// 토큰값 가져오기
$is_post = false;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $naver_curl);
curl_setopt($ch, CURLOPT_POST, $is_post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close ($ch);
if($status_code == 200) {
	$responseArr = json_decode($response, true);

	$_SESSION['naver_access_token'] = $responseArr['access_token'];
	$_SESSION['naver_refresh_token'] = $responseArr['refresh_token'];

	// 토큰값으로 네이버 회원정보 가져오기
	$me_headers = array(
		'Content-Type: application/json',
		sprintf('Authorization: Bearer %s', $responseArr['access_token'])
	);
	$me_is_post = false;
	$me_ch = curl_init();
	curl_setopt($me_ch, CURLOPT_URL, "https://openapi.naver.com/v1/nid/me");
	curl_setopt($me_ch, CURLOPT_POST, $me_is_post);
	curl_setopt($me_ch, CURLOPT_HTTPHEADER, $me_headers);
	curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true);
	$me_response = curl_exec($me_ch);
	$me_status_code = curl_getinfo($me_ch, CURLINFO_HTTP_CODE);
	curl_close ($me_ch);

	$me_responseArr = json_decode($me_response, true);

	$mb_nickname = $me_responseArr['response']['nickname']; // 닉네임
	$mb_email = $me_responseArr['response']['email']; // 이메일
	$mb_gender = $me_responseArr['response']['gender']; // 성별 F: 여성, M: 남성, U: 확인불가
	$mb_age = $me_responseArr['response']['age']; // 연령대
	$mb_birthday = $me_responseArr['response']['birthday']; // 생일(MM-DD 형식)
	$mb_profile_image = $me_responseArr['response']['profile_image']; // 프로필 이미지

	if ($me_responseArr['response']['id']) {
		// 회원아이디(naver_ 접두사에 네이버 아이디를 붙여줌)
		$mb_uid = 'naver_'.$me_responseArr['response']['id'];
		// 회원가입 DB에서 회원이 있으면(이미 가입되어 있다면) 토큰을 업데이트 하고 로그인함

		if(!$mb_email){
			$dv = "naver_noemail";
		} else {
			$m_que = "Select Count(*) from member Where 1=1 And email in ('$mb_email')";
			$mDs = dbQuery($m_que, $dbc);
			$mct = mysql_result($mDs,	0,	0);

			if ($mct==0) {
				$dv = "naver_ins";
			} else {
				$dv = "naver_ups";
				
			}
		}
	} else {
		// 회원정보를 가져오지 못했습니다.
		$dv = "naver_noinfo";
		//echo "정보 못가져옴";
	}
 
} else {
	$dv = "naver_notoken";
	//echo "토큰값 못가져옴";
  // 토큰값을 가져오지 못했습니다.
}
echo $dv;
?>
<style>
	.join_contents {width:650px;margin:0 auto}
	.join_contents h1 {font-size:26px;padding-bottom:20px; font-weight:400}
	.join_contents .join_pri {border:4px solid #d9d9d9;margin-top:30px;font-size:15px}
	.join_contents .join_pri button {width:100px; height:25px;background-color:#8d8d8d;border:none; border-radius: 4px;color:#fff; font-size:13px}
	.join_contents .join_pri .join_pri_border {border:1px solid #d9d9d9; border-right:none; border-left:none}
	.join_contents .join_pri div {padding:15px 52px; overflow: hidden;}
	.join_contents .join_pri div button {float:right}
	.join_contents .join_pri div span {color:red; font-size:13px;padding-left:5px; font-weight:400}	
	.join_pri_all_bt {text-align: center; font-size:18px; font-wieght:400; line-height: 38px; margin-top:10px}
	
	.join_form {background-color: #f8f8f8}
	.join_form input {width:382px; height:46px; border:1px solid #d9d9d9;padding-left:10px;font-size:13px}
	.join_form input.email {width:160px; }
	.join_form select {width:197px; height:46px;border:1px solid #d9d9d9;padding-left:10px;font-size:13px;background-color:#fff}
	#join_form {padding:50px 52px 65px 52px}
	#join_form span {color:red; font-size:13px;padding-left:5px; font-weight:400}	
	#join_form tr td:first-child {font-weight:400}
	
	.join_ok_button {text-align:center; margin-top:30px}
	.join_ok_button button {cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);width:193px; height:50px;border-radius: 4px;color:#fff;font-size:20px;font-weight: 400;border:none}

select{
-moz-appearance:none; /* Firefox */ 
-webkit-appearance:none; /* Safari and Chrome */ 
appearance:none;
background:url('http://image.mrlotto.co.kr/select_icon.png') 93% 50% no-repeat;
}
select::-ms-expand { display:none; }
</style>
<script type="text/javascript">
$(document).ready(function(){
	
});
</script>
<form method="post" name="form1" id="form1">
	<div class="join_contents">
		<h1>회원 정보 업데이트</h1>
		<div class="join_form">
			<table cellpadding="0" cellspacing="0" width="100%" border="0" id="join_form">
				<col width="162px">
				<col width="382px">
				
				<tr>
					<td>아이디<span>(필수)</span></td>
					<td><input type="text" placeholder="4-20자의 영,숫자만 사용해 주세요" id="uid_ck" name="uid" maxlength="20"></td>
				</tr>
				<tr>
					<td style="height:15px"></td>
				</tr>
				
				<tr>
					<td>휴대폰 번호<span>(필수)</span></td>
					<td><input type="text" placeholder="- 를 제외하고 입력해 주세요" id="phone_ck" name="phone" maxlength="11"></td>
				</tr>
				<tr>
					<td style="height:15px"></td>
				</tr>
			</table>
		</div>
		
		<div class="join_ok_button">
			<button id="join_ok">추가정보 업데이트</button>
		</div>
	</div>
</form>
<?
include(BASE_DIR.'inc/html/foot.html');

?>
