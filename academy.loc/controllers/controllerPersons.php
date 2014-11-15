<?php
$action = $_GET["action"];

switch($action) {
    case "add":
        include ("../views/persons/add.php");
        break;
    case "display":
        include ("../views/persons/display.php");
        break;
}