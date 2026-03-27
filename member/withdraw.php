<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
include(BASE_DIR.'inc/html/mypage.html');

login_check();
$dbc = dbOpen();

?>
<script type="text/javascript">
$(document).ready(function(){
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
		if(confirm("탈퇴하시겠습니까.")){
			var lgurl = "/member/login_process.php";
			var form_data = {
				user_id: "<?=$_SESSION[userid]?>",
				mode : "mem_wdraw"
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
						alert("탈퇴신청되었습니다");
						top.location.href="/";
						return false;
					}
				},
				error: function(request, status, error) {
					console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);

				}
			});
		} else {
			return;
		}
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
			<h1>탈퇴 관리</h1>
			<div>
				<form method="post" id="form1" name="form1">
				<input type="hidden" name="mode" id="mode">
				<div class="withdraw1" id="mod_view01">
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
				<div class="withdraw2"  id="mod_view02">

					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<col width="100px">
						<col width="300px">
						<tr>
							<td>이름</td>
							<td><input type="text" placeholder="저장된 이름" name="nickname" value="<?=$_SESSION['nickname']?>" readonly></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>아이디</td>
							<td><input type="text" placeholder="저장된 아이디" name="userid" value="<?=$_SESSION['userid']?>" readonly></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>휴대폰 번호</td>
							<td><input type="text" placeholder="저장된 전화번호" name="phone" value="<?=$_SESSION['tel']?>" readonly></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>이메일</td>
							<td><input type="text" placeholder="저장된 이메일 주소" name="email" value="<?=$_SESSION['email']?>" readonly></td>
						</tr>
						<tr>
							<td style="height:25px"></td>
						</tr>
						<tr>
							<td>이용중인 상품</td>
							<td>저장된 상품 ( 예 : 프리미엄 회원권 2년제 )<br><span>( 남은 기한 8개월 2주 )</span></td>
						</tr>
					</table>
					<div class="withdraw_txt">정말로 탈퇴하시겠습니까? 
					<div>탈퇴 시 이용중인 서비스에 잔여 금액은<br>미스터로또씨에서 실시하고 있는 신뢰 환불 보장제도에 의거하여 처리되어집니다.<a href="#"  onclick="window.open('http://image.mrlotto.co.kr/guarantee.jpg','','width=600,height=857,scrollbars=no,top=30,left=30');">환불 보장제도 자세히 보기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+</a></div></div>
					<a href="javascript:;" id="mod_ok">탈퇴 신청</a>
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