<?
header('Content-Type: text/html; charset=utf-8');

## Cache 방지용
header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . " GMT" );
header( "Cache-Control: no-store, no-cache, must-revalidate" );
header( "Cache-Control: post-check=0, pre-check=0", false );
header( "Pragma: no-cache" );
#######################################

@$hostname=$_SERVER['HTTP_HOST']; 

if(strpos($hostname, "www4") !== false) {   
	$css_url = str_replace("www4","css",$hostname);
	$img_url = str_replace("www4","image",$hostname);
	$js_url = str_replace("www4","js",$hostname);
} else {
	
	$css_url = str_replace("www","css",$hostname)."/add-css";
	$img_url = str_replace("www","image",$hostname)."/add-img";
	$js_url = str_replace("www","js",$hostname)."/add-js";
}

define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);
define('NCI',"KEWz31KwXWWepXcBUSWp");
define('NCS',"Gxs2y8KuVv");
define('NCU',"http://".$hostname."/member/callback_naver_join.php");
$naver_state = md5(microtime().mt_rand());
$naver_apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".NCI."&redirect_uri=".urlencode(NCU)."&state=".$naver_state;

$nicepay_key = "frqTnzaF1mP3Zo+TVsCKnN3Nq4gqSMZLp0nte2pL+dfF9whV0JdRh+cKwABcKwWWvySmPxJ5kSKtzLq1qtwVrQ==";
$merchantID       = "APG033295m";

include dirname(__FILE__)."/lotto.php";
include dirname(__FILE__)."/bbs.php";
include dirname(__FILE__)."/good.php";
include dirname(__FILE__)."/member.php";
include dirname(__FILE__)."/db.php";
include dirname(__FILE__)."/mail.php";
include dirname(__FILE__)."/ip.php";

$send_date = 0;
$sms_id = "mrlotto";
$sms_key = "9ab5307363d1c10c500d0b5f57bb9bc2";
$sms_send_phone = "1811-7335"; 

function getCode($size=5)
{
	$pattern = "12HIghqrPQYZRbx3VWf4EKLcdeCDwMXAByzaUN67J8n50opTSijklm9OvFGstu";
	$strcount=strlen($pattern);
	$key=$pattern{rand(0,$strcount-1)};
	for($i=1;$i<$size;$i++)
	{
	    $key.=$pattern{rand(0,$strcount-1)};
	}
	return $key;
}

define('RECOMMEND_LIMIT_COUNT', 30);//추천번호 최대수
define('MAX_BUY_COUNT', 1000);//구매한 조합 회차별 최대 보관 조합수
define('MAX_BOOKMARK_COUNT', 100);//즐겨찾기 최대 보관 조합수
define('MAX_MAKER_COUNT', 1000);//생성한 조합 최대 보관 조합수

$emailArray = array(
"naver.com"=>"naver.com",
"nate.com"=>"nate.com",
"gmail.com"=>"gmail.com",
"hanmail.net"=>"hanmail.net",
"daum.net"=>"daum.net",
"yahoo.com"=>"yahoo.com",
"e"=>"직접입력"
);

/*기준시간 date(w)*/
$mDay = "6";
$mTime = "16";
$mobile_dir = "/m";

$mobilechk = '/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/i';

if(@preg_match($mobilechk, $_SERVER['HTTP_USER_AGENT'])) {
	ini_set("session.cache_expire", 31536000);  //1년
	ini_set("session.gc_maxlifetime", 31536000); //1년
}

/*
$ip_data = getIP();
if(in_array('183.109.79.201',$ip_data)){
	echo "<meta charset='utf-8'>관리자에게 문의 바랍니다(IP가 차단되었습니다.)";
	exit;
}*/

