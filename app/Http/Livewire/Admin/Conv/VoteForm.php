<?php

namespace App\Http\Livewire\Admin\Conv;

use App\Models\conv_voting;
use Livewire\Component;

class VoteForm extends Component
{
    public $conv_id;
    public $agree = false;
    public $disagree = false;
    public $neutral = false;
    public $comment;

    protected $rules = [
        'comment' => 'string|max:255'
    ];

    protected $messages = [
        'comment.string'    => 'Комментарий заполнен некорректно',
        'comment.max'       => 'Максимум 255 символов',
    ];

    /*
     * Обновлю чекбоксы, должен быть выделен только один
     * Мб исправлю в будущем
     */
    public function agreeUpdate() {
        $this->neutral = false;
        $this->disagree = false;
    }
    public function disagreeUpdate() {
        $this->neutral = false;
        $this->agree = false;
    }
    public function neutralUpdate() {
        $this->disagree = false;
        $this->agree = false;
    }

    public function addVote () {
        $this->validate();
        $convVoting = new conv_voting();
        return $convVoting->addVote($this->conv_id, $this->comment,
            $this->agree, $this->disagree, $this->neutral);
    }

    private function voteInfo(){
        $convVoting = new conv_voting();
        return $convVoting->getVotingInfoByName($this->conv_id);
    }

    public function mount(){
        $voteInfo = $this->voteInfo();
        $this->comment = $voteInfo->comment ?? null;
        $this->agree = $voteInfo->agree ?? false;
        $this->disagree = $voteInfo->disagree ?? false;
        $this->neutral = $voteInfo->neutral ?? false;
    }

    public function render()
    {
        $voteInfo = $this->voteInfo();
        return view('livewire.admin.conv.vote-form', compact('voteInfo'));
    }
}
