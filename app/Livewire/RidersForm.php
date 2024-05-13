<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\Rider;

class RidersForm extends Component
{
    public $rider_Id = false;
    #[Validate]
    public $name;
    #[Validate]
    public $surname;
    #[Validate]
    public $number;
    public $fuel;

    public $transport;

    public function rules()
    {
        return [
            'name'=>'required',
            'surname'=>'required',
        ];
    }

    public function create()
    {
            $this->validate();

            $rider = Rider::create($this->only('name','surname', 'number', 'transport', 'fuel'));

            $total = 50 - $rider->fuel;
            $rider->update(['total'=> $total]);
            
            $this->dispatch('load-riders');

            session()->flash('success', 'Rider aggiunto!');

            $this->resetValues();
    }

    public function resetValues()
    {
        $this->name='';
        $this->surname='';
        $this->number='';
        $this->transport= null ;
        $this->fuel='';

    }

    #[On('rider-edit')]
    public function edit(Rider $rider)
    {
        $this->rider_Id = $rider->id;
        $this->name = $rider->name;
        $this->surname = $rider->surname;
        $this->number = $rider->number;
        $this->transport = $rider->transport;
        $this->fuel = $rider->fuel;
    }



    public function render()
    {
        return view('livewire.riders-form');
    }
}
