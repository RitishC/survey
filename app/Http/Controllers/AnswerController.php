<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Survey;
use App\Answer;
use App\Http\Requests;


class AnswerController extends Controller
{
    public function store(Request $request, Survey $survey) 
    {
        // remove the token
        $arr       = $request->except(['_token', 'school']);
        $school_id = $request->input('school');

        foreach ($arr as $key => $value) {
            $newAnswer = new Answer();

            if (! is_array( $value )) {
                $newValue = $value['answer'];
            } else {
                $newValue = json_encode($value['answer']);
            }

            $newAnswer->answer      = $newValue;
            $newAnswer->question_id = $key;
            $newAnswer->user_id     = Auth::id();
            $newAnswer->survey_id   = $survey->id;
            $newAnswer->school_id   = $school_id;
            $newAnswer->save();

            $answerArray[] = $newAnswer;
        };

        return redirect()->action('SurveyController@thankyou_page');
    }
}
