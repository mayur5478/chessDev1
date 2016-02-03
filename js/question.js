var cfg ={
					  draggable: true,
					  dropOffBoard: 'trash',
					  sparePieces: true
				};
				this.board = new ChessBoard('board',cfg);
							
				$('#saveAndNext').on('click', function() {
					  var question = $('#question').val(),
					  	  level = parseInt($('#level').val()),
					  	  boardPositionNew = board.position();
	 		          		
					  if(question != "" && (!jQuery.isEmptyObject(boardPositionNew)) )
					  {
					  		$.ajax({url:"config/CaptureBoard.php",data:{Question:question,BoardPosition:JSON.stringify(boardPositionNew),Level:level}}).done(function(data){
			          			window.location.href="next.php?questionId="+data;
			          		});
			          }
			          else{
			          		console.log("Error");
			          }
				});

			    var that = this;
				$('#show').on('click', function() {
				      $.ajax({url:"config/showBoard.php"}).done(function(data){
			          		var position = JSON.parse(data);
			          		that.board = new ChessBoard('board',position);
			         });
					});
					
				$('#reset').on('click', this.board.clear);
		