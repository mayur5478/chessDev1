<?php 
/*$dbc = mysqli_connect('localhost:3308','root','root','ChessDb');*/
$dbc=include 'setup.php';
$id = filter_input(INPUT_GET,'QuestionId');
$query = "select Position from puzzle_question where id = $id";
$r = mysqli_query($dbc,$query);
$position;
while($row = mysqli_fetch_array($r)){
	$position = $row[0];
}
echo $position;
?>