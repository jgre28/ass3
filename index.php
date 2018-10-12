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

    ?>
<script>
    function validateForm() {

        if (document.forms["search"]["suburb"].value == "" &&
            document.forms["search"]["propertyType"].value == "" &&
            document.forms["search"]["maxPrice"].value == "") {
            alert("At Least one field must be filled.");
            return false;
        }
    }
</script>

    <div class="container">
    <h2>Property Search</h2>
        <form name="search" method="post" action="displayResults.php" onsubmit="return validateForm()">
        <table class="form" cellpadding="5">
           <tr>
                <th>Suburb:</th>
                <td><input type="text" name="suburb" size="28"></td>

            </tr>
            <tr>
                <th>Property Type:</th>
                <td><input type="text" name="propertyType" size="28"></td>
            </tr>
            <tr>
                <th>Max. Listing Price:</th>
                <td><input type="number" name="maxPrice" size="28"></td>
            </tr>
            <tr>
                <td align="right" colspan="2"><input type="submit" class="submitButton" value="Search"><input type="reset" class="resetButton" value="Reset Search"></td>
            </tr>
        </table>

    </form>
    </div>

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
