<form class="form form-horizontal">
    <div class="form-body">
        <div class="row">
            <fieldset class="form-group">
                <select class="form-select" id="basicSelect" wire:model="date">
                    <option value="0" selected>Выбери неделю</option>
                    @foreach($weeks as $key)
                        <option value="{{ $key->id }}">#{{ $key->id }} | {{ $key->week_name }}</option>
                    @endforeach
                </select>
            </fieldset>
        </div>
    </div>
</form>
