<!-- MAIN CONTENT -->
@extends('web.layouts.master')
@section('content')
    @livewire('stats')
{{--    <div class="shape"></div>--}}
    <div class="section-performance">
        <div class="row">
            @livewire('stats-table')
            @livewire('report-stats')
        </div>
    </div>
@endsection
@section('js')
@endsection
