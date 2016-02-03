<script src="js/chess.js"></script>
$(document).ready(function(){
					var userMove = [],
						automatedMove = [],
						that = this,
						questionId = parseInt(location.search.split('questionId=')[1]);
			          $.ajax({url:"config/showBoard.php",data:{QuestionId:questionId}}).done(function(data){
			          	console.log(typeof data);
			          	var position = JSON.parse(data);
			          	var cfg ={
						  draggable: true,
						  dropOffBoard: 'trash',
						  onDrop : that.onDrop,
						  position :position,
						  onDragStart: that.onDragStart,
  						  onSnapEnd: that.onSnapEnd
						};
			          	this.board = new ChessBoard('board',cfg);
			          });
					
				this.board;
 var  game = new Chess(),
  statusEl = $('#status'),
  fenEl = $('#fen'),
  pgnEl = $('#pgn');

// do not pick up pieces if the game is over
// only pick up pieces for the side to move
var onDragStart = function(source, piece, position, orientation) {
  if (game.game_over() === true ||
      (game.turn() === 'w' && piece.search(/^b/) !== -1) ||
      (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
    return false;
  }
};

this.onDrop = function(source, target) {
  // see if the move is legal
  var move = game.move({
    from: source,
    to: target,
    promotion: 'q' // NOTE: always promote to a queen for example simplicity
  });

  // illegal move
  if (move === null) return 'snapback';

  updateStatus();
};

// update the board position after the piece snap 
// for castling, en passant, pawn promotion
this.onSnapEnd = function() {
  this.board.position(game.fen());
};

this.updateStatus = function() {
  var status = '';

  var moveColor = 'White';
  if (game.turn() === 'b') {
    moveColor = 'Black';
  }

  // checkmate?
  if (game.in_checkmate() === true) {
    status = 'Game over, ' + moveColor + ' is in checkmate.';
  }

  // draw?
  else if (game.in_draw() === true) {
    status = 'Game over, drawn position';
  }

  // game still on
  else {
    status = moveColor + ' to move';

    // check?
    if (game.in_check() === true) {
      status += ', ' + moveColor + ' is in check';
    }
  }

  statusEl.html(status);
  fenEl.html(game.fen());
  pgnEl.html(game.pgn());
};
	
	
	
				$('#getPositionBtn').on('click', function() {
					  console.log("Current position as an Object:");
					  console.log(board.position());
					
					  console.log("Current position as a FEN string:");
					  console.log(board.fen());
			          var BoardPosition1=board.position();
			          console.log(BoardPosition1);
			          $.ajax({url:"CaptureBoard.php",data:{BoardPosition:JSON.stringify(BoardPosition1)}}).done(function(data){
			          	console.log(data);
			          });
					});
					$('#show').on('click', function() {
					  
			          
			          $.ajax({url:"showBoard.php"}).done(function(data){
			          	console.log(typeof data);
			          	var position = JSON.parse(data);
			          	var board = new ChessBoard('board',position);
			          });
					});
					
					$('#clearBoardBtn').on('click', board.clear);
this.onDrop = function(source, target, piece, newPos, oldPos, orientation) {
  if(source!=target)
	 {
	  var move = {};
	  move[source] = target;
	  userMove.push(move);
	  console.log("Target: " + target);
	  console.log("Piece: " + piece);
	  console.log("New position: " + ChessBoard.objToFen(newPos));
	  console.log("Old position: " + ChessBoard.objToFen(oldPos));
	  console.log("Orientation: " + orientation);
	  console.log("--------------------");
	}
};

});
	