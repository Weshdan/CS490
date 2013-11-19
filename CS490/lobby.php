<?php
	session_start();
	//If You aren't authorized, we send you back to the login page
	//This is to ensure that you don't just directly link to this url.
	if($_SESSION['status'] !='authorized') 
	{
		header("location: login.php");
		//echo "lobby.php session not authorized";
	}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<title>Sasdfasdfasdfasdf</title>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
	</head>
    
    <body>

        <div id="container">
            <div id="header">
			
            <!--Controller for header.
           		I want "STUDENT" to change to "TEACHER" if a Teacher logs in.-->
                <h1><span class="on">NJIT<span class="off">
                <?php
					if($_SESSION['teacher'])
						echo "Teacher </span>";
					else
						echo "Student </span>";
					echo $_SESSION['user'];
				?>
                </h1>
                <h2>Only 24% Female! </h2>
            </div>   
            
            <!--Horizontal Top Bar-->
            <div id="menu">
                <ul>
                    <li class="menuitem"><a href="lobby.php">Home</a></li>
                    <!--The About Page will be documentation for the FINAL version-->
                    <li class="menuitem"><a href="lobby.php">About</a></li>
                    <li class="menuitem"><a href="TestTemplate.php">Tests</a></li>
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
                    <ul class = "getCourses">		
					<script>
					$.ajax({
						type: "GET",
						url: "http://web.njit.edu/~sam53/tunnel.php",
						dataType: 'html',
						data: {id: "getCourses"},
						success: function(data) {
							$(".getCourses").append( data );
						}
					});
					</script>
					</ul> 
                    </div>
            <!--The bottom of the blue box on the sidebar-->        
            <div id="leftmenu_bottom"></div>
            </div>
             
            <div id="content">
                <div id="content_top">
                </div>
                <div id="content_main">
                    <h2>Welcome to stuff </h2>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    <h3>Header</h3>
                        <p>What's up?</p>
            </div>
                <div id="content_bottom">
                </div>
                
                <div id="footer"><h3><a href="www.google.com">Google</a></h3></div>
          </div>
       </div>
	   
    </body>
</html>

