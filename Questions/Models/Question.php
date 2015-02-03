<?php
/**
 * User: Jon
 * Date: 06/08/2014
 * Time: 17:37
 */

namespace Monkey\Questions\Models;


use DB;
use Eloquent;

class Question extends Eloquent {

	protected $appends = ['answers', 'correctAnswer', 'questionCategory', 'supportingInfoBody'];

	function __construct()
	{

	}

	public function getVariable($key)
	{
		return DB::table('question_supporting_info_variables')
			->where('key', '=', $key)
			->where('question_id', '=', $this->id)
			->first();
	}

	public function setVariable($key, $value)
	{
		if ( $this->getVariable($key) )
		{
			return DB::table('question_supporting_info_variables')
				->where('question_id', '=', $this->id)
				->where('key', '=', $key)
				->update([
					'value' => $value
				]);
		}

		return DB::table('question_supporting_info_variables')->insert([
			'question_id' => $this->id,
			'key' => $key,
			'value' => $value
		]);
	}

	public function answers()
	{
		return $this->hasMany('Monkey\Questions\Models\Answer');
	}

	public function correctAnswer()
	{
		return $this->belongsTo('Monkey\Questions\Models\Answer');
	}

	public function questionCategory()
	{
		return $this->belongsTo('Monkey\Questions\Models\QuestionCategory');
	}

	public function questionFormat()
	{
		return $this->belongsTo('Monkey\Questions\Models\QuestionFormat');
	}

	public function getAnswersAttribute()
	{
		return $this->answers()->get();
	}

	public function getCorrectAnswerAttribute()
	{
		return $this->correctAnswer()->get();
	}

	public function getQuestionCategoryAttribute()
	{
		return $this->questionCategory()->first();
	}

	public function getSupportingInfoBodyAttribute()
	{
		return $this->getSupportingInfoBody();
	}

	public function delete()
	{
		DB::table('question_supporting_info_variables')
			->where('question_id', '=', $this->id)
			->delete();

		return parent::delete();
	}

	public function getSupportingInfoBody()
	{
		if ($this->supporting_info_html)
			return $this->supporting_info_html;

		$supportingInfo = QuestionSupportingInfo::find($this->supporting_info_type);

		if ( ! $supportingInfo)
			return null;

		$supportingInfo = $supportingInfo->first();

		$supportingInfoVariables = DB::table('question_supporting_info_variables')
			->where('question_id', '=', $this->id)
			->get();

		foreach ($supportingInfoVariables as $variable)
		{
			$supportingInfo->body = str_replace("[" . $variable->key . "]", $variable->value, $supportingInfo->body);
		}

		return $supportingInfo->body;
	}

} 