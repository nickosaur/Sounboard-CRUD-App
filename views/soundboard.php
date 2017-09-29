<?php
	session_start();
	require_once '../../../config.inc';

	if(isset($_SESSION['user'])){
		$username = $_SESSION['user'];
	}
	$soundboard_id = $_GET['soundboard_id'];
	$_SESSION['curr_soundboard_id'] = $soundboard_id;


	/*====Is this board private? If so, can the current user see it?====*/

	$sql = "SELECT soundboard_name,id,public FROM `soundboard` WHERE soundboard_id = $soundboard_id";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$soundboard_name = $row["soundboard_name"];
	$owner_id = $row["id"];
	$visibility = $row["public"];

	$sql = "SELECT id FROM `users` WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$user_id = $row["id"];

	if( !(isset($_SESSION['user']))){
	       if (! ($visibility)){ 	
		       //header('Location : publicSoundboards.php ');
		       die();
		}
	}
	else if($user_id != $owner_id && $visibility == false && $_SESSION['isAdmin'] == false){
		//header('Location : ../index.php');
		die();
	}
	/*==================================================================*/
	$sql = "SELECT * FROM `sound` WHERE soundboard_id = '$soundboard_id'";
	$result = mysqli_query($conn, $sql);
	
	$count = 0;
	define('row_lim', 4);
	
?>

<!DOCTYPE html>
<html lang = en>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name = "description" content="Soundboard display page">
    <meta name = "author" content="Mario Palma">
    <title>Soundboard</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/jumbotron-narrow.css" rel="stylesheet">
  </head>

  <body>
  <br>
    <div class="container">
      <div class="header clearfix">
	<nav>
	  <div class = "pull-left"> <?php echo $soundboard_name; ?>  </div>
          <ul class="nav nav-tabs pull-right">
            <li role="presentation"><a href="../index.php">Home</a></li>
            <?php
		  if(isset($_SESSION['user'])){
			  echo "<li role=\"presentation\"><a href=\"./dashboard.php\">";
			  echo $username;
			  echo "'s Dashboard</a></li> \n";
			  echo "<li role=\"presentation\"><a href=\"../model/processLogout.php\">";
			  echo "Logout</a></li> \n";
		  }
		  else{		
			  echo "<li role=\"presentation\"><a href=\"./login.php\">Login</a></li> \n";
			  echo "<li role=\"presentation\"><a href=\"./registration.php\">Sign up</a></li> \n";	
		  }
	  ?>
	  </ul>
        </nav>
      </div>
	<?php
                if( $owner_id == $user_id  ){
			echo "<a class = \"btn btn-success btn-lg\" href = \"./addSound.php?soundboard_id=" 
				. $soundboard_id . "\">Add Sound</a>";
                }
        ?>

    <!--SoundBoard-->
      <div id="board">
        <table border='2' width="100%">
        	<?php
	while ($row = mysqli_fetch_assoc($result) ){
		?>
		<tr align = "center">
		  <td>
		    <!--<img src="" width="200" height="150" alt = "sound" />-->
			<?php echo $row["sound_name"]  ?>
		  </td>
		   <td>
		    <?php $sound_file = $row["sound"];?>
		<audio controls src="<?php echo $sound_file; ?>" ></audio>
		  </td>
		  <td>
			<?php 
				if(($user_id == $owner_id) || $_SESSION['isAdmin'] == true) { 
					echo '<a href="../views/editSound.php?sound_id='.$row["sound_id"].'">Edit</a>'; 
				}
			?>
		  </td>
		  <td>
			<?php
				if(($user_id == $owner_id) || $_SESSION['isAdmin'] == true) { 
					echo '<a href="../model/deleteSound.php?sound_id='.$row["sound_id"].'">Delete</a>'; 
				}
			?>
		  </td>
		</tr>
		<?php }; ?>
        </table>
      </div>

    </div>

  </body>
</html>
