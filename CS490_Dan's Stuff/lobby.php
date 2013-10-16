<?php
//START SESSION IF AUTHORIZED
session_start();

	if($_SESSION['status'] !='authorized') 
		header("location: login.php");

	if(isset($_SESSION['user'])) 
	{
		print "Welcome ".$_SESSION['user']." how are you? <br>";
		print "Pulling up information ... <br>";

		//If result variable exists, if not then we query
		if(isset($_SESSION['result']))
		{		
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
			$_SESSION['query'] = "SELECT CourseName FROM Class WHERE CourseID IN (SELECT CourseID FROM Attends WHERE StudentID IN (SELECT StudentID FROM Student WHERE UCID = '".$_SESSION['user']."' ))" or die ("Seems like you are not registered for any classes at this time");
		
		header("location:http://web.njit.edu/~sam53/queryparser.php");
		}
	} 
	else 
	{
		header("location:login.php");
	}

?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--Call up the CSS-->
	<link rel="stylesheet" href="css/default.css" />
</head>
	<body>
		<div id = "container">
            <p>
                Have a nice day.
            </p>
                <a href="login.php?status=loggedout">Log Out</a>
        </div>
    </body>
</html>