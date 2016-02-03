function MobileLevelGenerateDialogue(){
/*
	currentLevel='level1';
	MobGenChapter(currentLevel);*/
    $(".Questions").empty();
	var problem_container = $(".chapter-question");
    	
		var level = document.createElement("div");
		level.className="level-bar";
		level.innerHTML = "<h3>Level";
		problem_container[0].appendChild(level);
		
	$('.level-bar').append("<ul class='Level'></ul>");

$.ajax({url:"config/RetriveLevel.php",data:{LevelId:currentLevel}}).done(function(data)
				{
	          	console.log(typeof data);
	          	
	          	var levelarray = data.split(" ");
	          		for (var cnt=0;cnt<levelarray.length-1;cnt++)
	          		{
		          		$('.Level').append("<li><h4>"+levelarray[cnt]+"</h4><div></div></li>");
			         	levelId=levelarray[cnt]; 
			         	       		
					}
					
					$('.Level>li').on('click',MobGenChapter);
				})
}