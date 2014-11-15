<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require ("../models/companies.php");
require ("../models/planes.php");
?>

<a href="?controller=planes&action=add"> Add plane </a> <br>
<a href="?controller=planes&action=display"> Display planes </a> <br>

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

        $plane = new Planes();
        $arr_planes = $plane->selectUsedPlanes($company);
        if (count($arr_planes)>0) {
            ?>
            <tr>
                <th>Used planes</th>
            </tr>
            <?php
            $arr_check[] = "";
            for($i=0;$i<count($arr_planes);$i++) {
                if (in_array($arr_planes[$i]->getName(),$arr_check) == false) {
                    echo "<tr>";
                    echo "<th>".$arr_planes[$i]->getName()."</th>";
                    echo "</tr>";
                    $arr_check[] = $arr_planes[$i]->getName();
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