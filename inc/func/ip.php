<?
function getIP(){
	global $dbc;
	if(!$dbc){
		$dbc = dbOpen();
	}
	$arr = array();
	
	$qry = "
		Select * 
		FROM ip_block
		Where 1=1 And del_flag in ('n')
	";
	//echo $qry."\n";
	$res	=	dbQuery($qry, $dbc);
	while($row = mysql_fetch_assoc($res)) {
		$arr[] = $row['ip'];
	}
	return $arr;

}
?>