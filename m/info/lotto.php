<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
$dbc = dbOpen();
$mode = $_POST['mode'];
switch($mode){
	case "data_grape"	:	function_grape();		break;
	case "brod_select"	:	function_brod_sel();	break;
	case "lotto_select"	:	function_lotto_sel();	break;
}
function function_lotto_sel(){
	global $dbc;
	$seq = $_POST['seq'];
	
	$que = "
		Select * from v_lotto_win
		Where seq in ('$seq')
	";
	$res	=	dbQuery($que, $dbc);
	while($row = mysql_fetch_assoc($res)) {
		$arr[$row['seq']] = $row;
	}
	$datas = array("data"=>$arr);
	echo json_encode($datas);
	dbClose($dbc);
	exit;
}
function function_brod_sel(){
	global $dbc;
	$seq = $_POST['seq'];
	if(!$seq){
		$seq = brod_getCurSeq();
	}
	$que = "
		Select * from data_lotto_win
		where seq in ('$seq')
	";
	$res	=	dbQuery($que, $dbc);
	while($row = mysql_fetch_assoc($res)) {
		$arr[$row['seq']] = $row;
	}
	$datas = array("data"=>$arr);
	
	echo json_encode($datas);
	dbClose($dbc);
	exit;

}
function function_grape(){
	global $dbc;
	$start_seq = $_POST['sseq'];
	$end_seq = $_POST['eseq'];

	$fArray = array(
	"1"=>"1~10",
	"11"=>"11~20",
	"21"=>"21~30",
	"31"=>"31~40",
	"41"=>"41~45"
	);

	if($start_seq && $end_seq){
		if($start_seq > $end_seq){
			$start_seq = $end_seq;
		}

		$que_where = "WHERE seq BETWEEN '{$start_seq}' AND '{$end_seq}'";
	}
	$que = "SELECT * FROM lotto_winning {$que_where} ORDER BY seq desc";
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
	$totals = 0;

	foreach($fArray as $key=>$val){
		if($key==41){
			$limit = $key+4;
		} else {
			$limit = ($key+9);
		}
		$nums[$key] = 0;
		for($i=$key;$i<=$limit;$i++){			
			if($ball_data[$i]!=0){
				$nums[$key] += $ball_data[$i];				
			}
			$max_num = max($nums);
			
		}
		$titles[] = $val."{".$nums[$key].")";
		$totals += $nums[$key];		
	}
	foreach($fArray as $key=>$val){
		$percent[] = round(($nums[$key]/$totals)*100,1);
	}
	$datas = array("total"=>$totals,"datas"=>$nums,"percent"=>$percent,"titles"=>$titles);
	
	echo json_encode($datas);
	dbClose($dbc);
	exit;
}
?>