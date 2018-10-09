<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 9/10/2018
 * Time: 11:58 AM
 */


class propertyDAO
{
    private $_propertyID;
    //private $_unitNum;
    //private $_streetNum;
    //private $_street;
    //private $_suburb;
    //private $_state;
    //private $_postcode;
    private $_address;
    private $_sellerID;
    private $_listingDate;
    private $_listingPrice;
    //private $_saleDate;
    //private $_salePrice;
    //private $_imageName;
    //private $_description;
    private $_propertyType;
    private $_conn;


    //constructor
    function __construct($conn)
    {
        $this->_conn = $conn;
    }

    public function findPropertyByID($ID)
    {
        $sql = "SELECT * FROM property WHERE propertyID =".$ID;
        $result = $this->_conn->query($sql);
        $row = $result->fetch_assoc();

        $address= "";
        if (!empty($row["unitNum"])){
            $address= $address."U".$row["unitNum"].", ";
        }
        $address= $address.$row["streetNum"]." ".$row["street"].", ".$row["suburb"].", ".$row["state"].", ".$row["postcode"];

        $this->_propertyID= $row['propertyID'];
        $this->_propertyType= $row['propertyType'];
        $this->_address= $address;
        $this->_sellerID= $row['sellerID'];
        $this->_listingDate= $row['listingDate'];
        $this->_listingPrice= $row['listingPrice'];
    }




}
?>