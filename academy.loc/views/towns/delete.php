<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require "../models/towns.php";
?>

<a href="?controller=towns&action=add"> Add town </a> <br>
<a href="?controller=towns&action=city_in_which_company_flies"> City in which given company flies </a> <br>
<a href="?controller=towns&action=display"> Display towns </a> <br>
<a href="?controller=towns&action=search"> Search towns </a>

<form action="" method="post">
    <table border="1">
        <tr>
            <th colspan="2">Delete town</th>
        </tr>
        <tr>
            <th>Select name</th>
            <th>
                <select name="town_id_del">
                    <option selected disabled>None</option>
                    <?php
                    $town = new Towns();
                    $arr_towns = $town->selectIdNameFromTowns();
                    for ($i=0;$i<count($arr_towns);$i++) {
                        echo '<option value="'.$arr_towns[$i]->getId().'">'.$arr_towns[$i]->getName().'</option>';
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
if ($_POST["town_id_del"]) {
    $town_id_del = $_POST["town_id_del"];

    $town = new Towns();
    $result = $town->deleteTown($town_id_del);
}
?>

</body>
</html>