<section class="section">
    <div class="card">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Выдвижения</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <p class="card-text">Голосовать обязаны все без исключения. <code>Инициатора голосования видно
                            6+</code>
                    </p>
                    <!-- Table with outer spacing -->
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                            <tr>
                                <th>Ник</th>
                                <th>Я</th>
                                <th>Тип</th>
                                <th>Дата начала</th>
                                @if(Auth::user()->hasAccess("watch_convers"))
                                <th>Кто начал</th>
                                @endif
                                <th>Статистика</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($all as $key)
                                <tr>
                                    <td class="text-bold-500">{{ $key->nickname }}</td>
                                    <td class="text-bold-500">{{ \App\Models\conv_voting::getMyVotingStat($key->id)}}</td>
                                    <td>{{ $key->type}}</td>
                                    <td class="text-bold-500">{{ $key->created_at->diffForHumans() }}</td>
                                    @if(Auth::user()->hasAccess("watch_convers"))
                                    <td class="text-bold-500">
                                        <div class="avatar avatar-lg me-3">
                                            <img src="{{ $key->profile->avatar }}" alt="" srcset="">
                                        </div>
                                        <a class="font-bold ms-3 mb-0">{{ $key->profile->name }}
                                            ({{ $key->profile->nickname }})</a></td>
                                    @endif
                                    <td class="text-bold-500"><span style="color: #47a76a">{{ $key->convVote->sum('agree') }}</span> / <span style="color: #CB4154">{{ $key->convVote->sum('disagree') }}</span>
                                        / <span style="color: #B5B8B1;">{{ $key->convVote->sum('neutral') }}</span></td>
                                    <td><a href="{{ route('adminconv', ['id' => $key->id]) }}" class="btn btn-primary">Перейти</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $all->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
