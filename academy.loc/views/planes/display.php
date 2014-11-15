<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require ("../models/planes.php");
?>

<a href="?controller=planes&action=add"> Add plane </a> <br>
<a href="?controller=planes&action=select_used_planes"> Display planes which uses given company </a> <br>

<table border="1">
    <tr>
        <th colspan="5"> Planes </th>
    </tr>

    <?php
    $plane = new Planes();
    $arr_planes = $plane->display();
    for($i=0;$i<count($arr_planes);$i++) {
        echo "<tr>";
        echo "<th>".$arr_planes[$i]->getName()."</th>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>