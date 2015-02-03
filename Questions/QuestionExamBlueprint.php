<?php
/**
 * User: Jon
 * Date: 10/08/2014
 * Time: 17:53
 */

namespace Monkey\Questions;


use Monkey\Questions\Models\Exam;

class QuestionExamBlueprint {

	protected $exam;
	protected $questions;

	/**
	 * @param Exam $exam
	 */
	public function __construct(Exam $exam)
	{
		$this->exam = $exam;
	}

	/**
	 * Build an exam!
	 *
	 * @param $callback
	 * @return mixed
	 */
	public static function create($callback)
	{
		$exam = new static(new Exam);

		$callback($exam);

		return $exam->save();
	}

	/**
	 * Performs the actions required for saving the unit.
	 */
	protected function save()
	{
		foreach ($this->questions as $question)
		{
			
		}
	}

	/**
	 * @param $questionId
	 * @internal param $question
	 */
	public function addQuestion(int $questionId)
	{
		array_push($this->questions, $questionId);
	}

} 