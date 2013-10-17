<?php
	session_start();
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<title>Sasdfasdfasdfasdf</title>
	</head>
    
    <body>
        <div id="container">
            <div id="header">
            <!--Controller for header.-->
            <!--I want "STUDENT" to change to "TEACHER" if a Teacher logs in.-->
            <!--I also want to change the "NOW WITH..." fun stuff to be randomly generated.-->
            <!--That's just for fun, do not prioritze highly-->
                <h1><span class="on">NJIT<span class="off">Student</span>
                <?php
					echo $_SESSION['user'];
				?>
                </h1>
                <h2>Now With Less Women! </h2>
            </div>   
            
            <!--Horizontal Top Bar-->
            <div id="menu">
                <ul>
                    <li class="menuitem"><a href="login.php">Home</a></li>
                    <!--The About Page will be documentation for the FINAL version-->
                    <li class="menuitem"><a href="login.php">About</a></li>
                    <li class="menuitem"><a href="login.php?status=loggedout">Log Out</a></li>
                </ul>
            </div>
            
            <!--The top of the blue box on the sidebar-->        
            <div id="leftmenu">
            <div id="leftmenu_top"></div>
    
    		<!--Sidebar Contents
           		Example php in there to show that I want something like this.
            	Where I fetch from database, the course contents and then fill.-->
                    <div id="leftmenu_main">    
                        <h3>Courses</h3>
                            
                        <ul>
                           <?php
								//If You aren't authorized, we send you back to the login page
								//This is to ensure that you don't just directly link to this url.
								if($_SESSION['status'] !='authorized') 
								{
									header("location: login.php");
								}
								else
								//if(isset($_SESSION['user'])) 
								{
									//If result exists, meaning we have acquired SQL info, 
									//otherwise Query to retrieve classes.
									if(isset($_SESSION['result']))
									{		
										$counter = count ($_SESSION['result'] );
	
										for ($x=0; $x<$counter; $x++)
										{
											//echo "<b>Course Name:</b> ".$_SESSION['result'][$x][0]."<br>";
											echo "<li><a href=\"#\">".$_SESSION['result'][$x][0]."</a></li>";        
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

