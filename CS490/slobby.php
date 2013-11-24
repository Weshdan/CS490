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
		<title><?php echo $_SESSION['user'];?>'s Lobby</title>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
	</head>
    
    <body>

        <div id="container">
            <div id="header">
			
            <!--Controller for header.
           		I want "STUDENT" to change to "TEACHER" if a Teacher logs in.-->
                <h1><span class="on">NJIT<span class="off">Student </span></h1>
                <h2>Only 24% Female! </h2>
            </div>   
            
            <!--Horizontal Top Bar-->
            <div id="menu">
                <ul>
                    <li class="menuitem" id="home"><a>Home</a></li>
                    <!--The About Page will be documentation for the FINAL version-->
                    <li class="menuitem" id="about"><a>About</a></li>
                    <li class="menuitem" id="tests"><a>Tests</a></li>
                    <li><a href="login.php?status=loggedout">Log Out</a></li>
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
                    <ul class = "leftmenu">		
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
	<script>
<!-- This sends an ajax get request to tunnel with the name of the query you want -->
	$.ajax({
		type: "GET",
		url: "http://web.njit.edu/~sam53/tunnel.php",
		dataType: 'json',
		data: {id: "getCourses"}, <!-- id: is the name of the query you want-->
		success: function(data) {
			<!-- This part happens after the ajax request is successful, starting by appending a li list of courses to the <ul class = "leftmenu"></ul>-->
			$.each(data, function(index, course) {
				$(".leftmenu").append("<li class = 'lmi' id = "+ course.CourseName +"><a>"+ course.CourseName +"</a></li>");				
			});
			
			<!-- This part makes the links from the previous link change the html code loacated in the <div id="content_main">.-->
			$(".lmi").click(function () {
				$("#content_main").html("<h2>Welcome to "+$(this).attr('id')+"! </h2>");
			});
		}
	});
	
	$(".menuitem").click(function () {
				$.ajax({
				type: "GET",
				url: "pager.php",
				dataType: 'html',
				data: {link: $(this).attr('id')},
				success: function(data) {
					$("#content_main").html(data);			
				} 
				});
	});
	
	$("#tests").click(function () {
				$.ajax({
				type: "GET",
				url: "http://web.njit.edu/~sam53/tunnel.php",
				dataType: 'json',
				data: {id: "getTestsForPerson"},
				success: function(tbldata) {
					$.each(tbldata, function (rid, rval){
						if (rval.Practice == '1') {
							rval.Practice = 'Yes';
						} else {
							rval.Practice = 'No';
						}
					
						$("table").append("<tr><td>"+rval.CourseName+"</td><td>"+rval.Practice+"</td><td>"+rval.TestName+"</td><td>"+rval.DayDue+"</td><td>"+rval.DayAvai+"</td></tr>");
					});
				} 
			});
	});

	</script>

</html>

