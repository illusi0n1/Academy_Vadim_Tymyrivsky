<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require ("../models/companies.php");
require ("../models/towns.php");
?>

<a href="?controller=towns&action=add"> Add town </a> <br>
<a href="?controller=towns&action=delete"> Delete town </a> <br>
<a href="?controller=towns&action=display"> Display towns </a> <br>
<a href="?controller=towns&action=search"> Search towns </a>

<form action="" method="post">
    <table border="1">
        <tr>
            <th colspan="2">Input data for searching</th>
        </tr>
        <tr>
            <th>Select company</th>
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
            <th colspan="2"><input type="submit" name="submit" value="Search"></th>
        </tr>
    </table>
</form>
<br>
<br>

<table border="1">

    <?php
    if($_POST["company_id"]) {
        $company = $_POST["company_id"];

        $town = new Towns();
        $arr_towns = $town->cityInWhichCompanyFlies($company);
        if (count($arr_towns)>0) {
            ?>
            <tr>
                <th>City, in which this company flies</th>
            </tr>
            <?php

            $arr_check[] = "";
            for($i=0;$i<count($arr_towns);$i++) {
                if (in_array($arr_towns[0]->getName(),$arr_check) == false) {
                    echo "<tr>";
                    echo "<th>".$arr_towns[$i]->getName()."</th>";
                    echo "</tr>";
                    $arr_check[] = $arr_towns[$i]->getName();
                }
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