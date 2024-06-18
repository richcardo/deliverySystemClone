<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\Rider;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }
    public function create(){
        return view('user.create');
    }
    public function store(UserStoreRequest $request){
        $user = User::create($request->all());
        return redirect()->back()->with(['success'=>'Utente creato correttamente']);
    }
    public function edit(User $user){
        return view('user.edit', compact('user')); 
    }

    public function update(User $user, UserStoreRequest $request){
        $user->update([
            'name'=> $request->name, 
            'password'=>$request->password,
        ]);
        return redirect()->back()->with(['success'=>'Utente modificato correttamente']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with(['success'=>'Utente eliminato correttamente']);
    }

    public function closeCount(Rider $rider)
    {
        dd($rider);
        return view('riders.count', compact('rider'));
    }
}
