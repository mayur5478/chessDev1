<?php 
$userName = $_GET['name'];
$password = $_GET['password'];
	include "DatabaseConnection.php";
	session_start();
	$sql = "SELECT loggedIn,Role FROM members WHERE Username = '$userName' And Password = '$password'";
	$result = mysqli_query($dbc, $sql) or die(mysqli_error());
	
	if (mysqli_num_rows($result) > 0) {
	//if ($result) {	
	   
	    while($row = mysqli_fetch_assoc($result)) {
			if($row["loggedIn"] == 'N' || $row["loggedIn"] == 'n'){
				$query_verify_loggedinuser = "Update members SET loggedIn = 'Y' WHERE Username = '$userName'";
				$result = mysqli_query($dbc, $query_verify_loggedinuser);
				if ($result) {										
					mysqli_close($dbc);
				}
			}	
			if($row["Role"] == 'Admin'){
				include "levelSelection.php";
			} else {
				$_GET['loggedUserName']	= $userName;
				$_SESSION['loggedUserName'] = $userName;						
				echo $userName;
			}			
	    }
	} else {
	    echo "false";
		
	}
?>