var cfg ={
					  draggable: true,
					  dropOffBoard: 'trash',
					  sparePieces: true
				};
				this.board = new ChessBoard('board',cfg);
						
$('#startBtn').on('click', board.start);

$('#clearBtn').on('click', board.clear);