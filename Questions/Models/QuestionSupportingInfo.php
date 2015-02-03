<?php
/**
 * User: Jon
 * Date: 06/08/2014
 * Time: 21:21
 */

namespace Monkey\Questions\Models;


use Eloquent;

class QuestionSupportingInfo extends Eloquent {
	protected $table = "question_supporting_info";

	protected $fillable = ['slug', 'title', 'description', 'body'];


} 