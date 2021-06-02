<?php

require_once('Models/RegisterDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Register';
$view->registerDataSet = null;

//require_once 'autoload.php');
if(isset($_POST['submit'])) {
    
                $registerDataSet = new RegisterDataSet();
                $registerDataSet->createStudent($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);
                $view->registerDataSet = $registerDataSet->fetchAllUsers();
               
    
} else {
    $registerDataSet = new RegisterDataSet();
    $view->registerDataSet = $registerDataSet->fetchAllUsers(); 
}

require_once('Views/register.phtml');
