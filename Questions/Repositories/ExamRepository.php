<?php  namespace Monkey\Questions\Repositories;
use Monkey\Questions\Models\Exam;

/**
 * User: Jon
 * Date: 19/08/2014
 * Time: 12:54
 */


class ExamRepository {
	public function all()
	{
		return Exam::all();
	}

	public function find($examId)
	{
		return Exam::find($examId);
	}
}