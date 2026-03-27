<?php include('header2.php')?>

<style>
	.find_contents {width:530px;margin:0 auto}
	.find_contents h1 {font-size:26px;padding-bottom:20px; font-weight:400}
	
	.id_form {background-color: #f8f8f8; padding-bottom:50px;margin-bottom:50px }
	.id_form input {width:300px; height:46px; border:1px solid #d9d9d9;padding-left:10px;font-size:13px}
	.id_form input.email {width:160px; }
	#id_form {padding:50px 52px 15px 52px}
	#id_form span {color:red; font-size:13px;padding-left:5px; font-weight:400}	
	#id_form tr td:first-child {font-weight:400}
	
	.pw_form {background-color: #f8f8f8; padding-bottom:50px; }
	.pw_form input {width:300px; height:46px; border:1px solid #d9d9d9;padding-left:10px;font-size:13px}
	.pw_form input.email {width:160px; }
	#pw_form {padding:50px 52px 15px 52px}
	#pw_form span {color:red; font-size:13px;padding-left:5px; font-weight:400}	
	#pw_form tr td:first-child {font-weight:400}
	
	.id_find_button, .pw_find_button {text-align:center; margin-top:30px}
	.id_find_button a, .pw_find_button a {cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);width:193px; height:50px;border-radius: 4px;color:#fff;font-size:18px;font-weight: 300; display: block;margin:0 auto; padding-top:13px;border:1px solid #2a5aad;}
</style>
	
	<div class="find_contents">
		<h1>아이디 찾기</h1>
		<div class="id_form">
			<table cellpadding="0" cellspacing="0" width="100%" border="0" id="id_form">
				<col width="100px">
				<col width="300px">
				<tr>
					<td>이름</td>
					<td><input type="text"></td>
				</tr>
				<tr>
					<td style="height:3px"></td>
				</tr>
				<tr>
					<td>휴대폰 번호</td>
					<td><input type="password"></td>
				</tr>
			</table>
			<div class="id_find_button">
				<a href="">아이디 찾기</a>
			</div>
		</div>
		<h1>비밀번호 찾기</h1>
		<div class="pw_form">
			<table cellpadding="0" cellspacing="0" width="100%" border="0" id="pw_form">
				<col width="100px">
				<col width="300px">
				<tr>
					<td>아이디</td>
					<td><input type="text"></td>
				</tr>
				<tr>
					<td style="height:3px"></td>
				</tr>
				<tr>
					<td>이름</td>
					<td><input type="text"></td>
				</tr>
				<tr>
					<td style="height:3px"></td>
				</tr>
				<tr>
					<td>휴대폰 번호</td>
					<td><input type="password"></td>
				</tr>
			</table>
			<div class="pw_find_button">
				<a href="">비밀번호 찾기</a>
			</div>
		</div>
	</div>
	

<?php include('footer.php')?>
