<?php

session_start();

$url = 'http://web.njit.edu/~sam53/servlet/bshservlet/eval';
$script = $_POST["script"];
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "bsh.script=".$script."");


$out = curl_exec($ch);




curl_close($ch);


$tag = '/<pre>(.*?)<\/pre>/s';
if (preg_match($tag, $out, $list))
	echo $list[0];
else
	$tag = '/<td bgcolor="#eeeeee">(.*?)<\/td>/s';
	preg_match($tag, $out, $list);
	echo $list[0];

?>


