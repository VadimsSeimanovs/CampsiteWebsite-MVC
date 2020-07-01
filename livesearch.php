<?php
include ('Models/CampsiteData.php');
session_start();
error_reporting(0);
$campsiteDataSet = new CampsiteData();
$q = $_REQUEST["q"];
//  var_dump($q);
if ($q < 3) {
    $a = $campsiteDataSet->getCampInfoSearch($q);
if($campsiteDataSet->getCampInfoSearch($q) != "") {
    $view->campsiteDataSet = $campsiteDataSet->getCampInfoSearch($q);
    if ($a != null) {
        foreach ($a as $camp) {
            echo "<div class='button'>";
            $string = 'view.php?campIDhidden=';
            $id = $camp->getCampID();
            $string2 = '&View=View';
            echo "<a href=" . $string . $id . $string2 . ">";
            echo $camp->getCampName() . " " . $camp->getCampCountry();
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "no data";
    }
    if ($q === null) {
        echo "Please enter the value";
    }
}
}