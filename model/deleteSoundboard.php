<?php
	session_start();
	
	require_once '../../../config.inc';

	$soundboard_id = $_GET['soundboard_id'];

	$username = $_SESSION['user'];
	$sql = "SELECT * FROM users WHERE BINARY username='$username'";
	$result = mysqli_query($conn, $sql);

	$getID = mysqli_fetch_array($result );
	$userID = (int)$getID['id'];

	$sql = $conn->prepare("DELETE FROM soundboard WHERE soundboard_id= ? AND id= ?");
	$sql->bind_param('ii', $soundboard_id, $userID);
	$sql-> execute();

	if($_SESSION['isAdmin'] == true)
	{
		$sql = $conn->prepare("DELETE FROM soundboard WHERE soundboard_id= ?");
		$sql->bind_param('i', $soundboard_id);
		$sql-> execute();
	}

	$result = $sql->get_result();

	header('Location: ../views/dashboard.php');
	die();
?>
