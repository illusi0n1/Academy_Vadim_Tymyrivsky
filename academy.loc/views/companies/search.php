<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>

<?php
require ("../models/companies.php");
?>

<a href="?controller=companies&action=add"> Add company </a><br>
<a href="?controller=companies&action=delete"> Delete company </a><br>
<a href="?controller=companies&action=display"> Display companies </a>

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

    $company = new Companies();
    $arr_companies = $company->search($part_of_name);
    if (count($arr_companies)>0) {
    ?>
    <tr>
        <th>Name</th>
        <th>Year of foundation</th>
        <th>Address</th>
        <th>Town</th>
        <th>President</th>
    </tr>
    <?php

    for($i=0;$i<count($arr_companies);$i++) {
        echo "<tr>";
        echo "<th>".$arr_companies[$i]->getName()."</th>";
        echo "<th>".$arr_companies[$i]->getYear()."</th>";
        echo "<th>".$arr_companies[$i]->getAddress()."</th>";
        echo "<th>".$arr_companies[$i]->getTown_name()."</th>";
        echo "<th>".$arr_companies[$i]->getPresident_name()."</th>";
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