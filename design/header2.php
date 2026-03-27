<!doctype html>
<html lang="ko">
	<head>
		<title>미스터 로또씨</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<link rel="shortcut icon" href="http://image.mrlotto.co.kr/favicon.ico">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/pc/reset.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://mrlotto.co.kr/design/main2.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://mrlotto.co.kr/design/nivo-slider2.css" type="text/css" media="screen" />
		<!--link rel="stylesheet" href="http://mrlotto.co.kr/design/styles2.css?dev=<?=date("YmdHis")?>"-->
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/pc/sub.css?dev=<?=date("YmdHis")?>" type="text/css" media="screen" />
<script src="http://js.mrlotto.co.kr/pc/common.js?dev=<?=date("YmdHis")?>" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="new/slick.css?dev=<?=date("YmdHis")?>"/>
<!--link rel="stylesheet" type="text/css" href="new/slick-theme.css?dev=<?=date("YmdHis")?>"/-->

	<link rel="stylesheet" type="text/css" href="new/styles.css?dev=<?=date("YmdHis")?>" />
		
	<script src="new/jquery-latest.js" type="text/javascript"></script>
	
	
<script type="text/javascript" src="http://js.mrlotto.co.kr/pc/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="http://js.mrlotto.co.kr/pc/jquery.nivo.slider.js?dev=<?=date("YmdHis")?>"></script>
	
    <script type="text/javascript" src="new/jquery.ulslide.js"></script>

    
	<!--<script src="new/shBrushXml.js" type="text/javascript"></script>>
	<script src="new/scripts.js?dev=<?=date("YmdHis")?>" type="text/javascript"></script>--->

		<script src="js/jquery.bxslider2.min.js" type="text/javascript"></script>
		<script src="new/scripts.js?dev=<?=date("YmdHis")?>" type="text/javascript"></script>
<script type="text/javascript">
$(window).load(function() {
	
});
/*SyntaxHighlighter.all();*/
</script>
		<style>
			html {width:100% !important}
			.bx_pager a {display: none}
			::-webkit-scrollbar {

				display:none;
				
				} 
			#wrap{position:relative; width:100%;}
			#main_bn {
				margin:0 auto;
				width:284px;
				height:291px;
			}
			#main_bn img {
				width:100%;
				height:auto;
			}
            #main_bn_btn {
                list-style-type:none;
				position:absolute;
				bottom:5px; left:250px;
            }
            #main_bn_btn li {
                float: left; padding:0px 2px; margin-right:5px; 
            }
            a {text-decoration: none !important}
		</style>
	</head>
	
	<body style="-ms-overflow-style: none">
		
        
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
			<!--main_contents start overflow: hidden;-->
			<div id="main_contents" style="position:relative">
				<div style="position: absolute;top:-92px; right:-135px">
					<a href="http://www.mrlotto.co.kr/member/join.php"><img src="http://image.mrlotto.co.kr/prijoin.png"></a>
				</div>
				<div class="right_quick">
					<ul>
						<li><a href="#"  onclick="window.open('http://image.mrlotto.co.kr/quality.jpg','','width=600,height=814,scrollbars=no,top=30,left=30');"><img src="http://image.mrlotto.co.kr/side1.jpg"></a></li>
						<li><a href="#"  onclick="window.open('http://image.mrlotto.co.kr/guarantee.jpg','','width=600,height=857,scrollbars=no,top=30,left=30');"><img src="http://image.mrlotto.co.kr/side2.jpg"></a></li>
						<li style="margin-bottom:7px">
							<img src="http://image.mrlotto.co.kr/side3.jpg">
							<input type="text" style="display: block; width: 130px;padding-left:5px;margin: 0 auto;height: 30px;line-height: 30px;font-size:14px;box-sizing: border-box; margin-bottom:5px;border: 1px solid #999" placeholder="- 제외하고 입력">
							<a href=""><img src="http://image.mrlotto.co.kr/side3_bt.jpg"></a>
						</li>
						<li><img src="http://image.mrlotto.co.kr/side4.jpg"></li>
						<li style="margin:7px 0"><a href="http://www.mrlotto.co.kr/design/notice_list.php"><img src="http://image.mrlotto.co.kr/side5.jpg"></a></li>
						<li><a href="http://www.mrlotto.co.kr/member/login.php"><img src="http://image.mrlotto.co.kr/side6.jpg"></a></li>
						<li style="margin:7px 0"><a href="http://www.mrlotto.co.kr/bbs/board_v.php?dep=e&page=1&uid=13"><img src="http://image.mrlotto.co.kr/side7.jpg"></a></li>
						<!--li><img src="http://image.mrlotto.co.kr/side8.jpg"></li-->
					</ul>
				</div>
				<!--div style="width:120px;text-align:center;position: absolute;top:0px; z-index: 999;left:-140px;border:1px solid #d9d9d9;border-top:2px solid #333" id="emblem">
					<a href="#"  onclick="window.open('http://image.mrlotto.co.kr/quality.jpg','','width=600,height=814,scrollbars=no,top=30,left=30');"><img src="http://image.mrlotto.co.kr/emblem1.png" style="width:100%;padding:18px 15px 5px 15px"></a>
					<p style="border-bottom:1px solid #d9d9d9;padding-bottom:20px;font-size:12px;line-height:18px;font-weight:400">믿고 이용할 수 있는<br>서비스 품질 책임제</p>
					<a href="#"  onclick="window.open('http://image.mrlotto.co.kr/guarantee.jpg','','width=600,height=857,scrollbars=no,top=30,left=30');"><img src="http://image.mrlotto.co.kr/emblem2.png" style="width:80%;padding:15px 15px 0px 15px"></a>
					<p style="padding-bottom:15px;font-size:12px;line-height:18px;font-weight:400">신뢰를 우선으로 하는<br>환불 보증제</p>
				</div-->
				
