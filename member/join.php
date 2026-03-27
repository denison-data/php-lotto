<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');


?>
<style>
	.join_contents {width:650px;margin:0 auto;}
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
<script type="text/javascript">
$(document).ready(function(){
	$("#pri_all_bt").change(function(){
		//$("#pri1_check").is(":checked")==true : false;
		var chk = $(this).is(":checked");
		var tck = $("[id$='_check']");
			
		if(chk==true){
			tck.each(function(e){
				var ck_id = $(this).attr("id");				
				$("#"+ck_id).prop("checked",true);
			});
			
		} else {
			tck.each(function(e){
				var ck_id = $(this).attr("id");				
				$("#"+ck_id).prop("checked",false);
			});
			
		}
	});
	$("#email2").change(function(){
		if($(this).val()=="e"){
			$("#email_ext").show();
			$("#email_ext").html("");
			$("#email_ext").append("<input type='text' name='email_exts' id='email_exts' value=''>");
		} else {
			$("#email_ext").hide();
			//$("#email_ext").append("");
		}
		
	});
	$("#join_ok").on("click",function(){
		alert('포트폴리오 페이지입니다.\n위 서비스는 더이상 이용하실 수 없습니다.\n');
		return false;
		var all_chk = $("#pri_all_bt").is(":checked");
		
		var chk1 = $("#pri1_check").is(":checked");
		var chk2 = $("#pri2_check").is(":checked");
		if(chk1==false || chk2==false){
			alert('필수 동의해주세요');
			return false;
		}
		if($.trim($("#uname_ck").val()).length==0){
			var alt = $("#uname_ck").attr("placeholder");
			alert(alt);
			$("#uname_ck").focus();
			return false;
		}
		if($.trim($("#uid_ck").val()).length==0){
			var alt = "id 입력해주세요";
			alert(alt);
			$("#uid_ck").focus();
			return false;
		}
		if($.trim($("#passwd_ck").val()).length==0){
			var alt = $("#passwd_ck").attr("placeholder");
			alert(alt);
			$("#passwd_ck").focus();
			return false;
		}
		if($.trim($("#passwd_ck").val())!=$.trim($("#passwd_ex").val())){
			alert('비밀번호가 맞지 않습니다');
			$("#passwd_ex").val("");
			$("#passwd_ex").focus();
			return false;
		}
		if(!$.trim($("#passwd_ck").val()).match(/([a-zA-Z0-9].*[!,@,#,$,%,^,&,*,?,_,~])|([!,@,#,$,%,^,&,*,?,_,~].*[a-zA-Z0-9])/)){
			alert("비밀번호는 영문,숫자,특수문자(!@$%^&* 만 허용)를 사용하여 6~16자까지, 영문은 대소문자를 구분합니다.");
			$("#passwd_ck").focus();
			return false;
		}

		if($.trim($("#phone_ck").val()).length==0){
			var alt = '연락처를 기입해주세요';
			alert(alt);
			$("#phone_ck").focus();
			return false;
		}
		if($.trim($("#phone_ck").val()).length<7){
			var alt = '연락처를 다시 기입해주세요';
			alert(alt);
			$("#phone_ck").focus();
			return false;
		}
		if($.trim($("#email1").val()).length==0){
			var alt = '이메일을 기입해주세요';
			alert(alt);
			$("#email1").focus();
			return false;
		}
		if($("#email2").val()=="e"){
			if($.trim($("#email_exts").val()).length==0){
				alert('이메일 다시 입력바랍니다');
				$("#email_exts").focus();
				return false;
			}
		}

		var lgurl = "/member/login_process.php";
		var form_data = {
			nickname : $("#uname_ck").val(),
			user_id : $("#uid_ck").val(),
			user_pw: $("#passwd_ck").val(),
			phone : $("#phone_ck").val(),
			email : $("#email1").val(),
			email2 : $("#email2").val(),
			email_ext : $("#email_exts").val(),
			mode : "mem_join"
		};
		
		$.ajax({
			type	:	"POST",
			url		:	lgurl,
			data : form_data,
			dataType : "json",
			async: true,
			cache: false,
			success : function(data){
				if(data['status']=="0"){
					alert('회원가입이 되었습니다\n 정상적으로 이용하시려면 메일인증 부탁드립니다.');
					top.location.href="/";
				} else if(data['status']=="1"){
					alert('이미 등록된 전화번호입니다.');
					return false;
				} else if(data['status']=="2"){
					alert('이미 등록된 이메일입니다.');
					return false;
				} else {
					alert('이미 등록된 ID 입니다.');
					return false;
				}
				//console.log(data);
			},
			error: function(request, status, error) {
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
		return false;
	});
	$("#phone_ck").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	$("#uid_ck").keyup(function(){
		if (!(event.keyCode >=37 && event.keyCode<=40)) {
			var inputVal = $(this).val();
			$(this).val(inputVal.replace(/[^a-z0-9]/gi,''));
		}
	});

});
</script>
<form method="post" name="form1" id="form1">
	<div class="join_contents" style="max-height: 900px !important">
		<h1>회원가입</h1>
		<div class="join_form">
			<table cellpadding="0" cellspacing="0" width="100%" border="0" id="join_form">
				<col width="162px">
				<col width="382px">
				<tr>
					<td>이름<span>(필수)</span></td>
					<td><input type="text" placeholder="실명을 입력해 주세요" id="uname_ck" name="uname"></td>
				</tr>
				<tr>
					<td style="height:15px"></td>
				</tr>
				<tr>
					<td>아이디<span>(필수)</span></td>
					<td><input type="text" placeholder="4-20자의 영,숫자만 사용해 주세요" id="uid_ck" name="uid" maxlength="20"></td>
				</tr>
				<tr>
					<td style="height:15px"></td>
				</tr>
				
				<tr>
					<td>비밀번호<span>(필수)</span></td>
					<td><input type="password" placeholder="최소 8자 이상 / 영,숫,특수문자 포함해서 입력해 주세요" id="passwd_ck" name="passwd"></td>
				</tr>
				<tr>
					<td>비밀번호 재확인</td>
					<td><input type="password" style="margin-top:-1px" id="passwd_ex" name="passwd_ex"></td>
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
				<tr>
					<td>이메일 주소<span>(필수) </span></td>
					<td>
						<input type="text" class="email" name="email1" id="email1" maxlength="30">&nbsp;&nbsp;@ &nbsp;
						<select name="email2" id="email2">
						<?
						foreach($emailArray as $es => $arr){
						?>
							<option value="<?=$es?>"><?=$arr?></option>
						<?
						}
						?>
						</select>
						<div id="email_ext"></div>
					</td>
				</tr>
			</table>
		</div>
		<div class="join_pri">


			<div class="pri1_check"><input type="checkbox" id="pri1_check" value="1"><label for="pri1_check">&nbsp;이용약관 동의<span>(필수)</span></label><a href="javascript:;"  onclick="window.open ('/agree/join_1.php','','width=600,height=857,scrollbars=no,top=30,left=30');">약관보기</a></div>
			<div class="pri2_check join_pri_border"><input type="checkbox" id="pri2_check" value="2"><label for="pri2_check">&nbsp;개인정보 수집 및 이용 동의<span>(필수)</span></label><a href="javascript:;"  onclick="window.open ('/agree/join_2.php','','width=600,height=857,scrollbars=no,top=30,left=30');">약관보기</a></div>
			<div class="pri3_check"><input type="checkbox" id="pri3_check" value="3"><label for="pri3_check">&nbsp;마케팅 정보 수신 동의</label><a href="javascript:;"  onclick="window.open ('/agree/join_3.php','','width=600,height=320,scrollbars=no,top=30,left=30');">약관보기</a></div>
		</div>
		<div class="join_pri_all_bt pri_all_bt">
			<input type="checkbox" id="pri_all_bt"><label for="pri_all_bt">&nbsp;&nbsp;위 약관에 모두 동의합니다.</label>
		</div>
		<div class="join_ok_button">
			<a id="join_ok">가입</a>
		</div>
	</div>
</form>	
<?
include(BASE_DIR.'inc/html/foot.html');

?>

