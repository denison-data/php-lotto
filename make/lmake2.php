<?
exit;
ini_set('memory_limit', '-1'); 
set_time_limit(0);
include('/data/www/lotto/www/inc/func/common.php');
$dbc = dbOpen();

$que = "SELECT * FROM base_cb ORDER BY RAND()";
$res = dbQuery($que, $dbc);

$s= 0;

while($row = mysql_fetch_assoc($res)) {
	$arrB = str_split($row[cb], 2);

	//처음
	if($s == 0){
		$CB_GRP[0] = implode('', $arrB);
		for($a=1; $a <= 45; $a++) {
			$CB_CHK[0][str_pad($a, 2, '0', STR_PAD_LEFT)] = 0;
		}
		foreach($arrB as $b) {
			$CB_CHK[0][$b]++;
		}
		$s++;continue;
	}

	for($i = 0; $i <= count($CB_GRP); $i++) {
		//현재그룹의 조합수
		if($CB_GRP[$i]) {
			$cur_grp_count = (strlen($CB_GRP[$i])/2)/6;
		}else{
			$cur_grp_count = 0;
		}
		//10조합 꽉참 => insert
		if($cur_grp_count >= 10) {
			$que = "INSERT INTO base_cb_all3 SET cb = '{$CB_GRP[$i]}'";
			dbQuery($que, $dbc);
			unset($CB_GRP[$i]);
			unset($CB_CHK[$i]);
			$cur_grp_count = 0;
		}

		//현재 그룹이 <= 0 
		//처음일경우 $CB_CHK[$i] 초기화
		if($cur_grp_count <= 0) {
			for($a=1; $a <= 45; $a++) {
				$CB_CHK[$i][str_pad($a, 2, '0', STR_PAD_LEFT)] = 0;
			}
			$CB_GRP[$i] = implode('', $arrB);
			foreach($arrB as $b) {
				$CB_CHK[$i][$b]++;
			}
			break;
		}

		//현재그룹의 조합수가 
		//7개 이하일 경우
		if($cur_grp_count <= 6) {
			//볼6개가 $CB_GRP[$i]에 하나라도 포함되어 있는지 체크
			$blnContain = false;
			foreach($arrB as $b) {
				//포함되어 있다면 다음 그룹으로
				if($CB_CHK[$i][$b]){
					$blnContain = true;
					break;
				}
			}

			//포함되어 있지 않다면 현재 그룹에 포함
			if(!$blnContain) {
				foreach($arrB as $b) {
					$CB_CHK[$i][$b]++;
				}
				$CB_GRP[$i] .= implode('', $arrB);
				$cur_grp_count++;
				break;
			}

		//7개 초과
		} else {

			//0이 있는지 체크
			if(in_array(0, $CB_CHK[$i])){
				$chk_cnt = 0;
			}else{
				$chk_cnt = 1;
			}

			$isBreak = false;
			foreach($arrB as $b) {
				//볼6개중 현재그룹에 포함되지 않은수가 있을경우
				if($CB_CHK[$i][$b] == $chk_cnt){
					$isBreak = true;
					break;
				}
			}

			//현재 그룹에 포함
			if($isBreak){
				foreach($arrB as $b) {
					$CB_CHK[$i][$b]++;
				}
				$CB_GRP[$i] .= implode('', $arrB);
				$cur_grp_count++;
				break;
			}
		}
	}
}


$que = "SELECT * FROM base_cb ORDER BY RAND() ";
$res = dbQuery($que, $dbc);

while($row = mysql_fetch_assoc($res)) {
	$arrB = str_split($row[cb], 2);

	if(count($CB_GRP) <= 0){
		break;
	}

	foreach($CB_GRP as $i => $balls) {

		//현재그룹의 조합수
		$cur_grp_count = (strlen($CB_GRP[$i])/2)/6;

		//10조합 꽉참 => insert
		if($cur_grp_count >= 10) {
			$que = "INSERT INTO base_cb_all3 SET cb = '{$CB_GRP[$i]}'";
			dbQuery($que, $dbc);
			unset($CB_GRP[$i]);
			unset($CB_CHK[$i]);
			continue;
		}

		//현재그룹의 조합수가 
		//7개 이하일 경우
		if($cur_grp_count <= 6) {
			//볼6개가 $CB_GRP[$i]에 하나라도 포함되어 있는지 체크
			$blnContain = false;
			foreach($arrB as $b) {
				//포함되어 있다면 다음 그룹으로
				if($CB_CHK[$i][$b]) {
					$blnContain = true;
					break;
				}
			}

			//포함되어 있지 않다면 현재 그룹에 포함
			if(!$blnContain) {
				foreach($arrB as $b) {
					$CB_CHK[$i][$b]++;
				}
				$CB_GRP[$i] .= implode('', $arrB);
				break;
			}

		//7개 초과
		} else {

			//0이 있는지 체크
			if(in_array(0, $CB_CHK[$i])) {
				$chk_cnt = 0;
			} else {
				$chk_cnt = 1;
			}

			$isBreak = false;
			foreach($arrB as $b) {
				//볼6개중 현재그룹에 포함되지 않은수가 있을경우
				if($CB_CHK[$i][$b] == $chk_cnt) {
					$isBreak = true;
					break;
				}
			}

			//현재 그룹에 포함
			if($isBreak){
				foreach($arrB as $b) {
					$CB_CHK[$i][$b]++;
				}
				$CB_GRP[$i] .= implode('', $arrB);
				break;
			}
		}
	}
}
?>