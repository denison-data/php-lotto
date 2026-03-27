<?
/*매주 수요일 오전 10시 20분에 번호 발생*/
set_time_limit(0);
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
$dbc = dbOpen();
$_INFO = array();
$_INFO[fixnum]	=	array();//고정수
$_INFO[except]	=	array();//제외수

$ymd = date("Ymd");
/*회원 조회*/
$mem_que = "
Select * from member m Where m.retire in ('n')  AND m.test_dv  NOT IN ('y')
";
$mem_res = dbQuery($mem_que,$dbc);
while($mrow = mysql_fetch_assoc($mem_res)){
	$mcode = $mrow['code'];

	/* 기간추가 */
	$que_od = "
	Select * from order_info 
	Where 1=1 And mem_code in ('$mcode') And Order_State in ('y')
	And '$ymd' BETWEEN Start_Date AND Finish_Date 
	Order By Order_Date desc
	";
	$qdata = dbQuery($que_od,$dbc);
	$totals = mysqli_num_rows();
	if($totals>0){
		switch($mrow['grade']){
			case "n"	:	$mcount = "1"; break;
			case "e"	:	$mcount = "1"; break; //이벤트 1개월
			case "s"	:	$mcount = "1"; break;
			case "g"	:	$mcount = "2"; break;
			case "p"	:	$mcount = "3"; break;

		}
		$mem_que = "
		Select * from maker_easy Where 1=1 And mcode in ('$mrow[code]');
		";
		$make_data = dbQuery($mem_que,$dbc);
		$make_row = mysqli_fetch_array($make_data);
		if($make_row['fixnum'] || $make_row['except']){
			res_db_plus($make_row['fixnum'],$make_row['except'],$make_row['mcode'],$mcount);
		} else {
			res_db($mrow['code'],$mcount, $mrow['grade']); //테스트는 멈춤
		}
	}
}
function res_db_plus($fnum, $ep, $mcode,$sel){
	global $dbc, $_SESSION, $_INFO;
	$cur_seq = getCurSeq();
	$next_seq = $cur_seq + 1;	
	$tb = getBuyTbName($next_seq);

	$_POST[fixnum] = explode(",",$fnum);
	//$_POST[fixnum] = array("6","5","3");
	$_POST[expert] = explode(",",$ep); //제외수
	$_POST[sel_num] = $sel*10;

	if( count($_POST[fixnum]) > 0 ) {
		foreach($_POST[fixnum] as $key => $val) {
			if( $val >= 1 && $val <= 45 ){
				$_INFO[fixnum][] = $val;
			}
		}
		$fixnum = implode(',', $_INFO[fixnum]);
		$que_fixnum = ",fixnum = '{$fixnum}'";
	}
	$n = array();
	for($i = 1; $i <= 45; $i++){
		$interval	 =	@floor($i * 0.1);
		if(in_array($i, $_INFO[except]) || in_array($i, $_INFO[fixnum])){//제외수, 고정수 제거
			continue;
		}
		$n[$interval][$i] = $i;
	}
	$user_count = $_POST[sel_num];
	$max_count = $user_count * 1;
	$_BALL = array();
	$total_count = 0;

	while($user_count > 0){
		if($total_count > $max_count) {
			break;
		}
		$arr_ball = array();
		$arr_interval = array();
		//고정수 넣고
		if(count($_INFO[fixnum]) > 0){
			foreach($_INFO[fixnum] as $val) {				
				$interval	 =	@floor($val * 0.1);				
				$arr_interval[$interval][] = $val;
				$arr_ball[] = $val;
			}			
		}
		$t_n = $n;
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
			//echo $arr_ball."<br>";
			unset($rand_keys);
			if(!$bln_loop){
				break;
			}
		}		
		############################
		unset($t_n);
		sort($arr_ball);		
		if( count($arr_ball) < 6 ) {
			$total_count++;
			continue;
		}	
		//생성한 조합중 동일한 조합이 있는지 체크
		$bln_add_ok = true;		
		foreach( $_BALL as $val ){		
			if($val == $arr_ball){
				$bln_add_ok = false;
				break;
			}
		}
		//동일하지 않다면 ADD
		if($bln_add_ok){
			$_BALL[] = $arr_ball;
			$user_count--;
			unset($arr_ball);
		}
		$total_count++;
	}	
	//echo $total_count;
	$que_ct = "Select * from {$tb} Where code in ('$mcode') And seq in ('$next_seq')";
	$q_res = dbQuery($que_ct, $dbc);
	$total = mysqli_num_rows();
	if($total==0){
		//echo sizeof($_BALL);
		for($i = 0; $i < $total_count; $i++ ) {
			if($_BALL[$i][0]){
			$que = "
				INSERT INTO 
				{$tb}
				SET
					uuid = '{$_MEMBER[uuid]}',
					code = '{$mcode}',
					seq = '{$next_seq}',
					b1 = '{$_BALL[$i][0]}',
					b2 = '{$_BALL[$i][1]}',
					b3 = '{$_BALL[$i][2]}',
					b4 = '{$_BALL[$i][3]}',
					b5 = '{$_BALL[$i][4]}',
					b6 = '{$_BALL[$i][5]}',
					type = 'E',
					sms = 'n',
					reg_datetime = NOW()
				";
				dbQuery($que, $dbc);//주석
				//echo $que." | ".$i."<br>"; R 포함 및 제외 갖고 추측
			}
			//dbQuery($que, $dbc);//주석
		}
	}
}

function res_db($code, $mcount, $mgrade){
	$cur_seq = getCurSeq();
	$next_seq = $cur_seq + 1;

	$limit_count = $mcount;
	$recommend_tb = "recommend_{$next_seq}";
	
	$que = "SELECT * FROM {$recommend_tb} LIMIT {$limit_count}";
	$res = dbQuery($que, $dbc);
	
	$tb = getBuyTbName($next_seq);
	
	
	$que_ct = "Select * from {$tb} Where code in ('$code') And seq in ('$next_seq')";
	$q_res = dbQuery($que_ct, $dbc);
	$total = mysqli_num_rows();
	if($total==0){
		$_BALL = array();
		while($row = mysql_fetch_assoc($res)) {
			$arr = str_split($row[cb], 12);
			foreach($arr as $balls){
				$_BALL[] = str_split($balls, 2);
			}
			$arrUid[] = $row[uid];
		}
		
		$uid_list = implode(',', $arrUid);
		$que = "DELETE FROM {$recommend_tb} WHERE uid IN ({$uid_list})";
		dbQuery($que, $dbc);
		if($mgrade=="n"){
			$max = 5; //등급에 따라 나눔 n== 5 
		} else {
			$max = 10*$mcount;
		}	
		for($i = 0; $i < $max; $i++ ) {
			$que = "
				INSERT INTO 
					{$tb} 
				SET
					uuid = '{$_MEMBER[uuid]}',
					code = '{$code}',
					seq = '{$next_seq}',
					b1 = '{$_BALL[$i][0]}',
					b2 = '{$_BALL[$i][1]}',
					b3 = '{$_BALL[$i][2]}',
					b4 = '{$_BALL[$i][3]}',
					b5 = '{$_BALL[$i][4]}',
					b6 = '{$_BALL[$i][5]}',
					type = 'R',
					sms = 'n',
					reg_datetime = NOW()
			";
			
			dbQuery($que, $dbc);
		}
		
	}
}

?>