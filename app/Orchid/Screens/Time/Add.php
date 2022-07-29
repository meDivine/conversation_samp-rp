<?php

namespace App\Orchid\Screens\Time;

use App\Classes\Admin\Parse;
use App\Models\AdminTime;
use App\Models\Week;
use App\Orchid\Layouts\Time\AddWeek;
use App\Orchid\Layouts\Time\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;

class Add extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Добавить историю';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    public function addWeek(Request $request) {
        $valid = $request->validate([
            'start' => 'date',
            'end'   => 'date',
            'norma' => 'numeric'
        ]);
        Week::query()->create([
            'week_start' => $valid['start'],
            'week_end' => $valid['end'],
            'normal_play' => $valid['norma'],
            'week_name' => Carbon::parse($valid['start'])->format('d-m-Y') . " - " . Carbon::parse($valid['end'])->format('d-m-Y')
        ]);
    }

    public function addFile(Request $request) {
        $test = $request->file('file');
        $file = file_get_contents($test);
        $parser = new Parse($file);
        $result = $parser->parseFile();
        foreach ($result as $key) {
            preg_match('/^(\d+)\s+часов\s+(\d+)\s+минут\s+(\d+)\s+секунд$/', $key['time'], $output_array);
            AdminTime::query()->create([
                'week_id'   => $request->time,
                'nickname'  => $key['nickname'],
                'level'     => $key['level'],
                'hours'     => $output_array[1],
                'minutes'   => $output_array[2],
                'seconds'   => $output_array[3]
            ]);
        }
        Toast::info('Данные за неделю добавлены');
    }

    public function clear(Request $request) {
        // Удалим данные с идом недели
       AdminTime::query()
           ->where('week_id' , $request->time)
           ->delete();
        Toast::info('Данные за неделю удалены');
    }
    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            AddWeek::class,
            Form::class
        ];
    }
}
