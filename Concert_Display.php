<!--Display the artist concert info-->
<?php
    if(isset($_GET["Name"])){ //Checks if the button has been pressed
        $Cname = $_GET['Name'];
        require_once('../CSC455_Configs.php');// connects to data base
        $query1 = "SELECT ArtistFN, ArtistLN, ConName, Venue.Name as Venue, PerfoTimes, Street, City, Zip FROM Artist JOIN Concert on Artist.ArtID = Concert.ArtID JOIN Venue ON Concert.Name = Venue.Name WHERE ConName = ?";
        // these help with the ? in the query
        $stmt = mysqli_prepare($dbc,$query1);
        mysqli_stmt_bind_param($stmt, "s", $Cname);
        mysqli_stmt_execute($stmt);
        $result1 = mysqli_stmt_get_result($stmt);

        if($result1){ // grabs the info in the table
            $conname = mysqli_fetch_assoc($result1);
            $Concert = $conname['ConName'];
            $ArtFN = $conname['ArtistFN'];
            $ArtLN = $conname['ArtistLN'];
            $Venue = $conname['Venue'];
            $Perfo = $conname['PerfoTimes'];
            $Street = $conname['Street'];
            $City = $conname['City'];
            $Zip = $conname['Zip'];
        }
        else{
            echo "error";
        }
    }
    else{
        echo"error";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ticket</title>
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
        <center><h2 style="font-family:verdana;">Ticket Information</h2></center>
        <?php // displays the information from the query
        echo"<center><h3 style=\"font-family:verdana;\">$Concert</h3></center>";
        echo"<center><h3 style=\"font-family:verdana;\">$ArtFN $ArtLN</h3></center>";
        echo"<center><h3 style=\"font-family:verdana;\">$Venue at $Perfo </h3></center>";
        echo"<center><h3 style=\"font-family:verdana;\">Location: $Street, $City, $Zip </h3></center>";
        ?>
    </body><br>
    <center><label>Query: SELECT ArtistFN, ArtistLN, ConName, Venue.Name as Venue, PerfoTimes, Street, City, Zip FROM Artist JOIN Concert on Artist.ArtID = Concert.ArtID JOIN Venue ON Concert.Name = Venue.Name WHERE ConName = ?</label></center><br>
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