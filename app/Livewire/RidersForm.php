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

        if(!$this->rider_Id){
            $rider = Rider::create($this->only('name','surname', 'number', 'transport', 'fuel'));

            session()->flash('success', 'Rider aggiunto!');
        }
        else {
            $rider= Rider::where('id', $this->rider_Id);
            $rider->update($this->only('name','surname', 'number', 'transport', 'fuel'));
            session()->flash('success', 'Rider modificato correttamente!');
            $this->resetValues();
            $this->dispatch('load-riders');
            redirect()->to('/riders/menu/index');
        }

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
