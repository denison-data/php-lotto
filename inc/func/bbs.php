<?

function getBbsList($start_seq=0, $end_seq=0, $division="n", $orderby='desc'){
	global $dbc;
	
	if(!$dbc){
		$dbc = dbOpen();
	}
	$arr = array();
	$que_where = 'Where del_flag in (\'n\') And live_on in (\'y\')';
	if($division){
		$que_where .= " And division in ('$division') ";
	}
	if($end_seq){
		$limit = "Limit $start_seq, $end_seq";
	}
	if($orderby=="rand"){
		$que = "SELECT * FROM bbs {$que_where}
		ORDER BY Rand()
		$limit
		";

	} else {
		$que = "SELECT * FROM bbs {$que_where}
		ORDER BY reg_datetime {$orderby}
		$limit
		";

	}
	

	$res	=	dbQuery($que, $dbc);
	while($row = mysqli_fetch_assoc($res)) {
		$arr[$row['uid']] = $row;
	}
	return $arr;
}
function page_move_event($page, $page_row, $page_scale, $total_count, $_VAR="")
{
    $total_page  = ceil($total_count / $page_row);	
    $paging_str = "";	
    // 4-4. 페이징에 표시될 시작 페이지 구하기
    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;
 
    // 4-5. 페이징에 표시될 마지막 페이지 구하기
    $end_page = $start_page + $page_scale - 1;
    if ($end_page >= $total_page) $end_page = $total_page;
	
	if($page==1){
		$paging_str .= "<li><a href='javascript:;'><</a></li>\n";
	} else {
		$paging_str .= "<li><a href='".$_SERVER['PHP_SELF']."?page=".($page - 1)."$_VAR'><</a></li>\n";
	}
    // 4-7. 페이지들 출력 부분 링크 만들기
    if ($total_page > 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            if ($page != $i){
                $paging_str .= "<li><a href='".$_SERVER['PHP_SELF']."?page=".$i."$_VAR'>$i</a></li>\n";
            }else{
                $paging_str .= "<li><a href='javascript:;' class='on'>$i</a></li> ";
            }
        }
    } else {
		$paging_str .= "<li><a href='javascript:;' class='on'>1</a></li> ";
	}
 
    // 4-8. 다음 페이징 영역으로 가는 링크 만들기

    if ($total_page > $end_page || $total_page > $page){
        $paging_str .= "<li><a href='".$_SERVER['PHP_SELF']."?page=".($page + 1)."$_VAR'>></a></li>";
    } else {

		$paging_str .= "<li><a href='javascript:;'>></a></li>";
	}
    return $paging_str;
}
function page_move_event_m($page, $page_row, $page_scale, $total_count, $_VAR="")
{
	global $img_url;
    $total_page  = ceil($total_count / $page_row);	
    $paging_str = "";	
    // 4-4. 페이징에 표시될 시작 페이지 구하기
    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;
 
    // 4-5. 페이징에 표시될 마지막 페이지 구하기
    $end_page = $start_page + $page_scale - 1;
    if ($end_page >= $total_page) $end_page = $total_page;
	
	if($page==1){
		$paging_str .= "<span><img src='http://".$img_url."/mobile/paging_prev.jpg'></span>\n";
	} else {
		$paging_str .= "<span><a href='".$_SERVER['PHP_SELF']."?page=".($page - 1)."$_VAR'><</a></span>\n";
	}
    // 4-7. 페이지들 출력 부분 링크 만들기
    if ($total_page > 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            if ($page != $i){
                $paging_str .= "<span><a href='".$_SERVER['PHP_SELF']."?page=".$i."$_VAR'>$i</a></span>\n";
            }else{
                $paging_str .= "<span><a href='javascript:;' class='paging_on'>$i</a></span> ";
            }
        }
    } else {
		$paging_str .= "<span><a href='javascript:;' class='paging_on'>1</a></span> ";
	}
 
    // 4-8. 다음 페이징 영역으로 가는 링크 만들기

    if ($total_page > $end_page || $total_page > $page){
        $paging_str .= "<span><a href='".$_SERVER['PHP_SELF']."?page=".($page + 1)."$_VAR'><img src='http://".$img_url."/mobile/paging_next_on.jpg'></a></span>";
    } else {

		$paging_str .= "<span><a href='javascript:;'><img src='http://".$img_url."/mobile/paging_next_on.jpg'></a></span>";
	}
    return $paging_str;
}
?>