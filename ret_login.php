<?
/* login 연동 https://developers.naver.com/apps/#/list */
/* 로그인 처리*/
$Client_id = "KEWz31KwXWWepXcBUSWp";

$Client_sec = "Gxs2y8KuVv";

//  $client_id = "YOUR_CLIENT_ID";
$redirectURI = urlencode("http://www.mrlotto.co.kr/member/join_naver.php");
  $state = "RAMDOM_STATE";
  $apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$Client_id."&redirect_uri=".$redirectURI."&state=".$state;


/*
$url = "https://openapi.naver.com/v1/nid/me";
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "Authorization: ".$header;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
*/
?><a href="<?php echo $apiURL ?>"><img height="50" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>
