<!doctype html>
<html lang="ko">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/reset.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/style.css?dev=<?=date("YmdHis")?>">
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/sub_swiper.min.css?dev=<?=date("YmdHis")?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		
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


		<div class="top" style="background-color: #111">
			<!--table cellpadding="0" cellspacing="0" border="0" class="top_td">
				<tr>
					<td><a href=""><img src="http://image.mrlotto.co.kr/mobile/category.png"></a></td>
					<td><img src="http://image.mrlotto.co.kr/mobile/logo.png"></td>
					<!--td><img src="http://image.mrlotto.co.kr/mobile/login.png"></td->
					<td><img src="http://image.mrlotto.co.kr/mobile/logout.png"></td>
				</tr>
			</table-->
			
			
			<ul>
				<li class="btn"><img src="http://image.mrlotto.co.kr/mobile/category.png"></li>
				<li><a href="/mobile/"><img src="http://image.mrlotto.co.kr/mobile/logo.png"></a></li>
			  <!--div><img src="http://image.mrlotto.co.kr/mobile/login.png"></div-->
				<li><img src="http://image.mrlotto.co.kr/mobile/logout.png"></li>
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
			</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#nav ul.sub").hide();
			$("#nav ul.menu li").click(function(){
				$("ul",this).slideToggle("fast");
			});
			$("#close").click(function(){
				$("#menu,.page_cover,html").removeClass("open");
			});

			$("#layer_popup").click(function(){
				var $modal = $('div.modal').omniWindow();
			
					$modal.trigger('show');
				$('.close-button').click(function(e){
				  e.preventDefault();
				  $modal.trigger('hide');
				});
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

		<!--div class="nav">
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
					<td><a href="sub1.php">분석시스템</a></td>
					<td><a href="sub3.php">상품소개</a></td>
					<td><a href="notice_list.php">공지사항</a></td>
					<td><a href="mypage1_1.php">마이페이지</a></td>
					<td><a href="event_list.php">이벤트</a></td>
				</tr>
			</table>
			
  		</div>