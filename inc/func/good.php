<?
function getGoods($GNo, $order="desc", $gcode = ""){
	global $dbc;
	if(!$dbc){
		$dbc = dbOpen();
	}
	$arr = array();
	
	$que_where = 'Where ing_flag in (\'y\') And GNo in ("'.$GNo.'") ';
	if($gcode){
		$que_where .= " And Code in ('$gcode')";
	}
	if($GNo){
		$qry = "
			Select * 
			FROM `lotto_goods` g LEFT OUTER JOIN `lotto_good_option` o ON g.No = o.GNo
			{$que_where}
			ORDER BY oNo $order
		";
		if($gcode=="SI3"){
		//echo $qry."\n";
		}
		
		$res	=	dbQuery($qry, $dbc);
		while($row = mysqli_fetch_assoc($res)) {
			$arr[$row['oNo']] = $row;
		}
		
		return $arr;
		
	}
}
function ordrGoods($code, $limit = 1, $order = "desc"){
	global $dbc;
	if(!$dbc){
		$dbc = dbOpen();
	}
	$arr = array();
	$days  = date("Ymd");
	/* 종료여부임
	$que_where = "Where i.State in ('y') ";
	*/
	$que_where = "Where i.Order_State not in ('n','d')";

	if($code){
		$que_where .= " And i.mem_code in ('$code') ";
		$qry = "
			Select *, i.Order_No as odNo 
			from
			order_info i left outer join v_goods vg on i.g_code = vg.Code
			{$que_where}
			Order By Order_Date $order 
		";
		
		
		$res	=	dbQuery($qry, $dbc);
		$i=0;
		while($row = mysql_fetch_assoc($res)) {
			if($days>= $row['Start_Date'] && $days <= $row['Finish_Date']){
				$ar[] = $row;
			} else {
				if($days <= $row['Finish_Date']){
					$ar2[] = $row;	
				}else {
					$ar2[] = null;
				}
				//
			}
			
			if($_SERVER['REMOTE_ADDR']=="183.109.79.201"){
				//echo $row['Start_Date']."||".$row['Finish_Date']." || $days<br>";
				if($days>= $row['Start_Date'] && $days <= $row['Finish_Date']){
				//	echo "<br>현재일 시작일이 큰경우 $days || $row[Start_Date] || $row[Finish_Date]";
				} else {
					if($days <= $row['Finish_Date']){
				//		echo "<br>현재일 시작일이 ww경우 $days || $row[Start_Date] || $row[Finish_Date]";
					}
				}
				
			}
			$i++;
		
		}
		
		$arr = array_merge($ar, $ar2);
		if($_SERVER['REMOTE_ADDR']=="183.109.79.201"){
			//echo "<pre>";
			//print_r(($arr));
			//echo "</pre>";
		}
		return $arr;
	}
}
function nordrGoods($code, $limit = 1, $order = "desc"){
	global $dbc;
	if(!$dbc){
		$dbc = dbOpen();
	}
	$arr = array();
	
	/* 종료여부임
	$que_where = "Where i.State in ('y') ";
	*/
	$que_where = "Where i.Order_State not in ('y','d') ";
		
	if($code){
		$que_where .= " And i.mem_code in ('$code') ";
		$qry = "
			Select *, i.No as odNo 
			from
			order_info i left outer join v_goods vg on i.g_code = vg.Code
			{$que_where}
			Order By Order_Date $order 
		";
		
		
		$res	=	dbQuery($qry, $dbc);
		while($row = mysql_fetch_assoc($res)) {
			$arr[$row['odNo']] = $row;
		}
		return $arr;
	}
}
?>