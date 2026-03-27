<?
function login_check(){
	global $_SESSION;
	if(!$_SESSION['userid']){
		if($_SERVER['PHP_SELF']){
			$url = "/member/login.php?target=".$_SERVER['PHP_SELF'];
		}else {
			$url = "/";
		}
		echo "<script>alert('다시 로그인 해주세요');top.location.href='".$url."';</script>";
	}
	
	//echo $_SERVER['PHP_SELF'];
}
function login_check_m(){
	global $_SESSION, $_SERVER;
	if(!$_SESSION['userid']){
		if($_SERVER['PHP_SELF']){
			$url = "/m/member/login.php?target=".$_SERVER['PHP_SELF'];
		}else {
			$url = "/m/";
		}
		echo "<script>alert('다시 로그인 해주세요');top.location.href='".$url."';</script>";
	}
	
	//echo $_SERVER['PHP_SELF'];
}
function login_level($dep,$ment="", $loc=""){
	global $_SESSION;
	if($_SESSION['grade']!=$dep){
		if($ment || $loc){
			echo "<script>alert(' $ment.');top.location.href='$loc'</script>";		
		} else {
			echo "<script>alert(' 금지되어있습니다.');history.go(-1);</script>";		
		}
	}
}
?>