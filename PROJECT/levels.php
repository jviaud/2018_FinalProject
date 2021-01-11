<!doctype html>
<html lang="en-us">
<head>
<meta charset="utf-8">

<title>Gambit</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Levels" />
		<meta name="keywords" content="Finals" />

<link rel="shortcut icon" type="image/png" href="img/favicon/favicon.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
<?php
//require_once 'core/init.php';
include_once 'includes/nav.php';
?>

<hr>
<div class="container">
<div class="row">	
	
<div class="col-sm-2">
<?php 
//All of this isnt realy necessary but I wanted to link the amount of links on the page to the amount of levels in the database in case i decide to change the number of levels
$DB = DB::getInstance()->get('level', array('id', '>', '0'))->results();


for($i=0; $i<count($DB);$i++){
?>
<a href='levels/level<?php echo $i+1?>/level<?php echo $i+1?>.php?level=<?php echo $i+1?>'>Level <?php echo $i+1?></a>
<br>

<?php }?>    
</div>  

	
	
<div class="col-sm-10">
<h1>Welcome to Gambit</h1>
<p>Here is How the Game Works</p>
<p>The Username for Every Level is gambit followed by the the level number. Single digit numbers will be proceeded by a 0</p>
<p>So The Username for level 1 is gambit01 where as the username for level 10 is gambit10</p>
<p>As for the password, you must find it</p>
<p>Don't wory, each page has a hint on how to find the password and you are free to use any means to get it</p>
<p>to start you off, here is the password to level 1</p>
<p>b13e6271d4257b8460449d0277343e2d</p>
<p>Don't forget to copy it!</p>
<br>
</div>	

</div>  
</div><!-- Container -->



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</body>
</html>




