<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');

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
	
	naver_id_login.get_naver_userprofile("naver_data()");
	$("#join_ok").on("click",function(){
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

		var lgurl = "<?=$mobile_dir?>/member/login_process.php";
		var form_data = {
			ecod : $("#ecod").val(),
			phone : $("#phone_ck").val(),
			mode : "naver_ups"
		};
		console.log(form_data);
		$.ajax({
			type	:	"POST",
			url		:	lgurl,
			data : form_data,
			dataType : "json",
			async: true,
			cache: false,
			success : function(data){
				console.log(data);
				if(data['status']=="0"){
					alert('정보가 업데이트 되었습니다\n');
					top.location.href="/";
				} else if(data['status']=="1"){
					alert('이미 등록된 전화번호입니다.');
					return false;
				} else if(data['status']=="2"){
					alert('이미 등록된 이메일입니다.');
					return false;
				} 
				
			},
			error: function(request, status, error) {
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
		return false;
	});
	$("#phone_ck").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
});
function inArray(needle, haystack) {
	var len = haystack.length;
	for(var i=0; i<len; i++) if(haystack[i] == needle) return true;
	return false;
}
function naver_data(){
	var fields = ["email","name","id"];
	var arrValues = {};
	for(var i = 0; i < fields.length; i++){
		arrValues[fields[i]] = naver_id_login.getProfileData(fields[i]);
		//$("#naver_data").append(arrValues[fields[i]]);
	}
	arrValues['mode'] = "naver_ins";
	var js_array = <?=json_encode($emailArray)?>;
	if(arrValues['id'].length==0){
		alert('시간이 너무 오래 경과되었습니다.');
		top.location.href="/";
	}
	//console.log(arrValues['id'].length);
	if(arrValues['email']==undefined){
		$("#email1").val("");
		$("#email2").val("");
		
	} else {
		var email_a = arrValues['email'].split("@");
		$("#email1").attr("readonly",true);
		$("#email1").val(email_a[0]);
		if(inArray(email_a[1],js_array)){
			$("#email2 option[value="+email_a[1]+"]").attr("selected",'selected');
			//$("#email_ext").append("<input type='text' name='email_exts' id='email_exts' value='<?=$email_ext?>'>");
		} else {
			$("#email_ext").show();
			$("#email_ext").html("");
			$("#email2 option[value=e]").attr("selected",'selected');

			$("#email_ext").append("<input type='text' name='email_exts' id='email_exts' value='"+email_a[1]+"' readonly class='inp'>");

		}
	}
	$("#email_views").show();
	$.post(mr_lotto + "/member/login_process.php", arrValues, function(arr){
		$("#ecod").val(arr.ecd);
		console.log(arr);
		if(arr.status=="ok"){
			$("#views").hide();
			setTimeout(function(){
				top.location.href="/";
			//	location.replace("/");
			},0);
		} else {

		}
	},"json").fail(function(data){
		console.log(data['responseText']);	
	});
}
</script>
<form method="post" name="form1" id="form1">
<input type="hidden" name="ecod" id="ecod">
<div class="member_contents">
	<p class="inp_tit">휴대폰 번호 <span class="red">(필수)</span></p>
	<input type="tel" placeholder="-를 제외하고 입력하세요" class="inp" id="phone_ck" name="phone" maxlength="11">
	<div id="email_views" style="display:none">
		<p class="inp_tit">이메일 주소 <span class="red">(네이버연결 Email)</span></p>
		<div style="position: relative" >
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
	</div>
	<div class="join_box">
		<div><p><input type="checkbox" id="pri1_check">이용약관 동의 <span class="red">(필수)</span><a href="<?=$mobile_dir?>/agree/join1.php" class="pri_bt" target="_blank">약관보기</a></p></div>
		<div><p><input type="checkbox" id="pri2_check">개인정보 수집 및 이용 동의 <span class="red">(필수)</span><a href="<?=$mobile_dir?>/agree/join2.php" class="pri_bt" target="_blank">약관보기</a></p></div>
		<div><p><input type="checkbox" id="pri3_check" target="_blank">마케팅 정보 수신 동의<a href="<?=$mobile_dir?>/agree/join3.php" class="pri_bt">약관보기</a></p></div>
	</div>
	<div class="join_check"><input type="checkbox" id="pri_check"><label for="pri_check"> 위 약관에 모두 동의합니다.</label></div>
	<a href="javascript:;" class="bt blue_bt" id="join_ok">추가정보 업데이트</a>
</div>
<?
include(BASE_DIR.'inc/html/foot_m.html');

?>
