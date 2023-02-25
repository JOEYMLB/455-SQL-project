<?php
require_once('../CSC455_Configs.php'); // connect to the database
$query = "SELECT GuestFN, GuestLN FROM Guest";
// the query to get the names of the Guest for the table
$result = mysqli_query($dbc, $query);
// gets the data from the query
if($result){
    mysqli_fetch_all($result, MYSQLI_ASSOC);
}
mysqli_close($dbc);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> GuestN </title>
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
<!-- This is the text enter for putting the Guest Lastname -->
<body>
    <center><form action = "Guest_Artist_Display.php" method="get">
		<h2>Enter Guest Last Name:</h2> 
        <input type="text" name = "guestname"><br>
		<input type="submit" value="Search">
	</form></center>

	<!-- Table for the Names -->
	<table width="500" border="1px" cellpadding="0" cellspacing="0" align="center">
		<tr bgcolor="#D3D3D3">
			<th>GuestFN</th>
			<th>GuestLN</th>
		
		</tr>
		<?php foreach ($result as $guest) {
			echo "<tr>";
			echo "<td>" .$guest['GuestFN']."</td>";
			echo "<td>" .$guest['GuestLN']."</td>";
			echo "</tr>";
		}
		?>
	</table><br>
	<center><label>Querey: SELECT GuestFN, GuestLN FROM Guest</label></center><br>
	<center><label>Display Query: SELECT ArtistFN, ArtistLN, ConName FROM Artist, Concert WHERE Artist.ArtID = (SELECT ArtID from Concert JOIN Attend on Concert.ConcertID = Attend.ConcertID JOIN Guest on Attend.GuestID = Guest.GuestID WHERE GuestLN = ? ) and Concert.ArtID = Artist.ArtID</label></center><br>
    <!-- Button to go back to the home page -->
	<form method="get">
	<center><input type="submit" name="Home" value="Return Home"></center>
	</form>
</body>
<?php
if(isset($_GET['Home']))
		header('Location:CSC455_Index.html');
?>
</html>