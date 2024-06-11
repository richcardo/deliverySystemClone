<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $users= User::all();
        return view('admin.index', compact('users'));
    }
    
    public function create()
    {
        return view('admin.create');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with(['success'=>'Utente Eliminato']);
    }

}
