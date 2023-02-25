<?php
    if(!empty($_GET['guestname'])){ // this checks if the selct option is empty
        $name = $_GET['guestname'];
        require_once('../CSC455_Configs.php');
        $query1 = "SELECT ArtistFN, ArtistLN, ConName FROM Artist, Concert WHERE Artist.ArtID = (SELECT ArtID from Concert JOIN Attend on Concert.ConcertID = Attend.ConcertID JOIN Guest on Attend.GuestID = Guest.GuestID WHERE GuestLN = ? ) and Concert.ArtID = Artist.ArtID";
        // this helps with handling the ? in the query
        $stmt = mysqli_prepare($dbc,$query1);
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $result1 = mysqli_stmt_get_result($stmt);
        // this gets the data form the query
        if($result1){
            $gname = mysqli_fetch_assoc($result1);
            $Firstn = $gname['ArtistFN'];
            $Lastn = $gname['ArtistLN'];
            $concert = $gname['ConName'];
        }
        else{
            echo"error";
            mysqli_close($dbc);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>GA</title>
    </head>
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
    <body>
    <!--This displays the Info from the query-->
    <center><h2 style="font-family:verdana;">You Info</h2></center>
        <?php // this puts the data into a table
        echo"<center><h3 style=\"font-family:verdana;\"> You are Seeing: $Firstn $Lastn</h3></center>";
        echo"<center><h3 style=\"font-family:verdana;\">At Concert: $concert</h3></center>";
        ?>
        <center><label>Querey: SELECT ArtistFN, ArtistLN, ConName FROM Artist, Concert WHERE Artist.ArtID = (SELECT ArtID from Concert JOIN Attend on Concert.ConcertID = Attend.ConcertID JOIN Guest on Attend.GuestID = Guest.GuestID WHERE GuestLN = ? ) and Concert.ArtID = Artist.ArtID</label></center><br>
	<form method="get">
        <!--Button to go back to the home page-->
	<center><input type="submit" name="Home" value="Return Home"></center>
	</form>
    </body>
    <?php
        if(isset($_GET['Home']))
		    header('Location:CSC455_Index.html')
    ?>
</html>