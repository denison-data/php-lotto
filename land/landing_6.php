<?
/*필수 include*/
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
?>
<!doctype html>
<html lang="ko">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="css/reset.css">
		<style>
			img {width:100%}
			.db {max-width:900px;margin: 0 auto;text-align: center;margin:5% 0}
			.db input {border:none;border-bottom:2px solid #111; width:70%; padding:3% 0 3% 3%;font-size:1.25rem;margin-bottom:3%}
			.db .ok_bt {width:70%; margin: 0 auto;margin-top:3%}
		</style>
	</head>
<script type="text/javascript">
window.onload = function(){
	var current = document.location.pathname + window.location.search;
	var replaceBack = 'http://www.mrlotto.co.kr/land/landing_7_back.php?num=ready2';
	history.replaceState({ data: replaceBack }, document.title , replaceBack);
	history.pushState({ data: 0 }, document.title , current);
};
window.addEventListener('popstate', function () {
	if(history.state.data){
		window.location.replace(history.state.data); 
	}   
});
</script>
<?
/*필수*/
include "./jquery.html";
?>	
	<body style="max-width:700px;margin:0 auto;margin-bottom:50px">	
		<img src="http://mrlotto.co.kr/land/img/land6_img1.jpg">
		<!--img src="http://mrlotto.co.kr/land/img/land6_img2.jpg"-->
		<div style="border:2px solid #1f54a4">
			<img src="http://mrlotto.co.kr/land/img/tit.jpg" style="border:1px solid white;box-sizing: border-box">
			<div class="db">
				<input type="text" placeholder="이름" name="uname" id="uname">
				<input type="text" placeholder="휴대폰번호" name="tel" id="tel">
				<div class="ok_bt"><a href="javascript:;" id="create"><img src="http://mrlotto.co.kr/land/img/land6_img3.jpg"></a></div>
			</div>
		</div>
		<div style="color:red;padding-top:2%;text-align:right">* 미성년자 참여 불가</div>
	</body>
</html>
