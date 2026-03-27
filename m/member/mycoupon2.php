<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');
include(BASE_DIR.'inc/html/head_m_member.html');
//login_check_m();
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#coupon_ins").on("click",function(){
		if($.trim($("#coupon_txt").val())==""){
			alert('필수 입력 입니다.');
			$("#coupon_txt").focus();
			return false;
		}
		var formData = {
			mcode : "<?=$_SESSION['code']?>",
			cpcod : $("#coupon_txt").val(),
			mode  : "coupon_ins"
		};
		var gurl = "./login_process.php";
		$.ajax({
			type	:	"POST",
			url		:	gurl,
			data : formData,
			dataType : "json",
			async: false,
			cache: false,
			success : function(data){
				//console.log(data);
				if(data['status']=="0"){
					alert('쿠폰 등록이 되었습니다');
					top.location.href="./mycoupon.php";
				} else {
					alert('쿠폰 등록이 되지 않았습니다.\이미 등록을 했거나 쿠폰코드가 잘못되었습니다.');
				}
			},
			error: function(request, status, error) {
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
		return false;

	});
});
</script>

<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/coupon_tit.jpg"></h2>
	<div class="sub_menu_button">
		<a href="./mycoupon.php">내 쿠폰 보관함</a><a href="./mycoupon2.php"  class="on">쿠폰 등록</a>
	</div>
</div>

		
<div class="sub_search_bg">
	<div class="contents" style="padding:10% 0">
		<input type="text" class="inp2" id="coupon_txt" name="coupon_txt" placeholder="일련번호 20자리를 입력하세요">
		<a href="javascript:;" id="coupon_ins" class="blue_bt search_bt" style="margin-top:5%">쿠폰 등록</a>
	</div>
</div>
<?
include(BASE_DIR.'inc/html/foot_m.html');
?>
