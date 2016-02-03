	function chapterClick(){
		currentChapter=$(this).children('h4').text();
		var Menu = $(this).next('ul');
		var CurrentArrow = $(this).find('div');
		var AllArrow = $('.Chapter').find('div');
		var AllMenu = $('.Chapter').find('ul');
		if (CurrentArrow.hasClass('ChapterArrowRotate')) 
		{
			Menu.removeClass('SubChapterOpen');
			CurrentArrow.removeClass('ChapterArrowRotate');
		}
		else 
		{			
				if(AllArrow.hasClass('ChapterArrowRotate'))
				{
					AllArrow.removeClass('ChapterArrowRotate');
					AllMenu.removeClass('SubChapterOpen');									
				}
				Menu.addClass('SubChapterOpen');
				CurrentArrow.addClass('ChapterArrowRotate');							
		}
	}
