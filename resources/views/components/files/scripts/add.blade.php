@extends('base')
@section('header')
    @include('components.homepage.header')
@endsection
@section('title')
    <title>ZEROTWO | Добавить файл</title>
@endsection
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Full Editor</h4>
            </div>
            @livewire('files.scripts.add')
        </div>
    </section>

@endsection
