<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head.html');

if($_GET['dep']){
	include(BASE_DIR.'inc/html/sub_'.$_GET['dep'].'.html');
}

if($_GET['dep']=="1"){
?>
		<h1>분석 시스템 소개</h1>
			<div style="margin-bottom:30px"><img src="http://image.mrlotto.co.kr/sub1_img.jpg"></div>
			<div><img src="http://image.mrlotto.co.kr/sub1_banner.jpg"></div>
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
	
?>
<script type="text/javascript">
$(document).ready(function(){

});
function orders(good,price,grade){
<?
	if(!$_SESSION['userid']){
?>
	var result = confirm('회원전용 상품입니다.\n 로그인 페이지로 이동하시겠습니까??');
	if(result){
		top.location.href="/member/login.php?target=/info/sub.php?dep=2";
	}
	//alert('회원 전용 상품입니다.');
	return false;
<?
	} else {
?>
	alert("PG 연동 중입니다.");
	return false;

	var aUrl = "/member/pay_process.php";
	var form_data = {
		mem_code: "<?=$_SESSION[code]?>",
		g_code : good,
		pm_dv : "p",
		mode : "pay_ins",
		price : price,
		grade : grade
	};
	$.ajax({
		type	:	"POST",
		url		:	aUrl,
		data : form_data,
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
			
		},
		error: function(request, status, error) {
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
	return false;
	

<?
	}
?>
}
</script>
<?
if($_SESSION['userid']){
?>
<form id="order_form" name="order_form">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['userid']?>">
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
			if($ind1==0){
		?>
		<div class="sub2_ticket" id="premium1">
			<a href="javascript:;" onclick="javascript:orders('<?=$garr['Code']?>','<?=$garr['Real_Price']?>','<?=$garr['grade']?>')">조합 번호 받기</a>
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
					<a href="javascript:;" onclick="javascript:orders('<?=$garr['Code']?>','<?=$garr['Real_Price']?>','<?=$garr['grade']?>')">조합 번호 받기</a>
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
			?>
			<div class="sub2_gold" <? if($ind2=="1"){?>style="margin:-1px 0 50px 0"<? } ?>>
				<ul class="ticket_subject">
					<li><span><?=$garr2['Good_name']?></span> <?=$garr2['Title1']?></li>
					<li><?=$garr2['Title2']?><br><?=$garr2['Title3']?></li>
				</ul>
				<ul class="ticket_price">
					<li></li>
					<li><span class="percent"><?=$garr2['Rate']?></span>%<span class="before_price2">정상가<span><?=number_format($garr2['Price'])?>원</span></span><span class="after_price2">할인가<span><?=number_format($garr2['Real_Price'])?></span>원</span>
					<a href="javascript:;" onclick="javascript:orders('<?=$garr2['Code']?>','<?=$garr2['Real_Price']?>','<?=$garr2['grade']?>')">조합 번호 받기</a>
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
			?>
			<div class="sub2_silver"  <? if($ind3=="1"){?>style="margin-top:2px" id="silver2"<? } else { ?>id="silver1"<?}?>>
				<ul class="ticket_subject">
					<li><span><?=$garr3['Good_name']?></span> <?=$garr3['Title1']?></li>
					<li><?=$garr3['Title2']?><br><?=$garr3['Title3']?></li>
				</ul>
				<ul class="ticket_price">
					<li></li>
					<li><span class="percent"><?=$garr3['Rate']?></span>%<span class="before_price2">정상가<span><?=number_format($garr3['Price'])?>원</span></span><span class="after_price2">할인가<span><?if($ind3=="1"){?>&nbsp;&nbsp;&nbsp;<?}?><?=number_format($garr3['Real_Price'])?></span>원</span>
					<a href="javascript:;" onclick="javascript:orders('<?=$garr3['Code']?>','<?=$garr3['Real_Price']?>','<?=$garr3['grade']?>')">조합 번호 받기</a>
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
					<a href="javascript:;" onclick="javascript:orders('<?=$garr4['Code']?>','<?=$garr4['Real_Price']?>','<?=$garr4['grade']?>')">조합 번호 받기</a>
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
