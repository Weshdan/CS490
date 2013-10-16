<?php
//require_once 'classes/Membership.php';
//START SESSION IF AUTHORIZED
session_start();
		if($_SESSION['status'] !='authorized') header("location: login.php");

if(isset($_SESSION['user'])) 
{
	print "Welcome ".$_SESSION['user']." how are you? <br>";
	print "Pulling up information ... <br>";

//If result variable exists, if not then we query
	if(isset($_SESSION['result']))
	{
//		print_r($_SESSION['result'])."<br>";
//		$foo = array('bar' => 'baz');
// 		print "<b>This is inside foo bar:</b> {$foo['bar']}  <br>"; 		
		$counter = count ($_SESSION['result'] );
		print "<br>";
		
		for ($x=0; $x<$counter; $x++)
 		{
			echo "<b>Course Name:</b> ".$_SESSION['result'][$x][0]."<br>";
  		} 

		//unset($_SESSION['status']);
	} 
	else 
	{	
	//".$_SESSION['user']."
		$_SESSION['query'] = "SELECT CourseName FROM Class WHERE CourseID IN (SELECT CourseID FROM Attends WHERE StudentID IN (SELECT StudentID FROM Student WHERE UCID = '".$_SESSION['user']."' ))" or die ("Seems like you are not registered for any classes at this time");
		header("location:http://web.njit.edu/~sam53/queryparser.php");
	}
} 

else 
{
	header("location:login.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link rel="stylesheet" href="css/default.css" />


</head>

<body>

<div id = "container">
	<p>
    	Have a nice day.
    </p>
    <a href="login.php?status=loggedout">Log Out</a>
    </div><!--end container-->
</body>
</html>