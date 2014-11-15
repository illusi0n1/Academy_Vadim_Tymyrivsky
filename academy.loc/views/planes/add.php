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

<a href="?controller=planes&action=display"> Display planes </a> <br>
<a href="?controller=planes&action=select_used_planes"> Display planes which uses given company </a> <br>

<form action="" method="post">
    <table border="1">
        <tr>
            <th colspan="2">New plane</th>
        </tr>
        <tr>
            <th>Name</th>
            <th><input type="text" name="plane_name" size="20"></th>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" name="submit" value="Add plane"></th>
        </tr>
    </table>
</form>

<?php
if ($_POST["plane_name"]) {
    $name = $_POST["plane_name"];

    $plane = new Planes();
    $result = $plane->addPlane($name);
}
?>

</body>
</html>