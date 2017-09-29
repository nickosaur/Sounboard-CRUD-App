<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Soundboard login page">
    <meta name="author" content="Nicholas Yee">

    <title>Login</title>
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
	    <link href="../css/bootstrap.min.css" rel="stylesheet">  
		
	    <!-- Custom narrow bootstrap -->
	    <link href="../css/jumbotron-narrow.min.css" rel="stylesheet">
	</noscript>


    <!--Critical CSS above the fold -->
    <style>
* { box-sizing: border-box; }
html { font-family: sans-serif; text-size-adjust: 100%; font-size: 10px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); }
body { margin: 0px; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.42857; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px; }
.container { padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; width: 750px; max-width: 730px; }
.header, .jumbotron { border-bottom: 1px solid rgb(229, 229, 229); }
.footer, .header, .marketing { padding-left: 0px; padding-right: 0px; }
.header { margin-bottom: 30px; }
article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary { display: block; }
ol, ul { margin-top: 0px; margin-bottom: 10px; }
.nav { padding-left: 0px; margin-bottom: 0px; list-style: none; }
.nav-tabs { border-bottom: 1px solid rgb(221, 221, 221); }
.pull-right { float: right !important; }
.nav > li { position: relative; display: block; }
.nav-tabs > li { float: left; margin-bottom: -1px; }
a { background-color: transparent; color: rgb(51, 122, 183); text-decoration: none; }
.nav > li > a { position: relative; display: block; padding: 10px 15px; }
.nav-tabs > li > a { margin-right: 2px; line-height: 1.42857; border: 1px solid transparent; border-radius: 4px 4px 0px 0px; }
.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { color: rgb(85, 85, 85); cursor: default; background-color: rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(221, 221, 221) rgb(221, 221, 221) transparent; border-image: initial; }
.text-center { text-align: center; }
.jumbotron { padding-top: 48px; padding-bottom: 48px; margin-bottom: 30px; color: inherit; background-color: rgb(238, 238, 238); text-align: center; border-bottom: 0px; }
.container .jumbotron, .container-fluid .jumbotron { padding-right: 60px; padding-left: 60px; border-radius: 6px; }
h1 { margin: 0.67em 0px; font-size: 2em; }
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 { font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit; }
.h1, .h2, .h3, h1, h2, h3 { margin-top: 20px; margin-bottom: 10px; }
.h1, h1 { font-size: 36px; }
.jumbotron .h1, .jumbotron h1 { color: inherit; font-size: 63px; }
p { margin: 0px 0px 10px; }
.lead { margin-bottom: 20px; font-size: 21px; font-weight: 300; line-height: 1.4; }
.jumbotron p { margin-bottom: 15px; font-size: 21px; font-weight: 200; }
.form-group { margin-bottom: 15px; }
button, input, optgroup, select, textarea { margin: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; color: inherit; }
input { line-height: normal; }
button, input, select, textarea { font-family: inherit; font-size: inherit; line-height: inherit; }
.form-control { display: block; width: 100%; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857; color: rgb(85, 85, 85); background-color: rgb(255, 255, 255); background-image: none; border: 1px solid rgb(204, 204, 204); border-radius: 4px; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px inset; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
.btn { display: inline-block; padding: 6px 12px; margin-bottom: 0px; font-size: 14px; font-weight: 400; line-height: 1.42857; text-align: center; white-space: nowrap; vertical-align: middle; touch-action: manipulation; cursor: pointer; user-select: none; background-image: none; border: 1px solid transparent; border-radius: 4px; }
.btn-success { color: rgb(255, 255, 255); background-color: rgb(92, 184, 92); border-color: rgb(76, 174, 76); }
.btn-group-lg > .btn, .btn-lg { padding: 10px 16px; font-size: 18px; line-height: 1.33333; border-radius: 6px; }
button, html input[type="button"], input[type="reset"], input[type="submit"] { -webkit-appearance: button; cursor: pointer; }
.jumbotron .btn { font-size: 21px; padding: 14px 24px; }
	</style>
  </head>

  <body>
    <br>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-tabs pull-right">
	    <li role="presentation"><a href="../index.php">Home</a></li>
	    <li role="presentation" class="active"><a href="login.php">Login</a></li> 
	    <li role="presentation"><a href="registration.php">Sign up</a></li>
	</ul>
        </nav>
      </div>

      <div class="jumbotron text-center">
	<h1>Login</h1>
	<?php 
		if(isset($_SESSION['wrong']) && $_SESSION['wrong'] && $_SESSION['lockOut'] < 3){
			echo "<p> Wrong username or password </p> <br>";
			unset($_SESSION['wrong']);
		
		}
		if(isset($_SESSION['alphanumeric']) && $_SESSION['alphanumeric']){
			echo "<p> Username contains invalid characters </p><br>";
			unset($_SESSION['alphanumeric']);
		}
		if(isset($_SESSION['lockOut']) && $_SESSION['lockOut'] > 2){
			echo "<p> You have failed to login 3 times. Please try again after 10 minutes </p><br>";
		}
	?>
	<p class="lead">
	</p><form action="../model/processLogin.php" method="GET">
		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{4,30}"
			title="Alphanumeric characters where input is longer than 3"
			class="form-control"
			name="username" placeholder="USERNAME" required> <br><br>

		<div class="form-group">
		<input type="password" pattern="[a-zA-Z0-9]{6,30}"
			title="Alphanumeric characters where input is longer than 5"
			class="form-control"
			name="password" placeholder="PASSWORD" required> <br><br>
		<input type="submit" class="btn btn-lg btn-success"  value="Login">
	</form> 

  </div> <!-- /container -->

  </body>
</html>

