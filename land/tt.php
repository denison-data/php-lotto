<!doctype html>
<html lang="ko">
	<head>
		<title>미스터 로또씨</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/reset.css?dev=20190108162606">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/style.css?dev=20190108162606">
		<link rel="shortcut icon" href="http://image.mrlotto.co.kr/favicon.ico">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/sub_swiper.min.css?dev=20190108162606">
		<style>
			
			a {color: inherit; text-decoration: none}
			.nav {border-bottom:1px solid #d8d8d8;}
			.nav ul {overflow: hidden;width:100%;margin: 0 auto; box-sizing: border-box;text-align: center;}
			.nav ul li {float: left;width:20%;text-align: center}
			
			.nav_table {width:95%; margin: 0 auto;padding:2% 0;}
			.nav_table tr td {text-align: center}
			
		</style>
		<!-- 네이버 로그인--->
		<script type="text/javascript" src="http://js.mrlotto.co.kr/naverLogin_implicit-1.0.3.js?dev=20190108162606" charset="utf-8"></script>
		<!-- 네이버 로그인 스크립트--->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="http://js.mrlotto.co.kr/mobile/common.js?dev=20190108162606" type="text/javascript"></script>


<script type="text/javascript">
var naver_id_login = new naver_id_login(naver_client_id, naver_callback_url);
var gid;
var sesid;
function logins(){	
	var lgurl = "/m/member/login_process.php";
	var form_data = {
		user_id : $("#user_id").val(),
		pwd: $("#pwd").val(),
		mode : "logins2"
	};
	
	$.ajax({
		type	:	"POST",
		url		:	lgurl,
		data : form_data,
		dataType : "json",
		async: true,
		cache: false,
		success : function(data){
			if(data['status']=="0"){
				//alert('회원가입이 되었습니다\n 정상적으로 이용하시려면 메일인증 부탁드립니다.');
				var mdata = JSON.stringify(data['data']);
				window.localStorage.setItem("mrlotto_data",mdata);
				top.location.href="";
				//console.log('로그인처리 : '+ mdata.length);
				//for(var i=0; i < data['data'].length;i++){
					//var k = localStorage.key(data['data'][i]);
					
				//}
			} else if(data['status']=="i"){
				consloe.log('이메일인증처리');
			} else {
				console.log('회원정보 불일치')
				alert('로그인을 할수 없습니다');
				//alert('이미 등록된 ID 입니다.');
				//return false;
			}
			console.log(data);
		},
		error: function(request, status, error) {
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
	return false;
}
$(document).ready(function(){
	console.log(window.localStorage.getItem("mrlotto_data"));
	var loc_data = window.localStorage.getItem("mrlotto_data");
	if(JSON.parse(loc_data)){
		var mData = JSON.parse(loc_data);
		console.log(mData['code']);
		$("#logimg").attr("src","http://image.mrlotto.co.kr/mobile/logout.png");
		$("#logimg").parent().attr("id","logout2");
		$("#logout2").attr("href","javascript:;");

		$("#movePage01").attr("href","/m/member/mypage.php");
		$("#movePage02").attr("href","/m/member/mycoupon2.php");
		$("#movePage03").attr("href","/m/member/orders.php");
		$("#movePage04").attr("href","/m/member/modify.php");

	} else {

	}
	$("#logout2").on("click",function(){
		alert('로그아웃되었습니다');
		window.localStorage.removeItem("mrlotto_data");
		$("#logimg").attr("src","http://image.mrlotto.co.kr/mobile/login.png");
		$("#logimg").parent().attr("id","login");
		$("#login").attr("href","/m/member/login.php");
	});	
	$("#login_ck2").on("click",function(){
		if($("#user_id").val().length==0){
			alert("ID 입력바랍니다!!");
			$("#user_id").focus();
			return false;
		}
		if($("#pwd").val().length==0){
			alert("비밀번호 입력바랍니다!!");
			$("#pwd").focus();
			return false;		
		}
		if($("#login_id_check").is(":checked")){                     
			   //id 저장 클릭시 pwd 저장 체크박스 활성화			  
			var userInputId = $("input[name='user_id']").val();
			setCookie("userInputId", userInputId, 365);
			//console.log('체크되어있음');
		}else{ 
			deleteCookie("userInputId");			
		}

		logins();
		return false;
	});
	/*
	$("#pwd").keydown(function(key) {
		//console.log(key.keyCode);
		if (key.keyCode == 13) {
			if($("#pwd").val().length==0){
				alert("비밀번호 입력바랍니다");
				$("#pwd").focus();
				return false;		
			}
			if($("#login_id_check").is(":checked")){                     
			   //id 저장 클릭시 pwd 저장 체크박스 활성화			  
				var userInputId = $("input[name='user_id']").val();
				setCookie("userInputId", userInputId, 365);
				
			}else{ 
				deleteCookie("userInputId");			
			}
			logins();
		}
	});
	*/

	$("#login_ck").on("click",function(){
		if($("#user_id").val().length==0){
			alert("ID 입력바랍니다");
			$("#user_id").focus();
			return false;
		}
		if($("#pwd").val().length==0){
			alert("비밀번호 입력바랍니다");
			$("#pwd").focus();
			return false;		
		}
		if($("#login_id_check").is(":checked")){                     
			   //id 저장 클릭시 pwd 저장 체크박스 활성화			  
			var userInputId = $("input[name='user_id']").val();
			setCookie("userInputId", userInputId, 365);
			//console.log('체크되어있음');
		}else{ 
			deleteCookie("userInputId");			
		}
		var lgurl = "/member/login_process.php";
		$("#form1").attr("action",lgurl);
		$("#form1").submit();
		return false;
	});
	$("#logout").on("click",function(){
		var lgurl = "/member/login_process.php";
		$("#logout_form").attr("action",lgurl);
		$("#logout_form").submit();
	});
	var userInputId = getCookie("userInputId");
	$("input[name='user_id']").val(userInputId); 
	if(userInputId){
		$("#login_id_check").attr("checked",true);
	} else {
		$("#login_id_check").attr("checked",false);

	}
		//console.log(naver_callback_url);
	$("#logout2").on("click",function(){
		var lgurl = "/m/member/login_process.php";
		$("#logout_form").attr("action",lgurl);
		$("#logout_form").submit();
	});
	$("#logout").on("click",function(){
		var lgurl = "/m/member/login_process.php";
		$("#logout_form").attr("action",lgurl);
		$("#logout_form").submit();
	});
	
	$("#pwd").keydown(function(key) {
		//console.log(key.keyCode);
		if (key.keyCode == 13) {
			if($("#pwd").val().length==0){
				alert("비밀번호 입력바랍니다");
				$("#pwd").focus();
				return false;		
			}
			if($("#login_id_check").is(":checked")){                     
			   //id 저장 클릭시 pwd 저장 체크박스 활성화			  
				var userInputId = $("input[name='user_id']").val();
				setCookie("userInputId", userInputId, 365);
				
			}else{ 
				deleteCookie("userInputId");			
			}
			
			var lgurl = "/m/member/login_process.php";
			$("#form1").attr("action",lgurl);
			$("#form1").submit();
		}
	});
	
	var x = 0;
	var tabx = 0;
	var xx = 0;
	var limit = $("ul").width() - $("div").width();
	$("ul").bind('touchstart', function(e) {
		var event = e.originalEvent;
		x = event.touches[0].screenX;
		tabx = $("ul").css("transform").replace(/[^0-9\-.,]/g, '').split(',')[4];
	});
	$("ul").bind('touchmove', function(e) {
		var event = e.originalEvent;
		xx = parseInt(tabx) + parseInt(event.touches[0].screenX - x);
		$("ul").css("transform", "translate(" + xx + "px, 0px)");
		event.preventDefault();
	});
	$("ul").bind('touchend', function(e) {
		if ((xx > 0) && (tabx <= 0)) {
			$("ul").css("transform", "translate(0px, 0px)");
		}
		if (Math.abs(xx) > limit) {
			$("ul").css("transform", "translate(" + -limit + "px, 0px)");
		}
	});

});
function setCookie(cookieName, value, exdays){
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
	document.cookie = cookieName + "=" + cookieValue;
}
function deleteCookie(cookieName){
	var expireDate = new Date();
	expireDate.setDate(expireDate.getDate() - 1); //어제날짜를 쿠키 소멸날짜로 설정
	document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}
function getCookie(cookieName) {
	cookieName = cookieName + '=';
	var cookieData = document.cookie;
	var start = cookieData.indexOf(cookieName);
	var cookieValue = '';
	if(start != -1){
		start += cookieName.length;
		var end = cookieData.indexOf(';', start);
		if(end == -1)end = cookieData.length;
		cookieValue = cookieData.substring(start, end);
	}
	return unescape(cookieValue);
}
</script>
<style>
		.swiper-container {
      width: 100%;
      height: 100%;
      padding:2% 0 2% 3%;
    }
    .swiper-slide {
      text-align: center;
      font-size: 0.9em;
      background: #f8f8f8;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
      width: 25%;
    }
	
    .swiper-slide:nth-child(1) {
	    width:18% !important
    }
    .swiper-slide:nth-child(2) {
	    width:8% !important
    }
    .swiper-slide:nth-child(3) {
	    width:20% !important
    }
    .swiper-slide:nth-child(4) {
	    width:22% !important
    }
    
    .btn {
  cursor: pointer;  }

.close {
  width: 50px;
  height: 50px;
  position: absolute;
  left: 0px;
  top: 0px;
  background-image: url("http://s1.daumcdn.net/cfs.tistory/custom/blog/204/2048858/skin/images/close.png");
  background-size: 50%;
  background-repeat: no-repeat;
  background-position: center;
  cursor: pointer;
}

#menu {
  width: 150px;
  height: 100%;
  position: fixed;
  top: 0px;
  left: -152px;
  z-index: 10;
  background-color: white;
  border-right: 1px solid #063980;
  transition: All 0.5s ease;
  -webkit-transition: All 0.5s ease;
  -moz-transition: All 0.5s ease;
  -o-transition: All 0.5s ease;
  color:#fff;
  padding-top:15%;
}

#menu.open {
  left: 0px;
}

.page_cover.open {
  display: block;
}

.page_cover {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0px;
  left: 0px;
  background-color: rgba(0, 0, 0, 0.6);
  z-index: 4;
  display: none;
}
.top ul {}		
.top ul li {display:table-cell }


#nav { font-family:'arial'; }
#nav ul{ width:100%; margin:0; padding:0; }
#nav ul.menu li{ position:relative; float:left; width:100%; list-style-type:none;border-bottom:1px solid #eee}
#nav ul.menu li a{ display:block; width:100%; height:100%;text-indent:20px; color:#8d8d8d; text-decoration:none; line-height: 34px; font-size: 1.05em;color:#333}
#nav ul.menu li a:hover{ background:#eee; }
#nav ul.menu li .sub a{ position:relative; float:left; display:block; width:100%; z-index:999;  background:#eee; font-size: 0.9em;line-height: 30px; padding-left:10px; box-sizing: border-box;color:#8d8d8d}
#nav ul.menu li .sub a:hover{ background:#444; color:#fff; }

		</style>
	</head>
<form name="logout_form" id="logout_form" method="post">
<input type="hidden" name="mode" value="logout">
</form>	
	<body>
		
		<div class="top" style="background-color: #111;">
			<!--
			<table cellpadding="0" cellspacing="0" border="0" class="top_td">
				<tr>
					<td><img src="http://image.mrlotto.co.kr/mobile/category.png"></td>
					<td><a href="/m/"><img src="http://image.mrlotto.co.kr/mobile/logo.png"></a></td>
					<td>
												<a href="/m/member/login.php?target=/m/bbs/board_v.php?dep=e&page=1&uid=13" name="로그인" href="javascript:;" >
						<img src="http://image.mrlotto.co.kr/mobile/login.png">
						</a>
											</td>
				</tr>
			</table>--->
			<ul>
	<li class="btn"><img src="http://image.mrlotto.co.kr/mobile/category.png"></li>
	<li><a href="/m/"><img src="http://image.mrlotto.co.kr/mobile/logo.png"></a></li>
	<li>
				<a href="/m/member/login.php"><img src="http://image.mrlotto.co.kr/mobile/login.png" id="logimg"></a>
			</li>
	<!--li><img src="http://image.mrlotto.co.kr/mobile/logout.png"></li-->
</ul>
  
<div onclick="history.back();" class="page_cover"></div>
<div id="menu">
	<div>
		<div id="close" class="close">
		</div>
	</div>
	<div style="color:#d8d8d8;padding-left:14%;margin-bottom:5%">CATEGORY</div>
	<div id="nav">
		<ul class="menu">
			<li><a href="/m/info/sub.php?dep=1">분석시스템 소개</a></li>
		</ul>
		<ul class="menu">
			<li><a href="#">당첨 통계</a>
				<ul class="sub">
					<li><a href="/m/info/sub1_stats.php?sub=2">번호별 통계</a></li>
					<li><a href="/m/info/sub1_stats.php?sub=3">색상 통계</a></li>
					<li><a href="/m/info/sub1_stats.php?sub=4">구간별 출현횟수</a></li>
					<li><a href="/m/info/sub1_stats.php?sub=5">기간별 미출현 번호</a></li>
					<li><a href="/m/info/sub1_stats.php?sub=6">홀짝 통계</a></li>
					<li><a href="/m/info/sub1_stats.php?sub=7">연속번호 출현</a></li>
				</ul>
			</li>
		</ul>
		<ul class="menu">
			<li><a href="/m/info/sub.php?dep=2">상품 소개</a></li>
		</ul>
		<ul class="menu">
			<li><a href="/m/bbs/board.php?dep=n">공지사항</a></li>
		</ul>
		<ul class="menu">
			<li><a href="#">마이페이지</a>
				<ul class="sub">
					<li><a href="/m/member/login.php?target=/m/member/mypage.php"  id="movePage01">조합 내역</a></li>
					<li><a href="/m/member/login.php?target=/m/member/mycoupon2.php"  id="movePage02">쿠폰</a></li>
					<li><a href="/m/member/login.php?target=/m/member/orders.php"  id="movePage03">서비스 설정</a></li>
					<li><a href="/m/member/login.php?target=/m/member/modify.php"  id="movePage04">회원 정보 관리</a></li>
				</ul>
			</li>
		</ul>
		<ul class="menu">
			<li><a href="/m/bbs/board.php?dep=e">이벤트</a></li>
		</ul>
	</div>
  <!--div style="color:#2b7ad9;padding-left:10%;margin-top:5%;font-weight: bold;display:inline-block;vertical-align: middle;width:150px;line-height:30px"><img src="http://image.mrlotto.co.kr/mobile/key.png" style="width:20px; height:26px;margin-right:3%">로그아웃</div-->
		<div style="color:#2b7ad9;padding-left:10%;margin-top:5%;font-weight: bold;display:inline-block;vertical-align: middle;width:150px;line-height:30px"><a href="/m/member/login.php"><img src="http://image.mrlotto.co.kr/mobile/key2.png" style="width:20px; height:26px;margin-right:3%">로그인</a></div>
	</div>
<script type="text/javascript">
$(document).ready(function(){
	var $modal,$modal2;
	$("#nav ul.sub").hide();
	$("#nav ul.menu li").click(function(){
		$("ul",this).slideToggle("fast");
	});
	$("#close").click(function(){
		$("#menu,.page_cover,html").removeClass("open");
	});

	$("#layer_popup").click(function(){
			$modal = $('div.modal').omniWindow();			
			$modal.trigger('show');
	});


	$('.close-button').click(function(e){
		  e.preventDefault();
		  $modal.trigger('hide');
	});
		
		
		
	$("#layer_popup2").click(function(){
		$modal2 = $('div.modal2').omniWindow();			
		$modal2.trigger('show');
	});

	$('.close-button2').click(function(e){
		e.preventDefault();
		$modal2.trigger('hide');
	});
});
</script>

<script>
$(".btn").click(function() {
  $("#menu,.page_cover,html").addClass("open");
  window.location.hash = "#open";
});

window.onhashchange = function() {
	//console.log($("#menu,.page_cover,html").hasClass("open"));
  //if ($("#menu,.page_cover,html").hasClass("open")==true) {
   // $("#menu,.page_cover,html").removeClass("open");
  //}
};
</script>



</div>		<!--div class="nav">
			<ul>
				<li><a href="">분석시스템</a></li>
				<li><a href="">상품소개</a></li>
				<li><a href="">공지사항</a></li>
				<li><a href="">마이페이지</a></li>
				<li><a href="">이벤트</a></li>
			</ul>
		</div-->
		<div class="nav">
			<table cellpadding="0" cellspacing="0" border="0" class="nav_table">
				<tr>
					<td><a href="/m/info/sub.php?dep=1">분석시스템</a></td>
					<td><a href="/m/info/sub.php?dep=2">상품소개</a></td>
					<td><a href="/m/bbs/board.php?dep=n">공지사항</a></td>
					<td><a  href="/m/member/login.php?target=/m/member/mypage.php">마이페이지</a></td>
					<td><a href="/m/bbs/board.php?dep=e">이벤트</a></td>
				</tr>
			</table>
		</div>

<script type="text/javascript">

</script>
<div class="contents sub">
	<h2><img src="http://image.mrlotto.co.kr/mobile/event_tit.jpg"></h2>
	<p>미스터로또씨 이벤트 게시판입니다.</p>
</div>
<div class="contents2">
			
			<table cellpadding="0" cellspacing="0" border="0" class="notice_table_view nv">
				<colgroup>
					<col width="20%">
					<col width="80%">
				</colgroup>
				<tbody>
					<tr>
						<td>제목</td>
						<td>미스터로또씨 룰렛 이벤트</td>
					</tr>
					<tr>
						<td colspan="2" style="border-right: none;font-size: 1em;padding:4% 0; font-weight: normal"><style>
			.land4_button {max-width:700px;width:100%;height:50%;padding-top:17.3%;position: absolute;text-align:center;z-index: 999}
			.land4_rull {width:72.7%;margin:0 auto;position: relative}
			/*background: url('/land/img/light-bg.png') top center no-repeat;background-size: contain;*/
			.land4_rull td {vertical-align: middle;text-align: center;}
			.txt {margin-top:-10%;background: url('/land/img/land4-bg5.png') center; background-size: cover;}
			.txt img {margin-top:5%; padding:10% 7%; box-sizing: border-box}
			.pin {max-width:700px;width:100%;padding-top:17.3%;position: absolute;text-align:center;z-index: 99}
			.pin img {width:24%}
			
			
			@media (max-width:768px){
			.land4_rull {width:65.3%;padding-top:8%}
			.land4_button {padding-top:28% !important;width:92%}
			.pin {width:92%;margin:0 auto;text-align:center; margin-top:5px;padding-top:0;}
			.light img {width:92% !important}
			.light {position: absolute;top:21.1% !important;}
			#result_view {width:100% !important; top:11.5% !important;left:0 !important;height: 46% !important}
			.ok_bt {background-color:#0d0d0d}
			.check2 img {width:83% !important}
			}
			
			
			@media (min-width:769px) and (max-width:1024px){
			.land4_button {padding-top:30.3% !important}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-10px;padding-top:0}
			}
			@media (min-width:1025px) and (max-width:1800px){
			.land4_button {padding-top:20% !important}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-0px;padding-top:0}
			}
			@media (min-width:1801px){
			.land4_button {width:100%;margin:0 auto;text-align:center; margin-top:245px;padding-top:0;}
			.pin {width:100%;margin:0 auto;text-align:center; margin-top:-20px;padding-top:0}
			}
			.db input {width:70%;display: block;margin: 0 auto;padding:3% 0 3% 3%;border:1px solid #111;font-size:0.8rem;margin-bottom:1%;border-radius:5px;}
			.db .ok_bt {text-align: center;margin:15% 0 0 0}
			.db a {display: inline-block;margin: 0 auto}
			.light {position: absolute;z-index: 99;top:20.8%}
</style>
	</head>
<script type="text/javascript" src="http://js.mrlotto.co.kr/pc/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="http://js.mrlotto.co.kr/pc/jQueryRotateCompressed.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	phone_check();
	var para = document.location.href.split("?");

	var vPage = window.location.protocol + "//" + window.location.host + "" + window.location.pathname;
	if(para.length==2){
		vPage = vPage+"?"+para[para.length-1];
	} else {
		vPage = vPage;
	}
	console.log(vPage);
	$("#check").on("click",function(){
		if($("#check").is(":checked")){
			console.log("check");
		} else {
			$("#check").prop("checked",false);
			alert('개인정보취급방침에 동의를 하셔야합니다.');
			$("#check").prop("checked",true);
			console.log("not check");
		}
	});
	$("#create2").on("click",function(){
		if($("#check2").length!=0){
			if($("#check2").is(":checked")){
			} else {
				alert('문자 수신 동의가 필요합니다');
				return false;
			}
		}
		var lgurl = "/land/land_p.php";
		var etc;
		if($("#etc").val()){
			etc = $("#etc").val();
		}
		var check = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
		var lgurl = "/land/land_p.php";
		var etc;
		if($("#etc").val()){
			etc = $("#etc").val();
		}
		if($.trim($("#uname2").val()).length==0){
			var alt = '이름을 기입해주세요';
			alert(alt);
			$("#uname2").focus();
			return false;
		}
		var check = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
		
		
		if($.trim($("#cellnum2").val()).length==0){
			var alt = '연락처를 기입해주세요!!';
			alert(alt);
			$("#cellnum2").val("");
			$("#cellnum2").focus();
			return false;
		}
		
		var trn_num2 = $.trim($("#cellnum2").val()).replace(/-/gi,'');
		var trn_num3 = $.trim($("#cellnum3").val()).replace(/-/gi,'');
		
		if(trn_num3.length<3){
			var alt = '연락처를 다시 기입해주세요!!!~';
			alert(alt);
			$("#cellnum3").val("");
			$("#cellnum3").focus();
			return false;
		}
		var history_url = document.referrer;

		var form_data = {
			tel		:	$.trim($("#cellnum").val())+$.trim($("#cellnum2").val())+$.trim($("#cellnum3").val()),
			name	:	$.trim($("#uname2").val()),
			page	:	vPage,	
			etc		:	etc,
			history_url :	history_url,
			mode	:	"land_ins"
		};
		
		$.ajax({
			type	:	"POST",
			url		:	lgurl,
			data : form_data,
			dataType : "json",
			async: false,
			cache: false,
			success : function(data){
				if(data['status']=="0"){
					alert('번호받기가 신청되었습니다.');
					$("#cellnum2").val("");
					$("#cellnum3").val("");
					$("#uname2").val("");
				} else {
					alert('이미 전화번호가 등록되어있습니다.');
					$("#cellnum2").val("");
					$("#cellnum3").val("");
					$("#uname2").val("");
				}
				
			},
			error: function(request, status, error) {
				console.log("code:"+request.status+"n"+"message:"+request.responseText+"n"+"error:"+error);
			}
		});
		return false;
	});
	
	$("#create").on("click",function(){
		if($("#check2").length!=0){
			if($("#check2").is(":checked")){
			} else {
				alert('문자 수신 동의가 필요합니다');
				return false;
			}
		}
		var lgurl = "/land/land_p.php";
		var etc;
		if($("#etc").val()){
			etc = $("#etc").val();
		}
		var check = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
		if(check.test($.trim($("#tel").val()))){
			var alt = '연락처를 정확히 기입해주세요';
			$("#tel").val("");
			$("#tel").focus();
			return false;
		}
		if($.trim($("#uname").val()).length==0){
			var alt = '이름을 기입해주세요';
			alert(alt);
			$("#uname").focus();
			return false;
		}
		if($.trim($("#tel").val()).length==0){
			var alt = '연락처를 기입해주세요';
			alert(alt);
			$("#tel").val("");
			$("#tel").focus();
			return false;
		}
		
		var trn_num = $.trim($("#tel").val()).replace(/-/gi,'');
		if(trn_num.length<10){
			var alt = '연락처를 다시 기입해주세요';
			alert(alt);
			$("#tel").val("");
			$("#tel").focus();
			return false;
		}
		var history_url = document.referrer;
		
		var form_data = {
			tel		:	$.trim($("#tel").val()),
			name	:	$.trim($("#uname").val()),
			page	:	vPage,	
			etc		:	etc,
			history_url :	history_url,
			mode	:	"land_ins"
		};
		
		$.ajax({
			type	:	"POST",
			url		:	lgurl,
			data : form_data,
			dataType : "json",
			async: false,
			cache: false,
			success : function(data){
				if(data['status']=="0"){
					alert('번호받기가 신청되었습니다.');
					$("#tel").val("");
					$("#uname").val("");
					if(typeof gtag == "function"){		
						gtag('event', 'conversion', {'send_to': 'AW-825156556/HDFgCOzEwZIBEMzHu4kD'});
						console.log('gogole ok');
					}
				} else {
					alert('이미 전화번호가 등록되어있습니다..');
					$("#tel").val("");
					$("#uname2").val("");
					console.log(data);
				}
				
			},
			error: function(request, status, error) {
				console.log("code:"+request.status+"n"+"message:"+request.responseText+"n"+"error:"+error);
			}
		});
		return false;
	});
	
	$("#create_HNS").on("click",function(){
//		var lgurl = "http://mp.lumieyes.com/01_lotto7/HNS/main_p.php";
		var etc;
		if($("#etc").val()){
			etc = $("#etc").val();
		}
		var check = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
		if(check.test($.trim($("#tel").val()))){
			var alt = '연락처를 정확히 기입해주세요';
			$("#tel").val("");
			$("#tel").focus();
			return false;
		}
		if($.trim($("#username").val()).length==0){
			var alt = '이름을 기입해주세요';
			alert(alt);
			$("#uname").focus();
			return false;
		}
		if($.trim($("#tel").val()).length==0){
			var alt = '연락처를 기입해주세요';
			alert(alt);
			$("#tel").val("");
			$("#tel").focus();
			return false;
		}
		
		var trn_num = $.trim($("#tel").val()).replace(/-/gi,'');
		if(trn_num.length<10){
			var alt = '연락처를 다시 기입해주세요';
			alert(alt);
			$("#tel").val("");
			$("#tel").focus();
			return false;
		}
		var history_url = document.referrer;

/*
		var form_data = {
			tel		:	$.trim($("#tel").val()),
			name	:	$.trim($("#username").val()),
			page	:	vPage,	
			etc		:	etc,
			history_url :	history_url,
			mode	:	"insert_mode"
		};
*/
		
/*
		$.ajax({
			type	:	"POST",
			url		:	lgurl,
			data : form_data,
			dataType : "json",
			async: false,
			cache: false,
			success : function(data){
				if(data['status']=="0"){
					alert('번호받기가 신청되었습니다.');
					$("#tel").val("");
					$("#uname").val("");
				} else {
					alert('이미 전화번호가 등록되어있습니다..');
					$("#tel").val("");
					$("#uname2").val("");
				}
				
			},
			error: function(request, status, error) {
				console.log("code:"+request.status+"n"+"message:"+request.responseText+"n"+"error:"+error);
			}
		});
*/

		document.getElementById('Join').submit();
//		return false;
	});
});
function phone_check(){
	
	$("#tel").on('keydown',function(e){
		var trn_num = $(this).val().replace(/-/gi,'');
		$(this).val($(this).val().replace(/[^0-9]/g,"") );

		var k = e.keyCode;
		if(trn_num.length >= 11 && ((k >= 48 && k <=126) || (k >= 12592 && k <= 12687 || k==32 || k==229 || (k>=45032 && k<=55203)) ))
		{
			e.preventDefault();
		}	
	}).on('blur',function(){

		if($.trim($(this).val())=='') return;
		var trn_num = $(this).val().replace(/-/gi,'');
		if(trn_num != null && trn_num != ''){
			if(trn_num.length==11 || trn_num.length==10){
				var rep_ctn = /^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/;
				if(rep_ctn.test(trn_num)){
					trn_num = trn_num.replace(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3"); 

					$(this).val(trn_num);
				} else {
					alert("유효하지 않은 전화번호 입니다!!.");
					$(this).val("");
					$(this).focus();
					return false;
				}
			}
		}else {
			alert("유효하지 않은 전화번호 입니다!!.");
			$(this).val("");
			$(this).focus();
			return false;
		}
		
	});
	$("#cellnum2").on('keydown',function(e){
		var trn_num = $(this).val().replace(/-/gi,'');
		$(this).val($(this).val().replace(/[^0-9]/g,"") );

		var k = e.keyCode;
		if(trn_num.length >= 11 && ((k >= 48 && k <=126) || (k >= 12592 && k <= 12687 || k==32 || k==229 || (k>=45032 && k<=55203)) ))
		{
			e.preventDefault();
		}	
	}).on('blur',function(){

		if($.trim($(this).val())=='') return;
		var trn_num = $(this).val().replace(/-/gi,'');
		if(trn_num != null && trn_num != ''){
			if(trn_num.length==11 || trn_num.length==10){
				var rep_ctn = /^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/;
				if(rep_ctn.test(trn_num)){
					trn_num = trn_num.replace(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3"); 

					$(this).val(trn_num);
				} else {
					alert("유효하지 않은 전화번호 입니다!!.");
					$(this).val("");
					$(this).focus();
					return false;
				}
			}
		}else {
			alert("유효하지 않은 전화번호 입니다!!.");
			$(this).val("");
			$(this).focus();
			return false;
		}
		
	});


	$("#cellnum3").on('keydown',function(e){
		var trn_num = $(this).val().replace(/-/gi,'');
		$(this).val($(this).val().replace(/[^0-9]/g,"") );

		var k = e.keyCode;
		if(trn_num.length >= 11 && ((k >= 48 && k <=126) || (k >= 12592 && k <= 12687 || k==32 || k==229 || (k>=45032 && k<=55203)) ))
		{
			e.preventDefault();
		}	
	}).on('blur',function(){

		if($.trim($(this).val())=='') return;
		var trn_num = $(this).val().replace(/-/gi,'');
		if(trn_num != null && trn_num != ''){
			if(trn_num.length==11 || trn_num.length==10){
				var rep_ctn = /^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/;
				if(rep_ctn.test(trn_num)){
					trn_num = trn_num.replace(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3"); 

					$(this).val(trn_num);
				} else {
					alert("유효하지 않은 전화번호 입니다!!.");
					$(this).val("");
					$(this).focus();
					return false;
				}
			}
		}else {
			alert("유효하지 않은 전화번호 입니다!!.");
			$(this).val("");
			$(this).focus();
			return false;
		}
		
	});	
}
</script>
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
		  animateTo:360 * 3 +37,
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
			imgs = "/land/img/n-db1.jpg";
			$("#etc").val("1개월쿠폰");
		} else {
			gb = part;
			imgs = "/land/img/n-db13.jpg";
			$("#etc").val("3개월쿠폰");

		}
		$("#result_view").show();
		$("#views").attr("src",imgs);
		//console.log(part+"||"+pArr[gb]+"||"+gb+"||"+37);
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


	<body style="max-width:700px; margin:0 auto;position: relative;">
		<div style="max-width:700px;width:100%;background: url('/land/img/n2_bg.jpg'); background-size: 100%; padding-bottom:27%;">
			<div><img src="/land/img/line.jpg" style="width: 100%;display: block"></div>
			<div class="tit"><img src="/land/img/tit.png" style="width: 100%"></div>
			<div class="light" style="max-width:700px;width: 100%;"><img src="/land/img/light-bg.png" style="width: 100%;position:relative"></div>
			<div style="position: absolute;z-index: 99;top:21.4%"><img src="/land/img/rib-bg.png" style="width: 100%"></div>
		<div class="land4_button"><a href="javascript:;" id="start_btn"><img src="/land/img/start-bt.png" style="width:25%"></a></div>
			<table class="land4_rull" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td style="padding:0;border:none"><img src="/land/img/rull-bg.png" style="width:100%;display: block" id="image2"></td>
				</tr>
			<div class="pin"><img src="/land/img/new-pin.png" style=";display: block; margin:0 auto"></div>
			</table>
		</div>
		<div style="max-width:700px;width:100%;"><img src="/land/img/use.png" style="width: 100%;display: block"></div>
		
		
		<div style="max-width:700px;width:100%;margin: 0 auto;height: 1880px;background-color: #0d0d0d;position:absolute;top:20px;left:20px;z-index: 99999;box-sizing: border-box " id="result_view">
			<div style="padding-top: 15%;"><img id="views"></div>
			<div style="width:80%;background-color:#0d0d0d; margin: 0 auto;overflow: hidden;" class="db">
				<img src="/land/img/n-db-gif.gif" style="width:100%;margin-bottom:7%">
				<input type="hidden" id="etc" name="etc">
				<input type="text" placeholder="이름" name="uname" id="uname"> 
				<input type="text" placeholder="연락처" name="tel" id="tel">
				
				<div style="width: 68%;box-sizing: border-box;float: left;text-align: center;overflow: hidden;margin-top:3%" class="check">
					<input type="checkbox" id="check" checked="" style="width: auto !important; display: inline-block">
					<label for="check">
						<img src="/land/img/n-db2.jpg" style="width: 60% !important; display: inline-block; vertical-align: middle"> 
						<a href="pri.php" target="_blank" style="width:25%; ">
							<img src="/land/img/n-db3.jpg"  style="width:100%; display: inline-block;vertical-align: middle">
						</a>
					</label>
				</div>
				<div style="width: 32%;box-sizing: border-box;float: left;text-align: right;overflow: hidden;margin-top:3%" class="check2">
					<input type="checkbox" id="check2" checked="" style="width: auto !important; display: inline-block">
					<label for="check2">
						<img src="/land/img/n-db4.jpg" style="width: 84% !important; vertical-align: middle">
					</label>
				</div>
				
				
				
				
				<div class="ok_bt"><a href="javascript:;" id="create"><img src="/land/img/n-db5.jpg" style="width: 100%"></a></div>
			<div><img src="/land/img/n-db6.jpg" style="width: 100%"></div>
			</div>
		</div>
		<footer class="footer" style="width:100%;max-width:700px;">
			<img src="/land/img/txt.png" style="width: 100%;display: block">
			<img src="/land/img/txt22.png" style="width: 100%;display: block">
			<!--div class="copyright" style="background:#000; padding:1% 2%; text-align: center">
				<span style="font-size:12px; color:#9d9d9d;">Copyright © MrQuant Corp. All right reserved.</span>
			</div-->
		</footer>
		
		

	</body>
</html></td>
						</tr>
												<!--<tr>
							<th>파일첨부</th>
							<td><a href="http://image.mrlotto.co.kr/data/1546923919_QaalK.jpg" target="_new">파일첨부</a></td>
						</tr>--->
												<tr>
							<th>기한</th>
							<td>2018/10/15 ~ 2019/02/15</td>
						</tr>
					</table>
					<div class="notice_button"><!--button button class="board_button">글쓰기</button--><button button class="board_cancel_button" onclick="location.href='/bbs/board.php?dep=e&page=1'">목록으로</button></div>
				</div>
			</div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->


		</div>
		
			<!--footer start-->
			<div id="footer">
				<ul>
					<li></li>
					<li><a href="javascript:;"  onclick="window.open ('/agree/join_1.php','','width=600,height=857,scrollbars=no,top=30,left=30');">이용약관</a></li>
					<li><a href="javascript:;"  onclick="window.open ('/agree/join_2.php','','width=600,height=857,scrollbars=no,top=30,left=30');">개인정보 처리방침</a></li>
					<li><a href="javascript:;"  onclick="window.open ('/agree/join_3.php','','width=600,height=320,scrollbars=no,top=30,left=30');">마케팅 정보 수신 동의</a></li>
					<li></li>
				</ul>
				<ul>
					<li>미스터퀀트 주식회사</li>
					<li>TEL : 1811-7335</li>
					<li>FAX : 02-2067-3090</li>
					<li>대표이사 : 조정윤</li>
					<li>개인정보책임관리자 : 조정윤</li>
					<li>사업자등록번호 : 547-88-01224</li>
					<li>주소 : 서울특별시 금천구 가산디지털1로 142, 1118호 (가산동, 가산더스카이밸리 1차)</li>
					<li>COPYRIGHT  ⓒ 2018 Mr.quant All rights reserved.</li>
				</ul>
				<ul style="clear:both;padding-top:10px">
					<li style="float:left;">* 당사의 분석시스템은 전체 로또번호 조합 중 등급별 압축 필터링한 조합 정보제공만을 목적으로 하며, 당첨 확정 서비스가 아니므로 서비스 이용 과정에서 기대이익을 얻지 못하거나 발생한 손해 등에 대한 최종책임은 서비스 이용자 본인에게 있습니다.</li>
				</ul>
			</div>
			<!--footer end-->
	</body>
</html></td>
					</tr>
					<tr>
						<td>기간</td>
						<td>2018/10/15 ~ 2019/02/15</td>
					</tr>
					<tr>
						<td>조회수</td>
						<td>1815</td>
					</tr>
				</tbody>
			</table>
			<div class="small_bt2"><a href="javascript:;" onclick="location.href='/m/bbs/board.php?dep=e&page=1'" style="z-index:99999999999">목록으로</a></div>
			
	</div>

<script src="http://js.mrlotto.co.kr/mobile/sub_swiper.min.js?dev1=1"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 'auto',
      centeredSlides: false,
      spaceBetween: 1,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  </script>
		
			<div  style="padding-top:10%"><a href="/m/info/sub.php?dep=1"><img src="http://image.mrlotto.co.kr/mobile/footer_banner.png"></a></div>
<div class="f4" style="border-top:1px solid #111; border-bottom:1px solid #111; text-align: center;padding:1% 0">
			<span><a href="/m/agree/join1.php">이용약관</a></span>
			<span style="margin:0 3%"><a href="/m/agree/join2.php">개인정보 처리방침</a></span>
			<span><a href="/m/agree/join3.php">마케팅 정보 수신 동의</a></span>
		</div>
		<div style="background-color: #333;color:#ccc;text-align: center;padding:2% 0" class="f5">
			<p>미스터퀀트 주식회사&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEL : 1811-7335&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FAX : 02-2067-3090</p>
			<p>대표이사 : 조정윤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;개인정보책임관리자 : 조정윤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;사업자등록번호 : 547-88-01224</p>
			<p>주소 : 서울특별시 금천구 가산디지털1로 142, 1118호(가산동, 가산더스카이밸리 1차)</p>
			<p class="f5" style="padding-top:1%;color:#666">COPYRIGHT ⓒ 2018 Mr.quant All rights reserved.</p>
		</div>
		<div style="background-color:#222;color:#888;text-align: center; padding:2% 4%" class="f5">* 당사의 분석 시스템은 전체 로또번호 조합 중 등급별 압축 필터링한 조합 정보제공만을 목적으로 하며, 당첨 확정 서비스가 아니므로 서비스 이용 과정에서 기대이익을 얻지 못하거나 발생한 손해 등에 대한 최종책임은 서비스 이용자 본인에게 있습니다.</div>

	</body>
</html>

