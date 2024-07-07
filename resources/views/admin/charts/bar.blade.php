@extends('admin.layouts.app')

@section('title', 'Admin-Charts bargraph')

@section('content')

<style>
    /* Center the bar chart */
    #chart-container {
        margin: 0 auto;
        text-align: center;
    }
</style>

<div id="chart-container">
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Category Title', 'Stocks'],
          <?php echo $chartData; ?>
        ]);

        var options = {
          title: 'Stocks',
          width: 900,
          legend: { position: 'left' },
          chart: { title: 'Category Stocks',
                   subtitle: 'from category table and stocks' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Category Title'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
  </head>
  <body>
    <div id="top_x_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>


</div>
@endsection
