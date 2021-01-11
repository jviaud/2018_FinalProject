<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
//////REGISTER PROCESS/VALIDATION
if(Input::exists()){//echo 'Passed Exsist';
    if(Token::check(Input::get('token'))){//echo 'Passed Token';

$validate= new Validate();
$validation = $validate->check($_POST, array(
    'country'=>array(
        'required'=>true
        )    
    ));
    
    if($validation->passed()){
       // echo 'Passed Valid';
        try{
            $id=$_SESSION['user'];
            $table = DB::getInstance()->update('users',$id, array(
            'country' => Input::get('country')
                     ));
                Redirect::to($_SERVER['DOCUMENT_ROOT'].'/profile.php?update=success');
            
        }catch(Exception $e){
            die($e->getMessage());
        }
        
    }else{
        $location='profile.php?';
        foreach($validation->errors() as $error){
            $location.=$error;
        }
        $location.='#update';
        Redirect::to($location);
    }



}//END TOKEN CHECK
}//END INPUT CHECK
?>


