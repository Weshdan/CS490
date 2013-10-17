<?php
session_start();
	//If You aren't authorized, we send you back to the login page
	//This is to ensure that you don't just directly link to this url.
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
			$_SESSION['query'] = "SELECT CourseName FROM Class 
									WHERE CourseID IN 
									(SELECT CourseID FROM Attends 
									WHERE SUCID IN (SELECT SUCID 
									FROM Student WHERE SUCID = '"
									.$_SESSION['user']."' ))";
		
			header("location:http://web.njit.edu/~sam53/queryparser.php");
		}
	} 
	else 
	{
		header("location:login.php");
	}
?>

<head>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>Sasdfasdfasdfasdf</title>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<div id="container">
		<div id="header">
        	<h1><span class="on">NJIT<span class="off">Student</span></h1>
            <h2>Now With Less Women! </h2>
        </div>   
        
        <div id="menu">
        	<ul>
            	<li class="menuitem"><a href="login.php">Home</a></li>
                <li class="menuitem"><a href="login.php">About</a></li>
                <li class="menuitem"><a href="login.php?status=loggedout">Log Out</a></li>
            </ul>
        </div>
		
        <!--The top of the blue box on the sidebar-->        
        <div id="leftmenu">
        <div id="leftmenu_top"></div>

				<div id="leftmenu_main">    
                	<h3>Courses</h3>
                        
                	<ul>
                   	 	<li><a href="#">Course1</a></li>
                    	<li><a href="#">Course2</a></li>
                   	 	<li><a href="#">Course3</a></li>
                    
                        <?php
                            echo "<li><a href="#">Dynamic Fill</a></li>";
                        ?>     
               		</ul>
				</div>
         
        <!--The bottom of the blue box on the sidebar-->        
        <div id="leftmenu_bottom"></div>
        </div>
         
		<div id="content">
            <div id="content_top">
            </div>
            <div id="content_main">
                <h2>LET ME TELL YOU ALL ABOUT HOW MUCH I HATE THIS </h2>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                <h3>1st Paragraph Header</h3>
                	<p>Biggest Load of Poppycock Yet</p>
                    <p>&nbsp;</p>
                <h3>2nd Paragraph Header</h3>
                    <p>Let me Sing You a Song about my Hate</p>
                    <p>&nbsp;</p>
                <h3>3rd Paragraph Header</h3>
                    <p>I pray for a miracle</p>
                    <p>&nbsp;</p>
		</div>
            <div id="content_bottom">
            </div>
            
            <div id="footer"><h3><a href="http://picturesofwes.tumblr.com">PicturesOfWes</a></h3></div>
      </div>
   </div>
</body>
</html>

