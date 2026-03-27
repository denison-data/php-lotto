<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');

?>

<script type="text/javascript">
$(document).ready(function(){
	$("#pri_check").change(function(){
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
			$("#email_ext").append("<p><input type='text' name='email_exts' id='email_exts' value='' class='inp'>");
		} else {
			$("#email_ext").hide();
		}
	});
	$("#join_ok").on("click",function(){
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

		var lgurl = "/m/member/login_process.php";
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
					top.location.href="/m/";
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
});
</script>
<div class="member_contents">
	<p class="inp_tit">이름 <span class="red">(필수)</span></p>
	<input type="text" placeholder="이름을 입력하세요" class="inp" id="uname_ck" name="uname">
	<p class="inp_tit">아이디 <span class="red">(필수)</span></p>
	<input type="text" placeholder="아이디를 입력하세요" class="inp" id="uid_ck" name="uid" >
	<p class="inp_tit">비밀번호 <span class="red">(필수)</span></p>
	<input type="password" placeholder="비밀번호를 입력하세요" class="inp" id="passwd_ck" name="passwd">
	<p class="inp_tit">비밀번호 재확인</p>
	<input type="password" placeholder="비밀번호를 입력하세요" class="inp" id="passwd_ex" name="passwd_ex">
	<p class="inp_tit">휴대폰 번호 <span class="red">(필수)</span></p>
	<input type="tel" placeholder="-를 제외하고 입력하세요" class="inp" id="phone_ck" name="phone" maxlength="11">
	<p class="inp_tit">이메일 주소 <span class="red">(필수)</span></p>
	<div style="position: relative">
		<input type="text" placeholder="이메일을 입력하세요" class="inp" maxlength="17" name="email1" id="email1">
		<select style="position: absolute;top:25%;right:2%;border: none; background-color: #fff;width: 50%;color:#777;" name="email2" id="email2">
			<?
			foreach($emailArray as $es => $arr){
			?>
				<option value="<?=$es?>"><?=$arr?></option>
			<?
			}
			?>
		</select>
		<div id="email_ext"></div>
	</div>
	<div class="join_box">
		<div><p><input type="checkbox" id="pri1_check">이용약관 동의 <span class="red">(필수)</span><a href="<?=$mobile_dir?>/agree/join1.php" class="pri_bt" target="_blank">약관보기</a></p></div>
		<div><p><input type="checkbox" id="pri2_check">개인정보 수집 및 이용 동의 <span class="red">(필수)</span><a href="<?=$mobile_dir?>/agree/join2.php" class="pri_bt" target="_blank">약관보기</a></p></div>
		<div><p><input type="checkbox" id="pri3_check" target="_blank">마케팅 정보 수신 동의<a href="<?=$mobile_dir?>/agree/join3.php" class="pri_bt">약관보기</a></p></div>
	</div>
	<div class="join_check"><input type="checkbox" id="pri_check"><label for="pri_check"> 위 약관에 모두 동의합니다.</label></div>
	<a href="javascript:;" class="bt blue_bt" id="join_ok">가입</a>
</div>
<?
include(BASE_DIR.'inc/html/foot_m.html');

?>