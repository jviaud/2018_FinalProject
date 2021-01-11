<?php 
//credentials and core variables
session_start();

$GLOBALS['config']=array(
    'mysql'=> array(
        'host' => '127.0.0.1',
        'username' => 'jviaud',
        'password' => '',
        'db' => 'gambit'
        ),
    'session'=> array(
        'session_name' => 'user',
        'token_name' => 'token'
        )
    );
    
//So I don't need to list every class   
spl_autoload_register(function($class){
    require_once $_SERVER['DOCUMENT_ROOT'].'/classes/'. $class . '.php';
});
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/clean.php';

?>