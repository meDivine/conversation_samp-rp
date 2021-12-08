<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Логи</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <p class="card-text">Тут мб какая то информация
                </p>
                <!-- Table with outer spacing -->
                @if (isset($unfo) ?? !empty($keys))
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                <tr>
                                    @foreach($keys as $tableKey)
                                        <th>{{ $tableKey }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                        @foreach($unfo as $key)
                        <tr>
                            @foreach($keys as $tableKeyTr)
                            <td class="text-bold-500">{{ $key[$tableKeyTr] }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
