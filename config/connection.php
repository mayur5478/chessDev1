<?php
	$user1 = $_GET['user1'];
	$user2 = $_GET['user2'];
	$combinedFileName = $user1."_".$user2.".txt";
	$fp = fopen($combinedFileName, 'w');
	fwrite($fp, $user2."-> request accepted");
	fclose($fp);

?>