<?php

require_once 'Database.php';


/*
 * This Class is responsable of creating a campsite objects with all of the parameters that it must have
 */
class CampData{

    protected $_campID, $_campName, $_campAddress, $_campEmail, $_campPhone, $_campOpenDate, $_campLat, $_campLong, $_campStatus, $_campCountry, $_campToilet, $_campPool, $_campWifi,$_campWaterSup, $_campChildrenPlay;
    protected $_mainImage, $_secondImage;

    public function __construct($dbRow)
    {
        $this->_campID = $dbRow['CampID'];
        $this->_campName = $dbRow['CampName'];
        $this->_campAddress = $dbRow['CampAddress'];
        $this->_campCountry = $dbRow['CampCountry'];
        $this->_campEmail = $dbRow['CampEmail'];
        $this->_campPhone = $dbRow['CampPhone'];
        $this->_campOpenDate = $dbRow['CampOpenDate'];
        $this->_campLat = $dbRow['CampLat'];
        $this->_campLong = $dbRow['CampLong'];
        $this->_campStatus = $dbRow['Status'];
        $this->_campToilet = $dbRow['Toilet'];
        $this->_campPool = $dbRow['Pool'];
        $this->_campWifi = $dbRow['Wifi'];
        $this->_campWaterSup = $dbRow['WaterSupply'];
        $this->_campChildrenPlay = $dbRow['ChildrenPlayground'];
        $this->_mainImage = $dbRow['imagePath'];
        $this->_secondImage = $dbRow['image_2'];
    }

    /**
     * @return mixed
     */
    public function getCampID()
    {
        return $this->_campID;
    }

    /**
     * @return mixed
     */
    public function getCampName()
    {
        return $this->_campName;
    }

    /**
     * @return mixed
     */
    public function getCampAddress()
    {
        return $this->_campAddress;
    }

    /**
     * @return mixed
     */
    public function getCampEmail()
    {
        return $this->_campEmail;
    }

    /**
     * @return mixed
     */
    public function getCampPhone()
    {
        return $this->_campPhone;
    }

    /**
     * @return mixed
     */
    public function getCampOpenDate()
    {
        return $this->_campOpenDate;
    }

    /**
     * @return mixed
     */
    public function getCampStatus()
    {
        return $this->_campStatus;
    }

    /**
     * @return mixed
     */
    public function getCampCountry()
    {
        return $this->_campCountry;
    }

    /**
     * @return mixed
     */
    public function getCampToilet()
    {
        return $this->_campToilet;
    }

    /**
     * @return mixed
     */
    public function getCampPool()
    {
        return $this->_campPool;
    }

    /**
     * @return mixed
     */
    public function getCampWifi()
    {
        return $this->_campWifi;
    }

    /**
     * @return mixed
     */
    public function getCampWaterSup()
    {
        return $this->_campWaterSup;
    }

    /**
     * @return mixed
     */
    public function getCampChildrenPlay()
    {
        return $this->_campChildrenPlay;
    }


    /**
     * @param mixed $campAddress
     */
    public function setCampAddress($campAddress): void
    {
        $this->_campAddress = $campAddress;
    }

    /**
     * @param mixed $campChildrenPlay
     */
    public function setCampChildrenPlay($campChildrenPlay): void
    {
        $this->_campChildrenPlay = $campChildrenPlay;
    }

    /**
     * @param mixed $campCountry
     */
    public function setCampCountry($campCountry): void
    {
        $this->_campCountry = $campCountry;
    }

    /**
     * @param mixed $campEmail
     */
    public function setCampEmail($campEmail): void
    {
        $this->_campEmail = $campEmail;
    }

    /**
     * @param mixed $campName
     */
    public function setCampName($campName): void
    {
        $this->_campName = $campName;
    }

    /**
     * @param mixed $campOpenDate
     */
    public function setCampOpenDate($campOpenDate): void
    {
        $this->_campOpenDate = $campOpenDate;
    }

    /**
     * @param mixed $campPhone
     */
    public function setCampPhone($campPhone): void
    {
        $this->_campPhone = $campPhone;
    }

    /**
     * @param mixed $campPool
     */
    public function setCampPool($campPool): void
    {
        $this->_campPool = $campPool;
    }

    /**
     * @param mixed $campStatus
     */
    public function setCampStatus($campStatus): void
    {
        $this->_campStatus = $campStatus;
    }

    /**
     * @param mixed $campToilet
     */
    public function setCampToilet($campToilet): void
    {
        $this->_campToilet = $campToilet;
    }

    /**
     * @param mixed $campWaterSup
     */
    public function setCampWaterSup($campWaterSup): void
    {
        $this->_campWaterSup = $campWaterSup;
    }

    /**
     * @param mixed $campWifi
     */
    public function setCampWifi($campWifi): void
    {
        $this->_campWifi = $campWifi;
    }

    /**
     * @param mixed $campID
     */
    public function setCampID($campID): void
    {
        $this->_campID = $campID;
    }

    /**
     * @return mixed
     */
    public function getMainImage()
    {
        return $this->_mainImage;
    }

    /**
     * @return mixed
     */
    public function getSecondImage()
    {
        return $this->_secondImage;
    }

    /**
     * @return mixed
     */
    public function getCampLat()
    {
        return $this->_campLat;
    }

    /**
     * @return mixed
     */
    public function getCampLong()
    {
        return $this->_campLong;
    }

    /**
     * @param mixed $campLat
     */
    public function setCampLat($campLat): void
    {
        $this->_campLat = $campLat;
    }

    /**
     * @param mixed $campLong
     */
    public function setCampLong($campLong): void
    {
        $this->_campLong = $campLong;
    }

    /**
     * @param mixed $mainImage
     */
    public function setMainImage($mainImage): void
    {
        $this->_mainImage = $mainImage;
    }

    /**
     * @param mixed $secondImage
     */
    public function setSecondImage($secondImage): void
    {
        $this->_secondImage = $secondImage;
    }
}