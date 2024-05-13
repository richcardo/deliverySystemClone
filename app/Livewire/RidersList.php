<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rider;
use Livewire\attributes\On;

class RidersList extends Component
{
    public $riders;

    public function mount()
    {
       $this->load();
    }

    #[On('load-riders')]
    public function load()
    {
        $this->riders = Rider::orderBy('id', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.riders-list');
    }
}
