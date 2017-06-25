@extends('layout')

@section('content')
    <ul class="collection with-header">
        <li class="collection-header">
            <h2 class="flow-text">Recente surveys</h2>
        </li>
        @forelse ($surveys as $survey)
            <li class="collection-item">
                <div>
                    {{ link_to_route('detail.survey.user', $survey->title, ['id'=>$survey->id])}}
                    <a href="survey/answers/{{ $survey->id }}" title="Surveyresultaten inzien" class="secondary-content"><i class="material-icons">textsms</i></a>
                </div>
            </li>
        @empty
            <p class="flow-text center-align">Geen survey om te weergeven</p>
        @endforelse
    </ul>

@stop