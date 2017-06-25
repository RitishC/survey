@extends('layout')

@section('content')
<h4>{{ $survey->title }}</h4>
<!-- tabel weggehaald zodat er alleen staaf is -->
<!--
<table class="bordered striped">
  <thead>
    <tr>
        <th data-field="id">Question</th>
        <th data-field="name">Answer(s)</th>
    </tr>
  </thead>

  <tbody>
    @forelse ($survey->questions as $item)
    <tr>
      <td>{{ $item->title }}</td>
      @foreach ($item->answers as $answer)
        <td>{{ $answer->answer }} <br/>
        <small>{{ $answer->created_at }}</small></td>
      @endforeach
    </tr>

    @empty
      <tr>
        <td>
          Nog geen antwoorden ingevuld voor deze survey
        </td>
        <td></td>
      </tr>
    @endforelse
    -->
  </tbody>
</table>

<h5>Alle antwoorden</h5>
<h6>Deze survey is {{ $times_survey_answered }} keer beantwoord.</h6>
<canvas id="myChart"></canvas>
{{ $i = 0 }}
@foreach($data as $key => $question)
        <h5><a href="{!! route('export.survey', $key) !!}">{{ key($question) }}</a></h5>
        <canvas id="myChart-{{ $key }}"></canvas>
@endforeach
    <script>
    //staafdiagram van chart.js
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: [@foreach($all as $key => $val)
                          {!! $key !!},
                        @endforeach],
              datasets: [{
                  label: 'Aantal antwoorden',
                  data: [
                  @foreach($all as $val)
                    {{$val}},
                  @endforeach
                  ],
                  borderWidth: 1,
                  backgroundColor: "rgba(75,192,192,0.4)"
              }]
          },
          options: {
              scales: {
                  xAxes: [{
                    display: false
                  }],
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
    //staafdiagram van chart.js
    @foreach($data as $key => $question)
            var ctx = document.getElementById("myChart-{{ $key }}");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [@foreach($question as $val)
                              @foreach($val as $title => $answer)
                                {!! $title !!},
                        @endforeach,
                        @endforeach],
                    datasets: [{
                        label: 'Aantal antwoorden',
                        data: [
                            @foreach($question as $val)
                              @foreach($val as $answer)
                                {{ $answer }},
                            @endforeach,
                            @endforeach
                            ],
                        borderWidth: 1,
                        backgroundColor: "rgba(75,192,192,0.4)"
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                          display: false
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
    @endforeach
    </script>
@endsection
