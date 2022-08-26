<form wire:submit.prevent="addVote" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="form-group">
        <label for="disabledInput">Голос</label>
        <p>
            <li class="d-inline-block me-2 mb-1">
        <div class="form-check">
            <div class="custom-control custom-checkbox" wire:click="disagreeUpdate">
                <input type="checkbox"
                       class="form-check-input form-check-danger"
                       name="customCheck" id="customColorCheck4"
                       wire:model="disagree">
                <label class="form-check-label"
                       for="customColorCheck4">Отрицательный</label>
            </div>
        </div>
        </li>
        </p>
        <p>
            <li class="d-inline-block me-2 mb-1">
        <div class="form-check">
            <div class="custom-control custom-checkbox" wire:click="neutralUpdate">
                <input type="checkbox" class="form-check-input form-check-info"
                       name="customCheck" id="customColorCheck5"
                       wire:model="neutral">
                <label class="form-check-label"
                       for="customColorCheck5">Нейтральный</label>
            </div>
        </div>
        </li>
        </p>
        <p>
            <li class="d-inline-block me-2 mb-1">
        <div class="form-check">
            <div class="custom-control custom-checkbox" wire:click="agreeUpdate">
                <input type="checkbox"
                       class="form-check-input form-check-success"
                       name="customCheck" id="customColorCheck3"
                       wire:model="agree">
                <label class="form-check-label"
                       for="customColorCheck3">Положительный</label>
            </div>
        </div>
        </li>
        </p>
    </div>

    <div class="col-md-4">
        <label>Комментарий</label>
    </div>
    @error('comment')
    {{ $message }}
    @enderror
    <div class="col-md-10 form-group">
        <input type="text" id="first-name" class="form-control"
               name="fname" wire:model="comment" placeholder="Видно тебе и ГА">
    </div>
    <button type="submit" class="btn btn-primary me-1 mb-1">Отправить</button>
    @if(\Auth::user()->inRole("lord"))
        <button wire:click="closeConv" class="btn btn-danger me-1 mb-1">Закрыть</button>
    @endif
</form>

