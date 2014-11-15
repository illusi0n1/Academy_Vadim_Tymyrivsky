<?php
$db_host = "localhost";
$db_user = "vadim";
$db_pass = "0146";
$db = mysql_connect($db_host,$db_user,$db_pass);
mysql_select_db("flights",$db);
?>