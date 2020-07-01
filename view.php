<?php
session_start();
include_once 'Models/CampsiteData.php';
$view = new stdClass();
$view->pageTitle = 'Homepage';
$oneCampsite = new CampsiteData();

if(isset($_GET['View'])){
    $campID = $_GET['campIDhidden'];
    //$campID = '21';
    $view->campsiteData = $oneCampsite->oneCampsite($campID);
}

require_once ('Views/view.phtml');

//var_dump($campID);