<?php

namespace App\Http\Controllers;
use Auth;

use App\ProtectedUrl;
use App\Survey;
use App\Answer;
use App\QuestionCategory;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class SurveyController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth', ['except' => ['show_protected_survey']]);
  }

  public function home(Request $request) 
  {
    $surveys = Survey::get();
    return view('home', compact('surveys'));
  }

  # Show page to create new survey
  public function new_survey() 
  {
    return view('survey.new');
  }

  public function create(Request $request, Survey $survey) 
  {
    $arr = $request->all();
    $arr['user_id'] = Auth::id();

    $surveyItem = $survey->create($arr);

    $protectedUrl = new ProtectedUrl();

    $protectedUrl->survey_id = $surveyItem->id;
    $protectedUrl->url = md5(time());

    $protectedUrl->save();

    return Redirect::to("/survey/{$surveyItem->id}");
  }

  # retrieve detail page and add questions here
  public function detail_survey(Survey $survey) 
  {
	$data = [];
    $survey->load('questions.user');
   
    if ($survey->protected_urls->first() !== null) {
        $data['url'] = $survey->protected_urls->first();
    }
    $data['survey'] = $survey;
    return view('survey.detail', $data);
  }

  public function get_question_categories()
  {
      return response()->json(['categories' => QuestionCategory::all()]);
  }
  public function edit(Survey $survey) 
  {
    return view('survey.edit', compact('survey'));
  }

  # edit survey
  public function update(Request $request, Survey $survey) 
  {
    $survey->update($request->only(['title', 'description']));
    return redirect()->action('SurveyController@detail_survey', [$survey->id]);
  }

  # view survey publicly and complete survey
  public function view_survey(Survey $survey) 
  { 
    $survey->option_name = unserialize($survey->option_name);
    return view('survey.view', compact('survey'));
  }

  /**
   * Toon antwoorden van vragen lijsten
   * @param Survey $survey
   */
  public function view_survey_answers(Survey $survey) 
  {
    $survey->load('user.questions.answers');

    $all = [];
    foreach($survey->questions as $question) {
        foreach($question->answers as $answer) {
          $all[$answer->answer] = $survey->answers->where("answer", $answer->answer)->count();
        }
    }

    $data = [];
    foreach($survey->questions as $question) {
        foreach($question->answers as $answer) {
          $data[$question->id][$question->title][$answer->answer] = $survey->answers->where("answer", $answer->answer)->where("question_id", $question->id)->count();
        }
    }
    return view('answer.view', ['survey'=> $survey, "data" => $data, "all" => $all]);
  }

 //link voor de leraren aanmaken
  public function show_protected_survey($hash)
  {
      $survey = ProtectedUrl::where('url', $hash)->first()->survey;
      $survey->load('questions.user');
      $url = $survey->protected_urls->first();
      return view('survey.view', ['survey' => $survey, 'url' => $url]);

  }
    // TODO: Make sure user deleting survey
    // has authority to

  public function export_answers(Question $question)
  {
    $filename = "file.csv";
    $data = [];
    foreach($question->answers as $answer) {
        $data[$answer->answer] = $question->answers->where("answer", $answer->answer)->where("question_id", $question->id)->count();
    }
  
    ob_start();
    $handle = fopen($filename, 'w+');
    fputcsv($handle, [$question->title]);
    foreach ($data as $answer => $row) {
       fputcsv($handle, [$answer, $row]);
    }
    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );

    return response()->download($filename, $question->title . ' '.date("d-m-Y H:i").'.csv', $headers);
} 


 public function delete_survey(Survey $survey)
  {
    $survey->delete();
    return redirect('');
  }

}
