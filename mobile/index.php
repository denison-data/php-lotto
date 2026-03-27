<!doctype html>
<html lang="ko">
	<head>
		<title>미스터로또씨</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/reset.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/style.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/swiper.min.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/swiper2.min.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/bxslider.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/jquery.omniwindow.css?dev=<?=date("YmdHis")?>">
		

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="http://js.mrlotto.co.kr/jquery.bpopup.min.js"></script>

		<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
		<script>
			    $(document).ready(function(){
			      $('.slider').bxSlider({
						
						paper: true,
						paperSelector: 'paper',
						touchEnabled: true,
						controls: true
					});
					$('.slider1').bxSlider({
						
						paper: true,
						paperSelector: 'paper',
						touchEnabled: true,
						controls: true
					});
				});
		</script>
		<style>
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
	
	<body>

<script>
function set_cookie(name, value, expirehours, domain) 
{
	var today = new Date();
	today.setTime(today.getTime() + (60*60*1000*expirehours));
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
	if (domain) {
		document.cookie += "domain=" + domain + ";";
	}
}
function get_cookie(name) 
{
	var find_sw = false;
	var start, end;
	var i = 0;
	for (i=0; i<= document.cookie.length; i++)
	{
		start = i;
		end = start + name.length;

		if(document.cookie.substring(start, end) == name) 
		{
			find_sw = true
			break
		}
	}
	if (find_sw == true) 
	{
		start = end + 1;
		end = document.cookie.indexOf(";", start);

		if(end < start)
			end = document.cookie.length;

		return document.cookie.substring(start, end);
	}
	return "";
}

function layer_close(id,hiddenWay) {
	var obj = document.getElementById("expirehours"+ id);
	var tmpid = document.getElementById("mpop"+id);
	if (obj.checked == true) {
		set_cookie("mit_ck_pop_"+id, "done", obj.value, window.location.host);
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
		$('#mpop'+id).bPopup().close();

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

$(document).ready(function(){
	var obj = document.getElementById("expirehours8");
	console.log(obj.value);

	var ck = get_cookie("mit_ck_pop_8");
	if(ck=="done"){
		$("#mpop8").hide();
	} else {
		$("#mpop8").bPopup({});
	}	
	//$("#mpop8").bPopup({});
});
</script>
<style>
.button:hover{
    background-color: #1e1e1e;
}
.button{
    background-color: #2B91AF;
    border-radius: 10px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.3);
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
}
.button.b-close, .button.bClose{
    border-radius: 7px 7px 7px 7px;
    box-shadow: none;
    font: bold 231% sans-serif;
    padding: 0 6px 2px;
    position: absolute;
    right: -7px;
    top: -7px;
}
</style>
<div id="mpop8" style="position:absolute;display: none; background-color: white; width: 400px; height: 400px;">
	<span class="button b-close"><span>X</span></span>
   <p>
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
				<input type="checkbox"  id="expirehours8" name="expirehours8" value="24" onchange="javascript:layer_close(8)">24시간 동안 이 창을 다시 열지 않음
				<!--<a href="javascript:layer_close(8)"><img src="http://image.mrlotto.co.kr/popup/close.jpg" width="14" height="14" border="0" style="width:auto"></a>--->
			</div>
			</td>
		</tr>
	</table>
	</div>
   </p>
</div>
	
		
		<div class="top" style="position:absolute;top:0;z-index: 9999;width:100%;">
			<!--table cellpadding="0" cellspacing="0" border="0" class="top_td">
				<tr>
					<td><a href=""><img src="http://image.mrlotto.co.kr/mobile/category.png"></a></td>
					<td><img src="http://image.mrlotto.co.kr/mobile/logo.png"></td>
					<td><img src="http://image.mrlotto.co.kr/mobile/login.png"></td>
					<td><img src="http://image.mrlotto.co.kr/mobile/logout.png"></td>
				</tr>
			</table-->
			
			
			<ul>
				<li class="btn"><img src="http://image.mrlotto.co.kr/mobile/category.png"></li>
				<li><img src="http://image.mrlotto.co.kr/mobile/logo.png"></li>
				<li><a href="login.php"><img src="http://image.mrlotto.co.kr/mobile/login.png"></a></li>
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
				  <li><a href="sub1.php">분석시스템 소개</a></li>
				 </ul>
				 <ul class="menu">
				  <li><a href="#">당첨 통계</a>
				   <ul class="sub">
				    <li><a href="sub2_1.php">번호별 통계</a></li>
				    <li><a href="sub2_3.php">색상 통계</a></li>
				    <li><a href="sub2_4.php">구간별 출현횟수</a></li>
				    <li><a href="sub2_6.php">기간별 미출현 번호</a></li>
				    <li><a href="sub2_7.php">홀짝 통계</a></li>
				    <li><a href="sub2_8.php">연속번호 출현</a></li>
				   </ul>
				  </li>
				 </ul>
				 <ul class="menu">
				  <li><a href="sub3.php">상품 소개</a></li>
				 </ul>
				 <ul class="menu">
				  <li><a href="notice_list.php">공지사항</a></li>
				 </ul>
				 <ul class="menu">
				  <li><a href="#">마이페이지</a>
				   <ul class="sub">
				    <li><a href="mypage1_1.php">조합 내역</a></li>
				    <li><a href="mypage2_1.php">쿠폰</a></li>
				    <li><a href="mypage3_1.php">서비스 설정</a></li>
				    <li><a href="mypage4_1.php">회원 정보 관리</a></li>
				   </ul>
				  </li>
				 </ul>
				 <ul class="menu">
				  <li><a href="event_list.php">이벤트</a></li>
				 </ul>
				</div>
			  <!--div style="color:#2b7ad9;padding-left:10%;margin-top:5%;font-weight: bold;display:inline-block;vertical-align: middle;width:150px;line-height:30px"><img src="http://image.mrlotto.co.kr/mobile/key.png" style="width:20px; height:26px;margin-right:3%">로그아웃</div-->
			  <div style="color:#2b7ad9;padding-left:10%;margin-top:5%;font-weight: bold;display:inline-block;vertical-align: middle;width:150px;line-height:30px"><a href="login.php"><img src="http://image.mrlotto.co.kr/mobile/key2.png" style="width:20px; height:26px;margin-right:3%">로그인</a></div>
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



		</div>
		<div class="container">
			<!-- slider -->
			<ul class="slider">
				<li>
					<img src="http://image.mrlotto.co.kr/mobile/main_banner2.jpg">
				</li>
				<li>
					<img src="http://image.mrlotto.co.kr/mobile/banner1.jpg">
				</li>
				<!--li>
					<img src="http://image.mrlotto.co.kr/mobile/main_banner3.jpg">
				</li-->
			</ul>
		</div>
		<div class="notice">
			<ul>
				<li><img src="http://image.mrlotto.co.kr/mobile/notice.jpg"></li>
				<li>미스터로또씨 공지사항 노출 영역입니다.</li>
			</ul>
		</div>
		<div class="contents2 lottoball" style="padding:2% 0 4% 0">
			<div>
				<div class="swiper-container2" style="padding-top:4%">
					<div class="swiper-wrapper2">
						<div class="swiper-slide2">
							
							<p>
								<!--span class="ball_prev"><a href=""><img src="http://image.mrlotto.co.kr/mobile/ball_arrow_prev.jpg"></a></span-->
								<span class="number">829</span>
								<span class="text">회 당첨 번호 안내</span>
								<span class="date">2018.11.26</span>
								<!--span class="ball_next"><a href=""><img src="http://image.mrlotto.co.kr/mobile/ball_arrow_next.jpg"></a></span-->
							</p>
							<div style="background-color:#f8f8f8;margin-top:4%;padding:2%" class="lotto_ball">
								<p>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_1.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_4.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_15.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_25.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_37.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/plus.png" style="width:5%;padding-top:2.5%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_41.png" style="width:11%"></span>
								</p>
							</div>
						</div>
						<div class="swiper-slide2">
							<p>
								<!--span class="ball_prev"><a href=""><img src="http://image.mrlotto.co.kr/mobile/ball_arrow_prev.jpg"></a></span-->
								<span class="number">828</span>
								<span class="text">회 당첨 번호 안내</span>
								<span class="date">2018.11.26</span>
								<!--span class="ball_next"><a href=""><img src="http://image.mrlotto.co.kr/mobile/ball_arrow_next.jpg"></a></span-->
							</p>
							<div style="background-color:#f8f8f8;margin-top:4%;padding:2%" class="lotto_ball">
								<p>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_1.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_4.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_15.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_25.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_37.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/plus.png" style="width:5%;padding-top:2.5%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_41.png" style="width:11%"></span>
								</p>
							</div>
						</div>
						<div class="swiper-slide2">
							<p>
								<!--span class="ball_prev"><a href=""><img src="http://image.mrlotto.co.kr/mobile/ball_arrow_prev.jpg"></a></span-->
								<span class="number">827</span>
								<span class="text">회 당첨 번호 안내</span>
								<span class="date">2018.11.26</span>
								<!--span class="ball_next"><a href=""><img src="http://image.mrlotto.co.kr/mobile/ball_arrow_next.jpg"></a></span-->
							</p>
							<div style="background-color:#f8f8f8;margin-top:4%;padding:2%" class="lotto_ball">
								<p>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_1.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_4.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_15.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_25.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_37.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/plus.png" style="width:5%;padding-top:2.5%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_41.png" style="width:11%"></span>
								</p>
							</div>
						</div>
						<div class="swiper-slide2">
							<p>
								<!--span class="ball_prev"><a href=""><img src="http://image.mrlotto.co.kr/mobile/ball_arrow_prev.jpg"></a></span-->
								<span class="number">826</span>
								<span class="text">회 당첨 번호 안내</span>
								<span class="date">2018.11.26</span>
								<!--span class="ball_next"><a href=""><img src="http://image.mrlotto.co.kr/mobile/ball_arrow_next.jpg"></a></span-->
							</p>
							<div style="background-color:#f8f8f8;margin-top:4%;padding:2%" class="lotto_ball">
								<p>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_1.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_4.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_15.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_25.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_37.png" style="width:11%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/plus.png" style="width:5%;padding-top:2.5%"></span>
									<span><img src="http://image.mrlotto.co.kr/mobile/ball_41.png" style="width:11%"></span>
								</p>
							</div>
						</div>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
				<script src="js/swiper2.js"></script>
				
				<script>
				    var swiper = new Swiper('.swiper-container2', {
				      navigation: {
				        nextEl: '.swiper-button-next',
				        prevEl: '.swiper-button-prev',
				      },
				    });
				  </script>


			</div>
			<div class="lotto_table">
				<table cellpadding="0" cellspacing="0" border="0" style="width:100%;" class="lottotable">
					<thead>
						<col width="15%">
						<col width="35%">
						<col width="18%">
						<col width="30%">
					</thead>
					<tbody>
						<tr>
							<td>순위</td>
							<td>당첨금액</td>
							<td>당첨자 수</td>
							<td>미스터로또씨 조합 수</td>
						</tr>
						<tr>
							<td>1</td>
							<td>2,444,650,641원</td>
							<td>8명</td>
							<td>0조합</td>
						</tr>
						<tr>
							<td>2</td>
							<td>72,434,094원</td>
							<td>29명</td>
							<td>1조합</td>
						</tr>
						<tr>
							<td>3</td>
							<td>1,774,379원</td>
							<td>1,596명</td>
							<td>106조합</td>
						</tr>
					</tbody>
				</table>
				<!--a href=""><img src="http://image.mrlotto.co.kr/mobile/tablemore.jpg"></a-->
			</div>
		</div>
		<div><img src="http://image.mrlotto.co.kr/mobile/line.jpg" class="line"></div>
		<div><a href="sub1.php"><img src="http://image.mrlotto.co.kr/mobile/banner2.jpg"></a></div>
		<div><img src="http://image.mrlotto.co.kr/mobile/line.jpg" class="line"></div>
		<div class="contents" style="position:relative">
			<div class="news">
				<p><img src="http://image.mrlotto.co.kr/mobile/news_tit.jpg"></p>
				<span><a href="notice_list.php"><img src="http://image.mrlotto.co.kr/mobile/more.jpg"></a></span>
			</div>
			<div class="news_table">
				<div style="border-bottom:1px solid #d8d8d8">
					<div class="news_table_thum"><img src="http://image.mrlotto.co.kr/mobile/news1.jpg"></div>
					<p class="news_tit f2 word">로또 허위 광고 이대로 괜찮은가? 광고 이대로 괜찮은가? 광고 이대로 괜찮은가?</p>
					<span class="news_date f3">10-11</span>
				</div>
				<div>
					<div class="news_table_thum"><img src="http://image.mrlotto.co.kr/mobile/news2.jpg"></div>
					<p class="news_tit f2 word">'미스터로또씨' 독자적인 분석 시스템의 분석 시스템의</p>
					<span class="news_date f3">10-11</span>
				</div>
			</div>
		</div>
		<div><img src="http://image.mrlotto.co.kr/mobile/line.jpg" class="line"></div>
		<div><img src="http://image.mrlotto.co.kr/mobile/img1.jpg"></div>
		<div><a href="javascript:;" id="layer_popup" class="ex1"><img src="http://image.mrlotto.co.kr/mobile/img2.jpg" style="width:50%"></a><a href="javascript:;" id="layer_popup2" class="ex2"><img src="http://image.mrlotto.co.kr/mobile/img3.jpg" style="width:50%"></a></div>
	
	
		
		<div class="ow-overlay ow-closed"></div> 
		
		<div class="modal ow-closed">
		  <img src="http://image.mrlotto.co.kr/mobile/m2.jpg">
		  <a class="close-button" href='#' style="color:#111;background-color: #fff;padding:1% 5% ;">닫기</a>
		</div>
		<div class="modal2 ow-closed">
		  <img src="http://image.mrlotto.co.kr/mobile/m_1.jpg">
		  <a class="close-button2" href='#' style="color:#111;background-color: #fff;padding:1% 5% ;">닫기</a>
		</div>
		
			
		<script type="text/javascript" src="js/jquery.omniwindow.js"></script> 
		
		
		<div><img src="http://image.mrlotto.co.kr/mobile/line.jpg" class="line"></div>
		<div class="chart" >
			
			<div class="contents">
				<p style="width:100%;padding-bottom:2%;border-bottom: 1px solid #111;"><img src="http://image.mrlotto.co.kr/mobile/chart_tit.jpg" style="width:80%"></p>
			</div>
			
			<div class="">
				<!-- slider -->
				<ul class="slider1">
					<li>
						<div class="contents">
							<h3>통계 분석 시스템(Statistical Analysis System)</h3>
							<p>미스터로또씨는 역대 로또 당첨 번호를 빅데이터화 하여 당첨 정보를 분석합니다. 최다 당첨번호 및 최저 당첨번호 추출, 홀짝 비율, 고저 비율을 더한 총합, 당첨 조합 끝자리, 끝자리를 모두 더한 끝수 합 등을 분석하여 패턴화 합니다.</p>
						</div>
						<img src="http://image.mrlotto.co.kr/mobile/chart1.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>패턴 비율 예측 시스템(Pattern Proportion System)</h3>
							<p>위의 데이터를 기반으로 패턴을 분석하고 비율을 예측합니다. 과거부터 현재까지 이른 장기적인 동향 분석과 최근 회차의 단기적인 동향을 분석하여, 현재 추세를 확인합니다. 28가지의 자체 알고리즘 필터링 방식을 사용하여 안정성이 높은 패턴과 낮은 패턴을 분류하게 됩니다.</p>
						</div>
						<img src="http://image.mrlotto.co.kr/mobile/chart2.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>변수 제거 시스템(Variable emoval System)</h3>
							<p>체계적인 패턴 필터링 후 조합 변수를 제거하는 작업을 거칩니다. 1,2단계를 거친 누적 데이터를 기반으로 한 데이터 베이스를 반영하여 가장 최적화 된 추첨 패턴을 적용합니다. 선별된 패턴 내에도 동일한 작업이 이루어지며, 당첨 번호 출현 가능 범위를 압축하여 변수를 제거 합니다.</p>
						</div>
						<img src="http://image.mrlotto.co.kr/mobile/chart3.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>변수 제거 시스템(Variable emoval System)</h3>
							<p>체계적인 패턴 필터링 후 조합 변수를 제거하는 작업을 거칩니다. 1,2단계를 거친 누적 데이터를 기반으로 한 데이터 베이스를 반영하여 가장 최적화 된 추첨 패턴을 적용합니다. 선별된 패턴 내에도 동일한 작업이 이루어지며, 당첨 번호 출현 가능 범위를 압축하여 변수를 제거 합니다.</p>
						<img src="http://image.mrlotto.co.kr/mobile/chart4.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>최적 번호 추출 및 맞춤형 초이스 넘버링 시스템<br>(Extract Optimal Number / Choice Number System)</h3>
							<p>시스템을 활용한 번호 조합이 완료되면 미스터로또씨의 연구원 및 전문가들이 이를 검토 및 분석하게 됩니다. 슈퍼 컴퓨터 시스템이 미처 닿지 못하는 세밀한 부분까지 확인하게 되면 당첨 확률을 높이는 최적의 번호 조합이 완성됩니다.</p>
						<img src="http://image.mrlotto.co.kr/mobile/chart5.jpg">
					</li>
				</ul>
				
			</div>
		</div>
		<!--div><img src="http://image.mrlotto.co.kr/mobile/line.jpg" class="line"></div>
		<div><a href="http://www.mrlotto.co.kr/m/bbs/board_v.php?dep=e&page=1&uid=13"><img src="http://image.mrlotto.co.kr/mobile/event_banner.jpg"></a></div-->
		<div><img src="http://image.mrlotto.co.kr/mobile/line.jpg" class="line"></div>
		
		<div class="contents" style="position:relative">
			<div class="product">
				<p><img src="http://image.mrlotto.co.kr/mobile/product_tit.jpg"></p>
				<span><a href="sub3.php"><img src="http://image.mrlotto.co.kr/mobile/more.jpg"></a></span>
			</div>
			<div class="swiper-container">
			<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="pro_tit1">프리미엄 2년제</div>
				<div class="pro_tit2">50% 할인</div>
				<span>30명 제한</span>
				<div style="padding:0 8px"><img src="http://image.mrlotto.co.kr/mobile/red_box.jpg" style="width:100%"></div>
				<div class="mon_s"><s>900,000원</s></div>
				<div class="mon_b">449,000원</div>
				<div class="pro_bt"><a href="sub3.php">상품 보러가기</a></div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">프리미엄 1년제</div>
				<div class="pro_tit2">45% 할인</div>
				<span>100명 제한</span>
				<div style="padding:0 8px"><img src="http://image.mrlotto.co.kr/mobile/red_box.jpg" style="width:100%"></div>
				<div class="mon_s"><s>540,000원</s></div>
				<div class="mon_b">299,000원</div>
				<div class="pro_bt"><a href="http://www.mrlotto.co.kr/mobile/sub3.php#pro2">상품 보러가기</a></div>
			</div>
			<div class="swiper-slide">
				<div style="background-color: #111;width:100%;height:100%;position: absolute;z-index: 9999;border-radius: 9px; opacity: 0.8"></div>
				<div class="soldout">
					<div class="pro_tit1">골드 2년제</div>
					<div class="pro_tit2">40% 할인</div>
					<div class="mon_s" style="padding-top:45px"><s>410,000원</s></div>
					<div class="mon_b">245,000원</div>
					<div class="pro_bt"><a href="sub3.php#pro2">상품 보러가기</a></div>
					<img src="http://image.mrlotto.co.kr/mobile/soldout.png">
				</div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">골드 1년제</div>
				<div class="pro_tit2">35% 할인</div>
				<div class="mon_s" style="padding-top:45px"><s>300,000원</s></div>
				<div class="mon_b">199,000원</div>
				<div class="pro_bt"><a href="sub3.php#pro2">상품 보러가기</a></div>
			</div>
			<div class="swiper-slide">
				
				<div style="background-color: #111;width:100%;height:100%;position: absolute;z-index: 9999;border-radius: 9px; opacity: 0.8"></div>
				<div class="soldout">
					<div class="pro_tit1">실버 2년제</div>
					<div class="pro_tit2">30% 할인</div>
					<div class="mon_s" style="padding-top:45px"><s>210,000원</s></div>
					<div class="mon_b">145,000원</div>
					<div class="pro_bt"><a href="sub3.php#pro3">상품 보러가기</a></div>
					<img src="http://image.mrlotto.co.kr/mobile/soldout.png">
				</div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">실버 6개월</div>
				<div class="pro_tit2">25% 할인</div>
				<div class="mon_s" style="padding-top:45px"><s>130,000원</s></div>
				<div class="mon_b">99,000원</div>
				<div class="pro_bt"><a href="sub3.php#pro3">상품 보러가기</a></div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">골드 1개월</div>
				<div class="pro_tit2">20% 할인</div>
				<div class="mon_s" style="padding-top:45px"><s>25,000원</s></div>
				<div class="mon_b">20,000원</div>
				<div class="pro_bt"><a href="sub3.php#pro4">상품 보러가기</a></div>
			</div>
			</div>
			
			<!--div class="swiper-pagination"></div-->
			</div>

		</div>
		<div><img src="http://image.mrlotto.co.kr/mobile/line.jpg" class="line"></div>
		<div><a href="sub1.php"><img src="http://image.mrlotto.co.kr/mobile/footer_banner.png"></a></div>
		<div><img src="http://image.mrlotto.co.kr/mobile/line.jpg" class="line"></div>
		
		<div class="contents" style="position:relative">
			<div class="tv">
				<p><img src="http://image.mrlotto.co.kr/mobile/tv_tit.jpg"></p>
				<div><img src="http://image.mrlotto.co.kr/mobile/video.jpg"></div>
			</div>
		</div>
		<div><img src="http://image.mrlotto.co.kr/mobile/line.jpg" class="line"></div>
		<div class="contents" style="position:relative">
			<div class="event" style="margin-bottom:2%">
				<p><img src="http://image.mrlotto.co.kr/mobile/event_tit.jpg"></p>
				<span><a href="event_list.php"><img src="http://image.mrlotto.co.kr/mobile/more.jpg"></a></span>
			</div>
			<div>
				<div style="border:1px solid #d8d8d8; border-radius: 15px;padding:2% 3%;margin-bottom:2%">
					<div class="event_thum"><a href="event_list.php"><img src="http://image.mrlotto.co.kr/mobile/event_1.jpg"></a></div>
					<div class="event_thum_tit">
						<h4><a href="event_list.php">1개월 자동 결제 경품 증정 이벤트</a></h4>
						<p class="f4 word2"><a href="event_list.php">자동 연장 결제 상품 가입 시, 상품가 상단의 경품을 증정해 드립니다.</a></p>
					</div>
				</div>
				<div style="border:1px solid #d8d8d8; border-radius: 15px;padding:2% 3%">
					<div class="event_thum"><a href="event_list.php"><img src="http://image.mrlotto.co.kr/mobile/event_2.jpg"></a></div>
					<div class="event_thum_tit">
						<h4><a href="event_list.php">홈페이지 리뉴얼 기념 이벤트</a></h4>
						<p class="f4 word2"><a href="event_list.php">지금 상품 결제하시면 1개월을 더! 홈페이지 리뉴얼 이벤트를</a></p>
					</div>
				</div>
			</div>
		</div>
		<div><img src="http://image.mrlotto.co.kr/mobile/line.jpg" class="line"></div>
		<div class="contents">
			<ul style="overflow: hidden">
				<li style="width:50%;float: left;padding-right:2%;box-sizing: border-box">
					<img src="http://image.mrlotto.co.kr/mobile/cc_tit.jpg" style="width:43%">
					<a href="tel:1811-7335"><img src="http://image.mrlotto.co.kr/mobile/footer_call.jpg" style="width:95%;margin:4% 0 2% 0"></a>
					<p class="f4" style="color:#2a76ce;margin-bottom:5%">클릭 시 바로 통화 가능합니다.</p>
					<p class="f4" style="font-weight:bold">평일 09:00 ~ 18:00<br>(점심시간 12:30 ~ 13:30 제외)</p>
					<p class="f4">주말 및 공휴일 고객센터 휴무</p>
				</li>
				<li style="width:50%;float: left;padding-left:1%;box-sizing: border-box">
					<img src="http://image.mrlotto.co.kr/mobile/money_tit.jpg" style="width:77%">
					<p class="f2" style="color:#2a76ce;margin:4% 0 2% 0">IBK 기업은행</p>
					<p class="f1">664-019737-01-020</p>
					<p class="f4">예금주 : 미스터퀀트(주)</p>
					<div class="f5" style="background-color:#f8f8f8;border-radius: 10px; color:#2a76ce;padding:4%;margin-top:3%">무통장입금 하신 경우 입금자확인을 위해 미스터로또씨로 꼭 연락주시기 바랍니다.</div>
				</li>
			</ul>
		</div>
		<div class="f4" style="border-top:1px solid #111; border-bottom:1px solid #111; text-align: center;padding:1% 0">
			<span><a href="join1.php">이용약관</a></span>
			<span style="margin:0 3%"><a href="join2.php">개인정보 처리방침</a></span>
			<span><a href="join3.php">마케팅 정보 수신 동의</a></span>
		</div>
		<div style="background-color: #333;color:#ccc;text-align: center;padding:2% 0" class="f5">
			<p>미스터퀀트 주식회사&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEL : 1811-7335&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FAX : 02-2067-3090</p>
			<p>대표이사 : 조정윤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;개인정보책임관리자 : 조정윤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;사업자등록번호 : 547-88-01224</p>
			<p>주소 : 서울특별시 금천구 가산디지털1로 142, 1118호(가산동, 가산더스카이밸리 1차)</p>
			<p class="f5" style="padding-top:1%;color:#666">COPYRIGHT ⓒ 2018 Mr.quant All rights reserved.</p>
		</div>
		<div style="background-color:#222;color:#888;text-align: center; padding:2% 4%" class="f5">* 당사의 분석 시스템은 전체 로또번호 조합 중 등급별 압축 필터링한 조합 정보제공만을 목적으로 하며, 당첨 확정 서비스가 아니므로 서비스 이용 과정에서 기대이익을 얻지 못하거나 발생한 손해 등에 대한 최종책임은 서비스 이용자 본인에게 있습니다.</div>
		
		
	<script src="js/swiper.min.js"></script>
	<script>
	    var swiper = new Swiper('.swiper-container', {
	      slidesPerView: 3,
	      spaceBetween: 5,
	      pagination: {
	        el: '.swiper-pagination',
	        clickable: true,
	      },
	    });
	  </script>
	</body>
</html>
