<?php
session_start();

//If the user clicks "Log Out" link on the index page
if(isset($_GET['status']) && $_GET['status'] == 'loggedout')
{
	if(isset($_SESSION['status'])) 
		{
			unset($_SESSION['status']);
			
			if(isset($_COOKIE[session_name()])) 
				setcookie(session_name(),'',time()-1000);
				session_destroy(); //Remove cookie and destroy session
		}
}
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>NJIT Login
    </title> <!--on the tab, name-->

		<link rel ="stylesheet" type = "text/css" href = "css/default.css" />

	<script type ="text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
	<script type ="text/javascript" src = "js/main.js"></script>

</head>

<body>
	<div id = "login">
		<form action = "#" id="form1" form method ="post"><!--I think covered this up-->
   		  <h2>Login <small> enter your credentials </small></h2>
       		 <p>
 <!--username instead of name?-->
        		<label for = "name"> Username: </label>
           		<input name="user" type="text" id="user" />
       		 </p>
        
     		 <p>
                <label for ="pass">Password: </label>
                <input name="pass" type="password" id="pass" />
             </p>
                    
             <p>
                <input type="submit" id="submit" value ="Login" name="Submit" />
             </p>
        </form>
		<h4 class = 'alert'></h4>
	   </div><!--end login-->
	<script>
	$("#alert").html(" ");
	$(document).ready(function(){
	   $("#form1").submit(function(){

			user=$("#user").val();
			pass=$("#pass").val();
			 $.ajax({
				type: "POST",
				url: "http://web.njit.edu/~sam53/validation.php",
				data: "user="+user+"&pass="+pass,
				success: function(html){
				  if(html == 'teacher'){
					   window.location.replace("tlobby.php");    
				  } else if(html == 'student'){
					   window.location.replace("slobby.php"); 
				  } else {	
						$('h4.alert').hide().fadeIn(700);
						$(".alert").html(html);
				  }
				}
			});
			 return false;
		});
	});
	</script>
</body>
</html>