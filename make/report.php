<?
set_time_limit(0);
include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
$dbc = dbOpen();

$limit = "30";

if($_POST['sseq']){
	$que_where = "WHERE seq BETWEEN '{$start_seq}' AND '{$end_seq}'";
}
$que = "SELECT *, b1+b2+b3+b4+b5+b6 AS btotal FROM lotto_winning {$que_where} ORDER BY seq desc Limit 134";
$data	=	dbQuery($que, $dbc);

$arrBall = array('b1', 'b2', 'b3', 'b4', 'b5', 'b6');

?>
<table border="1">
<tr>
	<td>회차</td>
	<td>홀수</td>
	<td>짝수</td>
	<td>홀수비율</td>
	<td>짝수비율</td>
	<td>높은수</td>
	<td>낮은수</td>
	<td>당첨번호 총합</td>
	<td>조합 끝자리</td>
	<td>끝자리더한합</td>
	<td>연속번호</td>
</tr>
<?
$ltotal  = 6;
$lmit = 23;
for($i=0;$row=mysqli_fetch_array($data);$i++){
	$odd[$row['seq']] = 0;//홀
	$even[$row['seq']] = 0;//짝

	$high[$row['seq']] = 0;//고
	$low[$row['seq']] = 0;//저
	foreach($arrBall as $field){
		$nums[$row['seq']][] = substr($row[$field],-1);
	}

	foreach($arrBall as $field){
		if($row[$field] % 2 == 1){ 
			$odd[$row['seq']] = $odd[$row['seq']] +1;
		} else {
			$even[$row['seq']] = $even[$row['seq']]+1;
		}
		if($row[$field] >= 23){ 
			$high[$row['seq']]++; 
		} else {
			$low[$row['seq']]++;
		}		
	}
	$epersent[$row['seq']] = sprintf("%0.2f",($even[$row['seq']]/$ltotal)*100);
	$opersent[$row['seq']] = sprintf("%0.2f",($odd[$row['seq']]/$ltotal)*100);

	$hpersent[$row['seq']] = sprintf("%0.2f",($high[$row['seq']]/$ltotal)*100);
	$lpersent[$row['seq']] = sprintf("%0.2f",($low[$row['seq']]/$ltotal)*100);

?>
<tr>
	<td><?=$row['seq']?>회</td>
	
	<td>
		
		<?=$odd[$row['seq']]?>
	</td>
	<td>
		
		<?=$even[$row['seq']]?>
	</td>
	<td>
		<?=$epersent[$row['seq']]?>
	</td>
	<td>
		<?=$opersent[$row['seq']]?>
	</td>
	<td>
		
		<?=$high[$row['seq']]?><!--(<?=$hpersent?>) | <?=$low?>(<?=$lpersent?>)--->
	</td>
	<td>
		 <?=$low[$row['seq']]?>
	</td>
	<td>		
		<?=$row['btotal']?>
	</td>
	<td>
		<?
		
		foreach(array_unique($nums[$row['seq']]) as $nn){
			echo $nn.",";	
		}
		?>
	</td>
	<td>
		<?
		
		foreach(($nums[$row['seq']]) as $nn){
			$ttal[$row['seq']] += $nn;
		}
		echo $ttal[$row['seq']];
		?>
	</td>
	<td>
		<?
		$v = 1;
		$next_field = '';
		
		foreach(getBallField() as $field => $var) {
			$firnum = $row[$var];
			$fd = 'b'.$v;
			$next_field = 'b'.($v+1);

			$prev_field = 'b'.($v-1);
			$diff = $row[$next_field] - $row[$var];
			if($row[$var]=="1"){
				$diff2 = "-1";
			} else {
				$diff2 = $row[$var] - $row[$prev_field];
				
			}

			
			if($diff==1 || $diff2==1){
				$nn = $row[$var].",";
				echo $nn;
			}
			$v++;
		}
		?>
	</td>
</tr>
<?
}
?>
</table>