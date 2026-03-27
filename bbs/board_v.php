<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');

include(BASE_DIR.'inc/html/sub_side.html');

$dep = $_GET['dep'];
$page = $_GET['page'];
$uid = $_GET['uid'];

$dbc = dbOpen();


$que_where = 'Where del_flag in (\'n\') And division in ("'.$dep.'") And uid in ("'.$uid.'")';
$ups_que = "
Update bbs set view_cnt= view_cnt+1
$que_where
";
dbQuery($ups_que, $dbc);

$que = "
SELECT * 
FROM bbs {$que_where}
";
$data=dbQuery($que, $dbc);
$row = mysqli_fetch_assoc($data);
$dep = $_GET['dep'];

$contents = $row['content'];
strip_tags($contents,"<img><div><p><form><span><ul><li><input><textarea>");
$contents = stripslashes(trim($contents));
if(!$row){
	echo "페이지를 찾을수 없습니다.";
	exit;
}
if($dep=="n"){
?>
	<h1>공지사항</h1>
			<div>
				<div class="notice_title">미스터 로또씨는 여러분의 이야기에 귀 기울입니다. 공지사항을 확인해 주세요.</div>
				<div class="notice_write_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<col width="200px">
						<col width="163px">
						<col width="200px">
						<col width="613px">
						<tr>
							<th>글 제목</th>
							<td colspan="3"><?=$row['title']?></td>
						</tr>
						<tr>
							<th>내용</th>
							<td colspan="3"><?=$contents?>
							</td>
						</tr>
						<tr>
							<th>등록일</th>
							<td style="letter-spacing: 0"><?=date("y.m.d",$row['reg_datetime'])?></td>
							<th style="border:1px solid #d9d9d9;border-top:none">조회수</th>
							<td style="letter-spacing: 0;padding-left:20px;text-align: left"><?=$row['view_cnt']?></td>
						</tr>
					</table>
					<div class="notice_button"><!--button button class="board_button">글쓰기</button--><button button class="board_cancel_button" onclick="location.href='/bbs/board.php?dep=<?=$dep?>&page=<?=$page?>'">목록으로</button></div>
				</div>
			</div>
		</div>
		
		<!--sub contents end-->
	</div>
	<!--sub title end-->
<? } else if($dep=="e") { ?>
			<h1>이벤트</h1>
			<div>
				<div class="event_title">미스터 로또씨 이벤트 게시판 입니다.</div>
				<div class="notice_write_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<col width="200px">
						<col width="976px">
						<tr>
							<th>글 제목</th>
							<td><?=$row['title']?></td>
						</tr>
						<tr>
							<th>내용</th>
							<td style="position: relative;"> <?=$contents?></td>
						</tr>
						<?
						if($row['file01']){
						?>
						<!--<tr>
							<th>파일첨부</th>
							<td><a href="<?=$row['file01']?>" target="_new">파일첨부</a></td>
						</tr>--->
						<?
						}
						?>
						<tr>
							<th>기한</th>
							<td><?=$row['text01']?> ~ <?=$row['text02']?></td>
						</tr>
					</table>
					<div class="notice_button"><!--button button class="board_button">글쓰기</button--><button button class="board_cancel_button" onclick="location.href='/bbs/board.php?dep=<?=$dep?>&page=<?=$page?>'">목록으로</button></div>
				</div>
			</div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->

<? } ?>
<?
include(BASE_DIR.'inc/html/foot.html');

?>
