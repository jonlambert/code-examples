<?php
/**
 * User: Jon
 * Date: 06/08/2014
 * Time: 19:41
 */

namespace Monkey\Questions\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;

class QuestionCategory extends Eloquent {
	protected $table = "question_categories";

	protected $fillable = ['title', 'slug'];
} 