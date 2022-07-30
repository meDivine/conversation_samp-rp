<div class="col-md-6 col-12" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Выдвижение кандидата</h4>
        </div>
        <div class="card-content">
            <form wire:submit.prevent="addConversation">
                <div class="card-body">
                    <form class="form form-vertical">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Игровое имя</label>
                                        <div class="position-relative">
                                            <input wire:model.lazy="gamenick" type="text" class="form-control"
                                                   placeholder="Pavel_Snow (прим.)"
                                                   id="first-name-icon">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person-bounding-box"></i>
                                            </div>
                                        </div>
                                        @error('gamenick')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <labe>Тип выдвижения</labe>
                                        <fieldset class="form-group">
                                            <select wire:model="type" class="form-select" id="basicSelect">
                                                <option value="0">Администратор</option>
                                                <option value="1">Игровой помощник</option>
                                            </select>
                                        </fieldset>
                                        @error('gamenick')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="email-id-icon">Ссылка на Соц. Сеть</label>
                                        <div class="position-relative">
                                            <input wire:model.lazy="social" type="text" class="form-control"
                                                   placeholder="https://vk.com/zxcdeadinside" id="email-id-icon">
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                        @error('social')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="email-id-icon">Ссылка на формный аккаунт</label>
                                        <div class="position-relative">
                                            <input wire:model.lazy="forum" type="text" class="form-control"
                                                    id="email-id-icon">
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                        @error('forum')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Реальное имя</label>
                                        <div class="position-relative">
                                            <input wire:model.lazy="realname" type="text" class="form-control"
                                                   placeholder="Павлик"
                                                   id="first-name-icon">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                        @error('realname')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="bi bi-file-earmark-break">О кандидате</label>
                                        <div class="position-relative">
                                        <textarea wire:model.lazy="about" type="text" class="form-control"
                                                  placeholder="Красивый смелый сильный" id="bi bi-file-earmark-break"> </textarea>
                                            <div class="form-control-icon">
                                                <i class="bi bi-file-earmark-break"></i>
                                            </div>
                                        </div>
                                        @error('about')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="bi bi-file-earmark-break">Лидерства</label>
                                        <div class="position-relative">
                                        <textarea wire:model.lazy="leaderships" type="text" class="form-control"
                                                  placeholder="Байкеры - 2 раза" id="bi bi-file-earmark-break"> </textarea>
                                            <div class="form-control-icon">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                        </div>
                                        @error('leaderships')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Добавить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
