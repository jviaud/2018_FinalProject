<!doctype html>
<html lang="en-us">
<head>
<meta charset="utf-8">

<title>Gambit</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Leaderboard" />
		<meta name="keywords" content="Finals" />

<link rel="shortcut icon" type="image/png" href="img/favicon/favicon.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/altStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
//require_once 'core/init.php';
include_once 'includes/nav.php';
?>

<hr>

<div class="container">
 <table class="table table-hover" >
  <thead class="thead-white">
    <tr>
      <th scope="col">User</th>
      <th scope="col">Country</th>
      <th scope="col">Level</th>
      <th scope="col">Complete Time</th>
    </tr>
  </thead>
  <tbody>

<?php 
//echo 'Current PHP version: ' . phpversion();
// $LEVEL = DB::getInstance()->get('level', array('id', '>', '0'))->results();
$DB = DB::getInstance()->get('users', array('id', '>', '0'))->results();



// print_r($DB);

for($i=0;$i<count($DB);$i++){
$users[]=array(
			'username'=>$DB[$i]->username,
			'country'=>$DB[$i]->country,
			'level'=>$DB[$i]->level,
			'fintime'=>$DB[$i]->fintime
		);
}
//print_r($users);

$level=array_column($users,'level');
$fintime=array_column($users,'fintime');

//print_r(array_multisort(array_column($users, 'level'), SORT_ASC, $users));


array_multisort($level,SORT_DESC,$fintime,SORT_ASC,$users);


//print_r($users[0]['username']);


for($i=0;$i<count($users);$i++){
?>
  
  


    <tr>
      <th scope="row"><?php echo $users[$i]['username']?></th>
      <td><?php echo $users[$i]['country']?></td>
      <td><?php echo $users[$i]['level']?></td>
      <td><?php echo $users[$i]['fintime']?></td>
    </tr>
    

    <?php } ?>
  
	
</tbody>
</table> 
<hr>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <ul class="pagination" id="myPager"></ul>
                            </div>
                        </div>
</div><!-- Container -->



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>




