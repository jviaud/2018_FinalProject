<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
 $DB = DB::getInstance()->get('level', array('id', '=', '5'));
 $results=$DB->results();
 $correctPassword=$results[0]->password;
 $correctUser=$results[0]->username;


if(!(($correctPassword==$_SERVER['PHP_AUTH_PW'])&&($correctUser==$_SERVER['PHP_AUTH_USER']))) {
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
		<meta name="description" content="Gambit05" />
		<meta name="keywords" content="Finals" />
		<meta name="level" content="1" />


<link rel="shortcut icon" type="image/png" href="../../img/favicon/favicon.png">
<link href="styles.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<?php 



$ref = $_SERVER['HTTP_REFERER'];
if (strpos($ref, $_SERVER['DOCUMENT_ROOT'].'/levels/level4/level4.php') !== FALSE) {
   $message = "Incorrect Referer";
   echo "<script type='text/javascript'>alert('$message');</script>";


      

?>
<script>
 window.location='/levels/level5/level5.php';
</script>

<?php } ?>

<body>
<div class=content>
<h1>Gambit Level 5</h1>
<p id='hint'>cf4103ca9bf90aebc81d1fd53cbed766</p>
	







<?php 

 $DB = DB::getInstance()->get('level', array('id', '=', '6'));
 $results=$DB->results();
 $correctPassword=$results[0]->password;
if(Input::exists()){
 $password=Input::get('password');


 if($correctPassword===$password){
  require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/updateLevel.php';
     Redirect::to('../level6/level6.php?username=user');
 }else{
    echo "<script type='text/javascript'>alert('Wrong');</script>";
     echo "<script>$('#password_entry').val(''); </script>";
 }
}
?>

<form id="form" action='' method='POST'>
<input id='password_entry' type='text' name='password'>
<button id='submit' type='submit'  name='submit' >SUBMIT</button>
<form>
 


  

<footer><?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/gohome.php';?></footer>
</body>
</html>
