<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">

    <title>Gambit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gambit" />
    <meta name="keywords" content="Finals" />

    <link rel="shortcut icon" type="image/png" href="img/favicon/favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/indexErrorCatcher.js"></script>
</head>

<body>

    <?php
require_once 'core/init.php';
    $user = new User();
    if($user->isLoggedIn()){
    Redirect::to('profile.php');
        }
?>


        <?php if($_GET['login']=="error"){ ?>
        <script>
            $('document').ready(function() {
                $('#loginerror').append('Invalid Username or Password');
            });
        </script>
        <!-- END catch Loging Error  -->
        <?php }  ?>






        <?php

//////REGISTER PROCESS/VALIDATION
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        
        if(isset($_POST['username'])){
            
$validate= new Validate();
$validation = $validate->check($_POST, array(
    'username'=> array(
        'required' => true,
        'min' => 5,
        'max' => 20,
        'unique' => 'users',
        'nospace' => ' '
    ),
    'password'=> array(
        'required' => true,
        'min' => 7,
        'nospace' => ' '
        ),
    'password_again'=> array(
        'required' => true,
        'matches' => 'password',
        'nospace' => ' '
        ),
    'country'=>array(
        'required'=>true
        )    
    ));
    
    if($validation->passed()){
        $user = new User();
        $salt = Hash::salt(32);
        
        try{
            $user->create( array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password'),$salt),
                'salt' => $salt,
                'country'=> Input::get('country')
                ));
                Redirect::to('index.php');
            
        }catch(Exception $e){
            die($e->getMessage());
        }
        
    }else{
        $location='index.php?';
        foreach($validation->errors() as $error){
            $location.=$error;
        }
        $location.='#registerForm';
        Redirect::to($location);
    }
}//////END REGISTER PROCESS/VALIDATION

///LOGIN VALIDATION
if(isset($_POST['usernameL'])){
            $validateL = new Validate();
            $validationL = $validateL->check($_POST, array(
            'usernameL' => array('required' => true),
            'passwordL' => array('required' => true)
    
            ));
            if($validationL->passed()){
                $user = new User();
                $login = $user->login(Input::get('usernameL'),Input::get('passwordL'));
            
                if($login){
                    Redirect::to('profile.php?user='.escape($user->data()-username));
                    
                }else{
                    Redirect::to('index.php?login=error');
                }
                
                
            }
    
}///END LOGIN VALIDATION


}//END TOKEN CHECK
}//END INPUT CHECK
?>


            <?php $Token=Token::generate() ?>
            <div class='background'>
                <div class='container'>


                    <div class='row'>
                        <div class='col-sm-12'>
                            <div class='form'>
                                <ul class="tab-group">
                                    <li class="tab"><a id='registerAnchor' href="#registerForm">Sign Up</a></li>
                                    <li class="tab active"><a id='loginAnchor' href="#loginForm">Log In</a></li>
                                </ul>

                                <div class='tab-content' id='tab-content'>
                                    <div id='loginForm'>
                                        <h1>Welcome!</h1>
                                        <form action='' method='POST'>
                                            <div class='form-group'>
                                                <label for='usernameL' class='label'>Username</label>
                                                <input type='text' class='form-control' name='usernameL' id='usernameL' autocomplete='off' placeholder='Enter Username' minlength='5' maxlength='20' required>
                                            </div>

                                            <div class='form-group'>
                                                <label for='passwordL' class='label'>Password</label>
                                                <input type='password' class='form-control' name='passwordL' id='passwordL' autocomplete='off' placeholder='Password' minlength='7' minlength='32' required>
                                            </div>

                                            <div id='loginerror'></div>
                                            <input type='hidden' name='token' value='<?php echo $Token; ?>'>
                                            <input type='submit' class='btn btn-primary btn-lg btn-block' id='loginbtn' value='Login'>
                                        </form>
                                    </div>

                                    <div id='registerForm'>
                                        <h1>Register Now!</h1>
                                        <form action="" method="POST">
                                            <div class='form-group'>
                                                <label for='username' class='label'>Username</label>
                                                <input type='text' class='form-control' name='username' id='username' value="<?php echo escape(Input::get('username')); ?>" autocomplete='off' aria-describedby='userhelp' placeholder='Enter Username' minlength='5' maxlength='20' required>
                                                <small id='userhelp' class='form-text text-muted'>Username must be between 5 and 20 character</small>
                                            </div>
                                            <div id='username_error'></div>

                                            <div class='form-group'>
                                                <label for='password' class='label'>Password</label>
                                                <input type='password' class='form-control' name='password' id='password' aria-describedby='pwdhelp' placeholder='Password' minlength='7' minlength='32' required>
                                                <small id='pwdhelp' class='form-text text-muted'>Password must be between 7 and 32 characters</small>
                                            </div>
                                            <div id='password_error'></div>

                                            <div class='form-group'>
                                                <label for='password_again' class='label'>Confirm Password</label>
                                                <input type='password' class='form-control' name='password_again' id='password_again' placeholder='Confirm Password' minlength='7' minlength='32' required>
                                            </div>
                                            <div id='password_again_error'></div>

                                            <div class='form-group'>
                                                <label for='country' class='label'>Country</label>
                                                <select name='country' class="form-control bfh-countries" data-country="US" required></select>
                                            </div>
                                            <div id='country_error'></div>


                                            <input type='hidden' name='token' value="<?php echo $Token ?>">
                                            <input type='submit' class='btn btn-primary btn-lg btn-block' value='Register'>
                                        </form>
                                    </div>
                                </div>
                                <!--End Tab Content-->
                            </div>
                            <!--End Form Content-->

                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--Row-->


                </div>
                <!-- End Container-->
            </div>
            <!--background-->

            <!-- Footer -->
            <!--<footer class="page-footer font-small blue">-->

            <!-- Copyright -->
            <!--  <div class="footer-copyright text-center py-3">© 2018 Copyright:-->
            <!--    <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>-->
            <!--  </div>-->
            <!-- Copyright -->

            <!--</footer>-->
            <!-- Footer -->


            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.js"></script>
            <script src="js/index.js"></script>
</body>

</html>
