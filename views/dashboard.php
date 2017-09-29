<?php
	session_start();
	require_once '../../../config.inc';
	if(!isset($_SESSION['user'])){
		header("Location: ../index.php");
		die();
	}
	$username = $_SESSION['user'];
	$isAdmin = $_SESSION['isAdmin'];
	//========================Php code below needed to load table
	$limit = 5;
	if(isset($_GET["page"])){ $page = $_GET["page"]; } else { $page=1; };
	$start_from = ($page-1) * $limit;

	$sql = "SELECT * FROM users WHERE username = '$username'";
	$rs_result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($rs_result);
	$userId = (int)$row["id"];

	$sql = "SELECT soundboard_name, public, soundboard_id FROM soundboard WHERE id='$userId' ORDER BY soundboard_id ASC LIMIT $start_from, $limit";
	if($_SESSION['isAdmin'] == true)
	{
		$sql = "SELECT soundboard_name, public, soundboard_id FROM soundboard ORDER BY soundboard_id ASC LIMIT $start_from, $limit";
	}
	$rs_result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Soundboard user's dashboard">
    <meta name="author" content="Nicholas Yee">

    <title><?=$username?>'s Dashboard</title>
    <!-- defer loading of CSS snippet, not compatible in some browsers -->
	<script> 
		var l = document.createElement('link');
		l.rel='stylesheet';
		l.href='../css/all.min.css';
		l.media='defer';
		l.addEventListener('load', function() { l.media=''; }, false);
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(l, s);
	</script>

    <!-- if no JS is enabled, fall back is added here-->
	<noscript>
	    <!-- Bootstrap core CSS -->
	    <link href="../css/all.min.css" rel="stylesheet">  
		
	</noscript>


    <!--Critical CSS above the fold -->
    <style>
* { box-sizing: border-box; }
html { font-family: sans-serif; text-size-adjust: 100%; font-size: 10px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); }
body { margin: 0px; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.42857; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px; }
.container { padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; width: 750px; max-width: 730px; }
.header, .marketing, .footer { padding-left: 0px; padding-right: 0px; }
.header { border-bottom: 1px solid rgb(229, 229, 229); margin-bottom: 30px; }
article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary { display: block; }
ul, ol { margin-top: 0px; margin-bottom: 10px; }
.nav { padding-left: 0px; margin-bottom: 0px; list-style: none; }
.nav-tabs { border-bottom: 1px solid rgb(221, 221, 221); }
.pull-right { float: right !important; }
.nav > li { position: relative; display: block; }
.nav-tabs > li { float: left; margin-bottom: -1px; }
a { background-color: transparent; color: rgb(51, 122, 183); text-decoration: none; }
.nav > li > a { position: relative; display: block; padding: 10px 15px; }
.nav-tabs > li > a { margin-right: 2px; line-height: 1.42857; border: 1px solid transparent; border-radius: 4px 4px 0px 0px; }
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus { color: rgb(85, 85, 85); cursor: default; background-color: rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(221, 221, 221) rgb(221, 221, 221) transparent; border-image: initial; }
.text-center { text-align: center; }
.jumbotron { padding-top: 48px; padding-bottom: 48px; margin-bottom: 30px; color: inherit; background-color: rgb(238, 238, 238); text-align: center; border-bottom: 0px; }
.container .jumbotron, .container-fluid .jumbotron { padding-right: 60px; padding-left: 60px; border-radius: 6px; }
h1 { margin: 0.67em 0px; font-size: 2em; }
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit; }
h1, .h1, h2, .h2, h3, .h3 { margin-top: 20px; margin-bottom: 10px; }
h1, .h1 { font-size: 36px; }
.jumbotron h1, .jumbotron .h1 { color: inherit; font-size: 63px; }
p { margin: 0px 0px 10px; }
.lead { margin-bottom: 20px; font-size: 21px; font-weight: 300; line-height: 1.4; }
.jumbotron p { margin-bottom: 15px; font-size: 21px; font-weight: 200; }
[role="button"] { cursor: pointer; }
.btn { display: inline-block; padding: 6px 12px; margin-bottom: 0px; font-size: 14px; font-weight: normal; line-height: 1.42857; text-align: center; white-space: nowrap; vertical-align: middle; touch-action: manipulation; cursor: pointer; user-select: none; background-image: none; border: 1px solid transparent; border-radius: 4px; }
.btn-success { color: rgb(255, 255, 255); background-color: rgb(92, 184, 92); border-color: rgb(76, 174, 76); }
.btn-lg, .btn-group-lg > .btn { padding: 10px 16px; font-size: 18px; line-height: 1.33333; border-radius: 6px; }
.jumbotron .btn { font-size: 21px; padding: 14px 24px; }
table { border-spacing: 0px; border-collapse: collapse; background-color: transparent; }
.table { width: 100%; max-width: 100%; margin-bottom: 20px; }
td, th { padding: 0px; }
th { text-align: left; }
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td { padding: 8px; line-height: 1.42857; vertical-align: top; border-top: 1px solid rgb(221, 221, 221); }
.table > thead > tr > th { vertical-align: bottom; border-bottom: 2px solid rgb(221, 221, 221); }
.table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > th, .table > caption + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > td, .table > thead:first-child > tr:first-child > td { border-top: 0px; }
    </style>
  </head>

  <body>
    <br>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-tabs pull-right">
	    <li role="presentation"><a href="../index.php">Home</a></li>
	    <li role="presentation" class="active"><a href="dashboard.php">Your Dashboard</a></li>
	    <li role="presentation"><a href="../model/processLogout.php">Logout</a></li>
	</ul>
        </nav>
      </div>

      <div class="jumbotron text-center">
      <h1> 
	<?php 
		if($isAdmin == 1)
			echo "Admin's ";
		?>
		Dashboard</h1>
	<p class="lead">
	</p>
	<?php if ( $_SESSION['isAdmin'] == 1 ){ ?>
		<a class="btn btn-lg btn-success" href="list.php" role="button">Admin Control</a>
	<?php } ?> 
	</div>
<!--Soundboard-->
      <div class = "jumbotron text-center">
        <h1>
	  Your Soundboards
	</h1>
	<form action="" method="get">
        <table class="table" align="left">
	  <thead>
	    <tr>
	      <th>Soundboard Name</th>
	      <th>Public</th>
	    </tr>
	  </thead>
	  <tbody align="left">
	    <?php
		while($row = mysqli_fetch_assoc($rs_result)){
			$soundboard_id = $row["soundboard_id"];
			$soundboard_name = $row["soundboard_name"];
	    ?>
		<tr>
		<td>
		<?php echo "<a href = \"./soundboard.php?soundboard_id=" . $soundboard_id . "\">" . 
			$soundboard_name . "</a>";
			?>
		</td>
		<td>
		  <?php 
			if($row["public"] == "0" ){
				echo No;
			}
			else{
				echo Yes;
			}
		  ?>
		</td>
		<td>
		<?php
			echo '<a href="../model/deleteSoundboard.php?soundboard_id='.$row["soundboard_id"].'">Delete</a>';
		?>	
		</td>
		</tr>
	    <?php
	    };
	    ?>
	  </tbody>
	</table>
	</form>
	<a class = "btn btn-success" href = "./addSoundboard.php" role = "button">Add Soundboard</a>
  </div>	
</div>
</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
	$('.pagination').pagination({
	        item: <?php echo $total_records;?>,
			itemsOnPage: <?php echo $limit;?>,
			cssStyle: 'light-theme',
			currentPage : <?php echo $page;?>,
			hrefTextPrefix : 'dashboard.php?page='
	});
	});
</script>

