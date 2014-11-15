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
<a href="?controller=flights&action=display"> Display flights </a> <br>

<form action="" method="post">
    <table border="1">
        <tr>
            <th colspan="2">Searching</th>
        </tr>
        <tr>
            <th>Input string</th>
            <th><input type="text" name="part_of_name" size="20"></th>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" name="submit" value="Search"></th>
        </tr>
    </table>
</form>

<table border="1">

<?php
if ($_POST["part_of_name"]) {
    $part_of_name = $_POST["part_of_name"];

    $flight = new Flights();
    $arr_flights = $flight->search($part_of_name);
    if (count($arr_flights)>0) {
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
        echo "<th>".$arr_flights[$i]->getName()."</th>";
        echo "<th>".$arr_flights[$i]->getCompany_name()."</th>";
        echo "<th>".$arr_flights[$i]->getTown_out_name()."</th>";
        echo "<th>".$arr_flights[$i]->getTown_in_name()."</th>";
        echo "<th>".$arr_flights[$i]->getPrice()."</th>";
        echo "<th>".$arr_flights[$i]->getFlight_time()."</th>";
        echo "<th>".$arr_flights[$i]->getPlane_name()."</th>";
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