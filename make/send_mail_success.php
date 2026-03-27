<?php

	$nameFrom  = "미스터로또관리자";
    $mailFrom = "webmaster@mrlottoc.com";
    $nameTo  = "수신인"; //받는사람
    $mailTo = "denison@lumieyes.com";
   // $cc = "funcorea@nate.com";
    //$bcc = "denison@lumieyes.com";
    $subject = "제목입니다.!!!";
	
	$mail_html = "../mail/confirm.php";
	$fp=fopen($mail_html,"r");
	fseek($fp,0);	
	$code = "11111";
	$mail_content=fread($fp,filesize($mail_html));
	$mail_content=str_replace("__login__","<a href=\"http://www.mrlotto.co.kr/member/ck.php?mode=mem_logins&code=$code\" target=\"_new\" style=\"background: rgb(42,83,154);background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);border:none; border-radius: 4px;padding:15px 30px;color:#fff;display:inline-block;width:230px;margin-top:30px; font-size:22px; font-weight:400\">로그인 하러 가기</a>",$mail_content);
	$content = $mail_content;
	

    $charset = "UTF-8";

    $nameFrom   = "=?$charset?B?".base64_encode($nameFrom)."?=";
    $nameTo   = "=?$charset?B?".base64_encode($nameTo)."?=";
    $subject = "=?$charset?B?".base64_encode($subject)."?=";

    $header  = "Content-Type: text/html; charset=utf-8\r\n";
    $header .= "MIME-Version: 1.0\r\n";

    $header .= "Return-Path: <". $mailFrom .">\r\n";
    $header .= "From: ". $nameFrom ." <". $mailFrom .">\r\n";
    $header .= "Reply-To: <". $mailFrom .">\r\n";
    if ($cc)  $header .= "Cc: ". $cc ."\r\n";
    if ($bcc) $header .= "Bcc: ". $bcc ."\r\n";

    $result = mail($mailTo, $subject, $content, $header, $mailFrom);

print_r($result);
?>