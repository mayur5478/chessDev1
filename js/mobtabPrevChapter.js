function mobtabPrevChapter()
{
	if(currentQuestionId>1)
	{
		--currentQuestionId;
		mobnextpreviousQuestion();
	}
	mobtabPrevChaptercolor();
}
