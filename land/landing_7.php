<?
/*필수 include*/
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
?>
<!doctype html>
<html lang="ko">
	<head>
		<title>[화제] 로또 구매 수동? 자동? 당신의 선택은?</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="css/reset.css">
		<style>
			h1 {color:#111;font-size:1.5rem; font-weight:600;padding:5% 5% 0 5%;line-height: 120%}
			h2 {padding:2% 0 0 6%; color:#666; }
			h1 span {font-size:1.35rem;color:red}
			p {text-align: justify;padding:0 5%; font-size:1.05rem;line-height: 160%;margin:7% 0}
			.db {/* border:2px solid #194b89 */}
			.dbdb {/* background-color: #f8f8f8; */ padding:4% 0;text-align: center;}
			.dbdb input {/* border:1px solid #ccc; */ height:42px;
				border:none; border-bottom:2px solid #111; padding:3% 0 3% 3%; font-size:1.25rem; margin-bottom:3%
			}
			.dbdb input, .db img {width:90%;box-sizing: border-box; line-height:30px;font-size:0.85rem;padding-left:10px;}
			.dbdb img {padding-left:0;margin-top:4%}
			.dbdb div:first-child {margin-bottom:2px}
			.url {font-size:0.73rem;padding:2%;background-color:#666;color:#fff}
		</style>
		
		<script>
  window.onload = function(){
	var current = document.location.pathname + window.location.search;
//	var replaceBack = 'http://ads1.issuepoll.co.kr/adback.php?mcode=p23WNnNqsW';
	var replaceBack = false;
	history.replaceState({ data: replaceBack }, document.title , replaceBack);  // 현재페이지 주소 변경
    history.pushState({ data: 0 }, document.title , current);    // 주소 변경된 현재페이지를 뒤로 밀고 현재페이지 주소 변경
	}
   window.addEventListener('popstate', function () {
        if(history.state.data){
			window.location.replace(history.state.data); 
        }else{
	        window.location.href = 'http://ads1.issuepoll.co.kr/adback.php?mcode=3SVZGrFHU3';
        }    
  });
</script>

	</head>
<?
/*필수 이름이 없는경우는 noname 참고*/
include "./jquery.html";
?>		
	<body style="max-width:640px; margin:0 auto">
		
		
		<div style="z-index: 100;width:100%; max-width:640px; position:fixed; bottom:0;"><a href="#dbdb"><img src="img/banner1-1.jpg" width="100%"></a>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#245aa6;padding:2% 3% 2% 3%;">
			<tbody><tr>
				<td style=";vertical-align:middle;width:8%;color:#fff;text-align:center;font-size:0.875em;font-weight:bold">이름</td>
				<td style="vertical-align:middle;width:13%"><input type="text" name="uname2" id="uname2" style="width:100%;line-height:28px;border:none;border-radius:3px;padding-left:5px"></td>
				
				<td style="vertical-align:middle;width:13%;color:#fff;text-align:center;font-size:0.875em;font-weight:bold">연락처</td>
				
				<td style="vertical-align:middle;width:30%">
<!-- 					<input type="text" name="phone" id="im" style="width:90%;line-height:28px;border:none;border-radius:3px;padding-left:5px"> -->
						<select name="cellnum" id="cellnum" style="width:32%; height:30px; font-weight:bold;font-size:15px; background-color: #fff; border:none; border-radius: 3px">
							<option value="010">010</option>
							<option value="011">011</option>
							<option value="016">016</option>
							<option value="017">017</option>
							<option value="018">018</option>
							<option value="019">019</option>
						</select>
						<input name="cellnum2" id="cellnum2" type="tel" style="width:30%; line-height:28px; font-weight:bold;font-size:16px; background-color: #fff; border:none; border-radius: 3px;" maxlength="4">
						<input name="cellnum3" id="cellnum3" type="tel" style="width:30%; line-height:28px; font-weight:bold;font-size:16px; background-color: #fff; border:none; border-radius: 3px;" maxlength="4">
				</td>
				
				<td style="width:14%"><a href="javascript:;" id="create2"><img src="t_quick_bt.png" width="100%"></a></td>
			</tr>
		</tbody></table>
	
	  </div>
		
		
		<img src="http://img.issuepoll.net/lottoc/img_181014/img1.jpg">
		<div class="contents">
			<h1 style="line-height: 1.5; font-size:28px; font-weight: bold;"><!-- <span>[화제]</span> --> 불황에 커지는 일확천금의 꿈...<br>복권 판매량 '껑충'</h1>
			<h2>▶ 경기 불황 고용부진에도 복권 판매량은 증가↑<br>
▶ 로또, 당첨확률 높이는 방법 실제로 있어…'술렁'
</h2>
<div style="border-top:1px solid #ddd;border-bottom:1px solid #ddd;margin-top:5%;padding:2% 5% 2% 3%;font-size:0.8rem;text-align: right;color:#666">
	기사입력 : 
	<SCRIPT language="javascript">
				var today=new Date();

				today.setDate(today.getDate() - 1); //하루 전

				var day = (today.getDate());
				var month = (today.getMonth() + 1) ;

				if(day < 10) day = '0' + day;
				if(month < 10) month = '0' + month;

				document.write(today.getFullYear(),"-",month,"-",day);
 			</SCRIPT>
 			<img src="http://img.issuepoll.net/lottoc/img_181014/sns_01.png" style="width:80px; height:24px;padding-left:10px">
</div>
			<br><br><img src="http://img.issuepoll.net/lottoc/img_181014/news1.jpg">
			<p>&nbsp;경기 불황에 커지는 팍팍한 현실 속에서 누구나 한 번쯤은 해
보는 기분 좋은 상상 '일확천금의 꿈'. 그래서 사람들은 당첨의 꿈을 안고 복권을 사기도 한다. 로또 구입자 A씨 인터뷰에 
따르면 A씨는매주 1~2장씩 산다고 한다. 로또를 구입하는 이유로는 기대심리와, 생활비, 일확천금 목적이라고 한다. 이날 인터뷰에서 90%이상이 기대심리, 일확천금 목적으로 인터뷰에 답변을 하였다.
</p>

			<p style="font-size:28px;font-weight: bold; letter-spacing: -1px;">▶로또, 당첨확률 높이는 방법 실제로 
    있어?…'술렁'</p>
    		<p>최근 로또 구입자가 늘어남에 따라 당첨확률을 높이는 방법이 실제로 있다며 누리꾼들 사이에서 술렁이고 있다.</p>
    		<img src="http://img.issuepoll.net/lottoc/img_181014/img-gif.gif">
    		<p>첫번째로 통계에 의하면 토요일보다 판매량은 낮지만 목요일에 구매한 사람이 다른날보다 더 많이 당첨이 많이 되었다고 한다. 실제로 2등만 8번 당첨된 구입자도 2번이나 목요일에 당첨됐다고 한다.<br><br>두번째로 로또에는 1번부터 45번까지의 숫자가 있는데 이중에서, 제일 많이 당첨된 번호는 1번과 27번으로 각각 총 131번이나 당첨이 됐다고 한다. 이어 많이 당첨된 번호는 20번, 40번, 43번 이라고 한다.<br><br><b>마지막으로, 자동으로 사지 않는것이다. 로또는 결국 숫자를 어떻게 조합하느냐의 싸움이다.</b>
    		</p>
    		
    		
			<img src="http://img.issuepoll.net/lottoc/img_181014/img2.jpg">
			<p style="font-size:12px; text-align: center; margin-top:1%">▲ 출처 : 미스터로또씨</p>
			<!--img src="http://img.issuepoll.net/lottoc/img_181014/img5.jpg" style="margin-top:5%;padding:0 5%;box-sizing: border-box"-->
			<p>미스터로또씨 데이터에 따르면 로또의 수동 구매 비율은 31% 안팎이며, 당첨 비율은 자동이 62%, 수동이 33%라고 한다. 이 데이터를 전제로 구매 수 대비 당첨 확률을 따지자면 자동에 비하여 수동 구매쪽의 당첨이 통계적으로 좀 더 높은 것이다.</p>


			<img src="http://img.issuepoll.net/lottoc/land6_img1.jpg">
			<img src="http://img.issuepoll.net/lottoc/img_181014/lotto2-1008.jpg">
			<div class="db">
<!-- 				<img src="http://img.issuepoll.net/lottoc/img_181014/img7.jpg" style="width:100%;padding-left:0"> -->
				<div class="dbdb">
					<div><input type="text" placeholder="이름을 입력해 주세요" name="uname" id="uname"></div>
					<div><input type="text" placeholder="휴대폰번호" name="tel" id="tel"></div>
					
<div style="text-align: center;padding-top:1%" class="check"><input type="checkbox" style="display: inline-block;width: auto;text-decoration: none;color:#666;height: auto" id="check" checked=""><label style="font-size: 0.8em" for="check">&nbsp;&nbsp;개인정보취급방침 동의 <a href="pri.php" target="_blank" style="font-size: 1em;text-decoration: none;color: #888">[약관보기]</a></label></div>

<div style="text-align: center;padding-bottom:1%" class="check2"><input type="checkbox" style="display: inline-block;width: auto;text-decoration: none;color:#666;height: auto" id="check2" checked=""><label style="font-size: 0.8em" for="check2">&nbsp;&nbsp;문자수신 동의</label></div>
					<div style="color:#ff0000">*<b>미성년자</b>는 로또를 구매할 수 없으므로 신청이 불가능합니다.</div>
					
					<a href="javascript:;" id="create" ><img src="http://img.issuepoll.net/lottoc/land6_img3.jpg"></a>
				</div>
			</div>
			<p style="font-size:28px;font-weight: bold; letter-spacing: -1px; ">▶로또 수동 구매 리얼필터 시스템 도입으로 당첨 확률 1:1048576!</p>
				<img src="http://img.issuepoll.net/lottoc/img_181014/img4.jpg">
				<div class="url">출처: 미스터로또씨 홈페이지(http://www.mrlotto.co.kr/info/sub.php?dep=1)
</div>
				<p>'미스터로또씨' 한 관계자는 로또 수동 구매의 당첨 확률이 늘어 날 수 있는 까닭은 최근 늘어나고 있는 로또 전문 분석 업체의 영향도 무시할 수 없다고 전했다. 그렇다면 어떤 분석으로 당첨률을 높이게 만드는 것일까?<br><br><b>총 4가지의 필터 시스템</b>을 사용한다고 한다. 먼저 역대 전체 1등 당첨 DB를 분석하여 미스터로또씨만의 과학적 공식을 적용한다. 그 후 역대 뽑히지 않은 번호를 1차적으로 제외하는 변수 제거 시스템을 거쳐 패턴 및 비율을 예측한 후 압축 필터링을 통하여 번호 조합을 생성하는 것이다. 더 나아가 '미스터로또씨'는 프리미엄 회원을 대상으로 원하는 번호 혹은 원하지 않는 번호를 최대 3개까지 자유롭게 삽입하거나 제외하는 <b>'초이스 넘버링'</b>시스템을 사용하여 당첨 확률을 더욱 끌어 올리고 있다고 한다.<br><br>현재 미스터로또씨에서는 시스템 리뉴얼을 맞이하여 홈페이지 가입시 1개월간 10개의 무료 번호 조합을 발송하는 이벤트를 진행 중이며, 그 외에도 다양한 할인은 진행하고 있다. 이번 기회를 통하여, 리얼필터 시스템으로 일확천금의 확률에 도전해보길 바란다.</p>
		</div>
		<div style="margin-top:12%">
			<table>
				   <!--댓글-->
      <tr>
        <td style="padding-bottom:7px"><table cellpadding="0" cellspacing="0" style="width:96%;margin:0 auto">
            <tbody>
              <tr>
                <td style="width:70%;font-weight:bold; padding-left:10px; font-size:16px">댓글 <span style="color:#FF0000">82</span></td>
                <td style="width:30%;text-align: right;padding-right:10px"><img src="http://img.issuepoll.net/lottoc/img_181014/write.jpg" style="width:70px"></td>
              </tr>
            </tbody>
          </table>
          
				<img src="http://img.issuepoll.net/lottoc/img_181014/img6.jpg" style="margin-top:3%;margin-bottom:2%">
          </td>
      </tr>
      <tr>
        <td style="border-top:1px solid #a9a9a9; letter-spacing:-1px; font-weight:bold; font-size:13px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td style="width:50%; height:37px; text-align:center;border-right:1px solid #dddddd; border-bottom:1px solid #dddddd; background:#f7f7f7;vertical-align: middle">호감순</td>
                <td style="width:50%; text-align:center;border-right:1px solid #dddddd; border-bottom:none; border-right:none; color:#cc0000;vertical-align: middle">최신순</td>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr>
        <td style="background-color:#FFFFFF; padding:10px; border-bottom:1px solid #e5e5e5"><table cellpadding="0" cellspacing="0" style="width:96%;margin:0 auto">
            <tbody>
              <tr>
                <td style="color:#cc0000; font-weight:bold; font-size:15px">hasd***</td>
              </tr>
              <tr>
                <td style="font-size:14px;"><!--a href="#" class="anchorLink"-->가입하고 한달간 10개 무료면 한번 해볼만 한데요?
</td>
              </tr>
              <tr>
                <td style="font-size:11px; color:#777777; padding-top:7px; letter-spacing:-1px"><span style="color:#CCCCCC"></span> 
                  <SCRIPT language="javascript">
						var today=new Date();
		
						today.setDate(today.getDate()-1); //하루 전
		
						var day = (today.getDate());
						var month = (today.getMonth() + 1) ;
		
						if(day < 10) day = '0' + day;
						if(month < 10) month = '0' + month;
		
						document.write(today.getFullYear(),"-",month,"-",day);
 				</SCRIPT>&nbsp;오전 11:51 <span style="color:#CCCCCC">|</span> 신고</td>
              </tr>
              <tr>
                <td align="right" style="padding-top:10px"><div style="height:30px;  background:url(http://img.issuepoll.net/lottoc/img_181014/re_4.png) no-repeat">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="60%"><img src="http://img.issuepoll.net/lottoc/img_181014/rere.jpg" style="width:57px"></td>
                          <td style="width:23%; height:30px;text-align: right;padding-right:5px"><img src="http://img.issuepoll.net/lottoc/img_181014/up1.jpg"style="width:57px"></td>
                          <td width="17%" height="30" align="right"><img src="http://img.issuepoll.net/lottoc/img_181014/down1.jpg"style="width:57px"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr>
        <td style="background-color:#FFFFFF; padding:10px; border-bottom:1px solid #e5e5e5"><table cellpadding="0" cellspacing="0" style="width:96%;margin:0 auto">
            <tbody>
              <tr>
                <td style="color:#cc0000; font-weight:bold; font-size:15px">bans***</td>
              </tr>
              <tr>
                <td style="font-size:14px;">가입해서 하고 있는데 로또 사고 처음으로 3등 나와봤네요~
</td>
              </tr>
              <tr>
                <td style="font-size:11px; color:#777777; padding-top:7px; letter-spacing:-1px"><span style="color:#CCCCCC"></span> 
                  <SCRIPT language="javascript">
						var today=new Date();
		
						today.setDate(today.getDate()-1); //하루 전
		
						var day = (today.getDate());
						var month = (today.getMonth() + 1) ;
		
						if(day < 10) day = '0' + day;
						if(month < 10) month = '0' + month;
		
						document.write(today.getFullYear(),"-",month,"-",day);
 				</SCRIPT>&nbsp;오후 13:52 <span style="color:#CCCCCC">|</span> 신고</td>
              </tr>
              <tr>
                <td align="right" style="padding-top:10px"><div style="height:30px; background:url(http://img.issuepoll.net/lottoc/img_181014/re_4.png) no-repeat">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="60%"><img src="http://img.issuepoll.net/lottoc/img_181014/rere.jpg" style="width:57px"></td>
                          <td style="width:23%; height:30px;text-align: right;padding-right:5px"><img src="http://img.issuepoll.net/lottoc/img_181014/up2.jpg" style="width:57px"></td>
                          <td width="17%" height="30" align="right"><img src="http://img.issuepoll.net/lottoc/img_181014/down2.jpg" style="width:57px"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr>
        <td style="background-color:#FFFFFF; padding:10px; border-bottom:1px solid #e5e5e5"><table cellpadding="0" cellspacing="0" style="width:96%;margin:0 auto">
            <tbody>
              <tr>
                <td style="color:#cc0000; font-weight:bold; font-size:15px">tp1081**</td>
              </tr>
              <tr>
                <td style="font-size:14px;"><!--a href="#db_table" class="anchorLink"--> 하면 할수록 번호가 조금씩 맞아가는걸 보니 진짜 효과는 있는거 같기도 하네요!
</td>
              </tr>
              <tr>
                <td style="font-size:11px; color:#777777; padding-top:7px; letter-spacing:-1px"><span style="color:#CCCCCC"></span> 
                  <SCRIPT language="javascript">
						var today=new Date();
		
						today.setDate(today.getDate()-2); //하루 전
		
						var day = (today.getDate());
						var month = (today.getMonth() + 1) ;
		
						if(day < 10) day = '0' + day;
						if(month < 10) month = '0' + month;
		
						document.write(today.getFullYear(),"-",month,"-",day);
 				</SCRIPT>&nbsp;오후 17:19 <span style="color:#CCCCCC">|</span> 신고</td>
              </tr>
              <tr>
                <td align="right" style="padding-top:10px"><div style="height:30px; background:url(http://img.issuepoll.net/lottoc/img_181014/re_4.png) no-repeat">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="60%"><img src="http://img.issuepoll.net/lottoc/img_181014/rere.jpg" style="width:57px"></td>
                          <td style="width:23%; height:30px;text-align: right;padding-right:5px"><img src="http://img.issuepoll.net/lottoc/img_181014/42.jpg" style="width:57px"></td>
                          <td width="17%" height="30" align="right"><img src="http://img.issuepoll.net/lottoc/img_181014/down.jpg" style="width:57px"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr>
        <td style="background-color:#FFFFFF; padding:10px; border-bottom:1px solid #e5e5e5"><table cellpadding="0" cellspacing="0" style="width:96%;margin:0 auto">            <tbody>
              <tr>
                <td style="color:#cc0000; font-weight:bold; font-size:15px">dkiejw**</td>
              </tr>
              <tr>
                <td style="font-size:14px;"><!--a href="#db_table" class="anchorLink"-->처음에는 진짜 되는가 싶었는데 3번만에 4등나와서 일단 계속 해보고있습니다..
</td>
              </tr>
              <tr>
                <td style="font-size:11px; color:#777777; padding-top:7px; letter-spacing:-1px"><span style="color:#CCCCCC"></span> 
                  <SCRIPT language="javascript">
						var today=new Date();
		
						today.setDate(today.getDate()-2); //하루 전
		
						var day = (today.getDate());
						var month = (today.getMonth() + 1) ;
		
						if(day < 10) day = '0' + day;
						if(month < 10) month = '0' + month;
		
						document.write(today.getFullYear(),"-",month,"-",day);
 				</SCRIPT>&nbsp;오후 17:19 <span style="color:#CCCCCC">|</span> 신고</td>
              </tr>
              <tr>
                <td align="right" style="padding-top:10px"><div style="height:30px; background:url(http://img.issuepoll.net/lottoc/img_181014/re_4.png) no-repeat">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="60%"><img src="http://img.issuepoll.net/lottoc/img_181014/rere.jpg" style="width:57px"></td>
                          <td style="width:23%; height:30px;text-align: right;padding-right:5px"><img src="http://img.issuepoll.net/lottoc/img_181014/up3.jpg" style="width:57px"></td>
                          <td width="17%" height="30" align="right"><img src="http://img.issuepoll.net/lottoc/img_181014/down.jpg" style="width:57px"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="http://img.issuepoll.net/lottoc/img_181014/footer.gif" border="0" style="width:100%"></td>
      </tr>
      <tr>
        <td height="50" align="center" valign="top" style="background-color: #f4f4f4; font-size: xx-small; color: #666666">&nbsp;</td>
      </tr>      
      
      <!--댓글끝-->

			</table>
		</div>
		<div style="margin-bottom:21%"></div>
	</body>
</html>
