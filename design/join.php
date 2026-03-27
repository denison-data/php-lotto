<?php include('header2.php')?>

<style>
	.join_contents {width:650px;margin:0 auto}
	.join_contents h1 {font-size:26px;padding-bottom:20px; font-weight:400}
	.join_contents .join_pri {border:4px solid #d9d9d9;margin-top:30px;font-size:15px}
	.join_contents .join_pri a {width:100px; height:25px;background-color:#8d8d8d;border:none; border-radius: 4px;color:#fff; font-size:13px;text-align: center}
	.join_contents .join_pri .join_pri_border {border:1px solid #d9d9d9; border-right:none; border-left:none}
	.join_contents .join_pri div {padding:15px 52px; overflow: hidden;}
	.join_contents .join_pri div a {float:right}
	.join_contents .join_pri div span {color:red; font-size:13px;padding-left:5px; font-weight:400}	
	.join_pri_all_bt {text-align: center; font-size:18px; font-wieght:400; line-height: 38px; margin-top:10px}
	
	.join_form {background-color: #f8f8f8}
	.join_form input {width:382px; height:46px; border:1px solid #d9d9d9;padding-left:10px;font-size:13px}
	.join_form input.email {width:160px;}
	.join_form select {width:197px; height:46px;border:1px solid #d9d9d9;padding-left:10px;font-size:13px;background-color:#fff;border-radius: 0px !important}
	#join_form {padding:50px 52px 65px 52px}
	#join_form span {color:red; font-size:13px;padding-left:5px; font-weight:400}	
	#join_form tr td:first-child {font-weight:400}
	
	.join_ok_button {text-align:center; margin-top:30px}
	.join_ok_button a {cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);width:193px; height:50px;border-radius: 4px;color:#fff;font-size:20px;font-weight: 400;display: block; margin: 0 auto; padding-top:12px;border:1px solid #2a5aad;}

select{
-moz-appearance:none; /* Firefox */ 
-webkit-appearance:none; /* Safari and Chrome */ 
appearance:none;
background:url('http://image.mrlotto.co.kr/select_icon.png') 93% 50% no-repeat;
}
select::-ms-expand { display:none; }
</style>
	
	<div class="join_contents">
		<h1>회원가입</h1>
		<div class="join_form">
			<table cellpadding="0" cellspacing="0" width="100%" border="0" id="join_form">
				<col width="162px">
				<col width="382px">
				<tr>
					<td>이름<span>(필수)</span></td>
					<td><input type="text" placeholder="실명을 입력해 주세요"></td>
				</tr>
				<tr>
					<td style="height:15px"></td>
				</tr>
				<tr>
					<td>아이디<span>(필수)</span></td>
					<td><input type="text" placeholder="4-20자의 영,숫자만 사용해 주세요"></td>
				</tr>
				<tr>
					<td style="height:15px"></td>
				</tr>
				<tr>
					<td>비밀번호<span>(필수)</span></td>
					<td><input type="password" placeholder="최소 8자 이상 / 영,숫,특수문자 포함해서 입력해 주세요"></td>
				</tr>
				<tr>
					<td>비밀번호 재확인</td>
					<td><input type="password" style="margin-top:-1px"></td>
				</tr>
				<tr>
					<td style="height:15px"></td>
				</tr>
				<tr>
					<td>휴대폰 번호<span>(필수)</span></td>
					<td><input type="text" placeholder="- 를 제외하고 입력해 주세요"></td>
				</tr>
				<tr>
					<td style="height:15px"></td>
				</tr>
				<tr>
					<td>이메일 주소</td>
					<td>
						<input type="text" class="email">&nbsp;&nbsp;@ &nbsp;
						<select>
							<option>hanmail.net</option>
							<option>nate.com</option>
							<option>naver.com</option>
						</select>
					</td>
				</tr>
			</table>
		</div>
		<div class="join_pri">
			<div class="pri1_check"><input type="checkbox" id="pri1_check"><label for="pri1_check">&nbsp;이용약관 동의<span>(필수)</span></label><a href="#"  onclick="window.open ('join_1.php','','width=600,height=857,scrollbars=no,top=30,left=30');">약관보기</a></div>
			<div class="pri2_check join_pri_border"><input type="checkbox" id="pri2_check"><label for="pri2_check">&nbsp;개인정보 수집 및 이용 동의<span>(필수)</span></label><a href="#"  onclick="window.open ('join_2.php','','width=600,height=857,scrollbars=no,top=30,left=30');">약관보기</a></div>
			<div class="pri3_check"><input type="checkbox" id="pri3_check"><label for="pri3_check">&nbsp;마케팅 정보 수신 동의</label><a href="#"  onclick="window.open ('join_3.php','','width=600,height=320,scrollbars=no,top=30,left=30');">약관보기</a></div>
		</div>
		<div class="join_pri_all_bt pri_all_bt">
			<input type="checkbox" id="pri_all_bt"><label for="pri_all_bt">&nbsp;&nbsp;위 약관에 모두 동의합니다.</label>
		</div>
		<div class="join_ok_button">
			<a href="">가입</a>
		</div>
	</div>
	

<?php include('footer.php')?>
