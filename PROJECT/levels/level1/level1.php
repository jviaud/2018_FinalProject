<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
 $DB_LEVEL= DB::getInstance()->get('level', array('id', '>', '0'))->results();

 //print_r($DB_LEVEL[0]->password);
 $correctPassword=$DB_LEVEL[0]->password;
 $correctUser=$DB_LEVEL[0]->username;


if (!(($correctPassword==$_SERVER['PHP_AUTH_PW'])&&($correctUser==$_SERVER['PHP_AUTH_USER']))) {
    header('WWW-Authenticate: Basic realm="Gambit"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Unauthorized User';
    exit;
} 
?>
<!doctype html>
<html lang="en-us">
<head>
<meta charset="utf-8">

<title>Gambit</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Gambit01" />
		<meta name="keywords" content="Finals" />
		<meta name="level" content="1" />

<link rel="shortcut icon" type="image/png" href="../../img/favicon/favicon.png">
<link href="styles.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>



<body>
<div class=content>
<h1>Gambit Level 1</h1>
<p id='hint'>The Password for level 2 is somewhere on this page<p>	







<?php 

 
 
 


$nextPassword=$DB_LEVEL[1]->password;

if(Input::exists()){
 $password=Input::get('password');


 if($nextPassword===$password){
  require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/updateLevel.php';
     Redirect::to('../level2/level2.php?level=2');
 }else{
     echo "<script>$('#password_entry').val(''); </script>";
 }
}
?>

<form id="form" action='' method='POST'>
<input id='password_entry' type='text' name='password'>
<button id='submit' type='submit'  name='submit' >SUBMIT</button>
<form>


<p id='password'><?php echo $nextPassword?></p>
</div>
  
<footer><?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/gohome.php';?></footer>
</body>
</html>
