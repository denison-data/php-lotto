<?
/*필수 include*/
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');

?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,target-densitydpi=device-dpi">
<title>미스터로또씨</title>

<link rel="stylesheet" href="css/style2.css">
<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/nanumgothic.css">
<script src="js/jquery-1.11.1.min.js"></script> <!-- 로컬주소 -->

<?
/*필수 이름이 없는경우는 noname 참고*/
include "./jquery.html";
?>

</head>
<body >
<div id="wrap">
	<div class="wrap_in">
		<!-- header -->
		<div class="header">
			<span class="icon_back">8</span>
			미스터로또씨
			<span class="icon_menu"></span>
			<span class="icon_srch"></span>
		</div>
		<!-- //header -->

		<!-- chat1 -->
		<div class="area_chat1">
			<div class="talkBox talk1">
				<span class="reporter"><span class="profile"></span>미스터로또씨</span>
				<p class="chat" >안녕하세요, 최신 알고리즘을 통한 신뢰있는 리얼 필터 시스템을 도입 한 미스터로또씨 입니다.</p>
				<p class="chat">궁금한 사항 있으시면 편하게 질문 주세요.</p>
			</div>
			<div class="talkBox talk4" style="text-align:left;">
				<span class="reporter"><span class="profile"></span>3등 당첨!/대박 한번 나보자!!!</span>
				<p class="chat" style="display:inline-block;">반갑습니다!~^^! 잘오셨어요!~</p>
			</div>
			<div class="talkBox talk5" style="text-align:left;">
				<span class="reporter"><span class="profile"></span>4등 당첨!/대박 한번 나보자!!! </span>
				<p class="chat" style="display:inline-block;">반갑습니다~!! 경쟁자 분이 또 생겼네요?ㅜㅜ</p>
			</div>
			<div class="talkBox talk6" style="text-align:left;">
				<span class="reporter"><span class="profile"></span>3등 당첨!/인생 한방</span>
				<p class="chat" style="display:inline-block;">반가워요~!!!</p>
			</div>
		</div>
		<!-- //chat1 -->

		<!-- chat2 -->
		<div class="area_chat2" style="margin:0 5px 50px;">
			<div class="talkBox talk2 right">
				<span class="reporter right"><span class="profile"></span>로또 1등을 꿈꾸며</span>
				<p class="chat">정말 너무 속상 하네요. </p>
				<p class="chat">당첨 비법이라는게 정말 존재하나요? ㅠㅠ</p>
			</div>
			<div class="talkBox talk1">
				<span class="reporter"><span class="profile"></span>미스터로또씨</span>
				<p class="chat">
					
						<span class="img"><img src="img/cont1.jpg" width="100%"></span>
						전체 1등 당첨 DB분석→통계분석시스템<br>
						뽑히지 않은 번호 제외→변수제거<br>
						패턴&비율빈도예측→패턴&비율 예측시스템<br>
						압축필터링/조합생성→리얼 필터 시스템<br>
						<br>
						(<span class="red">최신알고리즘을 통한 번호 추출</span>, 혁신적인 미스터로또씨)<br> 
				
				</p>
			</div>
			<div class="talkBox talk1">
				<span class="reporter"><span class="profile"></span>미스터로또씨</span>
				<p class="chat">2002년 로또 복권 출범부터 로또분석 시스템 연구를 시작하였습니다. </p>
				<p class="chat">10년이 넘는 분석 끝에 성공과 실패의 경험이 축적되어 탄생 된 미스터로또씨입니다.</p>
			</div>
			<div class="talkBox talk4">
				<span class="reporter"><span class="profile"></span>3등 당첨!/인생 한방</span>
				<p class="chat">저도 친구 추천받고 미스터로또씨 시작했는데 진짜 인생 한방인거 같아요!! </p>
				<p class="chat">전 3등 당첨!!!<br><span class="img" style="margin-top:8px; margin-bottom:0;"><img src="img/after.jpg" alt="1주일전, 1주일후" width="100%"></span></p>
			</div>
			
			
			<div class="talkBox talk5" style="text-align:left;">
				<span class="reporter"><span class="profile"></span>4등 당첨!/대박 한번 나보자!!!</span>
				<p class="chat" style="display:inline-block;">저는 4등 당첨!! 저는 1등을 노리고 있습니다 ㅎㅎ</p>
			</div>

			<div class="talkBox talk2 right">
				<span class="reporter"><span class="profile"></span>로또 1등을 꿈꾸며</span>
				<p class="chat">저도 번호를 받고 싶은데 어떻게 해야죠?</p>
			</div>
			<div class="talkBox talk1">
				<span class="reporter"><span class="profile"></span>미스터로또씨</span>
				<p class="chat">아래에 이름, 전화번호 남겨주시면 됩니다.</p>
				<p class="chat">선착순 100분 한정 이벤트 중! 놓치지 마세요~</p>

			<!-- db -->

				<div class="chat">
					<div class="box_img"><img src="img/db-9.jpg" width="100%" alt="다시시작 리메이크 다이어트" id="db_top"></div>
					<div id="db_form">
						
							<div class="center">
								<div class="db_box">
									<div class="tel_box">
										<input type="text" class="name_txt" name="uname" placeholder="이름을 입력해 주세요" style="border:none; border-bottom: 1px solid #111; width:100%; padding:3% 0 0 3%;  margin-bottom:3%; font-size: 0.8rem" id="uname">
										<input type="text" class="prdNum1" name="tel" placeholder="휴대폰번호" style="border:none; border-bottom: 1px solid #111; width:100%; padding:3% 0 0 3%; margin-bottom: 3%; font-size:0.8rem" name="tel" id="tel">
										
										
<!-- 										<input type="tel" class="age_txt num_chk" name="user_age" placeholder="연령"> -->
<!--
										<div class="sex_box">
											<input type="radio" style="vertical-align:middle;padding:0px 2px 0px 2px" name="user_sex" value="2" checked><label for="">여자</label>&nbsp;&nbsp;
											<input type="radio" style="vertical-align:middle;padding:0px 2px 0px 2px" name="user_sex" value="1"><label for="">남자</label>
										</div>

										<select class="prdNum1" name="tel1">
											<option value="010">010</option>
											<option value="011">011</option>
											<option value="016">016</option>
											<option value="017">017</option>
											<option value="018">018</option>
											<option value="019">019</option>
										</select>
										<input type="tel" class="prdNum1 num_chk" name="tel2" maxlength="4" placeholder="0000">
										<input type="tel" class="prdNum2 num_chk" name="tel3" maxlength="4" placeholder="0000">
									</div>-->
									<div style="width:100%;/* padding:0px 2px 0px 2px; */font-size:12px;line-height:18px;text-align:center;font-weight:normal; color:#ff0000">
										<!-- 	<input type="checkbox" name="agree" id="agree_checkbox" class="custom" style="vertical-align:middle" checked/>
									<label for="agree2">개인정보 수집 및 활용동의</label><a class="btn_popup">[자세히보기]</a> -->
									<div style="text-align: center;padding-top:1%" class="check"><input type="checkbox" style="width: auto;text-decoration: none;color:#666" id="check" checked=""><label style="font-size: 0.8em;color: #111" for="check">&nbsp;&nbsp;개인정보취급방침 동의 <a href="pri.php" target="_blank" style="font-size: 1em;text-decoration: none;color: #888">[약관보기]</a></label></div>

				<div style="text-align: center;padding-bottom:1%" class="check2"><input type="checkbox" style="display: inline-block;width: auto;text-decoration: none;color:#666" id="check2" checked=""><label style="font-size: 0.8em;color:#111" for="check2">&nbsp;&nbsp;문자수신 동의</label></div>
<p>*미성년자는 로또를 구매할 수 없으므로<br>신청이 불가합니다.</p>
									</div>
									
								</div>
							</div>
							<div class="btn_area" style="margin-top:3%"><a href="javascript:;" id="create"><img src="img/land6_img3.jpg" width="100%" class="btn_send" alt="리메이크 다이어트 무료 상담"></a></div>
						</form>
					</div>

					<!-- 하단정보 -->
<!--
					<div id="menu1" style="cursor:Pointer; margin:1px 0 4px" onclick="javascript:menuclick('b01');">
						<p align="center"><b><font color="#666">업체정보보기</font></b></p>
					</div>
-->
					<div id="prdPar_b01" class="Content_StyleIn" style="display: none; font-size:12px;">
						<p align="center">
							업체명: 나인펍&nbsp;&nbsp;&nbsp;l&nbsp;&nbsp;대표자 : 이현승<br>
					사업자번호: 172-15-00541<br>주소: 서울특별시 강동구 올림픽로62길 38,<br>지하1층(성내동)<br>대표번호 : 1522-5857
						</p>
					</div>
					<!-- //하단정보 -->

				</div>
			</div>
			<!-- //db -->
		</div>
		<!-- // chat2 -->
		
		<!-- footer -->
		<div class="footer">
			<span class="icon_plus"></span>
			<div class="bd">
				<span class="icon_tag"></span>
				<span class="icon_emoti"></span>
			</div>
		</div>
		<!-- //footer -->
	</div>
</div>

<script type="text/javascript">

	function Page1(){
		$('.area_chat1 > div:eq(0)').fadeIn(100);
		setTimeout(function(){
			$('.area_chat1 > div:eq(1)').fadeIn(100);
			setTimeout(function(){
				$('.area_chat1 > div:eq(2)').fadeIn(100);
				setTimeout(function(){
					$('.area_chat1 > div:eq(3)').fadeIn(100);
					setTimeout(function(){
						viewPage();
					}, 500);
				}, 500);
			}, 500);
		}, 500);
	}

	function viewPage(){
		$('.area_chat1 > div:eq(1)').fadeIn(100);
		$(window).scrollTop(200);
		setTimeout(function(){
			$('.area_chat2 > div:eq(0)').fadeIn(100);
			$(window).scrollTop(400);
				setTimeout(function(){
					$('.area_chat2 > div:eq(1)').fadeIn(100);
					$(window).scrollTop(800);
					setTimeout(function(){
						$('.area_chat2 > div:eq(2)').fadeIn(100);
						$(window).scrollTop(1000);
							setTimeout(function(){
								$('.area_chat2 > div:eq(3)').fadeIn(100);
								$(window).scrollTop(1200);
									setTimeout(function(){
										$('.area_chat2 > div:eq(4)').fadeIn(100);
										$(window).scrollTop(1400);
										setTimeout(function(){
											$('.area_chat2 > div:eq(5)').fadeIn(100);
											$(window).scrollTop(1600);
												setTimeout(function(){
													$('.area_chat2 > div:eq(6)').fadeIn(100);
													$(window).scrollTop(2000);
												}, 500);
										}, 500);
									}, 500);
							}, 500);
					}, 500);
			}, 500);
		}, 500);
	}



	jQuery(function($){
		setTimeout(function(){
			Page1();
		}, 1000);
	});

</script>

<script language="javascript">
//아래로 펼쳐지는 테그
var old_menu = '';
function menuclick(num) {
 var submenu = document.getElementById('prdPar_' + num);

 if(old_menu != submenu) {
  if(old_menu != '') old_menu.style.display = 'none';
  submenu.style.display = 'block';
  old_menu = submenu;
 } else {
  submenu.style.display = 'none';
  old_menu = '';
 }
}
</script>


<div class="background_layer"></div>
<div class="agree_layer">
	<div class="agree_txt">타겟뷰 개인정보 취급방침

애드티브 이노베이션(주)의 타겟뷰(이하 '회사'라 한다)는 개인정보 보호법 제30조 및 정보통신망이용촉진 및 정보보호등에관한법률(이하 '정보통신망법'이라 한다) 제27조의2에 따라 정보주체의 개인정보를 보호하고 이와 관련한 고충을 신속하고 원활하게 처리할 수 있도록 하기 위하여 다음과 같이 개인정보 처리지침을 수립ㆍ공개합니다.
제1조(개인정보의 처리목적)
회사는 다음의 목적을 위하여 개인정보를 처리합니다. 처리하고 있는 개인정보는 다음의 목적 이외의 용도로는 이용되지 않으며, 이용 목적이 변경되는 경우에는 개인정보 보호법 제18조 및 정보통신망법 제22조에 따라 별도의 동의를 받는 등 필요한 조치를 이행할 예정입니다.
1. 홈페이지 회원 가입 및 관리
회원 가입의사 확인, 회원제 서비스 제공에 따른 본인 식별·인증, 회원자격 유지·관리, 제한적 본인확인제 시행에 따른 본인확인, 서비스 부정이용 방지, 만 14세 미만 아동의 개인정보 처리시 법정대리인의 동의여부 확인, 각종 고지·통지, 고충처리 등을 목적으로 개인정보를 처리합니다.
2. 재화 또는 서비스 제공
제품 구매 계약에 따른 계약체결, 물품배송, 서비스 제공, 계약서·청구서 발송, 콘텐츠 제공, 맞춤서비스 제공, 이벤트/경품 소식 안내, 이벤트/경품당첨 결과안내 및 상품배송, 본인인증, 연령인증, 요금결제·정산, 채권추심 등을 목적으로 개인정보를 처리합니다.
3. 고충처리
민원인의 신원 확인, 민원사항 확인, 사실조사를 위한 연락·통지, 처리결과 통보 등의 목적으로 개인정보를 처리합니다.
4. 마케팅 및 광고에 활용
고객에게 최적화된 서비스 제공, 신규 서비스(제품) 개발 및 특화, 인구통계학적 특성에 따른 서비스 제공 및 광고 게재, 웹페이지 접속 빈도 파악, 서비스 이용에 대한 통계, 정기 간행물 발송, 새로운 상품 또는 서비스 안내, 고객 관심사에 부합하는 서비스 및 이벤트 기획, 경품행사, 이벤트 등 광고성 정보 전달 또는 회원 참여공간 운영, 고객설문조사, 서비스 및 상품 안내 등을 목적으로 개인정보를 처리합니다.
5. 상담 관리
상담 서비스 이용에 따른 본인 식별·인증, 상담 의사 확인, 상담 회신, 의사소통, 사은품 지급 시 물품 배송, 서비스 및 상품 안내 등을 목적으로 개인정보를 처리합니다.
제2조(개인정보의 처리 및 보유기간)
① 회사는 법령에 따른 개인정보 보유·이용기간 또는 정보주체로부터 개인정보를 수집 시에 동의 받은 개인정보 보유·이용기간 내에서 개인정보를 처리ㆍ보유합니다.
② 각각의 개인정보 처리 및 보유 기간은 다음과 같습니다.

1. 홈페이지 회원 가입 및 관리 : 홈페이지 탈퇴 시까지
다만, 다음의 사유에 해당하는 경우에는 해당 사유 종료 시까지
1) 관계 법령 위반에 따른 수사·조사 등이 진행중인 경우에는 해당 수사·조사 종료 시까지
2) 홈페이지 이용에 따른 채권·채무관계 잔존 시에는 해당 채권·채무관계 정산시까지

2. 재화 또는 서비스 제공 : 재화·서비스 공급완료 및 요금결제·정산 완료 시까지
다만, 다음의 사유에 해당하는 경우에는 해당 기간 종료 시까지
1) 「전자상거래 등에서의 소비자 보호에 관한 법률」에 따른 표시·광고, 계약내용 및 이행 등 거래에 관한 기록
- 표시·광고에 관한 기록 : 6월
- 계약 또는 청약철회, 대금결제, 재화 등의 공급 기록 : 5년
- 소비자 불만 또는 분쟁처리에 관한 기록 : 3년

3. 회사 내부 방침에 따른 보유
1) 불량회원 재 가입 방지
- 보유 목적: 불량 이용 행위(악성 댓글, 사이트 이용 시 회원간 분쟁을 야기, 사이트 부정이용 행위, 불법적인 보안위협 초래 등)를 야기한 이용자의 발견 및 이용행위 중지, 재가입 방지 등
- 보유항목: 이름, ID, 주소, 이메일, 전화번호, 휴대폰번호, 접속IP, 방문경로
- 보유 기간: 회원탈퇴 처리 후 1년간
2) 고객 상담 정보
- 보유 목적: 상담 사실 확인, 고객 관심사에 부합하는 서비스(제품) 개발 및 특화, 상담 통계 분석, 소비자 분쟁 대비 등
- 보유 항목: 이름, 이메일
- 보유 기간: 상담 종료 후 1년간
제3조(개인정보의 제3자 제공)
① 회사는 정보주체의 개인정보를 제1조(개인정보의 처리 목적)에서 명시한 범위 내에서만 처리하며, 정보주체의 동의, 법률의 특별한 규정 등 개인정보 보호법 제17조 및 정보통신망법 제24조의2에 해당하는 경우에만 개인정보를 제3자에게 제공합니다.
제4조(개인정보처리의 위탁)
① 회사는 고객님의 동의없이 고객님의 정보를 외부 업체에 위탁하지 않습니다. 향후 그러한 필요가 생길 경우, 위탁 대상자와 위탁 업무 내용에 대해 고객님에게 통지하고 필요한 경우 사전 동의를 받도록 하겠습니다.
제5조(정보주체의 권리ㆍ의무 및 행사방법)
① 정보주체는 회사에 대해 언제든지 다음 각 호의 개인정보 보호 관련 권리를 행사할 수 있습니다.
1. 개인정보 열람요구
2. 오류 등이 있을 경우 정정 요구
3. 삭제요구
4. 처리정지 요구

② 제1항에 따른 권리 행사는 아래의 방법으로 하실 수 있습니다.
1. 홈페이지 가입 회원: 자신의 ID/PW로 로그인 후 '마이페이지'에서 열람 및 정정을 할 수 있으며, '탈퇴신청'에서 회원탈퇴를 하실 수 있습니다. 개인정보에 대한 처리정지 요구는 아래의 개인정보관리책임자 또는 개인정보관리담당부서에게 서면, 전화, 전자우편, 모사전송(FAX) 등을 통하여 하실 수 있습니다. 회사는 이에 대해 지체없이 조치하겠습니다.
2. 상담문의 등 회원가입하지 않은 고객: 회사 또는 개인정보관리책임자 및 개인정보관리부서에 대해 서면, 전화, 전자우편, 모사전송(FAX) 등을 통하여 제1항에 따른 권리를 행사하실 수 있으며, 회사는 이에 대해 지체없이 조치하겠습니다.

③ 정보주체가 개인정보의 오류 등에 대한 정정 또는 삭제를 요구한 경우에는 회사는 정정 또는 삭제를 완료할 때까지 당해 개인정보를 이용하거나 제공하지 않습니다.
④ 제1항에 따른 권리 행사는 정보주체의 법정대리인이나 위임을 받은 자 등 대리인을 통하여 하실 수 있습니다. 이 경우 개인정보 보호법 시행규칙 별지 제11호 서식에 따른 위임장을 제출하셔야 합니다.
⑤ 정보주체는 개인정보 보호법 등 관계법령을 위반하여 회사가 처리하고 있는 정보주체 본인이나 타인의 개인정보 및 사생활을 침해하여서는 아니됩니다.
제6조(처리하는 개인정보 항목)
① 회사는 다음의 개인정보 항목을 처리하고 있습니다.
1. 홈페이지 회원 가입 및 관리
ㆍ필수항목 : 이름, 주소, 닉네임, 전화번호, 휴대폰번호, 이메일
ㆍ선택항목 : 직업

2. 홈페이지 상담 신청 및 관리
ㆍ필수항목 : 이름, 이메일

3. 인터넷 서비스 이용과정에서 아래 개인정보 항목이 자동으로 생성되어 수집될 수 있습니다.
ㆍIP주소, 쿠키, MAC주소, 서비스 이용기록, 방문기록, 불량 이용기록 등

② 개인정보 수집방법
ㆍ홈페이지, 신청서 등 서면양식에 서명, 상담게시판, 전화, 팩스, 경품행사 응모, 관계사의 제공, 제휴사부터의 제공을 통한 수집 방법 등
제7조(개인정보의 파기)
① 회사는 개인정보 보유기간의 경과, 처리목적 달성 등 개인정보가 불필요하게 되었을 때에는 지체없이 해당 개인정보를 파기합니다.
② 정보주체로부터 동의받은 개인정보 보유기간이 경과하거나 처리목적이 달성되었음에도 불구하고 다른 법령에 따라 개인정보를 계속 보존하여야 하는 경우에는, 해당 개인정보를 별도의 데이터베이스(DB)로 옮기거나 보관장소를 달리하여 보존합니다.
③ 개인정보 파기의 절차 및 방법은 다음과 같습니다.
1. 파기절차
회사는 파기 사유가 발생한 개인정보를 선정하고, 회사의 개인정보 관리책임자의 승인을 받아 개인정보를 파기합니다.
2. 파기방법
회사는 전자적 파일 형태로 기록?저장된 개인정보는 기록을 재생할 수 없도록 로우레밸포멧(Low Level Format) 등의 방법을 이용하여 파기하며, 종이 문서에 기록·저장된 개인정보는 분쇄기로 분쇄하거나 소각하여 파기합니다.
제8조(개인정보의 안전성 확보조치)
회사는 개인정보의 안전성 확보를 위해 다음과 같은 조치를 취하고 있습니다.
1. 관리적 조치 : 내부관리계획 수립ㆍ시행, 정기적 직원 교육 등
2. 기술적 조치 : 개인정보처리시스템 등의 접근권한 관리, 접근통제시스템 설치, 고유식별정보 등의 암호화, 보안프로그램 설치
3. 물리적 조치 : 전산실, 자료보관실 등의 접근통제
제9조(개인정보 자동수집 장치의 설치, 운영 및 그 거부에 관한 사항)
① 회사는 귀하의 정보를 수시로 저장하고 찾아내는 '쿠키(cookie)' 등을 운용합니다. 쿠키란 웹사이트를 운영하는데 이용되는 서버가 귀하의 브라우저에 보내는 아주 작은 텍스트 파일로서 귀하의 컴퓨터 하드디스크에 저장됩니다. 회사는 다음과 같은 목적을 위해 쿠키를 사용합니다.

▶ 쿠키 등 사용 목적
- 회원과 비회원의 접속 빈도나 방문 시간 등을 분석, 이용자의 취향과 관심분야를 파악 및 자취 추적, 각종 이벤트 참여 정도 및 방문 회수 파악 등을 통한 타겟 마케팅 및 개인 맞춤 서비스 제공

- 귀하는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서, 귀하는 웹브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다.

▶ 쿠키 설정 거부 방법
예: 쿠키 설정을 거부하는 방법으로는 회원님이 사용하시는 웹 브라우저의 옵션을 선택함으로써 모든 쿠키를 허용하거나 쿠키를 저장할 때마다 확인을 거치거나, 모든 쿠키의 저장을 거부할 수 있습니다.

설정방법 예(인터넷 익스플로어의 경우)
: 웹 브라우저 상단의 도구 > 인터넷 옵션 > 개인정보

단, 귀하께서 쿠키 설치를 거부하였을 경우 서비스 제공에 어려움이 있을 수 있습니다.
제10조(개인정보 관리책임자)
① 회사는 개인정보 처리에 관한 업무를 총괄해서 책임지고, 개인정보 처리와 관련한 정보주체의 불만처리 및 피해구제 등을 위하여 아래와 같이 개인정보 관리책임자를 지정하고 있습니다.

▶ 개인정보 관리책임자
성명 : 조경호
직책 : 유닛장
연락처 :
TEL. 02-554-9014
이메일: iami@adtive.co.kr
FAX. 02-554-3832

▶ 개인정보 보호 담당부서 
부서명 : Movement Green Unit 
담당자 : 조경호
연락처 : TEL. 02-554-9014 
이메일: iami@adtive.co.kr
FAX. 02-554-3832

② 정보주체께서는 회사의 서비스(또는 사업)을 이용하시면서 발생한 모든 개인정보 보호 관련 문의, 불만처리, 피해구제 등에 관한 사항을 개인정보 관리책임자 및 담당부서로 문의하실 수 있습니다. 회사는 정보주체의 문의에 대해 지체없이 답변 및 처리해드릴 것입니다.
제11조(개인정보 열람청구)
정보주체는 개인정보 보호법 제35조 및 정보통신망법 제30조에 따른 개인정보의 열람 청구를 아래의 부서에 할 수 있습니다. 회사는 정보주체의 개인정보 열람청구가 신속하게 처리되도록 노력하겠습니다.

▶ 개인정보 열람청구 접수ㆍ처리 부서
부서명 : Movement Green Unit
담당자 : 조경호
연락처 :
TEL. 02-554-9014
이메일: iami@adtive.co.kr
FAX. 02-554-3832
제12조(권익침해 구제방법)
정보주체는 아래의 기관에 대해 개인정보 침해에 대한 피해구제, 상담 등을 문의하실 수 있습니다.
[아래의 기관은 회사와는 별개의 기관으로서, 회사의 자체적인 개인정보 불만처리, 피해구제 결과에 만족하지 못하시거나 보다 자세한 도움이 필요하시면 문의하여 주시기 바랍니다]
▶ 개인정보보호 종합지원 포털 (행정안전부 운영)
- 소관업무 : 개인정보 침해사실 신고, 상담 신청, 자료제공
- 홈페이지 : www.privacy.go.kr
- 전화 : 02-2100-3394

▶ 개인정보 침해신고센터 (한국인터넷진흥원 운영)
- 소관업무 : 개인정보 침해사실 신고, 상담 신청
- 홈페이지 : privacy.kisa.or.kr
- 전화 : (국번없이) 118
- 주소 : (138-950) 서울시 송파구 중대로135 한국인터넷진흥원 개인정보침해신고센터

▶ 개인정보 분쟁조정위원회 (한국인터넷진흥원 운영)
- 소관업무 : 개인정보 분쟁조정신청, 집단분쟁조정 (민사적 해결)
- 홈페이지 : privacy.kisa.or.kr
- 전화 : (국번없이) 118
- 주소 : (138-950) 서울시 송파구 중대로135 한국인터넷진흥원 개인정보침해신고센터

▶ 경찰청 사이버테러대응센터
- 소관업무 : 개인정보 침해 관련 형사사건 문의 및 신고
- 홈페이지 : www.netan.go.kr
- 전화 : (사이버범죄) 02-393-9112
(경찰청 대표) 1566-0112
제13조(개인정보 취급방침 변경)
① 이 개인정보 취급방침은 2012. 7. 1. 부터 적용됩니다.
 위 사항에 동의합니다

모두 동의합니다
개인정보 수집 활용 동의서

[[리메이크다이어트]]는 다음의 목적을 위하여 개인정보를 처리합니다. 처리하고 있는 개인정보는 다음의 목적 이외의 용도로는 이용되지 않으며, 이용 목적이 변경되는 경우에는 개인정보 보호법 제18조및 정보통신망법 제22조에 따라 별도의 동의를 받는 등 필요한 조치를 이행할 예정입니다.
■ 수집하는 개인정보 항목
- 수집항목 :
이름, 나이, 휴대폰번호, 몸무게, 신장, 기타 정보, OS/브라우저, 접속IP/URL
■ 개인정보 수집 목적
상담 서비스 이용에 따른 본인 식별·인증, 상담 의사 확인, 상담 회신, 의사소통, 사은품 지급 시 물품 배송, 서비스 및 상품 안내 등을 목적으로 개인정보를 처리합니다.
■ 개인정보 보유 및 이용 기간
원칙적으로, 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다. 다만, 상담 사실 확인, 고객 관심사에 부합하는 서비스(제품) 개발 및 특화, 상담 통계 분석, 소비자 분쟁 대비 등의 목적으로 상담 종료 후 1년간 보관 후 파기됩니다.
■ 개인정보 제공 동의 거부 권리 및 동의 거부 따른 불이익 내용 또는 제한사항
귀하는 개인정보 제공 동의를 거부할 권리가 있으며, 동의 거부에 따른 불이익은 없습니다. 다만, 필수정보 제공에 동의하지 않는 경우 원활한 상담답변이 불가능 할 수도 있습니다.
 위 사항에 동의합니다

모두 동의합니다
개인정보 위탁 동의서

■ 개인정보 처리 위탁
- [[리메이크다이어트]]는 원활한 개인정보 업무처리를 위하여 다음과 같이 개인정보 처리업무를 위탁하고 있습니다.
■ 위탁하는 업무내용
광고대행, 광고관련 기사 작성, 상담문의 개인정보 수집 대행, 상담문의 정보 보관 및 관리, 상담문의 수집목적 달성 후 개인정보 파기대행
■ 위탁 받는자
애드티브 이노베이션(주)
■ 위탁에 따른 관리감독
[[리메이크다이어트]]는 위탁계약 체결시 개인정보 보호법 제26조 및 정보통신망법 제25조에 따라 위탁업무 수행목적 외 개인정보 처리금지, 기술적ㆍ관리적 보호조치, 재위탁 제한, 수탁자에 대한 관리ㆍ감독, 손해배상 등 책임에 관한 사항을 계약서 등 문서에 명시하고, 수탁자가 개인정보를 안전하게 처리하는지를 감독하고 있습니다</div>
	<a class="btn_close">닫기 X</a>
</div>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-W4R969"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W4R969');</script>
<!-- End Google Tag Manager -->

</body>
</html>