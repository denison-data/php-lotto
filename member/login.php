<?

include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');


if($_GET['target']){
	$target = $_GET['target'];
	if($_GET['gtype']){
		$target .= "&gtype=".$_GET['gtype'];
	}
} else {
	$target = "/";
}
?>
<style>
	.login_contents {width:1080px;margin:0 auto;padding-bottom:150px}
	.login_contents h1 {font-size:26px;padding-bottom:20px; font-weight:400}
	.login_form {width:530px;border:4px solid #d9d9d9; padding:60px 74px; float:left; margin-right:20px; height:355px}
	.login_form>input {width:382px; height:46px; border:1px solid #d9d9d9;padding-left:10px;font-size:13px}
	.login_form input:nth-child(2) {margin-top:3px}
	.login_id_check {font-size:15px;margin-top:5px; margin-bottom:15px}
	.login_id_check input {width:15px; height:15px; } 
	.login_id_check a {float:right}
	.login_id_check a.join {font-weight: 500;padding-left:20px}
	.login_bt button {width:382px; height:46px;}
	.login_bt button:first-child {background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);color:#fff;border:none;border-radius: 4px; font-size:18px; margin-bottom:3px;cursor: pointer}
	.login_bt button:last-child {;cursor: pointer;background-color:#1ec800 !important;color:#fff;border:none;border-radius: 4px; font-size:18px}
	
</style>
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
<div class="login_contents">
	<h1>로그인</h1>
	<div class="login_form">
	
	<input type="hidden" name="rurl" id="rurl" value="<?=$target?>">
		<input type="text" name="user_id" id="user_id" placeholder="아이디를 입력하세요">
		<input type="password" placeholder="비밀번호를 입력하세요" name="pwd" id="pwd">
		<div class="login_id_check"><input type="checkbox" id="login_id_check"><label for="login_id_check">&nbsp;아이디 저장</label><a href="/member/join.php" class="join">회원가입</a><a href="/member/find.php">아이디 / 비밀번호 찾기</a></div>
		<div class="login_bt">
			<button id="login_ck">로그인</button>
			<button id="naver_id_login" onclick="javascript:alert('포트폴리오 페이지입니다.\n위 서비스는 더이상 이용하실 수 없습니다.\n');return false;">네이버 로그인</button>
		</div>
	</div>
	
	<a href="/info/sub.php?dep=1"><img src="/add-img/login_banner.jpg"></a>

</div>
</form>
<?
include(BASE_DIR.'inc/html/foot.html');

?>

