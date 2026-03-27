<?php include('header.php')?>

<div class="member_contents">
	<p class="inp_tit">이름 <span class="red">(필수)</span></p>
	<input type="text" placeholder="이름을 입력하세요" class="inp">
	<p class="inp_tit">아이디 <span class="red">(필수)</span></p>
	<input type="text" placeholder="아이디를 입력하세요" class="inp">
	<p class="inp_tit">비밀번호 <span class="red">(필수)</span></p>
	<input type="password" placeholder="최소 8자 이상 / 영, 숫, 특문 포함해서 입력해 주세요" class="inp">
	<p class="inp_tit">비밀번호 재확인</p>
	<input type="password" placeholder="비밀번호를 재입력하세요" class="inp">
	<p class="inp_tit">휴대폰 번호 <span class="red">(필수)</span></p>
	<input type="text" placeholder="-를 제외하고 입력하세요" class="inp">
	<p class="inp_tit">이메일 주소 <span class="red">(필수)</span></p>
	<div style="position: relative">
		<input type="text" placeholder="이메일을 입력하세요" class="inp" maxlength="17">
		<select style="position: absolute;top:25%;right:2%;border: none; background-color: #fff;width: 50%;color:#777;">
			<option>@ naver.com</option>
		</select>
	</div>
	<div class="join_box">
		<div><p><input type="checkbox" style="border: 1px solid red">&nbsp;이용약관 동의 <span class="red">(필수)</span><a href="join1.php" class="pri_bt" target="_blank">약관보기</a></p></div>
		<div><p><input type="checkbox" style="border: 1px solid red">&nbsp;개인정보 수집 및 이용 동의 <span class="red">(필수)</span><a href="join2.php" class="pri_bt" target="_blank">약관보기</a></p></div>
		<div><p><input type="checkbox" style="border: 1px solid red">&nbsp;마케팅 정보 수신 동의<a href="join3.php" class="pri_bt" target="_blank">약관보기</a></p></div>
	</div>
	<div class="join_check"><input type="checkbox" id="pri_check"><label for="pri_check"> 위 약관에 모두 동의합니다.</label></div>
	<a href="" class="bt blue_bt">가입</a>
</div>


<?php include('sub_footer.php')?>