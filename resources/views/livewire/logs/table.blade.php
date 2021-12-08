<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Table with outer spacing</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <p class="card-text">Using the most basic table up, here’s how
                    <code>.table</code>-based tables look in Bootstrap. You can use any example
                    of below table for your table and it can be use with any type of bootstrap tables.
                </p>
                <!-- Table with outer spacing -->
                @if (isset($unfo) && !empty($keys))
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
                @else
                   <h1><span style="color: red"> Ничего не найдено</span></h1>
                @endif
            </div>
        </div>
    </div>
</div>
