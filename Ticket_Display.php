<?php
    if(!empty($_GET['Tick_name'])){ // this checks if the selct option is empty
        $id = $_GET['Tick_name'];
        require_once('../CSC455_Configs.php');
        $query1 = "SELECT GuestFN, GuestLN, Section, Row, Seat, Price from Guest join Ticket ON Guest.GuestID = Ticket.GuestID WHERE Guest.GuestID = ?";
        // these help with handling the ? in the query
        $stmt = mysqli_prepare($dbc,$query1);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result1 = mysqli_stmt_get_result($stmt);
        // this gets the data form the query
        if($result1){
            $Ticket = mysqli_fetch_assoc($result1);
            $Firstn = $Ticket['GuestFN'];
            $Lastn = $Ticket['GuestLN'];
            $Section = $Ticket['Section'];
            $Row = $Ticket['Row'];
            $Seat = $Ticket['Seat'];
            $Price = $Ticket['Price'];
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
        <title>Ticket</title>
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
    <center><h2 style="font-family:verdana;">Ticket Information</h2></center>
        <?php // this puts the data into a table
        echo"<center><h3 style=\"font-family:verdana;\">$Firstn $Lastn</h3></center>";
        echo"<center><h3 style=\"font-family:verdana;\">Section: $Section</h3></center>";
        echo"<center><h3 style=\"font-family:verdana;\">Row; $Row</h3></center>";
        echo"<center><h3 style=\"font-family:verdana;\">Seat: $Seat</h3></center>";
        echo"<center><h3 style=\"font-family:verdana;\">Price: $$Price</h3></center><br>";
        ?>
	<form method="get">
        <center><label>Query: SELECT GuestFN, GuestLN, Section, Row, Seat, Price from Guest join Ticket ON Guest.GuestID = Ticket.GuestID WHERE Guest.GuestID = ?</label></center><br>
        <!--button to go back to the home page-->
	<center><input type="submit" name="Home" value="Return Home"></center>
	</form>
    </body>
    <?php
        if(isset($_GET['Home']))
		    header('Location:CSC455_Index.html')
    ?>
</html>
