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
<a href="?controller=companies&action=search"> Search companies </a>



<form action="" method="post">
    <table>
        <tr>
            <th>Sort company by</th>
            <th>
                <select name="companies_sort">
                    <option value="companies.id">No sort</option>
                    <option value="companies.name">Name</option>
                    <option value="companies.year">Year</option>
                    <option value="companies.address">Address</option>
                    <option value="towns.name">Town</option>
                    <option value="persons.name">President</option>
                </select>
            </th>
            <th><input type="submit" name="submit" value="Sort"></th>
        </tr>
    </table>
</form>
<table border="1">
    <tr>
        <th colspan="5"> Companies </th>
    </tr>
    <tr>
        <th>Name</th>
        <th>Year of foundation</th>
        <th>Address</th>
        <th>Town</th>
        <th>President</th>
    </tr>

    <?php
    if ($_POST["companies_sort"]) {
        $companies_sort = $_POST["companies_sort"];
    }
    else {
        $companies_sort = "companies.id";
    }

    $company = new Companies();
    $arr_companies = $company->display($companies_sort);
    for($i=0;$i<count($arr_companies);$i++) {
        echo "<tr>";
        echo "<th>".$arr_companies[$i]->getName()."</th>";
        echo "<th>".$arr_companies[$i]->getYear()."</th>";
        echo "<th>".$arr_companies[$i]->getAddress()."</th>";
        echo "<th>".$arr_companies[$i]->getTown_name()."</th>";
        echo "<th>".$arr_companies[$i]->getPresident_name()."</th>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>