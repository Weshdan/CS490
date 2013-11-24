<?php
session_start();
//Resources:
//http://www.php.net/manual/en/book.curl.php
//http://blog.hernanjlarrea.com.ar/index.php/curl_aspnet/

if ($_POST) {
	$user = $_POST["user"];
	$pass = $_POST["pass"];
	$url = 'https://moodleauth00.njit.edu/cpip_serv/login.aspx?esname=moodle';

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
	curl_setopt($ch, CURLOPT_POST, 4);
	curl_setopt($ch, CURLOPT_POSTFIELDS, '__VIEWSTATE=%2FwEPDwUJNDIzOTY1MjU5ZGQdLVY%2B81xpmN0ATE7y41EHAhVaCA%3D%3D&txtUCID='.$user.'&txtPasswd='.$pass.'&btnLogin=Login&__EVENTVALIDATION=%2FwEWBAK7zbGBDQLr9O%2BIBwK01ba%2BBAKC3IeGDOn1GTxupWw9xfJhOXrBSFX6INdC');

	$out = curl_exec($ch);
	$check = curl_getinfo($ch);
		
	if ($check['url'] == 'http://njit.mrooms.net/'){
		$_SESSION['user']=$user;
		header("location: http://web.njit.edu/~wgs4/main.php?qry=validateUser");
	}else{
		echo 'Incorrect UCID or Password';
	}

curl_close($ch);

}else{
	echo "You either don't belong here or you made an incorrect ajax call";
}


?>


