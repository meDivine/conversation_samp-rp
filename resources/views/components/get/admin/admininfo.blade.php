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
                    <img src="https://flagcdn.com/w20/{{ strtolower($stats['countryCode'] ?? null) }}.webp"
                         alt=""/> {{ $stats['country'] ?? null }},
                    {{ $stats['regionName'] ?? null}}, {{ $stats['city'] ?? null}} [<a href="#" data-bs-toggle="tooltip"
                                                                         title="{{ $stats['isp'] ?? null}}">?</a>]
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
                            <a class="nav-link" id="suplog-tab" data-bs-toggle="tab" href="#suplog"
                               role="tab" aria-controls="suplog" aria-selected="false">Саппорт лог</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="warns-tab" data-bs-toggle="tab" href="#warns"
                               role="tab" aria-controls="warns" aria-selected="false">Варны</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="kicks-tab" data-bs-toggle="tab" href="#kicks"
                               role="tab" aria-controls="kicks" aria-selected="false">Кики</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="bans-tab" data-bs-toggle="tab" href="#bans"
                               role="tab" aria-controls="bans" aria-selected="false">Баны</a>
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
                                        <div class="form-group">
                                            <label for="disabledInput">Ссылка на соц. сеть</label>
                                            <p class="form-control-static" href="{{ $convinfo->social }}" id="staticInput">{{ $convinfo->social }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="disabledInput">О кандидате</label>
                                            <p class="form-control-static" id="staticInput">{{ $convinfo->about }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="disabledInput">Реальное имя</label>
                                            <p class="form-control-static" id="staticInput">{{ $convinfo->real_name }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="disabledInput">Голос</label>
                                            <p><i style="color: #499C54; font-size: 1.5rem;" class="bi bi-emoji-smile"></i>
                                            <i style="color: #FF0000; font-size: 1.5rem;" class="bi bi-emoji-angry"></i>
                                            <i style="color: #AEB4B6; font-size: 1.5rem;" class="bi bi-emoji-expressionless"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reportlog" role="tabpanel"
                             style="height:500px; background: #fff; border: 1px solid #C1C1C1; overflow: auto; "
                             aria-labelledby="reportlog-tab">
                            @foreach($replogs as $replog)
                                <p class="mt-2">{{ $replog }}</p>
                                @endforeach
                        </div>
                        <div class="tab-pane fade" id="suplog" role="tabpanel"
                             style="height:500px; background: #fff; border: 1px solid #C1C1C1; overflow: auto; "
                             aria-labelledby="suplog-tab">
                            @foreach ($suplogs as $suplog)
                                <p class="mt-2">{{ $suplog }}</p>
                                @endforeach
                        </div>
                        <div class="tab-pane fade"
                             style="height:500px; background: #fff; border: 1px solid #C1C1C1; overflow: auto; "
                             id="warns" role="tabpanel"
                             aria-labelledby="warns-tab">
                            @foreach($warns as $warn)
                                <p class="mt-2">{{ $warn }}</p>
                            @endforeach
                        </div>
                        <div class="tab-pane fade"
                             style="height:500px; background: #fff; border: 1px solid #C1C1C1; overflow: auto; "
                             id="kicks" role="tabpanel"
                             aria-labelledby="kicks-tab">
                            @foreach($kicks as $kick)
                                <p class="mt-2">{{ $kick }}</p>
                            @endforeach
                        </div>
                        <div class="tab-pane fade"
                             style="height:500px; background: #fff; border: 1px solid #C1C1C1; overflow: auto; "
                             id="bans" role="tabpanel"
                             aria-labelledby="bans-tab">
                            @foreach($bans as $ban)
                                <p class="mt-2">{{ $ban }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <livewire:conversation.chat :conv_id="$convinfo->id" />

    </div>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection
