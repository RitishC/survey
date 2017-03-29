<?php

class SurveyController extends Controller
{
  public function home(Request $request) 
  {
    # $surveys = Survey::get();
    # return view('home', compact('surveys'));
    return view('home');
  }
}


?>