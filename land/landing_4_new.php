<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');

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
			.land4_rull {width:72.7%;margin:0 auto;position: relative}
			/*background: url('http://mrlotto.co.kr/land/img/light-bg.png') top center no-repeat;background-size: contain;*/
			.land4_rull td {vertical-align: middle;text-align: center;padding:5.5%}
			.txt {margin-top:-10%;background: url('http://mrlotto.co.kr/land/img/land4-bg5.png') center; background-size: cover;}
			.txt img {margin-top:5%; padding:10% 7%; box-sizing: border-box}
			.pin {max-width:900px;width:100%;height:45%;padding-top:17.3%;position: absolute;text-align:center;z-index: 99}
			.pin img {width:24%}
			@media (min-width:480px){
			.land4_rull {width:77.7%;}
			.land4_rull td {padding:8.5% !important}
			.light {position: absolute;top:21.2% !important}
			}
			@media (max-width:768px){
			.land4_button {padding-top:27% !important}
			.tit {margin-top:-5% !important;padding-bottom:5%}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-8px;padding-top:0}
			}
			@media (min-width:769px) and (max-width:1024px){
			.land4_button {padding-top:30.3% !important}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-10px;padding-top:0}
			}
			@media (min-width:1025px) and (max-width:1800px){
			.land4_button {padding-top:30.3% !important}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-0px;padding-top:0}
			}
			@media (min-width:1801px){
			.land4_button {width:100%;margin:0 auto;text-align:center; margin-top:245px;padding-top:0;}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-20px;padding-top:0}
			}
			.db input {width:70%;display: block;margin: 0 auto;padding:3% 0 3% 3%;border:1px solid #111;font-size:0.8rem;margin-bottom:1%;border-radius:5px;}
			.db .ok_bt {text-align: center;margin:15% 0 0 0}
			.db a {display: inline-block;margin: 0 auto}
			.light {position: absolute;z-index: 99;top:21.4%}
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
			imgs = "http://mrlotto.co.kr/land/img/n-db1.jpg";
			$("#etc").val("1개월쿠폰");
		} else {
			gb = part;
			imgs = "http://mrlotto.co.kr/land/img/n-db13.jpg";
			$("#etc").val("3개월쿠폰");

		}
		$("#result_view").show();
		$("#views").attr("src",imgs);
		//console.log(part+"||"+pArr[gb]+"||"+gb+"||"+<?=$arr[0]?>);
	}
	var current = document.location.pathname + window.location.search;
	var replaceBack = false;//'http://www.mrlotto.co.kr/land/landing_7.php?num=ready2';
	//history.replaceState({ data: replaceBack }, document.title , replaceBack);
	//history.pushState({ data: 0 }, document.title , current);
    //history.pushState({ data: 0 }, document.title , current);  
}
   window.addEventListener('popstate', function () {
        if(history.state.data){
			window.location.replace(history.state.data); 
        }   
  });
</script>


	<body style="max-width:700px; margin:0 auto;position: relative">
		<div style="width:100%;background: url('http://mrlotto.co.kr/land/img/n_bg.jpg'); background-size: cover; padding-bottom:27%">
			<div><img src="http://mrlotto.co.kr/land/img/line.jpg"></div>
			<div class="tit"><img src="http://mrlotto.co.kr/land/img/tit.png"></div>
			<div class="light" ><img src="http://mrlotto.co.kr/land/img/light-bg.png"></div>
			<div style="position: absolute;z-index: 99;top:21.4%"><img src="http://mrlotto.co.kr/land/img/rib-bg.png"></div>
		<div class="land4_button"><a href="javascript:;" id="start_btn"><img src="http://mrlotto.co.kr/land/img/start-bt.png" style="width:20.5%"></a></div>
			<table class="land4_rull" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td><img src="http://mrlotto.co.kr/land/img/rull-bg.png" style="width:100%" id="image2"></td>
				</tr>
			<div class="pin"><img src="http://mrlotto.co.kr/land/img/new-pin.png"></div>
			</table>
		</div>
		<!--div class="txt">
			<img src="http://mrlotto.co.kr/land/img/land4-img4-1008.jpg">
		</div-->
		<div><img src="http://mrlotto.co.kr/land/img/use.png"></div>
		<div style="width:100%;margin: 0 auto;height: 100%;background-color: #0d0d0d;position:absolute;top:0;left:0;z-index: 99999;" id="result_view">
			<div><img src="http://mrlotto.co.kr/land/img/line.jpg"></div>
			<div style="padding-top: 15%;"><img id="views"></div>
			<div style="width:80%;background-color:#0d0d0d; margin: 0 auto;overflow: hidden;" class="db">
				<img src="http://mrlotto.co.kr/land/img/n-db-gif.gif" style="margin-bottom:7%">
				<input type="hidden" id="etc" name="etc">
				<input type="text" placeholder="이름" name="uname" id="uname"> 
				<input type="text" placeholder="연락처" name="tel" id="tel">
				
				<div style="width: 68%;box-sizing: border-box;float: left;text-align: center;overflow: hidden;margin-top:3%" class="check">
					<input type="checkbox" id="check" checked="" style="width: auto !important; display: inline-block">
					<label for="check">
						<img src="http://mrlotto.co.kr/land/img/n-db2.jpg" style="width: 60% !important; display: inline-block; vertical-align: middle"> 
						<a href="pri.php" target="_blank" style="width:25%; ">
							<img src="http://mrlotto.co.kr/land/img/n-db3.jpg"  style="width:100%; display: inline-block;vertical-align: middle">
						</a>
					</label>
				</div>
				<div style="width: 32%;box-sizing: border-box;float: left;text-align: right;overflow: hidden;margin-top:3%" class="check2">
					<input type="checkbox" id="check2" checked="" style="width: auto !important; display: inline-block">
					<label for="check2">
						<img src="http://mrlotto.co.kr/land/img/n-db4.jpg" style="width: 84% !important; vertical-align: middle">
					</label>
				</div>
				
				
				
				
				<div class="ok_bt"><a href="javascript:;" id="create"><img src="http://mrlotto.co.kr/land/img/n-db5.jpg"></a></div>
			<div>
				<img src="http://mrlotto.co.kr/land/img/n-db6.jpg">
			</div>
			</div>
		</div>
		<footer class="footer" style="width:100%">
			<img src="http://mrlotto.co.kr/land/img/txt.png">
			<img src="http://mrlotto.co.kr/land/img/txt22.png">
			<!--div class="copyright" style="background:#000; padding:1% 2%; text-align: center">
				<span style="font-size:12px; color:#9d9d9d;">Copyright © MrQuant Corp. All right reserved.</span>
			</div-->
		</footer>
		
		

	</body>
</html>
