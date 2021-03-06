<div class="col-md-6" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card">
        <div class="card-header">
            <div class="media d-flex align-items-center">
                <div class="avatar me-3">
                    <img src="{{ Auth::user()->avatar }}" alt="" srcset="">
                    <span class="avatar-status bg-success"></span>
                </div>
                <div class="name flex-grow-1">
                    <h6 class="mb-0">Обсуждение</h6>
                    <span class="text-xs">{{ Auth::user()->nickname }}</span>
                </div>
                <button class="btn btn-sm">
                    <i data-feather="x"></i>
                </button>
            </div>
        </div>
        <div class="card-body pt-4 bg-grey" style="overflow: auto;height: 400px; ">
            <div class="chat-content">
                <div class="chat chat-left" wire:init="renderChatMessages">
                    <div class="chat-body" wire:poll.keep-alive="renderChatMessages">
                        @foreach($chatMess as $key)
                            <div class="chat-message">
                                <div class="avatar me-3">
                                    <img src="{{ $key->userInfo->avatar ?? "https://shutnikov.club/wp-content/uploads/2020/01/58cc02673ad2915adce96349.jpg" }}" alt="" srcset="">
                                </div>

                                <span style="color: #eeff0f">{{$key->created_at->format('H:i d.m.y')}} {{ $key->userInfo->nickname ?? "noname" }} ({{ $key->userInfo->name ?? "noname" }})</span>
                                <br>
                                {{ $key->message }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <form wire:submit.prevent="send">
            <div class="message-form d-flex flex-direction-column align-items-center">
                <a href="http://" class="black"><i data-feather="smile"></i></a>
                <div class="d-flex flex-grow-1 ml-4">
                    <input type="text" wire:model.lazy="mess" class="form-control" placeholder="Максимум 1024 символа">
                </div>
                @error('mess')
                    {{ $message }}
                @enderror
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Отправить</button>
        </form>
    </div>
</div>
