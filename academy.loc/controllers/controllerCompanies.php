<?php
$action = $_GET["action"];

switch($action) {
    case "add":
        include ("../views/companies/add.php");
        break;
    case "delete":
        include ("../views/companies/delete.php");
        break;
    case "display":
        include ("../views/companies/display.php");
        break;
    case "search":
        include ("../views/companies/search.php");
        break;
}