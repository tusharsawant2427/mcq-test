<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAttendQuestion extends Model
{
    protected $fillable = ['question', 'user_test_result_id', 'correct_ans', 'selected_ans', 'is_correct', 'type'];
}
