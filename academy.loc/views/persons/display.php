<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require ("../models/persons.php");
?>

<a href="?controller=persons&action=add"> Add person </a>

<table border="1">
    <tr>
        <th colspan="5"> Persons </th>
    </tr>

    <?php
    $person = new Persons();
    $arr_persons = $person->display();
    for($i=0;$i<count($arr_persons);$i++) {
        echo "<tr>";
        echo "<th>".$arr_persons[$i]->getName()."</th>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>