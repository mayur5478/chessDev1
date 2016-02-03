<?php 
$userName = $_GET['name'];
$password = $_GET['password'];


	include_once 'database_connection.php';
	$sql = "SELECT loggedIn FROM members WHERE Username = '$userName'";
	echo $userName;
	$result = mysqli_query($dbc, $sql);
	
	if (mysqli_num_rows($result) > 0) {
	   
	    while($row = mysqli_fetch_assoc($result)) {
			if($row["loggedIn"] == 'N'){
				$query_verify_loggedinuser = "Update members SET loggedIn = 'Y' WHERE Username = '$userName'";
				$result = mysqli_query($dbc, $query_verify_loggedinuser);
				if ($result) {
					
					mysqli_close($dbc);
					//$dbc.exit;
					$_GET['loggedUserName']	= $userName;
					session_start();
					echo "session started";	
           			$_SESSION['login_user']= $userName;
           			
					include "loggedInUsers.php";	
				}		
			}	
			else{
				echo "login failed";
				
			}
	    }
	} else {
	    echo "0 results";
	}
	//mysqli_close($dbc);
?>
