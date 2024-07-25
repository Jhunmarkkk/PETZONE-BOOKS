@extends('admin.layouts.app')
@extends('master')
@section('title', 'Pie Chart')

@section('content')
<style>
    /* Center the pie chart */
    #chart-container {
        margin: 0 auto;
        text-align: right;
    }
    /* #pieChart {
        width: 100%; 
        height: 500px; 
    } */
</style>

<div id="chart-container">
    <canvas id="pieChart"></canvas>
</div>

@section('scripts')
<script src="{{ asset('public/js/charts.js') }}"></script> <!-- Include your charts.js file -->
@endsection
@endsection