<?php
	session_start();

	require_once '../../../config.inc';

	$username = $_SESSION['user'];
	$sql = "SELECT * FROM users WHERE BINARY username='$username'";
	$result = mysqli_query($conn, $sql);

	$getID = mysqli_fetch_array($result );
	$userID = (int)$getID['id'];

	$sound_id = $_GET['sound_id'];

	$sql = $conn->prepare("SELECT * FROM sound WHERE sound_id = ?");
	$sql->bind_param('i', $sound_id);
	$sql-> execute();
	$result = $sql->get_result();

	$get_soundboard = mysqli_fetch_array($result);
	$soundboard_id = (int)$get_soundboard['soundboard_id'];

	$sql = "SELECT * FROM soundboard WHERE soundboard_id = '$soundboard_id'";
	$result = mysqli_query($conn, $sql);
	$get_owner = mysqli_fetch_array($result);
	$owner_id = (int)$get_owner['id'];

	if(($userID == $owner_id) || $_SESSION['isAdmin'] == true)
	{
		$sql = $conn->prepare("DELETE FROM sound WHERE sound_id = ?");
		$sql->bind_param('i', $sound_id);
		$sql-> execute();
	}
	
	header('Location: ../views/dashboard.php');
	die();

?>
