<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
$dbc = dbOpen();


?>

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
	.id_find_button button, .pw_find_button button {cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);width:193px; height:50px;border-radius: 4px;color:#fff;font-size:18px;font-weight: 300; border:none}
</style>

<script type="text/javascript">
$(document).ready(function(){
	$("#id_search").on("click",function(){
		if($.trim($("#uname").val()).length==0){
			var alt = $("#uname").attr("placeholder");
			alert(alt);
			$("#uname").focus();
			return false;
		}
		if($.trim($("#phone").val()).length==0){
			var alt = $("#phone").attr("placeholder");
			alert(alt);
			$("#phone").focus();
			return false;
		}
		var lgurl = "/member/login_process.php";
		var form_data = {
			uname : $("#uname").val(),
			phone : $("#phone").val(),
			mode : "id_search"
		};
		$.ajax({
			type	:	"POST",
			url		:	lgurl,
			data : form_data,
			dataType : "json",
			async: false,
			cache: false,
			success : function(data){
				
				if(data['status']=="0"){
					alert('메일발송 되었습니다');
				} else {
					alert('회원 Data가 조회되지 않습니다.');
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
	$("#phone").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	$("#phone2").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	$("#pw_search").on("click",function(){
		if($.trim($("#uid2").val()).length==0){
			var alt = $("#uid2").attr("placeholder");
			alert(alt);
			$("#uid2").focus();
			return false;
		}
		if($.trim($("#uname2").val()).length==0){
			var alt = $("#uname2").attr("placeholder");
			alert(alt);
			$("#uname2").focus();
			return false;
		}
		if($.trim($("#phone2").val()).length==0){
			var alt = $("#phone2").attr("placeholder");
			alert(alt);
			$("#phone2").focus();
			return false;
		}
		var lgurl = "/member/login_process.php";
		var form_data = {
			uname : $("#uname2").val(),
			phone : $("#phone2").val(),
			uid : $("#uid2").val(),
			mode : "pw_search"
		};
		$.ajax({
			type	:	"POST",
			url		:	lgurl,
			data : form_data,
			dataType : "json",
			async: false,
			cache: false,
			success : function(data){
				
				if(data['status']=="0"){
					alert('임시 비밀번호가 발송 되었습니다');
				} else {
					alert('회원 Data가 조회되지 않습니다.');
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
});
</script>	
<form name="form1" id="form1">
<input type="hidden" id="mode" name="mode">
</form>
	<div class="find_contents">
		<h1>아이디 찾기</h1>
		<div class="id_form">
			<table cellpadding="0" cellspacing="0" width="100%" border="0" id="id_form">
				<col width="100px">
				<col width="300px">
				<tr>
					<td>이름</td>
					<td><input type="text" name="uname" id="uname" placeholder="이름 입력바랍니다"></td>
				</tr>
				<tr>
					<td style="height:3px"></td>
				</tr>
				<tr>
					<td>휴대폰 번호</td>
					<td><input type="text" name="phone" id="phone" placeholder="전화번호 입력바랍니다"></td>
				</tr>
			</table>
			<div class="id_find_button">
				<button id="id_search">아이디 찾기</button>
			</div>
		</div>
		<h1>비밀번호 찾기</h1>
		<div class="pw_form">
			<table cellpadding="0" cellspacing="0" width="100%" border="0" id="pw_form">
				<col width="100px">
				<col width="300px">
				<tr>
					<td>아이디</td>
					<td><input type="text" name="uid2" id="uid2" placeholder="ID 입력바랍니다"></td>
				</tr>
				<tr>
					<td style="height:3px"></td>
				</tr>
				<tr>
					<td>이름</td>
					<td><input type="text" name="uname2" id="uname2" placeholder="이름 입력바랍니다"></td>
				</tr>
				<tr>
					<td style="height:3px"></td>
				</tr>
				<tr>
					<td>휴대폰 번호</td>
					<td><input type="text" name="phone2" id="phone2" placeholder="전화번호 입력바랍니다"></td>
				</tr>
			</table>
			<div class="pw_find_button">
				<button id="pw_search">비밀번호 찾기</button>
			</div>
		</div>
	</div>

<?
include(BASE_DIR.'inc/html/foot.html');

?>

