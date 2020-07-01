<?php
session_start();

require 'Models/Database.php';
require 'Models/Login.php';

$loginSystem = new Login();

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $loginSystem->clean($_POST['email']);
    $password = $loginSystem->clean($_POST['password']);

    if($email != "" && $password != ""){
        if($loginSystem->loginin($email, $password) == true )
        {
            header("location: userAccount.php");
        }
        else
        {
           $_error = "Incorrect username or password.";
        }
    }
    else{
        die("Invalid Token");
    }
}