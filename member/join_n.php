<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head.html');

$emailArray = array(
"hanmail.net"=>"hanmail.net",
"naver.com"=>"naver.com",
"nate.com"=>"nate.com",
"daum.net"=>"daum.net",
"yahoo.com"=>"yahoo.com",
"e"=>"직접입력"
);
?>
<style>
	.join_contents {width:650px;margin:0 auto}
	.join_contents h1 {font-size:26px;padding-bottom:20px; font-weight:400}
	.join_contents .join_pri {border:4px solid #d9d9d9;margin-top:30px;font-size:15px}
	.join_contents .join_pri button {width:100px; height:25px;background-color:#8d8d8d;border:none; border-radius: 4px;color:#fff; font-size:13px}
	.join_contents .join_pri .join_pri_border {border:1px solid #d9d9d9; border-right:none; border-left:none}
	.join_contents .join_pri div {padding:15px 52px; overflow: hidden;}
	.join_contents .join_pri div button {float:right}
	.join_contents .join_pri div span {color:red; font-size:13px;padding-left:5px; font-weight:400}	
	.join_pri_all_bt {text-align: center; font-size:18px; font-wieght:400; line-height: 38px; margin-top:10px}
	
	.join_form {background-color: #f8f8f8}
	.join_form input {width:382px; height:46px; border:1px solid #d9d9d9;padding-left:10px;font-size:13px}
	.join_form input.email {width:160px; }
	.join_form select {width:197px; height:46px;border:1px solid #d9d9d9;padding-left:10px;font-size:13px;background-color:#fff}
	#join_form {padding:50px 52px 65px 52px}
	#join_form span {color:red; font-size:13px;padding-left:5px; font-weight:400}	
	#join_form tr td:first-child {font-weight:400}
	
	.join_ok_button {text-align:center; margin-top:30px}
	.join_ok_button button {cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);width:193px; height:50px;border-radius: 4px;color:#fff;font-size:20px;font-weight: 400;border:none}

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

		var lgurl = "/member/login_process.php";
		var form_data = {
			nickname : $("#uname_ck").val(),
			user_id : $("#uid_ck").val(),
			user_pw: $("#passwd_ck").val(),
			phone : $("#phone_ck").val(),
			email : $("#email1").val(),
			email2 : $("#email2").val(),
			email_ext : $("#email_ext").val(),
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
					alert('회원가입이 되었습니다');
					top.location.href="/";
				} else {
					alert('이미 등록된 전화번호입니다.');
					return false;
				}
				console.log(data);
			},
			error: function(request, status, error) {
				console.log("error");
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
	<div class="join_contents">
		<h1>회원 가입</h1>
		<div class="join_form">
			<table cellpadding="0" cellspacing="0" width="100%" border="0" id="join_form">
				<col width="162px">
				<col width="382px">
				
				<tr>
					<td>아이디<span>(필수)</span></td>
					<td><input type="text" placeholder="4-20자의 영,숫자만 사용해 주세요" id="uid_ck" name="uid" maxlength="20"></td>
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
				
			</table>
		</div>
		
		<div class="join_ok_button">
			<button id="join_ok">추가정보 업데이트</button>
		</div>
	</div>
</form>	
<?
include(BASE_DIR.'inc/html/foot.html');

?>

