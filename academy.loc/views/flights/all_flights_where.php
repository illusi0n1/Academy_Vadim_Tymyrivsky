<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require ("../models/towns.php");
require ("../models/companies.php");
require ("../models/planes.php");
require ("../models/flights.php");
?>

<a href="?controller=flights&action=add"> Add flight </a> <br>
<a href="?controller=flights&action=delete"> Delete flight </a> <br>
<a href="?controller=flights&action=display"> Display flights </a> <br>
<a href="?controller=flights&action=search"> Search flights </a> <br>

<form action="" method="post">
    <table border="1">
        <tr>
            <th colspan="2">Input data For searching</th>
        </tr>
        <tr>
            <th>Town out</th>
            <th>
                <select name="town_id_out">
                    <option selected disabled>None</option>
                    <?php
                    $town = new Towns();
                    $arr_towns = $town->selectIdNameFromTowns();
                    for ($i=0;$i<count($arr_towns);$i++) {
                        echo '<option value="'.$arr_towns[$i]->getId().'">'.$arr_towns[$i]->getName().'</option>';
                    }
                    ?>
                </select>
            </th>
        </tr>
        <tr>
            <th>Town in</th>
            <th>
                <select name="town_id_in">
                    <option selected disabled>None</option>
                    <?php
                    $town = new Towns();
                    $arr_towns = $town->selectIdNameFromTowns();
                    for ($i=0;$i<count($arr_towns);$i++) {
                        echo '<option value="'.$arr_towns[$i]->getId().'">'.$arr_towns[$i]->getName().'</option>';
                    }
                    ?>
                </select>
            </th>
        </tr>
        <tr>
            <th>Company</th>
            <th>
                <select name="company_id">
                    <option selected disabled>None</option>
                    <?php
                    $company = new Companies();
                    $arr_companies = $company->selectIdNameFromCompanies();
                    for($i=0;$i<count($arr_companies);$i++) {
                        echo '<option value="'.$arr_companies[$i]->getId().'">'.$arr_companies[$i]->getName().'</option>';
                    }
                    ?>
                </select>
            </th>
        </tr>
        <tr>
            <th>Plane brand</th>
            <th>
                <select name="plane_id">
                    <option selected disabled>None</option>
                    <?php
                    $plane = new Planes();
                    $arr_planes = $plane->selectIdNameFromPlanes();
                    for($i=0;$i<count($arr_planes);$i++) {
                        echo '<option value="'.$arr_planes[$i]->getId().'">'.$arr_planes[$i]->getName().'</option>';
                    }
                    ?>
                </select>
            </th>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" name="submit" value="Search"></th>
        </tr>
    </table>
</form>
<table border="1">

    <?php
    if (($_POST["town_id_out"])&&($_POST["town_id_in"])&&($_POST["company_id"])&&($_POST["plane_id"])) {
        $town_out = $_POST["town_id_out"];
        $town_in = $_POST["town_id_in"];
        $company = $_POST["company_id"];
        $plane_id = $_POST["plane_id"];

        if($town_out==$town_in) {
            echo "You chose the same city";
            exit;
        }

        $flight = new Flights();
        $arr_flights = $flight->allFlightWhere($town_out,$town_in,$company,$plane_id);
        if (count($arr_flights) > 0) {
            ?>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Town out</th>
                <th>Town in</th>
                <th>Price</th>
                <th>Flight time</th>
                <th>Plane brand</th>
            </tr>
            <?php
            for($i=0;$i<count($arr_flights);$i++) {
                echo "<tr>";
                echo "<th>" .$arr_flights[$i]->getName()."</th>";
                echo "<th>" .$arr_flights[$i]->getCompany_name()."</th>";
                echo "<th>" .$arr_flights[$i]->getTown_out_name()."</th>";
                echo "<th>" .$arr_flights[$i]->getTown_in_name()."</th>";
                echo "<th>" .$arr_flights[$i]->getPrice()."</th>";
                echo "<th>" .$arr_flights[$i]->getFlight_time()."</th>";
                echo "<th>" .$arr_flights[$i]->getPlane_name()."</th>";
                echo "</tr>";
            }
        }
        else {
            echo "No search results";
        }
    }
    ?>
</table>
</body>
</html>