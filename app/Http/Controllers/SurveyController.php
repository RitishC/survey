<?php
namespace App\Http\Controllers;

use App\School;
use Auth;
use App\ProtectedUrl;
use App\Survey;
use App\Answer;
use App\QuestionCategory;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show_protected_survey']]);
        $this->middleware('admin', ['only' => ['create', 'detail_survey', 'edit', 'update', 'delete_survey', 'home']]);
    }

    public function home(Request $request)
    {
        $surveys = Survey::get();
        return view('home', compact('surveys'));
    }

    public function detail_overview_user(Request $request)
    {
        $surveys = Survey::get();
        return view('user.home', compact('surveys'));
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

    public function detail_survey_user(Survey $survey)
    {
        $data = [];
        $survey->load('questions.user');

        foreach($survey->questions as $question) {
            // Get all categories
            foreach (QuestionCategory::all() as $category) {
                if ($question->question_category_id != $category->id) {
                    continue;
                }

                $questions = DB::table('question')
                    ->leftJoin('question_category', 'question.question_category_id', '=', 'question_category.id')
                    ->select('question_category.category_name', 'question.*')->get();
                $data['questions'] = $questions;
            }
        }

        if ($survey->protected_urls->first() !== null) {
            $data['url'] = $survey->protected_urls->first();
        }

        $data['survey'] = $survey;

        return view('survey.user.detail', $data);
    }

    //retrieve detail page and add questions here
    public function detail_survey(Survey $survey)
    {
        $data = [];
        $survey->load('questions.user');
		$data['questions'] = [];

        foreach($survey->questions as $question) {
            // Get all categories
            foreach (QuestionCategory::all() as $category) {
                if ($question->question_category_id != $category->id) {
                    continue;
                }

                $questions = DB::table('question')
					->leftJoin('question_category', 'question.question_category_id', '=', 'question_category.id')
					->where('question.survey_id', $survey->id)
                    ->select('question_category.category_name', 'question.*')->get();
                $data['questions'] = $questions;
            }
        }

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
        $times_survey_answered = 0;
        $all                   = [];
        $data                  = [];

        // Seperate loops to set them in the right order
        foreach($survey->questions as $question) {
            // Get all answers
            foreach ($question->answers as $answer) {
				$all[$answer->answer] = $survey->answers->where("answer", $answer->answer)->count();
            }
        }

        foreach($survey->questions as $question) {
            // Get all questions
            foreach ($question->answers as $answer) {
                $data[$question->id][$question->title][$answer->answer] = Answer::where('answer', $answer->answer)->where('question_id', $question->id)
					->where('survey_id', $survey->id)
					->orderBy('question_id')
					->count();
            }
        }

        foreach($survey->questions as $question) {
            // Get all categories
            foreach (QuestionCategory::all() as $category) {
                if ($question->question_category_id != $category->id) {
                    continue;
                }

                foreach ($question->answers as $answer) {
                	$count   = DB::table('answer')->leftJoin('question', 'question_id', '=', 'question.id')
                        ->where('question.question_category_id', '=', $category->id)
                        ->where('answer.answer', '=', $answer->answer)
						->orderBy('question_id')
                        ->select('answer.id')->count();
                    $data[$category->category_name][$category->category_name][$answer->answer] = $count;
                }
            }
        }

        foreach($survey->questions as $question) {
        	// Get all schools
            foreach($question->answers as $answer) {
                if (! isset($data[$answer->school->name][$answer->school->name][$answer->answer])) {
                    $data[$answer->school->name][$answer->school->name][$answer->answer] = 0;
                }

                $data[$answer->school->name][$answer->school->name][$answer->answer] += Answer::where('answer', $answer->answer)
                    ->where('question_id', $question->id)
                    ->where('survey_id', $survey->id)
                    ->where('school_id', $answer->school_id)
					->orderBy('question_id')
                    ->count();
            }

            // Count how many times survey is taken
            if (! isset($data['times_survey_answered'])) {
                $times_survey_answered = Answer::where('survey_id', $survey->id)->where('question_id', $question->id)->count();
            }
        }

        return view('answer.view', ['survey'=> $survey, "data" => $data, "all" => $all, 'times_survey_answered' => $times_survey_answered]);
    }

       //link voor de leraren aanmaken
    public function show_protected_survey($hash)
    {
        $survey = ProtectedUrl::where('url', $hash)->first()->survey;
        $survey->load('questions.user');
        $url     = $survey->protected_urls->first();
        $schools = School::all();
        return view('survey.view', ['schools' => $schools, 'survey' => $survey, 'url' => $url]);
    }

    // has authority to
    public function export_answers($parameter)
    {
        $filename = "file.csv";

        if(null !== ($category = QuestionCategory::where('category_name', $parameter)->first())) {
            return $this->export_question_category($category, $filename);
        }

        if(null !== ($question = Question::find($parameter))) {
			return $this->export_question($question, $filename);
		}

		if(null !== ($school = School::where('name', $parameter)->first())) {
			return $this->export_school($school, $filename);
		}
		echo "404 - Answers not found";
    }

    private function export_question_category(QuestionCategory $question_category, $filename)
    {
        $data = [];
        
        foreach($question_category->questions as $question) {
          $data[$question->title] = [];

            foreach ($question->answers as $answer) {
                if (isset($data[$question->title][$question->answer])) {
                    $data[$question->title][$answer->answer] += Answer::where('answer', $answer->answer)->where('question_id', $question->id)->count();
                } else {
                    $data[$question->title][$answer->answer] = Answer::where('answer', $answer->answer)->where('question_id', $question->id)->count();
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
            $data[$answer->answer] = Answer::where('answer', $answer->answer)->where('question_id', $question->id)->count();
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

    private function export_school(School $school, $filename)
    {
        $data    = [];
        $answers = $school->answers;

        foreach ($answers as $answer) {
            $data[$answer->question->title][$answer->answer] = Answer::where('answer', $answer->answer)
                ->where('question_id', $answer->question->id)
                ->where('school_id', $answer->school_id)
                ->count();
        }

        ob_start();
        $handle = fopen($filename, 'w+');
        fputcsv($handle, [$school->name]);

        foreach ($data as $question => $answers) {
            fputcsv($handle, [$question]);
            foreach ($answers as $answer => $amount_answered) {
                fputcsv($handle, [$answer, $amount_answered]);
            }
        }
        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return response()->download($filename, $school->name . ' '.date("d-m-Y H:i").'.csv', $headers);
    }

    public function delete_survey(Survey $survey)
    {
        $survey->delete();
        return back();
    }



    public function thankyou_page()
    {
        return view('survey.thankyou');
    }
}
