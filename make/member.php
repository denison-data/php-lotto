<?
/*10만개 디비 만들기 (회원)*/
set_time_limit(0);
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
$dbc = dbOpen();
$mcode = "vrmGD";
$gcode = "ED1";
$dates = date("ymdHis");
		$data_o['mem_code'] = $mcode;
		$data_o['g_code'] = $gcode;
		$data_o["Order_No"] = "ORD_".$gcode."_".getCode()."_".$dates;
		$data_o['Order_Date'] = time();
		if($md['pay_type']=="gasa"){
			$data_o['Order_State'] = 'y';
			$data_o['bank_order'] = "";
			$data_o['gasang_name'] = "";
			$data_o['gasang_no'] = "";
			$data_o['gasang_kname'] = "";
			
		} else {
			$data_o['Order_State'] = 'y';
		}
		$g_que = "Select grade from member Where code in ('".$mcode."')";
		$gres	=	dbQuery($g_que, $dbc);
		$gseq	=	@mysql_result($gres, 0, 0);
		$data_o['m_grade'] = $gseq; //등급
		$data_o['ip_addr'] = $_SERVER['REMOTE_ADDR'];
		$data_o['State']="n"; //종료여부임
		$data_o['Pay_Type'] = $md['pay_type'];

		$data_o['pm_division'] = "p";
		$p_que = "Select Real_Price from v_goods Where Code in ('$gcode')";
		$pres = dbQuery($p_que, $dbc);
		$price = mysql_result($pres,0, 0);

		if($_POST['od_price']!="0"){
			$data_o['total_price'] = $_POST['od_price'];
		} else {
			$data_o['total_price'] = $price;
		}
		$his_data = ordrGoods($mcode);
		if($his_data){
			$max = max(array_keys($his_data));
			$data_o['his_Order_No'] = $his_data[$max]['Order_No'];
		}

		$cts_que = "
		Select Count(*) from member Where 1=1 And code in ('$mcode') And grade in ('n')
		";
		$cdatas	=	dbQuery($cts_que, $dbc);
		$cout	=	mysql_result($cdatas, 0, 0);
		/*시작일 종료일 입력*/

		$w = date("w");
		$g_que = "
		Select * from v_goods
		Where Code in ('".$gcode."')
		";
		$gdata = dbQuery($g_que,$dbc);
		$grows = mysqli_fetch_array($gdata);

		$peroid = $grows['Peroid'];

		$od_que = "
		Select COunt(*) from v_order_list Where 1=1 And mem_code in ('$mcode')
		";
		$oddate = dbQuery($od_que,$dbc);
		$order_ct= mysql_result($oddate, 0, 0);
if($order_ct==0){
	if($w<=3){
		$sdate = date("Ymd",strtotime("Thursday"));
		$edate = date("Ymd",strtotime("$peroid month"));
	} else {
		$sdate = date("Ymd",strtotime("next week Thursday"));
		$edate = date("Ymd",strtotime("$peroid month", strtotime($sdate))); 
	}
	$ups_mque = "
	Update member set grade = '$ggrade' 
	Where 1=1 And code in ('$mcode') 
	";

	dbQuery($ups_mque, $dbc);

} else {
	$od_que = "
	Select * from v_order_list Where 1=1 And mem_code in ('$mcode')
	And Order_State in ('y')
	ORDER BY Order_Date DESC
	Limit 1
	";
	$oddate = dbQuery($od_que,$dbc);
	$orows = mysqli_fetch_array($oddate);
	$his_end_date = $orows['Finish_Date'];
	$sdate = date("Ymd",strtotime("1 days", strtotime($his_end_date))); 
	$edate = date("Ymd",strtotime("$peroid month", strtotime($his_end_date))); 

}
		$data_o['Start_Date'] = $sdate;
		$data_o['Finish_Date'] = $edate;

		$column_o = implode(",",array_keys($data_o));
		$mvalues_o = array_map('mysql_real_escape_string', array_values($data_o));
		$values_o  = implode("','", $mvalues_o);

	$o_qry = "
	Insert into order_info
		($column_o)
		values 
		('$values_o')
		";
echo $o_qry;

exit;
$arr1 ="";
$arr2 = "";
$t = 0;
$tb = "member_arr";
for($l1 = 1880; $l1 < 1890; $l1 ++) { 
	for($l2 = 0; $l2 < 10000; $l2 ++) { 
		$tel = "010".sprintf("%04d",$l1).sprintf("%04d",$l2);
		//echo "010-".sprintf("%04d",$l1).'-'.sprintf("%04d",$l2)."\n"; 

		$data['userid'] = $tel;
		$data['nickname'] = $tel;
		//$data['pwd'] = "md5(password(".$_POST['user_pw']."))";
		$data['tel'] = $tel;
		$pwd = $tel;
		$data['join_datetime'] = date("Y-m-d H:i:s");
		$data['ip'] = $_SERVER['REMOTE_ADDR'];
		$data['code'] = getCode();
		$data['grade'] = "n";
		$data['reg_dv'] = "w"; //pc 웹에서
		$data['etc_userid'] = ""; // 기타 아이디 (네이버 아이디 받기 )


		$que_ct = "
		Select Count(*) As Ct from $tb
		Where tel in ('$tel')
		";
		$cdata= dbQuery($que_ct, $dbc);
		$rs = mysql_fetch_assoc($cdata);

		$column = implode(",",array_keys($data));
		$mvalues = array_map('mysql_real_escape_string', array_values($data));
		$values  = implode("','", $mvalues);

		if($rs['Ct']=="0"){
			$qry = "
			Insert into $tb
			($column,pwd)
			values 
			('$values',md5(password('$pwd')))
			";
			dbQuery($qry, $dbc);
			
		}
		
		$t++;
	} 
} 
echo "<br><b>total : ".number_format($t);
?>