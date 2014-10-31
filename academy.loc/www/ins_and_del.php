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
		<center>
		<table>
			<tr>
			<th>
				<form action="ins_and_del.php" method="post">
				<table border="1"> 
				<tr>
					<th colspan="2">New flight</th>	
				</tr>	
				<tr>
					<th>Name</th>
					<th><input type="text" name="flight_name" size="20"></th>
				</tr>
				<tr>
					<th>Company</th>
					<th>
						<select name="company_id">
							<option disabled selected>Select company</option>
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
					<th>Town out</th>
						<th>
						<select name="town_id_out">
							<option disabled selected>Select town</option>
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
							<option disabled selected>Select town</option>
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
					<th>Price</th>
					<th><input type="text" name="price" size="20"></th>
				</tr>
				<tr>
					<th>Flight time</th>
					<th><input type="time" name="flight_time" step="1"></th>
				</tr>
				<tr>
					<th>Plane brand</th>
						<th>
						<select name="plane_id">
							<option disabled selected>Select brand</option>
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
					<th colspan="2"><input type="submit" name="submit" value="Add flight"></th>	
				</tr>
				
			
			
			<?php
				if (($_POST["flight_name"])&&($_POST["company_id"])&&($_POST["town_id_out"])&&($_POST["town_id_in"])&&($_POST["price"])&&($_POST["flight_time"])&&($_POST["plane_id"])) {
					$name = $_POST["flight_name"];
					$company = $_POST["company_id"];
					$town_out = $_POST["town_id_out"];
					$town_in = $_POST["town_id_in"];
					$price = $_POST["price"];
					$time = $_POST["flight_time"];
					$plane = $_POST["plane_id"];
					if (!is_numeric($price)) {
						echo "Price is incorrect";
					}
					elseif (!preg_match("/^[A-Za-z]+ ?[A-Za-z]+-[A-Za-z]+ ?[A-Za-z]+$/", $name)) {
						echo "<tr><th colspan='2'>";
						echo "Name is incorrect";
						echo "</th></tr>";	
					}
					elseif ($town_out == $town_in) {
						echo "<tr><th colspan='2'>";
						echo "You chose the same city";
						echo "</th></tr>";
					}
					else {
						$name = ucwords(strtolower($name));
						$result = mysql_query("INSERT INTO flights (name,company_id,town_id_out,town_id_in,price,flight_time,plane_id)
												VALUES ('$name','$company','$town_out','$town_in','$price','$time','$plane')");
					}					
				}
			?>
			</table>	 
			</form>
			</th>

			<th>
				<form action="ins_and_del.php" method="post">
				<table border="1">
				<tr>
					<th colspan="2">New town</th>	
				</tr>	
				<tr>
					<th>Name</th>
					<th><input type="text" name="town_name" size="20"></th>
				</tr>
				<tr>
					<th>Country</th>
					<th>
						<select name="country_id">
							<option disabled selected>Select country</option>
							<?php
								$result=mysql_query("SELECT id,name FROM countries");
								while ($myrow=mysql_fetch_array($result)) {
									echo '<option value="'.$myrow['id'].'">'.$myrow["name"].'</option>';
								}
							?>
						</select>
					</th>
				</tr>	
				<tr>
					<th>Quantity of citizens</th>
					<th><input type="text" name="citizens_quantity" size="20"></th>
				</tr>
				<tr>
					<th>Mayor</th>
						<th>
						<select name="mayor_id">
							<option disabled selected>Select mayor</option>
							<?php
								$result=mysql_query("SELECT persons.id,persons.name 
													FROM persons 
													WHERE persons.id not in (SELECT towns.mayor_id FROM towns)");
								while ($myrow=mysql_fetch_array($result)) {
									echo '<option value="'.$myrow['id'].'">'.$myrow["name"].'</option>';
								}
							?>
						</select>
					</th>
				</tr>
				<tr>
					<th colspan="2"><input type="submit" name="submit" value="Add town"></th>	
				</tr>
				

			<?php
				if(($_POST["town_name"])&&($_POST["country_id"])&&($_POST["citizens_quantity"])&&($_POST["mayor_id"])) {
					$name = $_POST["town_name"];
					$country = $_POST["country_id"];
					$citizens = $_POST["citizens_quantity"];
					$mayor = $_POST["mayor_id"];

					if (!preg_match("/^[A-Za-z]+ ?[A-Za-z]+$/", $name)) {
						echo "<tr><th colspan='2'>";
						echo "Name is incorrect";
						echo "</th></tr>";	
					}
					elseif (!is_numeric($citizens)) {
						echo "<tr><th colspan='2'>";
						echo "Quantity of citizens is incorrect";
						echo "</th></tr>";
					}
					else{
						$name = ucwords(strtolower($name));
						$result = mysql_query("INSERT INTO towns (name,country_id,citizens_quantity,mayor_id) 
												VALUES ('$name','$country','$citizens','$mayor')");
					}				
				}
			?>
			</table>	 
			</form>
			</th>

			<th>
				<form action="ins_and_del.php" method="post">
				<table border="1"> 
				<tr>
					<th colspan="2">New company</th>	
				</tr>	
				<tr>
					<th>Name</th>
					<th><input type="text" name="company_name" size="20"></th>
				</tr>
				<tr>
					<th>Year of foundatation</th>
					<th><input type="date" name="year"></th>
				</tr>	
				<tr>
					<th>Address</th>
					<th><input type="text" name="address" size="20"></th>
				</tr>
				<tr>
					<th>Town</th>
						<th>
						<select name="town_id">
							<option disabled selected>Select town</option>
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
					<th>President</th>
						<th>
						<select name="president_id">
							<option disabled selected>Select president</option>
							<?php
								$result=mysql_query("SELECT id,name FROM persons");
								while ($myrow=mysql_fetch_array($result)) {
									echo '<option value="'.$myrow['id'].'">'.$myrow["name"].'</option>';
								}
							?>
						</select>
					</th>
				</tr>
				<tr>
					<th colspan="2"><input type="submit" name="submit" value="Add company"></th>	
				</tr>	
				</table> 
				</form>
			</th>
			</tr>

			<?php
				if(($_POST["company_name"])&&($_POST["year"])&&($_POST["address"])&&($_POST["town_id"])&&($_POST["president_id"])) {
					$name = $_POST["company_name"];
					$year = $_POST["year"];
					$address = $_POST["address"];
					$town = $_POST["town_id"];
					$president = $_POST["president_id"];
				
					$result = mysql_query("INSERT INTO companies (name,year,address,town_id,president_id) VALUES ('$name','$year','$address','$town','$president')");
				}
			?>

			<tr>
			<th>
				<form action="ins_and_del.php" method="post"> 
				<table border="1">
				<tr>
					<th colspan="2">New country</th>	
				</tr>	
				<tr>
					<th>Name</th>
					<th><input type="text" name="country_name" size="20"></th>
				</tr>
				<tr>
					<th colspan="2"><input type="submit" name="submit" value="Add country"></th>	
				</tr>	
				</table> 
				</form>
			</th>	

			<?php
				if ($_POST["country_name"]) {
					$name = $_POST["country_name"];
					if (!preg_match("/^[A-Za-z]+ ?[A-Za-z]+$/", $name)) {
						echo "<tr><th colspan='2'>";
						echo "Name is incorrect";
						echo "</th></tr>";	
					}
					else {
						$name = ucwords(strtolower($name));
						$result = mysql_query("INSERT INTO countries (name) VALUES ('$name')");
					}	
				}
			?>

			<th>
				<form action="ins_and_del.php" method="post"> 
				<table border="1">
				<tr>
					<th colspan="2">New person</th>	
				</tr>
				<tr>
					<th>Name</th>
					<th><input type="text" name="person_name" size="20"></th>
				</tr>
				<tr>
					<th colspan="2"><input type="submit" name="submit" value="Add person"></th>	
				</tr>	
				</table> 
				</form>
			</th>	
			
			<?php
				if ($_POST["person_name"]) {
					$name = $_POST["person_name"];
					
					$result = mysql_query("INSERT INTO persons (name) VALUES ('$name')");
				}
			?>

			<th>
				<form action="ins_and_del.php" method="post"> 
				<table border="1">
				<tr>
					<th colspan="2">New plane</th>	
				</tr>		
				<tr>
					<th>Name</th>
					<th><input type="text" name="plane_name" size="20"></th>
				</tr>
				<tr>
					<th colspan="2"><input type="submit" name="submit" value="Add plane"></th>	
				</tr>	
				</table> 
				</form>
			</th>	

			<?php
				if ($_POST["plane_name"]) {
					$name = $_POST["plane_name"];

					$result = mysql_query("INSERT INTO planes (name) VALUES ('$name')");
				}
			?>

			</tr>

			<tr>
			<th>
				<form action="ins_and_del.php" method="post"> 
				<table border="1">
				<tr>
					<th colspan="2">Delete flight</th>	
				</tr>		
				<tr>
					<th>Select name</th>
					<th>
					<select name="flight_id_del">
						<option selected disabled>None</option>
						<?php
							$result = mysql_query("SELECT id,name FROM flights");
							while ($myrow = mysql_fetch_array($result)) {
								echo '<option value="'.$myrow["id"].'">'.$myrow["name"].'</option>';
							}
						?>
					</select>
				</th>
				</tr>
				<tr>
					<th colspan="2"><input type="submit" name="submit" value="Delete"></th>	
				</tr>	
				</table> 
				</form>
			</th>	
				
				<?php
					if ($_POST["flight_id_del"]) {
						$flight_id_del = $_POST["flight_id_del"];
						$result = mysql_query("DELETE FROM flights WHERE flights.id = $flight_id_del") or die(mysql_error());
					}
				?>

			<th>
				<form action="ins_and_del.php" method="post"> 
				<table border="1">
				<tr>
					<th colspan="2">Delete town</th>	
				</tr>		
				<tr>
					<th>Select name</th>
					<th>
					<select name="town_id_del">
						<option selected disabled>None</option>
						<?php
							$result = mysql_query("SELECT id,name FROM towns");
							while ($myrow = mysql_fetch_array($result)) {
								echo '<option value="'.$myrow["id"].'">'.$myrow["name"].'</option>';
							}
						?>
					</select>
				</th>
				</tr>
				<tr>
					<th colspan="2"><input type="submit" name="submit" value="Delete"></th>	
				</tr>	
				</table> 
				</form>
			</th>	
				
				<?php
					if ($_POST["town_id_del"]) {
						$town_id_del = $_POST["town_id_del"];
						$result = mysql_query("DELETE FROM towns WHERE towns.id = $town_id_del") or die(mysql_error());
					}
				?>

			<th>
				<form action="ins_and_del.php" method="post"> 
				<table border="1">
				<tr>
					<th colspan="2">Delete company</th>	
				</tr>		
				<tr>
					<th>Select name</th>
					<th>
					<select name="company_id_del">
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
					<th colspan="2"><input type="submit" name="submit" value="Delete"></th>	
				</tr>	
				</table> 
				</form>
			</th>	
				
				<?php
					if ($_POST["company_id_del"]) {
						$company_id_del = $_POST["company_id_del"];
						$result = mysql_query("DELETE FROM companies WHERE companies.id = $company_id_del") or die(mysql_error());
					}
				?>	
			</tr>
		</table>
		</center>


</body>
</html>