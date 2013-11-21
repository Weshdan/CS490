<?php
if ($_GET) {
	$q = $_GET['id'];
	header("location: http://web.njit.edu/~wgs4/main.php?qry=".$q."");
} else {
	echo "You either don't belong here or you made an incorrect ajax call";
}
?>
