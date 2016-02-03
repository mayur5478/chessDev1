<?php
	$userName = $_GET['userName'];
	$source = $_GET['source'];
	$target =$_GET['target'];
	$userFile = $userName.".txt";
	$fp = fopen($userFile, 'w');
	fwrite($fp,$source.' '.$target);
	fclose($fp);

?>