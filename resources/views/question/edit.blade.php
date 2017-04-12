@extends('layout')

@section('content')
<form method="POST" action="/question/{{ $question->id }}/update">
  {{ method_field('PATCH') }}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <h2 class="flow-text">Wijzig vraag titel</h2>
   <div class="row">
    <div class="input-field col s12">
      <input type="text" name="title" id="title" value="{{ $question->title }}">
      <label for="title">Vraag</label>
    </div>
    <div class="input-field col s12">
    <button class="btn waves-effect waves-light">Opslaan</button>
    </div>
  </div>
</form>
@stop