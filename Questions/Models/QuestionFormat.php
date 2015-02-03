<?php
/**
 * User: Jon
 * Date: 08/08/2014
 * Time: 12:25
 */

namespace Monkey\Questions\Models;


use Eloquent;

class QuestionFormat extends Eloquent {
	protected $fillable = ['title', 'description', 'question_category_id'];
	
} 