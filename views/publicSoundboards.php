<?php
	session_start();

	require_once '../../../config.inc';

	$limit = 5;
	if(isset($_GET["page"])){ $page = $_GET["page"]; } else { $page=1; };
	$start_from = ($page-1) * $limit;

	$sql = "SELECT * FROM `soundboard` WHERE public = 1 ORDER
	BY soundboard_id ASC LIMIT $start_from, $limit";

	$rs_result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv = "Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name = "description" content="Public soundboard viewing page">
    <meta name="author" content="Mario Palma">
    <title>Public Soundboards</title>
    <!---->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/jumbotron-narrow.css" rel="stylesheet">

    <script type = "text/javascript" charset = "utf8" src = "../js/jquery-2.0.3.js"></script>
    <script type = "text/javascript" src = "../js/bootstrap.min.js"></script>
    <script src = "../js/paginationFunc.js"></script>
  </head>
  <body>
    <br>
    <div class = "container">
      <div class = "header clearfix">
      <nav>
        <div class = pull-left> Public Soundboards </div>
        <ul class="nav nav-tabs pull-right">
	  <li role="presentation"><a href="../index.php">Home</a></li>
	    <?php
	    	if(isset($_SESSION['user'])){
			echo "<li role=\"presentation\"><a href=\"./dashboard.php\">";
			echo $_SESSION['user'];
			echo "'s Dashboard</a></li> \n";
			echo "<li role=\"presentation\"><a
			href=\"../model/processLogout.php\">";
			echo "Logout</a></li> \n";
		}
		else{
			echo "<li role=\"presentation\"><a
			href=\"./login.php\">Login</a></li> \n";
			echo "<li role=\"presentation\"><a
			href=\"./registration.php\">Sign up</a></li> \n";
                }
	    ?>
        </ul>
      </nav>
      </div>

    <div class ="jumbotron">
      <table class="table" align="left">
        <thead>
          <tr>
          <th>Soundboard Name</th>
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
		<?php
	echo "<a href = \"./soundboard.php?soundboard_id=" . $soundboard_id . "\">" . 
		$soundboard_name . "</a>"; 
       		#echo $row["soundboard_name"];	
		?>
		
           </td>
		   <!-- <td>
		<a
		<?php #echo"href=\"./soundboard.php?soundboard_id=" .$row["soundboard_id"]. "\"" ?>
		><span class = 'glyphicon glyphicon-eye-open'></span>
		</a>
		    </td>-->
	  </tr>
        <?php
        };
        ?>
        </tbody>
      </table>

    <?php
    $sql = "SELECT COUNT(soundboard_id) FROM `soundboard` WHERE public = 1";
    $rs_result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($rs_result);
    $total_records = $row[0];
    $total_pages = ceil($total_records / $limit);
    $pagLink = "<nav><ul class='pagination'>";
    for ($i = 1; $i<=$total_pages; $i++){
    	$paglink .= "<li><a href='publicSoundboards.php?page=".$i."'>".$i."</a></li>";
    };
    echo $paglink . "</ul></nav>";
?>

    <a class="btn btn-success" href="./addSoundboard.php" role="button">Add Soundboard</a>
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
		hrefTextPrefix : 'publicSoundboards.php?page='
	});
});
</script>
