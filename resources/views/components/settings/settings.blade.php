@extends('base')

@section('header')
    @include('components.settings.header')
@endsection
@section('title')
    <title>Настройки</title>
@endsection
@section('content')
    @include('components.settings.form')
@endsection
