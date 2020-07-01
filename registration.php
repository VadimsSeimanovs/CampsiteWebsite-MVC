<?php
session_start();
$view = new stdClass();
$view->pageTitle = 'registration Page';
include_once('Views/registration.phtml');
$userTitle = $_POST['title'];
$name = $_POST['first_name'];
$surname = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$conPassword = $_POST['confirm_password'];
$accountType = $_POST['accountType'];
if($password == $conPassword){
    require 'Models/Registration.php';
    $user = new Registration();
    $user->register($userTitle,$name,$surname,$email,$password,$accountType);
}
else{
    echo "Password didn't match";
}