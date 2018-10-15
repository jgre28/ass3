<html>
<header>
    <?php include("header.php"); ?>
</header>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 10/10/2018
 * Time: 4:03 PM
 */

require_once("DB.php");

$conn= new DB();

if ($conn->checkConn())
{
    require_once("propertyDAO.php");

    $property= new propertyDAO($conn->getConn());

        $where = array();
        $where[] = "suburb = ".$_POST["suburb"];
        $where[] = "propertyType = ".$_POST["propertyType"];
        $where[] = "maxPrice = ".$_POST["maxPrice"];
        ?>
        <div class="container">

        <?php if ($rows = $property->find($where))
        {
            ?>


            <table  class="table table-striped table-bordered">
                <p>Search Results for <?php echo $property->getSearchQuery($where) ?></p>
                <tr>
                    <th>Listing Date</th>
                    <th>Listing Price</th>
                    <th>Property Type</th>
                    <th>Address</th>
                </tr>

                <?php
                for ($i = 0; $i < $rows->rowCount(); $i++)
                {
                    //gets the next row from the result set
                    $currentRow = $rows->getNext(new propertyDAO($conn->getConn()), $i);


                    ?>

                    <tr>
                        <td><?php echo $currentRow->getListingDate()?></td>
                        <td><?php echo $currentRow->getListingPrice()?></td>
                        <td><?php echo $currentRow->getPropertyType()?></td>
                        <td><?php echo $currentRow->getAddress()?></td>
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
            
            echo "No results for ".$property->getSearchQuery($where);
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

