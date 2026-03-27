<?
$_pp_e = 0;
$_pp_s = 0;


include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');

$cur_seq = getCurSeq();
$_WIN = getSeqRank($cur_seq-5, $cur_seq, 'desc');

$_BRO = getBrod($cur_seq-3, $cur_seq, 'desc');

$_BBS = getBbsList(0,2,'e','desc');

$code = $_SESSION['code'];
$rs = ordrGoods($code,'','asc');

if(count($rs)==0){
	$product = "일반사용자";
	$limit_day = "탈퇴시";
	$next_product = "적용상품 없음";
} else {
	
	$product = $rs[0]['Good_name']."".$rs[0]['Title1'];
	if($rs[0]['Start_Date']){
		$ing = "이용중";
		$limit_day = date("y.m.d", strtotime($rs[0]['Finish_Date']))." 까지";
	} else {
		$ing = "이용전";
		$limit_day = "문자서비스 시작전";
	}
	
	if(count($rs)==1){
		$next_product = "적용상품 없음";
	} else {

		$next_product = $rs[1]['Good_name']."".$rs[1]['Title1'];
	}
}
?>
<script type="text/javascript">
$(document).ready(function(){
	view_tables('<?=$cur_seq?>');
});
</script>
<ul>
		<div style="text-align: center;border: 4px solid #e5e5e5;width: 985px;padding:29px 0;float: left;margin-right:10px">
			<ul>
				<h1 style="font-size: 34px;font-weight: 400"><span style="font-size:44px;font-weight: 500;color: #2b76d3" id="nseq"><?=$cur_seq?></span>회 당첨 번호 안내</h1>
				<li>
					<div style="border-bottom: 1px solid #e5e5e5;padding:0 20px">
						
						<div id="content">
							<div id="content_inner">
						  <!-- end intro -->
						  <!-- end sidebar_right -->
					  			<ul id="slides1">
									<? $n= 0; foreach($_WIN as $seq => $arr) { ?>
									
									<li>
										<input type="hidden" name="seq_id_<?=$n?>" id="seq_id_<?=$n?>" value="<?=$seq?>">
										
										<div>
											
											<? foreach(getBallField() as $field) { ?>
											<img src="http://image.mrlotto.co.kr/ball/new/lot_ball<?=$arr[$field]?>.jpg">
											<? } ?>												
											<img src="http://image.mrlotto.co.kr/main_lotto_plus.jpg" class="plus">
											<img src="http://image.mrlotto.co.kr/ball/new/lot_ball<?=$arr['bonus'];?>.jpg">
											
										</div>
									</li>
									<?  $n=$n+1; } ?>
								</ul>
							</div>
							<div class="ball_info" id="win_result">
								<ul>
									<li class="ball_info_tit">1등</li>
									<a id="num1_num"><?=number_format($_WIN[$cur_seq]['rank_1_count'])?></a>
									<li class="ball_info_txt" style="margin-right:30px">명</li>
									<li class="ball_info_tit">당첨금</li>
									<a id="num1_price">										
									</a>
									<li class="ball_info_txt">원</li>
								</ul>
							</div>
						</div><!-- end content_inner, content -->

						
					</div>

				</li>
				<li>
					<div class="lotto_tb_1">
						<ul>
							<h2>동행복권 총 당첨현황</h2>
							<li>
								<table class="lotto_tb_1_tb" cellpadding="0" cellspacing="0" border="0" style="width: 100%">
									<colgroup>
										<col width="20%">
										<col width="35%">
										<col width="45%">
									</colgroup>
									<thead>
										<tr>
											<th>등수</th>
											<th>당첨자 수</th>
											<th>1인당 당첨금액</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><span >1</span></td>
											<td id="num1_num_a">0명</td>
											<td id="num1_price_a">0원</td>
										</tr>
										<tr>
											<td>2</td>
											<td id="num2_num">0명</td>
											<td id="num2_price">0원</td>
										</tr>
										<tr>
											<td>3</td>
											<td id="num3_num">0명</td>
											<td id="num3_price">0원</td>
										</tr>
									</tbody>
								</table>
							</li>
						</ul>
						<ul>
							<h2>로또씨 회원 당첨현황</h2>
							<li>
								<table class="lotto_tb_1_tb1" cellpadding="0" cellspacing="0" border="0" style="width: 100%">
									<colgroup>
										<col width="20%">
										<col width="43%">
										<col width="37%">
									</colgroup>
									<thead>
										<tr>
											<th>당첨조합</th>
											<th>1인당 당첨금액</th>
											<th>적중금액 총액</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td id="num1_mrlotto">0명</td>
											<td id="num1_price_a2">0원</td>
											<td id="num1_mrlotto_g">0원</td>
										</tr>
										<tr>
											<td id="num2_mrlotto">0명</td>
											<td id="num2_price_a2">0원</td>
											<td id="num2_mrlotto_g">0원</td>
										</tr>
										<tr>
											<td id="num3_mrlotto">0명</td>
											<td id="num3_price_a2">0원</td>
											<td id="num3_mrlotto_g">0원</td>
										</tr>
									</tbody>
								</table>
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
		<div style="width: 284px;float: left">
			<ul style="margin-bottom:10px">
				<li>
					<?
					if(!$_SESSION['userid']){
					?>

					<form method="post" name="form1" id="form1">
					<input type="hidden" name="mode" value="logins">
					<div class="main_login">
						<input type="text" class="main_login_input_id" placeholder="아이디를 입력하세요" name="user_id" id="user_id">
						<input type="password" class="main_login_input_pw" placeholder="패스워드를 입력하세요" name="pwd" id="pwd">
						<span class="id_check"><input type="checkbox" id="login_id_check"><label for="id_check">&nbsp;아이디 저장</label></span>
						<span class="id_pw_find"><a href="/member/find.php">아이디 / 비밀번호 찾기</a></span>
						<a class="main_login_bt" name="로그인" href="javascript:;" id="login_ck">로그인</a>
						<div class="main_login_bt2">
							<a class="main_join_bt" name="회원가입" href="/member/join.php" >회원가입</a>
							<a class="main_naver_login_bt" name="네이버 로그인"  href="javascript:;" id="naver_id_login">네이버 로그인</a>
						</div>
					</div>
					
					</form>

					<?
					} else {
					?>	
					<div class="main_login_after">
						<div class="login_name"><a href="/member/mypage.php"><?=$_SESSION['nickname']?></a>님</div>
						<div class="login_item_info">
							<span class="login_item"><?=$product?></span><span><?=$ing?></span>
							<span class="login_item_date">만료일 : <?=$limit_day?><!--18년 10월 2일---><a class="extend" href="/info/sub.php?dep=2" >기간 연장</a></span>
						</div>
						<div class="login_item_next">다음 적용 상품 : <?=$next_product?><!--골드 회원권 1년제---></div>
						<div class="main_login_after_bt">
							<a class="login_after_bt1" name="내 조합 내역" href="/member/mypage.php">내 조합 내역</a>
							<a class="login_after_bt2" name="쿠폰 등록" href="/member/mycoupon2.php">쿠폰 등록</a>
						</div>
						<div class="main_login_after_bt2">
							<a class="login_after_bt3" name="회원정보 수정" href="/member/modify.php">회원정보 수정</a>
							<a class="login_after_bt4" name="로그아웃" id="logout" style="cursor:pointer" >로그아웃</a>
						</div>
					</div>	
					<?
					}
					?>
				</li>
			</ul>
				
			<div id="main_bn">
				<li>
					<img src="http://image.mrlotto.co.kr/right_banner1.jpg">
				</li>
				<li>
					<img src="http://image.mrlotto.co.kr/right_banner2.jpg">
				</li>
			</div>
		
			
		</div>
	</ul>
	<ul style="margin: 20px 0;overflow: hidden;">
		<div style="float: left;box-sizing: border-box;width: 635px;border:1px solid #e5e5e5;margin-right:10px;padding:30px 20px">
			<h3 style="border-bottom: 1px solid #111;font-size:26px; text-align: left;padding-bottom:15px;font-weight: 400">Real Filter System Algorithm</h3>
			
			<div id="main_bn2">
				<li>
					<h4 style="font-size: 20px;font-weight: 400;padding:20px 0 10px 0 ">통계 분석 시스템(Statistical Analysis System)</h4>
					<p style="padding-bottom:30px">미스터로또씨는 역대 로또 당첨 번호를 빅데이터화 하여 당첨 정보를 분석합니다.<br>
최다 당첨번호 및 최저 당첨번호 추출, 홀짝 비율, 고저 비율을 더한 총합, 당첨 조합 끝자리, 끝자리를 모두 더한 끝수 합 등을 분석하여 패턴화 합니다.</p>
					<img src="http://image.mrlotto.co.kr/new_chart1.jpg">
				</li>
				<li>
					<h4 style="font-size: 20px;font-weight: 400;padding:20px 0 10px 0 ">패턴 비율 예측 시스템(Pattern Proportion System)</h4>
					<p style="padding-bottom:30px">위의 데이터를 기반으로 패턴을 분석하고 비율을 예측합니다. 과거부터 현재까지 이른 장기적인 동향 분석과 최근 회차의 단기적인 동향을 분석하여, 현재 추세를 확인합니다. 28가지의 자체 알고리즘 필터링 방식을 사용하여 안정성이 높은 패턴과 낮은 패턴을 분류하게 됩니다.</p>
					<img src="http://image.mrlotto.co.kr/new_chart2.jpg">
				</li>
				<li>
					<h4 style="font-size: 20px;font-weight: 400;padding:20px 0 10px 0 ">변수 제거 시스템(Variable emoval System)</h4>
					<p style="padding-bottom:30px">체계적인 패턴 필터링 후 조합 변수를 제거하는 작업을 거칩니다. 1,2단계를 거친 누적 데이터를 기반으로 한 데이터 베이스를 반영하여 가장 최적화 된 추첨 패턴을 적용합니다. 선별된 패턴 내에도 동일한 작업이 이루어지며, 당첨 번호 출현 가능 범위를 압축하여 변수를 제거 합니다.</p>
					<img src="http://image.mrlotto.co.kr/new_chart3.jpg">
				</li>
				<li>
					<h4 style="font-size: 20px;font-weight: 400;padding:20px 0 10px 0 ">변수 제거 시스템(Variable emoval System)</h4>
					<p style="padding-bottom:30px">체계적인 패턴 필터링 후 조합 변수를 제거하는 작업을 거칩니다. 1,2단계를 거친 누적 데이터를 기반으로 한 데이터 베이스를 반영하여 가장 최적화 된 추첨 패턴을 적용합니다. 선별된 패턴 내에도 동일한 작업이 이루어지며, 당첨 번호 출현 가능 범위를 압축하여 변수를 제거 합니다.</p>
					<img src="http://image.mrlotto.co.kr/new_chart4.jpg">
				</li>
				<li>
					<h4 style="font-size: 20px;font-weight: 400;padding:20px 0 10px 0 ">최적 번호 추출 및 맞춤형 초이스 넘버링 시스템<br>(Extract Optimal Number / Choice Number System)</h4>
					<p style="padding-bottom:30px">시스템을 활용한 번호 조합이 완료되면 미스터로또씨의 연구원 및 전문가들이 이를 검토 및 분석하게 됩니다. 슈퍼 컴퓨터 시스템이 미처 닿지 못하는 세밀한 부분까지 확인하게 되면 당첨 확률을 높이는 최적의 번호 조합이 완성됩니다.</p>
					<img src="http://image.mrlotto.co.kr/new_chart5.jpg">
				</li>
	            <div id="main_bn_btn">
	                <li><a href="#"><img src="http://image.mrlotto.co.kr/blt.jpg"></a></li>
	                <li><a href="#"><img src="http://image.mrlotto.co.kr/bltout.jpg"></a></li>
	                <li><a href="#"><img src="http://image.mrlotto.co.kr/bltout.jpg"></a></li>
	                <li><a href="#"><img src="http://image.mrlotto.co.kr/bltout.jpg"></a></li>
	                <li><a href="#"><img src="http://image.mrlotto.co.kr/bltout.jpg"></a></li>
	            </div>
			</div>
		</div>
		<div style="float: left; width: 635px; vertical-align: top;">
			<img src="http://image.mrlotto.co.kr/notice_img.jpg" style="display: inline-block;margin:0 10px"><h2 style="display: inline-block;vertical-align: top;font-size:26px; font-weight: 400">공지사항</h2>
			<span style="vertical-align: top;margin-left:15px;font-size:18px">미스터로또씨 공지사항 게시판의 게시글 영역입니다.</span>
			<img src="http://image.mrlotto.co.kr/bigbanner.jpg" style="margin-top:10px">
		</div>
	</ul>	
	<ul>
		<h2 style="font-size:26px;line-height: 26px;margin:0 0 15px 20px;font-weight: 400">상품 소개</h2>
		<div class="pro">
			<ul>
				<li class="pro1">
					<h5>프리미엄 2년제</h5>
					<p class="p1">50% 할인</p>
					<span>30명 제한</span>
					<div class="div1"><img src="http://image.mrlotto.co.kr/prd_label.jpg"></div>
					<div class="div2"><s>900,000원</s></div>
					<p class="p2">449,000원</p>
					<div style=";text-align: center"><a href="/info/sub.php?dep=2">상품 보러가기</a></div>
				</li>
				<li class="pro1">
					<h5>프리미엄 1년제</h5>
					<p class="p1">45% 할인</p>
					<span>100명 제한</span>
					<div class="div1"><img src="http://image.mrlotto.co.kr/prd_label.jpg"></div>
					<div class="div2"><s>540,000원</s></div>
					<p class="p2">299,000원</p>
					<div style=";text-align: center"><a href="/info/sub.php?dep=2#premium1">상품 보러가기</a></div>
				</li>
				<li class="pro1" style="position: relative">
					<h5>골드 2년제</h5>
					<p class="p3">40% 할인</p>
					<div class="div2"><s>410,000원</s></div>
					<p class="p2">245,000원</p>
					<div style=";text-align: center"><a href="">상품 보러가기</a></div>
					<div class="soldout_bg"></div>
					<div class="soldout" style="position: absolute;z-index:100;bottom:-23px; right:-20px; "><img src="http://image.mrlotto.co.kr/new_soldout.png"></div>
				</li>
				<li class="pro1">
					<h5>골드 1년제</h5>
					<p class="p3">35% 할인</p>
					<div class="div2"><s>300,000원</s></div>
					<p class="p2">199,000원</p>
					<div style=";text-align: center"><a href="/info/sub.php?dep=2#premium2">상품 보러가기</a></div>
				</li>
				<li class="pro1" style="position: relative">
					<h5>실버 2년제</h5>
					<p class="p3">30% 할인</p>
					<div class="div2"><s>210,000원</s></div>
					<p class="p2">145,000원</p>
					<div style=";text-align: center"><a href="">상품 보러가기</a></div>
					<div class="soldout_bg"></div>
					<div class="soldout"><img src="http://image.mrlotto.co.kr/new_soldout.png"></div>
				</li>
				<li class="pro1">
					<h5>실버 6개월</h5>
					<p class="p3">25% 할인</p>
					<div class="div2"><s>130,000원</s></div>
					<p class="p2">99,000원</p>
					<div style=";text-align: center"><a href="/info/sub.php?dep=2#silver2">상품 보러가기</a></div>
				</li>
				<li class="pro1">
					<h5>골드 1개월</h5>
					<p class="p3">20% 할인</p>
					<div class="div2"><s>25,000원</s></div>
					<p class="p2">20,000원</p>
					<div style=";text-align: center"><a href="/info/sub.php?dep=2#silver2">상품 보러가기</a></div>
				</li>
			</ul>
		</div>
	</ul>	
	<ul>
		<div style="background: url('http://image.mrlotto.co.kr/awards_bg.jpg') no-repeat; width: 1280px; height:319px">
			
			<div class="autoplay" style="width: 890px;padding:115px 0 0 37px;box-sizing: border-box">		
			    <div><img src="http://image.mrlotto.co.kr/lotto1.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto2.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto3.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto4.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto5.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto6.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto7.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto8.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto9.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto10.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto11.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto12.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto13.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto14.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto15.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto16.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto17.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto18.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto19.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto20.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto21.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto22.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto23.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto24.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto25.jpg"></div>
			    <div><img src="http://image.mrlotto.co.kr/lotto26.jpg"></div>
			</div>
			
		</div>
	</ul>
	<ul style="overflow: hidden;margin-top:45px;">
		<li style="float: left;margin-right:20px"><a href="/info/sub.php?dep=1"><img src="http://image.mrlotto.co.kr/bt_banner.jpg"></a></li>
		<li style="float: left">
			<h2 style="font-size:26px;margin-bottom:15px;font-weight: 400">이벤트</h2>
			<div>
				<?
				if(sizeof($_BBS)!=0) {
					$ind = 0;
					foreach($_BBS as $bsq => $barr){
				?>
				<ul style="overflow: hidden;border: 1px solid #e5e5e5;width:630px;border-radius: 10px;padding:8px 0 8px 35px;<? if($ind!=0){?>margin-top:10px<? } ?>">
					<li style="float: left;padding-right:20px;"><a href="/bbs/board_v.php?dep=e&uid=<?=$barr['uid']?>"><img src="<?=$barr['file02']?>"></a></li>
					<li style="float: left;padding:18px 0">
					<a href="/bbs/board_v.php?dep=e&uid=<?=$barr['uid']?>">
					<h4 style="font-size: 20px;font-weight: 400;padding-bottom:5px;"><?=$barr['title']?></h4><p style="width: 435px;white-space:nowrap;overflow: hidden;text-overflow: ellipsis ;"><?=$barr['title2']?></p>
					</a>
					</li>
				</ul>
				<?
						$ind++;
					}
				} else {
				?>
				<div style="border:1px solid #d8d8d8; border-radius: 15px;padding:2% 3%;margin-bottom:2%">
					<div colspan="2" class="main_notice_1">게시된 내용이 조회되지 않습니다.</div>
				</div>
				<?
				}
				?>
				<!--
				<ul style="overflow: hidden;border: 1px solid #e5e5e5;width:630px;border-radius: 10px;padding:8px 0 8px 35px">
					<li style="float: left;padding-right:20px;"><img src="http://image.mrlotto.co.kr/new_thum1.jpg"></li>
					<li style="float: left;padding:18px 0"><h4 style="font-size: 20px;font-weight: 400;padding-bottom:5px;">미스터로또씨 룰렛 이벤트</h4><p style="width: 435px;white-space:nowrap;overflow: hidden;
text-overflow: ellipsis ;">더욱더 확률이 높아진 로또번호조합을 무료로 받아가세요</p></li>
				</ul>
				<ul style="overflow: hidden;border: 1px solid #e5e5e5;width:630px;border-radius: 10px;padding:8px 0 8px 35px;margin-top:10px">
					<li style="float: left;padding-right:20px"><img src="http://image.mrlotto.co.kr/new_thum2.jpg"></li>
					<li style="float: left;padding:18px 0"><h4 style="font-size: 20px;font-weight: 400;padding-bottom:5px;">1개월 자동 결제 경품 증정 이벤트</h4><p style="width: 435px;white-space:nowrap;overflow: hidden;
text-overflow: ellipsis ;">지금 골드 회원 가입하면 3만원상당의 경품증정</p></li>
				</ul>
				--->
			</div>
		</li>
	</ul>
	<ul style="border: 1px solid #e5e5e5;margin-top:20px;overflow: hidden">
		<li style="float: left">
			<div style="padding:30px 20px;width: 425px; height: 236px">
				<h2 style="display: inline-block;font-size:26px;margin-bottom:15px;font-weight: 400">SBS 추첨방송</h2>
				<div style="display: inline-block;width: 240px;text-align: right">
					<select name="vseq" style="border: none;padding-right:20px;font-size:15px" onchange="javascript:brod_img(this.value);">
						<? foreach($_BRO as $bseq => $brarr) { ?>
						<option value="<?=$brarr['seq']?>">[<?=$brarr['seq']?>회] <?=date("y.m.d",strtotime($brarr['date']))?> 토요일</option>
						<? } ?>
					</select>
				</div>
				<p style="display: block;background-color: #000; text-align: center" id="brod_img"><img src="http://image.mrlotto.co.kr/main_video.jpg"></p>
			</div>
		</li>
		<li style="float: left;border-left:1px solid #e5e5e5;border-right:1px solid #e5e5e5">
			<div style="padding:30px 20px;width: 425px; height: 236px">
				<h2 style="font-size:26px;margin-bottom:15px;font-weight: 400">고객 센터</h2>
				<p style="font-size:50px;font-weight: 600;letter-spacing: 0; color: #2b76d3;padding:30px 0 38px 0">1666-1212</p>
				<p style="font-size:18px;letter-spacing: 0;">평일 : 09:30 ~ 18:30 (점심시간 12:30 ~ 13:30 제외)</p>
				<p style="color:#2b76d3; ">주말 및 공휴일 고객센터 휴무</p>
			</div>
		</li>
		<li style="float: left">
			<div style="width: 425px; height: 236px">
				<h2 style="padding:30px 0 15px 20px;font-size:26px;margin-bottom:15px;font-weight: 400">무통장 입금계좌</h2>
				<ul style="overflow: hidden;padding-left:20px;">
					<li style="display: inline-block;vertical-align: top"><img src="http://image.mrlotto.co.kr/ibk.jpg"></li>
					<li style="display: inline-block;padding-left:20px">
						<p style="font-size:30px;font-weight: 400;padding-bottom:8px">664-019737-04-019</p>
						<p>예금주 : 미스터퀀트(주)</p>
					</li>
				</ul>
				<ul style="background-color: #f8f8f8;padding:15px 20px 30px 20px;margin-top:20px;color:#2b76d3;font-weight: 400">
					무통장입금 하신 경우 입금자확인을 위해 미스터로또씨로<br>꼭 연락주시기 바랍니다.
				</ul>
			</div>
		</li>
	</ul>
<?
dbClose($dbc);
include(BASE_DIR.'inc/html/foot.html');

?>