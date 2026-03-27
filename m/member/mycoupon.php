<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');
include(BASE_DIR.'inc/html/head_m_member.html');
login_check_m();

$nday = date("Ymd");
$dbc = dbOpen();
$mcode = $_SESSION['code'];
$que = "
Select * from 
v_coupon_list
Where 1=1 And  mem_code in ('$mcode')
";

$data=dbQuery($que, $dbc);
$total = mysqli_num_rows();

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
<script type="text/javascript">
function use_ok(cou_code){
	if(confirm("사용하시겠습니까??.")){
		var mcode = "<?=$_SESSION['code']?>";
		var lgurl = "<?=$mobile_dir?>/member/pay_process.php";
		var form_data = {
			ccode: cou_code,
			mcode: mcode,
			mode : "coupon_ups"
		};
		$.ajax({
			type	:	"POST",
			url		:	lgurl,
			data : form_data,
			async: false,
			dataType : "json",
			cache: false,
			success : function(data){
				
				if(data['status']=="0"){
					alert("등록되었습니다");
					top.location.href="<?=$mobile_dir?>/member/mycoupon.php";
					return false;
				}
			},
			error: function(request, status, error) {
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);

			}
		});
		console.log(mcode);
	} else {
		return;
	}
}
</script>
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/coupon_tit.jpg"></h2>
	<div class="sub_menu_button">
		<a href="./mycoupon.php" class="on">내 쿠폰 보관함</a><a href="./mycoupon2.php">쿠폰 등록</a>
	</div>
</div>

	<div class="contents2">
		<div class="coupon_board div_table">
			<ul>
				<li>쿠폰 명</li>
				<li>유효기간</li>
				<li>사용 여부</li>
			</ul>
			<?
			if($total==0){
			?>
			<ul style="position:relative;left:0%"><font style="left:30%">조회된 데이터가 없습니다.</font></ul>
			
			<?
			} else {
				if(!$start) $start=0;
							
				$ind = 0;
				mysqli_data_seek( $data , $cur_pos );
				for($i=1;($i<$set_page+1) && $row = mysqli_fetch_array($data); $i++) {
					$rec_num = $start_num - $ind;
					if($nday>$row['cp_end']){
						$mdays = "기간만료";
					} else {
						$mdays = ($row['cp_end']-$nday)." 일 남음";
					}
					if($row["use_datetime"]){
						$uday = date("y.m.d",strtotime($row['use_datetime']));
					} else {
						$uday = "";
					}
					if($row['cpl_using']=="y"){
						$us = '<a href="javascript:;" onclick="javascript:use_ok(\''.$row['cpl_code'].'\')">미사용</a>';
					} else if($row['cpl_using']=="n"){
						$us = '<a href="javascript:;">미사용</a>';
					} else {
						$us = "사용완료";
					}
			?>
			<ul>
				<li><p class="word2"><?=$row['cp_subject']?></p></li>
				<li><?=$mdays?></li>
				<li><?=$us?></li>
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

