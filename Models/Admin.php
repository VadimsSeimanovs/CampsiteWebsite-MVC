<?php
require_once 'UserData.php';
class Admin{

    protected $_dbConnection, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }

    /*
     * Function to remove the user form the database if the user was behaving in a bad way
     */
    public function removeUser($userParam){
        $sql = "DELETE FROM users WHERE UserID LIKE '$userParam' OR UserEmail LIKE '$userParam'";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
        header("Location: userAccount.php");
        return true;
    }

    /*
     * Function to remove the campsite from the database if admin of the website wants to remove campsite
     */
    public function removeCampsite($campsiteID){
        $sql = "DELETE FROM campsite WHERE CampID ='$campsiteID'";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
        header("Location: userAccount.php");
        return true;
    }

    /*
     * Function to view particular campsite just incase admin want to see the information about that campsite
     */
    public function viewCampsite($campID){
        $sql = "SELECT * FROM campsite WHERE CampID = $campID";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new CampData($row);
        }
        header("Location: userAccount.php");
        return $dataSet;
    }

    /*
     * Function to view User account by user id or user email
     */
    public function viewUserAccount($userParam){
        $sql = "SELECT * FROM users WHERE UserID LIKE '$userParam' OR UserEmail LIKE '$userParam'";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        header("Location: userAccount.php");
        return $dataSet;
    }
    /*
    * Function to give an admin to the user however this is only if a user have admin permissions
    */
    public function giveAdmin($userParam){
        $sql = "UPDATE users SET UserType = 'Admin' WHERE UserID LIKE '$userParam' OR UserEmail LIKE '$userParam'";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
        header("Location: userAccount.php");
        return true;
    }
    /*
     * Function to remove permissions from the user
     */
    public function removePermissions($userParam){
        $sql = "UPDATE users SET UserType = 'Personal' WHERE UserID LIKE '$userParam' OR UserEmail LIKE '$userParam'";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
        header("Location: userAccount.php");
        return true;
    }

    /*
     * Function to give moderator on the website which have less then admin function(only allowed to remove and view campsite/user)
     */
    public function giveModerator($userParam){
        $sql = "UPDATE users SET UserType = 'Moderator' WHERE UserID LIKE '$userParam' OR UserEmail LIKE '$userParam'";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();
        header("Location: userAccount.php");
    }


}