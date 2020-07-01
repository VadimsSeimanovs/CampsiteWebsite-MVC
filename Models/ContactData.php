<?php
/*
 * Class that is designed to store all of the data from the table and will be used to display it
 */
class ContactData{

    protected $contactID, $userID, $firstName, $surname, $email, $message;

    public function __construct($dbRow)
    {
        $this->contactID = $dbRow['ContactID'];
        $this->userID = $dbRow['UserID'];
        $this->firstName = $dbRow['FirstName'];
        $this->surname = $dbRow['LastName'];
        $this->email = $dbRow['Email'];
        $this->message = $dbRow['ContactMessage'];
    }

    /**
     * @return mixed
     */
    public function getContactID()
    {
        return $this->contactID;
    }

    /**
     * @return mixed
     */
    public function getForeignUserID()
    {
        return $this->userID;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}