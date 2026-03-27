<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
$dbc = dbOpen();
$mode = $_POST['mode'];

switch($mode){
	case "mem_wdraw"	:	function_wdraw();		break;
	case "logins"		:	function_logins();		break;
	case "logout"		:	function_logout();		break;
	case "mem_join"		:	function_memins();		break;
	case "mem_edit"		:	function_edits();		break;
	case "etc_join"		:	function_etcins();		break;
	
	case "pw_check"		:	function_pwd_ck();		break;
	case "id_search"	:	function_id_search();	break;
	case "pw_search"	:	function_pw_search();	break;
	case "email_check"	:	function_email_ck();	break;
	case "coupon_ins"	:	function_coupon_ins();	break;
	case "naver_ins"	:	function_naver_ins();	break;
	case "naver_ups"	:	function_naver_ups();	break;
}
function function_naver_ups(){
	global $_SERVER, $dbc, $_SESSION;
	$code = $_POST['ecod'];
	$tel = str_replace("-","",$_POST['phone']);
	$que = "
	Select * from member Where 1=1 And code in ('$code') And retire in ('n')
	";
	$res = dbQuery($que, $dbc);
	$row = mysqli_fetch_array($res);
	
	if(mysql_num_rows($res) > 0) {	
		$que_ct = "
		Select Count(*) As Ct from member
		Where tel in ('$tel')
		";
		$cdata= dbQuery($que_ct, $dbc);
		$rs = mysqli_fetch_assoc($cdata);
		if($rs['Ct']>0){
			$json_data = array("result"=>true,'status'=>'1',"q"=>$que_ct);
			echo json_encode($json_data);
			dbClose($dbc);
			exit;
		}

		$ups = "
		Update member set tel = '$tel', grade = 'n'
		Where 1=1 And code in ('$code') And retire in ('n') 
		";
		dbQuery($ups);
		if(!isset($_SESSION)) {
			session_start();
			ini_set("session.cookie_domain", ".mrlotto.co.kr");
		};
		$_SESSION['userid'] = $row['etc_userid'];
		$_SESSION['nickname'] = $row['nickname'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['tel'] = $row['tel'];
		$_SESSION['code'] = $row['code'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['reg_dv'] = $row['reg_dv'];
		$time = date("Y-m-d H:i:s");
		$ups = "Update member Set login_datetime = '$time' Where email = '{$_POST[email]}'";
		dbQuery($ups, $dbc);

		session_write_close();
		$json_data = array("result"=>true,'status'=>'0');
	} else {
		$json_data = array("result"=>true,'status'=>'1');
	}
	echo json_encode($json_data);
	dbClose($dbc);
	exit;
	

}
function function_naver_ins(){
	global $_SERVER, $dbc, $_SESSION;
	$que = "
	Select * from member Where 1=1 And etc_userid = '{$_POST[id]}' 
	And retire in ('n')
	";
	//And email = '{$_POST[email]}' And retire in ('n')
	$res = dbQuery($que, $dbc);
	$row = mysqli_fetch_array($res);

	if(mysql_num_rows($res) > 0) {
		/*회원데이터 존재시 로그인*/

		$que2 = "
		Select * from member Where 1=1 And etc_userid = '{$_POST[id]}' 
		And retire in ('n')
		Order By uid desc
		limit 1
		";
		$res2 = dbQuery($que2, $dbc);
		$row2 = mysqli_fetch_array($res2);

		if(strlen(trim($row2['tel']))<=5){			
			$json_data = array("result"=>true,'status'=>'2','ecd'=>$row['code'],'q'=>$que2);
		} else {
			if(!isset($_SESSION)) {
				session_start();
			};
			$_SESSION['userid'] = $row['etc_userid'];
			$_SESSION['nickname'] = $row['nickname'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['tel'] = $row['tel'];
			$_SESSION['code'] = $row['code'];
			$_SESSION['grade'] = $row['grade'];
			$_SESSION['reg_dv'] = $row['reg_dv'];
			$time = date("Y-m-d H:i:s");
			$ups = "Update member Set login_datetime = '$time' Where email = '{$_POST[email]}'";
			dbQuery($ups, $dbc);
			$ret = $_POST['rurl'];

			session_write_close();
			if($ret){
				$json_data = array("result"=>true,'status'=>'ok');
				
			} else {
				$json_data = array("result"=>true,'status'=>'ok','tel'=>$row['tel']);
			}
			
		}
		echo json_encode($json_data);
		dbClose($dbc);
		exit;
	} else {
		/*없을시에는 insert*/
		$data['userid'] = "NAVER_".$_POST[id];
		$data['etc_userid'] = $_POST[id];
		$data['join_datetime'] = date("Y-m-d H:i:s");
		$data['ip'] = $_SERVER['REMOTE_ADDR'];
		$data['code'] = getCode();
		$data['grade'] = "i";
		$data['reg_dv'] = "n"; //naver
		$data['nickname'] = $_POST['name'];
		$data['email'] = $_POST['email'];

		$column = implode(",",array_keys($data));
		$mvalues = array_map('mysql_real_escape_string', array_values($data));
		$values  = implode("','", $mvalues);
		$tb = "member";
		
		$que_ct2 = "
		Select Count(*) As Ct from $tb
		Where email in ('$email') 
		";
		$cdata2= dbQuery($que_ct2, $dbc);
		$rs2 = mysql_fetch_assoc($cdata2);
		if($rs2['Ct']>0){
			$ups = "Update $tb set email='{$_POST[email]}' Where 1=1 And etc_userid = '{$_POST[id]}' ";
			dbQuery($ups, $dbc);
			$json_data = array("result"=>true,'status'=>'2',"aaa"=>$rs2);
			echo json_encode($json_data);
			exit;
		} else {
			$qry = "
			Insert into $tb
			($column)
			values 
			('$values')
			";
			dbQuery($qry, $dbc);
			$json_data = array("result"=>true,'status'=>'0','ecd'=>$data['code']);
		
		}	
		
	}
	dbClose($dbc);
	echo json_encode($json_data);
	exit;
	
}
function function_coupon_ins(){
	global $_SERVER, $dbc, $_SESSION;

	$cpl_code = $_POST['cpcod'];
	$ymds = date("Ymd");
	$que = "
	Select * from v_coupon_list Where 1=1 And cpl_code in ('$cpl_code') And cpl_using in ('n') And '$ymds' Between cp_start And cp_end
	";
	$c_data = dbQuery($que,$dbc);
	$c_total = mysqli_num_rows();			
	if($c_total==0){ $json_data = array("result"=>true,"status"=>1); echo json_encode($json_data);exit;}
	else {
		$mcode = $_POST['mcode'];
		$que_ups = "
		Update coupon_list Set mem_code = '$mcode', mem_datetime = NOW(), cpl_using = 'y'
		Where 1=1 And cpl_code in ('$cpl_code') And cpl_using in ('n')
		";
		dbQuery($que_ups, $dbc);
		$json_data = array("result"=>true,"status"=>0);
		echo json_encode($json_data);
		exit;

	}
	//print_r($que);
}
function function_logout(){
	global $_SERVER, $dbc,$_SESSION;
	session_start();
	unset($_SESSION['userid']);
	unset($_SESSION['nickname']);
	unset($_SESSION['email']);
	unset($_SESSION['tel']);
	unset($_SESSION['code']);
	unset($_SESSION['reg_dv']);
	echo "<script>alert('로그아웃이 되었습니다.'); top.location.href='/'; </script>";

	exit;
}
function function_pw_search(){
	global $_SESSION,$dbc;
	if($_POST['uname']){
		$nickname = $_POST['uname'];
		$phone = $_POST['phone'];
		$userid = $_POST['uid'];
		$tb = "member";
		$que = "
		Select * from {$tb}
		Where nickname = '".$nickname."'
		And tel = '".$phone."' And userid = '".$userid."'
		";
		$cdata= dbQuery($que, $dbc);
		$total = mysqli_num_rows($cdata);
		//$total = mysqli_num_rows();		
		$row = mysqli_fetch_array($cdata);
		if($total==1){
			$pwds = getCode(8);
			$rankey = "md5(password('".$pwds."'))";
			$que = "
			Update {$tb} set pwd = $rankey
			Where nickname = '".$nickname."'
			And tel = '".$phone."' And userid = '".$userid."'
			";
			dbQuery($que, $dbc);
			function_sdmail($row['email'],$row['nickname'],$pwds,"pw");
			$json_data = array("result"=>true,'status'=>'0');
		} else {
			$json_data = array("result"=>true,'status'=>'1');
		}
		echo json_encode($json_data);
		dbClose($dbc);
		exit;

	}
}
function function_id_search(){
	global $_SESSION,$dbc;
	if($_POST['uname']){
		$nickname = $_POST['uname'];
		$phone = $_POST['phone'];
		$tb = "member";
		$que = "
		Select * from {$tb}
		Where nickname = '".$nickname."'
		And tel = '".$phone."'
		";
		
		$cdata= dbQuery($que, $dbc);
		$total = mysqli_num_rows($cdata);
		//$total = mysqli_num_rows();		
		$row = mysqli_fetch_array($cdata);
		if($total==1){
			$json_data = array("result"=>true,'status'=>'0');

			function_sdmail($row['email'],$row['nickname'],$row['userid'],"id");
		} else {
			$json_data = array("result"=>true,'status'=>'1');
		}
		echo json_encode($json_data);
		dbClose($dbc);
		exit;
		
	}
}
function function_wdraw(){
	global $_SERVER, $dbc;
	session_start();
	$tb = "member";
	$userid = $_POST['user_id'];
	$date = date("Y-m-d H:i:s");
	$qry = "Update {$tb} set expire_datetime = '$date', retire='y' where userid = '$userid'";
	$cdata= dbQuery($qry, $dbc);
	if($cdata){
		unset($_SESSION['userid']);
		unset($_SESSION['nickname']);
		unset($_SESSION['email']);
		unset($_SESSION['tel']);
		unset($_SESSION['code']);
		unset($_SESSION['reg_dv']);
		$json_data = array("result"=>true,'status'=>'0');
		echo json_encode($json_data);
	}
	dbClose($dbc);
	exit;
}
function function_edits(){
	global $_SERVER, $dbc;
	$tb = "member";
	if($_POST['email']){
	
		if($_POST['email2'] != "e"){
			$email_ext = $_POST['email2'];
		} else {
			$email_ext = $_POST['email_ext'];
		}
		$email = $_POST['email']."@".$email_ext;
	}
	$userid = $_POST['user_id'];
	$qry = "Update {$tb} set email = '$email', pwd=md5(password('".$_POST['user_pw']."')) where userid = '$userid'";
	$cdata= dbQuery($qry, $dbc);
	if($cdata){
		$json_data = array("result"=>true,'status'=>'0');
		echo json_encode($json_data);
	}
	dbClose($dbc);
	exit;
}
function function_pwd_ck(){
	global $_SESSION,$dbc;
	if($_POST['user_id']){
		$uid = $_POST['user_id'];
		$pwd = $_POST['user_pw'];
		$tb = "member";
		$que = "
		Select * from {$tb}
		Where userid = '".$uid."'
		And pwd = md5(password('".$pwd."'))
		";
		
		$cdata= dbQuery($que, $dbc);
		$total = mysqli_num_rows();		
		if($total==1){
			$json_data = array("result"=>true,'status'=>'0');
		} else {
			$json_data = array("result"=>true,'status'=>'1');
		}
		echo json_encode($json_data);
		dbClose($dbc);
		exit;
		
	}
	
}
function function_logins(){
	global $_SERVER, $dbc,$_SESSION;
	

	if(!isset($_SESSION)) {
		session_start();
	};
	
	$tb = "member";

	$ret = $_POST['rurl'];
    $given_username = $_POST['user_id'];
    $given_password = $_POST['pwd'];
    $given_username = stripslashes($given_username);
    $given_password = stripslashes($given_password);
    $given_username = mysqli_real_escape_string($given_username);
    $given_password = mysqli_real_escape_string($given_password);
	$matched_username = "";
    $matched_password = "";
	
	$sql = "
	SELECT * 
	FROM $tb WHERE userid='".$given_username."'
	And pwd = md5(password('".$given_password."'))
	And retire in ('n')
	";
	echo "<script>alert('개발용이라 로그인은 더이상 할 수 없습니다');history.go(-1);</script>";
		exit;
    $cdata= dbQuery($sql, $dbc);
	//$total = mysqli_num_rows();
	
	$total = mysqli_num_rows($cdata);

	$row = mysqli_fetch_assoc($cdata);
		
	if($total==1){
		if($row['grade']=="i"){
			$url = "/member/email_ck.php";
			$html ='<form method="post" name="form1" id="form1" action="'.$url.'">';
			$html .='<input type="hidden" name="nickname" value="'.$row['nickname'].'">';
			$html .='<input type="hidden" name="email" value="'.$row['email'].'">'; 
			$html .='<input type="hidden" name="uid" value="'.$row['uid'].'"></form>';
			echo "<script>alert('인증되지 않았습니다.');function doSubmit(){document.form1.submit();} window.onload = function(){doSubmit();};</script>".$html;
			exit;
		}
		
		/* 로그인 처리*/
		$time = date("Y-m-d H:i:s");
		$ups = "Update $tb Set login_datetime = '$time' Where userid in ('".$given_username."') ";
		dbQuery($ups, $dbc);
		
		ini_set("session.cookie_domain", ".mrlotto.co.kr");
		
		$_SESSION['userid'] = $row['userid'];
		$_SESSION['nickname'] = $row['nickname'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['tel'] = $row['tel'];
		$_SESSION['code'] = $row['code'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['reg_dv'] = $row['reg_dv'];

	
		session_write_close();
		if($ret){
			
			echo "<script>top.location.href='".$ret."'</script>";

		} else {
			echo "<script>top.location.href='/'</script>";
		}
		dbClose($dbc);

		/*
		$url = "http://www.mrlotto.co.kr/member/login_s.php";
		$fields = array(
		"userid"=>$row['userid'],
		"nickname"=>$row['userid'],
		"email"=>$row['email'],
		"tel"=>$row['tel']
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);    
		curl_setopt($ch, CURLOPT_NOPROGRESS, FALSE);    
		$result = curl_exec($ch); 
		curl_close($ch);
		*/
		//$json_data = array("result"=>true,'status'=>'0','ret'=>$ret,'session'=>$_SESSION);
	} else {
		/* 로그인 실패*/
		echo "<script>alert('로그인 실패되었습니다');history.go(-1);</script>";
		//$json_data = array("result"=>true,'status'=>'1');
	}

	exit;
}
function function_etcins(){
	global $_SERVER, $dbc;
	exit;
}
function function_memins(){
	global $_SERVER, $dbc;
	$data['userid'] = $_POST['user_id'];
	$data['nickname'] = $_POST['nickname'];
	//$data['pwd'] = "md5(password(".$_POST['user_pw']."))";
	$data['tel'] = $_POST['phone'];
	$pwd = $_POST['user_pw'];
	if($_POST['email']){
		if($_POST['email2']!="e"){
			$email_ext = $_POST['email2'];
		} else {
			$email_ext = $_POST['email_ext'];
		}
		$data['email'] = $_POST['email']."@".$email_ext;
	}
	
	$data['join_datetime'] = date("Y-m-d H:i:s");
	$data['ip'] = $_SERVER['REMOTE_ADDR'];
	$data['code'] = getCode();
	$data['grade'] = "i";
	$data['reg_dv'] = "w"; //pc 웹에서
	$data['etc_userid'] = ""; // 기타 아이디 (네이버 아이디 받기 )

	$column = implode(",",array_keys($data));
	$mvalues = array_map('mysql_real_escape_string', array_values($data));
	$values  = implode("','", $mvalues);
	$tb = "member";
	
	$tel = $_POST['phone'];
	$que_ct = "
	Select Count(*) As Ct from $tb
	Where tel in ('$tel')
	";
	$cdata= dbQuery($que_ct, $dbc);
	$rs = mysqli_fetch_assoc($cdata);
	/*
	번호중복관련
	*/

	/*이메일 중복 추가*/
	$email = $_POST['email']."@".$email_ext;
	$que_ct2 = "
	Select Count(*) As Ct from $tb
	Where email in ('$email')
	";
	$cdata2= dbQuery($que_ct2, $dbc);
	$rs2 = mysqli_fetch_assoc($cdata2);
	if($rs2['Ct']>0){
		$json_data = array("result"=>true,'status'=>'2');
		echo json_encode($json_data);
		exit;
	}
	/*이메일 중복 끝 */

	/*id 중복 추가*/
	$uid = $_POST['user_id'];
	$que_ct3 = "
	Select Count(*) As Ct from $tb
	Where userid in ('$uid')
	";
	$cdata3= dbQuery($que_ct3, $dbc);
	$rs3 = mysqli_fetch_assoc($cdata3);
	if($rs3['Ct']>0){
		$json_data = array("result"=>true,'status'=>'3');
		echo json_encode($json_data);
		exit;
	}
	/*이메일 중복 끝 */

	if($rs['Ct']=="0"){
		$qry = "
		Insert into $tb
		($column,pwd)
		values 
		('$values',md5(password('$pwd')))
		";
		dbQuery($qry, $dbc);
		/* 회원가입후 로그인 유지할건지는 회의를 통해 결정할 예정*/
		function_sdmail($_POST['email']."@".$email_ext,$_POST['nickname'],$data['code'],"join");
		$json_data = array("result"=>true,'status'=>'0');
	} else {
		$json_data = array("result"=>true,'status'=>'1');
	}
	dbClose($dbc);

	echo json_encode($json_data);
	exit;
}
function function_email_ck(){
	global $_SERVER, $dbc;
	if($_POST['email']){
		if($_POST['email2']!="e"){
			$email_ext = $_POST['email2'];
		} else {
			$email_ext = $_POST['email_ext'];
		}
		$data['email'] = $_POST['email']."@".$email_ext;
	}
	$data['nickname'] = $_POST['nickname'];
	$tb = "member";


	$email = $_POST['email']."@".$email_ext;
	/*이메일 중복 추가
	$que_ct2 = "
	Select Count(*) As Ct from $tb
	Where email in ('$email')
	";
	$cdata2= dbQuery($que_ct2, $dbc);
	$rs2 = mysql_fetch_assoc($cdata2);
	if($rs2['Ct']>0){
		$json_data = array("result"=>true,'status'=>'2');
		echo json_encode($json_data);
		exit;
	}
	이메일 중복 끝 */
	
	$uid = $_POST['uid'];
	$qry = "
		Update $tb set email = '$email'
		Where uid in ('$uid')
		";
	dbQuery($qry, $dbc);
	/* 회원가입후 로그인 유지할건지는 회의를 통해 결정할 예정*/

	$que = "
	Select * from $tb Where uid in ('$uid')
	";
	$data = dbQuery($que,$dbc);
	$rows = mysqli_fetch_array($data);

	function_sdmail($_POST['email']."@".$email_ext,$_POST['nickname'],$rows['code'],"join");
	
	dbClose($dbc);

	$json_data = array("result"=>true,'status'=>'0');
	echo json_encode($json_data);
	exit;


}
function function_sdmail($dmail,$dname, $code, $division){
	$nameFrom  = "미스터로또관리자";
    $mailFrom = "webmaster@mrlotto.co.kr";
    $nameTo  = $dname; //받는사람
    $mailTo = $dmail;
	if($division == "join"){
		$subject = "회원가입을 축하드립니다.";
		$mail_html = $_SERVER[DOCUMENT_ROOT]."mail/confirm.php";
		$fp=fopen($mail_html,"r");
		fseek($fp,0);	
		
		$mail_content=fread($fp,filesize($mail_html));
		$mail_content=str_replace("__login__","<a href=\"http://www.mrlotto.co.kr/member/ck.php?mode=mem_logins&code=$code\" target=\"_new\"  style=\"background: rgb(42,83,154);background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);border:none; border-radius: 4px;padding:15px 30px;color:#fff;display:inline-block;width:230px;margin-top:30px; font-size:22px; font-weight:400;text-decoration:none\">인증 하러 가기</a>",$mail_content);
	} else if($division == "id"){
		$subject = "회원정보를 알려드립니다.";
		$mail_html = $_SERVER[DOCUMENT_ROOT]."mail/id.php";
		$fp=fopen($mail_html,"r");
		fseek($fp,0);	
		
		$mail_content=fread($fp,filesize($mail_html));
		$mail_content=str_replace("__id__","<p style=\"background-color:#fff; width:300px;margin:0 auto;padding:30px 0;font-size:32px;font-weight:500\">".$code."</p>",$mail_content);
	} else if($division == "pw"){
		$subject = "임시 비밀번호를 알려드립니다.";
		$mail_html = $_SERVER[DOCUMENT_ROOT]."mail/pw.php";
		$fp=fopen($mail_html,"r");
		fseek($fp,0);	
		
		$mail_content=fread($fp,filesize($mail_html));
		$mail_content=str_replace("__pw__","<p style=\"background-color:#fff; width:300px;margin:0 auto;padding:30px 0;font-size:32px;font-weight:500\">".$code."</p>",$mail_content);
	}
	$content = $mail_content;
	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
	$nameFrom = "=?UTF-8?B?".base64_encode($nameFrom)."?=";


	$dMail = new Sendmail; 
	$dMail->setUseSMTPServer(true); 
	$ip = $REMOTE_ADDR;
	$dMail->setSMTPServer($ip); 
	$dMail->setFrom($mailFrom, $nameFrom); 
	$dMail->setSubject($subject); 
	$dMail->setMailBody($content, true); 
	$dMail->addTo($mailTo, "=?UTF-8?B?".base64_encode($ID).'?='); 
	$dMail->send();	
	return;
}
//print_r($_POST);

?>