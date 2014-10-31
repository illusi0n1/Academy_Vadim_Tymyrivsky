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
	<form action="all_flights_where.php" method="post">
		<table border="1">
			<tr>
				<th colspan="2">Input data For searching</th>
			</tr>
			<tr>
				<th>Town out</th>
				<th>
					<select name="town_id_out">
						<option selected disabled>None</option>
						<?php
							$result=mysql_query("SELECT id,name FROM towns");
							while ($myrow=mysql_fetch_array($result)) {
								echo '<option value="'.$myrow['id'].'">'.$myrow["name"].'</option>';
							}
						?>
					</select>
				</th>
			</tr>
			<tr>
				<th>Town in</th>
				<th>
					<select name="town_id_in">
						<option selected disabled>None</option>
						<?php
							$result=mysql_query("SELECT id,name FROM towns");
							while ($myrow=mysql_fetch_array($result)) {
								echo '<option value="'.$myrow['id'].'">'.$myrow["name"].'</option>';
							}
						?>
					</select>
				</th>
			</tr>	
			<tr>
				<th>Company</th>
				<th>
					<select name="company_id">
						<option selected disabled>None</option>
						<?php
							$result=mysql_query("SELECT id,name FROM companies");
							while ($myrow=mysql_fetch_array($result)) {
								echo '<option value="'.$myrow['id'].'">'.$myrow["name"].'</option>';
							}
						?>
					</select>
				</th>
			</tr>
			<tr>
				<th>Plane brand</th>
				<th>
					<select name="plane_id">
						<option selected disabled>None</option>
						<?php
							$result=mysql_query("SELECT id,name FROM planes");
							while ($myrow=mysql_fetch_array($result)) {
								echo '<option value="'.$myrow['id'].'">'.$myrow["name"].'</option>';
							}
						?>
					</select>
				</th>
			</tr>
			<tr>
				<th colspan="2"><input type="submit" name="submit" value="Search"></th>
			</tr>
		</table>
	</form>	
	<table border="1">

	<?php
		if (($_POST["town_id_out"])&&($_POST["town_id_in"])&&($_POST["company_id"])&&($_POST["plane_id"])) {		
			$town_out = $_POST["town_id_out"];
			$town_in = $_POST["town_id_in"];
			$company = $_POST["company_id"];
			$plane = $_POST["plane_id"];

			$result = mysql_query("SELECT flights.name,companies.name,t1.name,t2.name,flights.price,flights.flight_time,planes.name
									FROM flights
									INNER JOIN companies ON flights.company_id = companies.id
									INNER JOIN towns as t1 ON flights.town_id_out = t1.id
									INNER JOIN towns as t2 ON flights.town_id_in = t2.id
									INNER JOIN planes ON flights.plane_id = planes.id
									WHERE flights.town_id_out = $town_out and flights.town_id_in = $town_in and flights.company_id = $company and flights.plane_id = $plane") or die (mysql_error());
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
	?>
	</table>
</body>
</html>	