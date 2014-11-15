<?php
$action = $_GET["action"];

switch ($action) {
    case "add":
        include ("../views/planes/add.php");
        break;
    case "display":
        include ("../views/planes/display.php");
        break;
    case "select_used_planes":
        include ("../views/planes/select_used_planes.php");
        break;
}