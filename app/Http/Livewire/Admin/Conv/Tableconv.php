<?php

namespace App\Http\Livewire\Admin\Conv;

use App\Models\conversation;
use Livewire\Component;
use Livewire\WithPagination;

class Tableconv extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $all = conversation::simplePaginate(10);
        $all->withPath('/paginate');
        return view('livewire.admin.conv.tableconv', compact('all'));
    }
}
