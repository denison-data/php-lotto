<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
include(BASE_DIR.'inc/html/mypage.html');

login_check();
$dbc = dbOpen();
$uid = $_SESSION['userid'];
$qry = "Select * from member Where userid in ('$uid')";

$rs = dbQuery($qry, $dbc);
$data = mysqli_fetch_array($rs);

$email = $data['email'];

$email_array  = explode("@",$email);
$email_ext = $email_array[1];
if(in_array($email_ext,array_keys($emailArray))){
	$chose = $email_ext;
} else {
	$chose = "e";
}

?>
<script type="text/javascript">
$(document).ready(function(){
<?
	if($chose=="e"){
?>
	$("#email_ext").append("<input type='text' name='email_exts' id='email_exts' value='<?=$email_ext?>'>");
<?
	}
?>
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
	$("#pwdc").focus();
	$("#mod_view02").hide();

	$("#pwd_ck").on("click",function(){
		if($.trim($("#pwdc").val()).length==0){
			alert('필수입력입니다');
			$("#pwdc").focus();
			return false;
		}
		login_ck_func();

	});
	$("#pwdc").keydown(function(key) {
		if (key.keyCode == 13) {
			if($("#pwdc").val().length==0){
				alert("비밀번호 입력바랍니다");
				$("#pwdc").focus();
				return false;		
			}
			login_ck_func();
		}
	});

	$("#mod_ok").on("click",function(){
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
		
		var lgurl = "/member/login_process.php";
		var form_data = {
			user_id : $("#uid_ck").val(),
			user_pw: $("#passwd_ck").val(),			
			email : $("#email1").val(),
			email2 : $("#email2").val(),
			email_ext : $("#email_exts").val(),
			mode : "mem_edit"
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
					alert('수정 되었습니다');
					top.location.href="/member/modify.php";
				} else {
					alert('수정실패.');
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
function login_ck_func(){
	var lgurl = "/member/login_process.php";
	var form_data = {
		user_pw: $("#pwdc").val(),
		user_id: "<?=$_SESSION[userid]?>",
		mode : "pw_check"
	};
	$.ajax({
		type	:	"POST",
		url		:	lgurl,
		data : form_data,
		async: false,
		dataType : "json",
		cache: false,
		success : function(data){
			if(data['status']=="0"){
				$("#mod_view01").hide();
				$("#mod_view02").show();
			} else {
				alert("비밀번호 오류입니다.");
				$("#pwdc").val("");
				$("#pwdc").focus();
				return false;
			}
		},
		error: function(request, status, error) {
			console.log("error");
		}
	});
}
</script>
			
			<h1>나의 정보 수정</h1>
			<div>
				<form method="post" id="form1" name="form1">
				<input type="hidden" name="mode" id="mode">
				<div class="modify2" id="mod_view01">
					<div class="txt">한번 더 본인 확인을 위해 패스워드를 입력해주세요</div>
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<col>
						<col width="382px">
						<col>
						<tr>
							<td>비밀번호</td>
							<td><input type="password" id="pwdc" name="pwdc"></td>
							<td><a href="javascript:;" id="pwd_ck">확인</a></td>
						</tr>
					</table>
				</div>
				<div class="modify1" id="mod_view02">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<col width="100px">
						<col width="300px">
						<tr>
							<td>이름</td>
							<td><input type="text" placeholder="저장된 이름 영역(입력 불가, 비활성화 시켜주세요)" value="<?=$_SESSION['nickname']?>" readonly></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>아이디</td>
							<td><input type="text" placeholder="저장된 아이디 영역(입력 불가, 비활성화 시켜주세요)" value="<?=$_SESSION['userid']?>" readonly id="uid_ck" name="uid"></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>새 비밀번호</td>
							<td><input type="password" placeholder="최소 8자 이상 / 영,숫,특수문자 포함해서 입력해 주세요" id="passwd_ck" name="passwd"></td>
						</tr>
						<tr>
							<td>새 비밀번호 확인</td>
							<td><input type="password" style="margin-top:-1px" id="passwd_ex" name="passwd_ex"></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>휴대폰 번호</td>
							<td><input type="text" placeholder="저장된 휴대폰 번호" id="phone" name="phone" value="<?=$_SESSION['tel']?>" readonly></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>이메일 주소</td>
							<td>
								<input type="text" class="email" name="email1" id="email1" maxlength="30" value="<?=$email_array[0]?>">&nbsp;&nbsp;@ &nbsp;
								<select name="email2" id="email2">
								<?
								foreach($emailArray as $es => $arr){
								?>
									<option value="<?=$es?>" <? if($es==$chose){?>selected <? } ?>><?=$arr?></option>
								<?
								}
								?>
								</select>

								<div id="email_ext">
								</div>
							</td>
						</tr>
					</table>
					<a href="javascript:;" id="mod_ok">수정 완료</a>
				</div>
				</form>
			</div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->

<?
include(BASE_DIR.'inc/html/foot.html');

?>