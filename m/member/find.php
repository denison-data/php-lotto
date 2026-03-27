<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');

?>
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
		var lgurl = "<?=$mobile_dir?>/member/login_process.php";
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
<input type="hidden" id="mode" name="mode">
</form>
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/id_tit.jpg"></h2>
</div>
<div class="member_contents" style="padding-top:0 !important">
	<p class="inp_tit">이름</p>
	<input type="text" placeholder="이름을 입력하세요" class="inp" name="uname" id="uname">
	<p class="inp_tit">휴대폰 번호</p>
	<input type="text" placeholder="-를 제외하고 입력하세요" class="inp" name="phone" id="phone">
	<a href="javascript:;" id="id_search" class="bt blue_bt">아이디 찾기</a>
</div>

<div class="contents sub" style="margin-top:8%">
	<h2><img src="http://<?=$img_url?>/mobile/pass_tit.jpg"></h2>
</div>
<div class="member_contents" style="padding-top:0 !important">
	<p class="inp_tit">아이디</p>
	<input type="text" placeholder="아이디를 입력하세요" class="inp" name="uid2" id="uid2">
	<p class="inp_tit">이름</p>
	<input type="text" placeholder="이름을 입력하세요" class="inp" name="uname2" id="uname2">
	<p class="inp_tit">휴대폰 번호</p>
	<input type="text" placeholder="-를 제외하고 입력하세요" class="inp" name="phone2" id="phone2">
	<a href="javascript:;" class="bt blue_bt" id="pw_search">비밀번호 찾기</a>
</div>
<?
include(BASE_DIR.'inc/html/foot_m.html');

?>