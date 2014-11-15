<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>

<?php
require "../models/countries.php";
require "../models/towns.php";
require "../models/persons.php";
?>

<a href="?controller=towns&action=city_in_which_company_flies"> City in which given company flies </a> <br>
<a href="?controller=towns&action=delete"> Delete town </a> <br>
<a href="?controller=towns&action=display"> Display towns </a> <br>
<a href="?controller=towns&action=search"> Search towns </a>

<form action="" method="post">
    <table border="1">
        <tr>
            <th colspan="2">New town</th>
        </tr>
        <tr>
            <th>Name</th>
            <th><input type="text" name="town_name" size="20"></th>
        </tr>
        <tr>
            <th>Country</th>
            <th>
                <select name="country_id">
                    <option disabled selected>Select country</option>
                    <?php
                    $country = new Countries();
                    $arr_countries = $country->selectIdNameFromCountries();
                    for ($i=0;$i<count($arr_countries);$i++) {
                        echo '<option value="'.$arr_countries[$i]->getId().'">'.$arr_countries[$i]->getName().'</option>';
                    }
                    ?>
                </select>
            </th>
        </tr>
        <tr>
            <th>Quantity of citizens</th>
            <th><input type="text" name="citizens_quantity" size="20"></th>
        </tr>
        <tr>
            <th>Mayor</th>
            <th>
                <select name="mayor_id">
                    <option disabled selected>Select mayor</option>
                    <?php
                    $person = new Persons();
                    $arr_persons = $person->selectIdNameFromPersons();
                    for($i=0;$i<count($arr_persons);$i++) {
                        echo '<option value="'.$arr_persons[$i]->getId().'">'.$arr_persons[$i]->getName().'</option>';
                    }
                    ?>
                </select>
            </th>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" name="submit" value="Add town"></th>
        </tr>

        <?php
        if(($_POST["town_name"])&&($_POST["country_id"])&&($_POST["citizens_quantity"])&&($_POST["mayor_id"])) {
            $name = $_POST["town_name"];
            $country = $_POST["country_id"];
            $citizens = $_POST["citizens_quantity"];
            $mayor = $_POST["mayor_id"];

            if (!preg_match("/^[A-Za-z]+ ?[A-Za-z]+$/", $name)) {
                echo "<tr><th colspan='2'>";
                echo "Name is incorrect";
                echo "</th></tr>";
            }
            elseif (!is_numeric($citizens)) {
                echo "<tr><th colspan='2'>";
                echo "Quantity of citizens is incorrect";
                echo "</th></tr>";
            }
            else{
                $town = new Towns();
                $name = ucwords(strtolower($name));
                $result = $town->addTown($name,$country,$citizens,$mayor);
            }
        }
        ?>
    </table>
</form>
</body>
</html>