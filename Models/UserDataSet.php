<?php
require_once 'Database.php';
require_once 'UserData.php';
class UserDataSet{
    protected $_dbConnection, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }

    /*
     * Function to select only some of the data from the users table based on the user email information
     */
    public function fetchUser($userEmail){
        $sqlQuery= 'SELECT UserID, UserTitle , UserName, UserSurname, UserEmail, UserType FROM users WHERE UserEmail = ? ';
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $param=array("$userEmail");
        $statement->execute($param); // execute the PDO statement
        $dataSet= $statement->fetch();
        $userData=new UserData($dataSet);
        return $userData;
    }

    /*
     * Function to fetch all of the users is the userType = Pending in order to admin approve the data
     */
    public function fetchPendingUser(){
        $sqlQuery= "SELECT UserID, UserTitle , UserName, UserSurname, UserEmail, UserType FROM users WHERE UserType = 'Pending'";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $userDataSet = [];

        while ($row = $statement->fetch()) {
            $userDataSet[] = new UserData($row);
        }

        return $userDataSet;
    }
    /*
     * Function approve the
     */
    public function approveUser($userID){
        $sqlStatement = "UPDATE users SET UserType = 'Business' WHERE UserID = '$userID'";

        $statement = $this->_dbConnection->prepare($sqlStatement);
        $statement->execute();

        header("Location: userAccount.php");
    }

    public function declineUser($userID){
        $sqlStatement = "UPDATE users SET UserType = 'Personal' WHERE UserID = '$userID'";

        $statement = $this->_dbConnection->prepare($sqlStatement);
        $statement->execute();

        header("Location: userAccount.php");
    }
}