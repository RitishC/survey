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
<canvas id="myChart"></canvas>
    <script>
    //staafdiagram van chart.js
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: [@foreach($data as $key => $val)
                          {!! $key !!},
                        @endforeach],
              datasets: [{
                  label: 'Aantal antwoorden',
                  data: [
                  @foreach($data as $val)
                    {{$val}},
                  @endforeach
                  ],
                  borderWidth: 1,
                  backgroundColor: "rgba(75,192,192,0.4)"
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
    </script>
@endsection
