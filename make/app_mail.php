<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');

/*
$member_arr =array(
"qhrwjata@naver.com"=>"김지후",
"sm820603@naver.com"=>"전상민",
"lha2613@naver.com"=>"이현아",
"dhwntn00@naver.com"=>"전영",
"rlsprkdl1@naver.com"=>"김동준",
"kimmi1207@naver.com"=>"김미",
"platseb@hanmail.net"=>"조연우",
"skdhd0096@hanmail.net"=>"박상국",
"1046886344"=>"장경숙",
"adspjs@naver.com"=>"박지숙",
"brave135@naver.com"=>"염진호",
"jaemin00211@naver.com"=>"김홍수",
"1072707142"=>"나수환",
"1077312662"=>"김호성",
"Open107lycos@nate.com"=>"이상가",
"koosh1122@naver.com"=>"구소희",
"k12b34i52@gmail.com"=>"김병인",
"suin2027@naver.com"=>"김수희",
"jsd1597@gmail.com"=>"정순보 ",
"tymaestro21@naver.com"=>"전왕명",
"bcs0915@nate.com"=>"변천석",
"zomleey@naver.com"=>"이용진",
"dope303a@naver.com"=>"문경호",
"hjd0565@naver.com"=>"문연희",
"64370859@naver.com"=>"김선호",
"8987gwak@naver.com"=>"곽윤호 ",
"cyh1584@daum.net"=>"최영환 ",
"snows3944@naver.com"=>"이재화",
"wjddncjf1212@naver.com"=>"정우철",
"scbv109@naver.com"=>"이준영",
"ehaud18@naver.com"=>"최도명",
"benagirls@naver.com"=>"성소연",
"30124869@hanmail.net"=>"임소이",
"yaya0410 @hanmail.net"=>"김덕선",
"okmp333@naver.com"=>"박경원",
"SONG @naver.com"=>"송하령",
"gyeongno6248@hanmail.net"=>"손경노",
"hy30217 @naver.com"=>"이혜영",
"oi486@naver.com"=>"오다경",
"kkkkbomi@naver.com"=>"김보미",
"leews20038@hanmail.net@naver.com"=>"이우성",
"dnfksrb1210@naver.com"=>"우란규",
"mj72cm@naver.com"=>"조명자",
"smi7611@naver.com"=>"김선미",
"csc0206@@hanmail.net"=>"천수철",
"tu2nim@gmail.com"=>"김화복",
"lovehae138@naver.com"=>"서상기",
"jeno75@naver.com"=>"신문선",
"doshik1052@naver.com"=>"김도식",
"smjh7070@naver.com"=>"김재홍"
);*/
$mem_a = array(
	"denison@lumieyes.com"=>"이상현",
	"denison2@nate.com"=>"이상현"
	
);
foreach($mem_a as $n => $t ){
	func_sendmail($t,$n);
	
}
function func_sendmail($nameTo, $mailTo){
	$nameFrom  = "미스터로또관리자";
    $mailFrom = "webmaster@mrlotto.co.kr";
    $nameTo  = $nameTo; //받는사람
    $mailTo = $mailTo;
    $subject = "[미스터로또] 에서 사과의 말씀을 드릴까요 [".date("Y-m-d H:i:s")."]";
	$mail_html = $_SERVER[DOCUMENT_ROOT]."mail/app.php";
	$fp=fopen($mail_html,"r");
	fseek($fp,0);	
	
	$mail_content=fread($fp,filesize($mail_html));
	
	$content = $mail_content;
	
	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
	$nameFrom = "=?UTF-8?B?".base64_encode($nameFrom)."?=";

	$dMail = new Sendmail; 
	$dMail->setUseSMTPServer(true); 
	$ip = $REMOTE_ADDR;
	$dMail->setSMTPServer($ip); 
	$dMail->setFrom($mailFrom, $nameFrom); 
	$dMail->setSubject($subject); 
	$dMail->setMailBody($content, true); 
	$dMail->addTo($mailTo, "=?UTF-8?B?".base64_encode($ID).'?='); 
	$dMail->send();	
	echo "<pre>";
	var_dump($dMail);
	echo "</pre>";
}
?>