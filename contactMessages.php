<?php
session_start();
include_once ('Models/ContactSystem.php');
include_once ('Models/UserData.php');
include_once ('Models/ContactData.php');
$view = new stdClass();
$view->pageTitle = 'Customer Service';
$perm = $_SESSION['user_permission'];
$messages = new ContactSystem();
if($perm === 'Admin'){

    $view->messagesData = $messages->getAllMessage();
}


require_once ('Views/contactMessages.phtml');