<?php
	/*
	* This code logs a user out of the back-end, by destroying the session variable.
	* Redirects the user to the login page.
	*/
	
	//initialise session
	session_start(); 
	
	//unset all of the session variables
	$_SESSION = array(); 
	
	//destroy the session
	session_destroy();
	
	//redirect
	header("location:index.php"); 
?>