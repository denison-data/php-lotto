<?php
	
	include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');

	$nameFrom  = "미스터로또관리자";
    $mailFrom = "webmaster@mrlottoc.com";
    $nameTo  = "수신인"; //받는사람
    $mailTo = "denison@lumieyes.com";
	//$mailTo = "denison0918@gmail.com";
   // $cc = "funcorea@nate.com";"이상현" <denison0918@gmail.com> 	
	//$mailTo = "denison2@nate.com";
    $subject = "[미스터로또] 에서 사과의 말씀을 드립니다dr";
	
	$mail_html = $_SERVER[DOCUMENT_ROOT]."/mail/app.php";
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
	echo $content;
?>