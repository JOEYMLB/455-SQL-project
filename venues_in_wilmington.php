<?php
	require_once('../CSC455_Configs.php'); //Connect to the database
	$query = 'SELECT Name, PerfoTimes, Street, City, Zip
		FROM Venue
		WHERE City LIKE "Wilmington%"
		ORDER BY Name;';
	$result = mysqli_query($dbc, $query);
	//Fetch all rows of result as an associative array
	if($result)
		mysqli_fetch_all($result, MYSQLI_ASSOC); //get the result as an associative, 2-dimensional array
	else { 
		echo "<h2>We are unable to process this request right now.</h2>"; 
		echo "<h3>Please try again later.</h3>";
		exit;
	} 
	mysqli_close($dbc);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Venues In Wilmington</title>
	<meta charset ="utf-8">
	<style> 
        input[type=submit] {
            background-color: #000000; 
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            }

    </style>
</head>
<body>
	<h2 align="center">Venues Located in Wilmington</h2>
	<table width="500" border="1px" cellpadding="0" cellspacing="0" align="center">
		<!--display data into a table-->
		<tr bgcolor="#D3D3D3">
			<th>Name</th>
			<th>PerfoTimes</th>
			<th>Street</th>
			<th>City</th>
			<th>Zip</th>
		</tr>	
		<?php foreach ($result as $client) {
			echo "<tr>";
			echo "<td>".$client['Name']."</td>";
			echo "<td>".$client['PerfoTimes']."</td>";
			echo "<td>".$client['Street']."</td>";
			echo "<td>".$client['City']."</td>";
			echo "<td>".$client['Zip']."</td>";
			echo "</tr>";
		}
		?>
	</table><br>
	<center><label>Query: SELECT Name, PerfoTimes, Street, City, Zip FROM Venue WHERE City LIKE "Wilmington%" ORDER BY Name;</label></center><br>
	<!--button to return to the home page-->
	<form method="get">
	<center><input type="submit" name="Home" value="Return Home"></center>
	</form>
</body>
<?php
if(isset($_GET['Home']))
		header('Location:CSC455_Index.html')
?>   
</html>