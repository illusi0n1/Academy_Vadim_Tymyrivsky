<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require "../models/countries.php";
?>

<a href="?controller=countries&action=display"> Display countries </a>

<form action="" method="post">
    <table border="1">
        <tr>
            <th colspan="2">New country</th>
        </tr>
        <tr>
            <th>Name</th>
            <th><input type="text" name="country_name" size="20"></th>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" name="submit" value="Add country"></th>
        </tr>
    </table>
</form>

<?php
if ($_POST["country_name"]) {
    $name = $_POST["country_name"];
    if (!preg_match("/^[A-Za-z]+ ?[A-Za-z]+$/", $name)) {
        echo "<tr><th colspan='2'>";
        echo "Name is incorrect";
        echo "</th></tr>";
    }
    else {
        $country = new Countries();
        $name = ucwords(strtolower($name));
        $result = $country->addCountry($name);
    }
}
?>

</body>
</html>