<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');

$param_url = $_SERVER['REQUEST_URI'];
$param_url = str_replace("?","|:|",$param_url);
$param_url = str_replace("&","|::|",$param_url);

if($_GET['dep']=="1"){
	include(BASE_DIR.'inc/html/head_m_report.html');
	
?>
<div>
	<img src="http://<?=$img_url?>/mobile/sub1.jpg">
	<a href="<?=$mobile_dir?>/info/sub.php?dep=2"><img src="http://<?=$img_url?>/mobile/bt.jpg"></a>
</div>
<img src="http://<?=$img_url?>/mobile/sub1_banner.jpg">
<?
} else if($_GET['dep']=="2"){
	$_G01 = getGoods('1','asc');
	$_G02 = getGoods('3','asc','SI3'); //실버회원권 1년제
	
	$_G03 = getGoods('3','asc','SI1'); //실버
	$_G04 = getGoods('4','asc','JD1'); //회원권
	$authResultCode          = $_REQUEST['AuthResultCode'];  // 인증결과 : 0000(성공)
	$authResultMsg           = $_REQUEST['AuthResultMsg'];   // 인증결과 메시지
	
		/*결제 성공*/
		if($_GET['gtype']=="dev"){
		
		}
	if($authResultCode == '0000'){
		require_once '../../inc/pay/mobile/lib/NicepayLite.php';
		$nicepay                  = new NicepayLite;
		$MerchantKey              = $nicepay_key; // 상점키
		$nicepay->m_NicepayHome   = "/data/www/lotto/paylog/";               // 로그 디렉토리 설정
		$nicepay->m_ActionType    = "PYO";                  // ActionType
		$nicepay->m_charSet       = "UTF8";                 // 인코딩
		$nicepay->m_ssl           = "true";                 // 보안접속 여부
		$nicepay->m_Price         = $Amt;                   // 금액
		$nicepay->m_NetCancelAmt  = $Amt;                   // 취소 금액
		$nicepay->m_NetCancelPW   = "123456";               // 결제 취소 패스워드 설정   

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

		$paySuccess = false;
		if($PayMethod == "CARD"){
			if($resultCode == "3001") $paySuccess = true;  $pay_type = "card"; // 신용카드(정상 결과코드:3001)
		}else if($PayMethod == "BANK"){
			if($resultCode == "4000") $paySuccess = true;   $pay_type = "bank"; // 계좌이체(정상 결과코드:4000)
		}else if($PayMethod == "CELLPHONE"){
			if($resultCode == "A000") $paySuccess = true;   $pay_type = "phone";// 휴대폰(정상 결과코드:A000)
		}else if($PayMethod == "VBANK"){
			if($resultCode == "4100") $paySuccess = true;   $pay_type = "gasa";// 가상계좌(정상 결과코드:4100)
		}else if($payMethod == "SSG_BANK"){
			if($resultCode == "0000") $paySuccess = true;	// SSG은행계좌(정상 결과코드:0000)
		}
		
	
		if($paySuccess == true){
			$MallReserved = $_POST['MallReserved'];
			$mem_data = explode("||",$MallReserved);
			$data["Order_No"] = $_POST['Moid'];
			$data['mem_code'] = $mem_data[4];
			$data['g_code'] = $mem_data[2];
			$data["Order_No"] = $_POST['Moid'];
			$data['Order_Date'] = time();
			if($pay_type=="gasa"){
				$data['Order_State'] = 'n';
				$data['bank_order'] = "";
				$data['gasang_name'] = $nicepay->m_ResultData['VbankBankName'];
				$data['gasang_no'] = $nicepay->m_ResultData['VbankNum'];
				$data['gasang_kname'] = $nicepay->m_ResultData['VbankBankName'];
				
			} else {
				if($pay_type=="bank"){
					$data['gasang_name'] = $nicepay->m_ResultData['BankName'];
					$data['gasang_no'] = $nicepay->m_ResultData['BankCode'];
					$data['gasang_kname'] = $nicepay->m_ResultData['RcptType'];
				} else {
					$data['gasang_name'] = $nicepay->m_ResultData['CardName'];
					$data['gasang_no'] = $nicepay->m_ResultData['CardNo'];
					$data['gasang_kname'] = $nicepay->m_ResultData['CardName'];
				}
				$data['Order_State'] = 'y';
			}
			$g_que = "Select grade from member Where code in ('".$mem_data[4]."')";
			
			$gres	=	dbQuery($g_que, $dbc);
			$gseq	=	mysql_result($gres, 0, 0);

			$data['m_grade'] = $gseq; //등급
			$data['ip_addr'] = $_SERVER['REMOTE_ADDR'];
			$data['State']="n"; //종료여부임
			$data['Pay_Type'] = $pay_type;
			$data['pm_division'] = "m";
			$data['total_price'] = $mem_data[0];
			$data['order_tid'] = $nicepay->m_ResultData['TID'];
			
			$his_data = ordrGoods($mem_data[4]);
			if($his_data){
				$max = max(array_keys($his_data));
				$data['his_Order_No'] = $his_data[$max]['Order_No'];
			}
			$cts_que = "
			Select Count(*) from member Where 1=1 And code in ('$mem_data[4]') And grade in ('n')
			";
			$cdatas	=	dbQuery($cts_que, $dbc);
			$cout	=	mysql_result($cdatas, 0, 0);
			/*시작일 종료일 입력*/

			$w = date("w");
			$g_que = "
			Select * from v_goods
			Where Code in ('".$mem_data[2]."')
			";
			$gdata = dbQuery($g_que,$dbc);
			$grows = mysqli_fetch_array($gdata);

			$peroid = $grows['Peroid'];
			
			$od_que = "
			Select COunt(*) from v_order_list Where 1=1 And mem_code in ('$mem_data[4]')
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
				Select * from v_order_list Where 1=1 And mem_code in ('$mem_data[4]') And Order_State in ('y')
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
					Update member set grade = '$mem_data[3]' 
					Where 1=1 And code in ('$mem_data[4]') And grade in ('n') 
					";
					dbQuery($ups_mque, $dbc);
				}
				echo "<script>alert('정상 결제가 되었습니다.');</script>";

			} else {
				
			
			}
			dbClose($dbc);
			
		}

	} else {
		$resultCode = $authResultCode;
		$resultMsg = $authResultMsg;
	}
?>
<script type="text/javascript">
$(document).ready(function(){


});
function orders(good,price,grade, hasingData, gname){
<?
	if(!$_SESSION['userid']){
?>
	var result = confirm('회원전용 상품입니다.\n 로그인 페이지로 이동하시겠습니까??');
	if(result){
		top.location.href="<?=$mobile_dir?>/member/login.php?target=<?=$_SERVER['REQUEST_URI']?>";
	}
	//alert('회원 전용 상품입니다.');
	return false;

<?
} else {
	//if($_GET['gtype']=="dev"){
?>
	var payForm = document.order_form;
	console.log(price);
	$("#Amt").val(price);
	$("#GoodsName").val(gname);
	$("#vExp").val(getTomorrow());
	$("#encdata").val(hasingData);
	$("#g_code").val(good);
	$("#price").val(price);
	$("#grade").val(grade);

	var times = "<?=date('ymdHis')?>";
	var getCode = kgen();
	var odcode = "ORD_"+good+"_"+getCode+"_"+times;
	
	$("#Moid").val(odcode);
	var MallReserved = price+"||"+gname+"||"+good+"||"+grade+"||<?=$_SESSION[code]?>";
	$("#MallReserved").val(MallReserved)
	$("#order_form").attr("action","https://web.nicepay.co.kr/v3/smart/smartPayment.jsp");
	
	$("#order_form").attr("target","_self");
	$("#order_form").submit();
	$("#order_form").attr("accept-charset","euc-kr");
	
	//target="_self" action="https://web.nicepay.co.kr/v3/smart/smartPayment.jsp" accept-charset="euc-kr"

<?
	//} else {
?>

	//alert("PG 연동 준비중입니다.");
	//return false;
<?
	//}
}
?>
}
function nicepaySubmit(){
	var aUrl = "<?=$mobile_dir?>/member/pay_process.php";
	$("#mode").val("pay_ins");
	var params = $("#order_form").serialize(); 
	console.log(params);
	return false;
	$.ajax({
		type	:	"POST",
		url		:	aUrl,
		data : params,
		dataType : "json",
		async: false,
		cache: false,
		success : function(data){
			console.log(data);
			
			if(data['status']=="0"){
				alert('정상 결제가 되었습니다.');
			} else {
				alert('결제 실패되었습니다.');
			}
			$("#nice_layer").hide();
			$("#bg_layer").hide();
			
		},
		error: function(request, status, error) {
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
	return false;
}
function kgen(){
	var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
function getTomorrow(){
    var today = new Date();
    var yyyy = today.getFullYear().toString();
    var mm = (today.getMonth()+1).toString();
    var dd = (today.getDate()+1).toString();
    if(mm.length < 2){mm = '0' + mm;}
    if(dd.length < 2){dd = '0' + dd;}
    return (yyyy + mm + dd);
}
</script>
<?
if($_SESSION['userid']){
?>
<form id="order_form" method="post" name="order_form" accept-charset="euc-kr">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['userid']?>">
<input type="hidden" name="g_code" id="g_code">
<input type="hidden" name="price" id="price">
<input type="hidden" name="grade" id="grade">
<input type="hidden" name="mem_code" id="mem_code" value="<?=$_SESSION['code']?>">
<input type="hidden" name="pm_dv" id="pm_dv" value="m">

<input type="hidden" name="MallReserved" id="MallReserved">

<input type="hidden" name="GoodsName" id="GoodsName">
<input type="hidden" name="GoodsCnt" value="1">
<input type="hidden" name="Amt" id="Amt">
<input type="hidden" name="BuyerName" value="<?=$_SESSION['nickname']?>">
<input type="hidden" name="BuyerTel" value="<?=$_SESSION['tel']?>">
<input type="hidden" name="Moid" id="Moid">
<input type="hidden" name="MID" value="<?=$merchantID?>">

<input type="hidden" name="PayMethod" value="CARD">

<!-- IP -->
<input type="hidden" name="UserIP" value="<?=$ip?>"/>                         <!-- 회원사고객IP -->

<!-- 옵션 -->
<input type="hidden" name="ReturnURL" value="http://<?=$hostname?><?=$_SERVER['REQUEST_URI']?>"/>
<input type="hidden" name="CharSet" value="utf-8"/>

<input type="hidden" name="VbankExpDate" id="vExp"/>                          <!-- 가상계좌입금만료일 -->
<input type="hidden" name="BuyerEmail" value="<?=$_SESSION['email']?>"/>             <!-- 구매자 이메일 -->				  
<input type="hidden" name="TransType" value="0"/>                             <!-- 일반(0)/에스크로(1) --> 
<input type="hidden" name="GoodsCl" value="0"/>                               <!-- 상품구분(실물(1),컨텐츠(0)) -->               

<!-- 변경 불가능 -->
<input type="hidden" name="EncodeParameters" value=""/>                       <!-- 암호화대상항목 -->
<input type="hidden" name="EdiDate" value="<?=$ediDate?>"/>                   <!-- 전문 생성일시 -->
<input type="hidden" name="EncryptData" id="encdata"/>            <!-- 해쉬값	-->
<input type="hidden" name="TrKey" value=""/>         


</form>
<?
}
?>
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/product_tit.jpg"></h2>
	<p>문자서비스는 매주 목요일 오후 6시에 발송됩니다.
문자발송서비스(SMS,MMS)는 전산오류 (핸드폰기종/스팸설정/통신사사정)으로 문자 미전송될 수 있습니다. 
<br>본 서비스 이용자는 매주 전송하는 서비스 최종확인은 MRLOTTOC사이트 - [마이페이지] - [내 조합 내역] 에서 확인하여야 할 의무가 있습니다. 
문자 미전송과 관련하여 케이큐는 어떠한 법적책임도 지지 않음을 알려드립니다. (이용약관 3장 11조 10항)</p>
</div>

	<div class="contents">
		<?
		$ind1 = 0;
		foreach($_G01 as $gno => $garr){
			$hashDt1 = bin2hex(hash('sha256', $ediDate.$merchantID.$garr['Real_Price'].$merchantKey, true));
			if($ind1==0){
				
		?>
		<div class="pro1">
			<img src="http://<?=$img_url?>/mobile/ticket1.jpg">
			<a href="javascript:;" onclick="javascript:orders('<?=$garr['Code']?>','<?=$garr['Real_Price']?>','<?=$garr['grade']?>','<?=$hashDt1?>','<?=$garr['Good_name']?> <?=$garr['Title1']?>')"><img src="http://<?=$img_url?>/mobile/ticket2_bt.jpg"></a>
		</div>
		<?
			} else {
		?>
		<div class="pro2">
			<img src="http://<?=$img_url?>/mobile/ticket2.jpg" id="pro2">
			<a href="javascript:;" onclick="javascript:orders('<?=$garr['Code']?>','<?=$garr['Real_Price']?>','<?=$garr['grade']?>','<?=$hashDt1?>','<?=$garr['Good_name']?> <?=$garr['Title1']?>')"><img src="http://<?=$img_url?>/mobile/ticket2_bt.jpg" ></a>
		</div>
		<? }
			$ind1++;
		} ?>

		<div class="pro3"  id="pro3">

			<img src="http://<?=$img_url?>/mobile/ticket3.jpg">
			<?
			$ind2 = 0;
			foreach($_G02 as $gno2 => $garr2){
				$hashDt2 = bin2hex(hash('sha256', $ediDate.$merchantID.$garr2['Real_Price'].$merchantKey, true));
			
			?>
			<a href="javascript:;" onclick="javascript:orders('<?=$garr2['Code']?>','<?=$garr2['Real_Price']?>','<?=$garr2['grade']?>','<?=$hashDt2?>','<?=$garr2['Good_name']?> <?=$garr2['Title1']?>')" class="pro3_bt1"><img src="http://<?=$img_url?>/mobile/ticket3_bt.jpg"></a>
			<?
				$ind2++;
			}
			?>
			<!--
			<a href="javascript:alert('준비중입니다1');" class="pro3_bt2"><img src="http://<?=$img_url?>/mobile/ticket3_bt.jpg"></a>
			--->
			<!--a href="" class="pro3_bt2"><img src="http://image.mrlotto.co.kr/mobile/ticket3_bt.jpg"></a-->
			<?
			$ind3 = 0;
			foreach($_G03 as $gno3 => $garr3){
				$hashDt3 = bin2hex(hash('sha256', $ediDate.$merchantID.$garr3['Real_Price'].$merchantKey, true));
			
			?>
			<a href="javascript:;" onclick="javascript:orders('<?=$garr3['Code']?>','<?=$garr3['Real_Price']?>','<?=$garr3['grade']?>','<?=$hashDt3?>','<?=$garr3['Good_name']?> <?=$garr3['Title1']?>')" class="pro3_bt3"><img src="http://<?=$img_url?>/mobile/ticket3_bt.jpg"></a>		
			<?
				$ind3++;
			}
			?>
		</div>
		<div class="pro4"  id="pro4">
			<img src="http://<?=$img_url?>/mobile/ticket4.jpg">
			<?
			$ind4 = 0;
			foreach($_G04 as $gno4 => $garr4){
				$hashDt4 = bin2hex(hash('sha256', $ediDate.$merchantID.$garr4['Real_Price'].$merchantKey, true));
			
			?>
			<a href="javascript:;" onclick="javascript:orders('<?=$garr4['Code']?>','<?=$garr4['Real_Price']?>','<?=$garr4['grade']?>','<?=$hashDt4?>','<?=$garr4['Good_name']?> <?=$garr4['Title1']?>')"><img src="http://<?=$img_url?>/mobile/ticket4_bt.jpg"></a>
			<?
				$ind4++;
			}
			?>
		</div>
	</div>

<?
}
?>

<?
include(BASE_DIR.'inc/html/foot_m.html');

?>