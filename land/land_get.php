<?
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-type: application/json; charset=utf-8");

include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
$dbc = dbOpen();
$data = json_decode( file_get_contents('php://input') );

$mode = $_POST['mode'];
switch($mode){
	case	"land_ins"		:	func_land_ins();	break;
}
function func_land_ins(){
	global $_SERVER, $dbc, $_SESSION;
	header('Content-Type: application/json');
	$tel = trim($_POST['tel']);
	$tel = str_replace("-","",$tel);
	$data['etel'] =	$tel;
	
	$data['ip'] = $_SERVER['REMOTE_ADDR'];
	$data['uid'] = 0;

	$cnt_que = "
	Select * from member 
	Where 1=1 And tel in ('$data[etel]')
	";
	$cdata =dbQuery($cnt_que, $dbc);
	$crow = mysqli_fetch_array($cdata);
	if($crow['code']){
		$cd = $crow['code'];
		$data['mdivision'] = "y";
		if(strlen($_POST['name'])==0){
			$data['ename'] = $crow['nickname']." [회원DB]";
		} else {
			$data['ename'] = $_POST['name'];
		}
		$json_data = array("result"=>true,'status'=>'1');
		echo json_encode($json_data);
		exit;

	}else {
		$cd = getCode();
		$data['ename'] = $_POST['name'];
		$data['mdivision'] = "n";
	}
	$nowday = date("w");
	$nhour = date("H");
	//$data['grade'] = "n";
	$data['code'] = $cd;
	$data['page'] = $_POST['page'];
	$data['etc'] = $_POST['etc'];
	$data['history_url'] = $_POST['history_url'];
	$column = implode(",",array_keys($data));
	$mvalues = array_map('mysql_real_escape_string', array_values($data));
	$values  = implode("','", $mvalues);
	$tb = "data_member";
	$cts = "
	Select Count(*) from $tb Where 1=1 And del_flag in ('n') And etel in ('$tel')
	";
	
	$u_data =dbQuery($cts, $dbc);
	$u_ct = mysql_result($u_data,0,0);
	if($u_ct==0){
		$qry = "
			Insert into $tb
			($column,regdate)
			values 
			('$values',NOW())
			";
		dbQuery($qry, $dbc);
		
		$json_data = array("result"=>true,'status'=>'0');
	} else {
		$json_data = array("result"=>true,'status'=>'2'); //중복처리
	}
	//echo "<script>alert('등록되었습니다');top.location.href=$data[page];</script>";
	//exit;

}
?>