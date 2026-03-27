<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>★슬림웨이 타임딜★ 오직 이 페이지에서만! </title>
	<link rel="stylesheet" href="https://slimway.dailyissue.co.kr/comm/css/reset.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
	<script src="https://slimway.dailyissue.co.kr/comm/js/jquery.vticker.min.js"></script>
	<script type="text/javascript" src="//nadm.dailyissue.co.kr/ipc.php"></script>
    <style>
		@font-face {
			font-family: 'DS-DIGIB';    font-style: normal;    font-weight: 100;
			src: url(https://slimway.dailyissue.co.kr/comm/css/fonts/DS-DIGIB.TTF) format('truetype');
		}
		img {width:100%;}
		body {background-color:#000; color:#fff;}
		main {max-width:750px; margin:0 auto;}

		.intro {position:relative;}
		.intro .eventdate {position: absolute; transform: translate(-50%, -50%); top: 69%; left: 50%;}
		.eventdate, .eventdate * {font-size: 2rem; text-wrap:nowrap;}
		.obj {position:absolute; transform:translate(-50%, -50%); z-index:0;}
		.obj1 {top: 61.2%; left: -16%; z-index: 0; width: 51%; transform: scaleX(-1);}
		.obj2 {top: 98.2%; right: -19%; z-index: 0; width:29%;}

		#time_wrap {
			/* background-color:pink; */
			text-align: center; position:relative; z-index:10;
		}
		#time_wrap > p,#time_wrap > p * {font-size: 2.5rem; font-weight: 600; line-height:2.5; text-shadow:0px 1px 11px #000;}
		.timer {
			/* background-color: aqua; */
			display:flex; justify-content:center; gap:5%; font-size: 5rem; line-height:1;
			/* color:#fff; */
		}
		/* .timer li {background-color:#fff; padding:2%;} */
		.timer li span { font-size:7rem; font-weight: 600; color:#fff; font-family: "DS-DIGIB";}
		h3 {font-size: 2.0rem; text-align: center; line-height: 2.5;}

		/* iframe */
		.iframe-wrapper {
		padding: 5px;/* 테두리 두께만큼 패딩 설정 */
		background: linear-gradient(45deg, #f00, #ff931a);/* 그라디언트 배경 설정 */
		border-radius: 20px;/* 라운드 설정 */
		}
		
		.iframe-container {
			width: 100%; height: 0; padding-bottom: 56.25%;/* 16:9 비율을 유지하기 위해 패딩 설정 */
			position: relative; border-radius: 15px;/* 라운드 설정 */
			overflow: hidden;/* 라운드 테두리 적용을 위해 overflow hidden */
			background: #fff;/* 내부 백그라운드 설정 */
		}
		
		.iframe-container iframe {
			position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; border-radius: 15px;/* 내부 아이프레임 라운드 설정 */
		}

		/* 실시간현황 */
		.rolling_wrap .rolling_title {
			font-size: 2rem; line-height:2; text-align: center; color: #fff; font-weight: 500;
			background-color: #f00;
		}
		.rolling_wrap .rolling_title img { margin: 0 auto; }
		.rolling_wrap .rolling_wrap {
			background-color:#faf6f5; padding: 4%;
			border-radius:0 0 10px 10px; border: 2px solid #c8c8c8;
		}
		.rolling_list {height:250px !important; overflow:hidden;}
		.rolling_list li {
			display: flex; justify-content:space-between; align-items:center; height:60px; padding:0 3%;
			font-size: 1.0rem; border-bottom: 1px solid #c8c8c8; transition: all 0.5s ease-in-out;
		}
		.rolling_list li > span {/* flex: 0 0 30%; */ white-space: nowrap; }
		.rolling_list li > span:first-child, .rolling_list ul li > span:last-child { flex-basis: 20%; text-align: center; }
		.rolling_list li > span > span { padding: 4px; border: 1px solid #ccc; border-radius: 6px; font-size: 80%; }
		.rolling_list li > span.status_finish > span { background-color: #f4d439; color: #000; border: 0; }
		.list_name, .list_number { text-align: center; }

		/* db단 */
		form {background-color:#212121; color:#fff; padding:3%;}
		form p, form p * {text-align:center; line-height:5.5;}
		form a {color:#fff;}
		form dd {display:flex; justify-content:space-between; margin:3% 0;}
		form dd input[type="radio"]+label {text-align:center; background-color:#fff; color:#222;}
		form dd input[type="radio"]:checked+label {background-color: #fa2d0e; color: #fff; font-weight: 700;}
		form .btn {text-align:center;}

		.question input {display:none;}
		.question dl dt, .question dl dt * {font-size:2rem; line-height:2;}
		.question dl dt span.hl {color:#fff; font-weight:600; background-color:#fa2d0e; margin-right:1%; padding:0 1%;}
		.question dl dt span.min {font-size:0.8rem;}
		.question .q1 dd {justify-content:center; flex-flow:wrap; gap:10px 2%}
		.question .q1 input+label {font-size:1.2rem; padding:2% 1%; border-radius:5px; width:32%;}
		.question .q2 label {width:30%;}

		.info {max-width:700px; margin:0 auto;}
		.info dl {display:flex; justify-content:space-between; align-items:center;}
		.info dt {width:20%; text-align:center; font-size:1.5rem; font-weight:500;}
		.info dd {width:75%;}
		.info dd input, .info dd select, .info dd label {display:inline-block; width:100%; line-height:3;}
		.info .callnum dd input, .info .callnum dd select {width:29%; height:47px;}
		.info .gender dd input {display:none;}
		.info .gender dd input+label {width:47%;}

		footer { padding: 20px 10px; text-align: center; line-height:1.5; font-size:10px; color:#aaa;}

		@media screen and (max-width:700px){
			main {overflow:hidden;}
			form p, form p * {font-size:0.8rem;}
			.eventdate, .eventdate * {font-size: 1.5rem;}
			.timer {line-height:0.5;}
			#time_wrap > p,#time_wrap > p * {font-size: 2rem;}
			.timer li span {font-size:5rem;}
			h3 {font-size:1.3rem;}
			.rolling_wrap .rolling_title {font-size:1.5rem;}
		}
		@media screen and (max-width:553px){
			.question dl dt, .question dl dt * {font-size:1.35rem; letter-spacing:-0.06rem;}
			.question .q1 input+label {font-size:0.9rem; width:30%; letter-spacing:-0.06rem;}
		}
		@media screen and (max-width:500px){
			.info dt {font-size:1.1rem;}
			h3 {font-size:1rem;}
			.timer {font-size: 4rem;}
		}
	</style>
<script>
const lumieyes = {
	data : {
		name : null,
		phone : null,
		gender : null,
		age : null,
		q1 : null,
		q2 : null,
		q3 : null,
		q4 : null,
		q5 : null,
		q1_txt : null,
		qEtc : null,
		question : null,
		sourceTraffic : null,
		userAgent : null,
		code : null,
		num : null,
		sourceTraffic : null
	}

}
function CheckQryStr(sname){
    var params = location.search.substr(location.search.indexOf("?") + 1);
    var sval = "";
    params = params.split("&");
    for (var i = 0; i < params.length; i++) {
        temp = params[i].split("=");
        if ([temp[0]] == sname) { sval = temp[1]; }
    }
    return sval;
}
function setData(form){
	var xhr = new XMLHttpRequest();
	xhr.onloadend = function() {		
		 if (xhr.status == 200) {
			var rs = JSON.parse(xhr.response);
			console.log("res :", rs);
			if(rs["commit"]=="success")
			{
				if(lumieyes.data.num.length!=0){
					retVal(lumieyes.data.num, lumieyes.data)
				} else {
					retVal("",lumieyes.data);
				}
				lumieyes.data.q1 = null;lumieyes.data.q2 = null;lumieyes.data.q3 = null;lumieyes.data.q4 = null;lumieyes.data.q5 = null;lumieyes.data.qEtc = null;		
			
			} else {
				console.log("Result");
				lumieyes.data.q1 = null;lumieyes.data.q2 = null;lumieyes.data.q3 = null;lumieyes.data.q4 = null;lumieyes.data.q5 = null;lumieyes.data.qEtc = null;		
			
				return false;
			}
			form.reset();
			alert("등록되었습니다.");
			
		 } else {
			console.log("error " + this.status);
		 }
	}
	
	xhr.open("POST", form.action, true);
	xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
	xhr.send(JSON.stringify(lumieyes.data));
	
}
function getUserAgent(){
	var agent = navigator.userAgent.toLowerCase(),
        name = navigator.appName,
        browser = '';
	
    if(name === 'Microsoft Internet Explorer' || agent.indexOf('trident') > -1 || agent.indexOf('edge/') > -1) {
        browser = 'Internet Explorer ';
        if(name === 'Microsoft Internet Explorer') { // IE old version (IE 10 or Lower)
            agent = /msie ([0-9]{1,}[\.0-9]{0,})/.exec(agent);
            browser += parseInt(agent[1]);
        } else { // IE 11+
            if(agent.indexOf('trident') > -1) { // IE 11
                browser += 11;
            } else if(agent.indexOf('edge/') > -1) { // Edge
                browser = 'Edge';
            }
        }
    } else if(agent.indexOf('safari') > -1) { // Chrome or Safari
        if(agent.indexOf('opr') > -1) { // Opera
            browser = 'Opera';
        } else if(agent.indexOf('chrome') > -1) { // Chrome
            browser = 'Chrome';
        } else if(agent.indexOf('kakao') >-1){
			browser = 'KakaoTalk Safari';
		} else { // Safari
            browser = 'Safari';
        }
    } else if(agent.indexOf('firefox') > -1) { // Firefox
        browser = 'Firefox';
    } else if(agent.indexOf('kakao') >-1){
		browser = 'KakaoTalk';
	}
	//alert(agent);
	return browser;
}
function init(){
	//console.log(lumieyes);
	lumieyes.data['sourceTraffic'] = window.location.href;
	lumieyes.data['num'] = CheckQryStr("num");
	lumieyes.data['userAgent'] = getUserAgent();
}
function isEmpty(str){
	var sss = str.replace(/\s/gi,"");
	//console.log(sss);
	return sss;
}
function sendForm(btn){
	let form = btn.parentNode;
	while( form.tagName != "FORM"){form = form.parentNode;}
	let checked = true;
	
	for(var key =0; key < form.elements.length;key++){
		if(isNaN(key)) break;    //
		const attr = form.elements[key];		
		
		if(attr.readOnly == true){
			continue;
		}else if(attr.type == "text"){
			if(attr.id=="question"){
				lumieyes.data[attr.name] = attr.value;
			} else {
				(isEmpty(attr.value).length) ? lumieyes.data[attr.name] = isEmpty(attr.value) : checked = false;
			}
		}else if(attr.type == "number"){
			(isEmpty(attr.value).length) ? lumieyes.data[attr.name] = isEmpty(attr.value) : checked = false;
		}else if(attr.type == "tel"){
			(isEmpty(attr.value).length) ? lumieyes.data[attr.name] = isEmpty(attr.value) : checked = false;
		}else if( (attr.type == "checkbox") && (attr.value.length) ){
			if (attr.checked === true ) {
				if (lumieyes.data[attr.name]) {
					// 중복된 값 제거
					let values = lumieyes.data[attr.name].split(',');
					if (!values.includes(attr.value)) {
						values.push(attr.value);
						lumieyes.data[attr.name] = values.join(',');
					}
				} else {
					lumieyes.data[attr.name] = attr.value;
				}
			}
            console.log(attr.name);
			//if(lumieyes.data[attr.name] !== null){lumieyes.data[attr.name] = lumieyes.data[attr.name].replace("null/", "");}
            console.log("ck:"+lumieyes.data[attr.name])
		}else if(attr.type == "radio"){
			if(attr.checked === true) lumieyes.data[attr.name] = attr.value; 
		}else{
			lumieyes.data[attr.name] = isEmpty(attr.value);
		}
		if(attr.name=="age"){
			//console.log(attr.value);
			if(attr.value.length){
				var agevalue = attr.value;
				agevalue.trim();  
				if(isNumeric(agevalue)==true){
					checked = true;
				} else {
					alert('숫자만 기입해주세요.');
					attr.value="";
					attr.focus();
					checked = false;
					break;
				}
			}
		}
		if(attr.name=="age"){
			//console.log(attr.value);
			if(attr.value.length){
				if(attr.value<20 || attr.value > 99){
					alert('20세 이상만 신청이 가능합니다');
					attr.value="";
					attr.focus();
					checked= false;
					break;
				} else {
					checked = true;
				}
			}
		}
		if(attr.name=="cellnum2" || attr.name=="cellnum3"){
			if(attr.value.length){
				if(attr.value.length != 4){
					alert('전화번호 숫자가 모자랍니다');
					attr.focus();
					checked= false;
					break;
				} else {
					checked = true;
				}
			}
		}
		if(attr.name=="phone"){
			if(attr.value.length){
				if(attr.value.length != 11){
					alert('전화번호 숫자가 모자랍니다');
					attr.focus();
					checked= false;
					break;
				} else {
					checked = true;
				}
			}
		}
		if(checked == false){
			attr.value="";
			alert('필수입력입니다.');
			attr.focus();
			break;
		}
	
	}
	if(checked) setData(form);
}
init();

function isNumeric(num, opt){
  // 좌우 trim(공백제거)을 해준다.
  num = String(num).replace(/^\s+|\s+$/g, "");
 
  if(typeof opt == "undefined" || opt == "1"){
    // 모든 10진수 (부호 선택, 자릿수구분기호 선택, 소수점 선택)
    var regex = /^[+\-]?(([1-9][0-9]{0,2}(,[0-9]{3})*)|[0-9]+){1}(\.[0-9]+)?$/g;
  }else if(opt == "2"){
    // 부호 미사용, 자릿수구분기호 선택, 소수점 선택
    var regex = /^(([1-9][0-9]{0,2}(,[0-9]{3})*)|[0-9]+){1}(\.[0-9]+)?$/g;
  }else if(opt == "3"){
    // 부호 미사용, 자릿수구분기호 미사용, 소수점 선택
    var regex = /^[0-9]+(\.[0-9]+)?$/g;
  }else{
    // only 숫자만(부호 미사용, 자릿수구분기호 미사용, 소수점 미사용)
    var regex = /^[0-9]$/g;
  }
 
  if( regex.test(num) ){
    num = num.replace(/,/g, "");
    return isNaN(num) ? false : true;
  }else{ return false;  }
}

		var getIp = ip();
		function retVal(num, ldata){
			var phone = "";
        if(ldata['phone']){
                phone = ldata['phone'];
        } else {
                phone = ldata['cellnum']+ldata['cellnum2']+ldata['cellnum3'];
        }
        if(ldata){
            console.log(ldata);

        }

    }
    </script>
<!-- 디비단 -->
<dd>
								<label>
									<!-- <img src="https://slimway.dailyissue.co.kr/comm/images/q-01_off.jpg"> -->
									<input type="checkbox" name="q2" value="팔뚝전체" id="q2">aaa
								</label>
								<label>
									<!-- <img src="https://slimway.dailyissue.co.kr/comm/images/q-02_off.jpg"> -->
									<input type="checkbox" name="q2" value="뱃살전체" id="q2">bbb
								</label>
								<label>
									<!-- <img src="https://slimway.dailyissue.co.kr/comm/images/q-03_off.jpg"> -->
									<input type="checkbox" name="q2" value="다리전체" id="q2">bccc
								</label>
							</dd>
							
<div id="db2" class="db_wrap">
				<form action="https://api.dailyissue.co.kr/users?tb=240627_slim">
					<input type="hidden" name="landing" value="24/c/d3/01_m2">
					<div class="question">
						<dl class="q1">
							<dt>1. <span class="hl">몇 kg 감량</span>하고 싶으신가요?</dt>
							<dd>
								<input type="radio" id="q1-1mb" name="q1" value="3-5" checked><label for="q1-1mb">3~5kg</label>
								<input type="radio" id="q1-2mb" name="q1" value="6-8"><label for="q1-2mb">6~8kg</label>
								<input type="radio" id="q1-3mb" name="q1" value="9-11"><label for="q1-3mb">9~11kg</label>
								<input type="radio" id="q1-4mb" name="q1" value="12-14"><label for="q1-4mb">12~14kg</label>
								<input type="radio" id="q1-5mb" name="q1" value="15kg 이상"><label for="q1-5mb">15kg 이상</label>
							</dd>
						</dl>
						<dl class="q2">
							<dt>2. <span class="hl">특별히 빼고</span>싶은 부위는? <span class="min">(중복가능)</span></dt>
							<dd>
								<label>
									<img src="https://slimway.dailyissue.co.kr/comm/images/q-01_off.jpg">
									<input type="checkbox" name="q2" value="팔뚝전체" id="q2">
								</label>
								<label>
									<img src="https://slimway.dailyissue.co.kr/comm/images/q-02_off.jpg">
									<input type="checkbox" name="q2" value="뱃살전체" id="q2">
								</label>
								<label>
									<img src="https://slimway.dailyissue.co.kr/comm/images/q-03_off.jpg">
									<input type="checkbox" name="q2" value="다리전체" id="q2">
								</label>
							</dd>
						</dl>
					</div>
					<div class="info">
						<dl class="name">
							<dt class="title">이름</dt>
							<dd class="contents">
								<input type="text" name="username" class="form-control" placeholder="이름을 적어주세요" maxlength="10">
							</dd>
						</dl>
						<dl class="age">
							<dt class="title">나이</dt>
							<dd class="contents">
								<input type="tel" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="age" class="form-control" maxlength="2" placeholder="나이를 적어주세요">
							</dd>
						</dl>
						<dl class="gender">
							<dt>성별</dt>
							<dd>
								<input type="radio" checked id="gen-1mb" name="gender" value="여성"><label for="gen-1mb">여성</label>
								<input type="radio" id="gen-2mb" name="gender" value="남성"><label for="gen-2mb">남성</label>
							</dd>
						</dl>
						<dl class="callnum">
							<dt class="title">연락처</dt>
							<dd class="contents">
								<select name="cellnum" class="form-control">
									<option value="010">010</option>
									<!-- <option value="011">011</option>
									<option value="016">016</option>
									<option value="017">017</option>
									<option value="018">018</option>
									<option value="019">019</option> -->
								</select> -
								<input type="tel" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="cellnum2" id="im" class="form-control" size="4" maxlength="4"> -
								<input type="tel" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="cellnum3" id="im" class="form-control" size="4" maxlength="4">
							</dd>
						</dl>
						<p>
							<label>
								<input type="checkbox" name="agree" id="agree" value="Y" checked /> 개인정보 수집 및 이용동의
								<a href="https://slimway.dailyissue.co.kr/privacy.html" target="_blank">(약관보기)</a>
							</label>
						</p>
					</div>
					<div class="btn">
						<button type="button" onClick="javascript:sendForm(this);return false" class="btn btn-accent btn-block btn-lg">
							<img src="https://slimway.dailyissue.co.kr/comm/images/button2.gif" alt="">
						</button>
					</div>
				</form>
			</div>


            <script>

                
		// db단 이미지 변경
		$('input[name="q2"]').bind('click', function(){
			//설문이미지
			var src = $(this.parentNode).children('img').attr('src');
			if(src.indexOf('off')>-1){
				$(this.parentNode).children('img').attr('src', src.replace('_off', '_on'));
			}else if(src.indexOf('on')>-1){
				$(this.parentNode).children('img').attr('src', src.replace('_on', '_off'));
			}
		});


        </script>