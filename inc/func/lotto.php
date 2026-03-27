<?
/*고정수 */
function addFixNum(){
	global $arr_ball, $arr_interval, $_INFO;
	
	if(count($_INFO[fixnum]) > 0){
		foreach($_INFO[fixnum] as $val) {
			$interval	 =	@floor($val * 0.1);
			$arr_interval[$interval][] = $val;
			$arr_ball[] = $val;
		}
	}
}
function addNum() {
	global $arr_ball, $arr_interval, $_INFO, $n;
	$t_n = $n;

	//무작위 패턴
	$PATTERN		=	array();
	$PATTERN[0]	=	array(4,0,2,1,3,4,0,2,1,3,4,0,2,1,3,4,0,2,1,3,4,0,2,1,3,4,0,2,1,3);
	$PATTERN[1]	=	array(1,3,2,0,4,1,3,2,0,4,1,3,2,0,4,1,3,2,0,4,1,3,2,0,4,1,3,2,0,4);
	$PATTERN[2]	=	array(1,2,3,4,0,1,2,3,4,0,1,2,3,4,0,1,2,3,4,0,1,2,3,4,0,1,2,3,4,0);
	$PATTERN[3]	=	array(3,4,0,2,1,3,4,0,2,1,3,4,0,2,1,3,4,0,2,1,3,4,0,2,1,3,4,0,2,1);
	$PATTERN[4]	=	array(2,1,0,4,3,2,1,0,4,3,2,1,0,4,3,2,1,0,4,3,2,1,0,4,3,2,1,0,4,3);

	$rand = rand(0,4);
	
	$bln_loop = true;
	$loop_count	=	0;
	foreach( $PATTERN[$rand] as $interval ) {
		//구간별 뽑을 갯수
		if(count($arr_ball) <= 4) {
			$num_req = rand(1,2);
		}else{
			$num_req = 1;
		}
		if(count($arr_interval[$interval]) + $num_req > 4) {//구간안에 4개 이상이면 X
			continue;
		}

		if( (count($t_n[$interval])) < $num_req ) {//볼이 남아 있지 않다면
			continue;
		}

		$rand_keys		=	array();
		if( $num_req == 1 ) {
			$rand_keys[] = array_rand ($t_n[$interval], $num_req);
		}else if( $num_req >= 2 ) {
			$rand_keys = array_rand ($t_n[$interval], $num_req);
		}
		foreach($rand_keys as $val){
			if( count($arr_ball) >= 6) {
				$bln_loop = false;
				break;
			}
			$arr_ball[] = intval($val);
			$arr_interval[$interval][$val] = intval($val);
			unset($t_n[$interval][$val]);
			if( count($arr_ball) >= 6) {
				$bln_loop = false;
				break;
			}
		}
		unset($rand_keys);
		if(!$bln_loop){
			break;
		}
	}
	############################
	unset($t_n);
	sort($arr_ball);
}
function myLotto($code, $orderby='desc', $sb_segs=0){
	global $dbc;
	if(!$dbc){
		$dbc = dbOpen;
	}
	
	$arr = array();
	
	if($sb_segs){
		$cur_seq = $sb_segs;
		$next_seq = $cur_seq;
		$wheres = "";
		$tb = getBuyTbName($next_seq);
		
	} else {
		$cur_seq = getCurSeq();
		$next_seq = $cur_seq + 1;
		$wheres = "";
		$tb = getBuyTbName($next_seq);
		$db_que = "Show Tables from lumieyes_lotto";
		$data = dbQuery($db_que,$dbc);

		while($row=mysqli_fetch_row($data)){
			$sseq = $row[0];
			
			
			if(strpos($sseq,"lotto_buy") !== false && $sseq != $tb ){
				$ttb = ($sseq);
				if(strpos($ttb,"v_") !== false){					
				} else {
					$unionQry .= "
					Union All
					Select * from $ttb
					Where code in ('$code') And type not in ('V')
					
					";
				}
				
			}
		}
		
	}
	
	if($sb_segs > 0){
		$wheres .= " And seq in ('$sb_segs')";
	}
	$qry = "
	Select * from {$tb}
	Where code in ('$code') And type not in ('V')
	$wheres
	$unionQry
	Order by uid desc
	";

	$res	=	dbQuery($qry, $dbc);
	while($row = mysql_fetch_assoc($res)) {
		$arr[$row['uid']] = $row;
	}
	if($_SERVER['REMOTE_ADDR']=="183.109.79.249"){
		//print_r($arr);	
	}
	return $arr;
}
//필드명
function getBallField($type=''){

	$arr = array('b1', 'b2', 'b3', 'b4', 'b5', 'b6');
	if($type == 'bonus') {
		$arr[] = 'bonus';
	}

	return $arr;
}
//회차별 당첨방송
function getBrod($start_seq=0, $end_seq=0, $orderby='desc'){
	global $dbc;
	
	if(!$dbc){
		$dbc = dbOpen();
	}
	$arr = array();
	$que_where = '';
	if($start_seq && $end_seq){

		if($start_seq > $end_seq){
			$start_seq = $end_seq;
		}

		$que_where = "WHERE b.seq BETWEEN '{$start_seq}' AND '{$end_seq}'";
	}
	$que = "SELECT b.*, w.date
	FROM data_lotto_win b left outer join  lotto_winning w on b.seq = w.seq
	{$que_where} ORDER BY b.seq {$orderby}
	";
	$res	=	dbQuery($que, $dbc);
	while($row = mysqli_fetch_assoc($res)) {
		$arr[$row['seq']] = $row;
	}
	return $arr;
}
//회차별 당첨번호,당첨결과
function getSeqRank($start_seq=0, $end_seq=0, $orderby='desc'){
	global $dbc;
	
	if(!$dbc){
		$dbc = dbOpen();
	}
	$arr = array();

	$que_where = '';
	if($start_seq && $end_seq){

		if($start_seq > $end_seq){
			$start_seq = $end_seq;
		}

		$que_where = "WHERE seq BETWEEN '{$start_seq}' AND '{$end_seq}'";
	}
	$que = "SELECT * FROM lotto_winning {$que_where} ORDER BY seq {$orderby}";
	$res	=	dbQuery($que, $dbc);
	while($row = mysqli_fetch_assoc($res)) {
		$arr[$row['seq']] = $row;
	}
	return $arr;
}
/*회차별 당첨번호*/
function getSeqBalls($start_seq=0, $end_seq=0, $orderby='desc'){
	global $dbc;
	if(!$dbc){
		$dbc = dbOpen();
	}
	$arr = array();
	
	$where = '';
	if($start_seq && $end_seq){
		if($start_seq > $end_seq){
			$start_seq = $end_seq;
		}
		$where = "Where seq Between '{$start_seq}' And '{$end_seq}' ";
	} else if($start_seq){
		$where = "Where seq ='{$start_seq}' ";
	}
	$qry = "
	SELECT seq, date, b1, b2, b3, b4, b5, b6, bonus, week_ct FROM lotto_winning
	{$where}
	Order By seq {$orderby}
	";
	$res = dbQuery($qry, $dbc);
	
	if(mysqli_num_rows($res)>0){
		while($row = mysqli_fetch_assoc($res)){
			$arr[$row['seq']] = $row;
		}
	}

	return $arr;
}
function getBuyTbName($seq=0){
	if(!$seq){
		$seq = getCurSeq();
	}

	$seq = intval($seq*0.1)*10;
	$tb = "lotto_buy_{$seq}";

	return $tb;
}
function getBuyTbName_View($seq=0){
	if(!$seq){
		$seq = getCurSeq();
	}

	$seq = intval($seq*0.1)*10;
	$tb = "buy_{$seq}_view";

	return $tb;
}
//최근방송 회차
function brod_getCurSeq(){
	global $dbc;
	if(!$dbc){
		$dbc = dbOpen();
	}
	$que = "Select Max(seq) from data_lotto_win";
	$res	=	dbQuery($que, $dbc);
	$seq	=	mysql_result($res, 0, 0);
	return $seq;
}
//최근회차
function getCurSeq(){
	global $dbc;
	
	if(!$dbc){
		$dbc = dbOpen();
	}

	$que	=	"SELECT MAX(seq) FROM lotto_winning";
	$res	=	dbQuery($que, $dbc);
	$seq	=	mysqli_result($res, 0, 0);
	return $seq;
}
//최근방송회차
function getBroCurSeq(){
	global $dbc;
	
	if(!$dbc){
		$dbc = dbOpen();
	}
	
	$que	=	"SELECT MAX(seq) FROM data_lotto_win";
	
	$res	=	dbQuery($que, $dbc);
	
	$seq	=	mysqli_result($res, 0, 0);
	return $seq;
}

// 구매번호 랭킹
// $WB - (array) 회차의당첨번호(b1,..,b6, bonus)
// $arrBall - (array)조합
// 
function getBuyRank($_WB, $arrBall){
	$balls_list = ','.implode(',', $arrBall).',';
	$cnt = 0;
	if( strpos($balls_list, ",{$_WB['b1']},") !== false ) { $cnt++; }
	if( strpos($balls_list, ",{$_WB['b2']},") !== false ) { $cnt++; }
	if( strpos($balls_list, ",{$_WB['b3']},") !== false ) { $cnt++; }
	if( strpos($balls_list, ",{$_WB['b4']},") !== false ) { $cnt++; }
	if( strpos($balls_list, ",{$_WB['b5']},") !== false ) { $cnt++; }
	if( strpos($balls_list, ",{$_WB['b6']},") !== false ) { $cnt++; }
	if( $cnt == 6 ) {
		$rank = 1;
	} else if( $cnt == 5 && in_array($_WB['bonus'], $arrBall)) {
		$rank = 2;
	}else if( $cnt == 5 ) {
		$rank = 3;
	} else if( $cnt == 4 ) {
		$rank = 4;
	} else if( $cnt == 3 ) {
		$rank = 5;
	} else { 
		$rank = 0;
	}
	return $rank;
}
function mysqli_result($res,$row=0)
{ 
	$data=mysqli_fetch_row($res);
	return $data[$row];
}
?>