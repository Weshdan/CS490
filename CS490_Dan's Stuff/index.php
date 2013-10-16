
<?php

require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();
//This prevents people from just linking to index.php
//but lets you in if ur session is still up
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
    	Welcome to stuff.
    </p>
    <a href="login.php?status=loggedout">Log Out</a>
    </div><!--end container-->
</body>
</html>
