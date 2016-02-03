<?php 
$dbc = mysqli_connect('localhost:3308',"root","root","ChessDb");

$BoardPosition1 = filter_input(INPUT_GET,'BoardPosition'); 
$question = filter_input(INPUT_GET,'Question'); 
$level = filter_input(INPUT_GET,'Level'); 
$query = "insert into puzzle_question values(0,'$question','$level','$BoardPosition1')";
$r = mysqli_query($dbc,$query);
$query = "select id from puzzle_question where id in(select max(id) from puzzle_question)";
$r1 = mysqli_query($dbc,$query);
while($row = mysqli_fetch_array($r1)){
	echo $row[0]; 
} 

$dbc.exit;
?>