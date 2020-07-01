<?php
session_start();
require_once 'Models/CampsiteData.php';
$view = new stdClass();
$result = $_GET['searchParam'];
$view->pageTitle = 'Search Page';
$searchData = new CampsiteData();
$countryOption = '';
$dateOption = '';
$view->searchCampDataSet = $searchData->userSearch($result,$countryOption);
$dateOption = $_GET['Date'];
$view->searchCampDataSet = $searchData->searchByDate($dateOption);
if(isset($_GET['country'])) {
    foreach ($_GET['country'] as $countryOpt) {
        $countryOption = $countryOpt;
        $view->searchCampDataSet = $searchData->userSearch($result, $countryOpt);
    }
}else{
    $view->searchCampDataSet = $searchData->userSearch($result, $countryOption);
}
include_once ('Views/searchPage.phtml');