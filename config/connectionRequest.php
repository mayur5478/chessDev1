<?php
	$user1 = $_GET['user1Name'];
	$user2 = $_GET['user2Name'];
	$user2File = $user2.".txt";
	$fp = fopen($user2File, 'w');
	fwrite($fp, $user1);
	fclose($fp);

?>