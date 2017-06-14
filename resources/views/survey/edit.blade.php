@extends('layout')

@section('content')
{{ Form::open(array('route' => array('update.survey', $survey->id))) }}
  <h2 class="flow-text">Wijzig survey </h2>
   <div class="row">
    <div class="input-field col s12">
      <input type="text" name="title" id="title" value="{{ $survey->title }}">
      <label for="title">Naam van de vragenlijst</label>
    </div>
    <div class="input-field col s12">
      <textarea id="description" name="description" class="materialize-textarea">{{ $survey->description }}</textarea>
      <label for="description">Beschrijving</label>
    </div>
    <div class="input-field col s12">
    <button class="btn waves-effect waves-light">Opslaan</button>
    </div>
  </div>
{{ Form::close() }}
@stop