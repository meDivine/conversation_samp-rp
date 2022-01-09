<?php

namespace App\Http\Livewire\Admin\Conv;

use App\Models\conv_voting;
use App\Models\conversation;
use Livewire\Component;
use Livewire\WithPagination;

class Tableconv extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public static function getInfo($voteId) {
        $voteConv = new conv_voting();
        return $voteConv->getVotingInfoByName($voteId);
    }

    public function render()
    {
        $all = conversation::whereNull('who_close')
            ->latest()
            ->paginate(10);
        return view('livewire.admin.conv.tableconv', compact('all'));
    }
}
