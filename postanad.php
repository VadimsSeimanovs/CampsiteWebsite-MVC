<?php
include ('Models/CampsiteData.php');
session_start();
$view = new stdClass();
$view->pageTitle = 'Post an ad';
$campName = $_POST['CampName'];
$campAddress = $_POST['CampAddress'];
$campEmail = $_POST['CampEmail'];
$campPhone = $_POST['CampPhone'];
$campToilet = $_POST['Toilet'];
$campPool = $_POST['Pool'];
$campWifi = $_POST['Wifi'];
$campWaterSup = $_POST['WaterSup'];
$campChildrenPlay = $_POST['ChildrenPlay'];
$campOpenDate = $_POST['CampOpenDate'];
$campCountry = $_POST['CampCountry'];
$postCamp = new CampsiteData();
//$pathTwo = '';
if(!empty($_FILES['image']) )
{
    $path = "images/";
    $path = $path . basename( $_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
}
if(!empty($_FILES['secondImage'])){
    $pathTwo = "images/";
    $pathTwo = $pathTwo . basename( $_FILES['secondImage']['name']);
    move_uploaded_file($_FILES['secondImage']['tmp_name'], $pathTwo);
    //var_dump($pathTwo);
}
$postCamp->addCamp($campName,$campAddress,$campCountry,$campEmail,$campPhone,$campOpenDate,$campToilet,$campPool,$campWifi,$campWaterSup,$campChildrenPlay,$path,$pathTwo);
include_once('Views/postanad.phtml');