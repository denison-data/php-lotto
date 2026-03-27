<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');
include(BASE_DIR.'inc/html/head_m_member.html');
login_check_m();

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
		var aUrl = "<?=$mobile_dir?>/member/pay_process.php";
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
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/service_tit.jpg"></h2>
	<div class="sub_menu_button">
		<a href="./orders.php" class="on">결제 내역</a><a href="./norders.php">환불 내역</a>
	</div>
</div>

	<div class="contents2">
		<div class="service_board div_table">
			<ul>
				<li>결제일</li>
				<li>상품 명</li>
				<li>유효기간</li>
				<li>환불 신청</li>
			</ul>
			<?
			if($total=="0"){
			?>
			<ul style="position:relative;left:30%">조합 내역에 대한 데이터가 없습니다.</ul>
			<?
			} else {
				foreach(array_slice($ms,$cur_pos,$set_page) as $rows => $key){
					if($key['Start_Date']){
						/* 여기서 조건문 더 줄것*/
						$startday = date("y.m.d",strtotime($key['Start_Date'])). " 12:00 부터 적용";
					} else {
						$startday = "문자 서비스 시작 전";
					}

					$e_day = $key['Finish_Date'];
					$datetime1 = new DateTime($e_day); 
					$datetime2 = new DateTime($nday); 
					$interval = $datetime1->diff($datetime2); 
			?>
			<ul>
				<li><?=date("y.m.d",$key['Order_Date'])?></li>
				<li><?=$key['Good_name']?> <?=$key['Title1']?>
					<?
					if($key['g_grade']=="c"){ echo $key['Title2'];}
					?></li>
				<li><?=$interval->format('%a');?>일</li>
				<li>
					<?
					if($key['g_grade'] != "c"){
						if($key['Start_Date']>$nday){
							if($key['Order_State']=="y"){
							?>
							<a href="javascript:;" class="cp_use_bt blue_bt" onclick="javascript:cancel_order('<?=$key['Order_No']?>','n0')">환불 신청</a>
							<?
							} else if($key['Order_State']=="n0"){
							?>
							환불 진행
							<?
							} 
						}
					} else { echo "-"; }
					?>
				
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
include(BASE_DIR.'inc/html/foot_m.html');

?>