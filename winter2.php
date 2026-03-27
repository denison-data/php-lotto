<?php
// PHP permanent URL redirection
if($_GET['mcode']){
	$mcode = $_GET['mcode'];
	header("Location: http://img.issuepoll.net/lottoc/html/winter2.html?mcode=$mcode", true, 301);

} else {
	header("Location: http://img.issuepoll.net/lottoc/html/winter2.html", true, 301);
}
exit();
?>
<!doctype html>
<html lang="ko">
	<head>
		<title>미스터로또씨</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
		<style>
			 *,body{margin:0;padding:0;} body{text-align:center;overflow-x:hidden; overflow-y:hidden;text-align:center;} 
		</style>
	</head>
	
	<body style="width:100%">
		<div style="position: relative;overflow: hidden;width: 100%;height: 600px"><a href="http://www.mrlotto.co.kr/land/landing_4.php?num=ready2&mcode=D1b7g" target="_blank" style="display: block;height: 600px;background-color:#120f05"><img src="http://img.issuepoll.net/lottoc/img/lottoc-8.jpg" style="width:160px;height:600px" style="display:block; margin: 0 auto"></a></div>
	</body>
</html>
