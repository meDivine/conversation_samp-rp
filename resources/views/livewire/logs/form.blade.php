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
                            <div class="col-md-4">
                                <label>Игровой ник</label>
                            </div>
                            <div class="col-md-8 form-group" wire:p>
                                <input type="text" id="first-name" class="form-control"
                                       name="fname" placeholder="Nick_Name">
                            </div>
                            <div class="col-md-4">
                                <label>Второй ник</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="first-name" class="form-control"
                                       name="fname" placeholder="Nick_Name">
                            </div>
                            <div class="col-md-4">
                                <label>Дата начала</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" class="form-control"
                                       placeholder="">
                            </div>
                            <div class="col-md-4">
                                <label>Дата окончания</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" class="form-control"
                                       placeholder="data">
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit"
                                        class="btn btn-primary me-1 mb-1" wire:target="getInfo">Поиск
                                </button>
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
