<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
include(BASE_DIR.'inc/html/mypage.html');

login_check();

$code = $_SESSION['code'];
$ms = ordrGoods($code);

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

$nday = date("Ymd");

?>
<script type="text/javascript">
function cancel_order(ono){
	if(confirm('정말 환불 신청하시겠습니까 ? 환불 금액은 영업일 기준 14일 이내에 환불됩니다.')){
		var aUrl = "/member/pay_process.php";
		var form_data = {
			mcode : '<?=$_SESSION[code]?>',
			ono: ono,
			sty : "n0",
			mode : "pay_cancel"
		};
		$.ajax({
			type	:	"POST",
			url		:	aUrl,
			data : form_data,
			dataType : "json",
			async: false,
			cache: false,
			success : function(data){
				
				if(data['status']=="0"){
					alert('환불이 신청 되었습니다.');
					$("#v_"+data['OrdNo']).html("환불 진행");
				} else {
					alert('결제 실패되었습니다.');
				}
				
			},
			error: function(request, status, error) {
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}
	return false;
}
</script>
			<h1>서비스 설정</h1>
			<div>
				<div class="mypage_tab">
					<a href="./orders.php" class="on">결제 내역</a>
					<a href="./norders.php">환불 내역</a>
				</div>
				<div class="mypage_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" id="service_list">
						<col width="180px">
						<col width="390px">
						<col width="241px">
						<col width="235px">
						<col width="130px">
						<tr>
							<th>결제일</th>
							<th>상품 명</th>
							<th>결제 금액</th>
							<th>남은 기한</th>
							<th>환불</th>
						</tr>
						<?
						if($total=="0"){
						?>
						<tr>
							<td colspan="5">결제된 내역에 대한 데이터가 없습니다.</td>
						</tr>
						<?
						} else {
							
							foreach(array_slice($ms,$cur_pos,$set_page) as $rows => $key){
								//echo "준비해야함";
								
								if($key['Start_Date']){
									/* 여기서 조건문 더 줄것*/
									$startday = date("y.m.d",strtotime($key['Start_Date'])). " 12:00 부터 적용";
								} else {
									$startday = "문자 서비스 시작 전";
								}

						?>
						<tr>
							<td><?=date("y.m.d H:i",$key['Order_Date'])?></td>
							<td><?=$key['Good_name']?> <?=$key['Title1']?>
								<?
								if($key['g_grade']=="c"){ echo $key['Title2'];}
								?>
							</td>
							<td><?=number_format($key['total_price'])?></td>
							<td><span><?=$startday?></span></td>
							<td id="v_<?=$key['Order_No']?>">
							<!--onclick="alert('정말 환불 신청하시겠습니까 ? 환불 금액은 영업일 기준 14일 이내에 환불됩니다.')"--->
								<?
								if($key['g_grade'] != "c"){
									if($key['Start_Date']>$nday){
										if($key['Order_State']=="y"){
										?>
										<a href="javascript:;" onclick="javascript:cancel_order('<?=$key['Order_No']?>','n0')">환불 신청</a>
										<?
										} else if($key['Order_State']=="n0"){
										?>
										환불 진행
										<?
										} 
									}
								} else { echo "-"; }
								?>
							</td>
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