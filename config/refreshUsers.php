<?php
	include "DatabaseConnection.php";
	$name = $_GET['name'];
	$query_verify_loggedinusers = "SELECT Username FROM members WHERE loggedIn = 'Y' AND Username != '".$name."'";
    
    $result = mysqli_query($dbc, $query_verify_loggedinusers);
    $output = '';
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		
		while($row = mysqli_fetch_assoc($result)) {
		    
			$output = $output .$row['Username'] ." " ;
		}
	}	
	echo $output;
	mysqli_close($dbc);	
?>