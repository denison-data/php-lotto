<?
/*로그인 세션 남기기*/
session_start();

$userid = $_POST['userid'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$tel = $_POST['tel'];

$_SESSION['userid'] = $userid;
$_SESSION['nickname'] = $nickname;
$_SESSION['email'] = $email;
$_SESSION['tel'] = $tel;


print_r($_SESSION);

?>