<?php
/**
 * User: Jon
 * Date: 06/08/2014
 * Time: 17:37
 */

namespace Monkey\Questions\Models;

use Eloquent;

class Answer extends Eloquent {

	public function question()
	{
		return $this->belongsTo('Monkey\Questions\Models\Question');
	}

	public function user()
	{
		return $this->belongsTo('Monkey\Users\User');
	}
} 