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
            $conditions = array();
            foreach ($where as $condition)
            {
                $condition = explode("=",$condition,2);
                if(trim($condition[1]) != '')
                {
                    if (trim($condition[0]) == "suburb")
                    {
                        //adds the suburb condition to the query
                        $conditions[] = "suburb LIKE '" . trim($condition[1]) . "%'";
                    }
                    else if (trim($condition[0]) == "propertyType")
                    {
                        //select property types ids
                        $propTypeSql = "SELECT typeID FROM type WHERE typeName LIKE '" . trim($condition[1]) . "%'";
                        $propTypeResult = $this->_conn->query($propTypeSql);

                        if ($propTypeResult->num_rows > 0)
                        {
                            $propTypeArray = array();
                            //adds each matching type to the query
                            while ($row = mysqli_fetch_array($propTypeResult))
                            {
                                $propTypeArray[] = "propertyType=" . $row[0];
                            }
                            $conditions[] = "(" . implode(" OR ", $propTypeArray) . ")";
                        }
                        else
                        {
                            //property type doesn't exist so overall search must return nothing
                            $conditions[] = "FALSE";
                        }
                    }
                    else if (trim($condition[0]) == "maxPrice")
                    {
                        //adds the maximum listing price condition to the query
                        $conditions[] = "listingPrice <= " . trim($condition[1]);
                    }
                }
            }


            echo $sql = $sql." WHERE ".implode(" AND ",$conditions)." ORDER BY listingDate";

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

    public function getPropertyType()
    {
        $sql = "SELECT typeName FROM type WHERE typeID = ".$this->propertyType;
        $result = $this->_conn->query($sql);
        $typeName = $result->fetch_array();
        return $typeName[0];
    }

    public function getListingDate()
    {
        return date("d/m/Y",strtotime($this->listingDate));
    }

    public function getListingPrice()
    {
        return "$".number_format($this->listingPrice,2);
    }

    public function getSearchQuery($where)
    {
        if (count($where) > 0)
        {
            $query = array();
            foreach ($where as $condition)
            {
                $condition = explode("=",$condition,2);
                if(trim($condition[1]) != '')
                {
                    if (trim($condition[0]) == "suburb")
                    {
                        //adds the suburb condition to the query
                        $query[] = "Suburb LIKE '" . trim($condition[1]) . "'";
                    }
                    else if (trim($condition[0]) == "propertyType")
                    {
                        //adds the property type condition to the query
                        $query[] = "Property Types LIKE '".trim($condition[1]) . "'";

                    }
                    else if (trim($condition[0]) == "maxPrice")
                    {
                        //adds the listing price condition to the query
                        $query[] = "Listing Price LESS THAN $" . number_format(trim($condition[1]),2);
                    }
                }
            }
            $query = implode(" AND ", $query);
            return $query;
        }
        else
        {
            //where array empty
            return false;
        }


    }


}
?>