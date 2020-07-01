<?php
include_once ('Database.php');
include_once ('ContactData.php');
include_once ('UserData.php');
class ContactSystem{

    protected $_dbConnection, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }
    /*
     * Function to out all of the messages that users have sent
     */
    public function getAllMessage(){
        $sql = "select * from contactUS";
        $statement = $this->_dbConnection->prepare($sql);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ContactData($row);
        }
        //var_dump($dataSet);
        return $dataSet;
    }
}