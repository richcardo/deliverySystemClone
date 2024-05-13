<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Delivery;

class DeliveryList extends Component
{
    public $deliveries= [];

    public function render()
    {
        return view('livewire.delivery-list');
    }
}
