<?php
$action = $_GET["action"];

switch($action) {
    case "add":
        include ("../views/flights/add.php");
        break;
    case "all_flights_where":
        include ("../views/flights/all_flights_where.php");
        break;
    case "delete":
        include ("../views/flights/delete.php");
        break;
    case "display":
        include ("../views/flights/display.php");
        break;
    case "search":
        include ("../views/flights/search.php");
        break;
}