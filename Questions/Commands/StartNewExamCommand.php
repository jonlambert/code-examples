<?php namespace Monkey\Questions\Commands;
use Monkey\Questions\Models\QuestionCategory;
use Monkey\Users\User;

/**
 * Class StartNewExamCommand
 *
 * Begin a new exam.
 *
 * @package Monkey\Questions\Commands
 */
class StartNewExamCommand {
	/**
	 * @var User
	 */
	public $user;
	/**
	 * @var The
	 */
	public $type;
	/**
	 * @var QuestionCategory
	 */
	public $category;
	/**
	 * @var array
	 */
	public $questions;
	/**
	 * @var int
	 */
	public $numberOfQuestions;


	/**
	 * @param User $user
	 * @param $type int type of exam.
	 * @param QuestionCategory $category
	 * @param array $questions
	 * @param null $numberOfQuestions
	 */
	function __construct(User $user, $type, QuestionCategory $category = null, array $questions = array(), $numberOfQuestions = null)
	{
		$this->user = $user;
		$this->type = $type;
		$this->category = $category;
		$this->questions = $questions;
		$this->numberOfQuestions = $numberOfQuestions;
	}
}