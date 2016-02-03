<?php
	
	$userName = filter_input(INPUT_GET, 'name'); 
	include "DatabaseConnection.php";
	$query_verify_loggedinuser = "UPDATE members SET `loggedIn` = 'N' WHERE `Username` = '$userName'";
	$result_verify_loggedinuser = mysqli_query($dbc, $query_verify_loggedinuser);
	
	if ($result_verify_loggedinuser){
		echo '1';
	}
	
	// remove all session variables
	session_unset();
	
	// destroy the session
	session_destroy();
	mysqli_close($dbc);
?>
