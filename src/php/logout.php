<?php
	
	$userName = filter_input(INPUT_GET, 'name'); 
	
	include ('database_connection.php');
	$query_verify_loggedinuser = "UPDATE members SET `loggedIn` = 'N' WHERE `Username` = '$userName'";
	$result_verify_loggedinuser = mysqli_query($dbc, $query_verify_loggedinuser);
	
	if ($result_verify_loggedinuser){
		
		session_start();
		
		echo $_SESSION['gapiinstance'];
		
	}
	
	mysqli_close($dbc);
?>
