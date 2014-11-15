<?php
$action = $_GET["action"];

switch($action) {
    case "add":
        include ("../views/countries/add.php");
        break;
    case "display":
        include ("../views/countries/display.php");
        break;
}