<?

include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
include(BASE_DIR.'inc/html/mypage.html');

login_check();
$code = $_SESSION['code'];
$sb_seqs = "";
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
$set_page = $_GET['set_page'] ? $_GET['set_page'] : 20;
$bbs_page_scale = 5;
	
$page = $_GET['page'] ? $_GET['page'] : 1;

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
			<h1>내 조합 내역</h1>
			<div>
				<div class="mix_contents">
					<ul>
						<li>
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr>
									<td><img src="http://image.mrlotto.co.kr/class1.jpg"></td>
									<td><img src="http://image.mrlotto.co.kr/class2.jpg"></td>
									<td><img src="http://image.mrlotto.co.kr/class3.jpg"></td>
									<td><span>4등</span></td>
									<td><span>5등</span></td>
								</tr>
								<tr>
									<td style="height:10px"></td>
								</tr>
								<tr>
									<td><span><?=number_format($num1)?></span>회</td>
									<td><?=number_format($num2)?> 회</td>
									<td><?=number_format($num3)?> 회</td>
									<td><?=number_format($num4)?> 회</td>
									<td><span><?=number_format($num5)?></span>회</td>
								</tr>
							</table>
						</li>
					</ul>
					<ul>
						<li>
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr>
									<td>이용중인 상품</td>
									<td><span><?=$product?></span></td>
								</tr>
								<tr>
									<td>당첨 횟수</td>
									<td><span><?=number_format($total_nm)?></span> 회</td>
								</tr>
								<tr>
									<td>총 당첨금</td>
									<td><span><?=number_format($total_pr)?></span> 원</td>
								</tr>
							</table>
						</li>
					</ul>
				</div>
				<div class="mypage1_select">
				
					<select name="sb_seq" id="sb">
						<option value="">::전체회차::</option>
						<?
						for($i=($cur_seq+1);$i>=820;$i--){
						?>
						<option value="<?=$i?>" <? if($i==$sb_seqs){?>selected<?} ?>><?=$i?>회차</option>
						<?
						}
						?>
					</select>
				</div>
				<div class="mypage_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<col width="213px">
						<col width="665px">
						<col width="298px">
						<tr>
							<th>회차 [당첨발행일]</th>
							<th>번호 조합</th>
							<th>당첨 여부</th>
						</tr>
						<?
						if($total=="0"){
						?>
						<tr>
							<td colspan="3">조합 내역에 대한 데이터가 없습니다.</td>
						</tr>
						<?
						} else {
							foreach(array_slice($ms,$cur_pos,$set_page) as $rows => $key){
								
							?>
							<tr>
								<td><?=$key['seq']?>회 : <?=date("Y-m-d",strtotime($key['reg_datetime']))?> </td>
								<td>
									<? foreach(getBallField() as $field) { ?>
									<img src="http://<?=$img_url?>/ball/lotto_ball_<?=$key[$field]?>.jpg">
									<? } ?>
								</td>
								<td class="class1">
									<?
									if($key['seq'] <= $cur_seq){
										if($key['rank']>0){
											if($key['rank']>=4){
									?>
									<?=$key['rank']?>등 당첨

									<?
											} else {
									?>
									<img src="http://<?=$img_url?>/class<?=$key['rank']?>.jpg">
									<?
											}
									 
										} else { echo "미당첨";}
									} else {
									?>
									당첨발표 전
									<? } ?>
								</td>
							</tr>
							<?
							}
						}
						?>
						<!--
						<tr>
							<td>516회</td>
							<td>
								<img src="http://image.mrlotto.co.kr/ball/lotto_ball_3.jpg">
								<img src="http://image.mrlotto.co.kr/ball/lotto_ball_9.jpg">
								<img src="http://image.mrlotto.co.kr/ball/lotto_ball_12.jpg">
								<img src="http://image.mrlotto.co.kr/ball/lotto_ball_13.jpg">
								<img src="http://image.mrlotto.co.kr/ball/lotto_ball_25.jpg">
								<img src="http://image.mrlotto.co.kr/ball/lotto_ball_43.jpg">
								<img src="http://image.mrlotto.co.kr/main_lotto_plus.jpg">
								<img src="http://image.mrlotto.co.kr/ball/lotto_ball_34.jpg">
							</td>
							<td class="class1"><img src="http://image.mrlotto.co.kr/class1.jpg"></td>
						</tr>						
						--->
					</table>
					<div class="paging">
						<ul>
							<?=page_move_event($page, $set_page, $bbs_page_scale, $total, $search)?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->
<?
include(BASE_DIR.'inc/html/foot.html');

?>

