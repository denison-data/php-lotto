<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
$dbc = dbOpen();
$mode = $_GET['mode'];
switch($mode){
	case "mem_logins"	:	function_memck();	break; /*회원가입후 로그인처리*/
}
function function_memck()
{
	global $dbc,$sms_id, $sms_key, $sms_send_phone, $send_date;
	$req = "/data/www/lotto/";
	include($req."admin/inc/sms/api.class.php");
	$api = new gabiaSmsApi($sms_id, $sms_key);

	$code = $_GET['code'];
	
	$que = "
	Select * from member Where 1=1 And code in ('$code') 
	";
	
	$data= dbQuery($que, $dbc);
	$total = mysqli_num_rows();
	if($total==0){ echo "<script></script>인증 에러";} else {
		$row = mysqli_fetch_array($data);
		if($row['grade']=="i"){
			$upq = "
			Update member set grade = 'n' Where code in ('$code')
			";
			dbQuery($upq,$dbc);

			$sms_titles = "
			Select * from 
			lumieyes_lotto_intra.sms_send_txt
			Where sms_name in ('회원가입')
			";
			$sdata = dbQuery($sms_titles,$dbc);
			$srows = mysqli_fetch_array($sdata);
			$sms_title	=	$srows['sms_title'];
			$sms_txt	=	$srows['sms_txt'];
			$sms_txt = str_replace("Seq",$seq,$sms_txt);

			$codes= getCode(6);
			$p = $row['tel'];
			$message = str_replace("Name",$row['nickname'],$sms_txt);

			$r = $api->lms_send($p, $sms_send_phone, $message, $sms_title, $codes, $send_date);
			
		//	echo "<script>alert('인증되었습니다.');top.location.href=\"/\";</script>";

		} else {
		//	echo "<script>alert('이미 인증 받았습니다.');top.location.href=\"/\";</script>";
			lotto_create($code, $api);
		}
		
	}

}
function lotto_create($code, $api){

	$dbc = dbOpen('lottodb', 'lumieyes_lotto');
	
	$cur_seq = getCurSeq();
	$next_seq = $cur_seq + 1;
	$limit_count = 2;
	$recommend_tb = "recommend_{$next_seq}";
	
	$que = "SELECT * FROM {$recommend_tb} LIMIT {$limit_count} ";
	$res = dbQuery($que, $dbc);
	
	$tb = getBuyTbName($next_seq);
	
	$_BALL = array();
	while($row = mysql_fetch_assoc($res)) {
		$arr = str_split($row[cb], 12);
		foreach($arr as $balls){
			$_BALL[] = str_split($balls, 2);
		}
		$arrUid[] = $row[uid];
	}
	$uid_list = implode(',', $arrUid);

	//$que = "DELETE FROM {$recommend_tb} WHERE uid IN ({$uid_list})";
	//dbQuery($que,$dbc);
	
	$max = 10*$limit_count;

	$qct = "
	Select Count(*)  As Ct from lotto_sms_tmp 
	Where 1=1 And type = 'M' And code in ('$code')
	";
	
	$cdata2= dbQuery($qct, $dbc);
	$rs = mysql_fetch_assoc($cdata2);
	if($rs['Ct']!=0){
		for($i = 0; $i < $max; $i++ ) {
			$ms = floor($i/10);
			$que = "
				INSERT INTO 
					lotto_sms_tmp
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
					type = 'M',
					sms = 'n',
					reg_datetime = NOW(),
					l_uid = '{$arrUid[$ms]}'
			";
			//echo $que."<br>";
			//dbQuery($que,$dbc);
		}
		$que = "
		INSERT INTO lumieyes_lotto.{$tb} 
		Select '',
		lumieyes_lotto.b.uuid, lumieyes_lotto.b.code, lumieyes_lotto.b.seq, 
		lumieyes_lotto.b.b1, lumieyes_lotto.b.b2, lumieyes_lotto.b.b3,lumieyes_lotto.b.b4, lumieyes_lotto.b.b5,
		lumieyes_lotto.b.b6, lumieyes_lotto.b.rank, lumieyes_lotto.b.type, NOW(), 'y' from lotto_sms_tmp as b Where 1=1 And b.sms in ('n') And b.type in ('M')
		And b.code in ('$code')
		";
		//dbQuery($que,$dbc);

		$qry = "
		insert into lumieyes_lotto_sms.sms_".$tb."
		SELECT '',lumieyes_lotto.b.uuid, lumieyes_lotto.b.code, lumieyes_lotto.b.seq, 
		lumieyes_lotto.b.b1, lumieyes_lotto.b.b2, lumieyes_lotto.b.b3,lumieyes_lotto.b.b4, lumieyes_lotto.b.b5,
		lumieyes_lotto.b.b6, lumieyes_lotto.b.rank, lumieyes_lotto.b.type, NOW(), 'n',m.tel 
		from lumieyes_lotto.lotto_sms_tmp b left outer join 
		lumieyes_lotto.member m on b.code = m.code
		Where 1=1 And b.code in ('$code') And b.sms in ('n') And b.type in ('M')
		";
		//dbQuery($qry,$dbc);
		
		$upqry = "
		Update lumieyes_lotto.lotto_sms_tmp set sms='y' Where 1=1 And sms in ('n')
		And code in ('$code') And type in ('M')
		";
		//dbQuery($upqry, $dbc);

		$tbs = "lumieyes_lotto_sms.sms_".$tb;

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

		$qry = "
		Select tb.*, m.nickname 
		from $tbs tb left outer join 
		lumieyes_lotto.member m on tb.code = m.code
		Where 1=1 And tb.code in ('$code') And tb.sms in ('n')
		And tb.seq in ('$next_seq') And tb.type in ('M')
		";
		

		$data = dbQuery($qry, $dbc);
		while($row=mysqli_fetch_array($data)){
			
			$ldata[$row['tel']] .= "[".$row[b1].",".$row[b2].",".$row[b3].",".$row[b4].",".$row[b5].",".$row[b6]."]\n";
			$titles[$row['tel']] = $row['nickname'];
		}
		$upqry2 = "
		Update $tbs set sms='y' Where 1=1 And sms in ('n')
		And code in ('$code') And type in ('M')
		";
		//echo $upqry2;
		dbQuery($upqry2, $dbc);
		if($ldata){
			foreach($ldata as $p => $lotto){
				$code= getCode(6);
				$sms_txts = str_replace("Seq",$next_seq,$sms_txt);
				$message =str_replace("Data",$lotto,$sms_txts);
				$api->lms_send($p, $sms_send_phone, $message, $sms_title, $code, $send_date);
			}	
		}
		print_r($ldata);

	}
}

?>