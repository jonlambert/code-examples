<?php namespace Monkey\Questions\Commands;


use Monkey\Questions\Models\UserAnswer;

class AnswerQuestionCommandHandler {

	public function __construct()
	{

	}

	public function handle(AnswerQuestionCommand $command)
	{
		$userAnswer = new UserAnswer;

		$userAnswer->user_id = $command->user->id;
		$userAnswer->question_id = $command->question->id;
		$userAnswer->answer_id = $command->answer->id;

		if ( $command->exam )
		{
			$userAnswer->exam_id = $command->exam->id;
		}

		if ( $command->elapsedTime )
		{
			$userAnswer->elapsed_time = $command->elapsedTime;
		}

		return $userAnswer->save();
	}
} 