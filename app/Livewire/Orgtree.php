<?php

namespace App\Livewire;

use App\Models\Position;
use Livewire\Component;

class Orgtree extends Component
{
    public $positions = [];
    public function render()
    {
        $this->positions = $this->getOrgTree();
        return view('livewire.orgtree');
    }

    public function getOrgTree()
    {
        $positions = Position::with('parent')->get();
        return collect($this->positions = $positions);
    }

}
