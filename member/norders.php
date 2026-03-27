<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
include(BASE_DIR.'inc/html/mypage.html');

login_check();

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
			<h1>서비스 설정</h1>
			<div>
				<div class="mypage_tab">
					<a href="./orders.php">결제 내역</a>
					<a href="./norders.php" class="on">환불 내역</a>
				</div>
				<div class="mypage_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" id="service_list2">
						<col width="180px">
						<col width="520px">
						<col width="241px">
						<col width="235px">
						<tr>
							<th>접수일</th>
							<th>상품 명</th>
							<th>환불 금액</th>
							<th>처리 상태</th>
						</tr>
						<?
						if($total=="0"){
						?>
						<tr>
							<td colspan="4">데이터가 없습니다.</td>
						</tr>
						<?
						} else {
							
							foreach(array_slice($ms,$cur_pos,$set_page) as $rows => $key){
								//echo "준비해야함";
								/*
								if($key['Start_Date']){
									
									$startday = $key['Order_State'];
								} else {
									$startday = "문자 서비스 시작 전";
								}
								*/
								switch($key['Order_State']) {
									case "n":	$vi = "환불완료";	break;
									case "n0":	$vi = "환불요청";	break;

								}

						?>
						<tr>
							<td><?=date("y.m.d H:i",$key['Order_Date'])?></td>
							<td><?=$key['Good_name']?> <?=$key['Title1']?></td>
							<td><?=number_format($key['total_price'])?></td>
							<td><span><?=$vi?></span></td>
						</tr>
						<?
							}
						}
						?>
						
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