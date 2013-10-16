<?php

require_once 'includes/constants.php';

class Mysql 
{
	
	private $conn;
	//magic method, runs as soon as class is instantiated (Mysql)
	function __construct() 
	{
		$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME 
				or die('There was a problem connecting to the database.'));
	}
	
	
	function verify_Username_and_Pass($un, $pwd)
	{
		$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) 
		or die('There was a problem connecting to the database.');
		
		$query = "SELECT *
					FROM users
					WHERE username = ? AND password = ?
					LIMIT 1"; //for security (only thing should appear)
					
		if($stmt = $this->conn->prepare($query)) 
		{
			$stmt->bind_param('ss', $un, $pwd); //'s' stands for string
			$stmt->execute();
			
			if($stmt->fetch())
			{
				$stmt->close();
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}