<!-- shows the prodeucers that are referenced by there superior self join-->

<?php
require_once('../CSC455_Configs.php'); // connect to the database
$query = "SELECT j.ProdFN as ProducerFN, j.ProdLN as ProducerLN, i.ProdFN as SeniorFN, i.ProdLN as SeniorLN FROM Producer i, Producer j WHERE i.ProdID = j.SeniorPro;";
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
        <center><h2>Producers and Senior Producers</h2></center>
            <!--display data in a table-->
        <table width="500" border="1px" cellpadding="0" cellspacing="0" align="center">
            <tr bgcolor="#D3D3D3">
                <th>Producer FN &nbsp;</th>
                <th>Producer LN &nbsp;</th>
                <th>Seniors FN &nbsp;</th>
                <th>Seniors LN &nbsp;</th>
            </tr>

        <?php
        foreach($result as $row){ // puts the data into a table
                echo "<tr>";
                echo "<td>". $row['ProducerFN'] ."</td>";
                echo "<td>". $row['ProducerLN'] ."</td>";
                echo "<td>". $row['SeniorFN'] ."</td>";
                echo "<td>". $row['SeniorLN'] ."</td>";
                echo "</tr>";
        }
        ?>
        </table><br>
        <center><label>Querey: SELECT j.ProdFN as ProducerFN, j.ProdLN as ProducerLN, i.ProdFN as SeniorFN, i.ProdLN as SeniorLN FROM Producer i, Producer j WHERE i.ProdID = j.SeniorPro</label></center><br>
        <!--Button to go back to home page-->
	    <form method="get">
	    <center><input type="submit" name="Home" value="Return Home"></center>
	    </form>

    </body>
    <?php
    if(isset($_GET['Home']))
		header('Location:CSC455_Index.html')
    ?>
</html>