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

    $property->findPropertyByID(1);
    ?>

    <html>
    <header>
        Property Details
    </header>
    <body>
    <table border=1">
        <tr>
            <th>Property ID</th>
            <th>Property Type</th>
            <th>Address</th>
            <th>Seller</th>
            <th>Listing Date</th>
            <th>Listing Price</th>
        </tr>
        <tr>
            <td><?php echo $property->getPropertyID()?></td>
            <td><?php echo $property->getPropertyType()?></td>
            <td><?php echo $property->getAddress()?></td>
            <td><?php echo $property->getSellerID()?></td>
            <td><?php echo $property->getListingDate()?></td>
            <td><?php echo $property->getListingPrice()?></td>
        </tr>
    </table>
    </body>
    </html>

<?php
}
else
    echo "ERROR: ".$conn->getConnErr();
?>