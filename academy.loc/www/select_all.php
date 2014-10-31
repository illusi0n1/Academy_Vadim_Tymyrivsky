<!doctype html>
<html>
<head>
	<meta charset="utf-8" >
	<title> Academy </title>
</head>
<body>
	<?php
		require ("db_conn.php");
	?>	
		<form action="select_all.php" method="post">
		<table>
			<tr>
				<th>Sort company by</th>
				<th>
					<select name="companies_sort">
						<option value="companies.id">No sort</option>
						<option value="companies.name">Name</option>
						<option value="companies.year">Year</option>
						<option value="companies.address">Address</option>
						<option value="towns.name">Town</option>
						<option value="persons.name">President</option>
					</select>
				</th>
				<th><input type="submit" name="submit" value="Sort"></th>
			</tr>
		</table>
		</form>
		<table border="1"> 
			<tr>
				<th colspan="5"> Companies </th>
			</tr>
			<tr>
				<th>Name</th>
				<th>Year of foundatation</th>
				<th>Address</th>
				<th>Town</th>
				<th>President</th>
			</tr>	 

		<?php
			if ($_POST["companies_sort"]) {
				$companies_sort = $_POST["companies_sort"];
			}
			else {
				$companies_sort = "companies.id";
			}
			$result = mysql_query("SELECT companies.name,companies.year,companies.address,towns.name,persons.name 
									FROM companies
									INNER JOIN towns ON companies.town_id = towns.id
									INNER JOIN persons ON companies.president_id = persons.id
									ORDER BY $companies_sort") or die(mysql_error());
		
			while ($myrow = mysql_fetch_array($result)) {
						echo "<tr>";
						for ($i=0; $i < 5; $i++) { 
							echo "<th>".$myrow[$i]."</th>";
						}
						echo "</tr>";
					}
		?>
		</table>

		<form action="select_all.php" method="post">
		<table>
			<tr>
				<th>Sort towns by</th>
				<th>
					<select name="towns_sort">
						<option value="towns.id">No sort</option>
						<option value="towns.name">Name</option>
						<option value="countries.name">Country</option>
						<option value="towns.citizens_quantity">Quantity of citizens</option>
						<option value="persons.name">Mayor</option>
					</select>
				</th>
				<th><input type="submit" name="submit" value="Sort"></th>
			</tr>
		</table>
		</form>
		<table border="1">
			<tr>
				<th colspan="4"> Towns </th>
			</tr>
			<tr>
				<th>Name</th>
				<th>Country</th>
				<th>Quantity of citizens</th>
				<th>Mayor</th>
			</tr>	 

		<?php
			if ($_POST["towns_sort"]) {
				$towns_sort = $_POST["towns_sort"];
			}
			else {
				$towns_sort = "towns.id";
			}
			$result = mysql_query("SELECT towns.name,countries.name,towns.citizens_quantity,persons.name
									FROM towns
									INNER JOIN countries ON towns.country_id = countries.id
									INNER JOIN persons ON towns.mayor_id = persons.id
									ORDER BY $towns_sort") or die(mysql_error());
		
			while ($myrow = mysql_fetch_array($result)) {
						echo "<tr>";
						for ($i=0; $i < 4; $i++) { 
							echo "<th>".$myrow[$i]."</th>";
						}
						echo "</tr>";
					}
		?>
		</table>

		<form action="select_all.php" method="post">
		<table>
			<tr>
				<th>Sort flights by</th>
				<th>
					<select name="flights_sort">
						<option value="flights.id">No sort</option>
						<option value="flights.name">Name</option>
						<option value="companies.name">Company</option>
						<option value="t1.name">Town out</option>
						<option value="t2.name">Town in</option>
						<option value="flights.price">Price</option>
						<option value="flights.flight_time">Flight time</option>
						<option value="planes.name">Plane brand</option>
					</select>
				</th>
				<th><input type="submit" name="submit" value="Sort"></th>
			</tr>
		</table>
		</form>
		<table border="1">
			<tr>
				<th colspan="7"> Flights </th>
			</tr>
			<tr>
				<th>Name</th>
				<th>Company</th>
				<th>Town out</th>
				<th>Town in/th>
				<th>Price</th>
				<th>Flight time</th>
				<th>Plane brand</th>
			</tr>	 

		<?php
			if ($_POST["flights_sort"]) {
				$flights_sort = $_POST["flights_sort"];
			}
			else {
				$flights_sort = "flights.id";
			}
			$result = mysql_query("SELECT flights.name,companies.name,t1.name,t2.name,flights.price,flights.flight_time,planes.name
									FROM flights
									INNER JOIN companies ON flights.company_id = companies.id
									INNER JOIN towns as t1 ON flights.town_id_out = t1.id
									INNER JOIN towns as t2 ON flights.town_id_in = t2.id
									INNER JOIN planes ON flights.plane_id = planes.id
									ORDER BY $flights_sort") or die(mysql_error());
		
			while ($myrow = mysql_fetch_array($result)) {
						echo "<tr>";
						for ($i=0; $i < 7; $i++) { 
							echo "<th>".$myrow[$i]."</th>";
						}
						echo "</tr>";
					}
		?>

		</table>

</body>
</html>	