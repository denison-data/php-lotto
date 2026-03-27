<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');
include(BASE_DIR.'inc/html/head_m_member.html');
//login_check_m();
$code = $_SESSION['code'];
if($_GET['sb_seqs']){
	$sb_seqs = $_GET['sb_seqs'];
}
$rs = ordrGoods($code);
if(count($rs)==0){
	$product = "일반사용자";
} else {
	$product = $rs['Good_name']."".$rs['Title1'];
}
$ms = myLotto($code,'desc',$sb_seqs);
//echo $code;

$total = count($ms);
$set_page = $_GET[set_page] ? $_GET[set_page] : 5;
$bbs_page_scale = 5;
	
$page = $_GET[page] ? $_GET[page] : 1;

if ($total <= 0) $pages=1;
else	$pages = ceil( $total / $set_page ) ;

//페이지 계산 후 나머지 목록
$cur_pos = $set_page * $page - $set_page;

//시작되는 번호 초기화
$start_num  = $total - ( $page * $set_page ) + $set_page;

$cur_seq = getCurSeq();
$num1 = 0;
$num2 = 0;
$num3 = 0;
$num4 = 0;
$num5 = 0;

$pri1 = 0;
$pri2 = 0;
$pri3 = 0;
$pri4 = 0;
$pri5 = 0;
	
foreach($ms as $rs => $ky){
	$sq = $ky['seq'];//회차
	$ds = getSeqRank($sq,$sq);

	switch($ky['rank']){
		case "1"	:
			$num1++;
			$pri1 +=$ds[$sq]['rank_1_price'];
		break;
		case "2"	:	
			$num2++;
			$pri2 +=$ds[$sq]['rank_2_price'];
		break;
		case "3"	:	
			$num3++;
			$pri3 +=$ds[$sq]['rank_3_price'];
		break;
		case "4"	:	
			$num4++;
			$pri4 +=$ds[$sq]['rank_4_price'];
		break;
		case "5"	:	
			$pri5 +=$ds[$sq]['rank_5_price'];
			$num5++;
		break;

	}
}
$total_pr = $pri1+$pri2+$pri3+$pri4+$pri5;
$total_nm = $num1+$num2+$num3+$num4+$num5;
$search = "&sb_seqs=".$sb_seqs;
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#sb").change(function(){
		var seqs = $(this).val();
		$("#sb_seqs").val(seqs);
		$("#frm").submit();
	});
});
</script>
<form method="GET" name="frm" id="frm">
<input type="hidden" name="sb_seqs" id="sb_seqs">
</form>

<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/mix_tit.jpg"></h2>
	<div class="sub_menu_button">
		<a href="" class="on">내 조합 내역</a><a href="<?=$mobile_dir?>/member/number.php">초이스 넘버링</a>
	</div>
</div>

<div class="gray_box">
	<div class="mypage1_box">
		<div class="contents">
			<div><p>이용중인 상품</p><p class="my_box_txt1"><?=$product?></p></div>
			<div><p>당첨횟수</p><p class="my_box_txt1"><?=number_format($total_nm)?> 회</p></div>
			<div><p>총 당첨금</p><p class="my_box_txt1"><?=number_format($total_pr)?> 회</p></div>
		</div>
	</div>
	<div class="contents mypage1_box2">
		<p><img src="http://<?=$img_url?>/mobile/awards1.jpg"><span><?=number_format($num1)?> 회</span></p>
		<p><img src="http://<?=$img_url?>/mobile/awards2.jpg"><span><?=number_format($num2)?> 회</span></p>
		<p><img src="http://<?=$img_url?>/mobile/awards3.jpg"><span><?=number_format($num3)?> 회</span></p>
		<p><span class="circle">4등</span><span><?=number_format($num4)?> 회</span></p>
		<p><span class="circle">5등</span><span><?=number_format($num5)?> 회</span></p>
	</div>
</div>
<div class="contents2 mypage1_sel">
	<select  name="sb_seq" id="sb">
		<option value="">::전체회차::</option>
		<?
		for($i=($cur_seq+1);$i>=820;$i--){
		?>
		<option value="<?=$i?>" <? if($i==$_GET['sb_seqs']){?>selected<?} ?>><?=$i?>회차</option>
		<?
		}
		?>
	</select>
</div>
	<div class="contents">
		
		<div class="div_table">
			<ul>
				<li>회차</li>
				<li>번호 조합</li>
				<li>당첨 여부</li>
			</ul>
			<?
			if($total=="0"){
			?>
			<ul style="position:relative;left:0%"><font style="left:30%">조합 내역에 대한 데이터가 없습니다.</font></ul>
			<?
			} else {
				foreach(array_slice($ms,$cur_pos,$set_page) as $rows => $key){
			?>
			<ul>
				<li><?=$key['seq']?>회</li>
				<li class="table_lotto_ball small_ball">
					<? foreach(getBallField() as $field) { ?>
					<img src="http://<?=$img_url?>/mobile/ball_<?=$key[$field]?>.png">
					<? } ?>
					<!--
					<img src="http://image.mrlotto.co.kr/mobile/plus.png" class="plus">--->
				</li>
				<li>
					<?
					if($key['seq'] <= $cur_seq){
						if($key['rank']>0){
					?>
					<img src="http://<?=$img_url?>/mobile/awards<?=$key['rank']?>.jpg">
					
					<?
						} else { echo "미당첨";}
					} else {
					?>
					당첨발표 전
					<? } ?>
				
				
				</li>
			</ul>
			<?
				}
			}
			?>
			<div class="paging">
				<?=page_move_event_m($page, $set_page, $bbs_page_scale, $total, $search)?>

			</div>
		</div>
	</div>


<?
/*
<span><img src="http://image.mrlotto.co.kr/mobile/paging_prev.jpg"></span>
<!--span><img src="http://image.mrlotto.co.kr/mobile/paging_prev_on.jpg"></span-->
<span class="paging_on"><a href="">1</a></span>
<span>2</span>
<span>3</span>
<span>4</span>
<span>5</span>
<!--span><img src="http://image.mrlotto.co.kr/mobile/paging_next.jpg"></span-->
<span><img src="http://image.mrlotto.co.kr/mobile/paging_next_on.jpg"></span>

*/
include(BASE_DIR.'inc/html/foot_m.html');

?>