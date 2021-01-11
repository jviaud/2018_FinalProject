<? php 

$user = DB::getInstance()->update('users', 3, array(
    'password' => 'newpassword'
    ));

?>