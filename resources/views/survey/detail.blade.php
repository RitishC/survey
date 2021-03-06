@extends('layout')

@section('content')
  <div class="card">
      <div class="card-content">
      <span class="card-title"> {{ $survey->title }}</span>
      <p>
        {{ $survey->description }}
      </p>
      <br/>
      <!--<a href='view/{{$survey->id}}'>Survey afnemen</a> --> <a href="{{$survey->id}}/edit" style="text-decoration:underline; color: blue;">Wijzig survey</a> | <a href="/survey/answers/{{$survey->id}}" style="text-decoration:underline; color: blue;">Bekijk de resultaten</a> <a href="#doDelete" style="float:right;" class="modal-trigger red-text">Verwijder survey</a>
      </br></br>
    <p>  Kopieer deze link voor de leraren:</p>
<input id="foo" value="www.kennisbank.education/public/url_survey/{{ $url->url }}">
<!-- link die gestuurd kan worden naar leraren -->
    <!--  @if(isset($url))
              | <a href="/url_survey/{{ $url->url }}">Kopieer link <!--{{ $url->url }}--></a>
          @endif
      <!-- Modal Structure -->
      <div id="doDelete" class="modal bottom-sheet">
        <div class="modal-content">
          <div class="container">
            <div class="row">
              <h4>Weet je zeker?</h4>
              <p>Weet je zeker dat je de survey "{{ $survey->title }}" wilt verwijderen?</p>
              <div class="modal-footer">
                <a href="/survey/{{ $survey->id }}/delete" class=" modal-action waves-effect waves-light btn-flat red-text">Ja, ik weet het zeker</a>
                <a class=" modal-action modal-close waves-effect waves-light green white-text btn">Nee, annuleer</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="divider" style="margin:20px 0px;"></div>
      <p class="flow-text center-align">Vragen</p>
      <ul class="collapsible" data-collapsible="expandable">
         @forelse ($questions as $question)
          <li style="box-shadow:none;">
            <div class="collapsible-header">{{ $question->title }} - categorie: {{ $question->category_name }}
                <a href="/question/{{ $question->id }}/edit" style="float:right;">Wijzig</a>
                <a href="/question/{{ $question->id }}/delete"
                   onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?')"
                   style="float:right;">Verwijder &nbsp;</a>
            </div>

            <div class="collapsible-body">
              <div style="margin:5px; padding:10px;">
                  {!! Form::open() !!}
                    @if($question->question_type === 'text')
                      {{ Form::text('title')}}
                    @elseif($question->question_type === 'textarea')
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Geef een antwoord</label>
                      </div>
                    </div>
                    @elseif($question->question_type === 'radio')
                      @if( ! (is_array($options = $question->option_name) && is_array(json_decode($question->option_name))))
                          <p style="margin:0px; padding:0px;">
                              <input type="radio" id="1" />
                              <label for="1">{{ $options }}</label>
                          </p>
                      @else
                          @foreach($options as $key=>$value)
                            <p style="margin:0px; padding:0px;">
                              <input type="radio" id="{{ $key }}" />
                              <label for="{{ $key }}">{{ $value }}</label>
                            </p>
                          @endforeach
                      @endif
                    @elseif($question->question_type === 'checkbox')
                      @foreach(json_decode($question->option_name) as $key=>$value)
                      <p style="margin:0px; padding:0px;">
                        <input type="checkbox" id="{{ $key }}" />
                        <label for="{{$key}}">{{ $value }}</label>
                      </p>
                      @endforeach
                    @endif 
                  {!! Form::close() !!}
              </div>
            </div>
          </li>
          @empty
            <span style="padding:10px;">Geen vragen toegevoegd. Voeg vragen toe.</span>
          @endforelse
      </ul>
      <h2 class="flow-text">Voeg vraag toe</h2>
      <form method="POST" action="{{ $survey->id }}/questions" id="boolean">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="input-field col s12">
            <select class="browser-default" name="question_type" id="question_type">
              <option value="" disabled selected>Kies je optie</option>
              <option value="text">Tekst</option>
             <!-- <option value="textarea">Textarea</option>-->
              <!--<option value="checkbox">Checkbox</option>-->
              <option value="radio">Keuzerondje</option>
            </select>
          </div>
            <div class="input-field col s12">
                <input name="title" id="title" type="text">
                <label for="title">Vraag</label>
            </div>
            <div class="input-field col s12 category_names_container" style="display:none;">
                <select name="question_category_id" id="category_names" class="category_names"></select>
            </div>
            <!-- this part will be chewed by script in init.js -->
          <span class="form-g"></span>

          <div class="input-field col s12">
          <button class="btn waves-effect waves-light">Verstuur</button>
          </div>
        </div>
        </form>
    </div>
  </div>
@stop