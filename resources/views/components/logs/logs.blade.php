@extends('base')

@section('header')
    @include('components.logs.header')
@endsection

@section('title')
    <title>Логи</title>
@endsection

@section('content')
    @include('components.logs.form')
@endsection
