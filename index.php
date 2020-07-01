<?php
error_reporting(0);
session_start();
include ('Models/CampsiteData.php');
$view = new stdClass();
$view->pageTitle = 'Homepage';
$searchCampData = new CampsiteData();
$view->campsiteDataSet = $searchCampData->fetchAll();
$view->countryDataSet = $searchCampData->getCountries();
if(isset($_POST['addToFavorites'])) {
    $campID = $_POST['campIDhidden'];
    $userID = $_SESSION['userID'];
    $searchCampData->addToFavorites($userID, $campID);

}
$view->campsiteLocation = $searchCampData->getCampLocDetails();
require_once('Views/index.phtml');
