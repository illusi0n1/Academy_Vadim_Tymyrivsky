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
<a href="?controller=towns&action=search"> Search towns </a>

<form action="" method="post">
    <table>
        <tr>
            <th>Sort towns by</th>
            <th>
                <select name="towns_sort">
                    <option value="towns.id">No sort</option>
                    <option value="towns.name">Name</option>
                    <option value="countries.name">Country</option>
                    <option value="towns.citizens_quantity">Quantity of citizens</option>
                    <option value="persons.name">Mayor</option>
                </select>
            </th>
            <th><input type="submit" name="submit" value="Sort"></th>
        </tr>
    </table>
</form>
<table border="1">
    <tr>
        <th colspan="4"> Towns </th>
    </tr>
    <tr>
        <th>Name</th>
        <th>Country</th>
        <th>Quantity of citizens</th>
        <th>Mayor</th>
    </tr>

    <?php
    if ($_POST["towns_sort"]) {
        $towns_sort = $_POST["towns_sort"];
    }
    else {
        $towns_sort = "towns.id";
    }

    $town = new Towns();
    $arr_towns = $town->display($towns_sort);
    for($i=0;$i<count($arr_towns);$i++) {
        echo "<tr>";
        echo "<th>".$arr_towns[$i]->getName()."</th>";
        echo "<th>".$arr_towns[$i]->getCountry_name()."</th>";
        echo "<th>".$arr_towns[$i]->getCitizens_quantity()."</th>";
        echo "<th>".$arr_towns[$i]->getMayor_name()."</th>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>