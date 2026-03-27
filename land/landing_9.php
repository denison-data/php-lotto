<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
?>
<!doctype html>
<html lang="ko">
	<head>
		<title>미스터로또씨</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="css/reset.css">
		<style>
			h1 {font-size:1.4em; padding:2% 4% 1% 4%;line-height: 120%;font-weight: bold}
			h1 span {font-size:1em}
			p {padding:0 4%; font-size: 0.8em;line-height: 130%}
			.gray {color:#666}
			input {box-sizing: border-box}
		</style>
	</head>
	<?
include "./jquery.html";
	?>	
	<body style="max-width: 640px; margin: 0 auto;padding-bottom:35%">
		<div style="max-width: 640px; margin: 0 auto;z-index: 100;position:fixed; bottom:0;"><img src="http://img.issuepoll.net/lottoc/banner5.jpg">
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%;background-color:#245aa6;padding:1%">
				<tr>
					<td style="color:#fff;width:7%;font-size: 0.8em;font-weight:bold">이름</td>
					<td style="width:15%"><input type="text" style="width:90%;border-radius: 3px;border: none;line-height:20px;padding-left:5px" name="uname2" id="uname2" ></td>
					<td style="color:#fff;text-align: center;width:10%;font-size: 0.8em;font-weight:bold">연락처</td>
					<td style="width:43%">
						<select style="width:30%;height:22px;border-radius: 3px;border: none;line-height:20px;padding-left:5px" name="cellnum" id="cellnum">
							<option>010</option>
							<option>011</option>
							<option>016</option>
							<option>017</option>
							<option>018</option>
							<option>019</option>
						</select>
						<input type="text" style="width:28%;border-radius: 3px;border: none;line-height:20px;padding-left:5px" name="cellnum2" id="cellnum2">
						<input type="text" style="width:28%;border-radius: 3px;border: none;line-height:20px;padding-left:5px" name="cellnum3" id="cellnum3">
					</td>
					<td style="width:20%"><a href="javascript:;" id="create2"><img src="t_quick_bt.png"></a></td>
				</tr>
			</table>
	
	  	</div>

		<img src="http://img.issuepoll.net/lottoc/img1.jpg">
		<div style="border-bottom:1px solid #eee">
			<h1><span style="color:red">[최신]</span> 팍팍해지는 가계 살림에<br>로또 구입하는 사람들 증가 추세</h1>
			<p class="gray">- 실제 로또 분석업체를 통해 당첨 사례 등장</p>
			<p class="gray" style="padding-bottom:2%">- 로또 분석업체를 통한 구입 늘어..!</p>
		</div>
		<div style="font-size:0.8em;text-align: right;padding-right:4%;color:#666">기사입력 : 
			<SCRIPT language="javascript">
				var today=new Date();

				today.setDate(today.getDate() - 1); //하루 전

				var day = (today.getDate());
				var month = (today.getMonth() + 1) ;

				if(day < 10) day = '0' + day;
				if(month < 10) month = '0' + month;

				document.write(today.getFullYear(),"-",month,"-",day);
 			</SCRIPT>
		</div>
		<p><img src="http://img.issuepoll.net/lottoc/img3.jpg"></p>
		<p style="line-height: 130%;text-align: justify;padding-top:4%">최근 힘들어진 경제 소식과 함께 오는 어려워진 가계 사정에 복권 판매량이 증가하고 있다. 판매량 증가에 따라 로또 분석업체도 늘고 있는데 최근 10년이 넘는 로또 분석을 통해 자신감을 나타내고 있는 업체가 눈에 띄고 있다.</p>
		<p style="padding:2% 4%">로또 분석업체인 '미스터로또씨'는 패턴, 비율, 멸구간, 고정수, 등 10년이 넘는 다양한 로또 분석 노하우를 통하여 번호를 추출해 고객들에게 서비스를 제공 하고있다.</p>
		<p>로또 분석업체를 고르더라도 신뢰할 수 있는 업체를 고르는것이 복권을 구매하는 사람들에게는 가장 중요할 것이다. 오랜 기간동안의 노하우와 뛰어난 분석을 자랑하는 로또씨를 지금 당장 이용해 보는것이 어떨까?</p>
	</body>
</html>
