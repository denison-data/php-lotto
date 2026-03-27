<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
?>
<!doctype html>
<html lang="ko">
	<head>
		<title>[미스터로또씨] 황금돼지의 주인공이 될 수 있는 번호 대 공개!</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="css/reset.css">
		<style>
			input {line-height: 250%;font-size: 1.4em;padding-left:10px;box-sizing: border-box;width:100%;border-radius: 10px;border:1px solid #ddd;height:60px}
			input::-webkit-input-placeholder {color:#bfbfbf;}
			input::-moz-input-placeholder {color:#bfbfbf}
			input::-ms-input-placeholder {color:#bfbfbf;}
			.phone {margin-top:2%;}
			.phone input, .phone select {width:32%;vertical-align: bottom;font-size: 1.4em;padding-left:10px;}
			select {display: inline-block; height: 60px;background-color:#fff; border:1px solid #ddd}
			a {color: inherit; text-decoration: none;font-weight: bold}
			input[type="checkbox"] {height:auto}
			
			@media (max-width:768px) {
				input {font-size: 1em; height: 44px}
				input[type="checkbox"] {height:auto}
				.phone input, .phone select {font-size:1em; width: 31% !important;vertical-align: middle}
				select {height: 44px}
				
			}
			@media (max-width:500px) {
				.foot {font-size:0.6rem !important;}
			}

.progress-bar .bar {
	background:#000; border: 1px solid #000; border-radius:5px;border-image: none; height: 9px;
}
.progress-bar .bar i {
	background:#f60000; width: 0px; height: 9px; display: block;border-radius:5px;
}


		</style>
	</head>
<?
include "./jquery.html";
?>
<script type="text/javascript">
window.onload = function(){
	$("#display02").hide();
	var status = new Array();
    status[0] = '로또번호 조합 대기중..';
    status[25] = '실시간 로또데이터 분석중..';
    status[50] = '예상 번호 조합 중..';
    status[75] = '45개 번호 추출 중…';
    status[100] = '1등 당첨번호 분석 완료!';
	var progress_per = 0;
    var $bar = $('.progress-bar .bar i');
    var $status = $('.progress-bar .status');
    var $per = $('.progress-bar .per');
    var progress_hd = 0;

	$(".wrap").click(function(){
		btn_start();
	});

	function btn_start() {
		progress_go();
	}

	function progress_go() {
		progress_hd = 1;
		if (progress_per > 100){
				progress_hd = 0;
				$(".box2").css("display","block");
				$(".box1").css("display","none");
				console.log('aaa');

				$("#display01").hide();
				$("#display02").show();
					return false;
			}
			$bar.width(progress_per+'%');
			$status.text(status[progress_per]);
			$per.text(progress_per+'%');
			progress_per += 25;
			setTimeout(progress_go, 500);
	}
}
</script>
	<body style="max-width: 700px; margin: 0 auto">
<div id="display01">
		<img src="img/pig1.jpg">
		<img src="img/pig2.jpg">
		<div class='progress-bar'>
			<div class="bar" style="width:80% !important;margin: 0 auto;margin-top:3%; margin-bottom:1%"><i style="width: 0%;"></i></div>
			<div style="color: #111;text-align: center" class="status">로또번호 조합 대기중...</div>
		</div>
		<div style="text-align: center;margin:7% 0"><a href="javascript:;" class="wrap"><img src="img/pig3.jpg" style="width: 45%"></a></div>
		<div style="text-align: center">
			<img src="img/pig4.jpg" style="width: 25%;margin-bottom:1%">
			<div style="color: #bbb;font-size: 0.85rem">만 19세 미만 미성년자는 참여할 수 없습니다.</div>
		</div>
		<div class="foot" style="background-color: #111;color:#fff;font-size: 0.85rem;text-align: center;padding: 2% 0; line-height: 150%;margin-top:5%">
			미스터퀀트 주식회사      TEL : 1811-7335      FAX : 02-2067-3090      대표이사 : 조정윤<br>
개인정보책임관리자 : 조정윤      사업자등록번호 : 547-88-01224<br>
서울특별시 금천구 가산디지털1로 142, 1118호 (가산동, 가산더스카이밸리 1차)<br>
<span style="color: #ccc !important;font-size: 0.8em;">COPYRIGHT ⓒ 2018 Mr.quant All rights reserved. </span>
		</div>
</div>

<div id="display02">
	<img src="img/pig5.jpg">
		<div style="width: 80%;margin: 0 auto;padding-top:5%">
			<input type="text" placeholder="이름을 입력하세요." name="uname2" id="uname2" >
			<div class="phone">
				<select name="cellnum" id="cellnum">
					<option value="010">010</option>
					<option value="011">011</option>
					<option value="016">016</option>
					<option value="017">017</option>
					<option value="018">018</option>
					<option value="019">019</option>
				</select>
				<input name="cellnum2" id="cellnum2" type="tel" style="margin:0 1%" maxlength="4">
				<input name="cellnum3" id="cellnum3" type="tel" maxlength="4">
			</div>
		</div>
		<div style="text-align: center;margin-top:2%">
			<div><input type="checkbox" style="display: inline-block;width: auto" id="pri1" checked><label for="pri1">개인정보 수집 및 활용동의<span style="color:red">(필수)</span><a href="pri.php" target="_blank" style="padding-left:10px">[내용보기]</a></label></div>
			<div><input type="checkbox" style="display: inline-block;width: auto" id="pri2" checked><label for="pri2">광고성 문자메세지/알림톡 수신동의<span style="color:red">(필수)</span></label></div>
		</div>
		<div style="text-align: center;margin:7% 0"><a href="javascript:;" id="create2"><img src="img/pig6.jpg" style="width: 50%"></a></div>
		<div style="text-align: center">
			<img src="img/pig4.jpg" style="width: 25%;margin-bottom:1%">
			<div style="color: #bbb;font-size: 0.85rem">만 19세 미만 미성년자는 참여할 수 없습니다.</div>
		</div>
		<div class="foot" style="background-color: #111;color:#fff;font-size: 0.85rem;text-align: center;padding: 2% 0; line-height: 150%;margin-top:5%">
			미스터퀀트 주식회사      TEL : 1811-7335      FAX : 02-2067-3090      대표이사 : 조정윤<br>
개인정보책임관리자 : 조정윤      사업자등록번호 : 547-88-01224<br>
서울특별시 금천구 가산디지털1로 142, 1118호 (가산동, 가산더스카이밸리 1차)<br>
<span style="color: #ccc !important;font-size: 0.8em;">COPYRIGHT ⓒ 2018 Mr.quant All rights reserved. </span>
		</div>

</div>
	</body>
</html>
