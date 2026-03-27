<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
$dbc = dbOpen();
$mode = $_POST['mode'];
switch($mode){
	case "pay_ins"	: pay_insert();
	case "pay_ups"	: pay_update();
	case "pay_cancel"	: fc_pay_cancel();
	case "coupon_ups"	: fc_coupon_ups();
}
/*
gasa -> 가상계좌
bank -> 실시간 입금
card -> 카드결제
*/
function pay_update(){
	global $_SERVER, $dbc,$_SESSION;
	session_start();
	
}
function fc_pay_cancel(){
	global $_SERVER, $dbc,$_SESSION;
	session_start();
	$ord = $_POST['ono'];
	$sty = $_POST['sty'];
	
	$md = module_check();

	
	if($md['ck']==0){
		$tb = "order_info";
		$qry = "
		Update $tb set Order_State = '$sty'
		Where Order_No = '$ord'
		";
		
		$rs = dbQuery($qry, $dbc);
		if($rs){
			$json_data = array("result"=>true,'status'=>'0','OrdNo'=>$ord);	
		} else {
			$json_data = array("result"=>true,'status'=>'1');	
		}
		dbClose($dbc);
		
		echo json_encode($json_data);
		exit;
	}
}
function fc_coupon_ups(){
	global $_SERVER, $dbc,$_SESSION;
	session_start();
	$cpl_code = $_POST['ccode'];
	$mcode = $_POST['mcode'];
	
	$c_que = "
	Select * from v_coupon_list Where 1=1 And mem_code in ('$mcode') And cpl_code in ('$cpl_code')
	";
	$cdata =dbQuery($c_que, $dbc);
	$rows = mysqli_fetch_array($cdata);

	if($rows['cpl_using']=="u"){
		$json_data = array("result"=>true,"status"=>'1'); //이미 사용했다는 표시임
	} else {
		$ups = "
		Update coupon_list set use_datetime = NOW(), cpl_using='u'
		Where 1=1 And mem_code in ('$mcode') And cpl_code in ('$cpl_code')
		";
		dbQuery($ups, $dbc);
		$json_data = array("result"=>true,"status"=>'0');
		
		$dates = date("ymdHis");
		$data['mem_code'] = $mcode;
		$data['g_code'] = $rows['cp_target'];
		$data["Order_No"] = "ECD_".$data['g_code']."_".getCode()."_".$dates;
		$data['Order_Date'] = time();
		$data['Order_State'] = 'y';

		$g_que = "Select grade from member Where code in ('".$mcode."')";
		$gres	=	dbQuery($g_que, $dbc);
		$gseq	=	mysql_result($gres, 0, 0);

		$data['m_grade'] = $gseq; //등급
		$data['ip_addr'] = $_SERVER['REMOTE_ADDR'];
		$data['State']="n"; //종료여부임
		$data['Pay_Type'] =  "coupon";
		$data['pm_division'] = "m";
		$data['total_price'] = "0";

		$his_data = ordrGoods($mcode);
		if($his_data){
			$max = max(array_keys($his_data));
			$data['his_Order_No'] = $his_data[$max]['Order_No'];
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
		Where Code in ('".$rows['cp_target']."')
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
		} else {
			$ymds =date("Ymd");
			$od_que = "
			Select * from v_order_list Where 1=1 And mem_code in ('$mcode') And Order_State in ('y')
			ORDER BY Order_Date DESC
			Limit 1
			";
			$oddate = dbQuery($od_que,$dbc);
			$orows = mysqli_fetch_array($oddate);
			$his_start_date = $orows['Start_Date'];
			$his_end_date = $orows['Finish_Date'];
			
			if($ymds >= $his_start_date ){
				if($ymds <= $his_end_date){
					//echo "마감일 안에있음.<br>";
					$sdate = date("Ymd",strtotime("1 days", strtotime($his_end_date))); 
					$edate = date("Ymd",strtotime("$peroid month", strtotime($his_end_date))); 
				} else {
					//echo "마감일 미포함.<br>";
					$sdate = date("Ymd",strtotime("1 days", strtotime($ymds))); 
					$edate = date("Ymd",strtotime("$peroid month", strtotime($ymds)));
				}
			} else {
				//echo "$ymds || $his_start_date<br>";
				$sdate = date("Ymd",strtotime("1 days", strtotime($his_end_date))); 
				$edate = date("Ymd",strtotime("$peroid month", strtotime($his_end_date))); 
			}
			
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
		//echo $qry;
		dbQuery($qry, $dbc);

	}
	echo json_encode($json_data);
	exit;
}
function pay_insert(){
	global $_SERVER, $dbc,$_SESSION, $nicepay_key;
	session_start();
	$md = module_check($nicepay_key, $_POST['price']);
	echo json_encode(array($_POST));
	exit;
	if(!$md['pay_type']){ echo json_encode(array("result"=>true,'status'=>'3')); exit;}
	if($md['ck']==0){
		$dates = date("ymdHis");
		$data['mem_code'] = $_POST['mem_code'];
		$data['g_code'] = $_POST['g_code'];
		//$data["Order_No"] = "ORD_".$data['g_code']."_".getCode()."_".$dates;
		$data["Order_No"] = $_POST['Moid'];
		$data['Order_Date'] = time();
		if($md['pay_type']=="gasa"){
			$data['Order_State'] = 'n';
			$data['bank_order'] = "";
			$data['gasang_name'] = $md['vbankBankName'];
			$data['gasang_no'] = $md['vbanknum'];
			$data['gasang_kname'] = $md['vbankBankName'];
			
		} else {
			$data['Order_State'] = 'y';
		}
		$g_que = "Select grade from member Where code in ('".$_POST['mem_code']."')";
		$gres	=	dbQuery($g_que, $dbc);
		$gseq	=	mysql_result($gres, 0, 0);

		$data['m_grade'] = $gseq; //등급
		$data['ip_addr'] = $_SERVER['REMOTE_ADDR'];
		$data['State']="n"; //종료여부임
		$data['Pay_Type'] = $md['pay_type'];
		$data['pm_division'] = $_POST['pm_dv'];
		$data['total_price'] = $_POST['price'];
		$data['order_tid'] = $md['tid'];
		
		$his_data = ordrGoods($_POST['mem_code']);
		if($his_data){
			$max = max(array_keys($his_data));
			$data['his_Order_No'] = $his_data[$max]['Order_No'];
		}
		$cts_que = "
		Select Count(*) from member Where 1=1 And code in ('$_POST[mem_code]') And grade in ('n')
		";
		$cdatas	=	dbQuery($cts_que, $dbc);
		$cout	=	mysql_result($cdatas, 0, 0);
		/*시작일 종료일 입력*/

		$w = date("w");
		$g_que = "
		Select * from v_goods
		Where Code in ('".$_POST['g_code']."')
		";
		$gdata = dbQuery($g_que,$dbc);
		$grows = mysqli_fetch_array($gdata);

		$peroid = $grows['Peroid'];
		
		$od_que = "
		Select COunt(*) from v_order_list Where 1=1 And mem_code in ('$_POST[mem_code]')
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
		} else {
			$ymds =date("Ymd");
			$od_que = "
			Select * from v_order_list Where 1=1 And mem_code in ('$_POST[mem_code]') And Order_State in ('y')
			ORDER BY Order_Date DESC
			Limit 1
			";
			$oddate = dbQuery($od_que,$dbc);
			$orows = mysqli_fetch_array($oddate);
			$his_start_date = $orows['Start_Date'];
			$his_end_date = $orows['Finish_Date'];
			
			if($ymds >= $his_start_date ){
				if($ymds <= $his_end_date){
					//echo "마감일 안에있음.<br>";
					$sdate = date("Ymd",strtotime("1 days", strtotime($his_end_date))); 
					$edate = date("Ymd",strtotime("$peroid month", strtotime($his_end_date))); 
				} else {
					//echo "마감일 미포함.<br>";
					$sdate = date("Ymd",strtotime("1 days", strtotime($ymds))); 
					$edate = date("Ymd",strtotime("$peroid month", strtotime($ymds)));
				}
			} else {
				//echo "$ymds || $his_start_date<br>";
				$sdate = date("Ymd",strtotime("1 days", strtotime($his_end_date))); 
				$edate = date("Ymd",strtotime("$peroid month", strtotime($his_end_date))); 
			}
			
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

		$mem_tb = "member";
		/*문자 발송시 현 멤버를 업데이트 함*/
		$rs = dbQuery($qry, $dbc);
		if($rs){
			
			if($order_ct==0){
				/*처음 결제 상품후*/
				$ups_mque = "
				Update member set grade = '$_POST[grade]' 
				Where 1=1 And code in ('$_POST[mem_code]') And grade in ('n') 
				";
				dbQuery($ups_mque, $dbc);
			}
			$json_data = array("result"=>true,'status'=>'0');	
		} else {
			$json_data = array("result"=>true,'status'=>'1');	
		
		}
		dbClose($dbc);
		
		echo json_encode($json_data);
		exit;
		//$data['his_Order_No'] = 
		//print_r($qry);
		//print_r($_POST);
	}
}
function module_check($merchantKey, $Amt){
	/* 모듈 체크시 성공0 -> 실패 1*/
	global $_POST;
	require_once '../../inc/pay/mobile/lib/NicepayLite.php';
	
	$nicepay                  = new NicepayLite;
    $nicepay->m_NicepayHome   = "/data/www/lotto/paylog/";               // 로그 디렉토리 설정
    $nicepay->m_ActionType    = "PYO";                  // ActionType
    $nicepay->m_charSet       = "UTF8";                 // 인코딩
    $nicepay->m_ssl           = "true";                 // 보안접속 여부
    $nicepay->m_Price         = $Amt;                   // 금액
    $nicepay->m_NetCancelAmt  = $Amt;                   // 취소 금액
    $nicepay->m_NetCancelPW   = "lumi1004";             // 결제 취소 패스워드 설정   

    /*
    *******************************************************
    * <결제 결과 필드>
    *******************************************************
    */
    $nicepay->m_BuyerName     = $BuyerName;             // 구매자명
    $nicepay->m_BuyerEmail    = $BuyerEmail;            // 구매자이메일
    $nicepay->m_BuyerTel      = $BuyerTel;              // 구매자연락처
    //$nicepay->m_EncryptedData = $EncryptedData;         // 해쉬값
    $nicepay->m_GoodsName     = $GoodsName;             // 상품명
    $nicepay->m_GoodsCnt      = $m_GoodsCnt;            // 상품개수
    $nicepay->m_GoodsCl       = $GoodsCl;               // 실물 or 컨텐츠
    $nicepay->m_Moid          = $Moid;                  // 주문번호
    $nicepay->m_MallUserID    = $MallUserID;            // 회원사ID
    $nicepay->m_MID           = $MID;                   // MID
    $nicepay->m_MallIP        = $MallIP;                // Mall IP
    $nicepay->m_MerchantKey   = $MerchantKey;           // 상점키
    $nicepay->m_LicenseKey    = $MerchantKey;           // 상점키
    $nicepay->m_TransType     = $TransType;             // 일반 or 에스크로
    $nicepay->m_TrKey         = $TrKey;                 // 거래키
    $nicepay->m_PayMethod     = $PayMethod;             // 결제수단
    $nicepay->startAction();
        
    /*
    *******************************************************
    * <결제 성공 여부 확인>
    *******************************************************
    */	
    $resultCode = $nicepay->m_ResultData["ResultCode"];
	$payMethod = $nicepay->m_ResultData["PayMethod"];

	$vbankBankCode  = $nicepay->m_ResultData["vbankBankCode"];  // 가상계좌은행코드
	$vbankBankName  = $nicepay->m_ResultData["VbankBankName"];  // 가상계좌은행명
	$vbankNum       = $nicepay->m_ResultData["VbankNum"];       // 가상계좌번호
	$vbankExpDate   = $nicepay->m_ResultData["VbankExpDate"];   // 가상계좌입금예정일
		

	$paySuccess = false;
	if($payMethod == "CARD"){
		if($resultCode == "3001") $paySuccess = true;          $pay_type = "card";     // 신용카드(정상 결과코드:3001)
	}else if($payMethod == "BANK"){
		if($resultCode == "4000") $paySuccess = true;          $pay_type = "bank";     // 계좌이체(정상 결과코드:4000)
	}else if($payMethod == "CELLPHONE"){
		if($resultCode == "A000") $paySuccess = true;          $pay_type = "phone";     // 휴대폰(정상 결과코드:A000)
	}else if($payMethod == "VBANK"){
		if($resultCode == "4100") $paySuccess = true;          $pay_type = "gasa";      // 가상계좌(정상 결과코드:4100)
	}else if($payMethod == "SSG_BANK"){
		if($resultCode == "0000") $paySuccess = true;               // SSG은행계좌(정상 결과코드:0000)
	}
	
	//$rs = array("ck"=>"0","pay_type"=>$pay_type,"vbankBankName"=>$vbankBankName,"vbanknum"=>$vbankNum,"vbankBankName"=>$vbankBankName, "tid"=>$tid);
	$rs = $nicepay;
	return $rs;
}
/* 회원정보 리스트 insert -> 회원테이블 업데이트*/

/*
Array
(
    [mem_code] => 25C8X
    [g_code] => PR2
    [pm_dv] => p
    [mode] => pay_ins
    [price] => 449000
    [grade] => p
)

*/
?>