<?php include('header.php')?>

<div class="member_contents">
	<p class="inp_tit">아이디</p>
	<input type="text" placeholder="아이디를 입력하세요" class="inp">
	<p class="inp_tit">비밀번호</p>
	<input type="password" placeholder="비밀번호를 입력하세요" class="inp">
	<a href="" class="bt blue_bt">로그인</a>
	<a href="" class="bt naver_bt">네이버 로그인</a>
	<span class="check"><input type="checkbox" id="id_check"><label for="id_check">아이디 저장</label></span>
	<div class="small_bt"><a href="find_idpw.php">아이디/비밀번호 찾기</a><a href="join.php">회원가입</a></div>
</div>

<?php include('sub_footer.php')?>
