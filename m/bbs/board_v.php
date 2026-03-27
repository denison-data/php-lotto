<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');
$dep = $_GET['dep'];
$page = $_GET['page'];
$uid = $_GET['uid'];

$dbc = dbOpen();
$que_where = 'Where del_flag in (\'n\') And division in ("'.$dep.'") And uid in ("'.$uid.'")';

$que = "
SELECT * 
FROM bbs {$que_where}
";
$data=dbQuery($que, $dbc);
$row = mysql_fetch_assoc($data);
$dep = $_GET['dep'];

$ups_que = "
Update bbs set view_cnt= view_cnt+1
$que_where
";
dbQuery($ups_que, $dbc);


$contents = $row['content'];
strip_tags($contents,"<img><div><p><form><span><ul><li><input><textarea>");
$contents = stripslashes(trim($contents));
if($dep=="n"){
?>
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/notice_tit.jpg"></h2>
	<p>미스터로또씨는 여러분의 이야기에 귀 기울입니다.<br>공지사항을 확인해 주세요.</p>
</div>
<div class="contents2">
			
			<table cellpadding="0" cellspacing="0" border="0" class="notice_table_view nv">
				<colgroup>
					<col width="20%">
					<col width="80%">
				</colgroup>
				<tbody>
					<tr>
						<td>제목</td>
						<td><?=$row['title']?></td>
					</tr>
					<tr>
						<td colspan="2" style="border-right: none;font-size: 1em;padding:4%; font-weight: normal"><?=$contents?></td>
					</tr>
					<tr>
						<td>등록일</td>
						<td><?=date("y.m.d",$row['reg_datetime'])?></td>
					</tr>
					<tr>
						<td>조회수</td>
						<td><?=$row['view_cnt']?></td>
					</tr>
				</tbody>
			</table>
			<div class="small_bt2"><a href="javascript:;" onclick="location.href='<?=$mobile_dir?>/bbs/board.php?dep=<?=$dep?>&page=<?=$page?>'">목록으로</a></div>
			
	</div>

<? } else if($dep=="e") { ?>
<script type="text/javascript">

</script>
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/event_tit.jpg"></h2>
	<p>미스터로또씨 이벤트 게시판입니다.</p>
</div>
<div class="contents2">
			
			<table cellpadding="0" cellspacing="0" border="0" class="notice_table_view nv">
				<colgroup>
					<col width="20%">
					<col width="80%">
				</colgroup>
				<tbody>
					<tr>
						<td>제목</td>
						<td><?=$row['title']?></td>
					</tr>
					<tr>
						<td colspan="2" style="border-right: none;font-size: 1em;padding:4% 0; font-weight: normal"><?=$contents?></td>
					</tr>
					<tr>
						<td>기간</td>
						<td><?=$row['text01']?> ~ <?=$row['text02']?></td>
					</tr>
					<tr>
						<td>조회수</td>
						<td>1815</td>
					</tr>
				</tbody>
			</table>
			<div class="small_bt2"><a href="javascript:;" onclick="location.href='<?=$mobile_dir?>/bbs/board.php?dep=<?=$dep?>&page=<?=$page?>'" style="z-index:99999999999">목록으로</a></div>
			
	</div>

<?
}
include(BASE_DIR.'inc/html/foot_m.html');

?>