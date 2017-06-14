@extends('layout')

@section('content')
{{ Form::open(array('route' => array('update.question', $question->id))) }}
  <h2 class="flow-text">Wijzig vraag titel</h2>
   <div class="row">
    <div class="input-field col s12">
      <input type="text" name="title" id="title" value="{{ $question->title }}">
      <label for="title">Vraag</label>
    </div>
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
       @if( ! is_array($options = $question->option_name))
           @if(! is_array(json_decode($question->option_name)))
               <p style="margin:0px; padding:0px;">
                   <input type="text" name="option_name[]" id="1" value="{{ $options }}">
                   <label for="1">Antwoord</label>
               </p>
           @endif
       @else
           @foreach($options as $key=>$value)
               <div class="input-field col s12">
                   <input type="text" name="option_name[]" id="{{ $key }}" value="{{ $value }}">
                   <label for="{{ $key }}">Antwoord</label>
               </div>
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
      <div class="input-field col s12">
          <button class="btn waves-effect waves-light">Opslaan</button>
      </div>
  </div>
{{ Form::close() }}
@stop