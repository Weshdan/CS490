<?php
session_start();

if($_SESSION['status'] !='authorized') 
		header("location: login.php");
		
if(isset($_SESSION['query'])){
	header("location: http://web.njit.edu/~wgs4/main.php");
}

if(isset($_SESSION['result'])){
	header("location: http://web.njit.edu/~dc98/CS490/lobby.php");
}

?>