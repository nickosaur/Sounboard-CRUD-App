<?php
	require_once '../../../config.inc';
	session_start();

	//log first
	$username = $_SESSION['user'];
	$sql = "UPDATE `users` 
	    SET logouts = logouts + 1
	WHERE username = '".$username."'";
	mysqli_query($conn, $sql);


	unset($_SESSION['user']);		
	session_destroy();
	
	$_SESSION = [];

	//var_dump($_SESSION['user']);
	//die();

	header("Location: ../index.php");
	die();
?>
