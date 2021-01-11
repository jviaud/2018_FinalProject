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
    <link href="css/leaderboard.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
include_once 'includes/nav.php';
?>

        <hr>
        <div class='container'>

            <div class='row'>

                <input id='search' class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">

            </div>
            <br><br>


            <?php 
//echo 'Current PHP version: ' . phpversion();
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

array_multisort($level,SORT_DESC,$fintime,SORT_ASC,$users);




for($i=0;$i<count($users);$i++){

?>


            <div class="tile ">
                <div id='info'>
                    <img class='rounded-circle img-fluid profile-img' src="<?php if(file_exists('uploads/'.$users[$i]['username'].'.jpg')){echo 'uploads/'.$users[$i]['username'].'.jpg';}else{echo 'img/profile/temp.jpg';}?>">
                    <h4 id='name'>
                        <?php echo $users[$i]['username']?>
                    </h4>
                    <h5 id='country'>
                        <?php echo $users[$i]['country']?>
                    </h5>
                    <p id='rank'>RANK:
                        <?php echo $users[$i]['level']?><img class='rank' src="img/ranks/rank_<?php echo $users[$i]['level']?>.png"></p>
                    <p>
                        <?php echo $users[$i]['fintime']?>
                    </p>
                </div>
            </div>

            <?php } ?>



            <hr>
            <!--<div class="row">-->
            <!--    <div class="col-md-4 col-md-offset-4 text-center">-->
            <!--        <ul class="pagination" id="myPager"></ul>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
        <!-- Container -->


        <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/leaderboard.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


</body>

</html>
