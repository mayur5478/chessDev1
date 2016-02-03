function tabPrevChapterColor()
{
	if(currentQuestionId==1)
	{
		$('#tabPrevText1').animate({
                    color : "rgb( 128, 128, 128 )"        
        })
        $('#tabPrev').animate({
                    color : "rgb( 128, 128, 128 )"        
        })
	}
	else
	{
		$('#tabPrevText1').animate({
                    color : "rgb( 255, 255, 255)"        
        })
        $('#tabPrev').animate({
                    color : "rgb( 255, 255, 255)"        
        })
	}
}
