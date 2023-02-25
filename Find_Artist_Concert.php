<!--SELECT ArtistFN, ArtistLN, ConName, Venue.Name, PerfoTimes FROM Artist JOIN Concert on Artist.ArtID = Concert.ArtID JOIN Venue ON Concert.Name = Venue.Name;
This is going to use a Artist seach box this is going to use a text box query this is the three table join-->
<?php
require_once('../CSC455_Configs.php'); // connect to data base
$query = "SELECT ConName FROM Concert";
$query2 = "SELECT ArtistFN, ArtistLN, ConName, Venue.Name as Venue, PerfoTimes, Street, City, Zip FROM Artist JOIN Concert on Artist.ArtID = Concert.ArtID JOIN Venue ON Concert.Name = Venue.Name";
// these are two different queries one for the table and the other for the button data
$result = mysqli_query($dbc, $query);
$result2 = mysqli_query($dbc,$query2);
// gets data from the tables 
if($result){
    mysqli_fetch_all($result, MYSQLI_ASSOC);
}
if($result2){
    mysqli_fetch_all($result2, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Concert Info</title>
        <style> 
            input[type=submit] {
                background-color: #4CAF50; 
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
        <center><h2 style="font-family:verdana;">Select Concert</h2></center>

        <form action="Concert_Display.php" method="get">
            <?php // these are the button options
            foreach($result as $ConName){
                $Name = $ConName['ConName'];
                echo "<center><input type = \"submit\" name=\"Name\" value = \"$Name\"><br><br></center>";
            }
            ?>
        </form>

        <table width="500" border="1px" cellpadding="0" cellspacing="0" align="center">
            <!--displaying data in a table-->
		<tr bgcolor="#D3D3D3">
			<th>Concert</th>
			<th>ArtistFN</th>
			<th>ArtistLN</th>
            <th>Venue</th>
            <th>Performance</th>
            <th>Street</th>
            <th>City</th>
            <th>Zip</th>
            
		</tr>	
		<?php foreach ($result2 as $con) { // this displays the second query in a table
			echo "<tr>";
			echo "<td>".$con['ConName']."</td>";
			echo "<td>".$con['ArtistFN']."</td>";
			echo "<td>".$con['ArtistLN']."</td>";
            echo "<td>".$con['Venue']."</td>";
            echo "<td>".$con['PerfoTimes']."</td>";
            echo "<td>".$con['Street']."</td>";
            echo "<td>".$con['City']."</td>";
            echo "<td>".$con['Zip']."</td>";
			echo "</tr>";
		}
		?>
	</table><br>
    <center><label>Querey: SELECT ArtistFN, ArtistLN, ConName, Venue.Name as Venue, PerfoTimes, Street, City, Zip FROM Artist JOIN Concert on Artist.ArtID = Concert.ArtID JOIN Venue ON Concert.Name = Venue.Name</label></center><br>
    <!--Button to go bakc to home page-->
	<form method="get">
	<center><input type="submit" name="Home" value="Return Home"></center>
	</form>
    </body>
    <?php
    if(isset($_GET['Home']))
		header('Location:CSC455_Index.html')
    ?>
</html>

