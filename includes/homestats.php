<?php

//calculate the qa score phone+email
//$param1 is the username passed from the calling page
function qa_score($param1)
{
$db = new PDO('mysql:host=localhost;dbname=pitstop', 'root', '');
$db->exec("SET CHARACTER SET utf8");
$sth = $db->prepare("select audit_score from qa where agent_id = :username");
$sth->bindParam(':username', $param1);
$sth->execute();
$sum=0;
$count=0;
while ($row = $sth->fetch(PDO::FETCH_ASSOC))
{
	$sum = $sum + $row['audit_score'];
	$count++;
}
if ($count == 0)
	{
		echo "85";
	}
else
	{
		$average_qa = $sum / $count;
		echo round($average_qa, 2);
	}
}

//calculate the resolution rate Phone or email based on parameter passed
//$param1 is the username and $param2 is the channel passed by the calling page
function res_rate($param1, $param2)
{
	$db = new PDO('mysql:host=localhost;dbname=pitstop', 'root', '');
	$db->exec("SET CHARACTER SET utf8");
	$sth = $db->prepare("select `FCR` from csat_dump where `SBT Agent` = :username and `SBT Channel Name`=:channel");
	$sth->bindParam(':username', $param1);
	$sth->bindParam(':channel', $param2);
	$sth->execute();
	$sum=0;
	$count=0;
	while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$sum = $sum + $row['FCR'];
		$count++;
	}
	if ($count == 0)
	{
		echo "85";
	}
	else
	{
		$fcr = $sum/$count*100;
		echo round($fcr, 2);
	}
}

//Calculate csat phone or email based on parameter passed
//$param1 is the username and $param2 is the channel passed by the calling page
function get_csat($param1, $param2)
{
	$db = new PDO('mysql:host=localhost;dbname=pitstop', 'root', '');
	$db->exec("SET CHARACTER SET utf8");
	$sth = $db->prepare("select `SBT Q1 (Email overall score)` from csat_dump where `SBT Agent` = :username and `SBT Channel Name`=:channel");
	$sth->bindParam(':username', $param1);
	$sth->bindParam(':channel', $param2);
	$sth->execute();
	$sum=0;
	$count=0;
	while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$sum = $sum + $row['SBT Q1 (Email overall score)'];
		$count++;
	}
	if ($count == 0)
	{
		echo "8";
	}
	else
	{
		$average_csat = $sum / $count;
		echo round($average_csat, 2);
	}
}
?>
