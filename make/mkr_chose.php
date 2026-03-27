<?
set_time_limit(0);
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
$dbc = dbOpen();

$_INFO = array();
$_INFO[fixnum]	=	array();//고정수
$_INFO[except]	=	array();//제외수


$que_fixnum = "";
$_POST[fixnum] = array("3","5","6");  //고정수
$_POST[expert] = array("1","44","23"); //제외수
$_POST[sel_num] = 10; // 카운트

echo count($_POST[fixnum]);
if( count($_POST[fixnum]) > 0 ) {
	foreach($_POST[fixnum] as $key => $val) {
		if( $val >= 1 && $val <= 45 ){
			$_INFO[fixnum][] = $val;
		}
	}
	$fixnum = implode(',', $_INFO[fixnum]);
	$que_fixnum = ",fixnum = '{$fixnum}'";
}
//echo $que_fixnum;
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

echo "<pre>";
print_r($_BALL);
echo "</pre>";



?>