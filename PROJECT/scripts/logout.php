<?php

require '../classes/Redirect.php';

session_start();
session_unset();


Redirect::to('../index.php');
?>
