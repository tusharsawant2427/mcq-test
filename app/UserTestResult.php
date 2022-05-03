<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class UserTestResult extends Model
{
    protected $fillable = [ 'user_id', 'total_questions', 'total_questions_attend','total_questions_ans', 'difficulty'];

    public function userAttendQuestions()
    {
        return $this->hasMany(UserAttendQuestion::class);
    }

    public static function storeUserTestResult(array $userTestData)
    {
        return UserTestResult::create($userTestData);
    }

    public function updateUserAttendQuestionAnsCount()
    {
        $totalAttendQuestions=$this->userAttendQuestions()->whereNotNull('correct_ans')->count();
        $totalCorrectQuestions=$this->userAttendQuestions()->where('is_correct',1)->count();
        $this->total_questions_attend=$totalAttendQuestions;
        $this->total_questions_ans=$totalCorrectQuestions;
        return $this->save();
    }

    public function totalQuestionsCount()
    {
        return $this->userAttendQuestions()->count();
    }

    public function totalWrongQuestionsCount()
    {
        return $this->userAttendQuestions()->whereNotNull('correct_ans')->count();
    }

    public function totalCorrectQuestionsCount()
    {
        return $this->userAttendQuestions()->where('is_correct',1)->count();
    }
}
