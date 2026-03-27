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
			body {width:100%;height:100%;background: url('http://mrlotto.co.kr/land/img/land1-bg.jpg');background-size:cover;}
			img {border:0; width:100%}
			.db {background:url('http://mrlotto.co.kr/land/img/db_img-1008.jpg');width:755px; height:803px;margin:0 auto;padding-top:450px;box-sizing: border-box;margin-bottom:100px}
			.db input {border:1px solid #b2b2b2; width:100%; padding-left:15px; padding:3% 0 3% 3%;font-size:1.3rem;box-sizing: border-box;}/*margin-left:-23px*/
			#tel {margin-bottom:25px}
			/*.db a {margin-left:-23px}*/
			.footer {display: none}
			
			@media (max-width:768px){
				.db {width:80%;background-size: 100%;background-repeat: no-repeat;padding-top:46%;height:100%;padding-bottom:8%}
				.db input {margin:0 auto;width:86%;margin-left:7%;padding:2%;font-size:1.1rem}
				.db a {margin:0 auto;width:50%;margin-left:7%;}
				#tel {margin-bottom:15px}
				.db a img {width:86%}
				.footer {display: block;}
			}
		</style>
	</head>
	<?
include "./jquery_dev.html";
	?>
	<body style="max-width:900px; margin:0 auto;">
		<img src="http://mrlotto.co.kr/land/img/land1-img1-1008.png" style="box-sizing: border-box">
		<div class="db">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto">
				<tr>
					<td><input type="text" placeholder="이름" name="uname" id="uname"></td>
				</tr>
				<tr>
					<td style="height:5px"></td>
				</tr>
				<tr>
					<td><input type="text" placeholder="연락처" name="tel" id="tel"></td>
				</tr>
				<tr>
					<td><a href="javascript:;" id="create"><img src="http://mrlotto.co.kr/land/img/db_bt-1008.jpg"></a></td>
				</tr>
				<tr>
					<td style="padding-top:15px"><img src="http://mrlotto.co.kr/land/img/ps2.jpg"></td>
				</tr>
			</table>
		</div>
		<footer class="footer" style="width:100%">
			<img src="http://mrlotto.co.kr/land/img/footer-img.jpg">
			<div class="copyright" style="background:#000; padding:1% 2%; text-align: center">
				<span style="font-size:12px; color:#9d9d9d;">Copyright © MrQuant Corp. All right reserved.</span>
			</div>
		</footer>

	</body>
	
</html>
