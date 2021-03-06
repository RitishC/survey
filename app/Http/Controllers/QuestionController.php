<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
  
    public function store(Request $request, Survey $survey) 
    {
        $arr = $request->all();
        $arr['user_id'] = Auth::user()->id;

        $survey->questions()->create($arr);
        return back();
    }

    public function edit(Question $question) 
    {
     	return view('question.edit', compact('question'));
    }

    public function update(Request $request, Question $question) 
    {
      $question->update($request->all());
      return redirect()->action('SurveyController@detail_survey', [$question->survey_id]);
    }

        public function delete_question(Question $question)
    {
        $question->delete();
        return redirect()->back();
    }
}
