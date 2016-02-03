<?php
	$fileName = $_GET['fileName'];
	$fileContents = file_get_contents($fileName);
	if($fileContents)
		echo $fileContents;
	else
		echo "";
?>