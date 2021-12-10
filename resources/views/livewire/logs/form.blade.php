<div class="col-md-3 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Критерии поиска</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" wire:submit.prevent="getInfo">
                    <div class="form-body">
                        <div class="row">
                            @livewire('logs.select')
                            <div class="col-md-4" @if($stateFirstName) hidden @endif>
                                <label>{{ $getFirstNameText }}</label>
                            </div>
                            <div class="col-md-8 form-group" @if($stateFirstName) hidden @endif>
                                <input type="text" wire:model.lazy="nickname" id="first-name" class="form-control"
                                       name="fname" placeholder="Nick_Name">
                            </div>
                            <div class="col-md-4" @if($stateSecondName) hidden @endif>
                                <label>{{ $getSecondNameText }}</label>
                            </div>
                            <div class="col-md-8 form-group" @if($stateSecondName) hidden @endif>
                                <input type="text" wire:model="nickname2" id="first-name" class="form-control"
                                       name="fname" placeholder="Nick_Name">
                            </div>
                            <div class="col-md-4" @if($stateDateState) hidden @endif>
                                <label>Дата начала</label>
                            </div>
                            <div class="col-md-8 form-group" @if($stateDateState) hidden @endif>
                                <input type="date" wire:model="dateStart" class="form-control"
                                       placeholder="">
                            </div>
                            <div class="col-md-4" @if($endDateState) hidden @endif>
                                <label>Дата окончания</label>
                            </div>
                            <div class="col-md-8 form-group" @if($endDateState) hidden @endif>
                                <input type="date" wire:model.lazy="dateEnd" class="form-control"
                                       placeholder="data">
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" wire:loading.remove wire:target="getInfo"
                                        class="btn btn-primary me-1 mb-1">Поиск
                                </button>
                                <div wire:loading wire:target="getInfo">
                                    <button class="btn btn-primary" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <span class="visually-hidden">Загружаю</span>
                                    </button>
                                </div>
                                <button type="reset"
                                        class="btn btn-light-secondary me-1 mb-1" disabled>[WIP] Скачать
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
