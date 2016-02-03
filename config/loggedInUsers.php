
<?php
	$name = $_GET['name'];	
	session_start();
	$_SESSION['loggedUserName'] = $name;
	fopen($name.".txt", 'w');
	$output = "<div class='logindiv'><div class='loggedInUsersDiv'>Welcome ".ucfirst($name)." to ChessWay. <br/> ";
	include "DatabaseConnection.php";
	$query_verify_loggedinusers = "SELECT Username FROM members WHERE loggedIn = 'Y' AND Username != '".$name."'";
    
    $result = mysqli_query($dbc, $query_verify_loggedinusers);
    
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		$output = $output . "You can start game with any one of these players <br/>";
		while($row = mysqli_fetch_assoc($result)) {
		    
			$output = $output . "<a href='#' class='loggedInUser' id='". $row['Username']."'>". $row["Username"] ."</a><br/>";
		}
	} else {
		    $output = $output . "You can not start game with any one. <br/>";
	}	
	echo $output."</div><div class='request'></div></div>";
	mysqli_close($dbc);	
?>
