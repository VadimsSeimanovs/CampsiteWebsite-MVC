<?php

require_once 'Database.php';

class Registration {
    protected $_dbConnection, $_dbInstance;
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }
    /*
     * Function to register the user and store all of the user information in the database
     */
    public function register($title,$name,$surname,$email,$password,$accountType){
        try {
            // Hash password
            $user_hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Define query to insert values into the users table
            $sql = "INSERT INTO users(UserTitle, UserName, UserSurname, UserEmail, UserPassword, UserType) VALUES('$title' , '$name', '$surname','$email','$user_hashed_password','$accountType')";
            // Prepare the statement
            $this->_dbConnection->query($sql);

        } catch (PDOException $e) {
          array_push($errors, $e->getMessage());
        }
    }
}
