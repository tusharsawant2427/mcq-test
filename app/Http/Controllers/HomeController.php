<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserTestResult;
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

    public function Thankyou(Request $request, $id){

        $userTestResult=UserTestResult::findOrfail($id);
        $totalQuestionsCount=$userTestResult->totalQuestionsCount();
        $totalWrongQuestionsCount=$userTestResult->totalWrongQuestionsCount();
        $totalCorrectQuestionsCount=$userTestResult->totalCorrectQuestionsCount();
        return view('thank-you', compact('userTestResult','totalQuestionsCount','totalWrongQuestionsCount','totalCorrectQuestionsCount'));
    }

    public function Login(){
        return Redirect::route('user-test.create');
    }
}
