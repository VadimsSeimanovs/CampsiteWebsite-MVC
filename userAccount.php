<?php
require 'Models/Database.php';
require 'Models/Login.php';
require 'Models/UserDataSet.php';
require 'Models/CampsiteData.php';
require 'Models/Admin.php';
session_start();
$view = new stdClass();
$view->pageTitle='Account Page';
$userData = new UserDataSet();

if(isset($_SESSION['login_user'])){
    $user=$userData->fetchUser($_SESSION['login_user']);
}
$searchCampPending = new CampsiteData();
$view->campsiteDataSet = $searchCampPending->fetchPendingData();

if(isset($_POST['Approved'])){
    $campID= $_POST['campIDhidden'];
    $searchCampPending->setApprovedCampsite($campID);
}

if(isset($_POST['Declined'])){
    $campID = $_POST['campIDhidden'];
    $searchCampPending->declineCampsite($campID);
}

if(isset($_POST['removeFavorite'])){
    $userID = $_SESSION['userID'];
    $campID = $_POST['campIDhidden'];
    $searchCampPending->removeFromFavorites($userID,$campID);
}
$userID = $_SESSION['userID'];
$view->favoriteCampsite=$searchCampPending->getUserFavorites($userID);
$view->userDataSet = $userData->fetchPendingUser();
if(isset($_POST['userApprove'])){
    $userID = $_POST['userIDhidden'];
    $userData->approveUser($userID);
}
if(isset($_POST['userDecline'])){
    $userID = $_POST['userIDhidden'];
    $userData->declineUser($userID);
}
$adminObj = new Admin();

if(isset($_POST['RemoveUser'])){
    $param = $_POST['RemoveUser'];
    if($param != $_SESSION['login_user']) {
        $adminObj->removeUser($param);
    }
}

if(isset($_POST['RemoveCampsite'])){
    $removeCamp = $_POST['RemoveCampsite'];
    $adminObj->removeCampsite($removeCamp);
}

if(isset($_POST['GiveAdmin'])){
    $giveAdmin = $_POST['GiveAdmin'];
    $adminObj->giveAdmin($giveAdmin);
}

if(isset($_POST['RemoveAdmin'])){
    $param = $_POST['RemoveAdmin'];
    if($param != $_SESSION['login_user']) {
        $adminObj->removePermissions($param);
    }
}

if(isset($_POST['GiveModerator'])){
    $giveModerator = $_POST['GiveModerator'];
    $adminObj->giveModerator($giveModerator);
}

if (isset($_POST['RemoveModerator'])){
    $removeModerator = $_POST['RemoveModerator'];
    $adminObj->removePermissions($removeModerator);
}

//$pending = $userData->fetchPendingUser();
include_once ('Views/userAccount.phtml');