@extends('admin.layouts.app')

@section('title' , 'Admin-Charts piegraph')

@section('content')
  <style>
    /* Center the pie chart */
    #piechart-container {
      margin: 0 auto;
      text-align: center;
    }
  </style>

  <div id="piechart-container">
  <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category', 'Product'],
          <?php echo $chartData; ?>
        ]);

        var options = {
          title: 'Product Categories Chart',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>
</html>
  </div>
@endsection
