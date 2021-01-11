<?php 

class Config{
    public static function get($path = null){
        if($path){
            $config = $GLOBALS['config'];
            $path = explode('/',$path );
            
            //print_r($path);
            foreach($path as $bit){
                //echo $bit;
                if(isset($config[$bit])){
                    $config= $config[$bit];
                }//end inner if
            }//end foreach
            
            return $config;
            
        }//end outter if
        
        return false;
        
    }//end get method
}//end Config class



?>