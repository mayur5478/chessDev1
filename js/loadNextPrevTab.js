     function loadNextPrevTab(){
	/*
           Next And Previous Tab Generation
       */
      $.ajax({url:"config/RetriveQuestionsNumber.php",data:{SubchapterId:subchapterId,ChapterId:currentChapter,LevelId:currentLevel,CurrentQuestionId:currentQuestionId},async:false}).done(function(data)
     	{
     		console.log(typeof data);
     		
     		var tabNextPrevDiv = $(".Questions");
	       var tabNextPrev = document.createElement("div");
		   tabNextPrev.id="tabNextPrev";	   	   
		   tabNextPrevDiv[0].appendChild(tabNextPrev);
		   
		   var tabPrevTextDiv = $("#tabNextPrev");
	       var tabPrevText = document.createElement("div");
		   tabPrevText.id="tabPrevText";	   	   	   
		   tabPrevTextDiv[0].appendChild(tabPrevText);
		   
		   var tabPrevDiv = $("#tabPrevText");
	       var tabPrev = document.createElement("div");
		   tabPrev.id="tabPrev";	   	   
		   tabPrevDiv[0].appendChild(tabPrev);
		   var tabPrevText1Div = $("#tabPrevText");
	       var tabPrevText1 = document.createElement("div");
		   tabPrevText1.innerHTML = "Prev";
		   tabPrevText1.id="tabPrevText1";
		   tabPrevText1Div[0].appendChild(tabPrevText1);
		   
		   var tabQuestionTextDiv = $("#tabNextPrev");
	       var tabQuestionText = document.createElement("div");
		   tabQuestionText.id="tabQuestionText";
		   tabQuestionText.innerHTML =data;
		   tabQuestionTextDiv[0].appendChild(tabQuestionText);
		   
		   var tabNextTextDiv = $("#tabNextPrev");
	       var tabNextText = document.createElement("div");
		   tabNextText.id="tabNextText";	   	   
		   tabNextTextDiv[0].appendChild(tabNextText);
		   
		   var tabNextText1Div = $("#tabNextText");
	       var tabNextText1 = document.createElement("div");
		   tabNextText1.innerHTML = "Next";
		   tabNextText1.id="tabNextText1";
		   tabNextText1Div[0].appendChild(tabNextText1);
		   var tabNextDiv = $("#tabNextText");
	       var tabNext = document.createElement("div");
		   tabNext.id="tabNext";	   	   
		   tabNextDiv[0].appendChild(tabNext);
     	}
     	)
      
       
}