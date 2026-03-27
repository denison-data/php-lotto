<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
include(BASE_DIR.'inc/html/sub_1.html');

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

	foreach(getSeqBalls($_POST['sseq'], $_POST['eseq']) as $row){
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
			<h1>번호별 통계</h1>
			<div>
				<form method="post" id="dform1" name="dform1">
				<input type="hidden" name="orders" id="orders">
				<div class="stats1_tab">
					<a href="javascript:;" id="nms" <? if($_POST['orders']!="y"){?> class="on" <? } ?>>번호 순</a>
					<a href="javascript:;" id="ods" <? if($_POST['orders']=="y"){?> class="on" <? } ?>>당첨횟수 순</a>
				</div>
				<div class="stats1_title">
					<span style="margin-right:10px;font-weight:400">보너스번호</span>
					<select name="bn">						
						<option value="y" <? if($_POST['bn']=="y" || $_POST['bn']==""){?>selected<? } ?>>포함</option>	
						<option value="n" <? if($_POST['bn']=="n"){?>selected<? } ?>>미포함</option>
					</select>
					<span style="margin:0 10px 0 35px;">회차 선택</span>
					<select name="sseq" id="sseq">
					<?
					foreach(getSeqRank($_GET['sseq'], $_GET['eseq'], 'asc') as $arr) {
					?>
						<option value="<?=$arr['seq']?>" <? if($_POST['sseq']==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
					<?
					}
					?>
					</select>
					<span style="margin:0 10px 0 5px">부터</span>
					<select name="eseq" id="eseq">
					<?
					foreach(getSeqRank($_GET['sseq'], $_GET['eseq']) as $arr) {
					?>
						<option value="<?=$arr['seq']?>" <? if($_POST['eseq']==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
					<?
					}
					?>
					</select>
					<span style="margin-left:5px">까지</span>
					<a href="javascript:;" id="rsearch">조회</a>
				</div>
				</form>
				<div class="stats_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" id="stats1_list">
						<col width="180px">
						<col width="796px">
						<col width="200px">
						<tr>
							<th>번호</th>
							<th>그래프</th>
							<th>당첨횟수</th>
						</tr>
						<?
						if($_POST[orders]=='y'){
							arsort($arrBall);
						}
						$rank = 1;
						foreach($arrBall as $ball => $cnt) { 
							$precent = round(($cnt/$total_count)*100,1);
							$flo = floor($ball/10);
							$flo = $flo+1;
							$max_int_v = max($arrBall);
							$precents = round(($cnt/$max_int_v)*100,1);

						?>
						<tr>
							<td><img src="/add-img/ball/lotto_ball_<?=$ball?>.jpg"></td>
							<td><div  class="graph<?=$flo?>" style="width:<?=$precents?>%"></div></td>
							<td><?=$arrBall[$ball]?></td>
						</tr>
						<?
						}
						?>
						
					</table>
					<div class="ps">* 로또 645의 당첨번호는 나눔로또 공식홈페이지<a href="http://www.nlotto.co.kr/common.do?method=main" target="_blank">(www.nlotto.co.kr)</a> , ARS전화 등을 통해 확인하실 수 있습니다.</div>
				</div>
			</div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->
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

	$set_page = $_GET['set_page'] ? $_GET['set_page'] : 5;
	$bbs_page_scale = 5;
		
	$page = $_GET['page'] ? $_GET['page'] : 1;

	if ($total <= 0) $pages=1;
	else	$pages = ceil( $total / $set_page ) ;

	//페이지 계산 후 나머지 목록
	$cur_pos = $set_page * $page - $set_page;

	//시작되는 번호 초기화
	$start_num  = $total - ( $page * $set_page ) + $set_page;


?>

<script type="text/javascript" src="//<?=$js_url?>/admin/zingchart.min.js"></script>
<script type="text/javascript" src="http://<?=$js_url?>/pc/grape.js?dev=<?=date("YmdHis")?>"></script>
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
			<h1>색상 통계</h1>
			<div>
				<form method="post" name="form1" id="form1">
				<div class="stats1_title">
					<select name="sseq" id="sseq">
					<?
					foreach(getSeqRank($_GET['sseq'], $_POST['eseq'], 'asc') as $arr) {
					?>
						<option value="<?=$arr['seq']?>" <? if($start_seq==$arr['seq']){?> selected<? } ?>><?=$arr['seq']?></option>
					<?
					}
					?>
					</select>
					<span style="margin:0 10px 0 5px">부터</span>
					<select name="eseq" id="eseq">
					<?
					foreach(getSeqRank($_POST['sseq'], $_POST['eseq']) as $arr) {
					?>
						<option value="<?=$arr['seq']?>" <? if($end_seq==$arr['seq']){?> selected<? } ?>><?=$arr['seq']?></option>
					<?
					}
					?>
					</select>
					<span style="margin-left:5px">까지</span>
					<button id="rsearch">조회</button>
				</div>
				</form>
				<div class="circle_chart" id="grape"></div>
				<div class="stats_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" id="stats6_list">
						<col width="86px">
						<col width="145px">
						<col width="740px">
						<col width="195px">
						<tr>
							<th>회차</th>
							<th>당첨일자</th>
							<th>당첨번호</th>
							<th>보너스</th>
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
							<td><?=$arr['seq']?></td>
							<td><?=$arr['date']?></td>
							<td>
							<?
							foreach(getBallField() as $field) { 
							?>

								<img src="/add-img/ball/lotto_ball_<?=$arr[$field]?>.jpg">
							<?
							}
							?>
							</td>
							<td><img src="/add-img/ball/lotto_ball_<?=$arr['bonus']?>.jpg"></td>
						</tr>
						<?
						}
						?>
						
					</table>
					<div class="ps">* 로또 645의 당첨번호는 나눔로또 공식홈페이지<a href="http://www.nlotto.co.kr/common.do?method=main" target="_blank">(www.nlotto.co.kr)</a> , ARS전화 등을 통해 확인하실 수 있습니다.</div>
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
			
			<h1>구간별 출현횟수</h1>
			<div>
				<form method="post" name="form1" id="form1">
				<input type="hidden" name="views" id="views">
				<div class="stats2_tab">
					<a href="javascript:;" id="views1" <? if($_POST['views']=="5" || !$_POST['views']){?>class="on" <? } ?>>10번대</a>
					<a href="javascript:;" id="views2" <? if($_POST['views']=="10"){?>class="on" <? } ?>>5번대</a>
				</div>
				<div class="stats2_title">
					
					<select name="wks">
						<option value="5" <? if($_POST[wks]=="5" || $_POST[wks]==""){?>selected<?}?>>최근 5주간</option>
						<option value="10" <? if($_POST[wks]=="10"){?>selected<?}?>>최근 10주간</option>
						<option value="15" <? if($_POST[wks]=="15"){?>selected<?}?>>최근 15주간</option>
					</select>
					<a href="javascript:;" id="rsearch">조회</a>
					
				</div>
				</form>
				<div class="stats_table" id="st_01">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" id="stats1_list">
						<col width="180px">
						<col width="796px">
						<col width="200px">
						<tr>
							<th>번호대</th>
							<th>그래프</th>
							<th>당첨횟수</th>
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
							
							$percent = round(($nums[$key]/$max_num)*100,1);
						//	$precents = round(($cnt/$max_int_v)*100,1);
						?>
						<tr>
							<td><?=$val?></td>
							<td>
								<div  class="graph<?=$k?>" style="width:<?=$percent?>%"></div>
							</td>
							<td><?=$nums[$key]?></td>
						</tr>
						<?
							
						}
						?>				
					</table>
					<div class="ps">* 로또 645의 당첨번호는 나눔로또 공식홈페이지<a href="http://www.nlotto.co.kr/common.do?method=main" target="_blank">(www.nlotto.co.kr)</a> , ARS전화 등을 통해 확인하실 수 있습니다.</div>

				</div>
			</div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->


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

			<h1>기간별 미출현 번호</h1>
			<div>
				<div class="stats3_title">
					<form method="post" name="form1" id="form1">
					<select name="wks">
						<option value="5" <? if($_POST[wks]=="5" || $_POST[wks]==""){?>selected<?}?>>최근 5주간</option>
						<option value="10" <? if($_POST[wks]=="10"){?>selected<?}?>>최근 10주간</option>
						<option value="15" <? if($_POST[wks]=="15"){?>selected<?}?>>최근 15주간</option>
					</select>
					<a href="javascript:;" id="rsearch">조회</a>
					</form>
				</div>
				<div class="stats_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" id="stats3_list">
						<col width="280px">
						<col width="896px">
						<tr>
							<th>번호대</th>
							<th>미출현 번호리스트</th>
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
							<td><?=$val?></td>
							<td>
								<?
								for($i=$key;$i<=$limit;$i++){

									if(!in_array($i,$ball)){
								?>
								<img src="/add-img/ball/lotto_ball_<?=$i?>.jpg">
									
								<?
									}
								}?>
								
							</td>
						</tr>
						<?
						}
						?>
						
					</table>
					<div class="ps">* 로또 645의 당첨번호는 나눔로또 공식홈페이지<a href="http://www.nlotto.co.kr/common.do?method=main" target="_blank">(www.nlotto.co.kr)</a> , ARS전화 등을 통해 확인하실 수 있습니다.</div>

				</div>
			</div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->
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
		<h1>홀짝 통계</h1>
		<div>
			<div class="stats1_title">
			<form method="post" id="dform1" name="dform1">
				<select name="sseq" id="sseq">
				<?
				foreach(getSeqRank($_GET[sseq], $_GET[eseq], 'asc') as $arr) {
				?>
					<option value="<?=$arr['seq']?>" <? if($_POST[sseq]==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
				<?
				}
				?>
				</select>
				<span style="margin:0 10px 0 5px">부터</span>
				<select name="eseq" id="eseq">
				<?
				foreach(getSeqRank($_GET[sseq], $_GET[eseq]) as $arr) {
				?>
					<option value="<?=$arr['seq']?>" <? if($_POST[eseq]==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
				<?
				}
				?>
				</select>
				<span style="margin-left:5px">까지</span>
				<a href="javascript:;" id="rsearch">조회</a>
			</form>
			</div>
			<div class="stats_table">
				<table cellpadding="0" cellspacing="0" border="0" width="100%" id="stats4_list">
					<col width="86px">
					<col width="120px">
					<col width="410px">
					<col width="410px">
					<col width="150px">
					<tr>
						<th rowspan="2" style="vertical-align: middle;">회차</th>
						<th rowspan="2" style="vertical-align: middle">당첨일자</th>
						<th colspan="2" style="border-right:1px solid #d9d9d9;border-left:1px solid #d9d9d9">당첨번호</th>
						<th rowspan="2" style="vertical-align: middle">번호합</th>
					</tr>
					<tr>
						<th style="border-left:1px solid #d9d9d9;border-right:1px solid #d9d9d9">홀수</th>
						<th style="border-right:1px solid #d9d9d9">짝수</th>
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
						<td><?=date('y.m.d',strtotime($arr['date']))?></td>
						
						<td>
							<?
							foreach($arrBall as $field){
							
								if($arr[$field] % 2 == 1){ 
							?>
							<img src="/add-img/ball/lotto_ball_<?=$arr[$field]?>.jpg">
							<?
								}
								$sum_a[$arr['seq']] += $arr[$field]; 
							}
							?>
						</td>
						<td>
							<?
							foreach($arrBall as $field){
							
								if($arr[$field] % 2 == 0){ 
							?>
							<img src="/add-img/ball/lotto_ball_<?=$arr[$field]?>.jpg">
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
				</table>
				<div class="ps">* 로또 645의 당첨번호는 나눔로또 공식홈페이지<a href="http://www.nlotto.co.kr/common.do?method=main" target="_blank">(www.nlotto.co.kr)</a> , ARS전화 등을 통해 확인하실 수 있습니다.</div>
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

	$set_page = $_GET['set_page'] ? $_GET['set_page'] : 8;
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
	$("#rsearch").on("click",function(){
		$("#dform1").submit();
	});
});
</script>
			<h1>연속번호 출현</h1>
			<div>
				<div class="stats1_title">
					<form method="post" id="dform1" name="dform1">
					<select name="sseq" id="sseq">
					<?
					foreach(getSeqRank($_GET['sseq'], $_GET['eseq'], 'asc') as $arr) {
					?>
						<option value="<?=$arr['seq']?>" <? if($_POST['sseq']==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
					<?
					}
					?>
					</select>
					<span style="margin:0 10px 0 5px">부터</span>
					<select name="eseq" id="eseq">
					<?
					foreach(getSeqRank($_GET['sseq'], $_GET['eseq']) as $arr) {
					?>
						<option value="<?=$arr['seq']?>" <? if($_POST['eseq']==$arr['seq']){?> selected<? }?>><?=$arr['seq']?></option>
					<?
					}
					?>
					</select>
					<span style="margin-left:5px">까지</span>
					<a href="javascript:;" id="rsearch">조회</a>
				</form>
				</div>
				<div class="stats_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" id="stats5_list">
						<col width="86px">
						<col width="145px">
						<col width="740px">
						<col width="195px">
						<tr>
							<th>회차</th>
							<th>당첨일자</th>
							<th>당첨번호</th>
							<th>연속번호 출현횟수</th>
						</tr>
						<? 
						if(!$start) $start=0;
						$ind = 0;
						@mysqli_data_seek( $data , $cur_pos );
						for($i=1;($i<$set_page+1) && $arr = mysqli_fetch_array($data); $i++) {
							
							$ref[$arr['seq']] = 0;

							$nums[$arr['seq']][] = $arr['b1'];
							$nums[$arr['seq']][] = $arr['b2'];
							$nums[$arr['seq']][] = $arr['b3'];
							$nums[$arr['seq']][] = $arr['b4'];
							$nums[$arr['seq']][] = $arr['b5'];
							$nums[$arr['seq']][] = $arr['b6'];
/*echo "<pre>";
print_r($nums);			
echo "</pre>";
*/
						?>
						<tr>
							<td><?=$arr['seq']?></td>
							<td><?=date('y.m.d',strtotime($arr['date']))?></td>						
							<td>
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
								<img src="/add-img/ball/lotto_ball_<?=$arr[$var]?>.jpg">
								<?
									} else {
								?>
								<span><?=$arr[$var]?></span>
								<?
									}

									$v++;
								}
								//$ref[$arr['seq']]=$ref[$arr['seq']]-1;

								if($ref[$arr['seq']]==0){
									$ref[$arr['seq']]=0;
								} else {
									$ref[$arr['seq']]=$ref[$arr['seq']];
								}
								?>
								
							</td>
							<td><?=$ref[$arr['seq']]?> 쌍</td>
						</tr>
						<?
						}
						?>
					</table>
					<div class="ps">* 로또 645의 당첨번호는 나눔로또 공식홈페이지<a href="http://www.nlotto.co.kr/common.do?method=main" target="_blank">(www.nlotto.co.kr)</a> , ARS전화 등을 통해 확인하실 수 있습니다.</div>
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
?>
<?
@dbClose($dbc);
include(BASE_DIR.'inc/html/foot.html');

?>
