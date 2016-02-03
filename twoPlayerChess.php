<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="description" content="">
        
        <link rel="stylesheet" media="screen and (max-width: 1365px)" href="css/mobile.css" />
        <link rel="stylesheet" media="screen and (min-width: 1366px)" href="css/main.css" />
        <link rel="stylesheet"  href="css/bootstrap-theme.css" />
        <link rel="stylesheet"  href="css/bootstrap.css" />
        <link rel="stylesheet"  href="css/chessboard-0.3.0.css" />
        <link rel="stylesheet"  href="js/jquery-ui-1.11.4/jquery-ui.min.css" />
        
		<script src="js/jquery-1.11.2.min.js"> </script>
		<script src="js/jquery.validate.min.js"> </script>
        <script src="js/chess.js"> </script>
		<script src="js/chessboard-0.3.0.js"> </script>
    <script src="js/bootstrap.min.js"> </script>
    <script src="js/jquery-ui-1.11.4/jquery-ui.min.js"> </script>
        
        <title>New Web Project</title>
    </head>
    <body>
    	
    	<header>
        <div class="siteNameWrapper" style="background-color:#4a628e;color:white;text-align:center;padding-top:10px;height:60px;">
          <span style="height:80px;font-size:30px;float:left;padding-left:20px;">ChessWay</span>
          <span id="userNameSpan" style="height:80px;font-size:20px;float:right;padding-right:20px;"></span>
        </div>
      </header>
    	<section id="board" style="width:450px;
    	margin:0 auto;margin-top:30px;box-shadow: 1px 2px 1px 3px #502900;">

		</section>
    	<section class="buttonPanel">
    		<button class="btn btn-default buttonPanelButtons" data-toggle="confirmation">Draw Game</button>
    		<button class="btn btn-default buttonPanelButtons" data-toggle="confirmation">Resign</button>
    	   <button class="btn btn-default buttonPanelButtons" data-toggle="confirmation"`>Quit Game</button>
       </section>
      <div class="player1">
        <span class="player1Name" style="font-size:35px">Player1</span><br>
        <span class="player1Color" style="font-size:20px">White</span> 
      </div>
      
      <div class="player2">
        <span class="player2Name" style="font-size:35px">Player2</span><br>
        <span class="player2Color" style="font-size:20px">Black</span>
      </div>
       <div id="dialog-confirm"></div>
    </body>
</html>
<script>
$(document).ready(function(){
  var user1 = location.search.split('&&user2=')[0].split('user1=')[1],
      user2 = location.search.split('&&user2=')[1];
			 var loggedUserName = "<?php session_start();
       echo $_SESSION['loggedUserName']?>",
       lastModifiedTime=0;
       $('#userNameSpan').html("Welcome "+loggedUserName);
           $('.player1Name').html(user1);
           $('.player1').addClass('playerSelected');
           $('.player2Name').html(user2);
           $('.player2').addClass('playerNotSelected');
// do not pick up pieces if the game is over
// only pick up pieces for the side to move
var onDragStart = function(source, piece, position, orientation) {
  if (game.game_over() === true ||
      (game.turn() === 'w' && piece.search(/^b/) !== -1) ||
      (game.turn() === 'b' && piece.search(/^w/) !== -1) ||
      (game.turn() === 'w' && loggedUserName!== user1)   ||
      (game.turn() === 'b' && loggedUserName!== user2)) {
    return false;
  }
};

var onDrop = function(source, target) {
  // see if the move is legal
  var move = game.move({
    from: source,
    to: target,
    promotion: 'q' // NOTE: always promote to a queen for example simplicity
  });

  // illegal move
  if (move === null) return 'snapback';

  if(game.turn() === 'b'){
    $('.player2').addClass('playerSelected').removeClass('playerNotSelected');
    $('.player1').addClass('playerNotSelected').removeClass('playerSelected');
  }
  else{
      $('.player1').addClass('playerSelected').removeClass('playerNotSelected');
    $('.player2').addClass('playerNotSelected').removeClass('playerSelected');
  }

  if(game.turn() === 'b' && loggedUserName=== user1){
      $.ajax({
          url:"config/move.php",
          data:{userName:user2,source:source,target:target}
      });
  }
  else{
    if(game.turn() === 'w' && loggedUserName=== user2){
    
      $.ajax({
          url:"config/move.php",
          data:{userName:user1,source:source,target:target}
      });
  }
  updateStatus();
  }
};

// update the board position after the piece snap 
// for castling, en passant, pawn promotion
var onSnapEnd = function() {
    board.position(game.fen());
};

var updateStatus = function() {
  var status = '';

  var moveColor = 'White';
  if (game.turn() === 'b') {
    moveColor = 'Black';
  }

  // checkmate?
  if (game.in_checkmate() === true) {
    status = 'Game over, ' + moveColor + ' is in checkmate.';
    $("#dialog-confirm").html(status);
     $("#dialog-confirm").dialog({
        resizable: false,
        modal: true,
        title: "Checkmate",
        height: 200,
        width: 400,
        buttons: {
            "Ok": function () {
                $(this).dialog('close');
            }
        }
    });
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

 };
  var cfg   = {
                draggable: true,
                onDrop : onDrop,
                position:'start',
                onDragStart: onDragStart,
                  onSnapEnd: onSnapEnd
                  }  ,
                  board = new ChessBoard('board',cfg);
                 var fen = board.fen()+" w"+" -"+" -"+" 0"+" 10";
                  game= new Chess(fen);
 updateStatus();
setInterval(checkIfFileIsModified,100);

$('.buttonPanelButtons').click(function(){
    var buttonValue = $(this).text();

    $("#dialog-confirm").html("Are you sure you want to "+buttonValue.toLowerCase()+" ?");
     $("#dialog-confirm").dialog({
        resizable: false,
        modal: true,
        title: "Confirm",
        height: 200,
        width: 400,
        buttons: {
            "Yes": function () {
                $(this).dialog('close');
                okClicked(buttonValue);
            },
                "No": function () {
                $(this).dialog('close');
            }
        }
    });
    
});

function okClicked(buttonValue){
   if(loggedUserName == user1){
     $.ajax({
          url:"config/move.php",
          data:{userName:user2,source:buttonValue,target:""}
      });
   }
   else if(loggedUserName == user2){
     $.ajax({
          url:"config/move.php",
          data:{userName:user1,source:buttonValue,target:""}
      });
   }
}

function checkIfFileIsModified(){
  $.ajax({
    url:'config/lastModified.php',
    data:{username:loggedUserName},
    success:function(newModifiedTime){
        if(newModifiedTime > lastModifiedTime){
          lastModifiedTime = newModifiedTime;
            $.ajax({
              url:'config/'+loggedUserName+'.txt',
              success:function(string){
                if(string!="")
                  {
                    var source = string.split(" ")[0];
                    var target = string.split(" ")[1];
                    board.move(source+'-'+target);
                    onDrop(source,target);
                  }
              }
            });
        }
    }
  });
}    		
});
</script>