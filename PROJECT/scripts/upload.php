<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
$user = new User();
//print_r($user->data()->username);
$username=$user->data()->username;
if(isset($_POST['upload'])){
    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
   
   
   $fileExt = explode('.',$fileName);
   $fileActualExt = strtolower(end($fileExt));
   
   
   $allowed = array('jpg','jpeg','png','webp');
   
   if(in_array($fileActualExt, $allowed)){
       if($fileError===0){
           if($fileSize > 2000){
            $fileNameNew = $username .'.'. 'jpg'; //just save it as a jpg. Doesn't matter what I save it as, the file will retain it's original extension because no changes are made to the header
            //echo $fileNameNew;
            
            $fileDestination = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$fileNameNew;
            move_uploaded_file($fileTmpName,$fileDestination); 
            Redirect::to('../profile.php?upload=success');
           
           }else{//file is too big
               Redirect::to('../profile.php?upload=fail');;
           }
           
       }else{// file error
           Redirect::to('../profile.php?upload=fail');
       }
   }//end inner if
   else{//file type not supported
       Redirect::to('../profile.php?upload=fail');
   }
   
}
?>