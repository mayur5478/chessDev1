	        function loadChessBoard(){
						var userMove = [],
						automatedMove = [],
						answerId = 1,
						that=this;
						
       
       /*
       var cfg ={
                                    
                                       draggable: true,
                                      dropOffBoard: 'trash',
                                      position :that.position,
                                      onDragStart: that.onDragStart,
                                        onDrop : that.onDrop,
                                      onSnapEnd: that.onSnapEnd
                              };
                              that.board = new ChessBoard('board',cfg);*/
       
                       
       
				
				
				      /*questionId = parseInt(location.search.split('questionId=')[1]||''.split('&')[0]);*/
				     	questionId=currentQuestionId;
						$.ajax({url:"config/RetriveQuestion.php",data:{LevelId:currentLevel,ChapterId:currentChapter,SubChapterId:subchapterId,QuestionId:questionId}}).done(function(data){
			          	console.log(typeof data);
			          	var position = JSON.parse(data);
			          	var cfg ={
						  draggable: true,
						dropOffBoard: 'trash',
						position : position,
						onDragStart: that.onDragStart,
  						onDrop : that.onDrop,
						onSnapEnd: that.onSnapEnd
						  };
			          	that.board = new ChessBoard('board',cfg);
			          	that.fen = that.board.fen()+" w"+" -"+" -"+" 0"+" 10";
			    		that.game= new Chess(that.fen);
			    		that.updateStatus();
			          });
		// do not pick up pieces if the game is over
				// only pick up pieces for the side to move
		this.onDragStart = function(source, piece, position, orientation) {
		  if (that.game.game_over() === true ||
		      (that.game.turn() === 'w' && piece.search(/^b/) !== -1)) {  
		    return false;
		  }
		};	          
				
		this.onDrop = function(source, target, piece, newPos, oldPos, orientation) {
							
						// see if the move is legal
				  var move = that.game.move({
				    from: source,
				    to: target,
				    promotion: 'q' // NOTE: always promote to a queen for example simplicity
				  });
				  if(source!=target && move!==null) 
				  {
							var Position1=source+"-"+target;
							$.ajax({url:"config/RetriveAnswer.php",data:{LevelId:currentLevel,ChapterId:currentChapter,SubChapterId:subchapterId,QuestionId:questionId,Position:JSON.stringify(Position1)}}).done(function(data)
							{
								console.log(typeof data);
							
							if (data.trim()=="")
							{
								/*alert("Wrong Move");*/
								var incorrectMove = document.createElement("div"); 
								incorrectMove.id = "dialog";
								incorrectMove.innerText = "Wrong Move";
								document.body.appendChild(incorrectMove);
								
								/*
								var position = target+'-'+source;
																
																that.board.move(position);
									*/							
								that.game.undo();																	
								
								$("#dialog" ).dialog({modal:true,close:function(){
									
								}});
							}
				          	else if (data.trim()=="C")
				          	{
				          		/*alert("CheckMate!! Well Played");*/
				          		var checkMateMove = document.createElement("div"); 
								checkMateMove.id = "CheckMate";
								checkMateMove.innerText = "CheckMate!! Well Played";
								document.body.appendChild(checkMateMove);
								$("#CheckMate" ).dialog({modal:true});
				          		that.board.clear();
				          	}
				          	else
				          	{
				          		that.updateStatus();
				          		var position = JSON.parse(data);
					          
					          	/*that.board = new ChessBoard('board',cfg);*/
					          that.board.move(position);
					          	          	move = that.game.move({
											    from: position.split('-')[0],
											    to: position.split('-')[1],
											    promotion: 'q' // NOTE: always promote to a queen for example simplicity
											  });
					          	that.updateStatus();
					
				          	}			          	
					});
				  }
				  // illegal move
				  if (move === null) return 'snapback';
				
				  				
			};
			
			// update the board position after the piece snap 
				// for castling, en passant, pawn promotion
				this.onSnapEnd = function() {
				  that.board.position(that.game.fen());
				};
				
				this.updateStatus = function() {
				  this.status = '';
				
				  var moveColor = 'White';
				  if (that.game.turn() === 'b') {
				    moveColor = 'Black';
				  }
				
				  // checkmate?
				  if (that.game.in_checkmate() === true) {
				    this.status = 'Game over, ' + moveColor + ' is in checkmate.';
				  }
				
				  // draw?
				  else if (that.game.in_draw() === true) {
				    this.status = 'Game over, drawn position';
				  }
				
				  // game still on
				  else {
				    this.status = moveColor + ' to move';
				
				    // check?
				    if (that.game.in_check() === true) {
				      this.status += ', ' + moveColor + ' is in check';
				    }
				  }	
		};
	}
	
	
		
    function genDivs(){
     			subchapterId=$(this).children('h6').text();
	          	$.ajax({url:"config/RetriveQuestions.php",data:{SubchapterId:subchapterId,ChapterId:currentChapter,LevelId:currentLevel},async:false}).done(function(data)
	          	{
	          						console.log(typeof data);
	          						var questionsarray = data.split(" ");
	          						$(".Questions").empty();
							    	var problem_container = $(".Questions");
							    	var puzzle = document.createElement("div");
									puzzle.id="puzzle";
									puzzle.innerHTML = "<h3>PUZZLE";
									problem_container[0].appendChild(puzzle);
									numberofquestions=questionsarray.length;
							      //var e = document.body; // whatever you want to append the rows to: 
							      for(var i = 1; i < questionsarray.length; i++){ 
							        	var problem_container = $(".Questions");
							            var cell_parent = document.createElement("div"); 
							            cell_parent.className = "BoxParent";
							            var cell = document.createElement("div"); 
							            cell.className = "BoxChild";
							            cell.id =  i;
							         	$(cell).bind("click",onClick);
							            cell.innerText = questionsarray[i-1];
							            cell_parent.appendChild(cell);
							            problem_container[0].appendChild(cell_parent); 
							        	//e.appendChild(problem_container[0]); 
							      		}
							      		
	          	})
	          	
	          	
		    	 
    }
    
    function MobgenDivs(){
    	SlideFunction();
    	       
    	       
     			subchapterId=$(this).children('h6').text();
	          	$.ajax({url:"config/RetriveQuestions.php",data:{SubchapterId:subchapterId,ChapterId:currentChapter,LevelId:currentLevel},async:false}).done(function(data)
	          	{
	          						console.log(typeof data);
	          						var questionsarray = data.split(" ");
	          						$(".Questions").empty();
	          						var SlideChapter = $(".Questions");
	       	   var Slidechapsub = document.createElement("div");
		   	   Slidechapsub.id="Slide";	  
		   	   Slidechapsub.innerHTML="<h3>Chapters"	   
		       SlideChapter[0].appendChild(Slidechapsub);
		       $('#Slide').on('click',SlideFunction);
		       var SlideLevel = $(".Questions");
    	var Slidelevel1 = document.createElement("div");
		   	   Slidelevel1.id="LevelSlide";	  
		   	   Slidelevel1.innerHTML="<h3>Levels"	   
		       SlideLevel[0].appendChild(Slidelevel1);
		       $('#LevelSlide').on('click',LevelSlideFunction);
							    	var problem_container = $(".Questions");
							    	var puzzle = document.createElement("div");
									puzzle.id="puzzle";
									puzzle.innerHTML = "<h3>PUZZLE";
									problem_container[0].appendChild(puzzle);
									numberofquestions=questionsarray.length;
							      //var e = document.body; // whatever you want to append the rows to: 
							      for(var i = 1; i < questionsarray.length; i++){ 
							        	var problem_container = $(".Questions");
							            var cell_parent = document.createElement("div"); 
							            cell_parent.className = "BoxParent";
							            var cell = document.createElement("div"); 
							            cell.className = "BoxChild";
							            cell.id =  i;
							         	$(cell).bind("click",MobonClick);
							            cell.innerText = questionsarray[i-1];
							            cell_parent.appendChild(cell);
							            problem_container[0].appendChild(cell_parent); 
							        	//e.appendChild(problem_container[0]); 
							      		}
							      		
	          	})
	          	
	          	
		    	 
    }
    
    function onClick(){
    	
    	$(".Questions").empty();
    	
    	/*window.location.href="UserTrainingAnswer.php?questionId="+this.id;*/
    	var problem_container = $(".Questions");
    	
		var puzzle = document.createElement("div");
		puzzle.id="puzzle";
		puzzle.innerHTML = "<h3>PUZZLE";
		problem_container[0].appendChild(puzzle);
		
    	var chessboard = document.createElement("div"); 
        chessboard.id = "board";
        problem_container[0].appendChild(chessboard);
        /*loadChessBoard(this.id);*/
       currentQuestionId=this.id;
       loadChessBoard();
       loadNextPrevTab();
       tabPrevChapterColor();
       tabNextChaptercolor();
       $('#tabNext').on('click',tabNextChapter);
       $('#tabPrev').on('click',tabPrevChapter);          
    }
    function MobonClick(){
    	
    	$(".Questions").empty();
    	var SlideChapter = $(".Questions");
    	var Slidechapsub = document.createElement("div");
		   	   Slidechapsub.id="Slide";	  
		   	   Slidechapsub.innerHTML="<h3>Chapters"	   
		       SlideChapter[0].appendChild(Slidechapsub);
		       $('#Slide').on('click',SlideFunction);
		var SlideLevel = $(".Questions");
    	var Slidelevel1 = document.createElement("div");
		   	   Slidelevel1.id="LevelSlide";	  
		   	   Slidelevel1.innerHTML="<h3>Levels"	   
		       SlideLevel[0].appendChild(Slidelevel1);
		       $('#LevelSlide').on('click',LevelSlideFunction);
    	/*window.location.href="UserTrainingAnswer.php?questionId="+this.id;*/
    	var problem_container = $(".Questions");
    	
		var puzzle = document.createElement("div");
		puzzle.id="puzzle";
		puzzle.innerHTML = "<h3>PUZZLE";
		problem_container[0].appendChild(puzzle);
		
    	var chessboard = document.createElement("div"); 
        chessboard.id = "board";
        problem_container[0].appendChild(chessboard);
        /*loadChessBoard(this.id);*/
       currentQuestionId=this.id;
       loadChessBoard();
       loadNextPrevTab();
       mobtabPrevChaptercolor();
       mobtabNextChaptercolor();
       $('#tabNext').on('click',mobtabNextChapter);
       $('#tabPrev').on('click',mobtabPrevChapter);          
    }
    function mobnextpreviousQuestion(){
    	
    	$(".Questions").empty();
    	var SlideChapter = $(".Questions");
    	var Slidechapsub = document.createElement("div");
		   	   Slidechapsub.id="Slide";	  
		   	   Slidechapsub.innerHTML="<h3>Chapters"	   
		       SlideChapter[0].appendChild(Slidechapsub);
		       $('#Slide').on('click',SlideFunction);
		var SlideLevel = $(".Questions");
    	var Slidelevel1 = document.createElement("div");
		   	   Slidelevel1.id="LevelSlide";	  
		   	   Slidelevel1.innerHTML="<h3>Levels"	   
		       SlideLevel[0].appendChild(Slidelevel1);
		       $('#LevelSlide').on('click',LevelSlideFunction);
    	/*window.location.href="UserTrainingAnswer.php?questionId="+this.id;*/
    	var problem_container = $(".Questions");
    	
		var puzzle = document.createElement("div");
		puzzle.id="puzzle";
		puzzle.innerHTML = "<h3>PUZZLE";
		problem_container[0].appendChild(puzzle);
		
    	var chessboard = document.createElement("div"); 
        chessboard.id = "board";
        problem_container[0].appendChild(chessboard);
        /*loadChessBoard(this.id);*/
       /*currentQuestionId=this.id;*/
       loadChessBoard();
       loadNextPrevTab();
       $('#tabNext').on('click',mobtabNextChapter);
       $('#tabPrev').on('click',mobtabPrevChapter);          
    }
    function nextpreviousQuestion(){
    	
    	$(".Questions").empty();
    	/*window.location.href="UserTrainingAnswer.php?questionId="+this.id;*/
    	var problem_container = $(".Questions");
    	
		var puzzle = document.createElement("div");
		puzzle.id="puzzle";
		puzzle.innerHTML = "<h3>PUZZLE";
		problem_container[0].appendChild(puzzle);
		
    	var chessboard = document.createElement("div"); 
        chessboard.id = "board";
        problem_container[0].appendChild(chessboard);
        /*loadChessBoard(this.id);*/
       /*currentQuestionId=this.id;*/
       loadChessBoard();
       loadNextPrevTab();
       
       $('#tabNext').on('click',tabNextChapter);
       $('#tabPrev').on('click',tabPrevChapter);          
    }
    function SlideFunction()
        {
        	$(".Questions").empty();
            if (click) {
                $('.chapter-bar').animate({
                    "margin-left" : '51%'
                })
                click = 0;
            } else {
                $('.chapter-bar').animate({
                    "margin-left" : '0%'
                })
                click=1;
            }
        }
        
    function LevelSlideFunction()
        {
        	$(".Questions").empty();
            if (click1) {
                $('.level-bar').animate({
                    "margin-left" : '-100%'
                })
                click1 = 0;
            } else {
                $('.level-bar').animate({
                    "margin-left" : '0%'
                })
                click1=1;
            }
        }
    function GenChapter(id)
        {
        	$( ".levelDialogueDisplay" ).dialog( "close" );
        	currentLevel=this.id;
        	
        	var problem_container = $(".chapter-bar");
		var Chaptertxt = document.createElement("div");
		Chaptertxt.id="chaptertxt";
		Chaptertxt.innerHTML = "Chapters";
		problem_container[0].appendChild(Chaptertxt);
				
				$('.chapter-bar').append("<ul class='Chapter'></ul>");
/*
				for (var cnt = 1; cnt <= 4; cnt++) 
		    	{
		          $('.Chapter').append("<li><h4>Chapter"+cnt+"</h4><div></div></li>");
		          $('.Chapter').append("<ul class='SubChapter'></ul>");
		    	  for (var cnt1 = 1; cnt1 <= 2; cnt1++) 
		    		{
		          $('.SubChapter').append("<li><h6>Sub Chapter"+cnt1+"</h6></li>");
		         }
		    	}
		    	$('.Chapter>li').on('click',chapterClick);*/
				
				levelId=currentLevel;
				$.ajax({url:"config/RetriveChapter.php",data:{LevelId:levelId}}).done(function(data)
				{
	          	console.log(typeof data);
	          	
	          	var chapterarray = data.split(" ");
	          		for (var cnt=0;cnt<chapterarray.length-1;cnt++)
	          		{
		          		$('.Chapter').append("<li><h4>"+chapterarray[cnt]+"</h4><div></div></li>");
			         	chapterId=chapterarray[cnt];
			         	$('.Chapter').append("<ul class='SubChapter sub"+cnt+"'></ul>");
			         	
			         	$.ajax({url:"config/RetriveSubChapter.php",data:{ChapterId:chapterId,LevelId:levelId},async:false}).done(function(data)
			         	{
			         		console.log(typeof data);
	          				var subchapterarray = data.split(" ");
	          				for (var cnt1=0;cnt1<subchapterarray.length-1;cnt1++)
	          				{
	          					$('.sub'+cnt).append("<li><h6>"+subchapterarray[cnt1]+"</h6></li>");
	          					
	          					/*Question Generation*/
/*
	          					subchapterId=subchapterarray[cnt1];
	          					$.ajax({url:"config/RetriveQuestions.php",data:{SubchapterId:subchapterId,ChapterId:chapterId,LevelId:levelId},async:false}).done(function(data)
	          					{
	          						console.log(typeof data);
	          						var questionsarray = data.split(" ");
	          						$('.sub'+cnt).on('click',genDivs(questionsarray,questionsarray.length));
	          					})*/

	          				}
			         	})
			         	
					}
					
					$('.Chapter>li').on('click',chapterClick);
					$('.SubChapter>li').on('click',genDivs);
										
	          })	  
        }
        
        function MobGenChapter(id)
        {
        	
        	$(".chapter-bar").empty();
        	LevelSlideFunction();
        	SlideFunction();
        	currentLevel=$(this).children('h4').text();
        	
        	var problem_container = $(".chapter-bar");
        	var Chaptertxt = document.createElement("div");
		Chaptertxt.id="chaptertxt";
		Chaptertxt.innerHTML = "Chapters";
		problem_container[0].appendChild(Chaptertxt);
		
				$('.chapter-bar').append("<ul class='Chapter'></ul>");
/*
				for (var cnt = 1; cnt <= 4; cnt++) 
		    	{
		          $('.Chapter').append("<li><h4>Chapter"+cnt+"</h4><div></div></li>");
		          $('.Chapter').append("<ul class='SubChapter'></ul>");
		    	  for (var cnt1 = 1; cnt1 <= 2; cnt1++) 
		    		{
		          $('.SubChapter').append("<li><h6>Sub Chapter"+cnt1+"</h6></li>");
		         }
		    	}
		    	$('.Chapter>li').on('click',chapterClick);*/
				
				levelId=currentLevel;
				$.ajax({url:"config/RetriveChapter.php",data:{LevelId:levelId}}).done(function(data)
				{
	          	console.log(typeof data);
	          	
	          	var chapterarray = data.split(" ");
	          		for (var cnt=0;cnt<chapterarray.length-1;cnt++)
	          		{
		          		$('.Chapter').append("<li><h4>"+chapterarray[cnt]+"</h4><div></div></li>");
			         	chapterId=chapterarray[cnt];
			         	$('.Chapter').append("<ul class='SubChapter sub"+cnt+"'></ul>");
			         	
			         	$.ajax({url:"config/RetriveSubChapter.php",data:{ChapterId:chapterId,LevelId:levelId},async:false}).done(function(data)
			         	{
			         		console.log(typeof data);
	          				var subchapterarray = data.split(" ");
	          				for (var cnt1=0;cnt1<subchapterarray.length-1;cnt1++)
	          				{
	          					$('.sub'+cnt).append("<li><h6>"+subchapterarray[cnt1]+"</h6></li>");
	          					
	          					/*Question Generation*/
/*
	          					subchapterId=subchapterarray[cnt1];
	          					$.ajax({url:"config/RetriveQuestions.php",data:{SubchapterId:subchapterId,ChapterId:chapterId,LevelId:levelId},async:false}).done(function(data)
	          					{
	          						console.log(typeof data);
	          						var questionsarray = data.split(" ");
	          						$('.sub'+cnt).on('click',genDivs(questionsarray,questionsarray.length));
	          					})*/

	          				}
			         	})
			         	
					}
					
					
					$('.Chapter>li').on('click',chapterClick);
					$('.SubChapter>li').on('click',MobgenDivs);
					$('#Slide').on('click',SlideFunction);
							
	          })	  
        }

