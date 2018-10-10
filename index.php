<html>
<header>
    <div class="header">
        <h1>RUTHLESS REAL ESTATE</h1>
    </div>

    <div class="sideMenu" >


        <table align="center">
            <tr><td><input type="button" class="button" value="Home"  OnClick="window.location='index.php'"></td></tr>


        </table>

    </div>
</header>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 9/10/2018
 * Time: 12:58 PM
 */

require_once("DB.php");

$conn= new DB();

if ($conn->checkConn())
{
    require_once("propertyDAO.php");

    $property= new propertyDAO($conn->getConn());

    //$property->findPropertyByID(1);

    $where = array();
    $where[] = "suburb = 'Rye'";
    //first it will search for a propertyType ID's matching search and then add those to where
    //if none add an AND false since no property will exist
    $where[] = "propertyType = 1";

    if ($rows = $property->find($where))
    {
    ?>

    <div class="container">
    <table  class="table table-striped table-bordered">
        <tr>
            <th>Property ID</th>
            <th>Property Type</th>
            <th>Address</th>
            <th>Seller</th>
            <th>Listing Date</th>
            <th>Listing Price</th>
        </tr>

        <?php
            for ($i = 0; $i < $rows->rowCount(); $i++)
            {
                //gets the next row from the result set
                $currentRow = $rows->getNext(new propertyDAO($conn->getConn()), $i);


            ?>

                <tr>
                    <td><?php echo $currentRow->propertyID?></td>
                    <td><?php echo $currentRow->propertyType?></td>
                    <td><?php echo $currentRow->getAddress()?></td>
                    <td><?php echo $currentRow->sellerID?></td>
                    <td><?php echo $currentRow->listingDate?></td>
                    <td><?php echo $currentRow->listingPrice?></td>
                </tr>

            <?php
            }
            ?>
        </table>
        <?php
    }
    else
    {
        //if no rows returned
        $whereSearch="";
        $whereSearch =  $whereSearch." WHERE ".implode(" AND ", $where);
        echo "No results ".$whereSearch;
    }
        ?>



    </div>


<?php
}
else
    echo "ERROR: ".$conn->getConnErr();
?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="Ruthless.css">

    </body>
    </html>
