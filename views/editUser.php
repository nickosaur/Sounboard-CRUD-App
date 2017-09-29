<?php
	session_start();
	if ( isset($_SESSION['user']) && $_SESSION['isAdmin'] == false ){
		header("Location: ../index.php");
		die();
	}
	
	require_once '../../../config.inc';

	$username = $_GET['username'];
	
	$sql = "SELECT * FROM `users` WHERE BINARY username = '$username'";
	$result = mysqli_query($conn , $sql);
	
	$row = mysqli_fetch_array( $result);
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Soundboard registration page">
    <meta name="author" content="Nicholas Yee">

    <title>Sign up</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom narrow bootstrap -->
    <link href="../css/jumbotron-narrow.css" rel="stylesheet">

  </head>

  <body>
    <br>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-tabs pull-right">
	    <li role="presentation"><a href="../index.php">Home</a></li>
	    <li role="presentation"><a href="dashboard.php">
		<?php echo $_SESSION['user']?>'s Dashboard</a></li> 
	    <li role="presentation"><a href="list.php">User Controls</a></li> 
	    <li role="presentation"class="active"><a href="addUsers.php">Edit User</a></li>
	</ul>
        </nav>
      </div>

      <div class="jumbotron text-center">
      <h1>Edit <?php echo $row['username']?>'s Account</h1>
	<p class="lead">
		<?php
			if(isset($_SESSION['fromPA']) && $_SESSION['fromPA']){
				echo "Username already taken <br>";
			}
			if(isset($_SESSION['alphanumeric']) && $_SESSION['alphanumeric']){
				echo "Only alphanumeric can be used in fields <br>";
			}
			if(isset($_SESSION['unequal']) && $_SESSION['unequal']){
				echo "Password and Confirm password do not match <br>";
			}
			if(isset($_SESSION['badpassword']) && $_SESSION['badpassword']){
				echo "Password length must be greater than 5 <br>";
			}
			if(isset($_SESSION['baduser']) && $_SESSION['baduser']){
				echo "Username length must be greater than 3 and less than 30 <br>";
			}
			unset($_SESSION['fromPA']);
			unset($_SESSION['alphanumeric']);
			unset($_SESSION['unequal']);
			unset($_SESSION['badpassword']);
			unset($_SESSION['baduser']);

		?>
		</p><form action="../model/edit.php" method="GET">
		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{1,29}" 
			title="Alphanumeric characters only" class="form-control"
			name="first_name" value="<?php echo $row['first_name']?>"
			placeholder="FIRST NAME" required> <br> <br>

		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{1,29}" 
			title="Alphanumeric characters only" class="form-control" 
			name="last_name" value="<?php echo $row['last_name']?>" 
			placeholder="LAST NAME" required> <br> <br>

		<div class="form-group">
		<input type="email" class="form-control" 
			name="email" value="<?php echo $row['email']?>"
			placeholder="EMAIL" required> <br><br>

		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{4,29}" 
			title="Alphanumeric characters where input is longer than 3"
				class="form-control"
				name="username" value="<?php echo $row['username']?>"
			placeholder="USERNAME" required> <br><br>
			<input type="hidden" name="oriUser" value="<?php echo $username ?>">
		<input type="submit" class="btn btn-lg btn-success"  value="Edit user account">
	</form> 

  </div> <!-- /container -->

  </body>
</html>
