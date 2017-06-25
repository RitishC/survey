@extends('layout')

@section('content')
  <div class="card">
      <div class="card-content">
      <span class="card-title"> {{ $survey->title }}</span>
      <p>
        {{ $survey->description }}
      </p>
      <br/>
      <!--<a href='view/{{$survey->id}}'>Survey afnemen</a> --><a href="/survey/answers/{{$survey->id}}">Bekijk de resultaten</a>
    <p>  Kopieer deze link voor de leraren:</p>
<input id="foo" value="www.kennisbank.education/public/url_survey/{{ $url->url }}">
<!-- link die gestuurd kan worden naar leraren -->
    <!--  @if(isset($url))
              | <a href="/url_survey/{{ $url->url }}">Kopieer link <!--{{ $url->url }}--></a>
          @endif

      <div class="divider" style="margin:20px 0px;"></div>
      <p class="flow-text center-align">Vragen</p>
      <ul class="collapsible" data-collapsible="expandable">
         @forelse ($questions as $question)
          <li style="box-shadow:none;">
            <div class="collapsible-header">{{ $question->title }} - categorie: {{ $question->category_name }}</div>
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
                      @foreach(json_decode($question->option_name) as $key=>$value)
                        <p style="margin:0px; padding:0px;">
                          <input type="radio" id="{{ $key }}" />
                          <label for="{{ $key }}">{{ $value }}</label>
                        </p>
                      @endforeach
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
            <span style="padding:10px;">Geen vragen toegevoegd.</span>
          @endforelse
      </ul>
    </div>
  </div>
@stop