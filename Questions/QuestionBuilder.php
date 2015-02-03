<?php
/**
 * User: Jon
 * Date: 06/08/2014
 * Time: 17:41
 */

namespace Monkey\Questions;


use Monkey\Questions\Models\Answer;
use Monkey\Questions\Models\Question;
use Monkey\Questions\Models\QuestionCategory;

class QuestionBuilder {

	/**
	 * @var array Array of answers.
	 */
	public $answers = [];

	/**
	 * @var $correctAnswer The ID of the correct answer
	 */
	public $correctAnswer;

	/**
	 * @var Monkey\Questions\Models\Question The question Eloquent model.
	 */
	public $question;


	protected $supportingInfoVariables;

	/**
	 * @var string Markup for supporting info.
	 */
	protected $supportingInfoMarkup;
	protected $questionFormat;

	function __construct()
	{
		$question = new Question;
		$this->question = $question;
	}

	/**
	 * @param $callback
	 * @return Question|Monkey\Questions\Models\Question
	 */
	public static function create($callback)
	{
		$question = new QuestionBuilder;

		$callback($question);

		// Run the persisting process
		return $question->save();
	}


	/**
	 * Persists questions and answers.
	 */
	public function save()
	{
		// Persist the question so we have an ID
		$this->question->save();

		// Iterate through each question added
		foreach ($this->answers as $answer)
		{
			// Assign the ID of the question
			$answer->question_id = $this->question->id;

			// Persist the answer
			$answer->save();

			// If we are dealing with the correct answer
			if ($answer->is_correct)
			{
				// Now we have an ID, we can tell the question what the correct answer is
				$this->question->correct_answer_id = $answer->id;
				$this->question->save();
			}
		}

		if ($this->supportingInfoVariables)
		{
			foreach ($this->supportingInfoVariables as $variableKey => $variableValue)
			{
				$this->question->setVariable($variableKey, $variableValue);
			}
		}

		return $this->question;
	}

	/**
	 * Add an answer to the question
	 *
	 * @param $body
	 * @param bool $correct
	 */
	public function addAnswer($body, $correct = false)
	{
		$a = new Answer;
		$a->body = $body;
		$a->is_correct = $correct;

		array_push($this->answers, $a);
	}

	/**
	 * Set the question body
	 * @param $body
	 */
	public function setBody($body)
	{
		$this->question->body = $body;
	}

	public function setCategory(QuestionCategory $category)
	{
		$this->question->question_category_id = $category->id;
	}

	public function buildSupportingInfo($supportingInfo, $variables)
	{
		$this->question->supporting_info_type = $supportingInfo->id;

		$this->supportingInfoVariables = $variables;
	}

	public function setSupportingInfoMarkup($markup)
	{
		$this->supportingInfoMarkup = $markup;
		$this->question->supporting_info_html = $markup;
	}

	public function setFormat($questionFormat)
	{
		$this->question->question_format_id = $questionFormat->id;
	}

} 