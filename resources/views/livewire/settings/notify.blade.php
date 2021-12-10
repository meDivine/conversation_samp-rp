<li class="d-inline-block me-2 mb-1">
    <div class="form-check">
        <div class="checkbox">
            <input wire:model="notifyStateWar" type="checkbox" id="checkbox1"
                   class="form-check-input"
                   @if($notifyStateWar) checked @endif>
            <label for="checkbox1">Уведомления о войнах</label>
        </div>
    </div>
    <div class="form-check">
        <div class="checkbox">
            <input wire:model="notifyStateConvers" type="checkbox" id="checkbox1"
                   class="form-check-input"
                   @if($notifyStateConvers) checked @endif>
            <label for="checkbox1">Уведомления о начале голосования</label>
        </div>
    </div>
</li>
