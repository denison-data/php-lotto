<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');

$dbc = dbOpen();
if(!$_POST['nickname']){
	echo "<script>top.location.href=\"/m/\";</script>";
}

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

	$("#email_send").on("click",function(){
		if($.trim($("#uname").val()).length==0){
			var alt = $("#uname").attr("placeholder");
			alert(alt);
			$("#uname").focus();
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
		var his_email = $("#his_email").val();
		
		if($("#email_exts").val()){
			email_et = $("#email_exts").val();
		} else {
			email_et = $("#email2").val()
		}
		var nemail = $("#email1").val()+"@"+email_et;
		//console.log(email_et);
		if(confirm("입력하신 이메일로 인증메일이 발송됩니다.")){
			var lgurl = "<?=$mobile_dir?>/member/login_process.php";
			var form_data = {
				nickname : $("#uname").val(),
				uid : $("#uid").val(),
				email : $("#email1").val(),
				email2 : $("#email2").val(),
				email_ext : $("#email_exts").val(),
				mode : "email_check"
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
						alert('요청하신 메일로 재발송 되었습니다\n 정상적으로 이용하시려면 메일인증 부탁드립니다.');
						top.location.href="/";
					}  else if(data['status']=="2"){
						alert('이미 등록된 이메일입니다.');
						return false;
					} else {
						alert('Error');
						console.log(data);
						return false;
					}
					console.log(data);
				},
				error: function(request, status, error) {
					console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
		}
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
		var lgurl = "<?=$mobile_dir?>/member/login_process.php";
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
<input type="hidden" id="his_email" name="his_email" value="<?=$_POST['email']?>">
<input type="hidden" id="mode" name="mode">
<input type="hidden" id="uid" name="uid" value="<?=$_POST['uid']?>">
</form>
	<div class="find_contents">
		<h1>인증메일 재발송</h1>
		<div class="id_form">
			<table cellpadding="0" cellspacing="0" width="100%" border="0" id="id_form">
				<col width="100px">
				<col width="300px">
				<tr>
					<td>이름</td>
					<td><input type="text" name="uname" id="uname" placeholder="이름 입력바랍니다" value="<?=$_POST['nickname']?>" readonly></td>
				</tr>
				<tr>
					<td style="height:3px"></td>
				</tr>
				<tr>
					<td>이메일</td>
					<td><input type="text" class="email" name="email1" id="email1" maxlength="30">&nbsp;&nbsp;@ &nbsp;
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
			<div class="id_find_button">
				<button id="email_send">인증메일 재발송</button>
			</div>
		</div>
		
	</div>

<?
include(BASE_DIR.'inc/html/foot_m.html');

?>

