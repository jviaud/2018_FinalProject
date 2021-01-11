<?php 
//Googled the best way to prevent users from input invalid information into database
function escape($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}


?>