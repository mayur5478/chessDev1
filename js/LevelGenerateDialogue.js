function LevelGenerateDialogue(){
			var levelDialogBox = document.createElement("div"); 
			levelDialogBox.className = "levelDialogueDisplay";
			document.body.appendChild(levelDialogBox);
	
	$.ajax({url:"config/RetriveLevel.php",data:{LevelId:currentLevel}}).done(function(data)
				{
	          	console.log(typeof data);
	          	
	          	var levelarray = data.split(" ");
	          		for (var cnt=1;cnt<=levelarray.length-1;cnt++)
	          		{
		          			var cell = document.createElement("div"); 
							cell.id =  levelarray[cnt-1];
							$(cell).bind("click",GenChapter);
							cell.innerText = levelarray[cnt-1];
							$('.levelDialogueDisplay').append(cell);
			         }
			     });   
	$(".levelDialogueDisplay").dialog({modal:true, width:1000, height:600,resizable: true});
}