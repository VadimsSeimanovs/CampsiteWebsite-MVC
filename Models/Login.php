<?php
//require_once  'Database.php';
require_once 'UserData.php';

class Login{
    protected $_dbConnection, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }

    /*
     * Function to login
     */
    public function loginin($email,$password){
        if(!empty($email) && !empty($password)) { //if email and password are not empty
            $query='SELECT * FROM users WHERE UserEmail=?';  //selects all from the table where user email is the email that has been passed to the function
            $statement=$this->_dbConnection->prepare($query); //prepares the sql query
            $param=array("$email"); //puts the email in to the array
            $statement->execute($param); //executes the sql statement
            $data=$statement->fetch(); //fetch to find the row that we need
            if ($data===false) {
                echo "Your credentials were incorrect";
            } else {
                $user=new UserData($data); //if data === true then the user object will be created
                if(password_verify($password,$user->getPassword())){ //password_verify is used in order to check the password that has been entered
                    //with the password that has been stored as a hash
                    $userType = $user->getUserType(); //get the user account type that has been stored in the database
                    $userID = $user->getUserID(); // gets the user ID that has been auto incremented
                    $_SESSION['login_user'] = $email; //store email in the session
                    $_SESSION['user_permission'] = $userType; //store user permission in the session
                    $_SESSION['userID'] = $userID; //store userID in the ssion
                    return true;
                }
            }
        }else{
                die("Data Not Recieved");
            }
        }

        /*
         * function to encrypt the password
         */
        public function encryptPass($password){
        if(!empty($password)){
            return password_hash($password, PASSWORD_DEFAULT);
        }
        }
        /*
         * function to clean the data
         */
        public function clean($data){
        if(!empty($data)){
            $data = trim(strip_tags(stripcslashes($data)));
            return $data;
            }
        }
 /*
  * This needs to be moved to the contact System
  */
    public function contactUs($firstName, $lastName, $email,$contactMessage, $actualemail){
        try {
            if(!empty($firstName && $lastName && $email && $contactMessage)) {
                $sqlUserID = "SELECT UserID FROM users where UserEmail = '$actualemail'";
                $statement2 = $this->_dbConnection->prepare($sqlUserID);
                $statement2->execute();
                $userID = "";
                while($row = $statement2->fetch()){
                    $dataSet = new UserData($row);
                    $userID = $dataSet->getUserID();
                }
                //var_dump($userID);
                $sql = "INSERT INTO contactUS (UserID, FirstName, LastName, Email, ContactMessage) VALUES ('$userID','$firstName' ,'$lastName', '$email','$contactMessage' )";
                $statement= $this->_dbConnection->prepare($sql);
                $statement->execute();
            }
        }
        catch (PDOException $e){
            array_push($errors,$e->getMessage());
        }
    }
}