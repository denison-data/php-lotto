<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
$dbc = dbOpen();
$mode = $_POST['mode'];
$ymd = date("Ymd");
switch($mode){
	case	"land_ins"		:	
		if($ymd>="20181212"){
			func_land_ins();
		} else {
			func_land_ins();	
		}
	break;
	case	"land_ins2"		:	
		func_land_ins2();	
	break;
}
function func_land_ins2(){
	global $_SERVER, $dbc, $_SESSION;
	header('Content-Type: application/json');
	$tel = trim($_POST['tel']);
	$tel = str_replace("-","",$tel);
	$data['etel'] =	$tel;
	$tb_m = "member";
	$tb = "data_member";
	$tb_m_a = "member_arr";
	$next_seq = getCurSeq()+1; //현재회차에서 1플러스
	$lotto_tb = getBuyTbName($next_seq);

	//$lotto_tb = "lotto_buy_830_dev";

	$data['ip'] = $_SERVER['REMOTE_ADDR'];
	$data['uid'] = 0;

	$cnt_que = "
	Select * from $tb_m 
	Where 1=1 And tel in ('$data[etel]') And retire not in ('d')
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
		$data['mdivision'] = "y";
	}

	$cnt_que2 = "
	Select Count(*) as ct from $tb_m_a
	Where 1=1 And code in ('$cd')
	";
	$r2 = dbQuery($cnt_que2,$dbc);
	$r2_c = mysql_result($r2,0,0);
	if($r2_c == 1){
		$cd = getCode();
	}

	$nowday = date("w");
	$nhour = date("H");
	
	$data['code'] = $cd;
	$data['page'] = $_POST['page'];
	$data['etc'] = $_POST['etc'];
	$data['history_url'] = $_POST['history_url'];
	$column = implode(",",array_keys($data));
	$mvalues = array_map('mysql_real_escape_string', array_values($data));
	$values  = implode("','", $mvalues);

	$cts = "
	Select Count(*) from $tb Where 1=1 And del_flag in ('n') And etel in ('$tel')
	";
	$u_data =dbQuery($cts, $dbc);
	$u_ct = mysql_result($u_data,0,0);

	if($tel=="01066669999"){ $u_ct=0;}
	if($u_ct==0){
		$qry = "
			Insert into $tb
			($column,regdate)
			values 
			('$values',NOW())
			";
		dbQuery($qry, $dbc);

		/*member table 추가 본*/
		if($tel=="01066669999"){
		} else {
			$data_m['userid'] = $tel;
			$data_m['nickname'] = $_POST['name'];
			$data_m['tel'] = $tel;
			$pwd = $tel;
			$data_m['join_datetime'] = date("Y-m-d H:i:s");
			$data_m['ip'] = $_SERVER['REMOTE_ADDR'];
			$data_m['code'] =$cd;
			$data_m['grade'] = "n"; // 인증여부->인증
			$data_m['reg_dv'] = "w"; //pc 웹에서
			$data_m['etc_userid'] = ""; // 기타 아이디 (네이버 아이디 받기 )
			$que_ct = "
			Select Count(*) As Ct from $tb_m
			Where tel in ('$tel')
			";
			$cdata= dbQuery($que_ct, $dbc);
			$rs = mysql_fetch_assoc($cdata);

			$column_m = implode(",",array_keys($data_m));
			$mvalues_m = array_map('mysql_real_escape_string', array_values($data_m));
			$values_m  = implode("','", $mvalues_m);
			if($rs['Ct']=="0"){
				$qry = "
				Insert into $tb_m
				($column_m,pwd)
				values 
				('$values_m',md5(password('$pwd')))
				";
				dbQuery($qry, $dbc);

				$g_code = "ME1";
				
					Order_ins($cd, $g_code);
					Sms_ins($cd, 1, $lotto_tb, $tb_m); //문자발송 막음 2018-12-26 11시 50분
					Sms_send($cd, $lotto_tb, $tb_m); //문자발송 막음 2018-12-26 11시 50분
				
			}
		}
		/*추가본 테스트*/
		$json_data = array("result"=>true,'status'=>'0');
	} else {
		$json_data = array("result"=>true,'status'=>'2'); //중복처리
	}
	echo json_encode($json_data);
	exit;
}
function Sms_send($code, $tb, $tb_m){
	global $sms_id, $sms_key, $sms_send_phone, $send_date, $dbc, $mDay,$mTime;
	set_time_limit(0);
	$req = "/data/www/lotto/";
	include($req."admin/inc/sms/api.class.php");
	$api = new gabiaSmsApi($sms_id, $sms_key);

	$tbs = "lumieyes_lotto_sms.sms_".$tb;
	$nowday = date("w");
	$nhour = date("H");
	$ns= $nowday.$nhour;
	$ms = $mDay.$mTime;

	if($ms>=$ns){
		$seq = getCurSeq()+1;
	} else {
		if($nowday=="6"){
			$seq = getCurSeq()+2;
		} else {
			$seq = getCurSeq()+1;
		}
	}

	

	$qry = "
	Select tb.*, m.nickname 
	from $tbs tb left outer join 
	lumieyes_lotto.".$tb_m." m on tb.code = m.code
	Where 1=1 And tb.seq in ('$seq') And tb.sms in ('n') And tb.type in ('D') And tb.code in ('$code')
	";
	$data = dbQuery($qry, $dbc);

	$sms_titles = "
	Select * from 
	lumieyes_lotto_intra.sms_send_txt
	Where sms_name in ('회원가입-문자발송')
	";
	$sdata = dbQuery($sms_titles,$dbc);
	$srows = mysqli_fetch_array($sdata);
	$sms_title	=	$srows['sms_title'];
	$sms_txt	=	$srows['sms_txt'];
	$sms_txt = str_replace("Seq",$seq,$sms_txt);

	$upQue ="
	Update $tbs set sms = 'y'
	Where 1=1 And seq in ('$seq') And sms in ('n') And type in ('D') And code in ('$code')
	";
	dbQuery($upQue, $dbc);
	
	$n = 1;
	while($row=mysqli_fetch_array($data)){
		if($n<=5){
			$ns = sprintf('%02d',$n);
			$ldata[$row['tel']] .= "F[".$ns."]".$row[b1].",".$row[b2].",".$row[b3].",".$row[b4].",".$row[b5].",".$row[b6]."\n";
			$titles[$row['tel']] = $row['nickname'];
			if($n%5==0){
				$ldata[$row['tel']] .= "\n";
			}
		}
		$n = $n+1;
	}
	$send_date = "0";
	if($ldata){
		foreach($ldata as $p => $lotto){
			$code= getCode(6);
			
			$sms_txts = str_replace("Name",$titles[$p],$sms_txt);
			$sms_txts =str_replace("Seq",$seq,$sms_txts);			
			$message =str_replace("Data",$lotto,$sms_txts);
			
			$r = $api->lms_send($p, $sms_send_phone, $message, $sms_title, $code, $send_date);
			//echo $message."\n";
		}
	}
	return;
}
function Sms_ins($code, $mcount, $tb, $tb_m){
	global $mDay,$mTime;
	$cur_seq = getCurSeq();
	$next_seq = $cur_seq + 1;

	$limit_count = $mcount;
	$recommend_tb = "recommend_{$next_seq}";
	$que = "SELECT * FROM {$recommend_tb} LIMIT {$limit_count}";
	$res = dbQuery($que, $dbc);

	$nowday = date("w");
	$nhour = date("H");
	$ns= $nowday.$nhour;
	$ms = $mDay.$mTime;

	if($ms>=$ns){
		$seq = getCurSeq()+1;
	} else {
		if($nowday=="6"){
			$seq = getCurSeq()+2;
		} else {
			$seq = getCurSeq()+1;
		}
	}
	
	
	$que_ct = "Select * from {$tb} Where code in ('$code') And seq in ('$seq') And type not in ('A')";
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
		//type -> D landing 페이지 등록

		$uid_list = implode(',', $arrUid);
		$que = "DELETE FROM lumieyes_lotto.{$recommend_tb} WHERE uid IN ({$uid_list})";
		dbQuery($que, $dbc);
		$max = 10*$mcount;
		for($i = 0; $i < $max; $i++ ) {
			$que = "
				INSERT INTO 
					lumieyes_lotto.{$tb} 
				SET
					uuid = '{$_MEMBER[uuid]}',
					code = '{$code}',
					seq = '{$seq}',
					b1 = '{$_BALL[$i][0]}',
					b2 = '{$_BALL[$i][1]}',
					b3 = '{$_BALL[$i][2]}',
					b4 = '{$_BALL[$i][3]}',
					b5 = '{$_BALL[$i][4]}',
					b6 = '{$_BALL[$i][5]}',
					type = 'D',
					sms = 'n',
					reg_datetime = NOW()
			";
			
			dbQuery($que, $dbc);
		}
	}

	
	$up_que = "
	Update lumieyes_lotto.$tb set sms='y' 
	Where 1=1 And seq in ('$seq') And code in ('$code')
	";
	dbQuery($up_que);

	$ct_que = "
	Select Count(*) from lumieyes_lotto_sms.sms_".$tb."
	Where 1=1 And seq in ('$seq') And type in ('D') And code in ('$code')
	";
	$res = dbQuery($ct_que);
	$cts	=	mysql_result($res, 0, 0);
	
	if($cts==0){
		$qry = "
		insert into lumieyes_lotto_sms.sms_".$tb."
		SELECT 
		 '',
		 lumieyes_lotto.b.uuid,
		 lumieyes_lotto.b.code,
		 lumieyes_lotto.b.seq,
		 lumieyes_lotto.b.b1,
		 lumieyes_lotto.b.b2,
		 lumieyes_lotto.b.b3,
		 lumieyes_lotto.b.b4,
		 lumieyes_lotto.b.b5,
		 lumieyes_lotto.b.b6,
		 lumieyes_lotto.b.rank,
		 lumieyes_lotto.b.type,
		 lumieyes_lotto.b.reg_datetime,
		 lumieyes_lotto.b.sms, 
		 m.tel
		from {$tb} b left outer join 
		$tb_m m on b.code = m.code
		Where 1=1 And b.seq in ('$seq') And b.type in ('D') and b.code in ('$code')
		";
		$data = dbQuery($qry, $dbc);
		$upQry = "
		Update lumieyes_lotto_sms.sms_".$tb." set sms='n'
		Where 1=1 And seq in ('$seq') And code in ('$code')
		";
		dbQuery($upQry, $dbc);
	}
	return;

}
function Order_ins($mcode, $g_code){
	global $mDay, $mTime;
	$dates = date("ymdHis");
	$data['mem_code'] = $mcode;
	$data['g_code'] = $g_code;
	$data["Order_No"] = "ORD_".$data['g_code']."_".getCode()."_".$dates;
	$data['Order_Date'] = time();
	$data['Order_State'] = 'y';
	$data['bank_order'] = "";
	$data['gasang_name'] = "";
	$data['gasang_no'] = "";
	$data['gasang_kname'] = "";
	$data['Pay_Type'] = "auto"; //자동화
	$g_que = "
	Select * from v_goods
	Where Code in ('".$g_code."')
	";
	$gdata = dbQuery($g_que,$dbc);
	$grows = mysqli_fetch_array($gdata);

	$peroid = $grows['Peroid'];
	$nowday = date("w");
	$nhour = date("H");
	$ns= $nowday.$nhour;
	$ms = $mDay.$mTime;

	if($ms>=$ns){
		$sdate = date("Ymd",strtotime("Thursday")); 
		$edate = date("Ymd",strtotime("$peroid month"));
	} else {
		$sdate = date("Ymd",strtotime("next week Thursday"));
		$edate = date("Ymd",strtotime("$peroid month", strtotime($sdate))); 
	}
	$data['Start_Date'] = $sdate;
	$data['Finish_Date'] = $edate;
	$column = implode(",",array_keys($data));
	$mvalues = array_map('mysql_real_escape_string', array_values($data));
	$values  = implode("','", $mvalues);
	$tb = "order_info";
	$qry = "
	Insert into $tb
	($column)
	values 
	('$values')
	";
	$rs = dbQuery($qry, $dbc);
	if($rs){
		return;
	}
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
	Where 1=1 And tel in ('$data[etel]') And retire not in ('d')
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
			$data['ename'] = str_replace("-","",$data['ename']);
		}
		$json_data = array("result"=>true,'status'=>'1');
		echo json_encode($json_data);
		exit;

	}else {
		$cd = getCode();
		$data['ename'] = $_POST['name'];
		$data['ename'] = str_replace("-","",$data['ename']);
		$data['mdivision'] = "n";
	}
	$nowday = date("w");
	$nhour = date("H");
	
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
	if($tel=="01066669999"){ $u_ct=0;}
	if($u_ct==0){
		$qry = "
			Insert into $tb
			($column,regdate)
			values 
			('$values',NOW())
			";
		dbQuery($qry, $dbc);
		
		$json_data = array("result"=>true,'status'=>'0','u_ct'=>$u_ct);
	} else {
		$json_data = array("result"=>true,'status'=>'2','u_ct'=>$u_ct); //중복처리
	}
	echo json_encode($json_data);
	exit;
}
?>