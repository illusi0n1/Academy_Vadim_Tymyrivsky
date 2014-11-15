<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>

<?php
require ("../models/towns.php");
?>

<a href="?controller=towns&action=add"> Add town </a> <br>
<a href="?controller=towns&action=city_in_which_company_flies"> City in which given company flies </a> <br>
<a href="?controller=towns&action=delete"> Delete town </a> <br>
<a href="?controller=towns&action=display"> Display towns </a> <br>

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

    $town = new Towns();
    $arr_towns = $town->search($part_of_name);
    if (count($arr_towns)>0) {
?>
    <tr>
        <th>Name</th>
        <th>Country</th>
        <th>Quantity of citizens</th>
        <th>Mayor</th>
    </tr>
<?php

for($i=0;$i<count($arr_towns);$i++) {
    echo "<tr>";
    echo "<th>".$arr_towns[$i]->getName()."</th>";
    echo "<th>".$arr_towns[$i]->getCountry_name()."</th>";
    echo "<th>".$arr_towns[$i]->getCitizens_quantity()."</th>";
    echo "<th>".$arr_towns[$i]->getMayor_name()."</th>";
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