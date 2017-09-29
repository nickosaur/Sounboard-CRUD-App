<?php
	session_start();
	if ( !(isset($_SESSION['user'])) ){
		header("Location: ./login.php");
		die();
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Add/Create Soundboard page">
    <meta name="author" content="Mario Palma">

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
	</ul>
        </nav>
      </div>

      <div class="jumbotron text-center">
        <h1>Add Soundboard</h1>
	<p class="lead">
		<?php
			if(isset($_SESSION['alphanumeric']) && $_SESSION['alphanumeric']){
				echo "Only alphanumeric can be used in fields <br>";
			}

			unset($_SESSION['alphanumeric']);
		?>
		
	</p><form action="../model/processSoundboard.php" method="GET">
		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{1,29}" 
			title="Alphanumeric characters only" class="form-control"
			name="soundboard_name" placeholder="SOUNDBOARD NAME" required> <br> <br>

		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{1,20}" 
			title="Alphanumeric characters where input is NOT longer
			than 20"
			class="form-control"
			name="soundboard_description" placeholder="DESCRIPTION" required> <br><br>
		
		<div class = "form-group">
		<label for = "pub_board">Make this soundboard public? </label>
		<input type = "checkbox" title = "Make this sounboard
		public for others to see(default is private )"
		class = "form-control" name = "public" id = "pub_board">
		<br>
		<br>
		<input type="submit" class="btn btn-lg btn-success"  value="Add
		Soundboard">
	</form> 

  </div> <!-- /container -->

  </body>
</html>
