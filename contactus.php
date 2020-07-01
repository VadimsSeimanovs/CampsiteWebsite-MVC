<?php
session_start();
include_once ('Models/Login.php');
$view = new stdClass();
$view->pageTitle = "Contact us";
$firstName = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$message = $_POST['message'];
$contact = new Login();

$actualEmail = $_SESSION['login_user'];

$contact->contactUs($firstName,$surname,$email,$message,$actualEmail);

//echo $firstName . $surname . $email . $message;
include_once ('Views/contactus.phtml');