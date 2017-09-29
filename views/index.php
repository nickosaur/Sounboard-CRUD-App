<?php

	session_start();
	$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
	
    <!-- defer loading of CSS snippet, not compatible in some browsers -->
	<script> 
		var l = document.createElement('link');
		l.rel='stylesheet';
		l.href='css/all.min.css';
		l.media='defer';
		l.addEventListener('load', function() { l.media=''; }, false);
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(l, s);
	</script>

    <!-- if no JS is enabled, fall back is added here-->
	<noscript>
	    <!-- Bootstrap core CSS -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">  
		
	    <!-- Custom narrow bootstrap -->
	    <link href="css/jumbotron-narrow.min.css" rel="stylesheet">
	    </noscript> 


    <!--Critical CSS above the fold -->
    <style>
.nav>li,.nav>li>a{position:relative;display:block}.nav>li,.nav>li>a,article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary{display:block}.nav-tabs>li>a,body{line-height:1.42857}.btn,.jumbotron{text-align:center}*{box-sizing:border-box}html{font-family:sans-serif;text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:transparent}body{margin:0;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;color:#333;background-color:#fff;padding-top:20px;padding-bottom:20px}.container{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto;width:750px;max-width:730px}.footer,.header,.marketing{padding-left:0;padding-right:0}.header{border-bottom:1px solid #e5e5e5;margin-bottom:30px}ol,ul{margin-top:0;margin-bottom:10px}.nav{padding-left:0;margin-bottom:0;list-style:none}.nav-tabs{border-bottom:1px solid #ddd}.pull-right{float:right!important}.nav-tabs>li{float:left;margin-bottom:-1px}a{background-color:transparent;color:#337ab7;text-decoration:none}.nav>li>a{padding:10px 15px}.nav-tabs>li>a{margin-right:2px;border:1px solid transparent;border-radius:4px 4px 0 0}.nav-tabs>li.active>a,.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover{color:#555;cursor:default;background-color:#fff;border-width:1px;border-style:solid;border-color:#ddd #ddd transparent;border-image:initial}.btn,[role=button]{cursor:pointer}.jumbotron{padding-top:48px;padding-bottom:48px;margin-bottom:30px;color:inherit;background-color:#eee;border-bottom:0}.container .jumbotron,.container-fluid .jumbotron{margin-top:39px;padding-right:60px;padding-left:60px;border-radius:6px}h1{margin:.67em 0}.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{font-family:inherit;font-weight:500;line-height:1.1;color:inherit}.h1,.h2,.h3,h1,h2,h3{margin-top:20px;margin-bottom:10px}.h1,h1{font-size:36px}.jumbotron .h1,.jumbotron h1{color:inherit;font-size:63px}p{margin:0 0 10px}.lead{margin-bottom:20px;font-size:21px;font-weight:300;line-height:1.4}.jumbotron p{margin-bottom:15px;font-size:21px;font-weight:200}.btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857;white-space:nowrap;vertical-align:middle;touch-action:manipulation;user-select:none;background-image:none;border:1px solid transparent;border-radius:4px}.btn-success{color:#fff;background-color:#5cb85c;border-color:#4cae4c}.btn-group-lg>.btn,.btn-lg{padding:10px 16px;font-size:18px;line-height:1.33333;border-radius:6px}.jumbotron .btn{font-size:21px;padding:14px 24px}.footer{padding-top:19px;color:#777;border-top:1px solid #e5e5e5}
	</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Soundboard index page">
    <meta name="author" content="Nicholas Yee">

    <title>Soundboard 17</title>

  </head>
  <body>
    <br>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-tabs pull-right">
	    <li role="presentation" class="active"><a href="index.php">Home</a></li>
		<?php 
			if(isset($_SESSION['user'])){
				echo "<li role=\"presentation\"><a href=\"views/dashboard.php\">";
				echo $username; 
				echo "'s Dashboard</a></li> \n";
				echo "<li role=\"presentation\"><a href=\"model/processLogout.php\">";
				echo "Logout</a></li> \n";
				
			}
			else{
	echo "<li role=\"presentation\"><a href=\"views/login.php\">Login</a><li> \n";	
	echo "<li role=\"presentation\"><a href=\"views/registration.php\">Sign up</a><li> \n";	
			}
		 ?>	
	</ul>
	</nav>

      </div>

      <div class="jumbotron">
        <h1>Soundboard 17</h1>
	<p class="lead">
		Upload sounds, share them, or keep them private! 
	</p>
	<p><a class="btn btn-lg btn-success" href="views/publicSoundboards.php" role="button">View sounds</a></p>
      </div>

      <footer class="footer">
        <p>&copy; CSE 135 Summer 2017 : Team 17</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
