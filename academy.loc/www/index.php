<!doctype html>
<html>
<head>
	<meta charset="utf-8" >
	<title> Academy </title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="header"><center>My academy project</center></div>
<div class="main">
    <div class="menu">
        <ul>
            <li> <a href="index.php?controller=companies&action=display"> Companies </a> </li>
            <li> <a href="index.php?controller=countries&action=display"> Countries </a> </li>
            <li> <a href="index.php?controller=flights&action=display"> Flights </a> </li>
            <li> <a href="index.php?controller=persons&action=display"> Persons </a> </li>
            <li> <a href="index.php?controller=planes&action=display"> Planes </a> </li>
            <li> <a href="index.php?controller=towns&action=display"> Towns </a> </li>
        </ul>
    </div>
    <div class="content">
        <?php
        require ("../config/db_conn.php");
        require ("../models/base.php");

        $controller = $_GET["controller"];

        switch($controller) {
            case "companies":
                include ("../controllers/controllerCompanies.php");
                break;
            case "countries":
                include ("../controllers/controllerCountries.php");
                break;
            case "flights":
                include ("../controllers/controllerFlights.php");
                break;
            case "persons":
                include ("../controllers/controllerPersons.php");
                break;
            case "planes":
                include ("../controllers/controllerPlanes.php");
                break;
            case "towns":
                include ("../controllers/controllerTowns.php");
                break;
        }
        ?>
    </div>
</div>

</body>
</html>