<?php 
/*$dbc = mysqli_connect('localhost',"root","","chessgame");*/
$dbc=include 'setup.php';
$level = filter_input(INPUT_GET,'LevelId');
$Chapter = filter_input(INPUT_GET,'ChapterId');
$SubChapter = filter_input(INPUT_GET,'SubchapterId');
$query = "select distinct problem_name from problems where SubChapter='$SubChapter' and Chapter ='$Chapter' and Level ='$level'";
$r = mysqli_query($dbc,$query);
while($row = mysqli_fetch_array($r)){
	echo $row[0].' ';
	}
?>