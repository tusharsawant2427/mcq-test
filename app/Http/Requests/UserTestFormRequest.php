<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserTestFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question.*' => 'required'
        ];
    }

    public function getUserTestResultData()
    {
        $userTestResult['user_id'] = Auth::user()->id;
        $userTestResult['total_questions'] = count($this->question);
        $userTestResult['difficulty'] = 'easy';
        return $userTestResult;
    }

    public function getUserAttendedQuestions()
    {
        $userAttendQuestions = [];
        foreach ($this->question as $key => $question) {
            $userAttendQuestions[$key]['question'] = $question['q'];
            $userAttendQuestions[$key]['selected_ans'] = $question['a'];
            if (!empty($question['option'])) {
                $userAttendQuestions[$key]['correct_ans'] = $question['option'];
            }
            $userAttendQuestions[$key]['type'] = $question['type'];
            $is_correct = 0;
            if (!empty($question['option'])) {
                $is_correct = (strtolower($question['option']) == strtolower($question['a'])) ? 1 : 0;
            }
            $userAttendQuestions[$key]['is_correct'] = $is_correct;
        }
        return $userAttendQuestions;
    }
}
