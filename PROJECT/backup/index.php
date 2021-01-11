<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<?php
require_once 'core/init.php'; ?>

<?php
if(Session::exists('home')){
    echo '<p>'. Session::flash('home') .'</p>';
}
?>

<?php
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        
        
        $validateL = new Validate();
        $validationL = $validateL->check($_POST, array(
            'usernameL' => array('required' => true),
            'passwordL' => array('required' => true)
    
            ));
            if($validationL->passed()){
                $user = new User();
                $login = $user->login(Input::get('usernameL'),Input::get('passwordL'));
            
                if($login){
                    echo 'Success';
                }else{
                    echo 'Sorry';
                }
                
                
            }else{
                foreach($validationL->errors() as $error){
                    echo $error, '<br>';
                    
                }
            }
           
    }
}
?>


<div class='form'>
    <div class='login_form'>
<form action='' method='POST'>
    <div class='form-group'>
        <label for='usernameL'>Username</label>
        <input type='text' class='form-control' name='usernameL' id='usernameL' autocomplete='off' placeholder='Enter Username' minlength='5' maxlength='20' required>
    </div>
    
     <div class='form-group'>
        <label for='passwordL'>Password</label>
        <input type='password' class='form-control' name='passwordL' id='passwordL' autocomplete='off' placeholder='Password' minlength='7' minlength='32' required>
    </div>
    
    <input type='hidden' name='token' value='<?php echo Token::generate(); ?>'>
    <input type='submit' class='btn btn-primary' id='loginbtn' value='Login'>
</form>
</div>
</div>

<?php 
$user = new User();
if($user->isLoggedIn()){
   Redirect::to('profile.php');
}

?>