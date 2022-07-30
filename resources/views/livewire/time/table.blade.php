<table class="table table-lg">
    <thead>
    <tr>
        <th>Игровой ник</th>
        <th>Уровень</th>
        <th>Часы</th>
        <th>Минуты</th>
        <th>Секунды</th>
    </tr>
    </thead>
    <tbody>
    @if (isset($unionTable) && !empty($unionTable->weekInfo))
        @foreach($unionTable->weekInfo as $key)
            @if($key->hours < $unionTable->normal_play)
            <tr style="color: red">
                <td class="text-bold-500">{{ $key->nickname }}</td>
                <td>{{ $key->level }}</td>
                <td class="text-bold-500">{{ $key->hours }}</td>
                <td class="text-bold-500">{{ $key->minutes }}</td>
                <td class="text-bold-500">{{ $key->seconds }}</td>
            </tr>
            @else
                <tr style="color: green">
                    <td class="text-bold-500">{{ $key->nickname }}</td>
                    <td>{{ $key->level }}</td>
                    <td class="text-bold-500">{{ $key->hours }}</td>
                    <td class="text-bold-500">{{ $key->minutes }}</td>
                    <td class="text-bold-500">{{ $key->seconds }}</td>
                </tr>
            @endif
        @endforeach
    @endif
    </tbody>
</table>
