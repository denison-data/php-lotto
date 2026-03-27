<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');

if($_GET['dep']){
	include(BASE_DIR.'inc/html/sub_'.$_GET['dep'].'.html');
}


if($_GET['dep']=="1"){
?>
			<h1>분석 시스템 소개</h1>
			<div style="margin-bottom:30px;position: relative"><img src="http://image.mrlotto.co.kr/sub1_img1.jpg">
				<div style="position: absolute;bottom:105px;left:235px"><a href="/member/join.php" style="cursor: pointer"><img src="http://image.mrlotto.co.kr/sub1bt.jpg"></a></div>
			</div>
			<div><img src="http://image.mrlotto.co.kr/sub1_banner1.jpg"></div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->
<?
} else if($_GET['dep']=="2"){
	$_G01 = getGoods('1','asc');
	$_G02 = getGoods('2','asc');
	$_G03 = getGoods('3','asc');
	$_G04 = getGoods('4','asc');
	$merchantKey = $nicepay_key;
	$merchantID       = $merchantID;                           // 상점아이디


	$ediDate = date("YmdHis");
	$ip = $_SERVER['REMOTE_ADDR'];   
	//$price = 449000;
	//$hashString = bin2hex(hash('sha256', $ediDate.$merchantID.$price.$merchantKey, true));

	//$moid = "mnoid1234567890";                      // 상품주문번호
	
?>
<script src="https://web.nicepay.co.kr/flex/js/nicepay_tr_utf.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	NicePayUpdate();	
	
});
function orders(good,price,grade, hasingData, gname, sout){
	if(sout=="y"){
		alert('현재는 판매중이 이납니다\n 품절되었습니다');
		return false;
	} else {

<?
	if(!$_SESSION['userid']){
?>
	var result = confirm('회원전용 상품입니다.\n 로그인 페이지로 이동하시겠습니까??');
	if(result){
		top.location.href="/member/login.php?target=<?=$_SERVER['REQUEST_URI']?>";
	}
	//alert('회원 전용 상품입니다.');
	return false;
<?
	} else {
		//if($_GET['gtype']=="dev"){
?>
	var payForm = document.order_form;
//	Amt
//	GoodsName
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
	goPay(payForm);
	return false;
<?
		//} else {
?>
	//alert("PG 연동 중입니다.");
	//return false;
<?
	//	}

	}
?>
	}
}
function nicepayClose(){
    alert("결제가 취소 되었습니다");
}
function nicepaySubmit(){
	var aUrl = "/member/pay_process.php";
	$("#mode").val("pay_ins");
	var params = $("#order_form").serialize(); 
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
<form id="order_form" name="order_form" >
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['userid']?>">
<input type="hidden" name="g_code" id="g_code">
<input type="hidden" name="price" id="price">
<input type="hidden" name="grade" id="grade">
<input type="hidden" name="mem_code" id="mem_code" value="<?=$_SESSION['code']?>">
<input type="hidden" name="pm_dv" id="pm_dv" value="p">


<!-- 상품 갯수 -->

<input type="hidden" name="PayMethod" value="CARD,BANK">

 <input type="hidden" name="GoodsName" id="GoodsName">
 <input type="hidden" name="GoodsCnt" value="1">
 <input type="hidden" name="Amt" id="Amt">
 <input type="hidden" name="BuyerName" value="<?=$_SESSION['nickname']?>">
 <input type="hidden" name="BuyerTel" value="<?=$_SESSION['tel']?>">
 <input type="hidden" name="Moid" id="Moid">
 <input type="hidden" name="MID" value="<?=$merchantID?>">
	

<!-- IP -->
<input type="hidden" name="UserIP" value="<?=$ip?>"/>                         <!-- 회원사고객IP -->

<!-- 옵션 -->
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
	
		<h1>상품 소개</h1>
		<div class="sub2_title">문자서비스는 매주 목요일 오후 6시에 발송됩니다.<br>문자발송서비스(SMS,MMS)는 전산오류 (핸드폰기종/스팸설정/통신사사정)으로 문자 미전송될 수 있습니다. <br>본서비스 이용자는 매주 전송하는 서비스 최종확인은 MRLOTTOC사이트 - [마이페이지] - [내 조합 내역] 에서 확인하여야 할 의무가 있습니다. <br>
문자 미전송과 관련하여 미스터퀀트 주식회사는 어떠한 법적책임도 지지 않음을 알려드립니다. (이용약관 3장 11조 10항)</div>
		<?
		$ind1 = 0;
		foreach($_G01 as $gno => $garr){
			$hashDt1 = bin2hex(hash('sha256', $ediDate.$merchantID.$garr['Real_Price'].$merchantKey, true));
			if($ind1==0){
				
		?>
		<div class="sub2_ticket" id="premium1">
			<a href="javascript:;" onclick="javascript:orders('<?=$garr['Code']?>','<?=$garr['Real_Price']?>','<?=$garr['grade']?>','<?=$hashDt1?>','<?=$garr['Good_name']?> <?=$garr['Title1']?>','<?=$garr['Sout']?>')">조합 번호 받기</a>
			<div class="ticket_subject">
				<h2><span><?=$garr['Good_name']?></span> <?=$garr['Title1']?></h2>
				<p><?=$garr['Title2']?></p>
				<p><?=$garr['Title3']?></p>
				<div class="price">
					<span class="before_price">정상가<span><?=number_format($garr['Price'])?>원</span></span>
					<span class="after_price">할인가<span><?=number_format($garr['Real_Price'])?></span>원</span>
				</div>
			</div>
		</div>
		<?
			} else {
		?>
		<div class="sub2_contents">
			<!--premium 1 year-->
			<div class="sub2_premium"  id="premium2">
				<ul class="ticket_subject">
					<li><span><?=$garr['Good_name']?></span> <?=$garr['Title1']?></li>
					<li><?=$garr['Title2']?><br><?=$garr['Title3']?></li>
				</ul>
				<ul class="ticket_price">
					<li></li>
					<li><span class="percent"><?=$garr['Rate']?></span>%<span class="before_price2">정상가<span><?=number_format($garr['Price'])?>원</span></span><span class="after_price2">할인가<span><?=number_format($garr['Real_Price'])?></span>원</span>
					<a href="javascript:;" onclick="javascript:orders('<?=$garr['Code']?>','<?=$garr['Real_Price']?>','<?=$garr['grade']?>','<?=$hashDt1?>','<?=$garr['Good_name']?> <?=$garr['Title1']?>','<?=$garr['Sout']?>')">조합 번호 받기</a>
					</li>
				</ul>
			</div>
			<?
				}
			?>

			<?
				$ind1++;
			}
			?>
		
		
			
			<!--gold 2 year-->
			<?
			$ind2 = 0;
			foreach($_G02 as $gno2 => $garr2){
				$hashDt2 = bin2hex(hash('sha256', $ediDate.$merchantID.$garr2['Real_Price'].$merchantKey, true));
			
			?>
			<div class="sub2_gold" <? if($ind2=="1"){?>style="margin:-1px 0 50px 0"<? } ?>>
				<ul class="ticket_subject">
					<li><span><?=$garr2['Good_name']?></span> <?=$garr2['Title1']?></li>
					<li><?=$garr2['Title2']?><br><?=$garr2['Title3']?></li>
				</ul>
				<?
				if($garr2['Sout']=="y"){
				?>
				<div style="position: absolute; top:0; left:0; background-color: #111;width:100%; height:100%; opacity: 0.75;z-index: 999;">
				</div>
				<img src="http://image.mrlotto.co.kr/mobile/soldout.png" style="position: absolute;top:10px; left:42%;z-index: 9999;">
				<?
				}
				?>
				<ul class="ticket_price">
					<li></li>
					<li><span class="percent"><?=$garr2['Rate']?></span>%<span class="before_price2">정상가<span><?=number_format($garr2['Price'])?>원</span></span><span class="after_price2">할인가<span><?=number_format($garr2['Real_Price'])?></span>원</span>
					<a href="javascript:;" onclick="javascript:orders('<?=$garr2['Code']?>','<?=$garr2['Real_Price']?>','<?=$garr2['grade']?>','<?=$hashDt2?>','<?=$garr2['Good_name']?> <?=$garr2['Title1']?>','<?=$garr2['Sout']?>')">조합 번호 받기</a>
					</li>
				</ul>
			</div>	
			<?
				$ind2++;
			}
			?>
			
			<?
			$ind3 = 0;
			foreach($_G03 as $gno3 => $garr3){
				$hashDt3 = bin2hex(hash('sha256', $ediDate.$merchantID.$garr3['Real_Price'].$merchantKey, true));
			
			?>
			<div class="sub2_silver"  <? if($ind3=="1"){?>style="margin-top:2px" id="silver2"<? } else { ?>id="silver1"<?}?>>
				
					
				<ul class="ticket_subject">
					<li><span><?=$garr3['Good_name']?></span> <?=$garr3['Title1']?></li>
					<li><?=$garr3['Title2']?><br><?=$garr3['Title3']?></li>
				</ul>
				<?
				if($garr3['Sout']=="y"){
				?>
				<div style="position: absolute; top:0; left:0; background-color: #111;width:100%; height:100%; opacity: 0.75;z-index: 999;">
				</div>
				<img src="http://image.mrlotto.co.kr/mobile/soldout.png" style="position: absolute;top:10px; left:42%;z-index: 9999;">
				<?
				}
				?>
				<ul class="ticket_price">
					<li></li>
					<li><span class="percent"><?=$garr3['Rate']?></span>%<span class="before_price2">정상가<span><?=number_format($garr3['Price'])?>원</span></span><span class="after_price2">할인가<span><?if($ind3=="1"){?>&nbsp;&nbsp;&nbsp;<?}?><?=number_format($garr3['Real_Price'])?></span>원</span>
					<a href="javascript:;" onclick="javascript:orders('<?=$garr3['Code']?>','<?=$garr3['Real_Price']?>','<?=$garr3['grade']?>','<?=$hashDt3?>','<?=$garr3['Good_name']?> <?=$garr3['Title1']?>','<?=$garr3['Sout']?>')">조합 번호 받기</a>
					</li>
				</ul>
			</div>
			<?
				$ind3++;
			}
			?>
			
			<?
			$ind4 = 0;
			foreach($_G04 as $gno4 => $garr4){
				$hashDt4 = bin2hex(hash('sha256', $ediDate.$merchantID.$garr4['Real_Price'].$merchantKey, true));
			
			?>
			<div class="sub2_extend"   style="margin-top:50px" id="extend">
				<ul class="ticket_subject">
					<li><span><?=$garr4['Good_name']?></span> <?=$garr4['Title1']?></li>
					<p><?=$garr4['Title2']?></p>
					<p><?=$garr4['Title3']?></p>
				</ul>
				<ul class="ticket_price2">
					<li></li>
					<li><span class="percent"><?=$garr4['Rate']?></span>%<span class="before_price2">정상가<span>&nbsp;&nbsp;<?=number_format($garr4['Price'])?>원&nbsp;</span></span><span class="after_price2">할인가<span>&nbsp;&nbsp;&nbsp;<?=number_format($garr4['Real_Price'])?></span>원</span>
					<a href="javascript:;" onclick="javascript:orders('<?=$garr4['Code']?>','<?=$garr4['Real_Price']?>','<?=$garr4['grade']?>','<?=$hashDt4?>','<?=$garr4['Good_name']?> <?=$garr4['Title1']?>','<?=$garr4['Sout']?>')">조합 번호 받기</a>
					</li>
				</ul>
			</div>
			<?
				$ind4++;
			}
			?>
			
		</div>
	</div>
	<!--sub contents end-->
</div>
<!--sub title end-->
<?
}
?>
<?
include(BASE_DIR.'inc/html/foot.html');

?>
