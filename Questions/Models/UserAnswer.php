<?php  namespace Monkey\Questions\Models;
use Eloquent;

/**
 * User: Jon
 * Date: 17/08/2014
 * Time: 19:59
 */


class UserAnswer extends Eloquent {

	protected $table = 'user_answers';

	public function answer()
	{
		return $this->hasOne('Monkey\Questions\Models\Answer', 'answer_id');
	}

	public function question()
	{
		return $this->hasOne('Monkey\Questions\Models\Question', 'question_id');
	}

	public function user()
	{
		return $this->belongsTo('Monkey\Users\User', 'user_id');
	}

} 