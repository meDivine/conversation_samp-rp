@extends('base')

@section('header')
    @include('components.settings.header')
@endsection
@section('title')
    <title>Учёт игрового времени</title>
@endsection
@section('content')
    <div class="row match-height">
        @include('components.time.table')
        @include('components.time.card')
    </div>
@endsection
