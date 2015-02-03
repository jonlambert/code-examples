<?php namespace Monkey\Questions\Commands;

use Monkey\Questions\Models\Answer;
use Monkey\Questions\Models\Exam;
use Monkey\Questions\Models\Question;
use Monkey\Users\User;

/**
 * Class AnswerQuestionCommand
 *
 * The command responsible for performing the actual answering of a question.
 *
 * @package Monkey\questions\Commands
 */
class AnswerQuestionCommand {

	/**
	 * @var
	 */
	public $user;
	/**
	 * @var
	 */
	public $question;
	/**
	 * @var
	 */
	public $answer;
	/**
	 * @var
	 */
	public $exam;

	public $elapsedTime;

	public function __construct($user, Question $question, Answer $answer, Exam $exam = null, $elapsedTime = null)
	{
		$this->user = $user;
		$this->question = $question;
		$this->answer = $answer;
		$this->exam = $exam;
		$this->elapsedTime = $elapsedTime;
	}

} 