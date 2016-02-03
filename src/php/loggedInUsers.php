<html>
<link rel='stylesheet' type='text/css' href='../css/AppStyle.css' />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<body>
<div class="logindiv">
<?php
	$name = $_GET['loggedUserName'];
	echo "welcome ".$name." to ChessBoard site. You can start game with any one of these players :<br/> ";
	//include 'database_connection.php';	
	// Make the connection:
	$dbc = @mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
	
	$query_verify_loggedinusers = "SELECT Username FROM members WHERE loggedIn = 'Y' AND Username != '".$name."'";
    
    $result = mysqli_query($dbc, $query_verify_loggedinusers);
    
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
		    
			echo "<a href='src/php/startGame.php?PID=". $row['Username']."'>". $row["Username"] ."</a><br/>";
		}
	} else {
		    echo "0 results";
	}	
	
	mysqli_close($dbc);	
?>
<button id="signout">Sign Out</button>	
<script>
	$(function(){
		
		$("#signout").click(function(){
			var name = <?php echo json_encode($_GET['loggedUserName']);?>;
			
			$.ajax({url:"logout.php",data:{name:name}}).done(function(gapi){
	          	$.getScript("../js/loginWithGmail.js",function(){				
					window.dologin = false;
				});
				console.log("log out done");
				
	          	window.location.href = '../../index.php';
			});
			/*
			*/
			
		})
	})
	
	
</script>
</div>	
</body>	
</html>


