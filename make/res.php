<?
//http://poorescape.co.kr/maker/maker_easy.html 고정수 / 제외수 선택후 번호 생성

$perfect[1]=array('A','B','C','D','E','F');
$perfect[2]=array('A','B','C','D','E','G');
$perfect[3]=array('A','B','C','D','F','G');
$perfect[4]=array('A','B','C','E','F','G');
$perfect[5]=array('A','B','D','E','F','G');
$perfect[6]=array('A','C','D','E','F','G');
$perfect[7]=array('B','C','D','E','F','G');

$code = 176;

$rank = intval(substr($code, 0, 1));// 순위
$sel_num = intval(substr($code, 1, -1));// 선택한번호 갯수
$match_num = intval(substr($code, -1));// 당첨번호에 포함 갯수

$_GET[balls] = [3,13,16,19,27,32,42];

$arrBall = array();
foreach($_GET[balls] as $key => $val) {
	if($val >= 1 && $val <= 45) {
		$arrBall[] = $val;
	} else {
		exit;
	}
}
$alpha = array_combine(array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'), array('0', '1', '2', '3','4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25'));


shuffle($arrBall);
shuffle($perfect);

$arrResult = array();

$i = 0;
foreach ($perfect as $arr) {
	foreach ($arr as $ball) {
		$ball = trim($ball);

		if($arrBall[$alpha[$ball]]) {
			$arrResult[$i][] = $arrBall[$alpha[$ball]];

		}else{
			$arrResult[$i][] = $alpha[$ball];
		}

	}
	sort($arrResult[$i]);
	$i++;
	
}
echo "<pre>";
print_r($arrResult);
echo "</pre>";
echo $rank."||".$sel_num."||".$match_num;

?>