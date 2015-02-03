<?php
/**
 * User: Jon
 * Date: 10/08/2014
 * Time: 17:58
 */

namespace Monkey\Questions\Models;


use Eloquent;

class Exam extends Eloquent {

	protected $appends = ['user', 'questions'];

	public function user()
	{
		return $this->belongsTo("Monkey\Users\User");
	}

	public function getUserAttribute()
	{
		return $this->user()->first();
	}

	public function getQuestionsAttribute()
	{
		return $this->questions()->get();
	}

	public function questions()
	{
		return $this->belongsToMany('Monkey\Questions\Models\Question', 'exams_questions');
	}

	/**
	 * Gets the answers submitted by the user taking this exam.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getAnswers()
	{
		return UserAnswer::where('exam_id', '=', $this->id)->get();
	}

	public function setType($type)
	{
		$this->exam_type = $type;
	}

	public function addQuestion(Question $question)
	{
		$this->questions()->attach($question);
	}

} 