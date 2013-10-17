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
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '__VIEWSTATE=%2FwEPDwUJNDIzOTY1MjU5ZGQdLVY%2B81xpmN0ATE7y41EHAhVaCA%3D%3D&txtUCID='.$user.'&txtPasswd='.$pass.'&btnLogin=Login&__EVENTVALIDATION=%2FwEWBAK7zbGBDQLr9O%2BIBwK01ba%2BBAKC3IeGDOn1GTxupWw9xfJhOXrBSFX6INdC');


$out = curl_exec($ch);
$check = curl_getinfo($ch);

if ($check['url'] == 'http://njit.mrooms.net/'){
	$_SESSION['user']=$user;
	$_SESSION['status'] = 'authorized';
	header("location:http://web.njit.edu/~wgs4/main.php");
}else{
	$_SESSION['response'] = "You have entered invalid login credentials";
	header("location:http://web.njit.edu/~dc98/CS490/login.php");
	}


//print_r(curl_error($ch));
//print_r(curl_getinfo($ch));
//print_r(curl_errno($ch));

curl_close($ch);

}else{
	if($_SESSION['status'] !='authorized') 
		header("location:http://web.njit.edu/~dc98/CS490/login.php");
	else
		header("location:http://web.njit.edu/~dc98/CS490/lobby.php");
}


?>


