<?php


$id=$_SESSION['user'];
$DB_USER = DB::getInstance()->get('users', array('id', '=', $id))->results();
$level=$DB_USER[0]->level;
//echo '<br>User Level:',$level;
date_default_timezone_set('America/New_York');
$date=date('Y-m-d H:i:s');
$page=$_GET['level'];




if($page > $level){

try{
    $table = DB::getInstance()->update('users', $id, array(
    'level' => $page,
    'fintime'=>$date
    ));
    
    $table = DB::getInstance()->insert('stats', array(
    'id'=>$id,    
    'level' => $page,
    'fintime'=>$date
    ));
}catch(Exception $e){
    die($e->getMessage());
}
}//if

?>