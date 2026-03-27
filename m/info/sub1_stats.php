<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');
include(BASE_DIR.'inc/html/head_m_report.html');
$dbc = dbOpen();

$sub = $_GET['sub'];
if($sub=="2"){
	$arrField = getBallField();
	if($_POST[bn]=="n"){ $bn="";} else {$bn = "y";}
	if($bn == 'y') {
		$arrField[] = 'bonus';
	}
	$arrBall = array();

	for($i = 1; $i<=45; $i++) {
		$arrBall[$i] = 0;
	}
	$total_count = 0;

	foreach(getSeqBalls($_POST[sseq], $_POST[eseq]) as $row){
		foreach($arrField as $field){
			$arrBall[$row[$field]]++;
			$total_count++;
		}
	}
	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#ods").on("click",function(){		
		$("#form1 #orders").val("y");
		$("#form1").submit();
	});
	$("#nms").on("click",function(){		
		$("#form1 #orders").val("n");
		$("#form1").submit();
	});
	$("#rsearch").on("click",function(){
		if($("#nms").is(".on")==true){
			$("#dform1 #orders").val("n");
			console.log("n");
		}
		if($("#ods").is(".on")==true){
			$("#dform1 #orders").val("y");
			console.log("y");
		}

		
		$("#dform1").submit();
	});

});
</script>
<form method="post" name="form1" id="form1">
<input type="hidden" name="orders" id="orders">
</form>

<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/sub2_1_tit.jpg"></h2>
	<div class="sub_menu_button">
		<a href="javascript:;" id="nms" <? if($_POST['orders']!="y"){?> class="on" <? } ?>>번호 순</a><a href="javascript:;" id="ods" <? if($_POST['orders']=="y"){?> class="on" <? } ?>>당첨횟수 순</a>
	</div>
</div>
<form method="post" id="dform1" name="dform1">
<input type="hidden" name="orders" id="orders">
<div class="sub_search_bg">
	<div class="contents">
		<span class="sub_search_tit1">보너스 번호</span><span class="sub_search1"><input type="radio" id="search_radio1" name="bn"  value="y"<? if($_POST['bn']=="y" || $_POST['bn']==""){?>checked<? } ?> ><label for="search_radio1">&nbsp;포함</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="search_radio2" name="bn" <? if($_POST['bn']=="n"){?>checked<? } ?> value="n"><label for="search_radio2" >&nbsp;미포함</label></span>
		<span class="sub_search_tit1">회차선택</span>
		<span class="sub_search1">
			<select name="sseq" id="sseq">
			<?
			foreach(getSeqRank($_GET[sseq], $_GET[eseq], 'asc') as $arr) {
			?>
				<option value="<?=$arr['seq']?>" <? if($_POST[sseq]==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
			<?
			}
			?>
			</select>
			<label>부터</label>&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="eseq" id="eseq">
			<?
			foreach(getSeqRank($_GET[sseq], $_GET[eseq]) as $arr) {
			?>
				<option value="<?=$arr['seq']?>" <? if($_POST[eseq]==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
			<?
			}
			?>
			</select>
			<label>까지</label>
		</span>
		<div><a href="javascript:;" id="rsearch" class="blue_bt search_bt">조회하기</a></div>
	</div>
</div>
</form>
	<div class="contents2">
		<table cellpadding="0" cellspacing="0" border="0" class="table">
			<colgroup>
				<col width="20%">
				<col width="60%">
				<col width="20%">
			</colgroup>
			<tbody>
				<tr>
					<td>번호</td>
					<td>그래프</td>
					<td>당첨횟수</td>
				</tr>
				<?
				if($_POST[orders]=='y'){
					arsort($arrBall);
				}
				$rank = 1;
				foreach($arrBall as $ball => $cnt) { 
					$precent = round(($cnt/$total_count)*100,1);
					$flo = ceil($ball/10);
					$flo = $flo-1;
					if($flo==0){
						$flo = "";
					} else {
						$flo = $flo;
					}
					$max_int_v = max($arrBall);
					$precents = round(($cnt/$max_int_v)*100,1);
				
				?>
				<tr>
					<td><img src="http://<?=$img_url?>/mobile/ball_<?=$ball?>.png"></td>
					<td><div class="ball<?=$flo?>1_color" style="width:<?=$precents?>%">&nbsp;</div></td>
					<td><?=$arrBall[$ball]?></td>
				</tr>
				<?
				}
				?>
			</tbody>
		</table>
		
		<div class="paging">
			
		</div>
		
		<div class="comment">* 로또 645의 당첨번호는 나눔로또 공식홈페이지(www.nlotto.co.kr), ARS 전화 등을 통해 확인하실 수 있습니다.</div>
	</div>
<?
} else if($sub=="3"){
	$start_seq = $_POST['sseq'];
	
	$end_seq = $_POST['eseq'];
	if(!$start_seq ) { $start_seq = $_GET['sseq'];}
	if(!$end_seq ) { $end_seq = $_GET['eseq'];}
	if($start_seq && $end_seq){
		if($start_seq > $end_seq){
			$start_seq = $end_seq;
		}

		$que_where = "WHERE seq BETWEEN '{$start_seq}' AND '{$end_seq}'";
	}
	$que = "SELECT * FROM lotto_winning {$que_where} ORDER BY seq desc";

	
	$data	=	dbQuery($que, $dbc);
	$total = mysqli_num_rows();

	$search = "&sub=$sub&sseq=$start_seq&eseq=$end_seq";	

	$set_page = $_GET[set_page] ? $_GET[set_page] : 5;
	$bbs_page_scale = 5;
		
	$page = $_GET[page] ? $_GET[page] : 1;

	if ($total <= 0) $pages=1;
	else	$pages = ceil( $total / $set_page ) ;

	//페이지 계산 후 나머지 목록
	$cur_pos = $set_page * $page - $set_page;

	//시작되는 번호 초기화
	$start_num  = $total - ( $page * $set_page ) + $set_page;

?>
<script type="text/javascript" src="//<?=$js_url?>/admin/zingchart.min.js"></script>
<script type="text/javascript" src="http://<?=$js_url?>/mobile/grape.js?dev=<?=date("YmdHis")?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#rsearch").on("click",function(){
		/* 회차순 스크립트 중단*/
		$("#form1").submit();
	});
	$("#views1").on("click",function(){
		$("#views").val("5");
		$("#form1").submit();
	});
	
	dataAjax();
	$("#grape-license-text").css({"display":"none"});
	$("#grape-license-text").hide();
});

</script>
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/sub2_2_tit.jpg"></h2>
</div>
<div class="sub_search_bg">
	<div class="contents">
		<form method="post" name="form1" id="form1">
		<span class="sub_search_tit1">회차선택</span>
		<span class="sub_search1">
			<select name="sseq" id="sseq">
			<?
			foreach(getSeqRank($_GET[sseq], $_POST[eseq], 'asc') as $arr) {
			?>
				<option value="<?=$arr['seq']?>" <? if($start_seq==$arr['seq']){?> selected<? } ?>><?=$arr['seq']?></option>
			<?
			}
			?>
			</select>
			<label>부터</label>&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="eseq" id="eseq">
			<?
			foreach(getSeqRank($_POST[sseq], $_POST[eseq]) as $arr) {
			?>
				<option value="<?=$arr['seq']?>" <? if($end_seq==$arr['seq']){?> selected<? } ?>><?=$arr['seq']?></option>
			<?
			}
			?>
			</select>
			<label>까지</label>
		</span>
		<div><a href="javascript:;" id="rsearch" class="blue_bt search_bt">조회하기</a></div>
		</form>
	</div>
</div>
<div class="contents" style="border:1px solid #d8d8d8; margin-bottom:4%;text-align: center"  id="grape">
</div>
<div class="contents2">
	<table cellpadding="0" cellspacing="0" border="0" class="table t2 tp">
		<colgroup>
			<col width="20%">
			<col width="60%">
			<col width="20%">
		</colgroup>
		<tbody>
			<tr>
				<td>회차</td>
				<td>당첨번호</td>
				<td>보너스</td>
			</tr>
			<? 
			if(!$start) $start=0;
			$ind = 0;
			@mysqli_data_seek( $data , $cur_pos );
			for($i=1;($i<$set_page+1) && $arr = mysqli_fetch_array($data); $i++) {
				
				$sum = 0;
				$odd = 0;
				$highlow = 0;
			?>
			<tr>
				<td><?=$arr[seq]?>회</td>
				<td class="table_lotto_ball">
					<?
					foreach(getBallField() as $field) { 
					?>
					<img src="http://<?=$img_url?>/mobile/ball_<?=$arr[$field]?>.png">
					<?
					}
					?>
				</td>
				<td class="table_lotto_ball"><img src="http://<?=$img_url?>/mobile/ball_<?=$arr['bonus']?>.png"></td>
			</tr>
			<?
			}
			?>
		</tbody>
	</table>
	
	<div class="paging">
		<?=page_move_event_m($page, $set_page, $bbs_page_scale, $total, $search)?>
	</div>


	<div class="comment">* 로또 645의 당첨번호는 나눔로또 공식홈페이지(www.nlotto.co.kr), ARS 전화 등을 통해 확인하실 수 있습니다.</div>
</div>

<?
}  else if($sub=="4"){
	if(!$_POST[views] || $_POST[views]=="5"){
		$fArray = array(
		"1"=>"1(1~10)번대",
		"11"=>"10(11~20)번대",
		"21"=>"20(21~30)번대",
		"31"=>"30(31~40)번대",
		"41"=>"40(41~45)번대"
		);	
	} else {
		$fArray = array(
		"1"=>"1(1~5)번대",
		"6"=>"6(6~10)번대",
		"11"=>"11(11~15)번대",
		"16"=>"20(16~20)번대",
		"21"=>"25(21~25)번대",
		"26"=>"30(26~30)번대",
		"31"=>"40(31~35)번대",
		"36"=>"36(36~40)번대",
		"41"=>"41(41~45)번대"
		);	
	}
	
	$s_seq = getCurSeq();

	$e_wks = $_POST['wks'];
	if($e_wks){
		if($start_seq > $end_seq){
			$start_seq = $end_seq;
		}
		$e_wk = getCurSeq()-($e_wks-1);
		$que_where = "WHERE seq BETWEEN '{$e_wk}' AND '{$s_seq}'";
	} else {
		
		$e_seq = getCurSeq()-4;

		$que_where = "Where seq Between '$e_seq' And '$s_seq' ";
	}
	$que = "SELECT * FROM lotto_winning {$que_where} ORDER BY seq asc";
	
	$data	=	dbQuery($que, $dbc);
	$total = mysqli_num_rows();
	while ( $row = mysqli_fetch_array($data))
	{
		$ball[]= (int)$row['b1'];
		$ball[]= (int)$row['b2'];
		$ball[]= (int)$row['b3'];
		$ball[]= (int)$row['b4'];
		$ball[]= (int)$row['b5'];
		$ball[]= (int)$row['b6'];
		$ball[]= (int)$row['bonus'];

	}
	$ball_data = array_count_values($ball);
	foreach($fArray as $key=>$val){
		
		if($key==41){
			$limit = $key+4;
		} else {
			if($_POST[views]=="5" || !$_POST[views]){
				$limit = ($key+9);
			} else {
				$limit = ($key+4);
			}
		}
		$nums[$key] = 0;
		for($i=$key;$i<=$limit;$i++){
			
			if($ball_data[$i]!=0){
				$nums[$key] += $ball_data[$i];
				
			}
			$max_num = max($nums);
		}
	}
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#rsearch").on("click",function(){
		$("#views").val('<?=$_POST[views]?>');
		$("#form1").submit();
	});
	$("#views1").on("click",function(){
		$("#views").val("5");
		$("#form1").submit();
	});

	$("#views2").on("click",function(){
		$("#views").val("10");
		$("#form1").submit();
	});
});
</script>	
<form method="post" name="form1" id="form1">
<input type="hidden" name="views" id="views">
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/sub2_3_tit.jpg"></h2>
	<div class="sub_menu_button">
		<a href="javascript:;" id="views1" <? if($_POST['views']=="5" || !$_POST['views']){?>class="on" <? } ?>>10번대</a><a href="javascript:;" id="views2" <? if($_POST['views']=="10"){?>class="on" <? } ?>>5번대</a>
	</div>
</div>

<div class="sub_search_bg">
	<div class="contents">
		<span class="sub_search_tit1 short">기간</span>
		<span class="sub_search1 long one_line">
			<select name="wks">
				<option value="5" <? if($_POST[wks]=="5" || $_POST[wks]==""){?>selected<?}?>>최근 5주간</option>
				<option value="10" <? if($_POST[wks]=="10"){?>selected<?}?>>최근 10주간</option>
				<option value="15" <? if($_POST[wks]=="15"){?>selected<?}?>>최근 15주간</option>
			</select>
		</span>
		<a href="javascript:;" id="rsearch" class="blue_bt search_bt2">조회하기</a>
	</div>
</div>
</form>
	<div class="contents2" id="st_01">
		<table cellpadding="0" cellspacing="0" border="0" class="table tp">
			<colgroup>
				<col width="30%">
				<col width="55%">
				<col width="15%">
			</colgroup>
			<tbody>
				<tr>
					<td>번호대</td>
					<td>그래프</td>
					<td>당첨횟수</td>
				</tr>
				<?
				//echo sizeof($ball)."<br>";
				foreach($fArray as $key=>$val){
					if($key=="1"){
						$k = 1;
					} else {
						if($_POST[views]=="5" || !$_POST[views]){
							$k =(($key-1)/10)+1;
						}else {
							$k =ceil($key/10);
						}
						
					}
					$k=  $k-1;
					if($k==0){$k="";}
					$percent = round(($nums[$key]/$max_num)*100,1);
				//	$precents = round(($cnt/$max_int_v)*100,1);
				?>
				<tr>
					<td><?=$val?></td>
					<td><div class="ball<?=$k?>1_color" style="width:<?=$percent?>%">&nbsp;</div></td>
					<td><?=$nums[$key]?></td>
				</tr>
				<?
					
				}
				?>	
			</tbody>
		</table>
		
		<div class="comment">* 로또 645의 당첨번호는 나눔로또 공식홈페이지(www.nlotto.co.kr), ARS 전화 등을 통해 확인하실 수 있습니다.</div>
	</div>

<?
} else if($sub=="5"){
	$fArray = array(
	"1"=>"1 ~ 10번대",
	"11"=>"11 ~ 20번대",
	"21"=>"21 ~ 30번대",
	"31"=>"31 ~ 40번대",
	"41"=>"41 ~ 45번대"
	);
	$s_seq = getCurSeq();

	$e_wks = $_POST['wks'];
	if($e_wks){
		if($start_seq > $end_seq){
			$start_seq = $end_seq;
		}
		$e_wk = getCurSeq()-$e_wks;
		$que_where = "WHERE seq BETWEEN '{$e_wk}' AND '{$s_seq}'";
	} else {
		
		$e_seq = getCurSeq()-4;

		$que_where = "Where seq Between '$e_seq' And '$s_seq' ";
	}
	$que = "SELECT * FROM lotto_winning {$que_where} ORDER BY seq asc";
	
	$data	=	dbQuery($que, $dbc);
	$total = mysqli_num_rows();
	while ( $row = mysqli_fetch_array($data))
	{
		$ball[]= (int)$row['b1'];
		$ball[]= (int)$row['b2'];
		$ball[]= (int)$row['b3'];
		$ball[]= (int)$row['b4'];
		$ball[]= (int)$row['b5'];
		$ball[]= (int)$row['b6'];
		$ball[]= (int)$row['bonus'];

	}
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#rsearch").on("click",function(){
		$("#form1").submit();
	});
});
</script>
<form method="post" name="form1" id="form1">
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/sub2_4_tit.jpg"></h2>
</div>
<div class="sub_search_bg">
	<div class="contents">
		<span class="sub_search_tit1 short">기간</span>
		<span class="sub_search1 long one_line">
			<select name="wks">
				<option value="5" <? if($_POST[wks]=="5" || $_POST[wks]==""){?>selected<?}?>>최근 5주간</option>
						<option value="10" <? if($_POST[wks]=="10"){?>selected<?}?>>최근 10주간</option>
						<option value="15" <? if($_POST[wks]=="15"){?>selected<?}?>>최근 15주간</option>
			</select>
		</span>
		<a href="javascript:;" id="rsearch" class="blue_bt search_bt2">조회하기</a>
	</div>
</div>
</form>

	<div class="contents2">
		<table cellpadding="0" cellspacing="0" border="0" class="table t2 tp">
			<colgroup>
				<col width="30%">
				<col width="70%">
			</colgroup>
			<tbody>
				<tr>
					<td>번호대</td>
					<td>미출현 번호 리스트</td>
				</tr>
				<?
				foreach($fArray as $key=>$val){
					if($key==41){
						$limit = $key+4;
					} else {
						$limit = ($key+9);
					}
				?>
				<tr>
					<td><?=$val?>회</td>
					<td class="table_lotto_ball">
						<?
						for($i=$key;$i<=$limit;$i++){

							if(!in_array($i,$ball)){
						?>
						<img src="http://<?=$img_url?>/mobile/ball_<?=$i?>.png">
							
						<?
							}
						}?>
						
					</td>
				</tr>
				<?
				}
				?>
			</tbody>
		</table>
		<div class="comment">* 로또 645의 당첨번호는 나눔로또 공식홈페이지(www.nlotto.co.kr), ARS 전화 등을 통해 확인하실 수 있습니다.</div>
	</div>
<?
} else if($sub=="6"){
	$start_seq = $_POST['sseq'];
	$end_seq = $_POST['eseq'];
	if(!$start_seq){
		$start_seq = $_GET['sseq'];
	} 
	if(!$end_seq){
		$end_seq = $_GET['eseq'];
	} 
	if($start_seq && $end_seq){
		if($start_seq > $end_seq){
			$start_seq = $end_seq;
		}

		$que_where = "WHERE seq BETWEEN '{$start_seq}' AND '{$end_seq}'";
	}
	$que = "SELECT * FROM lotto_winning {$que_where} ORDER BY seq desc";

	
	$data	=	dbQuery($que, $dbc);
	$total = mysqli_num_rows();
	
	$search = "&sub=$sub&sseq=$start_seq&eseq=$end_seq";	
	
	
	$arrBall = array('b1', 'b2', 'b3', 'b4', 'b5', 'b6');

	$set_page = $_GET[set_page] ? $_GET[set_page] : 8;
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
	$("#rsearch").on("click",function(){
		$("#dform1").submit();
	});
});
</script>
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/sub2_5_tit.jpg"></h2>
</div>
<form method="post" id="dform1" name="dform1">
<div class="sub_search_bg">
	<div class="contents">
		<span class="sub_search1 long2 one_line2">
			<select name="sseq" id="sseq">
			<?
			foreach(getSeqRank($_GET[sseq], $_GET[eseq], 'asc') as $arr) {
			?>
			<option value="<?=$arr['seq']?>" <? if($_POST[sseq]==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
			<?
			}
			?>
			</select>
			<label>부터</label>&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="eseq" id="eseq">
			<?
			foreach(getSeqRank($_GET[sseq], $_GET[eseq]) as $arr) {
			?>
				<option value="<?=$arr['seq']?>" <? if($_POST[eseq]==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
			<?
			}
			?>
			</select>
			<label>까지</label>
		</span>
		<a href="javascript:;" id="rsearch" class="blue_bt search_bt2">조회하기</a>
	</div>
</div>
</form>
<div class="contents2">
	
		<table cellpadding="0" cellspacing="0" border="0" class="table t2 tp">
			<colgroup>
				<col width="15%">
				<col width="35%">
				<col width="35%">
				<col width="15%">
			</colgroup>
			<tbody>
				<tr>
					<td style="border-right: 1px solid #d8d8d8" rowspan="2">회차</td>
					<td colspan="2">당첨번호</td>
					<td style="border-left: 1px solid #d8d8d8" rowspan="2">번호합</td>
				</tr>
				<tr class="table_top">
					<td style="border-right: 1px solid #d8d8d8">홀수</td>
					<td>짝수</td>
				</tr>
				<? 
				if(!$start) $start=0;
				$ind = 0;
				@mysqli_data_seek( $data , $cur_pos );
				for($i=1;($i<$set_page+1) && $arr = mysqli_fetch_array($data); $i++) {
					
					$odd = 0;//홀
					$even = 0;//짝
				?>
				<tr>
					<td><?=$arr['seq']?></td>
					<td class="table_lotto_ball">
						<?
						foreach($arrBall as $field){
						
							if($arr[$field] % 2 == 1){ 
						?>
						<img src="http://<?=$img_url?>/mobile/ball_<?=$arr[$field]?>.png">
						<?
							}
							$sum_a[$arr['seq']] += $arr[$field]; 
						}
						?>
					</td>
					<td class="table_lotto_ball">
						<?
						foreach($arrBall as $field){
						
							if($arr[$field] % 2 == 0){ 
						?>
						<img src="http://<?=$img_url?>/mobile/ball_<?=$arr[$field]?>.png">
						<?
							}
						}
						?>
					</td>
					<td><?=$sum_a[$arr['seq']]?></td>
				</tr>
				<?
				}
				?>
			</tbody>
		</table>
		
		<div class="paging">
			<?=page_move_event_m($page, $set_page, $bbs_page_scale, $total, $search)?>
		</div>
		
		<div class="comment">* 로또 645의 당첨번호는 나눔로또 공식홈페이지(www.nlotto.co.kr), ARS 전화 등을 통해 확인하실 수 있습니다.</div>
	</div>

<?
} elseif($sub=="7"){
	$start_seq = $_POST['sseq'];
	$end_seq = $_POST['eseq'];
	if(!$start_seq){
		$start_seq = $_GET['sseq'];
	} 
	if(!$end_seq){
		$end_seq = $_GET['eseq'];
	} 
	if($start_seq && $end_seq){
		if($start_seq > $end_seq){
			$start_seq = $end_seq;
		}

		$que_where = "WHERE seq BETWEEN '{$start_seq}' AND '{$end_seq}'";
	}
	$que = "SELECT * FROM lotto_winning {$que_where} ORDER BY seq desc";
	
	
	$data	=	dbQuery($que, $dbc);
	$total = mysqli_num_rows();
	
	$search = "&sub=$sub&sseq=$start_seq&eseq=$end_seq";	

	$arrBall = array('b1', 'b2', 'b3', 'b4', 'b5', 'b6');

	$set_page = $_GET[set_page] ? $_GET[set_page] : 8;
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
	$("#rsearch").on("click",function(){
		$("#dform1").submit();
	});
});
</script>

<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/sub2_6_tit.jpg"></h2>
</div>
<form method="post" id="dform1" name="dform1">
<div class="sub_search_bg">
	<div class="contents">
		<span class="sub_search1 long2 one_line2">
			<select name="sseq" id="sseq">
			<?
			foreach(getSeqRank($_GET[sseq], $_GET[eseq], 'asc') as $arr) {
			?>
				<option value="<?=$arr['seq']?>" <? if($_POST[sseq]==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
			<?
			}
			?>
			</select>
			<label>부터</label>&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="eseq" id="eseq">
			<?
			foreach(getSeqRank($_GET[sseq], $_GET[eseq]) as $arr) {
			?>
				<option value="<?=$arr['seq']?>" <? if($_POST[eseq]==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
			<?
			}
			?>
			</select>
			<label>까지</label>
		</span>
		<a href="javascript:;" id="rsearch" class="blue_bt search_bt2">조회하기</a>
	</div>
</div>
</form>
	<div class="contents2">
		
		<table cellpadding="0" cellspacing="0" border="0" class="table t2 tp">
			<colgroup>
				<col width="15%">
				<col width="60%">
				<col width="25%">
			</colgroup>
			<tbody>
				<tr>
					<td>회차</td>
					<td>당첨번호</td>
					<td>연속번호 출현횟수</td>
				</tr>
				<? 
				if(!$start) $start=0;
				$ind = 0;
				@mysqli_data_seek( $data , $cur_pos );
				for($i=1;($i<$set_page+1) && $arr = mysqli_fetch_array($data); $i++) {
				?>
				<tr>
					<td><?=$arr['seq']?>회</td>
					<td class="table_lotto_ball">
					<?
					$v = 1;
					$next_field = '';
					
					foreach(getBallField() as $field => $var) { 
						$firnum = $arr[$var];
						$fd = 'b'.$v;
						$next_field = 'b'.($v+1);

						$prev_field = 'b'.($v-1);
						$diff = $arr[$next_field] - $arr[$var];
						if($arr[$var]=="1"){
							$diff2 = "-1";
						} else {
							$diff2 = $arr[$var] - $arr[$prev_field];
							
						}
						if($diff==1 || $diff2==1){
							$ref[$arr['seq']]= $ref[$arr['seq']]+1;
					?>
					<img src="http://<?=$img_url?>/mobile/ball_<?=$arr[$var]?>.png">
					<?
						} else {
					?>
					<span><?=$arr[$var]?></span>
					<?
						}
						$v++;
					}
					if($ref[$arr['seq']]==0){
						$ref[$arr['seq']]=0;
					} else {
						$ref[$arr['seq']]=$ref[$arr['seq']];
					}
					?>
					</td>
					<td><?=$ref[$arr['seq']]?>쌍</td>
				</tr>
				<?
				}
				?>
				
			</tbody>
		</table>
		
			<div class="paging">
				<?=page_move_event_m($page, $set_page, $bbs_page_scale, $total, $search)?>
			</div>
		<div class="comment">* 로또 645의 당첨번호는 나눔로또 공식홈페이지(www.nlotto.co.kr), ARS 전화 등을 통해 확인하실 수 있습니다.</div>
	</div>
<?
} else {
?>
<?
}
include(BASE_DIR.'inc/html/foot_m.html');

?>