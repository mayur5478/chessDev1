<?php 
/*$dbc = mysqli_connect('localhost',"root","","chessgame");*/
$dbc=include 'setup.php';
$id = filter_input(INPUT_GET,'LevelId');
$query = "select distinct Chapter from problems where Level ='$id'";
$r = mysqli_query($dbc,$query);
while($row = mysqli_fetch_array($r)){
	echo $row[0].' ';
	}
?>