<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 9/10/2018
 * Time: 11:58 AM
 */


class propertyDAO
{
    public $propertyID;
    public $unitNum;
    public $streetNum;
    public $street;
    public $suburb;
    public $state;
    public $postcode;
    public $sellerID;
    public $listingDate;
    public $listingPrice;
    public $saleDate;
    public $salePrice;
    public $imageName;
    public $description;
    public $propertyType;
    private $_conn;


    //constructor
    function __construct($conn)
    {
        $this->_conn = $conn;
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

    //returns property address in a nice format
    public function getAddress()
    {
        $address= "";

        if (!empty($this->unitNum))
        {
            $address= $address."U".$this->unitNum.", ";
        }
        $address= $address.$this->streetNum." ".$this->street.", ".$this->suburb.", ".$this->state.", ".$this->postcode;
        return $address;
    }


}
?>