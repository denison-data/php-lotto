<?php
exit;
if(!isset($_SESSION)) {
	session_start();
};
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
$dbc = dbOpen();

$uid = $_GET['uid'];

$que = "
Select * from member Where 1=1 And etc_userid = '{$uid}' And retire in ('n')
	
";
$res = dbQuery($que, $dbc);
$row = mysqli_fetch_array($res);
if(mysql_num_rows($res) > 0) {
	$time = date("Y-m-d H:i:s");
	$ups = "Update member Set login_datetime = '$time' Where etc_userid = '{$uid}' ";
	dbQuery($ups, $dbc);
	$ret = $_POST['rurl'];
	$_SESSION['userid'] = $row['etc_userid'];
	$_SESSION['nickname'] = $row['nickname'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['tel'] = $row['tel'];
	$_SESSION['code'] = $row['code'];
	$_SESSION['grade'] = $row['grade'];
	
	echo "<script>top.location.href='/';</script>";
}	else {
	echo "<script>alert('잘못된 접근입니다');top.location.href='/';</script>";
	exit;
}
?>