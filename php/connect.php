<?php
$user='root';
$password='mysql';
$database='jsudha';

date_default_timezone_set("Asia/Calcutta");

function CheckTotalBooklets($c1,$c2,$c3)
{
	$c = array();
	$c[0] = $c1 + $c2 + $c3 - 100;
	if($c1 > 100)
	{
		$c[4] = $c1 - 100;
		$c[1] = 100;
		$c[2] = 0;
		$c[3] = 0;
		$c[5] = $c2;
		$c[6] = $c3;
	}
	elseif($c2 > 100)
	{
		$c[5] = $c2 - 100;
		$c[1] = 0;
		$c[2] = 100;
		$c[3] = 0;
		$c[4] = $c1;
		$c[6] = $c3;
	}
	elseif($c3 > 100)
	{
		$c[6] = $c3 - 100;
		$c[1] = 0;
		$c[2] = 0;
		$c[3] = 100;
		$c[4] = $c1;
		$c[5] = $c2;
	}
	elseif(($c1 + $c2) > 100)
	{
		$c[1] = $c1;
		$c[2] = 100 - $c1;
		$c[3] = 0;
		$c[4] = 0;
		$c[5] = $c1 + $c2 - 100;
		$c[6] = $c3;
	}
	elseif(($c2 + $c3) > 100)
	{
		$c[1] = 0;
		$c[2] = $c2;
		$c[3] = 100 - $c2;
		$c[4] = $c1;
		$c[5] = 0;
		$c[6] = $c2 + $c3 - 100;
	}
	elseif(($c3 + $c1) > 100)
	{
		$c[1] = $c1;
		$c[2] = 0;
		$c[3] = 100 - $c1;
		$c[4] = 0;
		$c[5] = $c2;
		$c[6] = $c1 + $c3 - 100;
	}
	elseif(($c1 + $c2 + $c3) > 100)
	{
		$c[1] = $c1;
		$c[2] = $c2;
		$c[3] = 100 - $c1 - $c2;
		$c[4] = 0;
		$c[5] = 0;
		$c[6] = $c1 + $c2 + $c3 - 100;
	}
	
	return $c;
}

function rs_to_words($no)
{
	$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
	if($no == 0)
	{
		return '';
	}
	else
	{
		$novalue='';
		$highno=$no;
		$remainno=0;
		$value=100;
		$value1=1000;
		while($no>=100)
		{
			if(($value <= $no) &&($no < $value1))
			{
				$novalue=$words["$value"];
				$highno = (int)($no/$value);
				$remainno = $no % $value;
				break;
			}
			$value= $value1;
			$value1 = $value * 100;
		}
		if(array_key_exists("$highno",$words))
		return $words["$highno"]." ".$novalue." ".rs_to_words($remainno);
		else
		{
			$unit=$highno%10;
			$ten =(int)($highno/10)*10;
			return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".rs_to_words($remainno);
		}
	}
}

?>
