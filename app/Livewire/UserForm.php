<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserForm extends Component
{
    #[Validate]
    public $name;
    #[Validate]
    public $email;
    #[Validate]
    public $password;

    public function rules(){
        return [
            'name'=>'required', 
            'email'=>'required',
            'password'=>'required',
        ];
    }

    public function create(){
        $this->validate();
        
        $user = User::create($this->only('name', 'email', 'password'));

        $this->clean();
        return redirect()->back()->with(['success'=>'Utente creato correttamente']);
    }

    
    public function edit(User $user)
    {
        $this->name = $user->name;
        $this->email = $user->email;

    }
    public function destroy(User $user){
        $user->delete();
        return redirect()->back()->with(['success'=>'Utente eliminato correttamente']);
    }

    public function clean(){
        $this->name='';
        $this->email='';
        $this->password='';
    }
    public function render()
    {
        return view('livewire.user-form');
    }
}
