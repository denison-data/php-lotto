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
			body {margin:0; padding:0}
			img {border:0; width:100%}
			.img1 {width:100%;background: url('http://mrlotto.co.kr/land/img/land5_bg1.jpg'); background-size: contain}
			.img1 img {max-width:900px;}
			.img2 {background: url('http://mrlotto.co.kr/land/img/land5_bg2.jpg') repeat-x; background-size: contain;height:13px}
			.img3 {background-color: #111}
			.img3 img {max-width:900px;}
			.img4 {background: url('http://mrlotto.co.kr/land/img/land5_bg3.jpg') repeat-x; background-size: contain;height:13px}
			.img5 {background-color: #4524b9;padding:8%}
			.img5 img {max-width:900px;}
			.db {max-width:900px;margin: 0 auto}
			.db input {width:60%;display: block;margin: 0 auto;padding:3% 0 3% 3%;border:none;font-size:1.2rem;margin-bottom:1%;border-radius: 0}
			.db a {display: inline-block;margin-top:5%;width:40%}
		</style>
	</head>

<?
/*필수*/
include "./jquery.html";
?>		
<script type="text/javascript" src="./roolet.js?dev=<?=date("YmdHis")?>"></script>
<script type="text/javascript">
window.onload = function(){
	roolet();
};
</script>
<style type="text/css">
#container {
	width:90%;
	height:12.5vw;
	overflow:hidden;
	margin:0 auto;
	border:13px solid #150942;
	border-radius: 5px;
	position: relative;
	padding-top: 3px;
}

#container div {
	position:relative;
	width: calc(16.666 / 100 * 100%);
	float:left;
	overflow:hidden;
}

#container div img {
	width:100%;
	height:100%;
}
#container .left {
	position: absolute;
	z-index: 99999;
	width:3%;
	top:45%;
	left:-0.5%;
}
#container .right {
	position: absolute;
	z-index: 99999;
	width:3%;
	top:45%;
	right:-0.5%;
}

</style>
	<body>
		<div class="img1" style="text-align: center"><img src="http://mrlotto.co.kr/land/img/land5_img1.png"></div>
		<div class="img2" style="text-align: center"></div>
		<div class="img3" style="text-align: center"><img src="http://mrlotto.co.kr/land/img/land5_img2.jpg"></div>
		<div class="img4" style="text-align: center"></div>
		<!--머신-->
		<div class="img5" style="text-align: center" >
			<div id="container">
				<p class="left"><img src="http://mrlotto.co.kr/land/img/left.png"></p>
				<p class="right"><img src="http://mrlotto.co.kr/land/img/right.png"></p>
			<!---머신 start-->
				<div id="one">
					<?
					for($i=1;$i<=8;$i++){
					?>
					<img src="img/<?=$i?>.jpg" />
					<?
					}
					?>
				</div>
				<div id="two">
					<?
					for($i=9;$i<=16;$i++){
					?>
					<img src="img/<?=$i?>.jpg" />
					<?
					}
					?>
				</div>
				<div id="three">
					<?
					for($i=17;$i<=25;$i++){
					?>
					<img src="img/<?=$i?>.jpg" />
					<?
					}
					?>
				</div>
				<div id="four">
					<?
					for($i=26;$i<=33;$i++){
					?>
					<img src="img/<?=$i?>.jpg" />
					<?
					}
					?>
				</div>
				<div id="five">
					<?
					for($i=34;$i<=40;$i++){
					?>
					<img src="img/<?=$i?>.jpg" />
					<?
					}
					?>
				</div>
				<div id="six">
					<?
					for($i=41;$i<=45;$i++){
					?>
					<img src="img/<?=$i?>.jpg" />
					<?
					}
					?>
				</div>
			</div>
			
			<!---머신 start-->
			<img src="http://mrlotto.co.kr/land/img/land5_bg5.jpg">
			<div class="db" style="text-align: center">
				<input type="text" placeholder="이름" name="uname" id="uname">
				<input type="text" placeholder="연락처" name="tel" id="tel">
				<a href="javascript:;" id="create"><img src="http://mrlotto.co.kr/land/img/land5_bt.jpg"></a>
			</div>
		</div>
	</body>
</html>
