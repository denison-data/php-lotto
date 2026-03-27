<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');
include(BASE_DIR.'inc/html/head_m_member.html');
login_check_m();
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
			var lgurl = "<?=$mobile_dir?>/member/login_process.php";
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
	var lgurl = "<?=$mobile_dir?>/member/login_process.php";
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

<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/info_tit.jpg"></h2>
	<div class="sub_menu_button">
		<a href="./modify.php" >나의 정보 수정</a><a href="./withdraw.php" class="on">탈퇴관리</a>
	</div>
</div>

<form method="post" id="form1" name="form1">
<input type="hidden" name="mode" id="mode">		
<div class="sub_search_bg2" id="mod_view01">
	<div class="contents" style="padding:10% 0">
		<p class="mypage4_tit">한번 더 본인 확인을 위해 패스워드를 입력해 주세요</p>
		<input type="password" id="pwdc" name="pwdc" class="inp2" placeholder="비밀번호를 입력하세요">
		<a href="javascript:;" id="pwd_ck" class="blue_bt search_bt" style="margin-top:5%">확인</a>
	</div>
</div>

<div  id="mod_view02">
	<div>
		<div class="member_contents">
			<p class="inp_tit">이름</p>
			<input type="text" placeholder="저장된 이름 영역(수정 불가, 비활성화 시켜주세요)" class="inp_desa" name="nickname" value="<?=$_SESSION['nickname']?>" readonly>
			<p class="inp_tit">아이디</p>
			<input type="text" placeholder="저장된 아이디 영역(수정 불가, 비활성화 시켜주세요)" class="inp_desa" name="userid" value="<?=$_SESSION['userid']?>" readonly>
			<p class="inp_tit">휴대폰 번호</p>
			<input type="text" placeholder="저장된 핸드폰 번호 영역(수정 불가, 비활성화 시켜주세요)" class="inp_desa" name="phone" value="<?=$_SESSION['tel']?>" readonly>
			<p class="inp_tit">이메일 주소</p>
			<div style="position: relative">
				<input type="text" placeholder="저장된 이메일 영역(수정 불가, 비활성화 시켜주세요)" class="inp_desa" maxlength="17" name="email" value="<?=$_SESSION['email']?>" readonly>
			</div>
			<p class="inp_tit">이용중인 상품</p>
			<div style="margin-top: 3%"><p style="font-size:1.1em;color:#2a76ce">저장된 상품 (예 : 프리미엄 회원권 2년제)</p><p style="font-weight: 200">(남은 기한 8개월 2주)</p></div>
			
		
		</div>
	</div>
		
	<div class="gray_box" style="margin-top:5%;padding:4%">
		<p class="wit_txt1" >정말로 탈퇴하시겠습니까 ?</p>
		<p class="wit_txt2">탈퇴 시 이용중인 서비스에 잔여금액은 미스터로또씨에서 실시하고 있는 신뢰 환불 보장제도에 의거하여 처리되어 집니다.</p>
		
		<div class="wit_bt"><a href="http://image.mrlotto.co.kr/mobile/m_1.jpg" class="pri_bt2" target="_new">환불 보장제도 자세히 보기&nbsp;&nbsp;&nbsp;+</a></div>
	</div>

	<div class="contents" style="margin-top:0 !important"><a href="javascript:;" id="mod_ok" class="bt blue_bt" style="margin-top: 0">수정 완료</a></div>
</div>
</form>
<?
include(BASE_DIR.'inc/html/foot_m.html');

?>