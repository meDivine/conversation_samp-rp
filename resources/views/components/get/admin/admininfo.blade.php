@extends('base')

@section('header')
    @include('components.get.admin.header')
    <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">
@endsection

@section('title')
    <title>Администратор</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $convinfo->nickname }}</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                               role="tab" aria-controls="home" aria-selected="true">Информация</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#reportlog"
                               role="tab" aria-controls="profile" aria-selected="false">Репорт лог</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="warns-tab" data-bs-toggle="tab" href="#warns"
                               role="tab" aria-controls="warns" aria-selected="false">Варны</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#kicks"
                               role="tab" aria-controls="contact" aria-selected="false">Кики</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#kicks"
                               role="tab" aria-controls="contact" aria-selected="false">Баны</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#leaderships"
                               role="tab" aria-controls="contact" aria-selected="false">Лидерства</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#names"
                               role="tab" aria-controls="contact" aria-selected="false">Ники</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                             aria-labelledby="home-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="disabledInput">Игровой ник</label>
                                            <p class="form-control-static" id="staticInput">{{ $convinfo->nickname }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="disabledInput">Лидерства</label>
                                            <p class="form-control-static" id="staticInput">{{ $convinfo->leaderships }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="disabledInput">О кандидате</label>
                                            <p class="form-control-static" id="staticInput">{{ $convinfo->about }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel"
                             aria-labelledby="profile-tab">
                            Integer interdum diam eleifend metus lacinia, quis gravida eros mollis.
                            Fusce non sapien
                            sit amet magna dapibus
                            ultrices. Morbi tincidunt magna ex, eget faucibus sapien bibendum non. Duis
                            a mauris ex.
                            Ut finibus risus sed massa
                            mattis porta. Aliquam sagittis massa et purus efficitur ultricies. Integer
                            pretium dolor
                            at sapien laoreet ultricies.
                            Fusce congue et lorem id convallis. Nulla volutpat tellus nec molestie
                            finibus. In nec
                            odio tincidunt eros finibus
                            ullamcorper. Ut sodales, dui nec posuere finibus, nisl sem aliquam metus, eu
                            accumsan
                            lacus felis at odio. Sed lacus
                            quam, convallis quis condimentum ut, accumsan congue massa. Pellentesque et
                            quam vel
                            massa pretium ullamcorper vitae eu
                            tortor.
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel"
                             aria-labelledby="contact-tab">
                            <p class="mt-2">Duis ultrices purus non eros fermentum hendrerit. Aenean
                                ornare interdum
                                viverra. Sed ut odio velit. Aenean eu diam
                                dictum nibh rhoncus mattis quis ac risus. Vivamus eu congue ipsum.
                                Maecenas id
                                sollicitudin ex. Cras in ex vestibulum,
                                posuere orci at, sollicitudin purus. Morbi mollis elementum enim, in
                                cursus sem
                                placerat ut.</p>
                        </div>
                        <div class="tab-pane fade" style="height:500px; background: #fff; border: 1px solid #C1C1C1; overflow: auto; " id="warns" role="tabpanel"
                             aria-labelledby="warns-tab">
                            @foreach($warns as $warn)
                                <p class="mt-2">{{ $warn }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="media d-flex align-items-center">
                        <div class="avatar me-3">
                            <img src="{{ Auth::user()->avatar }}" alt="" srcset="">
                            <span class="avatar-status bg-success"></span>
                        </div>
                        <div class="name flex-grow-1">
                            <h6 class="mb-0">Обсуждение</h6>
                            <span class="text-xs">Твой ник наверное</span>
                        </div>
                        <button class="btn btn-sm">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body pt-4 bg-grey">
                    <div class="chat-content">
                        <div class="chat chat-left">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <div class="avatar me-3">
                                        <img src="{{ Auth::user()->avatar }}" alt="" srcset="">
                                    </div>
                                    Я против выдвижения Павла Сноу на пост Главного администратора, потому что он блатит
                                    таких людей как: Emily_Lewis
                                </div>
                            </div>
                            <div class="chat-message">
                                <div class="avatar me-3">
                                    <img src="{{ Auth::user()->avatar }}" alt="" srcset="">
                                </div>
                                Я за выдвижения Павла Сноу на пост Главного администратора
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="message-form d-flex flex-direction-column align-items-center">
                    <a href="http://" class="black"><i data-feather="smile"></i></a>
                    <div class="d-flex flex-grow-1 ml-4">
                        <label>
                            <input type="text" class="form-control" placeholder="Сообщение">
                        </label>
                        <a class="btn btn-primary">Отправить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
