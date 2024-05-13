<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Delivery;

class DeliveryInput extends Component
{
    public $input ;

    public function render()
    {
        $deliveries = Delivery::list($this->input);
        return view('livewire.delivery-input' ,[
            'deliveries' => $deliveries,
        ]);
    }
}
