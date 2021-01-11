<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<?php
require_once 'core/init.php';


if(Input::exists()){
    if(Token::check(Input::get('token'))){
        
        if(isset($_POST['username'])){
$validate= new Validate();
$validation = $validate->check($_POST, array(
    'username'=> array(
        'required' => true,
        'min' => 5,
        'max' => 20,
        'unique' => 'users'
    ),
    'password'=> array(
        'required' => true,
        'min' => 7
        ),
    'password_again'=> array(
        'required' => true,
        'matches' => 'password'
        )
    ));
    
    if($validation->passed()){
        $user = new User();
        $salt = Hash::salt(32);
        
        try{
            $user->create( array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password'),$salt),
                'salt' => $salt
                ));
                
                
                Session::flash('home','You Are Registered');
                Redirect::to('index.php');
            
        }catch(Exception $e){
            die($e->getMessage());
        }
        
    }else{
        foreach($validation->errors() as $error){
            echo $error, '<br>';
            
        }
    }
}
}
}
?>
<div class='form'>
    <div class='login_form'>
        <form action="" method="POST" name='registerForm'>
            <div class='form-group'>
                <label for='username'>Username</label>
                <input type='text' class='form-control' name='username' id='username' value="<?php echo escape(Input::get('username')); ?>" autocomplete='off' aria-describedby='userhelp' placeholder='Enter Username' minlength='5' maxlength='20' required>
                <small id='userhelp' class='form-text text-muted'>Username must be between 5 and 20 character</small>
             </div>
    
            <div class='form-group'>
                <label for='password'>Password</label>
                <input type='password' class='form-control' name='password' id='password' aria-describedby='pwdhelp' placeholder='Password' minlength='7' minlength='32' required>
                <small id='pwdhelp' class='form-text text-muted'>Password must be between 7 and 32 characters</small>
            </div>
    
            <div class='form-group'>
                <label for='password_again'>Re-Enter Password</label>
                <input type='password' class='form-control' name='password_again' id='password_again' placeholder='Confirm Password' minlength='7' minlength='32' required>
            </div>
    
    
    
            <input type='hidden' name='token' value="<?php echo Token::generate() ?>" >
            <input type='submit' class='btn btn-primary' id='registerbtn' value='Register'>
        </form>
    </div>
</div>


