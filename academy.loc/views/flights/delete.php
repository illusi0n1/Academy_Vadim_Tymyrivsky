<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require "../models/flights.php";
?>

<a href="?controller=flights&action=add"> Add flight </a> <br>
<a href="?controller=flights&action=all_flights_where"> Output flights using given data </a> <br>
<a href="?controller=flights&action=display"> Display flights </a> <br>
<a href="?controller=flights&action=search"> Search flights </a> <br>

<form action="" method="post">
    <table border="1">
        <tr>
            <th colspan="2">Delete flight</th>
        </tr>
        <tr>
            <th>Select name</th>
            <th>
                <select name="flight_id_del">
                    <option selected disabled>None</option>
                    <?php
                    $flight = new Flights();
                    $arr_flights = $flight->selectIdNameFromFlights();
                    for($i=0;$i<count($arr_flights);$i++) {
                        echo '<option value="'.$arr_flights[$i]->getId().'">'.$arr_flights[$i]->getName().'</option>';
                    }
                    ?>
                </select>
            </th>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" name="submit" value="Delete"></th>
        </tr>
    </table>
</form>

<?php
if ($_POST["flight_id_del"]) {
    $flight_id_del = $_POST["flight_id_del"];

    $flight = new Flights();
    $result = $flight->deleteFlight($flight_id_del);
}
?>

</body>
</html>
