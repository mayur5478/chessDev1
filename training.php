<!DOCTYPE HTML>
<html>
	<head>
		<title>Chess</title>
		<?php include 'config/library.php' ;?>
		<style>
		
		</style>
	
	<script>
	var currentChapter;
	var currentLevel;
	var subchapterId;
	var currentQuestionId;
	var numberofquestions;
	var click = 1;
	var click1 = 1;
	</script>
				
	
	<script src="js/GenerateChapSubChapQuestionDiv.js"></script>
	<script src="js/LevelGenerateDialogue.js"></script>
	<script src="js/MobileLevelGenerateDialogue.js"></script>
	
	
  	<!--<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>-->
   	<script src="js/UserTrainingAnswer.js"></script>	
   	
   	
   	
	</head>
		
	<body style="margin: 0px">
		<section class="training">
			<!--<input type="button" onclick="GenChapter(1)" value="click me">-->
			
			<div class="chapter-question">
				<div class="chapterbox">					
					<div class="chapter-bar">
						<!--<h3 style="margin:4%; color:white; text-align: center">Menu</h3>-->
						
								<!--
								<ul class="Chapter">
										<li><h4>Chapter 1</h4><div></div></li>
										<ul class="SubChapter">																		
										<li onclick="genDivs(60)"><h6>Sub Chapter1</h6></li>
										<li><h6>Sub Chapter2</h6></li>
										<li><h6>Sub Chapter3</h6></li>									
									</ul>														
							<li><h4>Chapter 2</h4><div></div></li>
							<li><h4>Chapter 3</h4><div></div></li>
							<li><h4>Chapter 4</h4><div></div></li>
								</ul>-->
								
						
						
					</div>
					<div class="Questions">
							<!--<h1 style="color:white; text-align: center">Puzzles</h1>-->		
					</div>
									
				</div>	
			</div>
		</section>	
	
		
	<!--<?php include 'training/training_main.php' ;?>--> 
	</body>
	<script type="text/javascript">
   	if (screen.width > 700) {
   		LevelGenerateDialogue();
   	}
   	else
   	{
   		MobileLevelGenerateDialogue();
   	}	
   	</script>
</html>