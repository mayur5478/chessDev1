<?php 
/*$dbc = mysqli_connect('localhost',"root","","chessgame");*/
$dbc=include 'setup.php';
$level = filter_input(INPUT_GET,'LevelId');
$chapter = filter_input(INPUT_GET,'ChapterId');
$subchapter = filter_input(INPUT_GET,'SubChapterId');
$question = filter_input(INPUT_GET,'QuestionId');
$query = "select Introduction from puzzle_text_theory where Level='$level' and Chapter='$chapter' and SubChapter='$subchapter' and Problem_id=$question";
$r = mysqli_query($dbc,$query);
while($row = mysqli_fetch_array($r)){
	echo $row[0];
	}

?>