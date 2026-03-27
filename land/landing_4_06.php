<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');

$rand = rand(1,10);

if($rand!=0){
	$rand1 = rand(1,45);
	$rand2 = rand(1,45);
	
} else {
	$rand1 = rand(92, 124);
	$rand2 = rand(92, 124);
}

$arr = array($rand1,$rand2);
shuffle($arr);

?>
<!doctype html>
<html lang="ko">
	<head>
		<title>[미스터로또씨] 룰렛 돌리고 무료 로또 번호 받자!</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="css/reset.css">
		<style>
			img {width:100%}
			.land4_button {max-width:900px;width:100%;height:50%;padding-top:17.3%;position: absolute;text-align:center;z-index: 999}
			.land4_rull {width:70%;margin:0 auto;background: url('http://mrlotto.co.kr/land/img/land4-bg3.png') top center no-repeat;background-size: contain;position: relative}
			.land4_rull td {vertical-align: middle;text-align: center;padding:5.5%}
			.txt {margin-top:-10%;background: url('http://mrlotto.co.kr/land/img/land4-bg5.png') center; background-size: cover;}
			.txt img {margin-top:5%; padding:10% 7%; box-sizing: border-box}
			.pin {max-width:900px;width:100%;height:45%;padding-top:17.3%;position: absolute;text-align:center;z-index: 99}
			.pin img {width:5%}
			@media (max-width:768px){
			.land4_button {padding-top:27.8%}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-8px;padding-top:0}
			.ok_bt {width:55%; text-align: center !important;margin:0 auto !important}
			}
			@media (min-width:769px) and (max-width:1024px){
			.land4_button {padding-top:27%;}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-10px;padding-top:0}
			}
			@media (min-width:1025px) and (max-width:1800px){
			.land4_button {width:100%;margin:0 auto;text-align:center; margin-top:245px;padding-top:0;}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-20px;padding-top:0}
			}
			@media (min-width:1801px){
			.land4_button {width:100%;margin:0 auto;text-align:center; margin-top:245px;padding-top:0;}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-20px;padding-top:0}
			}
			.db input {width:70%;display: block;margin: 0 auto;padding:3% 0 3% 3%;border:1px solid #111;font-size:0.8rem;margin-bottom:1%;border-radius:5px;}
			.db .ok_bt {text-align: center;margin:5% 0 8% 0}
			.db a {display: inline-block;margin: 0 auto}
		</style>
	</head>
<?
include "./jquery.html";
?>
<script type="text/javascript">
window.onload = function(){
	var pArr = ["1개월","꽝","3개월","꽝","1개월","꽝","3개월","꽝"];
	$("#result_view").hide();
	$('#start_btn').click(function(){
		rotation();
	});	
	function rotation(){
		$("#image2").rotate({
		  angle:0, 
		  animateTo:360 * 3 +<?=$arr[0]?>,
		  center: ["50%", "50%"],
		  easing: $.easing.easeInOutElastic,
		  callback: function(){ 
				var n = $(this).getRotateAngle();
				endAnimate(n);
			},
		  duration:5000
	   });
	}
	function randomize($min, $max){
		return Math.floor(Math.random() * ($max - $min + 1)) + $min;
	}
	function endAnimate($n){
		var n = $n;
		var real_angle = n%360;
		var part = Math.floor(real_angle/45);
		var gb,imgs;
		if(part==0){
			gb= 0;
			imgs = "http://mrlotto.co.kr/land/img/cong1.jpg";
			$("#etc").val("1개월쿠폰");
		} else {
			gb = part;
			imgs = "http://mrlotto.co.kr/land/img/cong1-1.jpg";
			$("#etc").val("3개월쿠폰");

		}
		$("#result_view").show();
		$("#views").attr("src",imgs);
		//console.log(part+"||"+pArr[gb]+"||"+gb+"||"+<?=$arr[0]?>);
	}
};
</script>

	<body style="max-width:900px; margin:0 auto;position: relative">
		<div style="width:100%;background: url('http://mrlotto.co.kr/land/img/land4-bg4.jpg'); background-size: 100%">
			<div><img src="http://mrlotto.co.kr/land/img/land4-img1-1008.png"></div>
			<div style="position: absolute;z-index: 99"><img src="http://mrlotto.co.kr/land/img/land4-bg2.png"></div>
			<div class="land4_button"><a href="javascript:;" id="start_btn"><img src="http://mrlotto.co.kr/land/img/land4-bt.png" style="width:15%"></a></div>
			<table class="land4_rull" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td><img src="http://mrlotto.co.kr/land/img/land4-img3.png" style="width:100%" id="image2"></td>
				</tr>
			<div class="pin"><img src="http://mrlotto.co.kr/land/img/land4-pin.png"></div>
			</table>
		</div>
		<div class="txt">
			<img src="http://mrlotto.co.kr/land/img/land4-img4-1008.jpg">
		</div>
		<img src="http://mrlotto.co.kr/land/img/land4-txt.jpg">
		<div style="box-shadow:0px 0px 10px;width:70%;background-color: #fff;position:absolute;top:30%;left:15%;z-index: 99999;" id="result_view">
			<div style="padding:5% 7%"><img id="views"></div>
			<div style="background-color:#f8f8f8;padding:2% 7%" class="db">
				<img src="http://mrlotto.co.kr/land/img/cong2.jpg">
				<input type="hidden" id="etc" name="etc">
				<input type="text" placeholder="이름" name="uname" id="uname"> 
				<input type="text" placeholder="연락처" name="tel" id="tel">
				
<div style="text-align: center;padding-top:1%" class="check"><input type="checkbox" style="display: inline-block;width: auto;text-decoration: none;color:#666" id="check" checked=""><label style="font-size: 0.7em" for="check">&nbsp;&nbsp;개인정보취급방침 동의 <a href="pri.php" target="_blank" style="font-size: 1em;text-decoration: none;color: #888">[약관보기]</a></label></div>

				<div style="text-align: center;padding-bottom:1%" class="check2"><input type="checkbox" style="display: inline-block;width: auto;text-decoration: none;color:#666" id="check2" checked=""><label style="font-size: 0.7em" for="check2">&nbsp;&nbsp;문자수신 동의</label></div>
				<div class="ok_bt"><a href="javascript:;" id="create"><img src="http://mrlotto.co.kr/land/img/ok_button-1008.jpg"></a></div>
			<div>
				<img src="http://mrlotto.co.kr/land/img/ps.jpg">
			</div>
			</div>
		</div>
		<footer class="footer" style="width:100%">
			<img src="http://mrlotto.co.kr/land/img/footer11.jpg">
			<div class="copyright" style="background:#000; padding:1% 2%; text-align: center">
				<span style="font-size:12px; color:#9d9d9d;">Copyright © MrQuant Corp. All right reserved.</span>
			</div>
		</footer>
		
		

	</body>
</html>
