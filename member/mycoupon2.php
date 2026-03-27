<?

include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
include(BASE_DIR.'inc/html/mypage.html');

login_check();


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

			
			<h1>쿠폰</h1>
			<div>
				<div class="coupon_tab">
					<a href="./mycoupon.php">내 쿠폰 보관함</a>
					<a href="./mycoupon2.php" class="on2">쿠폰 등록</a>
				</div>
				<div class="coupon_register">
					<input type="text" id="coupon_txt" name="coupon_txt" placeholder="쿠폰번호 10자리를 입력하세요">
					<a href="javascript:;" id="coupon_ins">쿠폰 등록</a>
				</div>
			</div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->
<?
include(BASE_DIR.'inc/html/foot.html');

?>