<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');
include(BASE_DIR.'inc/html/head_m_member.html');
login_check_m();
$code = $_SESSION['code'];
$ms = nordrGoods($code);

$total = count($ms);

$set_page = $_GET[set_page] ? $_GET[set_page] : 15;
$bbs_page_scale = 5;
	
$page = $_GET[page] ? $_GET[page] : 1;

if ($total <= 0) $pages=1;
else	$pages = ceil( $total / $set_page ) ;

//페이지 계산 후 나머지 목록
$cur_pos = $set_page * $page - $set_page;

//시작되는 번호 초기화
$start_num  = $total - ( $page * $set_page ) + $set_page;

?>
	
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/service_tit.jpg"></h2>
	<div class="sub_menu_button">
		<a href="./orders.php" >결제 내역</a><a href="./norders.php" class="on">환불 내역</a>
	</div>
</div>
	<div class="contents2">
		<div class="edit service_board div_table">
			<ul>
				<li>접수일</li>
				<li>상품 명</li>
				<li>환불 금액</li>
				<li>처리 상태</li>
			</ul>
			<?
			if($total=="0"){
			?>
			<ul>조회된 데이터가 없습니다.</ul>
			<?
			} else {
				foreach(array_slice($ms,$cur_pos,$set_page) as $rows => $key){
					switch($key['Order_State']) {
						case "n":	$vi = "환불완료";	break;
						case "n0":	$vi = "환불요청";	break;

					}


			?>
			<ul>
				<li><?=date("y.m.d",$key['Order_Date'])?></li>
				<li><?=$key['Good_name']?> <?=$key['Title1']?></li>
				<li><?=number_format($key['total_price'])?></li>
				<li><?=$vi?></li>
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
include(BASE_DIR.'inc/html/foot_m.html');

?>