<!doctype html>
<html lang="ko">
	<head>
		<title>미스터 로또씨</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<link rel="shortcut icon" href="http://image.mrlotto.co.kr/favicon.ico">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/pc/reset.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://mrlotto.co.kr/design/main.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/pc/nivo-slider.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="http://mrlotto.co.kr/design/styles.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/pc/sub.css?dev=<?=date("YmdHis")?>" type="text/css" media="screen" />


<script src="http://js.mrlotto.co.kr/pc/common.js?dev=<?=date("YmdHis")?>" type="text/javascript"></script>
		
<script type="text/javascript" src="http://js.mrlotto.co.kr/pc/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="http://js.mrlotto.co.kr/pc/jquery.nivo.slider.js?dev=<?=date("YmdHis")?>"></script>


		<script src="js/jquery.bxslider2.min.js" type="text/javascript"></script>
		<script src="js/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider();
});
/*SyntaxHighlighter.all();*/
</script>
		<style>
			html {width:100% !important}
			.bx_pager a {display: none}
			::-webkit-scrollbar {

				display:none;
				
				} 
		</style>
	</head>
	
	<body style="-ms-overflow-style: none;">
      
<script>
function layer_close(id,hiddenWay) {
	var obj = document.getElementById("expirehours"+ id);
	var tmpid = document.getElementById("pop"+id);
	if (obj.checked == true) {
		set_cookie("it_ck_pop_"+id, "done", obj.value, window.location.host);
	}
	if(hiddenWay == "ts_slideDownBack"){
		ts_slideDownBack(tmpid);
	}else if(hiddenWay == "ts_slideLeftBack"){
		ts_slideLeftBack(tmpid);
	}else if(hiddenWay == "ts_slideLeftDownBack"){
		ts_slideLeftDownBack(tmpid);
	}else if(hiddenWay == "ts_fadeInBack"){
		ts_fadeInBack(tmpid);
	}else{
		tmpid.style.display = "none";
	}
	selectbox_visible();
}
function selectbox_visible() 
{ 
	for (i=0; i<document.forms.length; i++) { 
		for (k=0; k<document.forms[i].length; k++) { 
			el = document.forms[i].elements[k];    
			if (el.type == "select-one" && el.style.visibility == 'hidden') 
				el.style.visibility = 'visible'; 
		} 
	} 
}
</script>
<style>
#pop8{
	position:absolute;
	z-index:9999999;
	width:420px;
	height:430px;
	filter:alpha(opacity=100);
	overflow : hidden;
	top:80px;
	left:100px;
}
</style>
<div id="pop8" >
	<div style="width:400px;overflow:hidden;">
	<table cellpadding="0" cellspacing="0" bgcolor="#edf2fc" width="100%" height="100%">
		<tr>
			<td>
			<table cellspacing="0" cellpadding="0" width="100%" height="400">
				<tr>
					<td><div style="overflow:hidden;"><div style="text-align: center"><img id="image_0.43562147746718776" style="width: 400px;" alt="pop.jpg" src="http://image.mrlotto.co.kr/popup/190122_popup.jpg" /><br /></div></div></td>
				</tr>
			</table>
			<div style="background:#000000;color:#FFFFFF;text-align:left;font-size:12px;">
				<input type="checkbox"  id="expirehours8" name="expirehours8" value="24">24시간 동안 이 창을 다시 열지 않음
				<a href="javascript:layer_close(8)"><img src="http://image.mrlotto.co.kr/popup/close.jpg" width="14" height="14" border="0"></a>
			</div>
			</td>
		</tr>
	</table>
	</div>
</div>
<script>
selectbox_hidden("8");
</script>
			  
		<div id="wrap">
			<!--head start-->
			<div id="header">
				<div class="top_menu">
					<h1><a href="/design/"><img src="http://image.mrlotto.co.kr/logo.png"></a></h1>
					<div class="nav">
						<ul>
							<li><a href="/design/sub1.php">분석 시스템</a></li>
							<li><a href="/design/sub2.php">상품 소개</a></li>
							<li><a href="/design/notice_list.php">공지사항</a></li>
							<li><a href="/design/mypage_mix.php">마이페이지</a></li>
							<li><a href="/design/event_list.php">이벤트</a></li>
			
						</ul>
					</div>
				</div>
			</div>
			<!--head end-->
			<!--main_contents start-->
			<div id="main_contents" style="position:relative;margin-top:-45px">
						
				<div style="width:120px;text-align:center;position: absolute;top:50px; z-index: 999;left:-140px;border:1px solid #d9d9d9;border-top:2px solid #333" id="emblem">
					<a href="#"  onclick="window.open('http://image.mrlotto.co.kr/quality.jpg','','width=600,height=814,scrollbars=no,top=30,left=30');"><img src="http://image.mrlotto.co.kr/emblem1.png" style="width:100%;padding:18px 15px 5px 15px"></a>
					<p style="border-bottom:1px solid #d9d9d9;padding-bottom:20px;font-size:12px;line-height:18px;font-weight:400">믿고 이용할 수 있는<br>서비스 품질 책임제</p>
					<a href="#"  onclick="window.open('http://image.mrlotto.co.kr/guarantee.jpg','','width=600,height=857,scrollbars=no,top=30,left=30');"><img src="http://image.mrlotto.co.kr/emblem2.png" style="width:80%;padding:15px 15px 0px 15px"></a>
					<p style="padding-bottom:15px;font-size:12px;line-height:18px;font-weight:400">신뢰를 우선으로 하는<br>환불 보증제</p>
				</div>