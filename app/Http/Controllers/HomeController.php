<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserAttendQuestion;
use App\UserTestResult;
use App\Http\Requests\UserAttendQuestionRequest;
use Auth;
use Redirect;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $endpoint = "https://opentdb.com/api.php?amount=10";
        $client = new \GuzzleHttp\Client();
        $amount = 10;
        $response = $client->request('GET', $endpoint, ['query' => [
            'amount' => $amount, 
        ]]);

        $statusCode = $response->getStatusCode();
        $questions = json_decode($response->getBody(), true);
        return view('questions',compact('statusCode','questions'));
    }

    public function store(UserAttendQuestionRequest $request)
    {
        $user_test_result=new UserTestResult;
        $user_test_result->user_id=Auth::user()->id;
        $user_test_result->total_questions=count($request->question);
        $user_test_result->difficulty='easy';
        if($user_test_result->save())
        {

            foreach($request->question as $key=>$question){
                
                $user_attend_questions=new UserAttendQuestion;
                $user_attend_questions->user_test_result_id=$user_test_result->id;
                $user_attend_questions->question=$question['q'];
                $user_attend_questions->selected_ans=$question['a'];

                if(!empty($question['option'])){
                    $user_attend_questions->correct_ans=$question['option'];
                }
                $user_attend_questions->type=$question['type'];
                $is_correct=0;
                if(!empty($question['option'])){
                    $is_correct=(strtolower($question['option'])==strtolower($question['a']))?1:0;
                }
                $user_attend_questions->is_correct=$is_correct;
                $user_attend_questions->save();
            }

            $total_attend_questions=$user_test_result->TotalAttendQuestions()->whereNotNull('correct_ans')->count();
            $total_correct_questions=$user_test_result->TotalAttendQuestions()->where('is_correct',1)->count();
            $user_test_result->total_questions_attend=$total_attend_questions;
            $user_test_result->total_questions_ans=$total_correct_questions;
            $user_test_result->save();

        }else{
            return Redirect::back()->withErrors(['Something went wrong while submitting result please try again']);
        }

        return Redirect::route('thank-you',[$user_test_result->id]);
    }

    public function Thankyou(Request $request, $id){

        $user_test_result=UserTestResult::findOrfail($id);
        $total_questions=$user_test_result->TotalAttendQuestions()->count();
        $total_attend_questions=$user_test_result->TotalAttendQuestions()->whereNotNull('correct_ans')->count();
        $total_correct_questions=$user_test_result->TotalAttendQuestions()->where('is_correct',1)->count();
        return view('thank-you', compact('user_test_result','total_questions','total_attend_questions','total_correct_questions'));
    }

    public function Login(){
        return Redirect::route('start_test');
    }
}
