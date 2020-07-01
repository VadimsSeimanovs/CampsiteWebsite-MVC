<?php
require_once 'Database.php';
require_once 'CampData.php';
require_once 'UserData.php';
class CampsiteData {
    protected $_dbConnection, $_dbInstance;
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }
    /*
     * Method to retrieve all of the data about the campsite
     */
    public function fetchAll() {
        $sqlQuery = "SELECT * FROM campsite INNER JOIN campsite_facilities cf on campsite.CampID = cf.CampID INNER JOIN campsite_image ci on campsite.CampID = ci.CampID WHERE Status ='Approved' ORDER BY campsite.CampID DESC ";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new CampData($row);
        }
        return $dataSet;
    }
    public function getCampInfoSearch($search){
        $sqlQuery = "SELECT CampID,CampName,CampCountry FROM campsite WHERE CampName LIKE '$search%' OR CampCountry LIKE '$search%' LIMIT 5";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new CampData($row);
        }
        return $dataSet;
    }
    public function getCampLocDetails()
    {
        $sqlQuery = "SELECT campsite.CampID, CampName, CampLat, CampLong, imagePath FROM campsite INNER JOIN campsite_image ci on campsite.CampID = ci.CampID";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new CampData($row);
        }
        return $dataSet;
    }
    /*
     * function to add the campsite to the database which will insert into 3 database tables that has a link with foreign keys
     *
     */
    public function addCamp($campName, $campAddress,$campCountry, $campEmail, $campPhone, $campOpenDate, $campToilet, $campPool, $campWifi, $campWaterSup, $campChildrenPlay,$imageOne, $imageTwo){
        try {
            if (!empty($campName && $campAddress && $campCountry && $campEmail && $campPhone && $campOpenDate)) {
                $sql = "INSERT INTO campsite(CampName, CampAddress, CampCountry, CampEmail, CampPhone, CampOpenDate) VALUES('$campName','$campAddress','$campCountry','$campEmail','$campPhone','$campOpenDate')";
                $statement = $this->_dbConnection->prepare($sql);
                $statement->execute();
                $campID = $this->_dbConnection->lastInsertId();
                $sql2 = "INSERT INTO campsite_facilities(CampID,Toilet, Pool, Wifi, WaterSupply, ChildrenPlayground)  VALUES('$campID','$campToilet','$campPool','$campWifi','$campWaterSup','$campChildrenPlay')";
                $statement2 =$this->_dbConnection->prepare($sql2);
                $statement2->execute();
                $sql3 = "INSERT INTO campsite_image(CampID, imagePath, image_2) values ('$campID','$imageOne','$imageTwo')";
                $statement3 =$this->_dbConnection->prepare($sql3);
                $statement3->execute();
                //header("Location: postanad.php");
                //var_dump($statement);
                //var_dump($statement2);
                //var_dump($statement3);
            }
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }

    /*
     *
     */
    public function userSearch($searchParam,$countryOption) {
        if(!empty($countryOption)) {
            $sql = "SELECT * FROM campsite INNER JOIN campsite_facilities cf on campsite.CampID = cf.CampID INNER JOIN campsite_image ci on campsite.CampID = ci.CampID WHERE CampName LIKE '$searchParam' OR CampAddress LIKE '$searchParam' OR CampEmail LIKE '$searchParam' OR CampPhone LIKE '$searchParam' OR CampOpenDate LIKE '$searchParam' OR CampCountry LIKE '$countryOption'";
            $statement2 = $this->_dbConnection->prepare($sql);
            $statement2->execute();
            $dataSet = [];
            while ($row = $statement2->fetch()) {
                $dataSet[] = new CampData($row);
            }
            return $dataSet;
        } else

        $sqlQuery = "SELECT * FROM campsite INNER JOIN campsite_facilities cf on campsite.CampID = cf.CampID INNER JOIN campsite_image ci on campsite.CampID = ci.CampID WHERE CampName LIKE '$searchParam' OR CampAddress LIKE '$searchParam' OR CampEmail LIKE '$searchParam' OR CampPhone LIKE '$searchParam' OR CampOpenDate LIKE '$searchParam'";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new CampData($row);
        }
        return $dataSet;
    }

    public function searchByDate($date){
        $sql = "SELECT * FROM campsite INNER JOIN campsite_facilities cf on campsite.CampID = cf.CampID INNER JOIN campsite_image ci on campsite.CampID = ci.CampID WHERE CampOpenDate = '$date'";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new CampData($row);
        }

        return $dataSet;
    }

    public function fetchPendingData(){
        $sqlQuery = "SELECT * FROM campsite INNER JOIN campsite_facilities cf on campsite.CampID = cf.CampID INNER JOIN campsite_image ci on campsite.CampID = ci.CampID WHERE Status = 'Pending'";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statementx
        $statement->execute(); // execute the PDO statement
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new CampData($row);
        }
        return $dataSet;
    }

    public function setApprovedCampsite($campID){
        $sqlStatement = "UPDATE campsite SET Status = 'Approved' WHERE CampID = '$campID'";
        $statement = $this->_dbConnection->prepare($sqlStatement);
        $statement->execute();
        header("Location: userAccount.php");
    }

    public function declineCampsite($campID){
        $sqlStatement = "DELETE FROM campsite WHERE CampID = '$campID'";
        $statement = $this->_dbConnection->prepare($sqlStatement);
        $statement->execute();
        header("Location: userAccount.php");
    }

    public function getCountries(){
        $sql = "SELECT DISTINCT CampCountry FROM campsite WHERE Status ='Approved' ";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
        $country = [];
        while ($row = $statement->fetch()){
            $country[] = new CampData($row);
        }
        return $country;
    }

    public function oneCampsite($campID){
        $sqlQuery = "SELECT * FROM campsite INNER JOIN campsite_facilities cf on campsite.CampID = cf.CampID INNER JOIN campsite_image ci on campsite.CampID = ci.CampID WHERE campsite.CampID='$campID'";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new CampData($row);
        }
        return $dataSet;
    }

    public function addToFavorites($userID,$campID){
        $sql = "INSERT INTO user_favorite(USERID, CAMPID) VALUES ('$userID' , '$campID')";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
        header("Location: index.php");
    }

    public function removeFromFavorites($userID,$campID){
        $sql = "DELETE FROM user_favorite WHERE UserID = '$userID' AND CampID = '$campID'";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
    }

    public function getUserFavorites($userID){
        $sql = "SELECT user_favorite.CampID FROM user_favorite INNER JOIN campsite c on user_favorite.CampID = c.CampID WHERE UserID = '$userID'";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
        $campID = "";
        $dataSet = [];
        while($row = $statement->fetch()){
            $campData = new CampData($row);
            $campID = $campData->getCampID();
        }
        $sql2 = "SELECT * FROM campsite INNER JOIN campsite_facilities cf on campsite.CampID = cf.CampID INNER JOIN campsite_image ci on campsite.CampID = ci.CampID WHERE campsite.CampID='$campID'";
        $statement2 = $this->_dbConnection->prepare($sql2);
        $statement2->execute();
        while ($row = $statement2->fetch()) {
            $dataSet[] = new CampData($row);
        }
        return $dataSet;
    }
}