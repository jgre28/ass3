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

    //returns a specific property by ID
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

    //finds a property based on multiple criteria
    public function find($where)
    {
        $sql = "SELECT * FROM property";
        if (count($where) > 0)
        {
            $sql = $sql." WHERE ".implode(" AND ",$where);

            $result = $this->_conn->query($sql);
            if ($result->num_rows > 0)
            {
                $allRows = $result->fetch_all(MYSQLI_ASSOC);
                include_once("resultSet.php");
                return new ResultSet($allRows);
            }
            else
            {
                //no rows found
                return false;
            }
        }
        else
        {
            //where array empty
            return false;
        }
    }


    public function getPropertyID()
    {
        return $this->_propertyID;
    }

    public function getPropertyType()
    {
        return $this->_propertyType;
    }

    public function getAddress()
    {
        return $this->_address;
    }

    public function getSellerID()
    {
        return $this->_sellerID;
    }

    public function getListingDate()
    {
        return $this->_listingDate;
    }

    public function getListingPrice()
    {
        return $this->_listingPrice;
    }



}
?>