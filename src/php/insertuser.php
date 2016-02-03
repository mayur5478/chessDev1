<?php 
	include ('database_connection.php'); 
	$name = filter_input(INPUT_GET,'name');
    $Email = filter_input(INPUT_GET,'mail');
    //$gapi = filter_input(INPUT_GET, 'gapiinstance'); 
    $Password = '';
	$query_verify_email = "SELECT * FROM members WHERE Email ='$Email'";
	$result_verify_email = mysqli_query($dbc, $query_verify_email);
	
	
	if (mysqli_num_rows($result_verify_email) == 0) {// IF no previous user is using this email .
		
		$activation = 'NULL';
		$query_insert_user = "INSERT INTO `members` ( `Username`, `Email`, `Password`, `Activation`, `loggedIn`) VALUES ( '$name', '$Email', '$Password', '$activation', 'N')";

		$result_insert_user = mysqli_query($dbc, $query_insert_user);
		
		if(mysqli_affected_rows($dbc)>0){	
			mysqli_close($dbc);
			//session_start();
			//$_SESSION['gapiinstance'] = $gapi;			
		}
		
	}	else {
		echo 1;
	}
?>