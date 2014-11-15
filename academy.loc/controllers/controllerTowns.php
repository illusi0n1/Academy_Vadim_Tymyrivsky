<?php
$action = $_GET["action"];

switch ($action) {
    case "add":
        include ("../views/towns/add.php");
        break;
    case "city_in_which_company_flies":
        include ("../views/towns/city_in_which_company_flies.php");
        break;
    case "delete":
        include ("../views/towns/delete.php");
        break;
    case "display":
        include ("../views/towns/display.php");
        break;
    case "search":
        include ("../views/towns/search.php");
        break;
}