<?php
require_once('../CSC455_Configs.php'); // connect to the database
$query = "SELECT GuestID, GuestFN, GuestLN FROM Guest";
$query2 = "SELECT GuestFN, GuestLN, Section, Row, Seat, Price from Guest join Ticket ON Guest.GuestID = Ticket.GuestID";
// two different queries one for the selct and the other for the table
$result = mysqli_query($dbc, $query);
$result2 = mysqli_query($dbc,$query2);
// gets the data from the two queries
if($result){
    mysqli_fetch_all($result, MYSQLI_ASSOC);
}
if($result2){
    mysqli_fetch_all($result2, MYSQLI_ASSOC);
}
mysqli_close($dbc);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>
            Ticket Info
        </title>
        <style> 
            input[type=submit] {
                background-color: #4CAF50; 
                border: none;
                color: white;
                padding: 16px 32px;
            }
        </style>
    
    </head>
    <body>
        <center><h2 style="font-family:verdana;">Look up Your Ticket Info</h2></center>

        <center><form action="Ticket_Display.php" method="get">
            Choose Your Name:
            <center><select name="Tick_name" style="padding: 10px; background:#edf2ff; border:none;">
                <option value=""> --Select--</option>
                <?php
                foreach($result as $name){ // this is the select options for the first query
                    $ID = $name['GuestID'];
                    $FN = $name['GuestFN'];
                    $LN = $name['GuestLN'];
                    $info = $FN.",".$LN;
                    echo "<option value=\"$ID\">$info</option><br>";
                }
                ?>
            </select></center>
            <center><input type="submit" name="GO" value="GO"></center>
        </form></center>
        <table width="500" border="1px" cellpadding="0" cellspacing="0" align="center">
		<tr bgcolor="#D3D3D3">
			<th>GuestFN</th>
			<th>GuestLN</th>
			<th>Section</th>
            <th>Row</th>
            <th>Seat</th>
            <th>Price</th>
            
		</tr>	
		<?php foreach ($result2 as $tick) { // this is the table for the second query
			echo "<tr>";
			echo "<td>".$tick['GuestFN']."</td>";
			echo "<td>".$tick['GuestLN']."</td>";
			echo "<td>".$tick['Section']."</td>";
            echo "<td>".$tick['Row']."</td>";
            echo "<td>".$tick['Seat']."</td>";
            echo "<td>".$tick['Price']."</td>";
			echo "</tr>";
		}
		?>
	</table><br>
    <center><label>Query1: SELECT GuestID, GuestFN, GuestLN FROM Guest</label></center><br>
    <center><label>Query2: SELECT GuestFN, GuestLN, Section, Row, Seat, Price from Guest join Ticket ON Guest.GuestID = Ticket.GuestID</label></center><br>
    <!-- button to go back to home page-->
	<form method="get">
	<center><input type="submit" name="Home" value="Return Home"></center>
	</form>
    </body>
    <?php
    if(isset($_GET['Home']))
		header('Location:CSC455_Index.html')
    ?>
</html>

