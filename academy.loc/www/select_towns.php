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
	<form action="select_towns.php" method="post">
		<table border="1">
			<tr>
				<th colspan="2">Input data for searching</th>
			</tr>
			<tr>
				<th>Select company</th>
				<th>
					<select name="company_id">
						<option selected disabled>None</option>
						<?php
							$result = mysql_query("SELECT id,name FROM companies");
							while ($myrow = mysql_fetch_array($result)) {
								echo '<option value="'.$myrow["id"].'">'.$myrow["name"].'</option>';
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
	<br>
	<br>

	<table border="1">

	<?php
		if($_POST["company_id"]) {		
			$company = $_POST["company_id"];
			$result = mysql_query("SELECT towns.name FROM towns,flights WHERE flights.company_id = $company and flights.town_id_in = towns.id") or die (mysql_error());
			if (mysql_num_rows($result)!=0) {
				?>
				<tr>
					<th>City, in which this company flies</th>
				</tr>
				<?php
			
				$arr_check[] = "";
				while ($myrow = mysql_fetch_array($result)) {
					if (in_array($myrow[0],$arr_check) == false) {
						echo "<tr>";
						echo "<th>".$myrow[0]."</th>";
						echo "</tr>";
						$arr_check[] = $myrow[0];
					}
				}
			}
			else {
				echo "No search results";
			}
		}
	?>

	</table>
</body>
</head>			