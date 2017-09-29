<?php
	session_start();
	if( !isset($_SESSION['isAdmin']) ||  $_SESSION['isAdmin'] == false ){
		http_response_code(404);
		die();
	}

	require_once '../../../config.inc';

	$username = $_GET['username'];

	$stmt = $conn->prepare("DELETE FROM users WHERE username = ?" );
	$stmt->bind_param('s', $username);
	$stmt->execute(); 

/*	$sql = "DELETE FROM `users` WHERE username = '$username' "; 

	mysqli_query($conn, $sql);*/	
	
	header('Location: ../views/list.php');
	die();

?>
