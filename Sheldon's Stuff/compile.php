<?php

session_start();

if($_POST) {
	$url = 'http://web.njit.edu/~sam53/servlet/bshservlet/eval';
	$script = $_POST["script"];
	$test = $_POST["test"];
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "bsh.script=".urlencode($script)."");

	$out = curl_exec($ch);
	curl_close($ch);

	if (preg_match_all('/<pre>(.*?)<\/pre>/s', $out, $list)) {
		$list[0][1] = trim(strip_tags($list[0][1]));
		if ($list[0][1] == $test){
			echo 'correct';
		} else {
			echo 'incorrect';
		}
	} else {
		if(preg_match('/<td bgcolor="#eeeeee">(.*?)<\/td>/s', $out, $list)) {
			preg_match("/'' :(.*?)<hr>/s",$list[0], $error);
			echo trim(strip_tags($error[0]));
		}
	}
	
} else {
	echo "You either don't belong here or you made an incorrect ajax call";
}
?>


