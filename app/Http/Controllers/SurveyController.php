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
use Illuminate\Support\Facades\DB;
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

          // Get all questions
        foreach($survey->questions as $question) {
            foreach ($question->answers as $answer) {
              $data[$question->id][$question->title][$answer->answer] = $survey->answers->where("answer", $answer->answer)->where("question_id", $question->id)->count();
            }
        }

          // Get all categories
        foreach($survey->questions as $question) {
            foreach(QuestionCategory::all() as $category) {
                if ($question->question_category_id !== $category->id) {
                    continue;
                }

            foreach($question->answers as $answer) {
                $count = DB::table('answer')->leftJoin('question', 'question_id', '=', 'question.id')
                ->where('question.question_category_id', '=', $category->id)
                ->where('answer.answer', '=', $answer->answer)
                ->select('answer.id')->count();
                $data[$category->category_name][$category->category_name][$answer->answer] = $count;
            }
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
    public function export_answers($parameter)
    {
        $filename = "file.csv";

        if(null !== ($category = QuestionCategory::where('category_name', $parameter)->first())) {
            return $this->export_question_category($category, $filename);
        }

        $question = Question::find($parameter);
        return $this->export_question($question, $filename);
    }

    private function export_question_category(QuestionCategory $question_category, $filename)
    {
        $data = [];
        
        foreach($question_category->questions as $question) {
          $data[$question->title] = [];

            foreach ($question->answers as $answer) {
                if (isset($data[$question->title][$question->answer])) {
                    $data[$question->title][$answer->answer] += $question->answers->where("answer", $answer->answer)->where("question_id", $question->id)->count();
                } else {
                    $data[$question->title][$answer->answer] = $question->answers->where("answer", $answer->answer)->where("question_id", $question->id)->count();
                }
            }
        }

        ob_start();
        $handle = fopen($filename, 'w+');
        fputcsv($handle, [$question_category->category_name]);
        foreach($data as $title => $question) {
            fputcsv($handle, [$title]);

            foreach ($data[$title] as $answer => $row) {
                fputcsv($handle, [$answer, $row]);
            }
        }
        
        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return response()->download($filename, $question_category->category_name . ' '.date("d-m-Y H:i").'.csv', $headers);
    }

    private function export_question(Question $question, $filename)
    {
        $data = [];
        foreach ($question->answers as $answer) {
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



    public function thankyou_page()
    {
       
        return view('survey.thankyou');
    }
}
