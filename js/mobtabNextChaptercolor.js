function mobtabNextChaptercolor()
{
	if(currentQuestionId<numberofquestions-1)
	{
		$('#tabNextText1').animate({
                    color : "rgb( 255, 255, 255)"        
        })
        $('#tabNext').animate({
                    color : "rgb( 255, 255, 255)"        
        })
		
	}
	else
	{
		$('#tabNextText1').animate({
                    color : "rgb( 128, 128, 128 )"        
        })
        $('#tabNext').animate({
                    color : "rgb( 128, 128, 128 )"        
        })
	}
}