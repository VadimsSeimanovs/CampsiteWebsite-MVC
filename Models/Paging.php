<?php
require_once 'Database.php';
require_once 'CampData.php';
class Paging{
    protected $_dbConnection, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }

    public function paging(){

        if (!isset($_GET['pageno'])) {
            $page = $_GET['pageno'];
        } else {
            $page = 1;
        }
        $limit = 10;
        $offset = ($page-1) * $limit;
        $query = "SELECT * FROM campsite INNER JOIN campsite_facilities cf on campsite.CampID = cf.CampID WHERE Status ='Approved'";
        $statement = $this->_dbConnection->prepare($query);
        $statement->execute();
        $total_result = $statement->rowCount();
        $total_pages = ceil($total_result/$limit);
        $show = "SELECT * FROM campsite INNER JOIN campsite_facilities cf on campsite.CampID = cf.CampID WHERE Status ='Approved' ORDER BY campsite.CampID LIMIT $offset,$limit";
        $statement2 = $this->_dbConnection->prepare($show);
        $statement2->execute();
        $dataSet = [];
        while ($row = $statement2->fetch()) {
            while ($row = $statement->fetch()) {
                $dataSet[] = new CampData($row);
            }
            //var_dump($dataSet);
            return $total_pages;
        }
    }


}