<?php

namespace App\Http\Services;

use App\UserAttendQuestion;
use App\UserTestResult;

class UserTestService
{
    public const QUESTION_API_ENDPOINT = "https://opentdb.com/api.php?amount=10";
    public const NUMBER_OF_QUESTION = 10;

    public function getMcqTestQuestions(): array
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', self::QUESTION_API_ENDPOINT, ['query' => [
            'amount' => self::NUMBER_OF_QUESTION,
        ]]);

        $data['statusCode'] = $response->getStatusCode();
        $data['questions'] = json_decode($response->getBody(), true);
        return $data;
    }

    public function storeUserTestResultWithAttendedQuestion($userTestResult, $userAttendedQuestions)
    {
        $userTestResult = UserTestResult::storeUserTestResult($userTestResult);
        $userAttendQuestion = $this->storeAttendedQuestion($userTestResult, $userAttendedQuestions);
        $userTestResult->updateUserAttendQuestionAnsCount();
        return $userTestResult;
    }

    public function storeAttendedQuestion(UserTestResult $userTestResult, $userAttendedQuestions)
    {
        foreach ($userAttendedQuestions as $userAttendedQuestion) {
            UserAttendQuestion::storeUserAttendQuestion($userTestResult, $userAttendedQuestion);
        }
        return $userTestResult->userAttendQuestions;
    }
}
