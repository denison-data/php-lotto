<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
$dbc = dbOpen();
$mode = $_POST['mode'];
switch($mode){
	case "chose"		:	function_choses();		break;
	case "chose_list"	:	function_chose_list();	break;

}
function function_chose_list(){
	global $_SERVER, $dbc,$_SESSION;
	$mcode = $_POST['mcode'];
	
	$qry = "
	Select * from maker_easy Where mcode in ('$mcode')
	";
	$data =dbQuery($qry, $dbc);
	$arr = array();
	$row=mysqli_fetch_array($data);
	
	$json_data = array("result"=>true,'status'=>'0','dat'=>$row);	
	dbClose($dbc);
		
	echo json_encode($json_data);
	exit;
}
function function_choses(){
	global $_SERVER, $dbc,$_SESSION;
	$mcode = $_POST['mcode'];
	$sel_type = $_POST['sel_type'];

	$_INFO = array();
	$_INFO[fixnum]	=	array();//고정수
	$_INFO[except]	=	array();//제외수

	
	if( $sel_type=="fixnum" ) {
		$que_fixnum	=	'';
		if(count($_POST[datas]['fixnum']) > 0 ){
			foreach($_POST[datas]['fixnum'] as $key => $val) {
				if( $val >= 1 && $val <= 45 ){
					$_INFO[fixnum][] = $val;
				}
			}
			$fixnum = implode(',', $_INFO[fixnum]);
		}
		$que_fixnum = ",fixnum = '{$fixnum}'";
		$que_except =  ",except = ''";
	}else if( $sel_type=="expert" ) {
		$que_except = "";
		if(count($_POST[datas]['expert']) > 0 ){
			foreach($_POST[datas]['expert'] as $key => $val) {
				if( $val >= 1 && $val <= 45 ){
					$_INFO[expert][] = $val;
				}
			}
			$expert = implode(',', $_INFO[expert]);
		}
		$que_fixnum = ",fixnum = ''";
		$que_except = ",except = '{$expert}'";
	}
	$qct = "Select Count(*) from maker_easy Where mcode in ('$mcode')";
	$data = dbQuery($qct,$dbc);
	$ct = mysql_result($data,0,0);

	if($ct=="0"){
		$que	=	"INSERT INTO maker_easy SET uuid = '{$_MEMBER[uuid]}' {$que_fixnum} {$que_except} ,reg_datetime = NOW(), mcode ='$mcode'";
	} else {
		$que = "
		Update maker_easy SET uuid = '{$_MEMBER[uuid]}' {$que_fixnum} {$que_except},up_datetime = NOW() 
		Where mcode = '$mcode'
		";
	}
	$rs = dbQuery($que,$dbc);
	if($rs)
	{
		$json_data = array("result"=>true,'status'=>'0');	
	} else {
		$json_data = array("result"=>true,'status'=>'1');	
	}
	dbClose($dbc);
		
	echo json_encode($json_data);
	//echo $que;
	exit;
	//print_r($_POST);
}

?>