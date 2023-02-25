<?php

	require_once('../CSC455_Configs.php'); //Connect to the database
	$query = "CALL showpromo()";

	$result = mysqli_query($dbc, $query); //gets the query data

	if($result)
		mysqli_fetch_all($result, MYSQLI_ASSOC);
	else {
		echo "<h2> we are unable to process this request right now. </h2>";
		echo "<h3> Please try again later.</h3>";
		exit;
		
	}
	mysqli_close($dbc);
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!--By: Joey Mills-->
	<title> Showpromo </title>
	<meta charset = "utf-8">
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
	<center><h2> Artist Promoters </h2></center>
	<!--Displays the data into a table-->
	<table width="500" border="1px" cellpadding="0" cellspacing="0" align="center">
		<tr bgcolor="#D3D3D3">
			<th>PhoneNumber</th>
			<th>ArtistFN</th>
			<th>ArtistLN</th>
			<th>PromFn and PromLN</th>
			<th>years_working</th>
		</tr>
		<?php foreach ($result as $client) {
			echo "<tr>";
			echo "<td>" .$client['PhoneNumber']."</td>";
			echo "<td>" .$client['ArtistFN']."</td>";
			echo "<td>" .$client['ArtistLN']."</td>";
			echo "<td>" .$client['PromFN']." ".$client['PromLN']." </td>";
			echo "<td>" .$client['years_working']. "</td>";
			echo "</tr>";
		}
		?>
	<!--The button to go back to the home page-->
	</table><br>
	<center><label>Query: CALL showpromo()</label></center><br>
	<form method="get">
	<center><input type="submit" name="Home" value="Return Home"></center>
	</form>
</body>
<?php
if(isset($_GET['Home']))
		header('Location:CSC455_Index.html');
?>
</html>
	
	
