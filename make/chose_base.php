<?
/*
간편조합기
$_POST[fixnum]
$_POST[except]
$_POST[sel_num]
*/
session_start();

set_time_limit(0);
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
$dbc = dbOpen();
$orderby='desc';

$code= $_SESSION['code'];

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
		if(strpos($sseq,"lotto_buy") !== false && $sseq != $tb){
			$ttb = ($sseq);
			$unionQry .= "
			Union All
			Select * from $ttb
			Where code in ('$code')
			
			";
			
		}
	}
}

if($sb_segs > 0){
	$wheres .= " And seq in ('$sb_segs')";
}
$qry = "
Select * from {$tb}
Where code in ('$code')
$wheres
$unionQry
";

echo $qry;


exit;
$seq = getCurSeq();
$t_seq	=	$seq + 1;

$_INFO = array();
$_INFO[fixnum]	=	array();//고정수
$_INFO[except]	=	array();//제외수

//고정수
$que_fixnum	=	'';
if( count($_POST[fixnum]) > 0 ) {
	foreach($_POST[fixnum] as $key => $val) {
		if( $val >= 1 && $val <= 45 ){
			$_INFO[fixnum][] = $val;
		}
	}
	$fixnum = implode(',', $_INFO[fixnum]);
	$que_fixnum = ",fixnum = '{$fixnum}'";
}

//제외수
$que_except = "";
if(count($_POST[except]) > 0 ){
	foreach($_POST[except] as $val){
		if( $val >= 1 && $val <= 45 ){
			$_INFO[except][] = $val;
		}
	}
	$except = implode(',', $_INFO[except]);
	$que_except = ",except = '{$except}'";
}

//사용 정보
$que	=	"INSERT INTO maker_easy SET uuid = '{$_MEMBER[uuid]}' {$que_fixnum} {$que_except} ,reg_datetime = NOW()";
dbQuery($que, $dbc);
$maker_easy_uid = mysql_insert_id($dbc);




//#######################################
//##	번호 생성, 제외수 제거

//1-45 번호 생성
$n = array();
for($i = 1; $i <= 45; $i++){
	$interval	 =	@floor($i * 0.1);
	if(in_array($i, $_INFO[except]) || in_array($i, $_INFO[fixnum])){//제외수, 고정수 제거
		continue;
	}
	$n[$interval][$i] = $i;
}

$user_count = $_POST[sel_num];
$max_count = $user_count * 10;
$_BALL = array();

###################	회원이 선택한 조합수 만큼 반복	#########################
$total_count = 0;

while($user_count > 0){

	if($total_count >= $max_count) {
		break;
	}

	$arr_ball = array();
	$arr_interval = array();

	//고정수 넣고
	addFixNum();

	//나머지 채워넣기
	addNum();
	echo ($arr_ball);
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


if(count($_BALL) > 0){

	foreach($_BALL as $key => $arr) {
		$que = "
			INSERT INTO 
				maker_my 
			SET
				uuid = '{$_MEMBER[uuid]}',
				b1 = '{$arr[0]}',
				b2 = '{$arr[1]}',
				b3 = '{$arr[2]}',
				b4 = '{$arr[3]}',
				b5 = '{$arr[4]}',
				b6 = '{$arr[5]}',
				type = 'E',
				reg_datetime = NOW()
		";
		dbQuery( $que, $dbc);
	}

	$que	=	"UPDATE maker_easy SET up_datetime = NOW() WHERE uid = '{$maker_easy_uid}'";
	dbQuery( $que, $dbc);

	echo 'ok';
	exit;
}

