<?
/*필수 include*/
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
?>
<!doctype html>
<html lang="ko">
	<head>
		<title>미스터로또씨 리서치</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<style>
			html {padding:0; margin:0; font-family: 'noto sans','맑은고딕', sans-serif; background-color:#f8f8f8;letter-spacing: -1px;}
			
			.tit {font-size:24px;}
			
			.border1 {border:5px solid #eee; border-radius:10px}
			.border2 {border:10px solid #f8f8f8; border-radius:10px}
			.contents {background-color: #fff;padding:0 50px 70px 50px}
			
			.que {padding:70px 0;border-bottom:2px dotted #ddd}
			.quest table {width:100%}
			.quest table td:first-child {vertical-align: top;}
			.quest table td span {width:40px; height:28px; background-color: #111;color:#fff;border-radius: 5px; text-align: center;font-weight:500;font-size:13px !important;display: inline-block;line-height: 28px}
			.quest table td:last-child {padding-left:10px;font-weight:600;font-size:22px;vertical-align: top;line-height: 34px;}
			
			.answer {margin-top:20px;}
			.answer table {width:85%;margin:0 auto}
			.answer input[type=radio] {vertical-align: middle;}
			.answer label {padding-left:5px;font-size:20px;}
			
			.next-bt {text-align: center}
			.next-bt a {display: inline-block;width:280px; height:50px; color: #fff;background-color: #000;text-decoration: none;line-height:44px;font-size:20px;font-weight:600}
			
			.sns {text-align: center;margin:30px 0 70px 0;}
			.sns span {margin-right:10px}
			.sns span:last-child {margin-right:0}
			
			@media (max-width:768px){
				.tit {padding:25px 0 10px 25px}
				.tit img {width:40%}
				.tit span {padding-left:10px;font-size:16px;}
				.contents {background-color: #fff;padding:0 10px 70px 20px}
				.border1 {margin:0 10px}
				.border2 {border:7px solid #f8f8f8; }
				.que {padding:40px 0;}
				.quest table td:first-child {width:35px; height:28px; line-height:28px;font-size:14px}
				.quest table td:last-child {font-size:18px; line-height:28px;text-align: left}
				.answer {margin-top:10px;}
				.answer input[type=radio] {vertical-align: middle;}
				.answer table {width:100%;margin:0 auto;}
				.answer label {padding-left:3px;font-size:16px;vertical-align: middle;}
			}
			.h1 {font-size:34px;font-weight:600;text-align: center;padding-top:100px;padding-bottom:10px}
			.txt {font-size:18px; color:#666;text-align: center;line-height: 28px}
			.db {text-align: center; margin-top:50px}
			.db input {border:1px solid #ddd;width:500px; height:55px;font-size:15px;padding-left:15px;box-sizing: border-box;margin-bottom:5px}
			
			.ok-bt {margin-top:20px;margin-bottom:50px}
			.ok-bt a{display: inline-block;width:280px; height:44px; color: #fff;background-color: #1d51ac;text-decoration: none;line-height:44px;font-size:20px;font-weight:600}
			
			.sns {text-align: center;margin:30px 0 70px 0;}
			.sns span {margin-right:10px}
			.sns span:last-child {margin-right:0}
			
			@media (max-width:768px){
				.tit {padding:25px 0 10px 25px}
				.tit img {width:40%}
				.tit span {padding-left:10px;font-size:16px;}
				.contents {background-color: #fff;padding:0 10px 70px 20px}
				.border1 {margin:0 10px}
				.border2 {border:7px solid #f8f8f8; }
				.db input {width:80%;font-size:15px;}
				.ok-bt a{width:70%;}
			}
			.que:last-child {border-bottom:none}
		</style>
	</head>
<?
/*필수*/
include "./jquery.html";
?>		
<script type="text/javascript">
$(function(){
	var eetc;

	console.log($("#q3:checked").val());

	$("#q3-2-v").hide();
	$("#q4-txt-v").hide();
	
	$("input[name='q3-1']:radio").change(function(){
		if($(this).val()=="예")
		{
			$("#q3-2-v").show();
		} else {
			$("#q3-2-v").hide();
		}
	
	});
	$("input[name='q4-1']:radio").change(function(){
		if($(this).val()=="etc")
		{
			$("#q4-txt-v").show();
		} else {
			$("#q4-txt-v").hide();
		}
	
	});

	$("#v_1").show();
	$("#v_2").hide();
	$("#v_3").hide();
	$("#v_4").hide();
	$("#step1").on("click",function(){
		$("#v_1").hide();
		eetc = "Q1 : "+$("#q1:checked").val()+",";
		eetc = "Q1-1 : "+$("#q-1:checked").val()+",";
		eetc += " Q2 : "+$("#q2:checked").val()+",";
		eetc += " Q3 : "+$("#q3:checked").val()+",";
		eetc += " Q3-1 : "+$("#q3-1:checked").val()+",";

		if($("#q3-1:checked").val()=="아니요"){
			eetc += " Q3-2 : "+$("#q3-2:checked").val()+",";
		}
		//if($("#q3:checked").val()=="Yes"){
		$("#v_2").show();
		$("#v_3").hide();
		$("#v_4").hide();			
		//} else {
		//	$("#v_2").hide();
		//	$("#v_3").show();
		//	$("#v_4").hide();
		//}
		
	});

	$("#step2").on("click",function(){
		
		eetc += " Q4 : "+$("#q4:checked").val()+",";
		if($("#q4-1:checked").val()=="etc"){
			if($.trim($("#q4-txt").val()).length==0){
				alert('기타 입력이 되지 않았습니다');
				$("#q4-txt").focus();
				return false;
			} 
			eetc += " Q4-1 : "+$("#q4-txt").val()+",";
		
		} else {
			eetc += " Q4-1 : "+$("#q4-1:checked").val()+",";
		
		}
		eetc += " Q4-2 : "+$("#q4-2:checked").val()+"";
		eetc += " Q4-3 : "+$("#q4-3:checked").val()+"";
		//if($("#q7:checked").val()=="있음"){
			$("#txt1").html("더 이상 꿈만 꾸지 마세요.<br>당신의 꿈 미스터로또씨에서 현실이 됩니다!");
			$("#txt2").html("철저한 분석으로 예측된 최상의 로또조합! 미스터로또씨에서 받아보세요");

//			$("#txt1").html("질문에 답변해주셔서 감사합니다.");
//			$("#txt2").html("최적화된 프로그램을 통한 로또 예측을 원하신다면 지금 미스터로또씨를 만나보세요.");
		//} else {
		//	$("#txt1").html("더 이상 꿈만 꾸지 마세요.<br>당신의 꿈 미스터로또씨에서 현실이 됩니다!");
		//	$("#txt2").html("철저한 분석으로 예측된 최상의 로또조합! 미스터로또씨에서 받아보세요");
		//}
		$("#etc").val(eetc);
		$("#v_1").hide();
		$("#v_2").hide();
		$("#v_3").show();
		$("#v_4").hide();
	});
	$("#step3").on("click",function(){
		$("#v_1").hide();
		$("#v_2").hide();
		$("#v_3").hide();
		$("#v_4").show();
		eetc += " Q5 : "+$("#q5:checked").val()+",";
		eetc += " Q6 : "+$("#q6:checked").val()+"";
		eetc += " Q7 : "+$("#q6:checked").val()+"";
		eetc += " Q8: "+$("#q6:checked").val()+"";

		if($("#q9:checked").val()=="Yes"){
			$("#txt1").html("더 이상 꿈만 꾸지 마세요.<br>당신의 꿈 미스터로또씨에서 현실이 됩니다!");
			$("#txt2").html("철저한 분석으로 예측된 최상의 로또조합! 미스터로또씨에서 받아보세요");

//			$("#txt1").html("질문에 답변해주셔서 감사합니다.");
//			$("#txt2").html("최적화된 프로그램을 통한 로또 예측을 원하신다면 지금 미스터로또씨를 만나보세요.");
		} else {
			$("#txt1").html("더 이상 꿈만 꾸지 마세요.<br>당신의 꿈 미스터로또씨에서 현실이 됩니다!");
			$("#txt2").html("철저한 분석으로 예측된 최상의 로또조합! 미스터로또씨에서 받아보세요");

//			$("#txt1").html("질문에 답변해주셔서 감사합니다.");
//			$("#txt2").html("매주 추첨 확률이 높은 로또 조합을 미스터로또씨가 보내드립니다. 지금 체험해보세요.");
		}
		console.log(eetc);
		$("#etc").val(eetc);

	});
});
</script>
	<body style="max-width:900px; margin:0 auto">
		<div class="tit">
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%;padding-right:15px;">
				<tr>
					<td style="width:75%">행운 참여지수 리서치</td>
					<td style="text-align: right;padding-top:3px"><img src="http://mrlotto.co.kr/land/img/land2-img1-1008.jpg" style="width:100%"></td>
				</tr>
			</table>
		</div>
		<div class="border1">
			<div class="border2">
				<div class="contents" id="v_1">
					<div class="que">
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q1</span></td>
									<td>나이를 선택해 주십시요?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<? for($i=1;$i<=5;$i++){ ?>
									<td><input type="radio" id="q1" name="q1" value="<?=$i?>0대" <? if($i==1){?>checked<?}?>><label><?=$i?>0대</label></td>
									<? } ?>
								</tr>
							</table>
						</div>
					</div>
					<div class="que">
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q1-1</span></td>
									<td>성별을 선택해 주십시오</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" id="q-1" value="남" name="q-1" checked><label>남성</label></td>
									<td><input type="radio" id="q-1" value="여" name="q-1"><label>여성</label></td>
								</tr>
							</table>
						</div>	
					</div>
					<div class="que">
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q2</span></td>
									<td>당신의 인생에 잭팟과 같은 인생역전이 언젠가 이루어질 것이라 믿으십니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" id="q2" value="예" name="q2" checked><label>예</label></td>
									<td><input type="radio" id="q2" value="아니요" name="q2"><label>아니요</label></td>
									<td><input type="radio" id="q2" value="모르겠다" name="q2"><label>모르겠다</label></td>
								</tr>
							</table>
						</div>	
					</div>
					<div class="que" ><!--style="border-bottom:none"--->
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q3</span></td>
									<td>카지노나 슬롯머신 등을 경험해 본적이 있습니까? </td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" id="q3" value="예" name="q3" ><label>예</label></td>
									<td><input type="radio" id="q3" value="아니요" name="q3" checked><label>아니요</label></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="que" style="border-bottom:none"><!--style="border-bottom:none"--->
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q3-1</span></td>
									<td>마트/ 백화점 행운권 추첨이나 경품 행사 등에 참여해 본 경험이 있습니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" id="q3-1" value="예" name="q3-1" ><label>예</label></td>
									<td><input type="radio" id="q3-1" value="아니요" name="q3-1" checked><label>아니요</label></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="que" style="border-bottom:none" id="q3-2-v"><!--style="border-bottom:none"--->
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q3-2</span></td>
									<td>잭팟이나 일정 정도의 돈/ 경품을 따거나 받은적이 있습니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" id="q3-2" value="예" name="q3-2" ><label>예</label></td>
									<td><input type="radio" id="q3-2" value="아니요" name="q3-2" checked><label>아니요</label></td>
								</tr>
							</table>
						</div>
					</div>

					<div class="next-bt"><a href="javascript:;" id="step1">다음으로</a></div>
				</div>
				<div class="contents" id="v_2">
					<div class="que">
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q4</span></td>
									<td>복권이나 로또 등을 구입해 본적이 있습니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" name="q4" id="q4" value="예" checked><label>예</label></td>
									<td><input type="radio" name="q4" id="q4" value="아니오"><label>아니요</label></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="que">
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q4-1</span></td>
									<td>그러한 경험이 있다면(혹은 로또를 사보고 싶다면) 어떤 이유로 하게 되었습니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" name="q4-1" id="q4-1" value="단순 재미" checked><label>단순 재미</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q4-1" id="q4-1" value="인생역전을 꿈꿔서"><label>인생역전을 꿈꿔서</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q4-1" id="q4-1" value="급전 필요" ><label>급전 필요</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q4-1" id="q4-1" value="생활비(자녀교육, 주택구입 등)"><label>생활비(자녀교육, 주택구입 등)</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q4-1" id="q4-1" value="etc"><label>기타</label></td>
								</tr>
								<tr id="q4-txt-v" style="display:none">
									
									<td>
										<input type="text" name="q4-txt" id="q4-txt"> (100자이내)
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="que">
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q4-2</span></td>
									<td>그러한 경험이 있다면(혹은 로또를 사보고 싶다면) 어떤 경로로 구매하십니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" name="q4-2" id="q4-2" value="편의점에 들렀다가 다른 물건과 함께 구입" checked><label>편의점에 들렀다가 다른 물건과 함께 구입</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q4-2" id="q4-2" value="동료, 친구들과 재미로"><label>동료, 친구들과 재미로</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q4-2" id="q4-2" value="지난밤 좋은(돼지, 조상 꿈)꿈을 꿔서" ><label>지난밤 좋은(돼지, 조상 꿈)꿈을 꿔서</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q4-2" id="q4-2" value="주기적으로 구입"><label>주기적으로 구입</label></td>								
								</tr>
							</table>
						</div>
					</div>
					<div class="que" style="border-bottom:none">
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q4-3</span></td>
									<td>그러한 경험이 있다면 (혹은 로또를 사보고 싶다면) 어떤 형태로 구매하십니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" name="q4-3" id="q4-3" value="자동 구매" checked><label>자동 구매</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q4-3" id="q4-3" value="미리 정해둔 번호로 수동구매"><label>미리 정해둔 번호로 수동구매</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q4-3" id="q4-3" value="구입 시 생각나는 번호 수동 구매" ><label>구입 시 생각나는 번호 수동 구매</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q4-3" id="q4-3" value="자동+수동 구매"><label>자동+수동 구매</label></td>									
								</tr>
							</table>
						</div>
					</div>
					<div class="next-bt"><a href="javascript:;" id="step2">다음으로</a></div>
				</div>
				<div class="contents" id="v_3">
					<div class="que">
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q5</span></td>
									<td>로또를 구매하신다면 구매 횟수는 보통 얼마나 되십니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" name="q5" id="q5" value="주 1회" checked><label>주 1회</label></td>
									<td><input type="radio" name="q5" id="q5" value="월 1회"><label>월 1회</label></td>
									<td><input type="radio" name="q5" id="q5" value="월 2회"><label>월 2회</label></td>
									<td><input type="radio" name="q5" id="q5" value="월 3회"><label>월 3회</label></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="que" >
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q6</span></td>
									<td>복권 구매 시 1회 비용은 어떻게 되십니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" name="q6" id="q6" value="만원 이하" checked><label>만원 이하</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q6" id="q6" value="만원 이상 3만원 미만" ><label>만원 이상 3만원 미만</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q6" id="q6" value="3만원 이상 5만원 미만" ><label>3만원 이상 5만원 미만</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q6" id="q6" value="5만원 이상" ><label>5만원 이상</label></td>

								</tr>
							</table>
						</div>
					</div>
					<div class="que" >
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q7</span></td>
									<td>로또를 구매하여 당첨된 경험이 있으십니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" name="q7" id="q7" value="예" checked><label>예</label></td>
									<td><input type="radio" name="q7" id="q7" value="아니오"><label>아니요</label></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="que">
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q7-1</span></td>
									<td>당첨 경험이 있으시다면 본인의 당첨 등수는?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<?
									for($m=5;$m>=1;$m--){
									?>
									<td><input type="radio" name="q7-1" id="q7-1" value="<?=$m?>등" <? if($m==5){?>checked<? } ?>><label><?=$m?>등</label></td>
									<?
									}
									?>
									
								</tr>
							</table>
						</div>
					</div>
					<div class="que" style="border-bottom:none">
						<div class="quest">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><span>Q8</span></td>
									<td>로또 구매시 당첨되지 않는 가장 큰 이유는 무엇이라고 생각하십니까?</td>
								</tr>
							</table>
						</div>
						<div class="answer">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><input type="radio" name="q8" id="q8" value="구입 횟수/ 금액이 적어서" checked><label>구입 횟수/ 금액이 적어서</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q8" id="q8" value="로또 당첨 명당에서 구입하지 않아서" ><label>로또 당첨 명당에서 구입하지 않아서</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q8" id="q8" value="자동으로 구매해서" ><label>자동으로 구매해서</label></td>
								</tr>
								<tr>
									<td><input type="radio" name="q8" id="q8" value="확률 높은 번호를 몰라서" ><label>확률 높은 번호를 몰라서</label></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="next-bt"><a href="javascript:;" id="step3">다음으로</a></div>
				</div>
				<div class="contents" id="v_4">
					<div class="h1" id="txt1">지금 체험해 보세요.</div>
					<div class="txt" id="txt2">매주 추첨 확률이 높은 로또 조합을 미스터로또씨가 보내드립니다.</div>
					<div class="db">
						<input type="hidden" id="etc" name="etc">
						<input type="text" placeholder="이름" name="uname" id="uname">
						<input type="text" placeholder="연락처" name="tel" id="tel">
						<div class="ok-bt"><a href="javascript:;" id="create">1등 예상 번호 무료 받기</a></div>
					</div>
				</div>
			</div>
		</div>
		<div class="sns">
			<span><img src="http://mrlotto.co.kr/land/img/facebook.jpg"></span>
			<span><img src="http://mrlotto.co.kr/land/img/instagram.jpg"></span>
			<span><img src="http://mrlotto.co.kr/land/img/naverblog.jpg"></span>
		</div>
		<footer class="footer" style="width:100%">
			<!--img src="http://mrlotto.co.kr/land/img/footer-img.jpg" style="width:100%"-->
			<div class="copyright" style="background:#000; padding:1% 2%; margin-top:-1%;text-align: center">
				<span style="font-size:12px; color:#9d9d9d;">Copyright © MrQuant Corp. All right reserved.</span>
			</div>
		</footer>

	</body>
</html>
