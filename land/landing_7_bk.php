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
			h1 {color:#111;font-size:1.5rem; font-weight:600;padding:7% 5% 0 5%;line-height: 120%}
			h2 {padding:2% 0 0 6%; color:#666; }
			h1 span {font-size:1.35rem;color:red}
			p {text-align: justify;padding:0 5%; font-size:1.05rem;line-height: 160%;margin:7% 0}
			.db {border:2px solid #194b89}
			.dbdb {background-color: #f8f8f8; padding:7% 5%;text-align: center;}
			.dbdb input {border:1px solid #ccc; height:36px}
			.dbdb input, .db img {width:80%;box-sizing: border-box; line-height:30px;font-size:0.85rem;padding-left:10px;}
			.dbdb img {padding-left:0;margin-top:4%}
			.dbdb div:first-child {margin-bottom:2px}
			.url {font-size:0.73rem;padding:2%;background-color:#666;color:#fff}
		</style>
	</head>
<?
/*필수 이름이 없는경우는 noname 참고*/
include "./jquery_noname.html";
?>		
	<body style="max-width:640px; margin:0 auto">
		<img src="img_181014/img1.jpg">
		<div class="contents">
			<h1><span>[화제]</span> 로또 구매 수동? 자동? 당신의 선택은?</h1>
			<h2>- 로또 분석 업체의 필터링 시스템이 무엇이길래?<br>
- 수동 구매 비율 점점 높아져..
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
 			<img src="img_181014/sns_01.png" style="width:80px; height:24px;padding-left:10px">
</div>
			<p>직장인에게 일주일을 지내게 하는 한 줄기 빛과 같은 로또. 그런데 로또를 구매할 때마다 고민 되는 것이 있다. 바로 자동 구매냐, 수동 구매냐 하는 선택이다.<br>
나눔 로또에서 이전까지 발표된 데이터에 따르면 로또의 수동 구매 비율은 31% 안팎이며, 당첨 비율은 자동이 62%, 수동이 33%라고 한다. 이 데이터를 전제로 구매 수 대비 당첨 확률을 따지자면 자동에 비하여 수동 구매 쪽의 당첨이 통계적으로 좀 더 높은 것이다. 
</p>
			<img src="img_181014/img2.jpg">
			<!--img src="img_181014/img5.jpg" style="margin-top:5%;padding:0 5%;box-sizing: border-box"-->
			<p>이와 같이 점차 로또 수동 구매의 당첨 확률이 늘어날 수 있는 까닭은 최근 늘어나고 있는 로또 전문 분석 업체의 영향도 무시할 수 없을 것으로 보인다. 2002년 로또 복권 출범부터 10년 이상 로또 시스템을 연구하여 최근 최신 시스템으로 자체 리뉴얼을 마친 ‘미스터로또씨’에 따르면 로또 1등 당첨 번호에도 숨겨진 규칙이 있다고 한다.</p>
			<div class="db">
				<img src="img_181014/img7.jpg" style="width:100%;padding-left:0">
				<div class="dbdb">
					<!--div><input type="text" placeholder="이름을 입력해 주세요"></div-->
					<div>
						<select name="tel1" id="tel1" style="width:20%;height:36px;border-radius: 0;border:1px solid #d9d9d9;padding-left:10px">
		                    <option value="010">010</option>
		                    <option value="011">011</option>
		                    <option value="016">016</option>
		                    <option value="017">017</option>
		                    <option value="018">018</option>
		                    <option value="019">019</option>
						</select> - 
						<input type="tel" name="tel2" id="tel2" maxlength="4" style="width:27%;border:1px solid #d9d9d9"> - 
						<input type="tel" name="tel3" id="tel3" maxlength="4" style="width:27%;border:1px solid #d9d9d9">
						
					</div>
					<a href="javascript:;" id="create" ><img src="img_181014/img3.jpg"></a>
				</div>
			</div>
			<p>미스터로또씨는 총 4가지의 필터 시스템을 사용한다. 먼저 역대 전체 1등 당첨 DB를 분석하여 미스터로또씨만의 과학적 공식을 적용한다. 그 후 역대 뽑히지 않은 번호를 1차적으로 제외하는 변수 제거 시스템을 거쳐 패턴 및 비율을 예측한 후 압축 필터링을 통하여 번호 조합을 생성하는 것이다. 더 나아가 ‘미스터로또씨’ 는 프리미엄 회원을 대상으로 원하는 번호 혹은 원하지 않는 번호를 최대 3개까지 자유롭게 삽입하거나 제외하는 ‘초이스 넘버링’ 시스템을 사용하여 당첨 확률을 더욱 끌어 올리고 있다. 
(미스터로또씨 필터링시스템)
</p>
				<img src="img_181014/img4.jpg">
				<div class="url">출처: 미스터로또씨 홈페이지(http://www.mrlotto.co.kr/info/sub.php?dep=1)
</div>
				<p>업계 관계자는 “현재 굉장히 많은 업체가 로또 분석에 뛰어들고 있다. 이런 때일수록 분석 시스템을 꼼꼼히 따져 결정하는 현명한 소비가 필요하다.” 며 공신력 있는 분석 시스템 선택의 중요성을 강조하였다. 현재 미스터로또씨는 시스템 리뉴얼을 맞이하여 홈페이지 가입 시 1개월 간 10개의 무료 번호 조합을 발송하는 이벤트를 진행 중이며 그 외에도 다양한 할인을 진행하고 있다.

				</p>
		</div>
		<div style="margin-top:12%">
			<table>
				   <!--댓글-->
      <tr>
        <td style="padding-bottom:7px"><table cellpadding="0" cellspacing="0" style="width:96%;margin:0 auto">
            <tbody>
              <tr>
                <td style="width:70%;font-weight:bold; padding-left:10px; font-size:16px">댓글 <span style="color:#FF0000">82</span></td>
                <td style="width:30%;text-align: right;padding-right:10px"><img src="img_181014/write.jpg" style="width:70px"></td>
              </tr>
            </tbody>
          </table>
          
				<img src="img_181014/img6.jpg" style="margin-top:3%;margin-bottom:2%">
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
                <td align="right" style="padding-top:10px"><div style="height:30px;  background:url(img_181014/re_4.png) no-repeat">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="60%"><img src="img_181014/rere.jpg" style="width:57px"></td>
                          <td style="width:23%; height:30px;text-align: right;padding-right:5px"><img src="img_181014/up1.jpg"style="width:57px"></td>
                          <td width="17%" height="30" align="right"><img src="img_181014/down1.jpg"style="width:57px"></td>
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
                <td align="right" style="padding-top:10px"><div style="height:30px; background:url(img_181014/re_4.png) no-repeat">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="60%"><img src="img_181014/rere.jpg" style="width:57px"></td>
                          <td style="width:23%; height:30px;text-align: right;padding-right:5px"><img src="img_181014/up2.jpg" style="width:57px"></td>
                          <td width="17%" height="30" align="right"><img src="img_181014/down2.jpg" style="width:57px"></td>
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
                <td align="right" style="padding-top:10px"><div style="height:30px; background:url(img_181014/re_4.png) no-repeat">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="60%"><img src="img_181014/rere.jpg" style="width:57px"></td>
                          <td style="width:23%; height:30px;text-align: right;padding-right:5px"><img src="img_181014/42.jpg" style="width:57px"></td>
                          <td width="17%" height="30" align="right"><img src="img_181014/down.jpg" style="width:57px"></td>
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
                <td align="right" style="padding-top:10px"><div style="height:30px; background:url(img_181014/re_4.png) no-repeat">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="60%"><img src="img_181014/rere.jpg" style="width:57px"></td>
                          <td style="width:23%; height:30px;text-align: right;padding-right:5px"><img src="img_181014/up3.jpg" style="width:57px"></td>
                          <td width="17%" height="30" align="right"><img src="img_181014/down.jpg" style="width:57px"></td>
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
        <td><img src="img_181014/footer.gif" border="0" style="width:100%"></td>
      </tr>
      <tr>
        <td height="50" align="center" valign="top" style="background-color: #f4f4f4; font-size: xx-small; color: #666666">&nbsp;</td>
      </tr>      
      
      <!--댓글끝-->

			</table>
		</div>
	</body>
</html>
