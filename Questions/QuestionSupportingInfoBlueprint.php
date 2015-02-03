<?php
/**
 * User: Jon
 * Date: 06/08/2014
 * Time: 21:19
 */

namespace Monkey\Questions;


use Monkey\Questions\Models\QuestionSupportingInfo;

class QuestionSupportingInfoBlueprint {

	/**
	 * @param $callback
	 */
	public static function create($callback)
	{
		$infoBlueprint = new QuestionSupportingInfoBlueprint;
		$callback($infoBlueprint);

		dd($infoBlueprint);
	}

} 