<?php

namespace App\Http\Controllers;

use Auth;
use App\Survey;
use App\Answer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
//klasse van surveycontroller incl functies 
class SurveyController extends Controller
{
  //functie voor authoriseren
  public function __construct()
  {
    $this->middleware('auth');
  }
//functie voor homepagina 
  public function home(Request $request) 
  {
    $surveys = Survey::get();
    return view('home', compact('surveys'));
  }

  // pagina laten zien om nieuwe survey aan te maken
  public function new_survey() 
  {
    return view('survey.new');
  }
// functie voor aanmaken survey
  public function create(Request $request, Survey $survey) 
  {
    $arr = $request->all();
    // $request->all()['user_id'] = Auth::id();
    $arr['user_id'] = Auth::id();
    $surveyItem = $survey->create($arr);
    return Redirect::to("/survey/{$surveyItem->id}");
  }

  //details van survey pagina krijgen en mogelijkheid om vragen toe te voegen
  public function detail_survey(Survey $survey) 
  {
    $survey->load('questions.user');
    return view('survey.detail', compact('survey'));
  }
  
// funnctie voor pagina van wijzigen van survey
  public function edit(Survey $survey) 
  {
    return view('survey.edit', compact('survey'));
  }

  // wijzigen van survey
  public function update(Request $request, Survey $survey) 
  {
    $survey->update($request->only(['title', 'description']));
    return redirect()->action('SurveyController@detail_survey', [$survey->id]);
  }

  // laten zien van survey
  public function view_survey(Survey $survey) 
  { 
    $survey->option_name = unserialize($survey->option_name);
    return view('survey.view', compact('survey'));
  }

  // weergeven van survey atwoorden
  public function view_survey_answers(Survey $survey) 
  {
    $survey->load('user.questions.answers');
    return view('answer.view', compact('survey'));
  }
  //verwijderen van survey
  public function delete_survey(Survey $survey)
  {
    $survey->delete();
    return redirect('');
  }

}