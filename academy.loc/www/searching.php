<!doctype html>
<html>
<head>
	<meta charset="utf-8" >
	<title> Academy </title>
</head>
<body>
	<form action="searching.php" method="post">
		<table border="1">
			<tr>
				<th colspan="2">Searching</th>
			</tr>
			<tr>
				<th>Input string</th>
				<th><input type="text" name="part_of_name" size="20"></th>
			</tr>
			<tr>
				<th>Select table</th>
				<th>
					<select name="table">
						<option disabled selected>None</option>
						<option value="flights">Flights</option>
						<option value="companies">Companies</option>
						<option value="towns">Towns</option>
					</select>
				</th>
				<tr>
				<th colspan="2"><input type="submit" name="submit" value="Search"></th>
			</tr>
			</tr>
		</table>
	</form>
	<table border="1">
	<?php
		require ("db_conn.php");

		if (($_POST["part_of_name"])&&($_POST["table"])) {
			$part_of_name = $_POST["part_of_name"];
			$table = $_POST["table"];

			if ($table == "companies") {
				$result = mysql_query("SELECT companies.name,companies.year,companies.address,towns.name,persons.name
										FROM companies 
										INNER JOIN towns ON companies.town_id = towns.id
										INNER JOIN persons ON companies.president_id = persons.id
										WHERE locate(lower('$part_of_name'),lower(companies.name))>0") or die(mysql_error());
				if (mysql_num_rows($result) != 0) {
					?>
					<tr>
						<th>Name</th>
						<th>Year of foundatation</th>
						<th>Address</th>
						<th>Town</th>
						<th>President</th>
					</tr>
					<?php

					while ($myrow = mysql_fetch_array($result)) {
						echo "<tr>";
						for ($i=0; $i < 5; $i++) { 
							echo "<th>".$myrow[$i]."</th>";
						}
					echo "</tr>";
					}
				}
				else {
					echo "No search results";
				}			
			}
			if ($table == "flights") {
				$result = mysql_query("SELECT flights.name,companies.name,t1.name,t2.name,flights.price,flights.flight_time,planes.name 
										FROM flights
										INNER JOIN companies ON flights.company_id = companies.id
										INNER JOIN towns as t1 ON flights.town_id_out = t1.id
										INNER JOIN towns as t2 ON flights.town_id_in = t2.id
										INNER JOIN planes ON flights.plane_id = planes.id
										WHERE locate(lower('$part_of_name'),lower(flights.name))>0") or die(mysql_error());
				if (mysql_num_rows($result) != 0) {
					?>
					<tr>
						<th>Name</th>
						<th>Company</th>
						<th>Town out</th>
						<th>Town in</th>
						<th>Price</th>
						<th>Flight time</th>
						<th>Plane brand</th>
					</tr>	 
					<?php

					while ($myrow = mysql_fetch_array($result)) {
						echo "<tr>";
						for ($i=0; $i < 7; $i++) { 
							echo "<th>".$myrow[$i]."</th>";
						}
					echo "</tr>";
					}
				}
				else {
					echo "No search results";
				}		
			}		
			if ($table == "towns") {
				$result = mysql_query("SELECT towns.name,countries.name,towns.citizens_quantity,persons.name 
										FROM towns 
										INNER JOIN countries ON towns.country_id = countries.id
										INNER JOIN persons ON towns.mayor_id = persons.id
										WHERE locate(lower('$part_of_name'),lower(towns.name))>0") or die(mysql_error());
				if (mysql_num_rows($result) != 0) {
					?>
					<tr>
						<th>Name</th>
						<th>Country</th>
						<th>Quantity of citizens</th>
						<th>Mayor</th>
					</tr>	
					<?php

					while ($myrow = mysql_fetch_array($result)) {
						echo "<tr>";
						for ($i=0; $i < 4; $i++) { 
							echo "<th>".$myrow[$i]."</th>";
						}
					echo "</tr>";
					}
				}
				else {
					echo "No search results";
				}	
			}
		}

	?>
	
	</table>	




</body>
</html>