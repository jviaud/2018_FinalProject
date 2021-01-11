<?php
require_once 'core/init.php'; ?>

<?php
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
    
            ));
            if($validation->passed()){
                $user = new User();
                $login = $user->login(Input::get('username'),Input::get('password'));
            
                if($login){
                    echo 'Success';
                }else{
                    echo 'Sorry';
                }
                
                
            }else{
                foreach($validation->errors() as $error){
                    echo $error, '<br>';
                    
                }
            }
            
    }
}
?>


<?php 
$user = new User();
if($user->isLoggedIn()){
    echo 'Logged in';
}

?>