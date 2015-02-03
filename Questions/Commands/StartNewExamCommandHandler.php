<?php  namespace Monkey\Questions\Commands;

use Monkey\Questions\Models\Exam;
use Monkey\Questions\Models\Question;

class StartNewExamCommandHandler {

	/**
	 * @param StartNewExamCommand $command
	 * @return \Illuminate\Database\Eloquent\Model|static
	 */
	public function handle(StartNewExamCommand $command)
	{
		$exam = new Exam();

		$exam->user_id = $command->user->id;
		$exam->setType($command->type);
		$exam->category_id = ($command->category) ? $command->category->id : NULL;

		$exam->save();

		// If we have less than one question defined, we need to generate more.
		if (count($command->questions) < 1)
		{
			for( $i=0; $i<(($command->numberOfQuestions)?$command->numberOfQuestions:20); $i++ )
			{
				print "Generating question...\n";
				$question = Question::all()->first();
				$exam->addQuestion($question);
			}
		}

		foreach ($command->questions as $question)
		{
			$exam->questions()->attach($question);
		}



		return $exam;
	}

} 