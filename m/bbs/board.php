<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');
$dep = $_GET['dep'];
$dbc = dbOpen();
$skword = $_GET['skword'];
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
<form method="get" id="form1">
<input type="hidden" name="dep" value="<?=$dep?>">
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/notice_tit.jpg"></h2>
	<p>미스터로또씨는 여러분의 이야기에 귀 기울입니다.<br>공지사항을 확인해 주세요.</p>
</div>
<div class="contents2 notice_search">
	<div><p class="notice_search1"><input type="text" class="search_inp" name="skword" value="<?=$skword?>" id="skword"><a href="javascript:;" class="blue_bt search_bt3" id="search">검색</a></p></div>
</div>
</form>
<div class="contents">
		<div class="div_table">
			<ul>
				<li>번호</li>
				<li>글제목</li>
				<li>조회수</li>
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
			?>
			<ul>
				<li><?=$rec_num?></li>
				<li><p class="word2"><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=<?=$dep?>&page=<?=$page?>&uid=<?=$row['uid']?>"><?=$row['title']?></a></p></li>
				<li><?=$row['view_cnt']?></li>
			</ul>
			<?
					$ind++;
				}
			}
			?>
			<div class="paging">
				<?=page_move_event_m($page, $set_page, $bbs_page_scale, $total, $search)?>
			</div>
		</div>
	</div>

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
<form method="get" id="form1">
<input type="hidden" name="dep" value="<?=$dep?>">
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/event_tit.jpg"></h2>
	<p>미스터로또씨 이벤트 게시판입니다.</p>
</div>
<div class="contents2 notice_search">
	<div><p class="notice_search1"><input type="text" class="search_inp" name="skword" value="<?=$skword?>" id="skword"><a href="javascript:;" class="blue_bt search_bt3" id="search">검색</a></p></div>
</div>
</form>


<div class="contents">
		<div class="event_board div_table">
			<ul>
				<li>이벤트</li>
				<li>기간</li>
			</ul>
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
					$sday = str_replace("/","",$row['text01']);
					$eday = str_replace("/","",$row['text02']);
			?>
			<ul>
				<?
				if($sday > $nday || $eday < $nday){
				?>
				<li class="event_thum"><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=<?=$dep?>&page=<?=$page?>&uid=<?=$row['uid']?>"><img src="<?=$row['file01']?>"><div class="event_end">이벤트 종료</div></a></li>
				<li><?=$row['text01']?> ~ <?=$row['text02']?></li>
				<?
				} else {
				?>
				<li class="event_thum"><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=<?=$dep?>&page=<?=$page?>&uid=<?=$row['uid']?>"><img src="<?=$row['file01']?>"></a></li>
				<li><?=$row['text01']?> ~ <?=$row['text02']?></li>
				<?
				}
				?>
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
}
include(BASE_DIR.'inc/html/foot_m.html');

?>