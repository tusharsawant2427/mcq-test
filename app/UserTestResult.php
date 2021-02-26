<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTestResult extends Model
{
    protected $fillable = [ 'user_id', 'total_questions', 'total_questions_attend','total_questions_ans', 'difficulty'];

    public function TotalAttendQuestions(){
        return $this->hasMany(UserAttendQuestion::class);
    }
}
