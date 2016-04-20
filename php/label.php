<?php

session_start();

if(isset($_SESSION['userid']))
{
	if($_SESSION['userid'] == 'sjs@math')
	{
		@header('Location: deny.php');
	}

	include("connect.php");

	$today = getdate();
	$date = $today['mday'] . "-" . $today['mon'] . "-" . $today['year'];
	$from = "If undelived, please return the package to\nSri Ramakrishna Ashrama, Yadavagiri, Mysore - 570020";

	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");

	require('fpdf.php');
	$pdf = new FPDF('L','mm','A4');

	$bno = $_GET['bn'];

	$res = mysql_query("select * from payment where batch='$bno' or batch like '$bno;%' or batch like '%;$bno'");
	$block = 5;

	//echo "<br/>" . $dat ;
	//echo mysql_num_rows($res);
	//return;
	for($i=0;$i<mysql_num_rows($res);$i++)
	{
		if($block != 6)
		{
			$row = mysql_fetch_assoc($res);
			$schoolid = $row['schoolid'];
			$schoolname = $row['t_1_1'];
			$add = $row['t_1_2'];
			$add = preg_replace("/\n/"," ",$add);
			$tal = $row['t_1_3'];
			$dis = $row['t_1_4'];
			$pin = $row['t_1_5'];
			$phn = $row['t_1_7'];
			$address = $schoolname . "\n\n" . $add;
			if($tal != "")
				$address = $address . "\n" . $tal . " Taluk";
			if($dis != "")
				$address = $address . "\n" . $dis . " District";
			if($pin != "")
				$address = $address . " - " . $pin;
			if($phn != "")
				$address = $address . "\nContact No. : " . $phn;
				
			$address = preg_replace("/\./",". ",$address);
			$address = ucwords(strtolower($address));
			$address = preg_replace("/\bPu\b/","PU",$address);
			
			$cata = explode(";",$row['t_2_1']);
			$catb = explode(";",$row['t_2_2']);
			$catc = explode(";",$row['t_2_3']);
			$batch = explode(";",$row['batch']);
			$cat1 = 0;
			$cat2 = 0;
			$cat3 = 0;
			for($j=0;$j<count($batch);$j++)
			{
				if($batch[$j] == $bno)
				{
					$cat1 = $cat1 + $cata[$j];
					$cat2 = $cat2 + $catb[$j];
					$cat3 = $cat3 + $catc[$j];
				}
			}
			$total = $cat1 + $cat2 + $cat3;
			//echo $schoolid . "  " . $cat1 . "  " . $cat2 . "  " . $cat3 . "<br/>";
		}
		
		if($block == 5  || $block == 6)
		{
			$block = 1;
			$pdf->AddPage();
			$pdf->SetTitle('hello');
			$pdf->SetFont('Arial','',12);
			$pdf->SetAutoPageBreak(0);
			$pdf->SetMargins(0,0,0);
		}
		
		if($block == 1)
		{
			if($total > 100)
			{
				$cat = CheckTotalBooklets($cat1,$cat2,$cat3);
				$cat1 = $cat[1];
				$cat2 = $cat[2];
				$cat3 = $cat[3];
			}
			
			$pdf->Line(10,10,143,10);
			$pdf->Line(143,10,143,100);
			$pdf->Line(143,100,10,100);
			$pdf->Line(10,100,10,10);
			
			//$pdf->SetXY(110,5);
			//$pdf->Cell(0,0,"Date : " . $date,0,0);
			$pdf->SetXY(11,13);
			$pdf->Cell(0,0,"Institution ID: " . $schoolid,0,0);
			
			/*$pdf->SetLeftMargin(8);
			$pdf->SetXY(8,10);
			$pdf->Cell(0,5,"Cat A : " . $cat1 . "  Booklet No - From:                      To:                      ",0,1);
			$pdf->Cell(0,5,"Cat B : " . $cat2 . "  Booklet No - From:                      To:                      ",0,1);
			$pdf->Cell(0,5,"Cat C : " . $cat3 . "  Booklet No - From:                      To:                      ",0,1);*/
			
			$pdf->SetXY(11,20);
			$pdf->Cell(0,0,"To:",0,0);
			$pdf->SetFont('Arial','B',16);
			$pdf->SetLeftMargin(13);
			$pdf->SetXY(13,24);
			$pdf->MultiCell(130,7,$address,0,'L');
			
			$pdf->SetFont('Arial','',12);
			$pdf->SetLeftMargin(24);
			$pdf->SetY(88);
			$pdf->MultiCell(0,5,$from,0,'L');
			$pdf->Image('logo.jpg',11,87,12,12);
			
			if($total > 100)
			{
				$total = $cat[0];
				$cat1 = $cat[4];
				$cat2 = $cat[5];
				$cat3 = $cat[6];
				$block++;
			}
		}
		if($block == 2)
		{
			if($total > 100)
			{
				$cat = CheckTotalBooklets($cat1,$cat2,$cat3);
				$cat1 = $cat[1];
				$cat2 = $cat[2];
				$cat3 = $cat[3];
			}
			
			$pdf->Line(153,10,287,10);
			$pdf->Line(287,10,287,100);
			$pdf->Line(287,100,153,100);
			$pdf->Line(153,100,153,10);
			
			//$pdf->SetXY(258,5);
			//$pdf->Cell(0,0,"Date : " . $date,0,0);
			$pdf->SetFont('Arial','',12);
			$pdf->SetXY(154,13);
			$pdf->Cell(0,0,"Institution ID: " . $schoolid,0,0);
			
			/*$pdf->SetLeftMargin(156);
			$pdf->SetXY(156,10);
			$pdf->Cell(0,5,"Cat A : " . $cat1 . "  Booklet No - From:                      To:                      ",0,1);
			$pdf->Cell(0,5,"Cat B : " . $cat2 . "  Booklet No - From:                      To:                      ",0,1);
			$pdf->Cell(0,5,"Cat C : " . $cat3 . "  Booklet No - From:                      To:                      ",0,1);*/
			
			$pdf->SetXY(154,20);
			$pdf->Cell(0,0,"To:",0,0);
			$pdf->SetFont('Arial','B',16);
			$pdf->SetLeftMargin(153);
			$pdf->SetXY(156,24);
			$pdf->MultiCell(130,7,$address,0,'L');
			
			$pdf->SetFont('Arial','',12);
			$pdf->SetLeftMargin(167);
			$pdf->SetY(88);
			$pdf->MultiCell(0,5,$from,0,'L');
			$pdf->Image('logo.jpg',154,87,12,12);
			
			if($total > 100)
			{
				$total = $cat[0];
				$cat1 = $cat[4];
				$cat2 = $cat[5];
				$cat3 = $cat[6];
				$block++;
			}
		}
		if($block == 3)
		{
			if($total > 100)
			{
				$cat = CheckTotalBooklets($cat1,$cat2,$cat3);
				$cat1 = $cat[1];
				$cat2 = $cat[2];
				$cat3 = $cat[3];
			}
			
			$pdf->Line(10,110,143,110);
			$pdf->Line(143,110,143,200);
			$pdf->Line(143,200,10,200);
			$pdf->Line(10,200,10,110);
			
			//$pdf->SetXY(110,110);
			//$pdf->Cell(0,0,"Date : " . $date,0,0);
			$pdf->SetFont('Arial','',12);
			$pdf->SetXY(11,113);
			$pdf->Cell(0,0,"Institution ID: " . $schoolid,0,0);
			
			/*$pdf->SetLeftMargin(8);
			$pdf->SetXY(8,115);
			$pdf->Cell(0,5,"Cat A : " . $cat1 . "  Booklet No - From:                      To:                      ",0,1);
			$pdf->Cell(0,5,"Cat B : " . $cat2 . "  Booklet No - From:                      To:                      ",0,1);
			$pdf->Cell(0,5,"Cat C : " . $cat3 . "  Booklet No - From:                      To:                      ",0,1);*/
			
			$pdf->SetXY(11,120);
			$pdf->Cell(0,0,"To:",0,0);
			$pdf->SetFont('Arial','B',16);
			$pdf->SetLeftMargin(13);
			$pdf->SetXY(13,124);
			$pdf->MultiCell(130,7,$address,0,'L');
			
			$pdf->SetFont('Arial','',12);
			$pdf->SetLeftMargin(24);
			$pdf->SetY(188);
			$pdf->MultiCell(0,5,$from,0,'L');
			$pdf->Image('logo.jpg',11,187,12,12);
			
			if($total > 100)
			{
				$total = $cat[0];
				$cat1 = $cat[4];
				$cat2 = $cat[5];
				$cat3 = $cat[6];
				$block++;
			}
		}
		if($block == 4)
		{
			if($total > 100)
			{
				$cat = CheckTotalBooklets($cat1,$cat2,$cat3);
				$cat1 = $cat[1];
				$cat2 = $cat[2];
				$cat3 = $cat[3];
			}
			
			$pdf->Line(153,110,287,110);
			$pdf->Line(287,110,287,200);
			$pdf->Line(287,200,153,200);
			$pdf->Line(153,200,153,110);
			
			//$pdf->SetXY(258,110);
			//$pdf->Cell(0,0,"Date : " . $date,0,0);
			$pdf->SetFont('Arial','',12);
			$pdf->SetXY(154,113);
			$pdf->Cell(0,0,"Institution ID: " . $schoolid,0,0);
			
			/*$pdf->SetLeftMargin(156);
			$pdf->SetXY(156,115);
			$pdf->Cell(0,5,"Cat A : " . $cat1 . "  Booklet No - From:                      To:                      ",0,1);
			$pdf->Cell(0,5,"Cat B : " . $cat2 . "  Booklet No - From:                      To:                      ",0,1);
			$pdf->Cell(0,5,"Cat C : " . $cat3 . "  Booklet No - From:                      To:                      ",0,1);*/

			$pdf->SetXY(154,120);
			$pdf->Cell(0,0,"To:",0,0);
			$pdf->SetFont('Arial','B',16);
			$pdf->SetLeftMargin(153);
			$pdf->SetXY(156,124);
			$pdf->MultiCell(130,7,$address,0,'L');
			
			$pdf->SetFont('Arial','',12);
			$pdf->SetLeftMargin(167);
			$pdf->SetY(188);
			$pdf->MultiCell(0,5,$from,0,'L');
			$pdf->Image('logo.jpg',154,187,12,12);
			
			if($total > 100)
			{
				$total = $cat[0];
				$cat1 = $cat[4];
				$cat2 = $cat[5];
				$cat3 = $cat[6];
				$block++;
			}
		}
		$block++;
		if($block == 6)
			$i--;
	}


	$pdf->Output();
	
}
else
{
	@header('Location: login.php');
}
?>
