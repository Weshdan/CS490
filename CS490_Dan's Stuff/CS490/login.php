
<?php

session_start();
/*require_once 'classes/Membership.php';
$membership = new Membership();
*/
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>NJIT Login</title> <!--on the tab, name-->

<link rel ="stylesheet" type = "text/css" href = "css/default.css" />

<script type ="text/javascript" src =
"http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js">
</script>
<script type ="text/javascript" src = "js/main.js">
</script>

</head>

<body>


<div id = "login">
	<form name="form1" form method ="post" action ="http://web.njit.edu/~sam53/validation.php"><!--I think covered this up-->
   	  <h2>Login <small> enter your credentials </small></h2>
      <p>
      
 <!--username instead of name?-->
        	<label for = "name"> Username: </label>
        <input name="user" type="text" id="user" />
      </p>
        
      <p>
        	<label for ="pwd">Password: </label>
        <input name="pass" type="password" id="pass" />
      </p>
            
      <p>
        <input type="submit" id="submit" value ="Login" name="Submit" />
      </p>
      
  </form>
  
  
  <?php if (isset($_SESSION['response']
)) echo "<h4 class = 'alert'>" . $_SESSION['response']
 . "</h4>"; ?>
</div>

<div id = "wes">
	<a href = "http://www.picturesofwes.tumblr.com">
  <img src="images/WES.png" width="215" height="233"/>;
    </a>
</div>
<!--end login-->
</body>
</html>