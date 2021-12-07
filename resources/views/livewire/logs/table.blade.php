<div>
    @if (isset($unfo))
        <div class="table-responsive">
            <table class="table table-lg">
                <thead>
                <tr>
                    @foreach(array_keys($unfo[1]) as $arkey)
                    <th>{{ $arkey }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($unfo as $raw => $key)
                    <td class="text-bold-500">{{ $key[array_key_first($unfo[1])] }}</td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    @endif
    sd
</div>
