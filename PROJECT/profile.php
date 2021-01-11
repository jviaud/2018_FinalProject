<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">

    <title>Gambit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Profile" />
    <meta name="keywords" content="Finals" />


    <link rel="shortcut icon" type="image/png" href="img/favicon/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
    <?php
include_once 'includes/nav.php';
?>

        <hr>
        <div class="container-fluid">

            <?php if($_GET['update']=='success' || $_GET['upload']=='success'){ ?>
            <div class="alert alert-success alert-dismissible">
                <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>Alert: </strong>Changes Successful</div>

            <?php } else if($_GET['upload']=='fail'){ ?>
            <div class="alert alert-danger alert-dismissible">
                <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>Alert: </strong>Upload Failed</div>
            <?php } 





$username=$user->data()->username;
$customDes ="uploads/".$username.".jpg";
$tmpDes = "img/profile/temp.jpg";
$finalDes;

if(file_exists($customDes)){
    $finalDes=$customDes;
}else{$finalDes=$tmpDes;}


?>

            <div class='container'>
                <div class="row">
                    <div class="col-sm-10">
                        <img title="profile image" id='profile_img' class="profile-img rounded-circle img-fluid" src='<?php echo $finalDes ?>' alt='Responsive image'>
                    </div>
                </div>
                <!--End first Row-->

                <div class="row">
                    <div class="col-sm-4">
                        <form class="form-inline upload" action="scripts/upload.php" method="POST" enctype="multipart/form-data">
                            <label title="choose image" for='file'>
                            <div class='p-image'><i class="fas fa-camera p-camera"></i></div>
                            <input type='file' id='file' name='file' onchange='readURL(this);' style='display:none;' >
                        </label>
                            <hr>

                            <label title="upload image" for='upload-btn'>
                           <div class='p-image'><i class="fas fa-upload p-upload"></i></div>
                           <button id='upload-btn' class='.btn' type='submit' name='upload' style='display:none;'>Upload</button>  
                         </label>
                        </form>
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-2">
                        <h1 id=curr-user-name>
                            <?php echo $user->data()->username;?>
                        </h1>
                    </div>
                </div>
                <!--End third Row-->

                <div class="row">
                    <div class="col-sm-3">
                        <!--left col-->
                        <ul class="list-group">
                            <li class="list-group-item text-muted">User Info</li>
                            <li class="list-group-item text-left"><span class="pull-left"><strong>Country</strong></span><br>
                                <?php echo $user->data()->country;?>
                            </li>
                            <li class="list-group-item text-left"><span class="pull-left"><strong>Joined</strong></span><br>
                                <?php echo $user->data()->joindate;?>
                            </li>
                            <li class="list-group-item text-left"><span class="pull-left"><strong>Last seen</strong></span><br>
                                <?php echo $user->data()->lastonline;?>
                            </li>
                            <li class="list-group-item text-left"><span class="pull-left"><strong>Level</strong></span><br>
                                <?php echo $user->data()->level;?>
                            </li>
                        </ul>
                    </div>
                    <!--/col-3-->
                    <div class="col-sm-9">

                        <ul class="nav nav-tabs" id="nav-tab">
                            <li><a class='nav-item nav-link active' href="#stats" data-toggle="tab">Home</a></li>
                            <li><a class='nav-item nav-link' href="#update" data-toggle="tab">Update</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="stats">
                                <div class="table-responsive">
                                    <?php include_once 'includes/stats.php' ?>
                                </div>
                                <!--/table-resp-->
                            </div>
                            <!--/tab-pane-->

                            <!--/tab-pane-->
                            <div class="tab-pane" id="update">
                                <br>

                                <?php $Token=Token::generate() ?>
                                <form class="form" action="scripts/update.php" method="POST" id="updateForm">

                                    <div class='form-group'>
                                        <div class="col-xs-12">
                                            <label for='country' class='label'>Country</label>
                                            <select name='country' class="form-control bfh-countries" data-country='<?php echo $user->data()->country;?>' required></select>
                                            <div id='country_error'></div>
                                        </div>
                                    </div>
                                    <!--first-form-group-->

                                    <input type='hidden' name='token' value="<?php echo $Token ?>">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <br>
                                            <button class="btn btn-lg btn-success" type="submit" aria-label="Left Align"><i class="fas fa-check"></i> Save</button>
                                            <button class="btn btn-lg btn-dark" type="reset"><i class="fas fa-times"></i> Reset</button>
                                        </div>
                                    </div>
                                    <!--second-form-group-->

                                </form>
                            </div>
                            <!--tab-pane-->
                        </div>
                        <!--/tab-content-->
                    </div>
                    <!--/col-sm-9-->

                </div>
                <!--/Row-->
            </div>
            <!--Container-->






            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="js/profile.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <!--<link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">-->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</body>

</html>
