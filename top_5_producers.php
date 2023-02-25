<?php
	require_once('../CSC455_Configs.php'); //Connect to the database
	$query = 'SELECT ProID, TickSold, CONCAT(PromFN, " ", PromLN) AS Name
		FROM Promoter
		WHERE Promoter.TickSold > 0
		ORDER BY TickSold DESC
		LIMIT 5';
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
    <title>Top 5 Producers</title>
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
	<h2 align="center">Top 5 Producers Based on # of Tickes Sold</h2>
	<table width="500" border="1px" cellpadding="0" cellspacing="0" align="center">
		<!--display data into a table -->
		<tr bgcolor="#D3D3D3">
			<th>ProID</th>
			<th>TickSold</th>
			<th>Name</th>
		</tr>	
		<?php foreach ($result as $client) {
			echo "<tr>";
			echo "<td>".$client['ProID']."</td>";
			echo "<td>".$client['TickSold']."</td>";
			echo "<td>".$client['Name']."</td>";
			echo "</tr>";
		}
		?>
	</table><br>
	<center><label>Query: SELECT ProID, TickSold, CONCAT(PromFN, " ", PromLN) AS Name FROM Promoter WHERE Promoter.TickSold > 0 ORDER BY TickSold DESC LIMIT 5</label></center><br>
	<!--button to go back to home page-->
	<form method="get">
	<center><input type="submit" name="Home" value="Return Home"></center>
	</form>
</body>
<?php
if(isset($_GET['Home']))
		header('Location:CSC455_Index.html')
?>   
</html>