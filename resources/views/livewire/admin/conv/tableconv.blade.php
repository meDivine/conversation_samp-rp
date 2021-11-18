<section class="section">
    <div class="card">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Выдвижения</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <p class="card-text">бла бла бла <code> и еще бла бла</code>
                    </p>
                    <!-- Table with outer spacing -->
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                            <tr>
                                <th>Ник</th>
                                <th>Тип</th>
                                <th>Дата начала</th>
                                <th>Кто начал</th>
                                <th>Статистика</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($all as $key)
                                <tr>
                                    <td class="text-bold-500">{{ $key->nickname }}</td>
                                    <td>{{ $key->type}}</td>
                                    <td class="text-bold-500">{{ $key->created_at->diffForHumans() }}</td>
                                    <td class="text-bold-500">
                                        <div class="avatar avatar-lg me-3">
                                            <img src="{{ $key->profile->avatar }}" alt="" srcset="">
                                        </div>
                                        <a class="font-bold ms-3 mb-0">{{ $key->profile->name }}
                                            ({{ $key->profile->nickname }})</a></td>
                                    <td class="text-bold-500">{{ $key->agree }} / {{ $key->disagree }}
                                        / {{ $key->neutral }}</td>
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
