$(document).ready(function(){
	var board = new ChessBoard('board',{
						  draggable: true,
						  dropOffBoard: 'trash',
						  sparePieces: true
						});
						
	$('#saveAndNext').on('click', function() {
		  console.log("Current position as an Object:");
		  console.log(board.position());
		  console.log("Current position as a FEN string:");
		  console.log(board.fen());
	});		

});
	
	