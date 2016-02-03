<?php
		clearstatcache();
		$userFileName = $_GET['username'];
		echo filemtime($userFileName.".txt")
?>