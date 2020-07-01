<?php
require_once 'Database.php';
/*
 * Class designed to store all of the information that has been retrieved from the database
 */
class UserData{

    protected $_userID, $_userTitle, $_userName, $_userSurname, $_userEmail,$_password , $_userType;

    public function __construct($dbRow)
    {
        $this->_userID = $dbRow['UserID'];
        $this->_userTitle = $dbRow['UserTitle'];
        $this->_userName = $dbRow['UserName'];
        $this->_userSurname = $dbRow['UserSurname'];
        $this->_userEmail = $dbRow['UserEmail'];
        $this->_password=$dbRow['UserPassword'];
        $this->_userType = $dbRow['UserType'];
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->_userID;
    }

    /**
     * @return mixed
     */
    public function getUserTitle()
    {
        return $this->_userTitle;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->_userName;
    }

    /**
     * @return mixed
     */
    public function getUserSurname()
    {
        return $this->_userSurname;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->_userEmail;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }
    /**
     * @return mixed
     */
    public function getUserType()
    {
        return $this->_userType;
    }
}