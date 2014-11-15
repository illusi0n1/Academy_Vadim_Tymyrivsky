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

<a href="?controller=persons&action=display"> Display persons </a>

<form action="" method="post">
    <table border="1">
        <tr>
            <th colspan="2">New person</th>
        </tr>
        <tr>
            <th>Name</th>
            <th><input type="text" name="person_name" size="20"></th>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" name="submit" value="Add person"></th>
        </tr>
    </table>
</form>

<?php
if ($_POST["person_name"]) {
    $name = $_POST["person_name"];

    $person = new Persons();
    $result = $person->addPerson($name);
}
?>

</body>
</html>