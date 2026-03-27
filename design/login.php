<?php include('header2.php')?>

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
	.login_bt a {width:382px; height:46px;display: block;text-align: center;padding-top:10px}
	.login_bt a:first-child {background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);color:#fff;border:none;border-radius: 4px; font-size:18px; margin-bottom:3px;cursor: pointer;border:1px solid #2a5aad;font-weight:400}
	.login_bt a:last-child {;cursor: pointer;background-color:#1ec800 !important;color:#fff;border:none;border-radius: 4px; font-size:18px}
	
</style>

	<div class="login_contents">
		<h1>로그인</h1>
		<div class="login_form">
			<input type="text" placeholder="아이디를 입력하세요">
			<input type="password" placeholder="비밀번호를 입력하세요">
			<div class="login_id_check"><input type="checkbox" id="login_id_check"><label for="login_id_check">&nbsp;아이디 저장</label><a href="/design/join.php" class="join">회원가입</a><a href="/design/idpw_find.php">아이디 / 비밀번호 찾기</a></div>
			<div class="login_bt">
				<a href="">로그인</a>
				<a href="">네이버 로그인</a>
			</div>
		</div>
		<a href="/design/sub1.php"><img src="http://image.mrlotto.co.kr/login_banner.jpg"></a>

	</div>


<?php include('footer.php')?>
