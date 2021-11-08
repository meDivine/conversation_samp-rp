@extends('base')
@section('header')
    @include('components.homepage.header')
@endsection
@section('title')
    <title>Тест тайтл</title>
@endsection
@section('content')
    @livewire('admin.conv.tableconv')
@endsection
