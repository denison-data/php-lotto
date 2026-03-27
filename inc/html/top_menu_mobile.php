<ul>
	<li class="btn"><img src="http://<?=$img_url?>/mobile/category.png"></li>
	<li><a href="<?=$mobile_dir?>/"><img src="http://<?=$img_url?>/mobile/logo.png"></a></li>
	<li>
		<?
		if(!$_SESSION['userid']){
		?>
		<a href="<?=$mobile_dir?>/member/login.php"><img src="http://<?=$img_url?>/mobile/login.png" id="logimg"></a>
		<? } else { ?>
		<a href="javascript:;" id="logout"><img src="http://<?=$img_url?>/mobile/logout.png" id="logimg"></a>
		
		<? } ?>
	</li>
	<!--li><img src="http://<?=$img_url?>/mobile/logout.png"></li-->
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
			<li><a href="<?=$mobile_dir?>/info/sub.php?dep=1">분석시스템 소개</a></li>
		</ul>
		<ul class="menu">
			<li><a href="#">당첨 통계</a>
				<ul class="sub">
					<li><a href="<?=$mobile_dir?>/info/sub1_stats.php?sub=2">번호별 통계</a></li>
					<li><a href="<?=$mobile_dir?>/info/sub1_stats.php?sub=3">색상 통계</a></li>
					<li><a href="<?=$mobile_dir?>/info/sub1_stats.php?sub=4">구간별 출현횟수</a></li>
					<li><a href="<?=$mobile_dir?>/info/sub1_stats.php?sub=5">기간별 미출현 번호</a></li>
					<li><a href="<?=$mobile_dir?>/info/sub1_stats.php?sub=6">홀짝 통계</a></li>
					<li><a href="<?=$mobile_dir?>/info/sub1_stats.php?sub=7">연속번호 출현</a></li>
				</ul>
			</li>
		</ul>
		<ul class="menu">
			<li><a href="<?=$mobile_dir?>/info/sub.php?dep=2">상품 소개</a></li>
		</ul>
		<ul class="menu">
			<li><a href="<?=$mobile_dir?>/bbs/board.php?dep=n">공지사항</a></li>
		</ul>
		<ul class="menu">
			<li><a href="#">마이페이지</a>
				<ul class="sub">
					<li><a <? if(!$_SESSION['userid']){ ?>href="<?=$mobile_dir?>/member/login.php?target=<?=$mobile_dir?>/member/mypage.php" <? } else { ?>href="<?=$mobile_dir?>/member/mypage.php"<? } ?> id="movePage01">조합 내역</a></li>
					<li><a <? if(!$_SESSION['userid']){ ?>href="<?=$mobile_dir?>/member/login.php?target=<?=$mobile_dir?>/member/mycoupon2.php" <? } else { ?>href="<?=$mobile_dir?>/member/mycoupon2.php"<? } ?> id="movePage02">쿠폰</a></li>
					<li><a <? if(!$_SESSION['userid']){ ?>href="<?=$mobile_dir?>/member/login.php?target=<?=$mobile_dir?>/member/orders.php" <? } else { ?>href="<?=$mobile_dir?>/member/orders.php"<? } ?> id="movePage03">서비스 설정</a></li>
					<li><a <? if(!$_SESSION['userid']){ ?>href="<?=$mobile_dir?>/member/login.php?target=<?=$mobile_dir?>/member/modify.php" <? } else { ?>href="<?=$mobile_dir?>/member/modify.php"<? } ?> id="movePage04">회원 정보 관리</a></li>
				</ul>
			</li>
		</ul>
		<ul class="menu">
			<li><a href="<?=$mobile_dir?>/bbs/board.php?dep=e">이벤트</a></li>
		</ul>
	</div>
  <!--div style="color:#2b7ad9;padding-left:10%;margin-top:5%;font-weight: bold;display:inline-block;vertical-align: middle;width:150px;line-height:30px"><img src="http://<?=$img_url?>/mobile/key.png" style="width:20px; height:26px;margin-right:3%">로그아웃</div-->
	<?
	if($_SESSION['userid']){
	?>
	 <div style="color:#2b7ad9;padding-left:10%;margin-top:5%;font-weight: bold;display:inline-block;vertical-align: middle;width:150px;line-height:30px"><a href="javascript:;" id="logout2"><img src="http://<?=$img_url?>/mobile/key.png" style="width:20px; height:26px;margin-right:3%">로그아웃</a></div>
	<?
	} else {
	?>
	<div style="color:#2b7ad9;padding-left:10%;margin-top:5%;font-weight: bold;display:inline-block;vertical-align: middle;width:150px;line-height:30px"><a href="<?=$mobile_dir?>/member/login.php"><img src="http://<?=$img_url?>/mobile/key2.png" style="width:20px; height:26px;margin-right:3%">로그인</a></div>
	<? } ?>
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