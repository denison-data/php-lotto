<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
//include(BASE_DIR.'inc/html/board_css.html');
include(BASE_DIR.'inc/html/sub_side.html');
echo BASE_DIR;
$dep = $_GET['dep'];
$dbc = dbOpen();
@$skword = $_GET['skword'];
$que_where = 'Where del_flag in (\'n\') And division in ("'.$dep.'") And live_on in ("y")';
if($skword){
	$que_where .= " And title like '%$skword%'";
}

$que = "
SELECT * 
FROM bbs {$que_where}
ORDER BY reg_datetime desc
";

$data=dbQuery($que, $dbc);
$total = mysqli_num_rows();


$search = "&dep=$dep";
$nday = date("Ymd");
if($dep=="n"){
	$set_page = $_GET['set_page'] ? $_GET['set_page'] : 12;
	$bbs_page_scale = 5;
		
	$page = $_GET['page'] ? $_GET['page'] : 1;

	if ($total <= 0) $pages=1;
	else	$pages = ceil( $total / $set_page ) ;

	//페이지 계산 후 나머지 목록
	$cur_pos = $set_page * $page - $set_page;

	//시작되는 번호 초기화
	$start_num  = $total - ( $page * $set_page ) + $set_page;
	

?>
<script type="text/javascript">
$(document).ready(function(){
	$("#search").on("click",function(){
		var kwd  = $("#skword").val();
		if(kwd.length==0){
			alert('검색할 문자를 입력해주세요');
			$("#skword").focus();
			return false;
		}
		$("#form1").submit();
	});
});
</script>

		
		<h1>공지사항</h1>
		<div>
			<div class="notice_title">미스터 로또씨는 여러분의 이야기에 귀 기울입니다. 공지사항을 확인해 주세요.</div>
			<div class="notice_table">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<col width="80px">
					<col width="676px">
					<col width="165px">
					<col width="130px">
					<col width="125px">
					<tr>
						<th>No</th>
						<th>글제목</th>
						<th>글쓴이</th>
						<th>날짜</th>
						<th>조회수</th>
					</tr>
					<?
					if($total==0){
					?>
					<tr>
						<td colspan="5" align="center">조회된 내용이 없습니다.</td>
					</tr>
					<?
					} else {
						$start="";
						if(!$start) $start=0;
						
						$ind = 0;
						mysqli_data_seek( $data , $cur_pos );
						for($i=1;($i<$set_page+1) && $row = mysqli_fetch_array($data); $i++) {
							
							$rec_num = $start_num - $ind;
					?>
					<tr>
						<td><?=$rec_num?></td>
						<td><a href="/bbs/board_v.php?dep=<?=$dep?>&page=<?=$page?>&uid=<?=$row['uid']?>"><?=$row['title']?><span><? if($i<='3'){?><img src="http://image.mrlotto.co.kr/new.jpg"><?}?></span></a></td>
						<td>미스터로또씨</td>
						<td><?=date("y.m.d",$row['reg_datetime'])?></td>
						<td><?=$row['view_cnt']?></td>
					</tr>

					<?
							$ind++;
						}
					}
					?>
				</table>
				<form method="get" id="form1">
				<input type="hidden" name="dep" value="<?=$dep?>">
				<div class="notice_button"><input type="text" name="skword" value="<?=$skword?>" id="skword"><button class="search" id="search">검색</button></div>
				</form>
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
} else if($dep=="e"){
	$set_page = $_GET[set_page] ? $_GET[set_page] : 12;
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
$(document).ready(function(){
	$("#search").on("click",function(){
		var kwd  = $("#skword").val();
		if(kwd.length==0){
			alert('검색할 문자를 입력해주세요');
			$("#skword").focus();
			return false;
		}
		$("#form1").submit();
	});
});
</script>
			<h1>이벤트</h1>
			<div>
				<div class="event_title">미스터 로또씨 이벤트 게시판 입니다.</div>
				<div class="event_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<col width="520px">
						<col width="656px">
						<tr>
							<th>이벤트</th>
							<th>내용</th>
						</tr>
						<?
						if($total==0){
						?>
						<tr>
							<td colspan="2" align="center">조회된 내용이 없습니다.</td>
						</tr>
						<?
						} else {
							if(!$start) $start=0;
						
							$ind = 0;
							mysqli_data_seek( $data , $cur_pos );
							for($i=1;($i<$set_page+1) && $row = mysqli_fetch_array($data); $i++) {
								$content = $row['content'];
								
								$content = trim(strip_tags($content));
								//strip_tags(nl2br($content),"<img><div><p><form><span><ul><li><input><textarea>");
								/*
								$content=str_replace("<p>","",$content); 
								$content=str_replace("</p>","",$content); 
								*/
								$sday = str_replace("/","",$row['text01']);
								$eday = str_replace("/","",$row['text02']);
						//echo $sday."||".$nday."||".$eday."<br>";
						?>
						<tr>
							<?
							if($sday > $nday || $eday < $nday){
							?>
							<td><a href="/bbs/board_v.php?dep=<?=$dep?>&page=<?=$page?>&uid=<?=$row['uid']?>"><img src="<?=$row['file01']?>" style="width:450px;height:200px"></a><div class="event_end"><span>이벤트 종료</span></div></td>
							<?
							} else {
							?>
							<td><a href="/bbs/board_v.php?dep=<?=$dep?>&page=<?=$page?>&uid=<?=$row['uid']?>"><img src="<?=$row['file01']?>" style="width:450px;height:200px"></a></td>
							<?
							}
							?>
							<td>
								<div class="event_txt" onclick="javascript:top.location.href='/bbs/board_v.php?dep=<?=$dep?>&page=<?=$page?>&uid=<?=$row['uid']?>'">
									<h3><?=$row['title']?></h3>
									<!--<p><?=$content?></p>--->
									<span class="event_date"><?=$row['text01']?> ~ <?=$row['text02']?></span>
								</div>
							</td>
						</tr>
						<?
							}
						}
						?>
					</table>
					<form method="get" id="form1">
					<input type="hidden" name="dep" value="<?=$dep?>">
					<div class="event_button"><input type="text" name="skword" value="<?=$skword?>" id="skword"><button class="search" id="search">검색</button><!--button class="board_button" onclick="location.href='/design/event_write.php'">글쓰기</button--></div>
					</form>
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
}
include(BASE_DIR.'inc/html/foot.html');

?>

