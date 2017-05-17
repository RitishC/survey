@extends('layout')

@section('content')
<ul class="collection with-header">
    <li class="collection-header">
        <h2 class="flow-text">Recente surveys
            <span style="float:right;">{{ link_to_route('new.survey', 'Nieuwe survey') }}
            </span>
        </h2>
    </li>
    @forelse ($surveys as $survey)
      <li class="collection-item">
        <div>
            {{ link_to_route('detail.survey', $survey->title, ['id'=>$survey->id])}}
            <a href="survey/view/{{ $survey->id }}" title="Vul Survey in" class="secondary-content"><i class="material-icons">send</i></a>
            <a href="survey/{{ $survey->id }}" title="Wijzig Survey" class="secondary-content"><i class="material-icons">edit</i></a>
            <a href="survey/answers/{{ $survey->id }}" title="Surveyresultaten inzien" class="secondary-content"><i class="material-icons">textsms</i></a>
        </div>
        </li>
    @empty
        <p class="flow-text center-align">Geen survey om te weergeven</p>
    @endforelse
    </ul>

@stop