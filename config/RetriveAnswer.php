<?php 
/*$dbc = mysqli_connect('localhost',"root","","chessgame");*/
$dbc=include 'setup.php';
$move = filter_input(INPUT_GET,'Position');
$level = filter_input(INPUT_GET,'LevelId');
$chapter = filter_input(INPUT_GET,'ChapterId');
$subchapter = filter_input(INPUT_GET,'SubChapterId');
$question = filter_input(INPUT_GET,'QuestionId');
/*echo $move;*/

$query = "select admin_Move from puzzle_answer where Level='$level' and Chapter='$chapter' and SubChapter='$subchapter' and Problem_id=$question and trim(user_Move)= trim('$move')";
$r = mysqli_query($dbc,$query);
while($row = mysqli_fetch_array($r)){
	echo $row[0];
}
?>




