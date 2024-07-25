@extends('admin.layouts.app')
@extends('master')
@section('title', 'Line Chart')

@section('content')


<div>
    <canvas id="lineChart"></canvas>
</div>

@section('scripts')
<script src="{{ asset('public/js/charts.js') }}"></script> <!-- Include your charts.js file -->
@endsection
@endsection