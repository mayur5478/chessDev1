<?php

include ('database_connection.php');
if (isset($_POST['formsubmitted'])) {
	$error = array();
	//Declare An Array to store any error message
	if (empty($_POST['name'])) {//if no name has been supplied
		$error[] = 'Please Enter a name ';
		//add to array "error"
	} else {
		$name = $_POST['name'];
		//else assign it a variable
	}

	if (empty($_POST['e-mail'])) {
		$error[] = 'Please Enter your Email ';
	} else {

		if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['e-mail'])) {
			//regular expression for email validation
			$Email = $_POST['e-mail'];
		} else {
			$error[] = 'Your EMail Address is invalid  ';
		}

	}

	if (empty($_POST['Password'])) {
		$error[] = 'Please Enter Your Password ';
	} else {
		$Password = $_POST['Password'];
	}

	if (empty($error))//send to Database if there's no error '

	{
		// If everything's OK...

		// Make sure the email address is available:
		$query_verify_email = "SELECT * FROM members WHERE Email ='$Email'";
		//$query_verify_email = "SELECT * FROM members WHERE Username ='$name'";
		$result_verify_email = mysqli_query($dbc, $query_verify_email);
		if (!$result_verify_email) {//if the Query Failed ,similar to if($result_verify_email==false)
			echo ' Database Error Occured ';
		}

		if (mysqli_num_rows($result_verify_email) == 0) {// IF no previous user is using this email .

			// Create a unique  activation code:
			$activation = md5(uniqid(rand(), true));

			$query_insert_user = "INSERT INTO `members` ( `Username`, `Email`, `Password`, `Activation`) VALUES ( '$name', '$Email', '$Password', '$activation')";

			$result_insert_user = mysqli_query($dbc, $query_insert_user);
			if (!$result_insert_user) {
				echo 'Query Failed ';
			}

			if (mysqli_affected_rows($dbc) == 1) {//If the Insert Query was successfull.

				require_once "Mail.php";

				$from = '<from.gmail.com>';
				$to = $Email;
				$subject = 'Hi!';
				$message = " To activate your account, please click on this link:\n\n";
				$message .= WEBSITE_URL . '/activate.php?email=' . urlencode($Email) . "&key=$activation";

				$headers = array('From' => $from, 'To' => $to, 'Subject' => $subject);

				$smtp = Mail::factory('smtp', array('host' => 'ssl://smtp.gmail.com', 'port' => '465', 'auth' => true, 'username' => 'playchesstowin@gmail.com', 'password' => 'checkmate@1'));

				$mail = $smtp -> send($to, $headers, $message);

				if (PEAR::isError($mail)) {
					echo '<div class="errormsgbox">You could not be registered due to a system
					error. We apologize for any
					inconvenience.</div>';
				} else {
					// Finish the page:
					echo '<div class="success logindiv">Thank you for
					registering! A confirmation email
					has been sent to ' . $Email . ' Please click on the Activation Link to Activate your account </div>';

				}

			} else {// If it did not run OK.
				echo '<div class="errormsgbox">You could not be registered due to a system
					error. We apologize for any
					inconvenience.</div>';

			}

		} else {// The email address is not available.
			echo '<div class="errormsgbox" >That email address has already been registered.</div>';
		}

	} else {//If the "error" array contains error msg , display them

		echo '<div class="errormsgbox"> <ol>';
		foreach ($error as $key => $values) {

			echo '	<li>' . $values . '</li>';

		}
		echo '</ol></div>';

	}

	mysqli_close($dbc);
	//Close the DB Connection

} // End of the main Submit conditional.
?>