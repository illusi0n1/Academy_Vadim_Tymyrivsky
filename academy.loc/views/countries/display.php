<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require ("../models/countries.php");
?>

<a href="?controller=countries&action=add"> Add country </a>

<table border="1">
    <tr>
        <th colspan="5"> Countries </th>
    </tr>

    <?php
    $country = new Countries();
    $arr_countries = $country->display();
    for($i=0;$i<count($arr_countries);$i++) {
        echo "<tr>";
        echo "<th>".$arr_countries[$i]->getName()."</th>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>