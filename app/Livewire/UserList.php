<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{

    public $users;

    public function mount()
    {
        $this->users = User::all();
    }
    public function edit(User $user)
    {
        dd('inside');
        $this->dispatch('edit', ['user' => $user]);
    }
    public function render()
    {
        return view('livewire.user-list');
    }
}
