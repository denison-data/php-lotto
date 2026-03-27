<?php include('mypage_header.php')?>

<div class="contents sub">
	<h2><img src="http://image.mrlotto.co.kr/mobile/info_tit.jpg"></h2>
	<div class="sub_menu_button">
		<a href="mypage4_1.php" class="on">나의 정보 수정</a><a href="mypage4_3.php">탈퇴관리</a>
	</div>
</div>
<div class="sub_search_bg2">
	<div class="member_contents">
		<p class="inp_tit">이름</p>
		<input type="text" placeholder="저장된 이름 영역(수정 불가, 비활성화 시켜주세요)" class="inp_desa">
		<p class="inp_tit">아이디</p>
		<input type="text" placeholder="저장된 아이디 영역(수정 불가, 비활성화 시켜주세요)" class="inp_desa">
		<p class="inp_tit">비밀번호</p>
		<input type="password" placeholder="최소 8자 이상 / 영, 숫, 특문 포함해서 입력해 주세요" class="inp">
		<p class="inp_tit">비밀번호 재확인</p>
		<input type="password" placeholder="비밀번호를 재입력하세요" class="inp">
		<p class="inp_tit">휴대폰 번호</p>
		<input type="text" placeholder="저장된 번호 영역" class="inp">
		<p class="inp_tit">이메일 주소</p>
		<div style="position: relative">
			<input type="text" placeholder="이메일을 입력하세요" class="inp" maxlength="17">
			<select style="position: absolute;top:25%;right:2%;border: none; background-color: #fff;width: 50%;color:#777;">
				<option>@ naver.com</option>
			</select>
		</div>
		<a href="" class="bt blue_bt" style="margin-top:15%">수정 완료</a>
	</div>
</div>
	

<?php include('sub_footer.php')?>