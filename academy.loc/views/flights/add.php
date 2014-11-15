<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require ("../models/companies.php");
require ("../models/flights.php");
require ("../models/planes.php");
require ("../models/towns.php");
?>

<a href="?controller=flights&action=all_flights_where"> Output flights using given data </a> <br>
<a href="?controller=flights&action=delete"> Delete flight </a> <br>
<a href="?controller=flights&action=display"> Display flights </a> <br>
<a href="?controller=flights&action=search"> Search flights </a> <br>

<form action="" method="post">
    <table border="1">
        <tr>
            <th colspan="2">New flight</th>
        </tr>
        <tr>
            <th>Name</th>
            <th><input type="text" name="flight_name" size="20"></th>
        </tr>
        <tr>
            <th>Company</th>
            <th>
                <select name="company_id">
                    <option disabled selected>Select company</option>
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
            <th>Town out</th>
            <th>
                <select name="town_id_out">
                    <option disabled selected>Select town</option>
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
                    <option disabled selected>Select town</option>
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
            <th>Price</th>
            <th><input type="text" name="price" size="20"></th>
        </tr>
        <tr>
            <th>Flight time</th>
            <th><input type="time" name="flight_time" step="1"></th>
        </tr>
        <tr>
            <th>Plane brand</th>
            <th>
                <select name="plane_id">
                    <option disabled selected>Select brand</option>
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
            <th colspan="2"><input type="submit" name="submit" value="Add flight"></th>
        </tr>

        <?php
        if (($_POST["flight_name"])&&($_POST["company_id"])&&($_POST["town_id_out"])&&($_POST["town_id_in"])&&($_POST["price"])&&($_POST["flight_time"])&&($_POST["plane_id"])) {
            $name = $_POST["flight_name"];
            $company = $_POST["company_id"];
            $town_out = $_POST["town_id_out"];
            $town_in = $_POST["town_id_in"];
            $price = $_POST["price"];
            $time = $_POST["flight_time"];
            $plane = $_POST["plane_id"];
            if (!is_numeric($price)) {
                echo "Price is incorrect";
            }
            elseif (!preg_match("/^[A-Za-z]+ ?[A-Za-z]+-[A-Za-z]+ ?[A-Za-z]+$/", $name)) {
                echo "<tr><th colspan='2'>";
                echo "Name is incorrect";
                echo "</th></tr>";
            }
            elseif ($town_out == $town_in) {
                echo "<tr><th colspan='2'>";
                echo "You chose the same city";
                echo "</th></tr>";
            }
            else {
                $name = ucwords(strtolower($name));
                $flight = new Flights();
                $result = $flight->addFlight($name,$company,$town_out,$town_in,$price,$time,$plane);
            }
        }
        ?>
    </table>
</form>
</body>
</html>