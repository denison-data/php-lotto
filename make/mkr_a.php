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
Select * from member_arr m Where m.retire in ('n')  AND m.test_dv  NOT IN ('y')
";

$mem_res = dbQuery($mem_que,$dbc);
while($mrow = mysql_fetch_assoc($mem_res)){
	$mcode = $mrow['code'];
	$mcount = 2;
	


	res_db($mrow['code'],$mcount, $mrow['grade']); 
}
function res_db($code, $mcount, $mgrade){
	$cur_seq = getCurSeq();
	$next_seq = $cur_seq + 1;

	$limit_count = $mcount;
	$recommend_tb = "recommend_{$next_seq}";
	
	$que = "SELECT * FROM {$recommend_tb} LIMIT {$limit_count}";
	$res = dbQuery($que, $dbc);
	
	$tb = getBuyTbName($next_seq);
	
	$que_ct = "Select * from {$tb} Where code in ('$code') And seq in ('$next_seq') And type not in ('A','R')";
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
			$max = 10*$mcount;
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
					type = 'V',
					sms = 'y',
					reg_datetime = NOW()
			";
			//echo $que;
			dbQuery($que, $dbc);
		}
		
	}
}
?>