<!-- shows the producers working for the venue and how long they have been there using a function to sub the hire date and the current date
SELECT ProdFN, ProdLN, years_working(HireDate) as Years, ProdHire.Name from Producer JOIN ProdHire on Producer.ProdID = ProdHire.ProdID; -->

<?php
require_once('../CSC455_Configs.php'); // connect to the database
$query = "SELECT ProdFN, ProdLN, years_working(HireDate) as Years, ProdHire.Name as Venue from Producer JOIN ProdHire on Producer.ProdID = ProdHire.ProdID";
$result = mysqli_query($dbc, $query);
// gets the data from the query
if($result){
    mysqli_fetch_all($result, MYSQLI_ASSOC);
}
mysqli_close($dbc);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Producers</title>
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
        <center><h2>Producers Years Working</h2></center>

        <table width="500" border="1px" cellpadding="0" cellspacing="0" align="center">
            <!-- displaying data into a table-->
            <tr bgcolor="#D3D3D3">
                <th>Producer FN &nbsp;</th>
                <th>Producer LN &nbsp;</th>
                <th>Years Working &nbsp;</th>
                <th>Venue &nbsp;</th>
            </tr>

        <?php
        foreach($result as $row){ // puts the data into a table
                echo "<tr>";
                echo "<td>". $row['ProdFN'] ."</td>";
                echo "<td>". $row['ProdLN'] ."</td>";
                echo "<td>". $row['Years'] ."</td>";
                echo "<td>". $row['Venue'] ."</td>";
                echo "</tr>";
        }
        ?>
        </table><br>
        <center><label>Querey: SELECT ProdFN, ProdLN, years_working(HireDate) as Years, ProdHire.Name as Venue from Producer JOIN ProdHire on Producer.ProdID = ProdHire.ProdID</label></center><br>
	    <form method="get">
	        <center><input type="submit" name="Home" value="Return Home"></center>
	    </form>
    </body>
    <?php
    if(isset($_GET['Home']))
            header('Location:CSC455_Index.html')
    ?>
</html>