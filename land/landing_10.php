<?
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');

//print_r($_SESSION);
function MobileCheck() { 
    global $_SERVER;
	$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
    $MobileArray  = array("iphone","lgtelecom","skt","mobile","samsung","nokia","blackberry","android","android","sony","phone"); 

    $checkCount = 0; 
        for($i=0; $i<sizeof($MobileArray); $i++){ 
            if(preg_match("/$MobileArray[$i]/", strtolower($HTTP_USER_AGENT))){ $checkCount++; break; } 
        } 
   return ($checkCount >= 1) ? "Mobile" : "Computer"; 
}
$Mobile = MobileCheck();
$now_url = siteURL();

if($Mobile=="Mobile"){
	$move_url = $_SERVER['REQUEST_URI'];
	$move_url = str_replace("10.php","10_m.php",$move_url);
		header("Location: $move_url"); 
}


function siteURL() {
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
	$_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domainName = $_SERVER['HTTP_HOST'];
	return $protocol.$domainName.$_SERVER['REQUEST_URI'];
}
?>
<!doctype html>
<html lang="ko">
	<head>
		<title>로또씨만의 고유 기술, 리얼필터시스템</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" href="css/reset2.css">
			
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery.bpopup.min.js"></script>
					<script>
						;(function($) {

					         // DOM Ready
					        $(function() {
					
					            // Binding a click event
					            // From jQuery v.1.7.0 use .on() instead of .bind()
					            $('#my-button').bind('click', function(e) {
					
					                // Prevents the default action to be triggered. 
					                e.preventDefault();
					
					                // Triggering bPopup when click event is fired
					                $('#element_to_pop_up').bPopup();
					
					            });
					
					        });
					
					    })(jQuery);
					</script>
		<style>
			#element_to_pop_up {display: none}
		</style>
	</head>
	<?
include "./jquery.html";
	?>	
	<body style="background: url('http://img.issuepoll.net/lottoc/bg.jpg') center -15px;">
		<div style="max-width: 1280px;margin: 0 auto">
			<div style="padding:80px 0 0 55px;">
				<ul>
					<li><img src="http://img.issuepoll.net/lottoc/txt1.png"></li>
					<li style="padding:15px 0 30px 0"><img src="http://img.issuepoll.net/lottoc/txt222.png"></li>
					<li><img src="http://img.issuepoll.net/lottoc/txt3.png"></li>
				</ul>
			</div>
			<div style="margin-top:85px;background: url('http://img.issuepoll.net/lottoc/dbbg.jpg') center top;text-align: center;padding:75px 0 0 0;">
				<ul>
					<li><img src="http://img.issuepoll.net/lottoc/db1.jpg"></li>
					<li style="margin-top:45px">
						<span><img src="http://img.issuepoll.net/lottoc/db2.jpg" style="padding-top:9px"></span>
						<input type="text" style="height:42px;border-radius: 30px;border: none;line-height: 42px;padding-left:13px; font-size:15px;box-sizing: border-box;width:185px;margin-right:30px" placeholder="이름" name="uname" id="uname">
						<span style="padding-right:18px"><img src="http://img.issuepoll.net/lottoc/db3.jpg" style="padding-top:9px"></span>
						<input type="tel" name="tel" id="tel" style="height:42px;border-radius: 30px;border: none;line-height: 42px;padding-left:13px; font-size:15px;box-sizing: border-box;width:320px" placeholder="-를 제외하고 입력하세요">
						<span style="margin-left:80px"><a href="javascript:;" id="create"><img src="http://img.issuepoll.net/lottoc/dbbt.jpg"></a></span>
					</li>
					<li style="display: inline-block;padding:15px 0 10px 0"><input type="checkbox" id="check" style="width:15px;height:15px;vertical-align: middle" checked><label for="check"><img src="http://img.issuepoll.net/lottoc/db4.jpg" style="padding-top:4px;margin:0 10px 0 5px"><a href="pri.php" target="_blank" id="my-button"><img src="http://img.issuepoll.net/lottoc/db5.jpg"></a></label>
					
					<div id="element_to_pop_up" style="background-color:#fff;margin-top:40px">
						<iframe src="pri.php" width="800" height="800" style="padding:30px;box-sizing: border-box"></iframe>
					</div>    
					
					</li>
					<li style="padding-bottom:50px;letter-spacing: -1px;color:#888">* 미성년자는 로또를 구매할 수 없으므로 신청이 불가능합니다.</li>
				</ul>
			</div>
		</div>
			<div style="max-width: 1280px;margin: 0 auto;font-size: 0.75em;text-align: center;padding-bottom:1%">미스터퀀트 주식회사&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEL : 1811-7335&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FAX : 02-2067-3090&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;대표이사 : 조정윤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;개인정보책임관리자 : 조정윤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;사업자등록번호 : 547-88-01224&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;주소 : 서울특별시 금천구 가산디지털1로 142, 1118호 (가산동, 가산더스카이밸리 1차)</div>
			
	</body>
</html>
