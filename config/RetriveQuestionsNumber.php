<?php 
/*$dbc = mysqli_connect('localhost',"root","","chessgame");*/
$dbc=include 'setup.php';
$level = filter_input(INPUT_GET,'LevelId');
$chapter = filter_input(INPUT_GET,'ChapterId');
$subchapter = filter_input(INPUT_GET,'SubchapterId');
$CurrentQuestionId = filter_input(INPUT_GET,'CurrentQuestionId');
$query = "select distinct problem_name from problems where Level='$level' and Chapter='$chapter' and SubChapter='$subchapter' and Problem_id=$CurrentQuestionId";


$r = mysqli_query($dbc,$query);
while($row = mysqli_fetch_array($r)){
	echo $row[0];
	}


?>