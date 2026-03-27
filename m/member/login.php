<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
if($_GET['target']){
	$target = $_GET['target'];
	if($_GET['gtype']){
		$target .= "&gtype=".$_GET['gtype'];
	}
} else {
	$target = $mobile_dir."/";
}
include(BASE_DIR.'inc/html/head_m.html');


?>
<script type="text/javascript">
<?
if($_SESSION['userid']){
?>
	top.location.href="<?=$target?>";
<?
}
?>
</script>
<form method="post" name="form1" id="form1">
<input type="hidden" name="mode" value="logins">
<input type="hidden" name="rurl" id="rurl" value="<?=$target?>">
<div class="member_contents">
	<p class="inp_tit">아이디</p>
	<input type="text" placeholder="아이디를 입력하세요" class="inp" id="user_id" name="user_id">
	<p class="inp_tit">비밀번호</p>
	<input type="password" placeholder="비밀번호를 입력하세요" class="inp" name="pwd" id="pwd">
	<a href="javascript:;" id="login_ck" class="bt blue_bt">로그인</a>
	<a href="javascript:;" id="naver_id_login" class="bt naver_bt">네이버 로그인</a>
	<span class="check"><input type="checkbox" id="login_id_check"><label for="id_check">아이디 저장</label></span>
	<div class="small_bt"><a href="<?=$mobile_dir?>/member/find.php">아이디/비밀번호 찾기</a><a href="<?=$mobile_dir?>/member/join.php">회원가입</a></div>
</div>
</form>
<?
include(BASE_DIR.'inc/html/foot_m.html');

?>