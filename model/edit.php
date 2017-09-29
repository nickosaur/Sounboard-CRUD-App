<?php
	session_start();


	if( !isset($_SESSION['isAdmin']) ||  $_SESSION['isAdmin'] == false ){
		http_response_code(404);
		die();
	}
	

	require_once '../../../config.inc';

	$oriUser = $_GET['oriUser'];
	$stmt = $conn->prepare("SELECT id FROM users WHERE username= ?" );

	$stmt->bind_param('s', $oriUser);

	$stmt->execute(); 
	$result = $stmt->get_result();
	/*get unique id of user in case username is changed
	$sql = "SELECT id FROM `users` where username='$oriUser' ";
	$result = mysqli_query($conn, $sql); */
	$row = mysqli_fetch_array( $result);
	
	$id = $row['id'];
	$first_name = $_GET['first_name'];
	$last_name = $_GET['last_name'];
	$email = $_GET['email'];
	$username = $_GET['username'];

	$sql = "UPDATE `users` SET `first_name` = '$first_name' , `last_name` = '$last_name' , `email` = '$email', `username` = '$username' WHERE `users`.`id` = $id ";	

	mysqli_query($conn, $sql);	
	
	header('Location: ../views/list.php');
	die();

?>

