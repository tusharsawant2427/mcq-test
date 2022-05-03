<?php

namespace App\Http\Controllers;

use App\Http\Services\UserTestService;
use Illuminate\Http\Request;
use App\Http\Requests\UserTestFormRequest;
use Exception;
use Redirect;

class UserTestController extends Controller
{

    public $userTestService;

    public function __construct()
    {
        $this->userTestService = new UserTestService();
    }

    public function create()
    {
        $data = $this->userTestService->getMcqTestQuestions();
        return view('questions', $data);
    }

    public function store(UserTestFormRequest $request)
    {
        try {
            $userTestResult =  $request->getUserTestResultData();
            $userAttendedQuestions =  $request->getUserAttendedQuestions();
            $userTestResult = $this->userTestService->storeUserTestResultWithAttendedQuestion($userTestResult, $userAttendedQuestions);
            return Redirect::route('thank-you', [$userTestResult->id]);
        } catch (Exception $ex) {
            return Redirect::back()->withErrors([$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
