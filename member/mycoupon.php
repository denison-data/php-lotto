<?

include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
include(BASE_DIR.'inc/html/mypage.html');

login_check();

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
		var lgurl = "/member/pay_process.php";
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
					top.location.href="/member/mycoupon.php";
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
			
			<h1>쿠폰</h1>
			<div>
				<div class="coupon_tab">
					<a href="" class="on">내 쿠폰 보관함</a>
					<a href="./mycoupon2.php">쿠폰 등록</a>
				</div>
				<div class="mypage_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" id="coupon_list">
						<col width="80px">
						<col width="550px">
						<col width="211px">
						<col width="180px">
						<col width="155px">
						<tr>
							<th>No</th>
							<th>쿠폰 명</th>
							<th>유효기간</th>
							<th>사용한 날짜</th>
							<th>사용 여부</th>
						</tr>
						<?
						if($total==0){
						?>
						<tr>
							<td colspan="5" align="center">조회된 내용이 없습니다.</td>
						</tr>
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
						<tr>
							<td><?=$rec_num?></td>
							<td><?=$row['cp_subject']?></td>
							<td class="coupon_date"><?=$mdays?> </td>
							<td><?=$uday?></td>
							<td><?=$us?></td>
						</tr>
						<?
							}
						}
						?>
						<!--
						
						<tr>
							<td>11</td>
							<td>2018 미스터로또씨 오픈 기념 이벤트</td>
							<td>90일<span>(2018.08.02 13:30까지)</span></td>
							<td>18.08.02</td>
							<td><a href="">사용</a></td>
						</tr>
						<tr>
							<td>10</td>
							<td>월드컵 기념 이벤트 쿠폰</td>
							<td>90일<span>(2018.08.02 13:30까지)</span></td>
							<td>18.08.02</td>
							<td><a href="">사용</a></td>
						</tr>
						<tr>
							<td>9</td>
							<td>2018 새해 첫 기념 쿠폰</td>
							<td>90일<span>(2018.08.02 13:30까지)</span></td>
							<td>18.08.02</td>
							<td><a href="">사용</a></td>
						</tr>
						<tr class="coupon_end">
							<td>8</td>
							<td>미스터로또씨 리뉴얼 기념 이벤트</td>
							<td><span>2018.08.02 13:30까지</span></td>
							<td>18.08.02</td>
							<td><a href="">사용 완료</a></td>
						</tr>
						<tr>
							<td>7</td>
							<td>2018 미스터로또씨 오픈 기념 이벤트</td>
							<td>90일<span>(2018.08.02 13:30까지)</span></td>
							<td>18.08.02</td>
							<td><a href="">사용</a></td>
						</tr>
						<tr>
							<td>6</td>
							<td>월드컵 기념 이벤트 쿠폰</td>
							<td>90일<span>(2018.08.02 13:30까지)</span></td>
							<td>18.08.02</td>
							<td><a href="">사용</a></td>
						</tr>
						<tr>
							<td>5</td>
							<td>2018 새해 첫 기념 쿠폰</td>
							<td>90일<span>(2018.08.02 13:30까지)</span></td>
							<td>18.08.02</td>
							<td><a href="">사용</a></td>
						</tr>
						<tr>
							<td>4</td>
							<td>미스터로또씨 리뉴얼 기념 이벤트</td>
							<td>90일<span>(2018.08.02 13:30까지)</span></td>
							<td>18.08.02</td>
							<td><a href="">사용</a></td>
						</tr>
						<tr>
							<td>3</td>
							<td>2018 미스터로또씨 오픈 기념 이벤트</td>
							<td>90일<span>(2018.08.02 13:30까지)</span></td>
							<td>18.08.02</td>
							<td><a href="">사용</a></td>
						</tr>
						<tr>
							<td>2</td>
							<td>월드컵 기념 이벤트 쿠폰</td>
							<td>90일<span>(2018.08.02 13:30까지)</span></td>
							<td>18.08.02</td>
							<td><a href="">사용</a></td>
						</tr>
						<tr>
							<td>1</td>
							<td>2018 새해 첫 기념 쿠폰</td>
							<td>90일<span>(2018.08.02 13:30까지)</span></td>
							<td>18.08.02</td>
							<td><a href="">사용</a></td>
						</tr>--->
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