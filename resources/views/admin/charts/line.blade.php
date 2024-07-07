@extends('admin.layouts.app')

@section('title', 'Admin-Charts linegraph')

@section('content')

<style>
    /* Center the line chart */
    #chart-container {
        margin: 0 auto;
        text-align: center;
    }
</style>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category Title', 'Product Count', 'Stocks'],
          <?php echo $chartData; ?>
        ]);

        var options = {
          title: 'Product Category Stocks',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>

@endsection
