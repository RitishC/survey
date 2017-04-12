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
          No answers provided by you for this Survey
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
              labels: ["Volledig oneens", "Oneens", "Noch oneens", "Eens", "Volledig eens"],
              datasets: [{
                  label: 'Aantal antwoorden',
                  data: [2,2,2,1,1
                  
                  ],
                  borderWidth: 1
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
