#!/usr/bin/perl

use DBI();

$dbh=DBI->connect("DBI:mysql:database=jsudha;host=localhost","root","Sriranga@#$!");

$sth1=$dbh->prepare("select * from institution order by type, institution_id");
$sth1->execute();

system("mv ../jsd.xml ../jsd_old.xml");

open(OUT,">../jsd.xml") or die("cannot open");

print OUT "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<!DOCTYPE jsd SYSTEM \"jsd.dtd\">

<jsd>\n";

while($ref1=$sth1->fetchrow_hashref())
{
	$head=$ref1->{'head'};
	$type=$ref1->{'type'};
	$institute=$ref1->{'institute'};
	$address=$ref1->{'address'};
	$taluk=$ref1->{'taluk'};
	$district=$ref1->{'district'};
	$pin=$ref1->{'pin'};
	$cperson=$ref1->{'cperson'};
	$phone=$ref1->{'phone'};
	$email=$ref1->{'email'};
	$institution_id=$ref1->{'institution_id'};
	
	print OUT "\t<entry type=\"".$type."\" id=\"".$institution_id."\">\n";
	
	print OUT "\t\t<head>".$head."</head>\n";
	print OUT "\t\t<institute>".$institute."</institute>\n";
	print OUT "\t\t<address>".$address."</address>\n";
	print OUT "\t\t<taluk>".$taluk."</taluk>\n";
	print OUT "\t\t<district>".$district."</district>\n";
	print OUT "\t\t<pin>".$pin."</pin>\n";
	print OUT "\t\t<cperson>".$cperson."</cperson>\n";
	print OUT "\t\t<phone>".$phone."</phone>\n";
	print OUT "\t\t<email>".$email."</email>\n";
	
	print OUT "\t</entry>\n";
}

print OUT "</jsd>\n";

close(OUT);
$dbh->disconnect();
