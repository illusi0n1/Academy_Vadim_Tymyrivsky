<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require ("../models/flights.php");
?>

<a href="?controller=flights&action=add"> Add flight </a> <br>
<a href="?controller=flights&action=all_flights_where"> Output flights using given data </a> <br>
<a href="?controller=flights&action=delete"> Delete flight </a> <br>
<a href="?controller=flights&action=search"> Search flights </a> <br>

<form action="" method="post">
    <table>
        <tr>
            <th>Sort flights by</th>
            <th>
                <select name="flights_sort">
                    <option value="flights.id">No sort</option>
                    <option value="flights.name">Name</option>
                    <option value="companies.name">Company</option>
                    <option value="t1.name">Town out</option>
                    <option value="t2.name">Town in</option>
                    <option value="flights.price">Price</option>
                    <option value="flights.flight_time">Flight time</option>
                    <option value="planes.name">Plane brand</option>
                </select>
            </th>
            <th><input type="submit" name="submit" value="Sort"></th>
        </tr>
    </table>
</form>
<table border="1">
    <tr>
        <th colspan="7"> Flights </th>
    </tr>
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
    if ($_POST["flights_sort"]) {
        $flights_sort = $_POST["flights_sort"];
    }
    else {
        $flights_sort = "flights.id";
    }

    $flight = new Flights();
    $arr_flights = $flight->display($flights_sort);
    for($i=0;$i<count($arr_flights);$i++) {
        echo "<tr>";
        echo "<th>".$arr_flights[$i]->getName()."</th>";
        echo "<th>".$arr_flights[$i]->getCompany_name()."</th>";
        echo "<th>".$arr_flights[$i]->getTown_out_name()."</th>";
        echo "<th>".$arr_flights[$i]->getTown_in_name()."</th>";
        echo "<th>".$arr_flights[$i]->getPrice()."</th>";
        echo "<th>".$arr_flights[$i]->getFlight_time()."</th>";
        echo "<th>".$arr_flights[$i]->getPlane_name()."</th>";
        echo "</tr>";
    }
    ?>

</table>
</body>
</html>